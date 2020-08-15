<?php

use App\User;
use App\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::transaction (function () {
            $user = new User;
            $user->name = 'giacholari';
            $user->email = 'giacholari@gmail.com';
            $user->password = bcrypt('password');
            
            $user->save();

            $user->posts()->saveMany(factory(Post::class, 30)->make());
        });
    }
}
