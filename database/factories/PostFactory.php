<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    
    $title = $faker->title;
    $body =  $faker->paragraph;

    return [
        'title' => $title,
        'body' => $body,
        'excerpt' => $body,
        'slug' => $title,
    ];
});