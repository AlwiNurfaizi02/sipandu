<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PotensiPangan extends Model
{
    protected $table = 'potensi_pangan';
    protected $fillable = [
        'judul',
        'kategori',
        'link_video',
        'lokasi',
        'latitude',
        'deskripsi',
        'longitude',
        'gambar',
        'jurnal',
        'alamat'
    ];
}
