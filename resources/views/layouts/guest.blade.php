<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('Login') }} - {{ config('app.name', 'Digitalisasi Aset') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        media="print" onload="this.media='all'">
    <noscript>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    </noscript>

    <link rel="icon" type="image/png" href="{{ asset('logo_kemenkeu.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ═══════════════════════════════════════════════════
           CRITICAL CSS — inlined untuk zero render-blocking
        ═══════════════════════════════════════════════════ */

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        /* ── Progress Bar ─────────────────────────────── */
        #page-progress {
            position: fixed;
            top: 0;
            left: 0;
            width: 0%;
            height: 3px;
            background: linear-gradient(90deg, #3b82f6, #8b5cf6, #06b6d4);
            background-size: 200% 100%;
            z-index: 99999;
            transition: width 0.4s ease, opacity 0.4s ease;
            animation: progressShimmer 1.5s linear infinite;
        }

        #page-progress.done {
            width: 100% !important;
            opacity: 0;
        }

        @keyframes progressShimmer {
            0% {
                background-position: 200% center;
            }

            100% {
                background-position: -200% center;
            }
        }

        /* ── Loading Overlay ──────────────────────────── */
        #loading-overlay {
            position: fixed;
            inset: 0;
            background: #0f172a;
            z-index: 9998;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 2rem;
            transition: opacity 0.5s ease;
        }

        #loading-overlay.fade-out {
            opacity: 0;
            pointer-events: none;
        }

        /* ── Logo animasi ─────────────────────────────── */
        .logo-ring {
            position: relative;
            width: 80px;
            height: 80px;
        }

        .logo-ring svg {
            position: absolute;
            inset: 0;
            animation: spinRing 2s linear infinite;
            transform-origin: center;
        }

        .logo-ring svg:nth-child(2) {
            animation-direction: reverse;
            animation-duration: 3s;
        }

        .logo-ring .logo-core {
            position: absolute;
            inset: 14px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            display: flex;
            align-items: center;
            justify-content: center;
            animation: pulseLogo 2s ease-in-out infinite;
        }

        @keyframes spinRing {
            to {
                transform: rotate(360deg);
            }
        }

        @keyframes pulseLogo {

            0%,
            100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.4);
            }

            50% {
                transform: scale(1.05);
                box-shadow: 0 0 0 8px rgba(59, 130, 246, 0);
            }
        }

        /* ── Loading text counter ─────────────────────── */
        #loading-percent {
            font-family: 'Inter', sans-serif;
            font-size: 0.8rem;
            font-weight: 500;
            letter-spacing: 0.15em;
            color: rgba(148, 163, 184, 0.8);
        }

        /* ── Background grid subtle ───────────────────── */
        .bg-dot-grid {
            background-image: radial-gradient(circle, rgba(255, 255, 255, 0.06) 1px, transparent 1px);
            background-size: 32px 32px;
        }

        /* ── Animasi dekoratif sisi kiri ──────────────── */
        @keyframes floatY {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            33% {
                transform: translateY(-12px) rotate(1deg);
            }

            66% {
                transform: translateY(-6px) rotate(-1deg);
            }
        }

        .float-1 {
            animation: floatY 7s ease-in-out infinite;
        }

        .float-2 {
            animation: floatY 9s ease-in-out infinite 1.5s;
        }

        .float-3 {
            animation: floatY 6s ease-in-out infinite 0.8s;
        }

        .logo-core img,
        .logo-box img {
            filter: brightness(1.1);
            /* Jika logo terlalu gelap di dark background: */
            /* filter: brightness(0) invert(1); */
            /* membuat logo jadi putih */
        }

        /* ── Animated logo di sisi kiri ───────────────── */
        @keyframes drawCircle {
            to {
                stroke-dashoffset: 0;
            }
        }

        @keyframes iconBounceIn {
            0% {
                transform: scale(0) rotate(-20deg);
                opacity: 0;
            }

            70% {
                transform: scale(1.15) rotate(3deg);
                opacity: 1;
            }

            100% {
                transform: scale(1) rotate(0deg);
                opacity: 1;
            }
        }

        .icon-bounce {
            animation: iconBounceIn 0.7s cubic-bezier(.34, 1.56, .64, 1) 0.3s both;
        }

        /* ── Garis aksen vertikal ─────────────────────── */
        @keyframes lineGrow {
            from {
                transform: scaleY(0);
            }

            to {
                transform: scaleY(1);
            }
        }

        .line-grow {
            transform-origin: top center;
            animation: lineGrow 1s cubic-bezier(.16, 1, .3, 1) 0.5s both;
        }

        /* ── Reduced motion ───────────────────────────── */
        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>

    <link rel="preload" href="https://unpkg.com/aos@2.3.1/dist/aos.css" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    </noscript>
