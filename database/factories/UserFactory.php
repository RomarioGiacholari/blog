<?php

namespace Database\Factories;

use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name'           => Str::random(10),
            'email'          => $this->faker->unique()->safeEmail,
            'password'       => bcrypt('password'),
            'remember_token' => Str::random(10),
        ];
    }
}
