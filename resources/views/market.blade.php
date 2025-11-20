@extends('layouts.apps')

@section('title', 'Market Pangan')

@section('content')
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Market Pangan</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Temukan produk pangan segar langsung dari petani dan produsen lokal.
            </p>
        </div>

        <!-- Filter Section (dikosongkan karena belum ada data kategori & lokasi) -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
            <div class="flex flex-wrap gap-4 items-center">
                <span class="font-semibold text-gray-700">Filter:</span>

                <select class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none">
                    <option value="">Semua Kategori</option>
                </select>

                <div class="flex-1 min-w-[200px]">
                    <form method="GET" action="">
                        <input
                            type="text"
                            name="search"
                            placeholder="Cari produk..."
                            value="{{ request('search') }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                    </form>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($products as $product)
            <div class="bg-white rounded-xl shadow-sm overflow-hidden card-hover">
                <div class="h-48 bg-green-100 flex items-center justify-center overflow-hidden">
                    @if($product->gambar)
                    <img src="{{ asset('storage/' . $product->gambar) }}"
                        alt="{{ $product->nama }}"
                        class="w-full h-full object-cover">
                    @else
                    <i class="fas fa-carrot text-5xl text-green-600"></i>
                    @endif
                </div>

                <div class="p-6">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-xl font-semibold text-gray-800">{{ $product->nama }}</h3>
                        <span class="tag tag-{{ $product->kategori }}">
                            {{ ucfirst($product->kategori) }}
                        </span>
                    </div>

                    <p class="text-gray-600 mb-4">{{ $product->deskripsi }}</p>

                    <div class="mb-4">
                        <div class="flex items-center text-sm text-gray-500 mb-1">
                            <i class="fas fa-user mr-2"></i>
                            <span>{{ $product->penjual }}</span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-2xl font-bold text-green-600">
                            Rp {{ number_format($product->harga, 0, ',', '.') }}
                        </span>

                        <a href="https://wa.me/{{ $product->whatsapp }}?text=Halo,%20saya%20tertarik%20dengan%20produk%20{{ $product->nama }}%20sebesar%20Rp%20{{ number_format($product->harga, 0, ',', '.') }}"
                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition flex items-center"
                            target="_blank">
                            <i class="fab fa-whatsapp mr-2"></i> Beli
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $products->links() }}
        </div>
    </div>
</section>
@endsection