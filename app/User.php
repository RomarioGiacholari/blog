<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use HasFactory;

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
        $email = config('app.admin_email');

        if ($email !== null && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $isAdmin = ($this->attributes['email'] === $email);
        }

        return $isAdmin;
    }
}
