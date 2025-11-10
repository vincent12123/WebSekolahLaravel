<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    //
    protected $fillable = [
        'nama_sekolah',
        'nama_kepala_sekolah',
        'logo_url',
        'foto_kepala_sekolah_url',
        'alamat',
        'sambutan_kepala_sekolah',
        'telepon',
        'email_kontak',
        'jam_operasional',
        'link_facebook',
        'link_instagram',
        'link_youtube',
    ];

    /**
     * Public URL for the headmaster photo, handling external, absolute, or storage paths.
     */
    public function getFotoKepalaSekolahPublicAttribute(): ?string
    {
        $path = $this->foto_kepala_sekolah_url;
        if (empty($path)) {
            return null;
        }
        // Accept external URLs or absolute paths
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '/')) {
            return $path;
        }
        // Assume stored on public disk
        return \Illuminate\Support\Facades\Storage::disk('public')->url($path);
    }
}
