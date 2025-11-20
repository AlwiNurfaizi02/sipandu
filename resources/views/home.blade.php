{{-- resources/views/home.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPandu</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('SIPANDU.png') }}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-dNrY9J1YvxPi94bTyPjdvVSjGInxjeRGna43EIBgzHuLlHotE5T7V6czS4QhIwTZPIYOuToNiQvkfqtY7Xr4Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body class="bg-gray-50 text-gray-800">

    {{-- Header + Hero --}}
    <header class="bg-white shadow-md">
        <div class="max-w-6xl mx-auto flex items-center justify-between p-4">
            <div class="flex items-center space-x-3">
                <img src="/SIPANDU.png" alt="Logo" class="w-12 h-12 rounded-full shadow">
                <h1 class="text-2xl font-bold text-green-700">SIPandu</h1>
            </div>
        </div>
    </header>

    <section class="p-10 text-center bg-gradient-to-br from-green-100 to-green-300">
        <h2 class="text-4xl font-extrabold text-green-900 mb-4 drop-shadow">
            Sistem Informasi Pangan Terpadu
        </h2>
        <p class="text-lg text-green-800 max-w-2xl mx-auto">
            Informasi sebaran komoditas pangan, potensi pangan, dan pemasaran produk dalam satu platform.
        </p>
    </section>

    {{-- Menu Utama --}}
    <section class="py-14 max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 px-6">

        {{-- PETA PANGAN --}}
        <a href="/peta-pangan"
            class="group bg-white shadow-md p-6 rounded-2xl hover:shadow-2xl transition transform hover:-translate-y-2 block text-center duration-300">
            <div class="w-20 h-20 mx-auto mb-4 flex items-center justify-center bg-green-200 rounded-full group-hover:scale-110 transition duration-300">
                <img src="/icons/map.png" class="w-10 h-10" alt="pangan icon">
            </div>
            <h3 class="text-xl font-semibold mb-2 text-green-700">Sebaran Maps</h3>
            <p class="text-gray-600">Lihat peta interaktif komoditas pangan di daerah Anda.</p>
        </a>


        {{-- POTENSI PANGAN --}}
        <a href="/agro-eduwisata"
            class="group bg-white shadow-md p-6 rounded-2xl hover:shadow-2xl transition transform hover:-translate-y-2 block text-center duration-300">
            <div class="w-20 h-20 mx-auto mb-4 flex items-center justify-center bg-green-200 rounded-full group-hover:scale-110 transition duration-300">
                <img src="/icons/leaf.png" class="w-10 h-10" alt="pangan icon">
            </div>
            <h3 class="text-xl font-semibold mb-2 text-green-700">Potensi Pangan</h3>
            <p class="text-gray-600">Temukan potensi hasil pertanian berdasarkan kategori.</p>
        </a>

        {{-- MARKET --}}
        <a href="/market"
            class="group bg-white shadow-md p-6 rounded-2xl hover:shadow-2xl transition transform hover:-translate-y-2 block text-center duration-300">
            <div class="w-20 h-20 mx-auto mb-4 flex items-center justify-center bg-green-200 rounded-full group-hover:scale-110 transition duration-300">
                <img src="/icons/market.png" class="w-10 h-10" alt="market icon">
            </div>
            <h3 class="text-xl font-semibold mb-2 text-green-700">Market</h3>
            <p class="text-gray-600">Belanja produk pangan segar dari petani lokal.</p>
        </a>
    </section>

    {{-- Produk Terbaru --}}
    <section class="p-10 bg-green-50">
        <h2 class="text-3xl font-bold mb-8 text-center text-green-800">Produk Terbaru</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            @if(isset($recentProducts))
            @foreach($recentProducts as $item)
            <div class="bg-white shadow-md rounded-2xl p-4 hover:shadow-xl transition duration-300">
                <img src="{{ Storage::url($item->gambar) }}"
                    class="w-full h-48 object-cover rounded-xl mb-4">
                <h3 class="font-bold text-lg text-green-700">{{ $item->produk_pangan }}</h3>
                <p class="text-gray-600 text-sm mt-1">{{ Str::limit($item->deskripsi, 80) }}</p>
                <p class="text-green-700 font-bold mt-3 text-lg">
                    Rp {{ number_format($item->harga) }}
                </p>
                <a href="https://wa.me/{{ $item->nomor_hp }}"
                    class="block mt-4 bg-green-600 hover:bg-green-700 text-white text-center py-2 rounded-lg transition">
                    Hubungi Penjual
                </a>
            </div>
            @endforeach
            @endif
        </div>
    </section>

</body>

</html>