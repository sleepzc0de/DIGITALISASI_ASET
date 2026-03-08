<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="Digitalisasi Aset BMN - SIDITA">
    <meta name="description" content="Sistem informasi digitalisasi aset BMN Kementerian Keuangan BA 015.">
    <meta name="keywords" content="BMN, Barang Milik Negara, Digitalisasi Aset, Kementerian Keuangan">
    <meta name="author" content="Biro Manajemen BMN dan Pengadaan - Kementerian Keuangan RI">
    <meta name="robots" content="index, follow">
    <meta name="developer" content="Auliya Putra Azhari">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://digitalisasi-aset.kemenkeu.go.id/">
    <meta property="og:title" content="Digitalisasi Aset BMN - Kementerian Keuangan RI">
    <meta property="og:description" content="Sistem informasi digitalisasi aset BMN Kementerian Keuangan.">
    <meta property="og:image" content="{{ asset('kemenkeu_hd.png') }}">
    <meta property="og:site_name" content="Digitalisasi Aset Kemenkeu">
    <meta property="og:locale" content="id_ID">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="canonical" href="https://digitalisasi-aset.kemenkeu.go.id">
    <link rel="icon" type="image/png" href="{{ asset('kemenkeu_hd.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('kemenkeu_hd.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('kemenkeu_hd.png') }}">
    <title>Digitalisasi Aset BMN - Kementerian Keuangan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

        * {
            font-family: 'Inter', sans-serif;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
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

        @keyframes pulse-slow {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        @keyframes shimmer {
            0% {
                background-position: -200% center;
            }

            100% {
                background-position: 200% center;
            }
        }

        @keyframes ripple {
            0% {
                transform: scale(0.8);
                opacity: 1;
            }

            100% {
                transform: scale(2.5);
                opacity: 0;
            }
        }

        @keyframes borderGlow {

            0%,
            100% {
                border-color: rgba(251, 191, 36, 0.2);
                box-shadow: 0 0 10px rgba(251, 191, 36, 0.1);
            }

            50% {
                border-color: rgba(251, 191, 36, 0.6);
                box-shadow: 0 0 30px rgba(251, 191, 36, 0.4);
            }
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes modalIn {
            from {
                opacity: 0;
                transform: scale(0.85) translateY(20px);
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        @keyframes tooltipFadeIn {
            from {
                opacity: 0;
                transform: translateY(6px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .animate-fadeIn {
            animation: fadeIn 0.5s ease-out forwards;
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        .animate-pulse-slow {
            animation: pulse-slow 3s ease-in-out infinite;
        }

        .animate-slideDown {
            animation: slideDown 0.4s ease-out forwards;
        }

        .animate-modalIn {
            animation: modalIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        }

        .animate-tooltipIn {
            animation: tooltipFadeIn 0.2s ease-out forwards;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #0a1f44 0%, #1a3a6e 50%, #0a1f44 100%);
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .glass-dark {
            background: rgba(10, 31, 68, 0.92);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.12);
        }

        .text-shadow {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .glow-yellow {
            box-shadow: 0 0 20px rgba(251, 191, 36, 0.5);
        }

        .shimmer-text {
            background: linear-gradient(90deg, #fbbf24 0%, #fff 40%, #fbbf24 60%, #fbbf24 100%);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shimmer 3s linear infinite;
        }

        .border-glow-anim {
            animation: borderGlow 2s ease-in-out infinite;
        }

        /* ── Segment icon box transition ── */
        .segment-icon-box {
            transition: all 0.3s ease;
        }

        /* Ripple */
        .ripple-ring {
            position: absolute;
            inset: 0;
            border-radius: 50%;
            border: 2px solid rgba(251, 191, 36, 0.6);
            animation: ripple 2s ease-out infinite;
        }

        .ripple-ring:nth-child(2) {
            animation-delay: 0.7s;
        }

        /* Progress bar */
        .progress-fill {
            height: 100%;
            border-radius: 9999px;
            transition: width 1.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Modal */
        .modal-backdrop {
            backdrop-filter: blur(8px);
            background: rgba(5, 15, 35, 0.75);
        }

        .modal-scroll::-webkit-scrollbar {
            width: 4px;
        }

        .modal-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .modal-scroll::-webkit-scrollbar-thumb {
            background: rgba(251, 191, 36, 0.4);
            border-radius: 9999px;
        }

        /* Loading spinner */
        .spinner {
            width: 56px;
            height: 56px;
            border: 4px solid rgba(251, 191, 36, 0.2);
            border-top-color: #fbbf24;
            border-radius: 50%;
            animation: spin 0.9s linear infinite;
        }

        /* ══════════════════════════════
           TOOLTIP — fixed position,
           rendered via JS (no CSS rotate problem)
        ══════════════════════════════ */
        #floating-tooltip {
            position: fixed;
            z-index: 9999;
            pointer-events: none;
            transform: translate(-50%, -100%);
            margin-top: -12px;
            animation: tooltipFadeIn 0.2s ease-out forwards;
        }

        #floating-tooltip .arrow {
            position: absolute;
            bottom: -6px;
            left: 50%;
            transform: translateX(-50%) rotate(45deg);
            width: 10px;
            height: 10px;
            background: rgba(10, 31, 68, 0.95);
            border-right: 1px solid rgba(255, 255, 255, 0.15);
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
        }

        @media (max-width: 768px) {
            .segment-label {
                font-size: 0.6rem;
            }
        }
    </style>
</head>

<body class="gradient-bg min-h-screen overflow-x-hidden">

    <!-- ══════════════════════════════════════════
     LOADING SCREEN
═══════════════════════════════════════════ -->
    <div id="loading-screen"
        class="fixed inset-0 z-[200] gradient-bg flex flex-col items-center justify-center transition-opacity duration-700">
        <div class="text-center">
            <div class="spinner mx-auto mb-6"></div>
            <p class="text-yellow-400 font-semibold text-lg tracking-widest uppercase animate-pulse-slow">Memuat Sistem…
            </p>
            <p class="text-gray-500 text-sm mt-2">Digitalisasi Aset BMN</p>
            <div class="mt-6 w-56 h-1 bg-white/10 rounded-full overflow-hidden mx-auto">
                <div id="load-progress" class="progress-fill bg-yellow-400" style="width:0%"></div>
            </div>
        </div>
    </div>

    <!-- ══════════════════════════════════════════
     FLOATING TOOLTIP (outside Alpine, fixed pos)
═══════════════════════════════════════════ -->
    <div id="floating-tooltip" style="display:none;">
        <div class="glass-dark rounded-xl px-4 py-2.5 shadow-2xl max-w-[200px]">
            <p id="tooltip-name" class="text-yellow-400 font-bold text-xs text-center"></p>
            <p id="tooltip-desc" class="text-gray-300 text-[10px] mt-0.5 leading-snug text-center"></p>
        </div>
        <div class="arrow"></div>
    </div>

    <!-- ══════════════════════════════════════════
     MAIN APP
═══════════════════════════════════════════ -->
    <div x-data="assetManagement()" x-init="init()" class="relative">

        <!-- Background decoratives -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-20 left-10 w-72 h-72 bg-blue-500/10 rounded-full blur-3xl animate-pulse-slow">
            </div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-yellow-500/10 rounded-full blur-3xl animate-pulse-slow"
                style="animation-delay:1s;"></div>
            <div class="absolute top-1/2 left-1/4 w-48 h-48 bg-indigo-500/5 rounded-full blur-2xl animate-float"></div>
        </div>

        <!-- ── Hero ── -->
        <section class="relative z-10 py-6 px-4">
            <div class="container mx-auto text-center">

                <!-- Title Block -->
                <div class="animate-fadeInUp mb-6" style="animation-delay:0.1s; opacity:0;">
                    <h2 class="text-4xl md:text-5xl font-bold text-white text-shadow shimmer-text pb-2 leading-tight">
                        Digitalisasi Aset BMN
                    </h2>
                    <p class="text-gray-400 text-xs md:text-sm mt-3 tracking-widest uppercase">
                        Biro Manajemen BMN dan Pengadaan · Kementerian Keuangan RI
                    </p>
                </div>

                <!-- ── Cycle Diagram ── -->
                <div class="relative max-w-2xl mx-auto animate-fadeInUp" style="animation-delay:0.3s; opacity:0;">

                    <!-- Label "Informasi Aset BA 015" — dipindah ke DALAM diagram, bukan menumpuk subtitle -->
                    <div class="flex justify-center mb-3">
                        <div
                            class="glass-effect px-6 py-2 rounded-full border border-yellow-400/30 inline-flex items-center gap-2">
                            <span class="w-2 h-2 bg-yellow-400 rounded-full animate-pulse-slow"></span>
                            <span class="text-yellow-400 font-semibold text-sm tracking-wide">Informasi Aset BA
                                015</span>
                            <span class="w-2 h-2 bg-yellow-400 rounded-full animate-pulse-slow"></span>
                        </div>
                    </div>

                    <div class="relative mx-auto w-full aspect-square" id="diagram-root">
                        <!-- Outer pulse ring -->
                        <div
                            class="absolute inset-10 rounded-full border border-yellow-400/20 border-glow-anim pointer-events-none">
                        </div>

                        <!-- Segments wrapper -->
                        <div class="absolute inset-[10%] rounded-full" id="segments-wrapper">

                            <!-- ── Center Core ── -->
                            <div class="absolute inset-[28%] rounded-full bg-gradient-to-br from-blue-900 to-blue-950
                                    flex items-center justify-center shadow-2xl border-2 border-yellow-400/30
                                    cursor-pointer transition-all duration-300 hover:scale-105 hover:border-yellow-400/60
                                    group z-20"
                                @click="openLogin()">
                                <div class="absolute inset-0 rounded-full overflow-hidden">
                                    <div class="ripple-ring opacity-0 group-hover:opacity-100"></div>
                                    <div class="ripple-ring opacity-0 group-hover:opacity-100"></div>
                                </div>
                                <div class="text-center px-2 relative z-10">
                                    <div
                                        class="w-10 h-10 mx-auto mb-1 rounded-full bg-yellow-400/10 flex items-center justify-center group-hover:bg-yellow-400/20 transition-all">
                                        <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-base md:text-xl font-bold text-white leading-tight">SIKLUS</h3>
                                    <h4 class="text-sm md:text-base font-bold text-yellow-400 leading-tight">
                                        PENGELOLAAN</h4>
                                    <h4 class="text-sm md:text-base font-bold text-yellow-400 leading-tight">BMN</h4>
                                    <p
                                        class="text-[10px] text-gray-400 mt-1 group-hover:text-yellow-300 transition-colors">
                                        Klik untuk masuk</p>
                                </div>
                            </div>

                            <!-- ── Segments (rendered by JS, not Alpine template) ── -->
                            <div id="segments-container" class="absolute inset-0"></div>

                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- ── Footer ── -->
        <footer class="relative z-10 py-4 px-4 mt-2 border-t border-white/10">
            <div class="container mx-auto text-center text-gray-400">
                <p class="font-semibold text-gray-300">&copy; 2026 Kementerian Keuangan Republik Indonesia</p>
                <p class="text-sm mt-1">Powered By Biro Manajemen BMN dan Pengadaan</p>
                <p class="text-sm mt-1 text-yellow-400 hover:text-yellow-300 transition-colors cursor-pointer">
                    <a href="https://romadan.kemenkeu.go.id/">www.romadan.kemenkeu.go.id</a>
                </p>
            </div>
        </footer>

        <!-- ══════════════════════════════════════════
         MODAL DETAIL SEGMEN
    ═══════════════════════════════════════════ -->
        <div x-show="activeSegment !== null" x-cloak
            class="fixed inset-0 z-[100] flex items-center justify-center modal-backdrop" @click.self="closeModal()"
            x-transition:enter="transition duration-200" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

            <div class="glass-dark rounded-2xl p-6 md:p-8 max-w-sm w-full mx-4 shadow-2xl modal-scroll overflow-y-auto max-h-[90vh] animate-modalIn relative"
                @click.stop>

                <!-- Close -->
                <button
                    class="absolute top-4 right-4 w-8 h-8 rounded-full glass-effect flex items-center justify-center
                           text-gray-400 hover:text-white transition-all"
                    @click="closeModal()">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <template x-if="activeSegment !== null">
                    <div class="text-center">
                        <!-- Icon -->
                        <div
                            class="w-20 h-20 mx-auto rounded-2xl bg-yellow-400/10 border border-yellow-400/20
                                flex items-center justify-center mb-4 glow-yellow">
                            <span x-html="segments[activeSegment]?.icon" class="text-4xl"></span>
                        </div>

                        <!-- Step badge -->
                        <div class="inline-block glass-effect px-3 py-0.5 rounded-full mb-2">
                            <span class="text-yellow-400 text-xs font-semibold"
                                x-text="`Tahap ${activeSegment + 1} dari ${segments.length}`"></span>
                        </div>

                        <!-- Name -->
                        <h3 class="text-2xl font-bold text-white mb-2" x-text="segments[activeSegment]?.name"></h3>

                        <!-- Description -->
                        <p class="text-gray-300 text-sm leading-relaxed mb-4"
                            x-text="segments[activeSegment]?.description"></p>

                        <!-- Detail box -->
                        <div class="bg-white/5 rounded-xl p-4 text-left mb-4 border border-white/10">
                            <p class="text-xs text-gray-400 leading-relaxed" x-text="segments[activeSegment]?.detail">
                            </p>
                        </div>

                        <!-- Activities -->
                        <div class="text-left mb-5">
                            <p class="text-yellow-400 text-xs font-semibold mb-2 uppercase tracking-wider">Kegiatan
                                Utama</p>
                            <ul class="space-y-1.5">
                                <template x-for="act in segments[activeSegment]?.activities" :key="act">
                                    <li class="flex items-start gap-2 text-gray-300 text-xs">
                                        <span class="text-yellow-400 mt-0.5 flex-shrink-0">▸</span>
                                        <span x-text="act"></span>
                                    </li>
                                </template>
                            </ul>
                        </div>

                        <!-- Progress -->
                        <div class="flex items-center gap-2 mb-5">
                            <div class="flex-1 h-1 bg-white/10 rounded-full overflow-hidden">
                                <div class="progress-fill bg-gradient-to-r from-yellow-500 to-yellow-300"
                                    :style="`width: ${((activeSegment + 1) / segments.length) * 100}%`"></div>
                            </div>
                            <span class="text-yellow-400 text-xs font-semibold"
                                x-text="`${Math.round(((activeSegment + 1) / segments.length) * 100)}%`"></span>
                        </div>

                        <!-- Navigation -->
                        <div class="flex gap-2 mb-4">
                            <button
                                class="flex-1 glass-effect rounded-xl py-2 text-sm text-gray-300
                                       hover:text-white transition-all disabled:opacity-30"
                                :disabled="activeSegment === 0"
                                @click="activeSegment = activeSegment > 0 ? activeSegment - 1 : activeSegment">
                                ← Sebelumnya
                            </button>
                            <button
                                class="flex-1 glass-effect rounded-xl py-2 text-sm text-gray-300
                                       hover:text-white transition-all disabled:opacity-30"
                                :disabled="activeSegment === segments.length - 1"
                                @click="activeSegment = activeSegment < segments.length - 1 ? activeSegment + 1 : activeSegment">
                                Selanjutnya →
                            </button>
                        </div>

                        <!-- CTA -->
                        <button @click="openLogin()"
                            class="w-full bg-gradient-to-r from-yellow-400 to-yellow-500 text-blue-900
                                   font-bold py-3 rounded-xl hover:from-yellow-300 hover:to-yellow-400
                                   transition-all duration-200 hover:shadow-lg hover:shadow-yellow-400/30
                                   active:scale-95 flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            Akses Fitur Ini
                        </button>
                    </div>
                </template>
            </div>
        </div>

    </div><!-- /x-data -->

    <!-- ══════════════════════════════════════════
     SCRIPTS
═══════════════════════════════════════════ -->
    <script>
        /* ── Loading screen ── */
        (function() {
            const screen = document.getElementById('loading-screen');
            const progress = document.getElementById('load-progress');
            let pct = 0;
            const timer = setInterval(() => {
                pct += Math.random() * 18 + 8;
                if (pct >= 100) {
                    pct = 100;
                    clearInterval(timer);
                    setTimeout(() => {
                        screen.style.opacity = '0';
                        setTimeout(() => screen.style.display = 'none', 700);
                    }, 300);
                }
                progress.style.width = pct + '%';
            }, 160);
        })();

        /* ════════════════════════════════════════
           SEGMENT RENDERER
           Kita render segmen langsung ke DOM dengan
           posisi (x,y) menggunakan trigonometri —
           BUKAN CSS rotate — sehingga tooltip selalu
           muncul tepat di atas ikon yang di-hover.
        ════════════════════════════════════════ */
        const SEGMENTS_DATA = [{
                name: 'Perencanaan',
                icon: '📋',
                description: 'Proses perencanaan kebutuhan dan penganggaran BMN',
                detail: 'Meliputi analisis kebutuhan, penyusunan RKBMN, dan koordinasi dengan unit anggaran untuk memastikan ketersediaan dana.',
                activities: ['Analisis kebutuhan barang', 'Penyusunan RKBMN', 'Koordinasi anggaran',
                    'Persetujuan perencanaan'
                ]
            },
            {
                name: 'Pengadaan',
                icon: '🛍️',
                description: 'Proses perolehan BMN melalui pembelian, hibah, atau cara lain',
                detail: 'Mencakup proses tender, penunjukan langsung, e-purchasing, dan seluruh mekanisme pengadaan sesuai regulasi.',
                activities: ['Penyusunan spesifikasi teknis', 'Proses lelang/tender', 'Penerimaan & pemeriksaan barang',
                    'Pencatatan awal BMN'
                ]
            },
            {
                name: 'Penggunaan',
                icon: '🏢',
                description: 'Kegiatan yang dilakukan oleh Pengguna Barang dalam mengelola BMN',
                detail: 'Penetapan status penggunaan, persetujuan penggunaan sementara, dan penggunaan BMN untuk kepentingan tupoksi.',
                activities: ['Penetapan status penggunaan', 'Permohonan penggunaan', 'Monitoring pemanfaatan aset',
                    'Laporan penggunaan'
                ]
            },
            {
                name: 'Pemanfaatan',
                icon: '🔑',
                description: 'Pendayagunaan BMN untuk dipergunakan sesuai tupoksi K/L',
                detail: 'Meliputi sewa, pinjam pakai, kerja sama pemanfaatan, bangun guna serah, dan bangun serah guna.',
                activities: ['Identifikasi aset idle', 'Penyusunan proposal pemanfaatan',
                    'Persetujuan Pengelola Barang', 'Monitoring & evaluasi'
                ]
            },
            {
                name: 'Pengamanan & Pemeliharaan',
                icon: '🛡️',
                description: 'Kegiatan perlindungan dan perawatan BMN agar tetap optimal',
                detail: 'Pengamanan fisik, administratif, dan hukum atas BMN, serta kegiatan pemeliharaan rutin dan berkala.',
                activities: ['Pengamanan fisik & administrasi', 'Sertifikasi tanah & bangunan', 'Pemeliharaan rutin',
                    'Perbaikan & renovasi'
                ]
            },
            {
                name: 'Penilaian',
                icon: '📊',
                description: 'Proses penetapan nilai BMN dalam rangka penyusunan neraca',
                detail: 'Dilakukan oleh Penilai Pemerintah atau penilai publik untuk keperluan pemanfaatan, pemindahtanganan, atau laporan keuangan.',
                activities: ['Inventarisasi & identifikasi', 'Penilaian oleh DJKN', 'Penetapan nilai wajar',
                    'Update data SIMAK BMN'
                ]
            },
            {
                name: 'Pemindahtanganan',
                icon: '🔄',
                description: 'Pengalihan kepemilikan BMN kepada pihak lain',
                detail: 'Bentuk pemindahtanganan meliputi penjualan, tukar-menukar, hibah, dan penyertaan modal pemerintah pusat.',
                activities: ['Permohonan pemindahtanganan', 'Penilaian BMN', 'Persetujuan DPR/Presiden',
                    'Pelaksanaan & serah terima'
                ]
            },
            {
                name: 'Pemusnahan',
                icon: '🔥',
                description: 'Tindakan menghancurkan fisik BMN yang tidak dapat digunakan',
                detail: 'Dilakukan apabila BMN tidak dapat digunakan, tidak dapat dimanfaatkan, dan tidak dapat dipindahtangankan.',
                activities: ['Identifikasi BMN rusak berat', 'Permohonan pemusnahan', 'Pembentukan panitia',
                    'Berita acara pemusnahan'
                ]
            },
            {
                name: 'Penghapusan',
                icon: '🗑️',
                description: 'Tindakan menghapus BMN dari daftar barang dengan menerbitkan SK',
                detail: 'Penghapusan merupakan tahap akhir siklus BMN, dilakukan setelah pemindahtanganan atau pemusnahan selesai.',
                activities: ['Permohonan penghapusan', 'Verifikasi dokumen', 'Penerbitan SK penghapusan',
                    'Update SIMAK BMN'
                ]
            },
            {
                name: 'Penatausahaan',
                icon: '📁',
                description: 'Kegiatan pembukuan, inventarisasi, dan pelaporan BMN',
                detail: 'Meliputi pencatatan dalam SIMAK BMN, rekonsiliasi dengan SAIBA, inventarisasi berkala, dan penyusunan laporan BMN.',
                activities: ['Pencatatan di SIMAK BMN', 'Rekonsiliasi internal', 'Inventarisasi tahunan',
                    'Penyusunan laporan BMN'
                ]
            }
        ];

        /* Render segments setelah DOM siap */
        document.addEventListener('DOMContentLoaded', () => {
            const container = document.getElementById('segments-container');
            const tooltip = document.getElementById('floating-tooltip');
            const tooltipName = document.getElementById('tooltip-name');
            const tooltipDesc = document.getElementById('tooltip-desc');
            const total = SEGMENTS_DATA.length;
            let autoTimer = null;
            let highlightIdx = 0;
            let paused = false;

            /* Render tiap segmen sebagai elemen absolute
               menggunakan posisi x/y dari trigonometri */
            SEGMENTS_DATA.forEach((seg, i) => {
                // Sudut: mulai dari atas (−90°), searah jarum jam
                const angleDeg = (i / total) * 360 - 90;
                const angleRad = (angleDeg * Math.PI) / 180;

                // Radius dalam persen relatif terhadap wrapper (inset 10%)
                // Kita letakkan ikon pada ~42% dari center (antara center dan tepi)
                const r = 42; // persen
                const cx = 50 + r * Math.cos(angleRad);
                const cy = 50 + r * Math.sin(angleRad);

                const el = document.createElement('div');
                el.className = 'absolute flex flex-col items-center cursor-pointer group';
                el.dataset.index = i;
                el.style.cssText = `
            left: ${cx}%;
            top:  ${cy}%;
            transform: translate(-50%, -50%);
            transition: transform 0.3s ease;
            z-index: 10;
        `;

                el.innerHTML = `
            <div class="seg-icon w-11 h-11 md:w-14 md:h-14 rounded-2xl flex items-center justify-center
                        bg-white/10 backdrop-blur border border-white/10
                        transition-all duration-300 shadow-lg mb-1.5">
                <span class="text-xl md:text-2xl select-none">${seg.icon}</span>
            </div>
            <p class="segment-label text-[9px] md:text-[11px] font-semibold text-white text-center
                      leading-tight max-w-[68px] md:max-w-[80px] drop-shadow">${seg.name}</p>
            <div class="seg-dot w-1.5 h-1.5 bg-yellow-400 rounded-full mt-1 opacity-0 transition-opacity duration-300 animate-pulse-slow"></div>
        `;

                /* Hover — show tooltip at cursor position */
                el.addEventListener('mouseenter', (e) => {
                    paused = true;
                    highlightEl(i);

                    tooltipName.textContent = seg.name;
                    tooltipDesc.textContent = seg.description;
                    tooltip.style.display = 'block';
                    positionTooltip(e);
                });

                el.addEventListener('mousemove', positionTooltip);

                el.addEventListener('mouseleave', () => {
                    paused = false;
                    tooltip.style.display = 'none';
                });

                /* Click — open Alpine modal */
                el.addEventListener('click', () => {
                    // Dispatch event yang ditangkap Alpine
                    window.dispatchEvent(new CustomEvent('open-modal', {
                        detail: {
                            index: i
                        }
                    }));
                });

                /* Staggered reveal */
                el.style.opacity = '0';
                el.style.transform = 'translate(-50%, -50%) scale(0.5)';
                setTimeout(() => {
                    el.style.transition =
                        'opacity 0.5s ease, transform 0.5s cubic-bezier(0.34,1.56,0.64,1)';
                    el.style.opacity = '1';
                    el.style.transform = 'translate(-50%, -50%) scale(1)';
                }, 900 + i * 100);

                container.appendChild(el);
            });

            /* Position tooltip tepat di atas kursor */
            function positionTooltip(e) {
                tooltip.style.left = e.clientX + 'px';
                tooltip.style.top = (e.clientY - 14) + 'px';
            }

            /* Highlight segmen aktif */
            function highlightEl(idx) {
                document.querySelectorAll('#segments-container > div').forEach((el, i) => {
                    const icon = el.querySelector('.seg-icon');
                    const dot = el.querySelector('.seg-dot');
                    if (i === idx) {
                        icon.classList.add('bg-yellow-400/25', 'border-yellow-400/50',
                            'shadow-yellow-400/40');
                        icon.style.boxShadow = '0 0 18px rgba(251,191,36,0.5)';
                        icon.style.transform = 'scale(1.18)';
                        el.querySelector('p').style.color = '#fbbf24';
                        dot.style.opacity = '1';
                    } else {
                        icon.classList.remove('bg-yellow-400/25', 'border-yellow-400/50',
                            'shadow-yellow-400/40');
                        icon.style.boxShadow = '';
                        icon.style.transform = '';
                        el.querySelector('p').style.color = '';
                        dot.style.opacity = '0';
                    }
                });
            }

            /* Auto-rotate highlight */
            autoTimer = setInterval(() => {
                if (!paused) {
                    highlightIdx = (highlightIdx + 1) % total;
                    highlightEl(highlightIdx);
                }
            }, 1800);
        });

        /* ── Alpine component ── */
        function assetManagement() {
            return {
                activeSegment: null,

                segments: SEGMENTS_DATA,

                init() {
                    // Dengarkan event dari vanilla JS segment click
                    window.addEventListener('open-modal', (e) => {
                        this.openModal(e.detail.index);
                    });
                },

                openModal(index) {
                    this.activeSegment = index;
                    document.body.style.overflow = 'hidden';
                },
                closeModal() {
                    this.activeSegment = null;
                    document.body.style.overflow = '';
                },
                openLogin() {
                    window.location.href = '{{ route('login') }}';
                }
            };
        }
    </script>
</body>

</html>
