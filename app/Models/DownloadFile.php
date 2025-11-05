<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DownloadFile extends Model
{
    //
    protected $fillable = [
        'download_category_id',
        'title',
        'file_path',
        'file_type',
        'file_size_kb',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(DownloadCategory::class, 'download_category_id');
    }
}
