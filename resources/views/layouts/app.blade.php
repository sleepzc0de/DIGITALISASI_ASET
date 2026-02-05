<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>📊</text></svg>">

    <title>{{ config('app.name', 'Laravel') }} - Digitalisasi Aset</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    @stack('styles')
</head>
<body class="font-sans antialiased bg-gradient-to-br from-gray-50 to-blue-50 min-h-screen">
    <!-- Loading Spinner -->
    <div id="loading-spinner" class="fixed inset-0 bg-white/80 backdrop-blur-sm z-50 flex items-center justify-center transition-opacity duration-300">
        <div class="relative">
            <div class="w-20 h-20 border-4 border-blue-200 rounded-full"></div>
            <div class="w-20 h-20 border-4 border-blue-600 border-t-transparent rounded-full absolute top-0 left-0 animate-spin"></div>
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="w-8 h-8 bg-blue-600 rounded-full animate-pulse"></div>
            </div>
        </div>
    </div>

    <div class="min-h-screen flex flex-col">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-gradient-to-r from-white to-blue-50 shadow-lg shadow-blue-100/50">
                <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-sm font-bold text-gray-900">{{ $header }}</h1>
                            @if (isset($subheader))
                                <p class="mt-2 text-gray-600">{{ $subheader }}</p>
                            @endif
                        </div>
                        @if (isset($headerActions))
                            <div class="flex items-center space-x-">
                                {{ $headerActions }}
                            </div>
                        @endif
                    </div>
                </div>
            </header>
        @endif

        <!-- Success/Error Messages -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
            @if (session('success'))
                <div class="mb-6 animate-fade-in-down">
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 rounded-xl shadow-sm p-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                    <i class="fas fa-check-circle text-green-600 text-lg"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                            </div>
                            <div class="ml-auto">
                                <button onclick="this.parentElement.parentElement.remove()" class="text-green-500 hover:text-green-700">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 animate-fade-in-down">
                    <div class="bg-gradient-to-r from-red-50 to-rose-50 border-l-4 border-red-500 rounded-xl shadow-sm p-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center">
                                    <i class="fas fa-exclamation-circle text-red-600 text-lg"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                            </div>
                            <div class="ml-auto">
                                <button onclick="this.parentElement.parentElement.remove()" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Page Content -->
        <main class="flex-grow py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-gradient-to-r from-gray-900 to-blue-900 text-white mt-12">
            <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <div class="flex items-center space-x-2 mb-4">
                            {{-- <div class="h-10 w-10 rounded-lg bg-blue-600 flex items-center justify-center">
                                <i class="fas fa-chart-bar text-white"></i>
                            </div> --}}
                            <span class="text-xl font-bold">Sistem Digitalisasi Aset</span>
                        </div>
                        <p class="text-gray-300 text-sm">
                            Digitalisasi Aset Kementerian Keuangan Republik Indonesia.
                        </p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Navigasi Cepat</h3>
                        <ul class="space-y-2">
                            <li><a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white transition-colors"><i class="fas fa-chevron-right text-xs mr-2"></i> Dashboard Aset</a></li>
                            <li><a href="{{ route('kinerja') }}" class="text-gray-300 hover:text-white transition-colors"><i class="fas fa-chevron-right text-xs mr-2"></i> Kinerja BMN</a></li>
                            @if(auth()->check())
                            <li><a href="{{ route('profile.edit') }}" class="text-gray-300 hover:text-white transition-colors"><i class="fas fa-chevron-right text-xs mr-2"></i> Profil</a></li>
                            @endif
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                        <div class="space-y-3">
                            <div class="flex items-center text-gray-300">
                                <i class="fas fa-envelope mr-3"></i>
                                <span>kemenkeu.prime@kemenkeu.go.id</span>
                            </div>
                            <div class="flex items-center text-gray-300">
                                <i class="fas fa-phone mr-3"></i>
                                <span>0813-1000-4134</span>
                            </div>
                            <div class="flex items-center space-x-4 mt-4">
                                <a href="https://www.facebook.com/pastikanasetkita" class="h-8 w-8 rounded-full bg-blue-700 flex items-center justify-center hover:bg-blue-600 transition-colors">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="https://www.instagram.com/pastikanasetkita/" class="h-8 w-8 rounded-full bg-pink-600 flex items-center justify-center hover:bg-pink-500 transition-colors">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-t border-gray-800 mt-8 pt-6 text-center text-gray-400 text-sm">
                    <p>&copy; {{ date('Y') }} Digitalisasi Aset. Hak cipta dilindungi.</p>
                    <p class="mt-1">Powered By Biro Manajemen BMN dan Pengadaan</p>
                </div>
            </div>
        </footer>
    </div>

    <!-- Back to Top Button -->
    <button id="backToTop" class="fixed bottom-6 right-6 h-12 w-12 bg-blue-600 text-white rounded-full shadow-lg hover:bg-blue-700 hover:shadow-xl transition-all duration-300 transform hover:scale-110 hidden z-40">
        <i class="fas fa-chevron-up"></i>
    </button>

    <script>
        // Loading Spinner
        window.addEventListener('load', function() {
            const spinner = document.getElementById('loading-spinner');
            spinner.style.opacity = '0';
            setTimeout(() => spinner.style.display = 'none', 300);
        });

        // Back to Top Button
        const backToTop = document.getElementById('backToTop');
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTop.classList.remove('hidden');
            } else {
                backToTop.classList.add('hidden');
            }
        });

        backToTop.addEventListener('click', function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });
    </script>

    @stack('scripts')
</body>
</html>
