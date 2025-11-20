<?php

namespace App\Http\Controllers;

use App\Models\Market;
use Illuminate\Http\Request;

class MarketController extends Controller
{
    public function index(Request $request)
    {
        $query = Market::query();

        // Filter berdasarkan pencarian
        if ($request->has('search') && $request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('produk_pangan', 'like', '%' . $request->search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
            });
        }

        $products = $query->latest()->paginate(12);

        return view('market', compact('products'));
    }
}
