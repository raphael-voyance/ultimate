<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Concern\Blog;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::where('status', 'PUBLISH')->paginate(3);
        return view('blog.my-universe', ['posts' => $posts]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        if(!Auth::user() || ($post->status != 'PUBLISH' && !Auth::user()->hasRole('admin'))) {
            abort(404);
        }
        return view('blog.show', ['post' => $post]);
    }

    public function getPostDataContent(int $postId) {
        $blog = new Blog;
        dd($blog->getPostContentData($postId));
    }
}
