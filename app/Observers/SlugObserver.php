<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SlugObserver
{
    public function creating(Model $model): void
    {
        $this->ensureSlug($model);
    }

    public function updating(Model $model): void
    {
        if ($model->isDirty('title') && !$model->isDirty('slug')) {
            $this->ensureSlug($model);
        }
        if ($model->isDirty('name') && !$model->isDirty('slug')) {
            $this->ensureSlug($model);
        }
    }

    private function ensureSlug(Model $model): void
    {
        if (!in_array('slug', $model->getFillable(), true)) {
            return; // model doesn't handle slug
        }

        $source = $model->getAttribute('title') ?? $model->getAttribute('name') ?? '';
        $base = Str::slug((string) $source);
        if ($base === '') {
            $base = 'item';
        }

        $slug = $base;
        $i = 2;
        $query = $model->newQuery()->where('slug', $slug);
        if ($model->exists) {
            $query->whereKeyNot($model->getKey());
        }
        while ($query->exists()) {
            $slug = $base . '-' . $i;
            $i++;
            $query = $model->newQuery()->where('slug', $slug);
            if ($model->exists) {
                $query->whereKeyNot($model->getKey());
            }
        }

        $model->setAttribute('slug', $slug);
    }
}
