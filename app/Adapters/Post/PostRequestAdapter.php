<?php

namespace App\Adapters\Post;

use App\Entities\Post\PostEntity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostRequestAdapter
{
    public static function toPostEntity(Request $request): PostEntity
    {
        $postEntity = new PostEntity();
        $postEntity->userId = Auth::id() ?? null;
        $postEntity->title = $request->get('title');
        $postEntity->body = $request->get('body');
        $postEntity->slug = $request->get('title');
        $postEntity->excerpt = $request->get('body');
        $postEntity->created_at = now();
        $postEntity->updated_at = now();
        $postEntity->views = 0;

        return $postEntity;
    }

    public static function getOrderByKey(Request $request): string
    {
        $allowedKeys = ['created_at', 'views'];
        $default = $allowedKeys[0];
        $orderBy = $request->query('order_by') ?? $default;

        if (!in_array($orderBy, $allowedKeys)) {
            $orderBy = $default;
        }

        return $orderBy;
    }

    public static function getOrderByDirection(Request $request): string
    {
        $allowedKeys = ['desc', 'asc'];
        $default = $allowedKeys[0];
        $direction = $request->query('direction') ?? $default;

        if (!in_array($direction, $allowedKeys)) {
            $direction = $default;
        }

        return $direction;
    }

    public static function getPage(Request $request): int
    {
        $page =  $request->query('page') ?? 1;

        if ($page < 1) {
            $page = 1;
        }

        return $page;
    }
}
