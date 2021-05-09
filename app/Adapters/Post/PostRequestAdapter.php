<?php

namespace App\Adapters\Post;

use App\Entities\Post\PostEntity;
use Illuminate\Support\Facades\Auth;

class PostRequestAdapter
{
    public static function toPostEntity(string $title, string $body): PostEntity
    {
        $postEntity = new PostEntity();
        $postEntity->userId = Auth::id() ?? null;
        $postEntity->title = $title;
        $postEntity->body = $body;
        $postEntity->slug = $title;
        $postEntity->excerpt = $body;
        $postEntity->created_at = now();
        $postEntity->updated_at = now();
        $postEntity->views = 0;

        return $postEntity;
    }
}