</head>

<body class="font-sans antialiased min-h-screen overflow-x-hidden" style="background:#0f172a;">

    {{-- ═══════════════════════════════════════════════════════
         PROGRESS BAR
    ═══════════════════════════════════════════════════════ --}}
    <div id="page-progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"
        aria-label="Memuat halaman"></div>

    {{-- ═══════════════════════════════════════════════════════
         LOADING OVERLAY
    ═══════════════════════════════════════════════════════ --}}
    <div id="loading-overlay" aria-hidden="true">
        {{-- Logo animasi ─────────────────────── --}}
        <div class="logo-ring">
            {{-- Ring luar --}}
            <svg viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="40" cy="40" r="36" stroke="url(#ringGrad1)" stroke-width="2"
                    stroke-dasharray="6 4" stroke-linecap="round" />
                <defs>
                    <linearGradient id="ringGrad1" x1="0" y1="0" x2="80" y2="80"
                        gradientUnits="userSpaceOnUse">
                        <stop offset="0%" stop-color="#3b82f6" />
                        <stop offset="100%" stop-color="#8b5cf6" stop-opacity="0.3" />
                    </linearGradient>
                </defs>
            </svg>
            {{-- Ring dalam --}}
            <svg viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="40" cy="40" r="28" stroke="url(#ringGrad2)" stroke-width="1.5"
                    stroke-dasharray="3 6" stroke-linecap="round" />
                <defs>
                    <linearGradient id="ringGrad2" x1="80" y1="0" x2="0" y2="80"
                        gradientUnits="userSpaceOnUse">
                        <stop offset="0%" stop-color="#06b6d4" />
                        <stop offset="100%" stop-color="#3b82f6" stop-opacity="0.2" />
                    </linearGradient>
                </defs>
            </svg>
            {{-- Core --}}
            <div class="logo-core">
                <img src="{{ asset('logo_kemenkeu.png') }}" alt="Logo Digitalisasi Aset" class="w-8 h-8 object-contain">
            </div>
        </div>

        {{-- Teks --}}
        <div class="text-center space-y-1">
            <p class="text-white font-semibold text-sm tracking-widest uppercase">
                Digitalisasi Aset
            </p>
            <p id="loading-percent" aria-live="polite">Memuat... <span id="pct">0</span>%</p>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════
         MAIN LAYOUT
    ═══════════════════════════════════════════════════════ --}}
    <main class="flex items-stretch">


        {{-- ── LEFT SIDE: hanya tampil di lg+ ──────────── --}}
        <aside
            class="hidden lg:flex lg:w-[52%] xl:w-1/2 relative flex-col
               justify-between overflow-hidden
               sticky top-0 h-screen"
            aria-hidden="true">

            {{-- Background gradient + grid --}}
            <div
                class="absolute inset-0 bg-gradient-to-br
                        from-slate-900 via-blue-950 to-slate-900 bg-dot-grid">
            </div>

            {{-- Glow blobs — lebih subtle dari sebelumnya --}}
            <div
                class="absolute top-1/4 left-1/3 w-96 h-96 rounded-full
                        bg-blue-600/10 blur-3xl pointer-events-none float-1">
            </div>
            <div
                class="absolute bottom-1/4 right-1/4 w-80 h-80 rounded-full
                        bg-violet-600/10 blur-3xl pointer-events-none float-2">
            </div>

            {{-- Garis aksen vertikal kiri --}}
            <div
                class="absolute left-0 top-0 bottom-0 w-px
                        bg-gradient-to-b from-transparent via-blue-500/40 to-transparent
                        line-grow">
            </div>

            {{-- Konten utama --}}
            <div class="relative z-10 flex flex-col h-full px-14 py-16 justify-between">

                {{-- Logo atas --}}
                <div data-aos="fade-down" data-aos-delay="100">
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center gap-4 group
                              focus:outline-none focus-visible:ring-2
                              focus-visible:ring-blue-400 rounded-2xl p-1">
                        {{-- Ikon logo dengan animasi --}}
                        <div class="relative">
                            {{-- Ring dekoratif --}}
                            <svg class="absolute -inset-2 w-[calc(100%+16px)] h-[calc(100%+16px)]
                                        opacity-0 group-hover:opacity-100 transition-opacity duration-500"
                                viewBox="0 0 68 68" fill="none">
                                <circle cx="34" cy="34" r="32" stroke="url(#hoverRing)"
                                    stroke-width="1" stroke-dasharray="5 3" stroke-linecap="round" />
                                <defs>
                                    <linearGradient id="hoverRing" x1="0" y1="0" x2="68"
                                        y2="68" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#3b82f6" />
                                        <stop offset="1" stop-color="#8b5cf6" />
                                    </linearGradient>
                                </defs>
                            </svg>
                            <div
                                class="w-12 h-12 rounded-2xl
            bg-slate-800 border border-slate-700/60
            flex items-center justify-center
            shadow-lg shadow-black/20
            group-hover:shadow-black/40
            group-hover:scale-110
            transition-all duration-300 icon-bounce p-1.5">
                                <img src="{{ asset('logo_kemenkeu.png') }}" alt="Logo Digitalisasi Aset"
                                    class="w-full h-full object-contain">
                            </div>
                        </div>
                        <div>
                            <span
                                class="block text-lg font-bold text-white
                                         tracking-tight leading-none">
                                Digitalisasi Aset
                            </span>
                            <span
                                class="block text-xs text-slate-400 mt-1 font-medium
                                         tracking-wide uppercase">
                                Kementerian Keuangan RI
                            </span>
                        </div>
                    </a>
                </div>

                {{-- Hero ─────────────────────────────────── --}}
                <div class="max-w-md" data-aos="fade-right" data-aos-delay="200">

                    {{-- Badge --}}
                    <div class="inline-flex items-center gap-2 px-3 py-1.5
                                rounded-full border border-blue-500/30
                                bg-blue-500/10 backdrop-blur-sm mb-8"
                        data-aos="fade-up" data-aos-delay="250">
                        <span
                            class="w-1.5 h-1.5 rounded-full bg-blue-400
                                     animate-pulse"></span>
                        <span class="text-blue-300 text-xs font-medium tracking-wide">
                            Sistem Aktif & Aman
                        </span>
                    </div>

                    <h1 class="text-4xl xl:text-5xl font-bold text-white
                                leading-[1.15] tracking-tight mb-6"
                        data-aos="fade-up" data-aos-delay="300">
                        Satu Platform,<br>
                        <span
                            class="text-transparent bg-clip-text
                                     bg-gradient-to-r from-blue-400 via-violet-400 to-cyan-400">
                            Kelola Seluruh Aset
                        </span>
                    </h1>

                    <p class="text-slate-400 text-base leading-relaxed mb-10" data-aos="fade-up"
                        data-aos-delay="350">
                        SIDITA menyediakan dashboard terpadu untuk pemantauan,
                        analisis, dan pengelolaan Barang Milik Negara (BMN)
                        secara real-time dan akurat.
                    </p>

                    {{-- Feature pills --}}
                    <div class="flex flex-wrap gap-3" data-aos="fade-up" data-aos-delay="400">
                        @foreach ([['icon' => 'fa-bolt', 'label' => 'Real-time', 'color' => 'blue'], ['icon' => 'fa-shield-halved', 'label' => 'Aman & Terenkripsi', 'color' => 'violet'], ['icon' => 'fa-chart-line', 'label' => 'Analitik BMN', 'color' => 'cyan']] as $pill)
                            <span
                                class="inline-flex items-center gap-2 px-4 py-2
                                          rounded-full bg-slate-800/60 border border-slate-700/60
                                          text-slate-300 text-xs font-medium
                                          hover:border-{{ $pill['color'] }}-500/50
                                          hover:text-{{ $pill['color'] }}-300
                                          transition-all duration-200 cursor-default">
                                <i
                                    class="fas {{ $pill['icon'] }}
                                             text-{{ $pill['color'] }}-400 text-[11px]"></i>
                                {{ $pill['label'] }}
                            </span>
                        @endforeach
                    </div>
                </div>

                {{-- Footer kiri --}}
                <div class="text-xs text-slate-600 font-medium tracking-wide" data-aos="fade-up"
                    data-aos-delay="450">
                    © {{ date('Y') }} · Biro Manajemen BMN dan Pengadaan
                </div>
            </div>

            {{-- Dekorasi pojok kanan bawah --}}
            <div class="absolute bottom-0 right-0 w-64 h-64 float-3 pointer-events-none" aria-hidden="true">
                <svg viewBox="0 0 256 256" fill="none" class="w-full h-full opacity-[0.04]">
                    <circle cx="256" cy="256" r="200" stroke="white" stroke-width="1" />
                    <circle cx="256" cy="256" r="140" stroke="white" stroke-width="1" />
                    <circle cx="256" cy="256" r="80" stroke="white" stroke-width="1" />
                </svg>
            </div>
        </aside>

        {{-- ── RIGHT SIDE: Form login (full width di mobile) ── --}}
        <section
            class="flex-1 flex items-center justify-center
                         min-h-screen p-6 sm:p-10 relative"
            style="background: linear-gradient(160deg, #0f172a 0%, #0d1f3c 50%, #0f172a 100%);">

            {{-- Subtle radial glow di belakang card --}}
            <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
                <div
                    class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2
                            w-[500px] h-[500px] rounded-full
                            bg-blue-600/5 blur-[80px]">
                </div>
            </div>

            <div class="w-full max-w-[420px] relative z-10" data-aos="fade-up" data-aos-delay="150">

                {{-- ── CARD ──────────────────────────────── --}}
                <div
                    class="rounded-2xl border border-slate-700/60
                            bg-slate-900/80 backdrop-blur-xl
                            shadow-2xl shadow-black/40 p-8 sm:p-10">

                    {{-- Card header --}}
                    <div class="mb-8">
                        {{-- Mobile-only: logo kecil --}}
                        <div class="flex items-center gap-3 mb-6 lg:hidden">
                            <div
                                class="w-9 h-9 rounded-xl
            bg-slate-800 border border-slate-700/60
            flex items-center justify-center p-1.5">
                                <img src="{{ asset('logo_kemenkeu.png') }}" alt="Logo Digitalisasi Aset"
                                    class="w-full h-full object-contain">
                            </div>
                            <div>
                                <span class="text-sm font-bold text-white">Digitalisasi Aset</span>
                                <p class="text-[10px] text-slate-500 uppercase tracking-wide">
                                    Kementerian Keuangan RI
                                </p>
                            </div>
                        </div>

                        <h2 class="text-xl font-bold text-white mb-1">Selamat Datang</h2>
                        <p class="text-slate-400 text-sm">
                            Masuk untuk mengakses SIDITA
                        </p>
                    </div>

                    {{-- Slot: konten form dari login.blade.php --}}
                    {{ $slot }}

                    {{-- Footer card --}}
                    <p class="text-center text-xs text-slate-600 mt-8">
                        © {{ date('Y') }} Digitalisasi Aset · Hak cipta dilindungi
                    </p>
                </div>
            </div>
        </section>
    </main>

    {{-- ═══════════════════════════════════════════════════════
         SCRIPTS
    ═══════════════════════════════════════════════════════ --}}
    <script>
        (function() {
            'use strict';

            // ── Progress bar + overlay controller ─────────────────────
            const bar = document.getElementById('page-progress');
            const overlay = document.getElementById('loading-overlay');
            const pct = document.getElementById('pct');

            let progress = 0;
            const targetProgress = {
                value: 0
            };

            // Simulasi progress realistis
            const steps = [{
                    to: 30,
                    delay: 0,
                    speed: 80
                },
                {
                    to: 60,
                    delay: 200,
                    speed: 120
                },
                {
                    to: 85,
                    delay: 500,
                    speed: 200
                },
                {
                    to: 95,
                    delay: 800,
                    speed: 400
                },
            ];

            function setProgress(val) {
                progress = Math.min(val, 100);
                if (bar) {
                    bar.style.width = progress + '%';
                    bar.setAttribute('aria-valuenow', progress);
                }
                if (pct) pct.textContent = Math.round(progress);
            }

            steps.forEach(({
                to,
                delay,
                speed
            }) => {
                setTimeout(() => animateTo(to, speed), delay);
            });

            function animateTo(target, duration) {
                const start = progress;
                const diff = target - start;
                const startTime = performance.now();

                function step(now) {
                    const elapsed = now - startTime;
                    const p = Math.min(elapsed / duration, 1);
                    // ease-out cubic
                    const eased = 1 - Math.pow(1 - p, 3);
                    setProgress(start + diff * eased);
                    if (p < 1) requestAnimationFrame(step);
                }
                requestAnimationFrame(step);
            }

            function finishLoading() {
                animateTo(100, 300);
                setTimeout(() => {
                    if (bar) bar.classList.add('done');
                    if (overlay) {
                        overlay.classList.add('fade-out');
                        setTimeout(() => overlay.remove(), 520);
                    }
                }, 350);
            }

            // Fallback paksa selesai setelah 6 detik
            const fallback = setTimeout(finishLoading, 6000);

            window.addEventListener('load', () => {
                clearTimeout(fallback);
                finishLoading();
            }, {
                once: true
            });

        })();
    </script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js" defer></script>
    <script>
        window.addEventListener('load', function() {
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 600,
                    once: true,
                    offset: 30,
                    easing: 'ease-out-cubic',
                });
            }
        }, {
            once: true
        });
    </script>
</body>

</html>
