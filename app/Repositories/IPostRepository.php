<?php

namespace App\Repositories;

use App\Entities\Post\PostEntity;

interface IPostRepository
{
    public function get(int $limit, string $orderByColumn = 'created_at', string $direction = 'desc'): array;

    public function store(object $postData): ?string;

    public function findBy(string $slug): ?PostEntity;

    public function update(object $postData, string $slug): bool;

    public function destroy(string $slug): bool;

    public function incrementViews(string $slug): bool;
}
