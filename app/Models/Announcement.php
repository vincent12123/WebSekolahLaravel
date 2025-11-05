<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'title',
        'content',
        'file_attachment_url',
        'is_important',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'is_important' => 'boolean',
            'published_at' => 'datetime',
        ];
    }
}
