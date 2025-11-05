<?php

namespace App\Observers;

use Illuminate\Support\Str;
use Stephenjude\FilamentBlog\Models\Post;

class BlogPostObserver
{
    /**
     * Handle the Post "creating" event.
     */
    public function creating(Post $post): void
    {
        $this->ensureSlug($post);
    }

    /**
     * Handle the Post "updating" event.
     */
    public function updating(Post $post): void
    {
        // Auto-generate only if slug is empty or user didn't change it explicitly
        if (empty($post->slug) || ($post->isDirty('title') && !$post->isDirty('slug'))) {
            $this->ensureSlug($post);
        }
    }

    private function ensureSlug(Post $post): void
    {
        // If slug provided, just make sure it's unique
        if (!empty($post->slug)) {
            $post->slug = $this->makeUniqueSlug($post->slug, $post->id);
            return;
        }

        $base = Str::slug((string) $post->title);
        if ($base === '') {
            $base = 'post';
        }

        $post->slug = $this->makeUniqueSlug($base, $post->id);
    }

    private function makeUniqueSlug(string $base, ?int $ignoreId = null): string
    {
        $slug = $base;
        $i = 2;

        while (
            Post::query()
                ->where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base . '-' . $i;
            $i++;
        }

        return $slug;
    }
}
