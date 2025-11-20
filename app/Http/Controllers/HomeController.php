<?php

namespace App\Http\Controllers;

use App\Models\Market;
use App\Models\PotensiPangan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil 6 produk terbaru dari tabel market
        $recentProducts = Market::latest()->take(6)->get();

        return view('home', compact('recentProducts'));
    }
}
