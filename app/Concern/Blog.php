<?php

namespace App\Concern;

use App\Models\Post;

class Blog
{

    public function getPostContentData(int $postId) {
        $post = Post::where('id', $postId)->firstOrFail();
        // j'aimerais rajouter la clef slug de l'article
        return json_encode([
            'content' => $post->content,
            'slug' => $post->slug,
        ]);
    }
}