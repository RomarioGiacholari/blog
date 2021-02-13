<?php

namespace Database\Factories;

use App\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        $title = Str::random(10);
        $body = Str::random(100);

        return [
            'title'   => $title,
            'body'    => $body,
            'excerpt' => strip_tags(Str::limit($body, 96, ' ...')),
            'slug'    => Str::slug($title, '-'),
            'views'   => 0,
        ];
    }
}
