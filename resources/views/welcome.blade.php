<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
        }
        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }
        @keyframes pulse-slow {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        .animate-fadeInUp {
            animation: fadeInUp 0.8s ease-out forwards;
        }
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        .animate-rotate {
            animation: rotate 20s linear infinite;
        }
        .animate-pulse-slow {
            animation: pulse-slow 3s ease-in-out infinite;
        }
        .animate-slideInRight {
            animation: slideInRight 0.6s ease-out forwards;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #0a1f44 0%, #1a3a6e 50%, #0a1f44 100%);
        }
        .cycle-segment {
            transition: all 0.3s ease;
        }
        .cycle-segment:hover {
            transform: scale(1.05);
            filter: brightness(1.2);
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .text-shadow {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        .glow {
            box-shadow: 0 0 20px rgba(251, 191, 36, 0.3);
        }
        /* Perbaikan untuk responsiveness */
        @media (max-width: 768px) {
            .cycle-segment {
                font-size: 0.7rem;
            }
        }
    </style>
</head>
<body class="gradient-bg min-h-screen overflow-x-hidden">
    <div x-data="assetManagement()" class="relative">
        <!-- Background Decorative Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-20 left-10 w-72 h-72 bg-blue-500/10 rounded-full blur-3xl animate-pulse-slow"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-yellow-500/10 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 1s;"></div>
        </div>
        <!-- Hero Section -->
        <section class="relative z-10 py-4 md:py-4 px-4">
            <div class="container mx-auto text-center">
                <div x-show="true" x-transition:enter="animate-fadeInUp" style="animation-delay: 0.2s;">
                    <h2 class="text-4xl md:text-5xl font-bold text-white mb-6 text-shadow">
                        Digitalisasi Aset BMN
                    </h2>
                    {{-- <p class="text-xl md:text-2xl text-gray-300 mb-4 max-w-3xl mx-auto">
                        Biro Manajemen BMN dan Pengadaan
                    </p>
                    <p class="text-gray-400 max-w-2xl mx-auto mb-8">
                        Informasi Aset Kementerian Keuangan BA 015
                    </p> --}}
                </div>
                <!-- Main Cycle Diagram -->
                <div class="relative max-w-5xl mx-auto my-0" x-show="true" x-transition:enter="animate-fadeInUp" style="animation-delay: 0.4s;">
                    <!-- Center Circle -->
                    <div class="relative mx-auto w-full aspect-square max-w-2xl">
                        <!-- Outer Ring with Integration Label -->
                        <div class="absolute inset-12 flex items-center justify-center">
                            <div class="w-full h-full rounded-full border-2 border-yellow-400/30 animate-pulse-slow"></div>
                        </div>
                        <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 glass-effect px-6 py-2 rounded-full">
                            <span class="text-yellow-400 font-semibold">Informasi Aset BA 015</span>
                        </div>
                        <!-- Cycle Segments Container -->
                        <div class="absolute inset-[10%] rounded-full">
                            <!-- Central Core -->
                            <div class="absolute inset-[30%] rounded-full bg-gradient-to-br from-blue-900 to-blue-950 flex items-center justify-center shadow-2xl border-4 border-yellow-400/20 cursor-pointer hover:shadow-yellow-400/30 transition-all"
                                 @click="window.location.href = '{{ route('login') }}'">
                                <div class="text-center px-4">
                                    <h3 class="text-xl md:text-3xl font-bold text-white mb-2">SIKLUS</h3>
                                    <h4 class="text-lg md:text-2xl font-bold text-yellow-400 mb-1">PENGELOLAAN</h4>
                                    <h4 class="text-lg md:text-2xl font-bold text-yellow-400 mb-1">BMN</h4>
                                </div>
                            </div>
                            <!-- Cycle Segments (10 segments) -->
                            <template x-for="(segment, index) in segments" :key="index">
                                <div
                                    class="absolute inset-0 cycle-segment cursor-pointer"
                                    :style="`transform: rotate(${index * 36}deg);`"
                                    @mouseenter="hoveredSegment = index"
                                    @mouseleave="hoveredSegment = null"
                                    @click="window.location.href = '{{ route('login') }}'"
                                    x-show="true"
                                    x-transition:enter="transition ease-out duration-500"
                                    :style="`animation-delay: ${index * 0.05}s;`">
                                    <div class="absolute top-0 left-1/2 transform -translate-x-1/2 w-24 h-32 origin-bottom">
                                        <div
                                            class="w-full h-full flex items-start justify-center pt-4"
                                            :class="segment.color"
                                            :style="`transform: rotate(-${index * 36}deg);`">
                                            <div class="text-center">
                                                <div class="w-12 h-12 mx-auto mb-2 rounded-lg flex items-center justify-center bg-white/10 backdrop-blur"
                                                     :class="{'glow': hoveredSegment === index}">
                                                    <span x-html="segment.icon" class="text-2xl"></span>
                                                </div>
                                                <p class="text-xs font-semibold text-white text-shadow leading-tight" x-text="segment.name"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer -->
        <footer class="relative z-10 py-4 px-4 mt-2 border-t border-white/10">
            <div class="container mx-auto text-center text-gray-400">
                <p class="font-semibold text-gray-300">&copy; 2026 Kementerian Keuangan Republik Indonesia</p>
                <p class="text-sm mt-2">Powered By Biro Manajemen BMN dan Pengadaan</p>
                <p class="text-sm mt-1 text-yellow-400">www.romadan.kemenkeu.go.id</p>
            </div>
        </footer>
    </div>
    <script>
        function assetManagement() {
            return {
                hoveredSegment: null,
                segments: [
                    { name: 'Perencanaan', icon: '📋', color: 'text-yellow-400' },
                    { name: 'Pengadaan', icon: '🛍️', color: 'text-yellow-400' },
                    { name: 'Penggunaan', icon: '🏢', color: 'text-yellow-400' },
                    { name: 'Pemanfaatan', icon: '🔑', color: 'text-yellow-400' },
                    { name: 'Pengamanan & Pemeliharaan', icon: '🛡️', color: 'text-yellow-400' },
                    { name: 'Penilaian', icon: '📊', color: 'text-yellow-400' },
                    { name: 'Pemindahtanganan', icon: '🔄', color: 'text-yellow-400' },
                    { name: 'Pemusnahan', icon: '🔥', color: 'text-yellow-400' },
                    { name: 'Penghapusan', icon: '🗑️', color: 'text-yellow-400' },
                    { name: 'Penatausahaan', icon: '📁', color: 'text-yellow-400' }
                ]
            }
        }
    </script>
</body>
</html>
