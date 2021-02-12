<?php

namespace App\Adapters\Post;

use App\Entities\Post\PostEntity;
use App\Post;

class PostAdapter
{
    public static function toPostEntity(Post $post): PostEntity
    {
        $postEntity = new PostEntity();
        $postEntity->userId = $post->user_id;
        $postEntity->title = $post->title;
        $postEntity->body = $post->body;
        $postEntity->slug = $post->title;
        $postEntity->excerpt = $post->body;
        $postEntity->views = $post->views;

        return $postEntity;
    }
}
