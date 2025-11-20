<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PotensiPangan;

class PotensiPanganController extends Controller
{
    public function map()
    {
        $data = PotensiPangan::select('judul', 'kategori', 'gambar', 'link_video', 'lokasi', 'latitude', 'longitude', 'deskripsi')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        return view('potensi_pangan.map', compact('data'));
    }
}
