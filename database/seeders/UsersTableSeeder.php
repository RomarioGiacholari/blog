<?php

namespace Database\Seeders;

use App\Podcast;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::statement("TRUNCATE TABLE users");
        DB::statement("TRUNCATE TABLE podcasts");
        DB::statement("TRUNCATE TABLE posts");
        
        DB::transaction(function () {
            $user = new User();
            $user->name = 'giacholari';
            $user->email = 'giacholari@gmail.com';
            $user->password = bcrypt('password');
            $user->save();

            $podcast = new Podcast();
            $podcast->user_id = $user->id;
            $podcast->title = 'Romario Giacholari';
            $podcast->description = 'Podcast of Romario Giacholari';
            $podcast->save();

            $posts = [];
            $userId = $user->id;
            $views = 0;

            for ($i = 0; $i < 50; $i++) {
                $title = Str::random(10);
                $body = Str::random(50);
                $excerpt = strip_tags(Str::limit($body, 96, ' ...'));
                $slug = Str::slug($title, '-');

                $posts[] = [
                    'user_id' => $userId,
                    'title'   => $title,
                    'body'    => $body,
                    'excerpt' => $excerpt,
                    'slug'    => $slug,
                    'views'   => $views,
                    'created_at' => now()->toDateTimeString(),
                    'updated_at' => now()->toDateTimeString()
                ];
            }

            $chunkedPostList = array_chunk($posts, 50);

            foreach ($chunkedPostList as $list) {
                DB::table("posts")->insert($list);
            }
        });
    }
}
