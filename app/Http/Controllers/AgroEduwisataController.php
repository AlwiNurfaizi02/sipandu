<?php

namespace App\Http\Controllers;

use App\Models\PotensiPangan;
use Illuminate\Http\Request;

class AgroEduwisataController extends Controller
{
    public function index()
    {
        // Ambil semua data dari tabel potensipangan untuk agro eduwisata
        $eduwisatas = PotensiPangan::all();

        return view('agro-eduwisata', compact('eduwisatas'));
    }
}
