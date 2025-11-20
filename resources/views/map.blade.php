<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peta Sebaran Potensi Pangan</title>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        #map {
            height: 100vh;
            width: 100%;
        }

        .popup-image {
            max-width: 200px;
            max-height: 150px;
            object-fit: cover;
            border-radius: 8px;
            margin: 10px 0;
        }

        .popup-title {
            font-weight: bold;
            font-size: 1.2em;
            color: #2c3e50;
        }

        .popup-category {
            background: #3498db;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.9em;
            display: inline-block;
            margin: 5px 0;
        }

        .popup-video {
            margin-top: 10px;
        }

        .popup-video a {
            color: #e74c3c;
            text-decoration: none;
            font-weight: 500;
        }
    </style>
</head>

<body>
    <div id="map"></div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // Inisialisasi peta
        const map = L.map('map').setView([-2.5, 118], 5); // Pusat Indonesia

        // Tile Layer (OpenStreetMap)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Data dari Laravel
        // const data = @json($data); ERROR CUK

        // Tambahkan marker
        data.forEach(item => {
            if (item.latitude && item.longitude) {
                const marker = L.marker([item.latitude, item.longitude]).addTo(map);

                // Buat konten popup
                let popupContent = `
                    <div class="popup-title">${item.judul || 'Tanpa Judul'}</div>
                    <div class="popup-category">${item.kategori || 'Uncategorized'}</div>
                `;

                if (item.gambar) {
                    const imageUrl = `/storage/${item.gambar}`;
                    popupContent += `<img src="${imageUrl}" alt="${item.judul}" class="popup-image">`;
                }

                if (item.deskripsi) {
                    popupContent += `<p><small>${item.deskripsi.substring(0, 150)}${item.deskripsi.length > 150 ? '...' : ''}</small></p>`;
                }

                if (item.link_video) {
                    popupContent += `
                        <div class="popup-video">
                            <a href="${item.link_video}" target="_blank">📹 Lihat Video</a>
                        </div>
                    `;
                }

                marker.bindPopup(popupContent, {
                    maxWidth: 300
                });
            }
        });

        // Auto zoom ke semua marker jika ada
        if (data.length > 0) {
            const bounds = L.latLngBounds(data.map(item => [item.latitude, item.longitude]));
            map.fitBounds(bounds, {
                padding: [50, 50]
            });
        }
    </script>
</body>

</html>