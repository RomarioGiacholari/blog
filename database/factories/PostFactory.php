<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Post::class, function (Faker $faker) {
    $title = $faker->title;
    $body =  $faker->word;

    return [
        'title'   => $title,
        'body'    => $body,
        'excerpt' => strip_tags(Str::words($body, 20, ' ...')),
        'slug'    => str_slug($title, '-'),
    ];
});
