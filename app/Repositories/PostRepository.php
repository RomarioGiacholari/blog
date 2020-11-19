<?php

namespace App\Repositories;

use App\Entities\Post\PostEntity;
use App\Post;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostRepository implements IPostRepository
{
    private Post $repository;

    public function __construct(Post $repository)
    {
        $this->repository = $repository;
    }

    public function get(int $perPage, string $orderByColumn = 'created_at', string $direction = 'desc'): ?Paginator
    {
        $postCollection = null;

        DB::transaction(function () use (&$postCollection, $perPage, $orderByColumn, $direction) {
            $postData = $this->repository::query()->orderBy($orderByColumn, $direction)->paginate($perPage);

            if (!$postData->isEmpty()) {
                $postCollection = $postData;
            }
        });

        return $postCollection;
    }

    public function store(PostEntity $postEntity): ?string
    {
        $postSlug = null;

        DB::transaction(function () use (&$postSlug, $postEntity) {
            if ($postEntity) {
                $postData = new Post();
                $postData->user_id = $postEntity->userId;
                $postData->title = $postEntity->title;
                $postData->body = $postEntity->body;
                $postData->excerpt = strip_tags(Str::limit($postEntity->excerpt, 100, ' ...'));
                $postData->slug = Str::slug($postEntity->slug, '-');
                $isSuccess = $postData->save();

                if ($isSuccess) {
                    $postSlug = $postData->slug;
                }
            }
        });

        return $postSlug;
    }

    public function findBy(string $slug): ?Post
    {
        $postData = null;

        DB::transaction(function () use (&$postData, $slug) {
            if (trim($slug) !== '') {
                /** @var Post $postData */
                $postData = $this->repository::query()->where('slug', '=', $slug)->first();
            }
        });

        return $postData;
    }

    public function update(PostEntity $postEntity, string $slug): bool
    {
        $isSuccess = false;

        DB::transaction(function () use (&$isSuccess, $postEntity, $slug) {
            $postData = $this->findBy($slug);

            if ($postData !== null) {
                $postData->title = $postEntity->title;
                $postData->body = $postEntity->body;
                $postData->excerpt = strip_tags(Str::limit($postEntity->excerpt, 100, ' ...'));
                $postData->slug = Str::slug($postEntity->slug, '-');
                $isSuccess = $postData->save();
            }
        });

        return $isSuccess;
    }

    public function destroy(string $slug): bool
    {
        $isSuccess = false;

        DB::transaction(function () use (&$isSuccess, $slug) {
            $postData = $this->findBy($slug);

            if ($postData !== null) {
                $isSuccess = $postData->delete();
            }
        });

        return $isSuccess;
    }
}
