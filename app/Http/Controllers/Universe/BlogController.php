<?php

namespace App\Http\Controllers\Universe;

use Carbon\Carbon;
use App\Models\Post;
use App\Concern\Blog;
use App\Models\Media;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Concern\MediaManager;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Mockery\Undefined;

class BlogController extends Controller
{

    protected $mediaManager;

    public function __construct()
    {
        $this->mediaManager = new MediaManager();
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('universe.posts.index');
    }

        /**
     * Display a listing of the resource.
     */
    public function privateIndex()
    {
        $posts = Post::where('status', 'PRIVATE')->orderByDesc('published_at')->with('categories')->paginate(3);

        return view('universe.my-universe', [
            'posts' => $posts
        ]);
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
            'categories.*' => 'integer|exists:categories,id',
            'categories' => 'nullable|array',
            'publishedAt' => 'nullable|string',
        ]);

        if ($request->filled('thumbnail') && $request->thumbnail != 'undefined') {
            $request->validate([
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        }

        $post = new Post();
        $post->title = $validated['title'];
        $post->content = json_encode($validated['content']);
        $post->slug = $validated['slug'];
        $post->excerpt = $validated['excerpt'];
        $post->status = Str::upper($validated['status']);
        $post->published_at = $validated['publishedAt'] === 'now' ? Carbon::now() : Carbon::createFromFormat('d/m/Y', $validated['publishedAt']);

        if ($request->hasFile('thumbnail')) {
            $disk = $post->status == 'PRIVATE' ? 'private' : 'public';
            $uploadPath = "media/{$post->slug}/thumbnails";
            $thumbnail = $this->mediaManager->upload($request->file('thumbnail'), null, $post, $disk, $uploadPath);

            $post->image = $this->mediaManager->getUrl($thumbnail, $post->slug);
            
            //dd($post->image);
        } else {
            $post->image = asset('storage/site-images/pending.jpg');
        }

        $post->save();

        if ($request->filled('categories')) {
            $post->categories()->sync($validated['categories']);
        }

        toast()->success('L\'article "' . $post->title . '" a bien été ajouté.')->pushOnNextPage();

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
            'categories.*' => 'integer|exists:categories,id',
            'categories' => 'nullable|array',
            'publishedAt' => 'nullable|string',
        ]);

        if ($request->filled('thumbnail') && $request->thumbnail != 'undefined') {
            $request->validate([
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        }

        // Met à jour les attributs de l'article
        $post->title = $validated['title'];
        $post->content = json_encode($validated['content']);
        $post->slug = $validated['slug'];
        $post->excerpt = $validated['excerpt'];
        $post->status = Str::upper($validated['status']);

        // Met à jour la date de publication
        if ($validated['publishedAt'] === 'now') {
            $post->published_at = Carbon::now();
        } else {
            $post->published_at = Carbon::createFromFormat('d/m/Y', $validated['publishedAt']);
        }

        // Gérer la suppression de l'image précédente si elle a été remplacée
        if ($request->hasFile('thumbnail')) {
            // Supprime l'ancienne image si elle existe et n'est pas l'image par défaut
            if ($post->image && !str_contains($post->image, 'pending.jpg')) {
                $cleanedPath = str_replace('/storage/', '', parse_url($post->image, PHP_URL_PATH));
                $oldMedia = Media::where('file_name', $cleanedPath)
                                ->where('model_type', Post::class)
                                ->where('model_id', $post->id)
                                ->first();

                // dd(['oldMedia' => $oldMedia, 
                //     'basename(parse_url($post->image, PHP_URL_PATH)' => parse_url($post->image, PHP_URL_PATH),
                // ]);

                if ($oldMedia) {
                    $this->mediaManager->delete($oldMedia);
                }
            }

            // Téléchargement de la nouvelle image selon la visibilité
            $disk = $post->status == 'PRIVATE' ? 'private' : 'public';
            
            $thumbnail = $this->mediaManager->upload($request->file('thumbnail'), null, $post, $disk, "media/$post->slug/thumbnails");
            $post->image = $this->mediaManager->getUrl($thumbnail, $post->slug);
        } else {
            
            // Si aucune nouvelle image n'est téléchargée, déplacez l'image existante si la visibilité change
            if ($post->image && !str_contains($post->image, 'pending.jpg')) {

                // Si l'article est privé
                if ($post->status == 'PRIVATE') {
                    $filePath = str_replace('/storage/', '', parse_url($post->image, PHP_URL_PATH));
            
                    if (Storage::disk('public')->exists($filePath)) {
                        // Déplacer de public à privé
                        Storage::disk('private')->put($filePath, Storage::disk('public')->get($filePath));
                        Storage::disk('public')->delete($filePath);
            
                        // Mise à jour du chemin de l'image
                        $post->image = url("/storage/private/{$filePath}");
                    }
            
                // Si l'article devient public
                } elseif ($post->status != 'PRIVATE') {
                    $filePath = str_replace('/storage/private/', '', parse_url($post->image, PHP_URL_PATH));
            
                    if (Storage::disk('private')->exists($filePath)) {
                        // Déplacer de privé à public
                        Storage::disk('public')->put($filePath, Storage::disk('private')->get($filePath));
                        Storage::disk('private')->delete($filePath);
            
                        // Mise à jour du chemin de l'image
                        $post->image = asset('storage/' . $filePath);
                    }
                }
            }
        }

        //dd($post);

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
        return $blog->getPostContentData($postId);
    }

    /**
     * Duplicate the specified resource from storage.
     */
    public function duplicate(int $postId)
    {
        // Charger l'article original
        $post = Post::where('id', $postId)->firstOrFail();

        // Dupliquer l'article
        $newPost = $post->replicate(); // Cloner l'article sans l'ID
        $newPost->title = $post->title . ' - duplicate';
        $newPost->slug = $post->slug . '-duplicate';

        // Sauvegarder le nouvel article
        $newPost->save();

        // Retourner le nouvel article
        // Affiche un message de succès
        toast()
        ->success('L\'article "' . $post->title . '" a bien été dupliqué.')
        ->pushOnNextPage();

        // Redirige vers la page d'édition de l'article
        return redirect(route('admin.blog.post.edit', $newPost->id));
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
            'slug' => 'unique:categories|max:255',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;

        if(empty($request->slug)) {
            $category->slug = Str::slug($request->name);
        }else {
            $category->slug = $request->slug;
        }
        
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
            'description' => 'nullable|string',
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
