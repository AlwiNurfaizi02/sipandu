<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - AgroPangan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('SIPANDU.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .hero-bg {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }

        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .tag {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-right: 8px;
            margin-bottom: 8px;
        }

        .tag-karbo {
            background-color: #ffedd5;
            color: #9a3412;
        }

        .tag-ternak {
            background-color: #dcfce7;
            color: #166534;
        }

        .tag-sayur {
            background-color: #dbeafe;
            color: #1e40af;
        }

        .tag-buah {
            background-color: #fae8ff;
            color: #86198f;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-10">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-green-700">SI<span class="text-green-500">Pandu</span></a>
            </div>
            <nav class="hidden md:flex space-x-8">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-green-600 font-medium {{ request()->routeIs('home') ? 'text-green-600' : '' }}">Home</a>
                <a href="{{ route('peta-pangan') }}" class="text-gray-700 hover:text-green-600 font-medium {{ request()->routeIs('peta-pangan') ? 'text-green-600' : '' }}">Peta Pangan</a>
                <a href="{{ route('market') }}" class="text-gray-700 hover:text-green-600 font-medium {{ request()->routeIs('market') ? 'text-green-600' : '' }}">Market</a>
                <a href="{{ route('agro-eduwisata') }}" class="text-gray-700 hover:text-green-600 font-medium {{ request()->routeIs('agro-eduwisata') ? 'text-green-600' : '' }}">Agro Eduwisata</a>
            </nav>
            <!-- <div class="flex items-center space-x-4">
                <button class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">Login</button>
                <button class="md:hidden text-gray-700" id="mobile-menu-button">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div> -->
        </div>

        <!-- Mobile Menu -->
        <div class="md:hidden hidden bg-white py-4 px-4" id="mobile-menu">
            <a href="{{ route('home') }}" class="block py-2 text-gray-700 hover:text-green-600 {{ request()->routeIs('home') ? 'text-green-600' : '' }}">Home</a>
            <a href="{{ route('peta-pangan') }}" class="block py-2 text-gray-700 hover:text-green-600 {{ request()->routeIs('peta-pangan') ? 'text-green-600' : '' }}">Peta Pangan</a>
            <a href="{{ route('market') }}" class="block py-2 text-gray-700 hover:text-green-600 {{ request()->routeIs('market') ? 'text-green-600' : '' }}">Market</a>
            <a href="{{ route('agro-eduwisata') }}" class="block py-2 text-gray-700 hover:text-green-600 {{ request()->routeIs('agro-eduwisata') ? 'text-green-600' : '' }}">Agro Eduwisata</a>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">AgroPangan</h3>
                    <p class="text-gray-400">Platform terintegrasi untuk produk pangan, informasi sebaran, dan agro eduwisata.</p>
                </div>

                <div>
                    <h4 class="font-semibold mb-4">Menu</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition">Home</a></li>
                        <li><a href="{{ route('peta-pangan') }}" class="text-gray-400 hover:text-white transition">Peta Pangan</a></li>
                        <li><a href="{{ route('market') }}" class="text-gray-400 hover:text-white transition">Market</a></li>
                        <li><a href="{{ route('agro-eduwisata') }}" class="text-gray-400 hover:text-white transition">Agro Eduwisata</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-semibold mb-4">Kontak</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-center">
                            <i class="fas fa-phone mr-2"></i>
                            <span>+62 812 3456 7890</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-2"></i>
                            <span>info@agropangan.id</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            <span>Bandung, Indonesia</span>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-semibold mb-4">Ikuti Kami</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-facebook text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-youtube text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2023 AgroPangan. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>

    @yield('scripts')
</body>

</html>