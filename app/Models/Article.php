<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'image_url',
        'status',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): MorphToMany
    {
        // Use polymorphic tags via the 'taggables' table
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

    /**
     * Accessor: map featured_image to the stored image_url with a public URL.
     * - If image_url is an absolute URL (http/https) or starts with '/', return as-is.
     * - Otherwise, assume it's a path on the public disk and return Storage public URL.
     */
    public function getFeaturedImageAttribute(): ?string
    {
        $path = $this->image_url;
        if (empty($path)) {
            // Default placeholder when no image set
            return 'https://placehold.co/1200x600?text=Artikel';
        }

        if (Str::startsWith($path, ['http://', 'https://', 'data:', '/'])) {
            return $path;
        }

        return Storage::disk('public')->url($path);
    }
}
