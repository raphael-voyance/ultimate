<?php

namespace App\Http\Controllers\Universe;

use Carbon\Carbon;
use App\Models\Post;
use App\Concern\Blog;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('universe.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('name', 'slug', 'id')->orderByDesc('id')->get();
        return view('universe.posts.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|unique:posts|max:255',
            'content' => 'required',
            'slug' => 'required|unique:posts|max:255',
            'status' => 'string',
            'excerpt' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categories.*' => 'integer|exists:categories,id',
            'categories' => 'nullable|array',
            'publishedAt' => 'nullable|string',
        ]);

        $post = new Post();

        $post->title = $request->get('title');
        $post->content = json_encode($request->get('content'));
        $post->slug = $request->get('slug');
        $post->excerpt = $request->get('excerpt');
        $post->status = Str::upper($request->get('status'));

        if ($request->get('publishedAt') === 'now') {
            $post->published_at = Carbon::now();
        } else {
            $post->published_at = Carbon::createFromFormat('d/m/Y', $request->get('publishedAt'));
        }

        if ($request->hasFile('thumbnail')) {
            if($post->status == 'PRIVATE') {
                $thumbnailPath = $request->file('thumbnail')->store('images', 'private');
                $validated['thumbnail'] = $thumbnailPath;
                $post->image = url("/storage/private/{$thumbnailPath}");
            }else {
                $thumbnailPath = $request->file('thumbnail')->store('posts/thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
                $post->image = asset('storage/' . $thumbnailPath);
            }
        }else {
            $post->image = asset('storage/site-images/pending.jpg');
        }
 
        $post->save();

        $post->categories()->sync($request->get('categories'));

        //dd($request->publishedAt);

        toast()
            ->success('L\'article "' . $post->title . '" a bien été ajouté.')
            ->pushOnNextPage();

        $redirectRoute = route('admin.blog.post.edit', $post->id);
        return response()->json(['status' => 'success', 'redirectRoute' => $redirectRoute]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::where('id', $id)->firstOrFail();
        $categories = Category::select('name', 'slug', 'id')->orderByDesc('id')->get();

        return view('universe.posts.edit', [
            'post' => $post,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Récupère l'article à mettre à jour
        $post = Post::where('id', $id)->firstOrFail();

        // Valide les données de la requête
        $validated = $request->validate([
            'title' => [
                'required',
                'max:255',
                Rule::unique('posts')->ignore($post->id),
            ],
            'content' => 'required',
            'slug' => [
                'required',
                'max:255',
                Rule::unique('posts')->ignore($post->id),
            ],
            'status' => 'string',
            'excerpt' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categories.*' => 'integer|exists:categories,id',
            'categories' => 'nullable|array',
            'publishedAt' => 'nullable|string',
        ]);

        // Met à jour les attributs de l'article
        $post->title = $request->get('title');
        $post->content = json_encode($request->get('content'));
        $post->slug = $request->get('slug');
        $post->excerpt = $request->get('excerpt');
        $post->status = Str::upper($request->get('status'));

        // Met à jour la date de publication
        if ($request->get('publishedAt') === 'now') {
            $post->published_at = Carbon::now();
        } else {
            $post->published_at = Carbon::createFromFormat('d/m/Y', $request->get('publishedAt'));
        }

        // Initialiser $filename pour qu'il soit disponible même si aucune nouvelle image n'est téléchargée
        $filename = null;

        if ($post->image && !str_contains($post->image, 'pending.jpg')) {
            // Extrait le chemin relatif de l'image actuelle
            $oldPath = parse_url($post->image, PHP_URL_PATH);
            $oldPath = ltrim($oldPath, '/');
            $filename = basename($oldPath);
        }

        // Vérifie si une nouvelle image a été téléchargée
        if ($request->hasFile('thumbnail')) {
            // Supprime l'ancienne image si elle existe
            if ($filename) {
                // Détermine le disque actuel de l'image
                if (Storage::disk('private')->exists('images/' . $filename)) {
                    Storage::disk('private')->delete('images/' . $filename);
                } elseif (Storage::disk('public')->exists('posts/thumbnails/' . $filename)) {
                    Storage::disk('public')->delete('posts/thumbnails/' . $filename);
                }
            }

            // Téléchargement de la nouvelle image selon la visibilité
            if ($post->status == 'PRIVATE') {
                $thumbnailPath = $request->file('thumbnail')->store('images', 'private');
                $post->image = url("/storage/private/{$thumbnailPath}");
            } else {
                $thumbnailPath = $request->file('thumbnail')->store('posts/thumbnails', 'public');
                $post->image = asset('storage/' . $thumbnailPath);
            }

            } else {
                // Si aucune nouvelle image n'est téléchargée, déplacez l'image existante si la visibilité change
                if ($filename) {
                    if ($post->status == 'PRIVATE' && Storage::disk('public')->exists('posts/thumbnails/' . $filename)) {
                        // Déplacer du disque public au disque privé
                        Storage::disk('private')->put('images/' . $filename, Storage::disk('public')->get('posts/thumbnails/' . $filename));
                        Storage::disk('public')->delete('posts/thumbnails/' . $filename);
                        $post->image = url("/storage/private/images/{$filename}");
                    } elseif ($post->status != 'PRIVATE' && Storage::disk('private')->exists('images/' . $filename)) {
                        // Déplacer du disque privé au disque public
                        Storage::disk('public')->put('posts/thumbnails/' . $filename, Storage::disk('private')->get('images/' . $filename));
                        Storage::disk('private')->delete('images/' . $filename);
                        $post->image = asset('storage/posts/thumbnails/' . $filename);
                    }
                }
            }

            // Enregistre les modifications
            $post->save();

            // Met à jour les catégories associées
            $post->categories()->sync($request->get('categories'));

            // Affiche un message de succès
            toast()
                ->success('L\'article "' . $post->title . '" a bien été mis à jour.')
                ->pushOnNextPage();

            // Redirige vers la page d'édition de l'article
            $redirectRoute = route('admin.blog.post.edit', $id);
            return response()->json(['status' => 'success', 'redirectRoute' => $redirectRoute]);
    }

    public function getPostDataContent(int $postId) {
        $blog = new Blog;
        // dd($blog->getPostContentData($postId));
        return $blog->getPostContentData($postId);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        // Post
        $post = Post::where('id', $id)->firstOrFail();

        $post->delete();

        toast()
            ->success('L\'article vient d\'être supprimé avec succés.')
            ->pushOnNextPage();

        $redirectRoute = route('admin.blog.post.index');
        return response()->json(['status' => 'success', 'redirectRoute' => $redirectRoute]);
    }

    /**
     * Show all resources.
     */
    public function indexCategory(Request $request)
    {
        return view('universe.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createCategory()
    {
        return view('universe.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:255',
            'description' => 'nullable|string',
            'slug' => 'required|unique:categories|max:255',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->slug = $request->slug;
        $category->save();

        $redirectRoute = route('admin.blog.category.edit', $category->id);
        return response()->json([
            'status' => 'success', 
            'message' => 'La catégorie "' . $category->name . '" a bien été ajoutée.',
            'categoryId' => $category->id,
            'redirectRoute' => $redirectRoute
        ]);
    }

    public function editCategory(string $id) {
        $category = Category::where('id', $id)->firstOrFail();

        return view('universe.categories.edit', [
            'category' => $category
        ]);
    }

    public function updateCategory(Request $request, string $id) {
        // Récupère l'article à mettre à jour
        $category = Category::where('id', $id)->firstOrFail();

        $validated = $request->validate([
            'name' => [
                'required',
                'max:255',
                Rule::unique('categories')->ignore($category->id),
            ],
            'description' => 'required',
            'slug' => [
                'required',
                'max:255',
                Rule::unique('categories')->ignore($category->id),
            ],
        ]);

        $category->name = $request->name;
        $category->description = $request->description;
        $category->slug = $request->slug;
        $category->save();

        return response()->json([
            'status' => 'success', 
            'message' => 'La catégorie "' . $category->name . '" a bien été mise à jour.',
            'categoryId' => $category->id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyCategory(string $id)
    {
        
        // Post
        $category = Category::where('id', $id)->firstOrFail();

        $category->delete();

        toast()
            ->success('La catégorie vient d\'être supprimée avec succés.')
            ->pushOnNextPage();

        $redirectRoute = route('admin.blog.category.index');
        return response()->json(['status' => 'success', 'redirectRoute' => $redirectRoute]);
    }
}
