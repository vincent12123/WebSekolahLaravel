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
        // Prefer public disk; fall back to local disk (served) if needed
        $storage = \Illuminate\Support\Facades\Storage::disk('public');
        if ($storage->exists($path)) {
            return $storage->url($path);
        }

        // Fallback: if previously saved to the default/local disk
        $local = \Illuminate\Support\Facades\Storage::disk(config('filesystems.default'));
        if ($local->exists($path)) {
            try {
                return $local->url($path);
            } catch (\Throwable $e) {
                // ignore and let it fall through
            }
        }

        // Last resort: return as-is, which will likely 404 but avoids exceptions
        return $path;
    }
}
