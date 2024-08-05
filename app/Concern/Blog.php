<?php

namespace App\Concern;

use App\Models\Post;

class Blog
{

    public function getPostContentData(int $postId) {
        $post = Post::where('id', $postId)->firstOrFail();
        return json_encode($post->content);
    }
}