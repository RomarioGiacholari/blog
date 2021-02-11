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
        $title         = $this->faker->word;
        $body          =  $this->faker->paragraph;
        $randomInteger = random_int(1, 10);
        $hash          = bcrypt("{$title}{$randomInteger}");
        $partOfTheHash = substr($hash, 0, 5);

        return [
            'title'   => $partOfTheHash,
            'body'    => $body,
            'excerpt' => strip_tags(Str::limit($body, 96, ' ...')),
            'slug'    => Str::slug($partOfTheHash, '-'),
            'views'   => 0,
        ];
    }
}
