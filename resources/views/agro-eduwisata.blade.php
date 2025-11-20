@extends('layouts.apps')

@php
use Illuminate\Support\Str;
@endphp

@section('title', 'Agro Eduwisata')

@section('content')
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Agro Eduwisata</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Jelajahi pengalaman edukasi pertanian dan peternakan langsung dari potensi pangan masyarakat.
            </p>
        </div>

        {{-- Jika tabel kosong --}}
        @if($eduwisatas->isEmpty())
        <p class="text-center text-gray-500 mb-12">Belum ada data agro eduwisata.</p>
        @endif

        @foreach($eduwisatas as $eduwisata)

        @php
        // Fallback keunggulan
        $keunggulanList = $eduwisata->keunggulan;

        if (is_string($keunggulanList)) {
        $decode = json_decode($keunggulanList, true);
        $keunggulanList = $decode ?: [];
        }

        if (!is_array($keunggulanList)) {
        $keunggulanList = [];
        }

        // Fasilitas
        $fasilitasList = $eduwisata->fasilitas;

        if (is_string($fasilitasList)) {
        $decode = json_decode($fasilitasList, true);
        $fasilitasList = $decode ?: [];
        }

        if (!is_array($fasilitasList)) {
        $fasilitasList = [];
        }
        @endphp

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">

            {{-- GAMBAR SAJA --}}
            <div>
                @php
                $img = $eduwisata->gambar;

                // Jika gambar adalah link Google Drive, ubah menjadi direct link
                if ($img && Str::contains($img, 'drive.google.com')) {
                preg_match('/\/d\/(.*?)\//', $img, $match);
                $img = isset($match[1])
                ? 'https://drive.google.com/uc?export=view&id=' . $match[1]
                : $img;
                } else {
                // Jika gambar tersimpan di storage Laravel
                $img = $img ? Storage::url($img) : null;
                }
                @endphp

                @if($img)
                <div class="bg-gray-100 rounded-xl overflow-hidden h-80">
                    <img src="{{ $img }}" class="w-full h-full object-cover" alt="Gambar Eduwisata">
                </div>
                @else
                <div class="bg-gray-100 rounded-xl h-80 flex items-center justify-center">
                    <p class="text-gray-500">Tidak ada gambar.</p>
                </div>
                @endif
            </div>


            {{-- DESKRIPSI --}}
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ $eduwisata->judul ?? 'Tanpa Judul' }}</h2>

                <p class="text-gray-700 mb-6">{{ $eduwisata->deskripsi ?? 'Tidak ada deskripsi.' }}</p>

                <!-- {{-- KEUNGGULAN --}}
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Keunggulan:</h3>

                    @forelse($keunggulanList as $k)
                    <div class="flex items-start mb-2">
                        <i class="fas fa-check text-green-500 mr-2"></i>
                        <span class="text-gray-700">{{ $k }}</span>
                    </div>
                    @empty
                    <p class="text-gray-500 text-sm">Tidak ada data keunggulan.</p>
                    @endforelse
                </div>

                {{-- FASILITAS --}}
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Fasilitas:</h3>

                    <div class="flex flex-wrap gap-2">
                        @forelse($fasilitasList as $f)
                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-800 text-sm">
                            {{ $f }}
                        </span>
                        @empty
                        <p class="text-gray-500 text-sm">Tidak ada fasilitas tersedia.</p>
                        @endforelse
                    </div>
                </div> -->

                {{-- LOKASI --}}
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Lokasi:</h3>

                    <p class="text-gray-700">
                        <i class="fas fa-map-marker-alt text-green-500 mr-2"></i>
                        {{ $eduwisata->alamat ?? $eduwisata->lokasi ?? 'Lokasi tidak tersedia' }}
                    </p>
                </div>

                {{-- JURNAL --}}
                @if($eduwisata->jurnal)
                <a href="{{ Str::startsWith($eduwisata->jurnal, 'http') ? $eduwisata->jurnal : asset('storage/' . $eduwisata->jurnal) }}"
                    target="_blank"
                    class="text-green-600 hover:text-green-700 flex items-center">
                    <i class="fas fa-file-pdf mr-2"></i> Lihat Dokumentasi
                </a>
                @endif

                {{-- VIDEO --}}
                @if($eduwisata->link_video)
                <a href="{{ Str::startsWith($eduwisata->link_video, ['http', 'https']) 
                ? $eduwisata->link_video 
                : asset('storage/' . $eduwisata->link_video) }}"
                    target="_blank"
                    class="text-green-600 hover:text-green-700 flex items-center">
                    <i class="fas fa-play-circle mr-2"></i> Lihat Video
                </a>
                @endif


                {{-- BUTTON --}}
                <div class="flex space-x-4">
                    @if($eduwisata->pendaftaran_url)
                    <a href="{{ $eduwisata->pendaftaran_url }}" class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        Kunjungi Lokasi
                    </a>
                    @endif

                    <a href="{{ url('/peta-pangan') }}"
                        class="px-6 py-3 border border-green-600 text-green-600 rounded-lg hover:bg-green-50">
                        <i class="fas fa-map-marker-alt mr-2"></i> Lihat Peta
                    </a>
                </div>

            </div>

        </div>

        @endforeach
    </div>
</section>
@endsection