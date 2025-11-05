<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobListing extends Model
{
    //
    protected $fillable = [
        'position',
        'job_type',
        'location',
        'description',
        'requirements',
        'deadline',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'deadline' => 'date',
        ];
    }

    /**
     * Get the applications for the job listing.
     */
    public function applications(): HasMany
    {
        return $this->hasMany(JobApplication::class);
    }
}
