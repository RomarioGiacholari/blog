<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'body', 'slug'];
    
    public function creator() 
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function path()
    {
        return "posts/{$this->slug}";
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_slug($value,'-');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
