<!-- resources/views/peta-sebaran.blade.php -->
@extends('layouts.apps')

@section('title', 'Peta Sebaran')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peta Sebaran Pangan</title>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        #map {
            height: 600px;
            width: 100%;
            border-radius: 20px;
        }

        .popup-img {
            width: 150px;
            height: 100px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 8px;
        }
    </style>
</head>

<body class="bg-gray-100 p-6">

    <h1 class="text-3xl font-bold text-green-700 mb-4 text-center">Peta Sebaran Produk Pangan</h1>

    <div id="map"></div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        // Inisialisasi peta
        var map = L.map('map').setView([-7.3518, 108.2270], 10); // pusat Indonesia

        // OpenStreetMap Layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap'
        }).addTo(map);

        // Data dari Laravel
        let potensi = JSON.parse('{!! addslashes(json_encode($potensiPangan)) !!}');

        // Loop marker
        potensi.forEach(function(item) {
            if (item.latitude && item.longitude) {
                var popupContent = `
                    <div>
                        <img src="/storage/${item.gambar}" class="popup-img" alt="gambar">
                        <h3><strong>${item.judul}</strong></h3>
                        <p>${item.deskripsi}</p>
                        <p><strong>Kategori:</strong> ${item.kategori}</p>
                    </div>
                `;

                L.marker([item.latitude, item.longitude]).addTo(map)
                    .bindPopup(popupContent);
            }
        });
    </script>
</body>

</html>
@endsection