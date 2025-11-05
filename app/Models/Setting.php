<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    //
    protected $fillable = [
        'nama_sekolah',
        'logo_url',
        'alamat',
        'telepon',
        'email_kontak',
        'link_facebook',
        'link_instagram',
        'link_youtube',
    ];
}
