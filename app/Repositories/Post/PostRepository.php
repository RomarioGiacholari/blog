<?php

namespace App\Repositories\Post;

use App\Adapters\Post\PostAdapter;
use App\Entities\Post\PostEntity;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\DB;

class PostRepository implements IPostRepository
{
    private DatabaseManager $dataAccess;
    private static string $table = "posts";

    public function __construct(DatabaseManager $dataAccess)
    {
        $this->dataAccess = $dataAccess;
    }

    public function get(int $limit, int $offset = 0, string $orderByColumn = 'created_at', string $direction = 'desc'): array
    {
        $postEntities = [];
        $postData = $this->dataAccess->table(static::$table)->orderBy($orderByColumn, $direction)->limit($limit)->offset($offset)->get();

        if (!$postData->isEmpty()) {
            foreach ($postData as $postDataItem) {
                $postEntities[] = PostAdapter::toPostEntity($postDataItem);
            }
        }

        return $postEntities;
    }

    public function getForUser(int $userId, int $limit, int $offset = 0, string $orderByColumn = 'created_at', string $direction = 'desc'): array
    {
        $postEntities = [];
        $postData = $this->dataAccess->table(static::$table)->where('user_id', '=', $userId)->orderBy($orderByColumn, $direction)->limit($limit)->offset($offset)->get();

        if (!$postData->isEmpty()) {
            foreach ($postData as $postDataItem) {
                $postEntities[] = PostAdapter::toPostEntity($postDataItem);
            }
        }

        return $postEntities;
    }

    public function store(object $postData): ?string
    {
        $postSlug = null;

        if ($postData) {
            DB::transaction(function () use (&$postSlug, $postData) {
                $values = [
                    'user_id' => $postData->userId,
                    'title' => $postData->title,
                    'body' => $postData->body,
                    'excerpt' => $postData->excerpt,
                    'slug' => $postData->slug,
                    'views' => 0,
                    'created_at' => $postData->created_at,
                    'updated_at' => $postData->updated_at
                ];

                $isSuccess = $this->dataAccess->table(static::$table)->insert($values);

                if ($isSuccess) {
                    $postSlug = $values['slug'];
                }
            });
        }

        return $postSlug;
    }

    public function findBy(string $slug): ?PostEntity
    {
        $postEntity = null;

        if (trim($slug) !== '') {
            $postData = $this->dataAccess->table(static::$table)->where('slug', '=', $slug)->sole();
            $postEntity = PostAdapter::toPostEntity($postData);
        }

        return $postEntity;
    }

    public function update(object $postData, string $slug): bool
    {
        $isSuccess = false;

        if ($postData && trim($slug) !== '') {
            DB::transaction(function () use (&$isSuccess, $postData, $slug) {
                $values = [
                    'title' => $postData->title,
                    'body' => $postData->body,
                    'excerpt' => $postData->excerpt,
                    'slug' => $postData->slug,
                    'updated_at' => $postData->updated_at,
                ];

                $isSuccess = $this->dataAccess->table(static::$table)->where('slug', '=', $slug)->limit(1)->update($values);
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
                $isSuccess = $this->dataAccess->table(static::$table)->where('slug', '=', $postData->slug)->limit(1)->delete();
            });
        }

        return $isSuccess;
    }

    public function incrementViews(string $slug): bool
    {
        $isSuccess = false;
        $postData = $this->findBy($slug);

        if ($postData !== null) {
            DB::transaction(function () use (&$isSuccess, $postData,  $slug) {
                $values = [
                    'views' => $postData->views + 1
                ];

                $isSuccess = $this->dataAccess->table(static::$table)->where('slug', '=', $postData->slug)->limit(1)->update($values);
            });
        }

        return $isSuccess;
    }

    public function count (): int
    {
        return $this->dataAccess->table(static::$table)->count();
    }

    public function countForUser (int $userId): int
    {
        $count = 0;

        if ($userId > 0) {
            $count = $this->dataAccess->table(static::$table)->where('user_id', '=', $userId)->count();
        }

        return $count;
    }
}
