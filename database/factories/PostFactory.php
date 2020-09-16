<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Post::class, function (Faker $faker) {
    $title = $faker->title;
    $body =  $faker->paragraph;

    return [
        'title'   => $title,
        'body'    => $body,
        'excerpt' => strip_tags(Str::limit($body, 50, ' ...')),
        'slug'    => str_slug($title, '-'),
    ];
});
