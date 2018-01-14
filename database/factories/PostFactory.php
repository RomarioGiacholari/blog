<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    
    $title = $faker->title;
    return [
        'title' => $title,
        'body' => $faker->paragraph,
        'slug' => $title,
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        }
    ];
});
