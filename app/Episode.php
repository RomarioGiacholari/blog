<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Episode extends Model
{
    protected $fillable = ['title', 'slug', 'description', 'audioBase64'];

    public function podcast()
    {
        return $this->belongsTo(Podcast::class);
    }

    public function setSlugAttribute($title)
    {
        $this->attributes['slug'] = Str::slug($title, '-');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
