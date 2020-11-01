<?php

namespace App\Adapters\Post;

use App\Entities\Post\PostEntity;
use Illuminate\Http\Request;

class PostRequestAdapter
{
    public static function toPostEntity(Request $request): PostEntity
    {
        $postEntity          = new PostEntity();
        $postEntity->title   = $request->get('title');
        $postEntity->body    = $request->get('body');
        $postEntity->slug    = $request->get('title');
        $postEntity->excerpt = $request->get('body');

        return $postEntity;
    }
}
