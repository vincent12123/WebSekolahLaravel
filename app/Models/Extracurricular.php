<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Extracurricular extends Model
{
    //
    protected $fillable = [
        'name',
        'slug',
        'logo_url',
        'instructor_name',
        'schedule',
        'description',
        'gallery_album_id',
    ];

    public function galleryAlbum(): BelongsTo
    {
        return $this->belongsTo(GalleryAlbum::class);
    }

}
