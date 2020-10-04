<?php

namespace Database\Seeders;

use App\Podcast;
use App\Post;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::transaction(function () {
            $user = new User();
            $user->name = 'giacholari';
            $user->email = 'giacholari@gmail.com';
            $user->password = bcrypt('password');

            $user->save();

            $podcast = new Podcast();
            $podcast->title = 'Romario Giacholari';
            $podcast->description = 'Podcast of Romario Giacholari';

            $posts = Post::factory()->count(30)->make();

            $user->podcasts()->save($podcast);

            $user->posts()->saveMany($posts);
        });
    }
}
