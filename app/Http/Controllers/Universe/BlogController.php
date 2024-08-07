<?php

namespace App\Http\Controllers\Universe;

use App\Models\Post;
use App\Concern\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        return view('universe.posts.create');
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
            'excerpt' => 'nullable|string',
        ]);

        $post = new Post;

        $post->title = $request->get('title');
        $post->content = json_encode($request->get('content'));
        $post->slug = $request->get('slug');
        $post->excerpt = $request->get('excerpt');

        if($request->image) {
            $post->image = $request->image;
        }else {
            $post->image = asset('imgs/pending.jpg');
        }
 
        $post->save();

        toast()
            ->success('L\'article "' . $post->title . '" a bien été ajouté.')
            ->pushOnNextPage();

        $redirectRoute = route('admin.post.edit', $post->id);
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

        return view('universe.posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::where('id', $id)->firstOrFail();

        $post->content = $request->content;
 
        $post->save();

        toast()
            ->success('L\'article "' . $post->title . '" a bien été mis à jour.')
            ->pushOnNextPage();

        $redirectRoute = route('admin.post.edit', $id);
        return response()->json(['status' => 'success', 'redirectRoute' => $redirectRoute]);

        // return back()->withInput();
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

        $redirectRoute = route('admin.post.index');
        return response()->json(['status' => 'success', 'redirectRoute' => $redirectRoute]);
    }
}
