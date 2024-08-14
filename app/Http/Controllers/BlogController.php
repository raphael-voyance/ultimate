<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Concern\Blog;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::where('status', 'PUBLISH')->with('categories')->paginate(3);
        return view('blog.my-universe', ['posts' => $posts]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
{
    // Récupèrer l'article en fonction du slug
    $post = Post::where('slug', $slug)->firstOrFail();
    $user = Auth::user();
    
    if (!$user) {
        if ($post->status !== 'PUBLISH') {
            abort(404);
        }
    } elseif ($user && !$user->hasRole('admin')) {
        if ($post->status !== 'PUBLISH') {
            abort(404);
        }
    }
    return view('blog.show', ['post' => $post]);
}

    public function getPostDataContent(int $postId) {
        $blog = new Blog;
        dd($blog->getPostContentData($postId));
    }

    public function showCategory(string $slug) {
        $category = Category::where('slug', $slug)->select('id', 'name', 'description')->firstOrFail();
        // Récupère les articles qui appartiennent à cette catégorie et qui sont publiés
        $posts = Post::where('status', 'PUBLISH')
        ->whereHas('categories', function($query) use ($category) {
            $query->where('category_id', $category->id);
        })
        ->with('categories')
        ->paginate(3);
        return view('blog.category', [
            'posts' => $posts,
            'category' => $category
        ]);
    }
}
