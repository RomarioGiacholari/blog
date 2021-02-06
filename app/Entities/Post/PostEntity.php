<?php

namespace App\Entities\Post;

class PostEntity
{
    public ?int $userId;
    public string $title;
    public string $body;
    public string $slug;
    public string $excerpt;
    public int $views;
}