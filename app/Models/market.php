<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class market extends Model
{
    protected $table = 'market';

    protected $fillable = [
        'produk_pangan',
        'deskripsi',
        'harga',
        'nomor_hp',
        'latitude',
        'longitude',
        'gambar',
    ];

    // Accessor untuk kompatibilitas dengan view
    public function getNamaAttribute()
    {
        return $this->produk_pangan;
    }

    public function getWhatsappAttribute()
    {
        return $this->nomor_hp;
    }

    public function getPenjualAttribute()
    {
        return 'Petani Lokal'; // Default value atau sesuaikan dengan struktur data Anda
    }

    public function getKategoriAttribute()
    {
        // Anda bisa menambahkan logika untuk menentukan kategori berdasarkan nama produk
        $produk = strtolower($this->produk_pangan);

        if (str_contains($produk, 'beras') || str_contains($produk, 'jagung') || str_contains($produk, 'singkong')) {
            return 'karbo';
        } elseif (str_contains($produk, 'daging') || str_contains($produk, 'ayam') || str_contains($produk, 'telur')) {
            return 'ternak';
        } elseif (str_contains($produk, 'wortel') || str_contains($produk, 'bayam') || str_contains($produk, 'kangkung')) {
            return 'sayur';
        } elseif (str_contains($produk, 'apel') || str_contains($produk, 'jeruk') || str_contains($produk, 'mangga')) {
            return 'buah';
        }

        return 'lainnya';
    }
}
