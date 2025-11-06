<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Event extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'starts_at',
        'ends_at',
        'location',
        'image_url',
        'status',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
            'published_at' => 'datetime',
        ];
    }

    public function getFeaturedImageAttribute(): ?string
    {
        $path = $this->image_url;
        if (empty($path)) {
            return null;
        }
        if (Str::startsWith($path, ['http://', 'https://', 'data:', '/'])) {
            return $path;
        }
        return Storage::disk('public')->url($path);
    }
}
