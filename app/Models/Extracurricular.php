<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

    /**
     * Backward-compat: views expect `logo_path` (relative path for Storage::url()).
     * Here we derive it from `logo_url` when it is a local storage path.
     */
    public function getLogoPathAttribute(): ?string
    {
        $path = $this->logo_url;
        if (empty($path)) {
            return null;
        }

        // If it's an absolute URL or leading slash, don't return a storage path
        if (Str::startsWith($path, ['http://', 'https://', '/'])) {
            return null;
        }

        return $path;
    }

    /**
     * Convenience accessor to get a public URL for the logo, regardless of storage or external.
     */
    public function getLogoPublicUrlAttribute(): ?string
    {
        $path = $this->logo_url;
        if (empty($path)) {
            return null;
        }

        if (Str::startsWith($path, ['http://', 'https://', 'data:', '/'])) {
            return $path;
        }

        return Storage::disk('public')->url($path);
    }
}
