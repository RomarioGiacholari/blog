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

        if ($postEntity) {
            DB::transaction(function () use (&$postSlug, $postEntity) {
                $postData = new Post();
                $postData->user_id = $postEntity->userId;
                $postData->title = $postEntity->title;
                $postData->body = $postEntity->body;
                $postData->excerpt = strip_tags(Str::limit($postEntity->excerpt, 100, ' ...'));
                $postData->slug = Str::slug($postEntity->slug, '-');
                $postData->views = 0;
                $isSuccess = $postData->save();

                if ($isSuccess) {
                    $postSlug = $postData->slug;
                }
            });
        }

        return $postSlug;
    }

    public function findBy(string $slug): ?Post
    {
        $postData = null;

        if (trim($slug) !== '') {
            DB::transaction(function () use (&$postData, $slug) {
                /** @var Post $postData */
                $postData = $this->repository::query()->where('slug', '=', $slug)->sole();
            });
        }

        return $postData;
    }

    public function update(PostEntity $postEntity, string $slug): bool
    {
        $isSuccess = false;
        $postData = $this->findBy($slug);

        if ($postData !== null) {
            DB::transaction(function () use (&$isSuccess, $postEntity, $postData) {
                $postData->title = $postEntity->title;
                $postData->body = $postEntity->body;
                $postData->excerpt = strip_tags(Str::limit($postEntity->excerpt, 100, ' ...'));
                $postData->slug = Str::slug($postEntity->slug, '-');
                $isSuccess = $postData->save();
            });
        }

        return $isSuccess;
    }

    public function destroy(string $slug): bool
    {
        $isSuccess = false;
        $postData = $this->findBy($slug);

        if ($postData !== null) {
            DB::transaction(function () use (&$isSuccess, $postData) {
                $isSuccess = $postData->delete();
            });
        }

        return $isSuccess;
    }

    public function incrementViews(string $slug): bool
    {
        $isSuccess = false;
        $postData = $this->findBy($slug);

        if ($postData !== null) {
            DB::transaction(function () use (&$isSuccess, $postData) {
                $postData->views += 1;
                $isSuccess = $postData->save();
            });
        }

        return $isSuccess;
    }
}
