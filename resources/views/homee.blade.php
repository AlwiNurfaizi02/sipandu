<!-- Recent Products -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Produk Terbaru</h2>
            <p class="text-gray-600">Lihat beberapa produk terbaru dari petani lokal</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($recentProducts as $product)
            <div class="bg-white rounded-xl shadow-sm overflow-hidden card-hover">
                <div class="h-48 bg-green-100 flex items-center justify-center overflow-hidden">
                    @if($product->gambar)
                    <img src="{{ asset('storage/' . $product->gambar) }}"
                        alt="{{ $product->produk_pangan }}"
                        class="w-full h-full object-cover">
                    @else
                    <i class="fas fa-shopping-basket text-5xl text-green-600"></i>
                    @endif
                </div>

                <div class="p-6">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-xl font-semibold text-gray-800">{{ $product->produk_pangan }}</h3>

                        @if($product->kategori)
                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm">
                            {{ ucfirst($product->kategori) }}
                        </span>
                        @endif
                    </div>

                    <p class="text-gray-600 mb-4">
                        {{ Str::limit($product->deskripsi, 100) }}
                    </p>

                    <div class="flex justify-between items-center">
                        <span class="text-2xl font-bold text-green-600">
                            Rp {{ number_format($product->harga, 0, ',', '.') }}
                        </span>

                        <a href="https://wa.me/{{ $product->nomor_hp ?? $product->wa }}?text=Halo,%20saya%20tertarik%20dengan%20produk%20{{ $product->produk_pangan }}"
                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition flex items-center"
                            target=\"_blank\">
                            <i class=\"fab fa-whatsapp mr-2\"></i>
                            Hubungi
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('market') }}" class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                Lihat Semua Produk
            </a>
        </div>
    </div>
</section>