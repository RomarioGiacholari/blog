<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;

/**
 * Class User.
 *
 * @property int        $id
 * @property string     $name
 * @property string     $email
 * @property string     $password
 * @property Collection $posts
 */
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

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function podcasts(): HasMany
    {
        return $this->hasMany(Podcast::class);
    }

    public function isAdministrator(): bool
    {
        $isAdmin = false;
        $email = config('app.admin.email');

        if ($email !== null && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $isAdmin = ($this->attributes['email'] === $email);
        }

        return $isAdmin;
    }
}
