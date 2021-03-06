<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

/**
 * Class Episode.
 *
 * @property int    $id
 * @property int    $podcast_id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property string $audioBase64
 */
class Episode extends Model
{
    protected $fillable = ['title', 'slug', 'description', 'audioBase64'];

    public function podcast(): BelongsTo
    {
        return $this->belongsTo(Podcast::class);
    }

    public function setSlugAttribute(string $title): void
    {
        $this->attributes['slug'] = Str::slug($title, '-');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
