<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'body', 'slug', 'excerpt'
    ];
    
    public function creator() 
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function path()
    {
        return "posts/{$this->slug}";
    }

    public function setSlugAttribute($title)
    {
        $this->attributes['slug'] = str_slug($title,'-');
    }

    public function setExcerptAttribute($excerpt)
    {
        $this->attributes['excerpt'] = Str::words($excerpt, 20, ' ...');
    }

    public function setBodyAttribute($body)
    {
        $this->attributes['body'] = preg_replace(
        '/@([\w\-]+)/',
        '<a href="/$1">$0</a>',
        $body
        );
    }

    public function getBodyAttribute($body)
    {
        return \Purify::clean($body);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
