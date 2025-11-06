<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'type',
        'order_column',
    ];

    protected $casts = [
        'name' => 'array',
        'slug' => 'array',
    ];

    public function articles(): MorphToMany
    {
        // Reverse polymorphic relation to get Articles that have this Tag
        return $this->morphedByMany(Article::class, 'taggable');
    }

    /**
     * Human-readable tag name for the current locale, with sensible fallbacks.
     */
    public function getNameLabelAttribute(): string
    {
        $name = $this->name;
        if (is_array($name)) {
            $locale = app()->getLocale();
            if (!empty($name[$locale])) return (string) $name[$locale];
            if (!empty($name['id'])) return (string) $name['id'];
            if (!empty($name['en'])) return (string) $name['en'];
            $first = reset($name);
            return is_string($first) ? $first : '';
        }
        return (string) ($name ?? '');
    }
}
