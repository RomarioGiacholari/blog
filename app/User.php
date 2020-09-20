<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function podcasts()
    {
        return $this->hasMany(Podcast::class);
    }

    public function isAdmin(): bool
    {
        $isAdmin = false;
        $email   = config('app.admin_email');

        if (isset($email)) {
            $isAdmin = ($this->email === $email);
        }

        return $isAdmin;
    }
}
