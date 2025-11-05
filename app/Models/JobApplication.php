<?php
// app/Models/JobApplication.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_listing_id',
        'full_name',
        'email',
        'phone',
        'cover_letter',
        'cv_file_url',
    ];

    /**
     * Get the job listing that the application belongs to.
     */
    public function jobListing(): BelongsTo
    {
        return $this->belongsTo(JobListing::class);
    }
}
