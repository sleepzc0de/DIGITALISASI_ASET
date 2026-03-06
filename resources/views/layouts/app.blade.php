<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Sistem Digitalisasi Aset Kementerian Keuangan Republik Indonesia">
    <meta name="robots" content="noindex, nofollow">

    <link rel="icon" type="image/png" href="{{ asset('logo_kemenkeu.png') }}">

    <title>
        @isset($title)
            {{ $title }} | {{ config('app.name', 'Sistem Informasi Digitalisasi Aset') }}
        @else
            {{ config('app.name', 'Sistem Informasi Digitalisasi Aset') }}
        @endisset
    </title>

    {{--
        CRITICAL: x-cloak CSS harus ada di <head> SEBELUM Alpine load
        agar tidak ada flash of unstyled content (FOUC) pada elemen x-show
    --}}
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    {{-- Font --}}
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet">

    {{--
        Font Awesome & AOS: load async agar tidak memblokir render.
        Pattern: preload + onload swap rel ke stylesheet.
        <noscript> fallback untuk browser tanpa JS.
    --}}
    <link rel="preload" as="style" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    </noscript>

    <link rel="preload" as="style" href="https://unpkg.com/aos@2.3.1/dist/aos.css"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    </noscript>

    {{-- Vite: app.css (Tailwind) + app.js (Alpine, Chart.js, bootstrap) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body class="font-sans antialiased bg-gradient-to-br from-gray-50 to-blue-50 min-h-screen">

    {{-- ── Loading Spinner ───────────────────────────────────────────────────── --}}
    {{--
        Sengaja TIDAK pakai Alpine di sini agar spinner muncul
        sebelum Alpine selesai inisialisasi.
    --}}
    <div id="loading-spinner"
        class="fixed inset-0 bg-white/80 backdrop-blur-sm z-[9999]
                flex items-center justify-center"
        role="status" aria-label="Memuat halaman">
        <div class="relative" aria-hidden="true">
            <div class="w-20 h-20 border-4 border-blue-200 rounded-full"></div>
            <div
                class="w-20 h-20 border-4 border-blue-600 border-t-transparent
                        rounded-full absolute top-0 left-0 animate-spin">
            </div>
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="w-8 h-8 bg-blue-600 rounded-full animate-pulse"></div>
            </div>
        </div>
        <span class="sr-only">Memuat...</span>
    </div>

    <div class="min-h-screen flex flex-col">

        @include('layouts.navigation')

        {{-- ── Page Heading ──────────────────────────────────────────────────── --}}
        @isset($header)
            <header class="bg-gradient-to-r from-white to-blue-50 shadow-lg shadow-blue-100/50">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900 leading-tight">
                                {{ $header }}
                            </h1>
                            @isset($subheader)
                                <p class="mt-1 text-sm text-gray-600">{{ $subheader }}</p>
                            @endisset
                        </div>
                        @isset($headerActions)
                            <div class="flex items-center gap-3 flex-shrink-0">
                                {{ $headerActions }}
                            </div>
                        @endisset
                    </div>
                </div>
            </header>
        @endisset

        {{-- ── Flash Messages ────────────────────────────────────────────────── --}}
        {{--
            Gunakan session()->hasAny() agar blok ini tidak dirender sama sekali
            bila tidak ada flash message — hemat DOM nodes.
        --}}
        @if (session()->hasAny(['success', 'error', 'warning', 'info']))
            <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 mt-5" aria-live="polite" aria-atomic="true">

                @php
                    $flashConfig = [
                        'success' => [
                            'gradient' => 'from-green-50 to-emerald-50',
                            'border' => 'border-green-500',
                            'icon_bg' => 'bg-green-100',
                            'icon_text' => 'text-green-600',
                            'icon' => 'fa-check-circle',
                            'msg_text' => 'text-green-800',
                            'btn_class' => 'text-green-400 hover:text-green-600 hover:bg-green-100',
                        ],
                        'error' => [
                            'gradient' => 'from-red-50 to-rose-50',
                            'border' => 'border-red-500',
                            'icon_bg' => 'bg-red-100',
                            'icon_text' => 'text-red-600',
                            'icon' => 'fa-exclamation-circle',
                            'msg_text' => 'text-red-800',
                            'btn_class' => 'text-red-400 hover:text-red-600 hover:bg-red-100',
                        ],
                        'warning' => [
                            'gradient' => 'from-yellow-50 to-amber-50',
                            'border' => 'border-yellow-500',
                            'icon_bg' => 'bg-yellow-100',
                            'icon_text' => 'text-yellow-600',
                            'icon' => 'fa-exclamation-triangle',
                            'msg_text' => 'text-yellow-800',
                            'btn_class' => 'text-yellow-400 hover:text-yellow-600 hover:bg-yellow-100',
                        ],
                        'info' => [
                            'gradient' => 'from-blue-50 to-sky-50',
                            'border' => 'border-blue-500',
                            'icon_bg' => 'bg-blue-100',
                            'icon_text' => 'text-blue-600',
                            'icon' => 'fa-info-circle',
                            'msg_text' => 'text-blue-800',
                            'btn_class' => 'text-blue-400 hover:text-blue-600 hover:bg-blue-100',
                        ],
                    ];
                @endphp

                @foreach ($flashConfig as $type => $cfg)
                    @if (session($type))
                        <div class="mb-4 animate-fade-in-down" role="alert">
                            <div
                                class="flex items-start gap-3
                                        bg-gradient-to-r {{ $cfg['gradient'] }}
                                        border-l-4 {{ $cfg['border'] }}
                                        rounded-xl shadow-sm p-4">
                                <div
                                    class="flex-shrink-0 h-9 w-9 rounded-full {{ $cfg['icon_bg'] }}
                                            flex items-center justify-center">
                                    <i class="fas {{ $cfg['icon'] }} {{ $cfg['icon_text'] }}" aria-hidden="true"></i>
                                </div>
                                <p class="flex-1 text-sm font-medium {{ $cfg['msg_text'] }} pt-1.5">
                                    {{-- e() untuk XSS protection --}}
                                    {{ e(session($type)) }}
                                </p>
                                <button type="button" onclick="this.closest('[role=alert]').remove()"
                                    class="{{ $cfg['btn_class'] }} transition-colors p-1 rounded-lg flex-shrink-0"
                                    aria-label="Tutup notifikasi">
                                    <i class="fas fa-times text-sm" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    @endif
                @endforeach

            </div>
        @endif

        {{-- ── Page Content ───────────────────────────────────────────────────── --}}
        <main id="main-content" class="flex-grow py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>

        {{-- ── Footer ─────────────────────────────────────────────────────────── --}}
        <footer class="bg-gradient-to-r from-gray-900 to-blue-900 text-white mt-auto">
            <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                    {{-- Brand --}}
                    <div>
                        <div class="flex items-center gap-3 mb-3">
                            <img src="{{ asset('logo_kemenkeu.png') }}" alt="Logo Kementerian Keuangan"
                                class="h-10 w-10 object-contain" loading="lazy" width="40" height="40">
                            <span class="text-lg font-bold leading-tight">
                                Sistem Digitalisasi Aset
                            </span>
                        </div>
                        <p class="text-gray-400 text-sm leading-relaxed">
                            Digitalisasi Aset Kementerian Keuangan Republik Indonesia.
                        </p>
                    </div>

                    {{-- Quick Nav --}}
                    <nav aria-label="Navigasi cepat footer">
                        <h3 class="text-base font-semibold mb-4">Navigasi Cepat</h3>
                        <ul class="space-y-2 text-sm">
                            <li>
                                <a href="{{ route('dashboard') }}"
                                    class="flex items-center gap-2 text-gray-400 hover:text-white
                                          transition-colors group">
                                    <i class="fas fa-chevron-right text-xs text-blue-400
                                              group-hover:translate-x-0.5 transition-transform"
                                        aria-hidden="true"></i>
                                    Dashboard Aset
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('kinerja') }}"
                                    class="flex items-center gap-2 text-gray-400 hover:text-white
                                          transition-colors group">
                                    <i class="fas fa-chevron-right text-xs text-blue-400
                                              group-hover:translate-x-0.5 transition-transform"
                                        aria-hidden="true"></i>
                                    Kinerja BMN
                                </a>
                            </li>
                            @auth
                                <li>
                                    <a href="{{ route('profile.edit') }}"
                                        class="flex items-center gap-2 text-gray-400 hover:text-white
                                              transition-colors group">
                                        <i class="fas fa-chevron-right text-xs text-blue-400
                                                  group-hover:translate-x-0.5 transition-transform"
                                            aria-hidden="true"></i>
                                        Profil
                                    </a>
                                </li>
                            @endauth
                        </ul>
                    </nav>

                    {{-- Contact --}}
                    <div>
                        <h3 class="text-base font-semibold mb-4">Kontak</h3>
                        <address class="not-italic space-y-2 text-sm text-gray-400">
                            <div class="flex items-center gap-3">
                                <i class="fas fa-envelope w-4 text-center flex-shrink-0" aria-hidden="true"></i>
                                <a href="mailto:kemenkeu.prime@kemenkeu.go.id"
                                    class="hover:text-white transition-colors truncate">
                                    kemenkeu.prime@kemenkeu.go.id
                                </a>
                            </div>
                            <div class="flex items-center gap-3">
                                <i class="fas fa-phone w-4 text-center flex-shrink-0" aria-hidden="true"></i>
                                <a href="tel:+6281310004134" class="hover:text-white transition-colors">
                                    0813-1000-4134
                                </a>
                            </div>
                            <div class="flex items-center gap-3 pt-2">
                                <a href="https://www.facebook.com/pastikanasetkita" target="_blank"
                                    rel="noopener noreferrer"
                                    class="h-8 w-8 rounded-full bg-blue-700 flex items-center
                                          justify-center hover:bg-blue-500 transition-colors"
                                    aria-label="Facebook Pastikan Aset Kita">
                                    <i class="fab fa-facebook-f text-sm" aria-hidden="true"></i>
                                </a>
                                <a href="https://www.instagram.com/pastikanasetkita/" target="_blank"
                                    rel="noopener noreferrer"
                                    class="h-8 w-8 rounded-full bg-pink-600 flex items-center
                                          justify-center hover:bg-pink-500 transition-colors"
                                    aria-label="Instagram Pastikan Aset Kita">
                                    <i class="fab fa-instagram text-sm" aria-hidden="true"></i>
                                </a>
                            </div>
                        </address>
                    </div>

                </div>

                <div class="border-t border-white/10 mt-8 pt-6 text-center text-gray-500 text-xs space-y-1">
                    <p>&copy; {{ date('Y') }} Digitalisasi Aset. Hak cipta dilindungi.</p>
                    <p>Powered By Biro Manajemen BMN dan Pengadaan</p>
                </div>
            </div>
        </footer>

    </div>

    {{-- ── Back to Top ─────────────────────────────────────────────────────── --}}
    <button id="backToTop"
        class="fixed bottom-6 right-6 h-12 w-12 bg-blue-600 text-white rounded-full
                   shadow-lg hover:bg-blue-700 hover:shadow-xl hover:scale-110
                   transition-all duration-300 z-40 flex items-center justify-center
                   focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2"
        style="opacity:0; pointer-events:none; will-change:opacity;" aria-label="Kembali ke atas">
        <i class="fas fa-chevron-up" aria-hidden="true"></i>
    </button>

    {{--
        AOS dan jsPDF di-defer agar tidak blokir render.
        Keduanya tidak dibutuhkan saat halaman pertama kali tampil.
    --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js" defer></script>

    <script>
        // ── 1. Loading Spinner ───────────────────────────────────────
        // Gunakan 'load' bukan 'DOMContentLoaded' agar semua aset
        // (termasuk gambar) sudah selesai sebelum spinner hilang.
        window.addEventListener('load', function() {
            var spinner = document.getElementById('loading-spinner');
            if (!spinner) return;
            spinner.style.transition = 'opacity 0.3s ease';
            spinner.style.opacity = '0';
            // Hapus dari DOM setelah transisi selesai agar tidak ada
            // elemen invisible yang menghalangi klik
            setTimeout(function() {
                spinner.remove();
            }, 350);
        });

        // ── 2. Back to Top ───────────────────────────────────────────
        (function() {
            var btn = document.getElementById('backToTop');
            if (!btn) return;

            // passive:true agar scroll listener tidak blokir thread
            window.addEventListener('scroll', function() {
                var show = window.scrollY > 300;
                btn.style.opacity = show ? '1' : '0';
                btn.style.pointerEvents = show ? 'auto' : 'none';
            }, {
                passive: true
            });

            btn.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }());

        // ── 3. Auto-dismiss Flash Messages ──────────────────────────
        document.addEventListener('DOMContentLoaded', function() {
            var alerts = document.querySelectorAll('[role="alert"]');
            if (!alerts.length) return;

            setTimeout(function() {
                alerts.forEach(function(el) {
                    el.style.transition = 'opacity 0.4s ease';
                    el.style.opacity = '0';
                    setTimeout(function() {
                        // Cek masih ada di DOM sebelum remove
                        // (user mungkin sudah manual close)
                        if (el.parentNode) el.remove();
                    }, 450);
                });
            }, 6000);
        });

        // ── 4. AOS Init ──────────────────────────────────────────────
        // Pakai 'load' karena script AOS di-defer, sehingga pasti
        // sudah tersedia saat event 'load' fired.
        window.addEventListener('load', function() {
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 700,
                    once: true,
                    offset: 80,
                    easing: 'ease-out-cubic',
                });
            }
        });
    </script>

    @stack('scripts')
</body>

</html>
