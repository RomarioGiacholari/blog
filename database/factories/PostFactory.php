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
        $title = $this->faker->word;
        $body  =  $this->faker->paragraph;

        return [
            'title'   => $title,
            'body'    => $body,
            'excerpt' => strip_tags(Str::limit($body, 50, ' ...')),
            'slug'    => Str::slug($title, '-'),
        ];
    }
}
