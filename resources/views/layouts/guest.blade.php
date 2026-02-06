<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('Login') }} - {{ config('app.name', 'Digitalisasi Aset') }}</title>

    <!-- Preconnect untuk resource pihak ketiga -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://unpkg.com">

    <!-- Fonts dengan display=swap untuk menghindari FOIT -->
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Font Awesome - gunakan defer -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        media="print" onload="this.media='all'">

    <link rel="icon" type="image/png" href="{{ asset('logo_kemenkeu.png') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Inline Critical CSS -->
    <style>
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .animate-float-delayed {
            animation: float 8s ease-in-out infinite;
            animation-delay: 1s;
        }

        .bg-grid-pattern {
            background-image:
                radial-gradient(circle at 25px 25px, rgba(255, 255, 255, 0.1) 2%, transparent 0%),
                radial-gradient(circle at 75px 75px, rgba(255, 255, 255, 0.1) 2%, transparent 0%);
            background-size: 100px 100px;
        }

        #loading-spinner {
            position: fixed;
            inset: 0;
            background: rgba(17, 24, 39, 0.8);
            backdrop-filter: blur(4px);
            z-index: 50;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 300ms;
        }
    </style>

    <!-- AOS CSS - lazy load -->
    <link rel="preload" href="https://unpkg.com/aos@2.3.1/dist/aos.css" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    </noscript>
</head>

<body class="font-sans antialiased min-h-screen bg-gradient-to-br from-gray-900 via-blue-900 to-purple-900">
    <!-- Animated Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div
            class="absolute top-1/4 left-1/4 w-72 h-72 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-float">
        </div>
        <div
            class="absolute bottom-1/4 right-1/4 w-72 h-72 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-float-delayed">
        </div>
        <div
            class="absolute top-1/3 right-1/3 w-64 h-64 bg-pink-500 rounded-full mix-blend-multiply filter blur-3xl opacity-10">
        </div>
        <div class="bg-grid-pattern absolute inset-0"></div>
    </div>

    <!-- Loading Spinner -->
    <div id="loading-spinner">
        <div class="text-center">
            <div class="relative inline-block">
                <div class="w-24 h-24 border-4 border-blue-200 rounded-full"></div>
                <div
                    class="w-24 h-24 border-4 border-blue-500 border-t-transparent rounded-full absolute top-0 left-0 animate-spin">
                </div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-500 rounded-full animate-pulse">
                    </div>
                </div>
            </div>
            <p class="mt-4 text-white font-medium">Loading...</p>
        </div>
    </div>

    <main class="min-h-screen flex flex-col lg:flex-row">
        <!-- Left Side - Branding & Illustration -->
        <div class="lg:w-1/2 flex flex-col justify-between p-8 lg:p-12 relative overflow-hidden">
            <!-- Decorative Elements -->
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 to-purple-500"></div>
            <div class="absolute top-20 right-10 w-40 h-40 rounded-full bg-blue-500/10 backdrop-blur-sm"></div>
            <div class="absolute bottom-20 left-10 w-60 h-60 rounded-full bg-purple-500/10 backdrop-blur-sm"></div>

            <div class="relative z-10">
                <!-- Logo -->
                <div class="mb-8 lg:mb-12">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center space-x-3 group">
                        <div
                            class="h-14 w-14 rounded-2xl bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center shadow-lg shadow-blue-500/30 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-chart-bar text-white text-2xl"></i>
                        </div>
                        <div>
                            <span
                                class="text-3xl font-bold bg-gradient-to-r from-white to-blue-100 bg-clip-text text-transparent">
                                Digitalisasi Aset
                            </span>
                            <p class="text-blue-200/80 text-sm mt-1">Kementerian Keuangan RI</p>
                        </div>
                    </a>
                </div>

                <!-- Hero Content -->
                <div class="max-w-lg" data-aos="fade-right" data-aos-delay="200">
                    <h1 class="text-4xl lg:text-5xl font-bold text-white mb-6 leading-tight">
                        Sistem
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400">
                            Digitalisasi Aset (SIDITA)
                        </span>
                    </h1>
                    <p class="text-lg text-blue-100/80 mb-8 leading-relaxed" style="text-align: justify;">
                        Menyediakan berbagai informasi untuk memantau data aset dan pengadaan melalui dashboard Beranda,
                        serta memfasilitasi siklus proses pengelolaan Barang Milik Negara (BMN) dan Pengadaan.
                    </p>

                    <!-- Features List -->
                    <div class="space-y-4 mb-10">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-lg bg-blue-500/20 flex items-center justify-center">
                                <i class="fas fa-check text-blue-400"></i>
                            </div>
                            <span class="text-blue-100">Dashboard Aset Real-time</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-lg bg-purple-500/20 flex items-center justify-center">
                                <i class="fas fa-check text-purple-400"></i>
                            </div>
                            <span class="text-blue-100">Analisis Kinerja BMN</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-lg bg-green-500/20 flex items-center justify-center">
                                <i class="fas fa-check text-green-400"></i>
                            </div>
                            <span class="text-blue-100">Manajemen Aplikasi Terpusat</span>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <!-- Right Side - Login Form -->
        <div class="lg:w-1/2 flex items-center justify-center p-8 lg:p-12">
            <div class="w-full max-w-md" data-aos="fade-left" data-aos-delay="300">
                <div class="bg-white/10 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 p-8 lg:p-10">
                    <!-- Form Header -->
                    <div class="text-center mb-8">
                        <div
                            class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-white/20 to-white/10 mb-4">
                            <i class="fas fa-user-shield text-2xl text-white"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-white">Masuk ke Akun Anda</h2>
                        <p class="text-blue-100/80 mt-2">Masukkan kredensial untuk mengakses sistem</p>
                    </div>

                    {{ $slot }}

                    <!-- Footer Links -->
                    <div class="text-center space-y-3 mt-6">
                        <div class="text-xs text-blue-100/60">
                            © {{ date('Y') }} Digitalisasi Aset. Hak cipta dilindungi.
                            <p>Powered By Biro Manajemen BMN dan Pengadaan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Scripts diletakkan di akhir untuk performa optimal -->
    <script>
        // Loading Spinner - optimized
        (function() {
            const spinner = document.getElementById('loading-spinner');

            if (document.readyState === 'complete') {
                hideSpinner();
            } else {
                window.addEventListener('load', hideSpinner);
            }

            function hideSpinner() {
                spinner.style.opacity = '0';
                setTimeout(() => {
                    spinner.style.display = 'none';
                    spinner.remove(); // Hapus dari DOM
                }, 300);
            }
        })();
    </script>

    <!-- AOS Script - lazy load -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js" defer onload="AOS.init({duration: 800, once: true, offset: 50})">
    </script>
</body>

</html>
