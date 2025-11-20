<?php

namespace App\Http\Controllers;

use App\Models\PotensiPangan;
use Illuminate\Http\Request;

class PetaPanganController extends Controller
{
    public function index()
    {
        // Ambil semua data dari tabel potensipangan untuk peta
        $potensiPangan = PotensiPangan::all();

        // Ambil semua lokasi unik untuk tag
        $lokasis = PotensiPangan::select('lokasi')
            ->distinct()
            ->whereNotNull('lokasi')
            ->get();

        // Kelompokkan data berdasarkan kategori
        $dataPerKategori = $potensiPangan->groupBy('kategori');

        return view('peta-pangan', compact('potensiPangan', 'lokasis', 'dataPerKategori'));
    }
}
