{{-- resources/views/home.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50 text-gray-800">

    <section class="p-8 text-center bg-white">
        <h2 class="text-4xl font-bold mb-4">SIPandu</h2>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">Informasi sebaran komoditas pangan, potensi pangan, dan pemasaran produk dalam satu platform.</p>
    </section>

    <section class="py-12 grid grid-cols-1 md:grid-cols-3 gap-6 px-6">
        <a href="/peta-pangan" class="group bg-white shadow p-6 rounded-xl hover:shadow-2xl transition transform hover:-translate-y-2 block text-center duration-300">
            <div class="w-20 h-20 mx-auto mb-4 flex items-center justify-center bg-green-100 rounded-full group-hover:scale-110 transition duration-300">
                <img src="/icons/map.png" class="w-10 h-10" alt="map icon">
            </div>
            <h3 class="text-xl font-semibold mb-2 text-green-700">Sebaran Maps</h3>
            <p class="text-gray-600">Lihat peta interaktif komoditas pangan di daerah Anda.</p>
        </a>

        <a href="/peta-pangan" class="group bg-white shadow p-6 rounded-xl hover:shadow-2xl transition transform hover:-translate-y-2 block text-center duration-300">
            <div class="w-20 h-20 mx-auto mb-4 flex items-center justify-center bg-green-100 rounded-full group-hover:scale-110 transition duration-300">
                <img src="/icons/leaf.png" class="w-10 h-10" alt="pangan icon">
            </div>
            <h3 class="text-xl font-semibold mb-2 text-green-700">Potensi Pangan</h3>
            <p class="text-gray-600">Temukan potensi hasil pertanian berdasarkan kategori.</p>
        </a>

        <a href="/market" class="group bg-white shadow p-6 rounded-xl hover:shadow-2xl transition transform hover:-translate-y-2 block text-center duration-300">
            <div class="w-20 h-20 mx-auto mb-4 flex items-center justify-center bg-green-100 rounded-full group-hover:scale-110 transition duration-300">
                <img src="/icons/market.png" class="w-10 h-10" alt="market icon">
            </div>
            <h3 class="text-xl font-semibold mb-2 text-green-700">Market</h3>
            <p class="text-gray-600">Belanja produk pangan segar dari petani lokal.</p>
        </a>
    </section>

    <section class="p-6 bg-gray-100">
        <h2 class="text-2xl font-bold mb-6 text-center">Produk Terbaru</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @if(isset($recentProducts))
            @foreach($recentProducts as $item)
            <div class="bg-white shadow rounded-lg p-4">
                <img src="{{ Storage::url($item->gambar) }}" class="w-full h-40 object-cover rounded-lg mb-3">
                <h3 class="font-bold text-lg">{{ $item->produk_pangan }}</h3>
                <p class="text-gray-600 text-sm">{{ Str::limit($item->deskripsi, 80) }}</p>
                <p class="text-blue-600 font-semibold mt-2">Rp {{ number_format($item->harga) }}</p>
                <a href="https://wa.me/{{ $item->nomor_hp }}" class="block mt-3 bg-green-500 text-white text-center py-2 rounded-lg">Hubungi Penjual</a>
            </div>
            @endforeach
            @endif
        </div>
    </section>
</body>

</html>