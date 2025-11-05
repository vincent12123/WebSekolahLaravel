<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class GalleryAlbum extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'cover_image_url',
        'event_date',
    ];

    protected function casts(): array
    {
        return [
            'event_date' => 'date',
        ];
    }

    /**
     * Get the photos in this album.
     */
    public function photos(): HasMany
    {
        return $this->hasMany(GalleryPhoto::class);
    }

    /**
     * Get the extracurricular activity linked to this album.
     */
    public function extracurricular(): HasOne
    {
        return $this->hasOne(Extracurricular::class);
    }
}
