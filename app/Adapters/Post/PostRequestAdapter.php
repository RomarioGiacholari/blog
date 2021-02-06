<?php

namespace App\Adapters\Post;

use App\Entities\Post\PostEntity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostRequestAdapter
{
    public static function toPostEntity(Request $request): PostEntity
    {
        $postEntity          = new PostEntity();
        $postEntity->userId  = Auth::id() ?? null;
        $postEntity->title   = $request->get('title');
        $postEntity->body    = $request->get('body');
        $postEntity->slug    = $request->get('title');
        $postEntity->excerpt = $request->get('body');
        $postEntity->views   = 0;

        return $postEntity;
    }
}
