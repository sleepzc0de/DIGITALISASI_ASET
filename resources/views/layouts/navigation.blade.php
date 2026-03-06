{{--
    ╔══════════════════════════════════════════════════════════════╗
    ║  PENTING: Semua variabel PHP didefinisikan di sini PERTAMA  ║
    ║  sebelum <nav> agar bisa dipakai di desktop DAN mobile.     ║
    ║  Jika didefinisikan di dalam blok HTML bersyarat, variabel  ║
    ║  tidak akan tersedia di luar blok tersebut (PHP scope).     ║
    ╚══════════════════════════════════════════════════════════════╝
--}}
@php
    // ── Route active state ───────────────────────────────────────
    $isDashboard = request()->routeIs('dashboard');
    $isKinerja   = request()->routeIs('kinerja');
    $isAplikasi  = request()->routeIs('aplikasi-bmn.*');
    $isManajemen = request()->routeIs('manajemen-bmn.*');

    // ── Manajemen BMN items ──────────────────────────────────────
    // Perhatian: 'bg' dan 'text' ditulis LENGKAP (bukan konkatenasi)
    // agar Tailwind JIT/purge bisa mendeteksi class-nya.
    $manajemenItems = [
        [
            'route' => 'manajemen-bmn.perencanaan.index',
            'label' => 'Perencanaan BMN',
            'desc'  => 'Perencanaan kebutuhan aset',
            'bg'    => 'bg-blue-50',
            'text'  => 'text-blue-600',
            'icon'  => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2',
        ],
        [
            'route' => 'manajemen-bmn.pemanfaatan.index',
            'label' => 'Pemanfaatan BMN',
            'desc'  => 'Penggunaan optimal aset',
            'bg'    => 'bg-green-50',
            'text'  => 'text-green-600',
            'icon'  => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
        ],
        [
            'route' => 'manajemen-bmn.pemindahtanganan.index',
            'label' => 'Pemindahtanganan',
            'desc'  => 'Alih kelola aset',
            'bg'    => 'bg-yellow-50',
            'text'  => 'text-yellow-600',
            'icon'  => 'M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z',
        ],
        [
            'route' => 'manajemen-bmn.penghapusan.index',
            'label' => 'Penghapusan BMN',
            'desc'  => 'Penghapusan aset',
            'bg'    => 'bg-red-50',
            'text'  => 'text-red-600',
            'icon'  => 'M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16',
        ],
        [
            'route' => 'manajemen-bmn.penatausahaan.index',
            'label' => 'Penatausahaan BMN',
            'desc'  => 'Administrasi aset',
            'bg'    => 'bg-indigo-50',
            'text'  => 'text-indigo-600',
            'icon'  => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
        ],
        [
            'route' => 'manajemen-bmn.wasdal.index',
            'label' => 'Wasdal BMN',
            'desc'  => 'Pengawasan dan pengendalian',
            'bg'    => 'bg-purple-50',
            'text'  => 'text-purple-600',
            'icon'  => 'M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z',
        ],
    ];

    // ── Admin main menu items ────────────────────────────────────
    $adminMainItems = [
        [
            'route' => 'admin.dashboard-aset.index',
            'label' => 'Kelola Aset',
            'desc'  => 'Manajemen data aset',
            'bg'    => 'bg-blue-100',
            'text'  => 'text-blue-600',
            'icon'  => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4',
        ],
        [
            'route' => 'admin.kinerja-bmn.index',
            'label' => 'Kelola Kinerja',
            'desc'  => 'Analisis kinerja BMN',
            'bg'    => 'bg-green-100',
            'text'  => 'text-green-600',
            'icon'  => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
        ],
        [
            'route' => 'admin.aplikasi-bmn.index',
            'label' => 'Kelola Aplikasi',
            'desc'  => 'Manajemen aplikasi BMN',
            'bg'    => 'bg-indigo-100',
            'text'  => 'text-indigo-600',
            'icon'  => 'M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z',
        ],
        [
            'route' => 'admin.users.index',
            'label' => 'Kelola User',
            'desc'  => 'Manajemen pengguna',
            'bg'    => 'bg-pink-100',
            'text'  => 'text-pink-600',
            'icon'  => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z',
        ],
    ];

    // ── Admin Manajemen BMN sub-items ────────────────────────────
    $adminManajemenItems = [
        ['route' => 'admin.manajemen-bmn.perencanaan.index',     'label' => 'Perencanaan'],
        ['route' => 'admin.manajemen-bmn.pemanfaatan.index',     'label' => 'Pemanfaatan'],
        ['route' => 'admin.manajemen-bmn.pemindahtanganan.index','label' => 'Pemindahtanganan'],
        ['route' => 'admin.manajemen-bmn.penghapusan.index',     'label' => 'Penghapusan'],
        ['route' => 'admin.manajemen-bmn.penatausahaan.index',   'label' => 'Penatausahaan'],
        ['route' => 'admin.manajemen-bmn.wasdal.index',          'label' => 'Wasdal'],
    ];
@endphp

{{--
    ╔══════════════════════════════════════════════════════════════════╗
    ║  Alpine.js x-data: SATU scope terpusat di <nav>                ║
    ║                                                                  ║
    ║  Kenapa satu scope?                                              ║
    ║  - Mencegah child x-data mem-shadow variabel parent             ║
    ║  - @keydown.escape.window bisa tutup SEMUA dropdown sekaligus   ║
    ║  - Lebih mudah debug dan maintain                               ║
    ║                                                                  ║
    ║  Variabel:                                                       ║
    ║  - open          : mobile menu                                   ║
    ║  - manajemenOpen : dropdown Manajemen BMN (desktop)             ║
    ║  - adminOpen     : dropdown Administrator (desktop)             ║
    ║  - userOpen      : dropdown user profile (desktop)              ║
    ╚══════════════════════════════════════════════════════════════════╝
--}}
<nav x-data="{
        open: false,
        manajemenOpen: false,
        adminOpen: false,
        userOpen: false,
        closeAllDropdowns() {
            this.manajemenOpen = false;
            this.adminOpen     = false;
            this.userOpen      = false;
        }
     }"
     @keydown.escape.window="open = false; closeAllDropdowns()"
     class="sticky top-0 z-40 bg-white/95 backdrop-blur-md
            shadow-md shadow-blue-100/40 border-b border-gray-200/80"
     role="navigation"
     aria-label="Navigasi utama">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            {{-- ════════════════ LOGO ════════════════ --}}
            <div class="flex items-center gap-6">

                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3 group rounded-xl
                          focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                   aria-label="Digitalisasi Aset - Beranda">
                    <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-blue-600 to-purple-600
                                flex items-center justify-center shadow-md shadow-blue-500/25
                                group-hover:shadow-lg group-hover:shadow-blue-500/40
                                transition-shadow duration-200">
                        <i class="fas fa-chart-bar text-white" aria-hidden="true"></i>
                    </div>
                    <div class="hidden sm:block leading-tight">
                        <span class="block text-base font-bold bg-gradient-to-r from-blue-600
                                     to-purple-600 bg-clip-text text-transparent">
                            Digitalisasi Aset
                        </span>
                        <span class="block text-xs text-gray-500">Kementerian Keuangan RI</span>
                    </div>
                </a>

                {{-- ════════════════ DESKTOP NAV ════════════════ --}}
                <div class="hidden lg:flex items-center gap-1">

                    {{-- Dashboard --}}
                    <a href="{{ route('dashboard') }}"
                       aria-current="{{ $isDashboard ? 'page' : 'false' }}"
                       class="flex items-center gap-2 px-3 py-2 rounded-xl text-sm font-medium
                              transition-all duration-200
                              {{ $isDashboard
                                 ? 'bg-blue-50 text-blue-700 shadow-sm'
                                 : 'text-gray-600 hover:bg-blue-50 hover:text-blue-700' }}">
                        <div class="w-7 h-7 rounded-lg flex items-center justify-center transition-colors
                                    {{ $isDashboard ? 'bg-blue-100' : 'bg-gray-100' }}">
                            <svg class="w-4 h-4 {{ $isDashboard ? 'text-blue-600' : 'text-gray-400' }}"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                        </div>
                        Dashboard
                    </a>

                    {{-- Kinerja BMN --}}
                    <a href="{{ route('kinerja') }}"
                       aria-current="{{ $isKinerja ? 'page' : 'false' }}"
                       class="flex items-center gap-2 px-3 py-2 rounded-xl text-sm font-medium
                              transition-all duration-200
                              {{ $isKinerja
                                 ? 'bg-green-50 text-green-700 shadow-sm'
                                 : 'text-gray-600 hover:bg-green-50 hover:text-green-700' }}">
                        <div class="w-7 h-7 rounded-lg flex items-center justify-center transition-colors
                                    {{ $isKinerja ? 'bg-green-100' : 'bg-gray-100' }}">
                            <svg class="w-4 h-4 {{ $isKinerja ? 'text-green-600' : 'text-gray-400' }}"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        Kinerja BMN
                    </a>

                    {{-- Aplikasi BMN --}}
                    <a href="{{ route('aplikasi-bmn.index') }}"
                       aria-current="{{ $isAplikasi ? 'page' : 'false' }}"
                       class="flex items-center gap-2 px-3 py-2 rounded-xl text-sm font-medium
                              transition-all duration-200
                              {{ $isAplikasi
                                 ? 'bg-indigo-50 text-indigo-700 shadow-sm'
                                 : 'text-gray-600 hover:bg-indigo-50 hover:text-indigo-700' }}">
                        <div class="w-7 h-7 rounded-lg flex items-center justify-center transition-colors
                                    {{ $isAplikasi ? 'bg-indigo-100' : 'bg-gray-100' }}">
                            <svg class="w-4 h-4 {{ $isAplikasi ? 'text-indigo-600' : 'text-gray-400' }}"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                            </svg>
                        </div>
                        Aplikasi BMN
                    </a>

                    {{-- ── Manajemen BMN Dropdown ── --}}
                    {{--
                        TIDAK ada x-data di sini — pakai variabel dari parent <nav>.
                        @mouseenter/@mouseleave untuk hover UX desktop.
                        @click untuk toggle via keyboard / touch.
                        Keduanya tidak konflik karena memanipulasi variabel yang sama.
                    --}}
                    <div class="relative"
                         @mouseenter="manajemenOpen = true"
                         @mouseleave="manajemenOpen = false">

                        <button @click="manajemenOpen = !manajemenOpen"
                                :aria-expanded="manajemenOpen"
                                aria-haspopup="menu"
                                class="flex items-center gap-2 px-3 py-2 rounded-xl text-sm font-medium
                                       transition-all duration-200
                                       {{ $isManajemen
                                          ? 'bg-purple-50 text-purple-700 shadow-sm'
                                          : 'text-gray-600 hover:bg-purple-50 hover:text-purple-700' }}
                                       focus:outline-none focus:ring-2 focus:ring-purple-400
                                       focus:ring-offset-1">
                            <div class="w-7 h-7 rounded-lg flex items-center justify-center transition-colors
                                        {{ $isManajemen ? 'bg-purple-100' : 'bg-gray-100' }}">
                                <svg class="w-4 h-4 {{ $isManajemen ? 'text-purple-600' : 'text-gray-400' }}"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                            </div>
                            Manajemen BMN
                            <svg class="w-3.5 h-3.5 text-gray-400 transition-transform duration-200"
                                 :class="{ 'rotate-180': manajemenOpen }"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="manajemenOpen"
                             x-cloak
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 translate-y-1"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-1"
                             class="absolute left-0 top-full mt-1 w-72 bg-white rounded-2xl
                                    shadow-xl border border-gray-100 py-2 z-50"
                             role="menu"
                             aria-label="Menu Manajemen BMN">

                            <div class="px-4 py-2 mb-1">
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest">
                                    Manajemen BMN
                                </p>
                            </div>

                            @foreach ($manajemenItems as $item)
                                <a href="{{ route($item['route']) }}"
                                   class="flex items-center gap-3 px-4 py-2.5
                                          hover:bg-gray-50 transition-colors group/item"
                                   role="menuitem">
                                    <div class="w-8 h-8 rounded-lg {{ $item['bg'] }}
                                                flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4 {{ $item['text'] }}"
                                             fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                             aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  stroke-width="2" d="{{ $item['icon'] }}"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-800
                                                  group-hover/item:text-gray-900">
                                            {{ $item['label'] }}
                                        </p>
                                        <p class="text-xs text-gray-400">{{ $item['desc'] }}</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    {{-- ── Admin Dropdown ── --}}
                    @if (auth()->user()->isAdmin())
                        <div class="relative"
                             @mouseenter="adminOpen = true"
                             @mouseleave="adminOpen = false">

                            <button @click="adminOpen = !adminOpen"
                                    :aria-expanded="adminOpen"
                                    aria-haspopup="menu"
                                    class="flex items-center gap-2 px-3 py-2 rounded-xl text-sm
                                           font-medium transition-all duration-200 text-gray-600
                                           hover:bg-orange-50 hover:text-orange-700
                                           focus:outline-none focus:ring-2 focus:ring-orange-400
                                           focus:ring-offset-1">
                                <div class="w-7 h-7 rounded-lg bg-gray-100 flex items-center
                                            justify-center transition-colors">
                                    <svg class="w-4 h-4 text-gray-400"
                                         fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                         aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                Administrator
                                <svg class="w-3.5 h-3.5 text-gray-400 transition-transform duration-200"
                                     :class="{ 'rotate-180': adminOpen }"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            <div x-show="adminOpen"
                                 x-cloak
                                 x-transition:enter="transition ease-out duration-150"
                                 x-transition:enter-start="opacity-0 translate-y-1"
                                 x-transition:enter-end="opacity-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-100"
                                 x-transition:leave-start="opacity-100 translate-y-0"
                                 x-transition:leave-end="opacity-0 translate-y-1"
                                 class="absolute left-0 top-full mt-1 w-72 bg-white rounded-2xl
                                        shadow-xl border border-gray-100 py-2 z-50"
                                 role="menu"
                                 aria-label="Panel Administrator">

                                <div class="px-4 py-2 mb-1">
                                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest">
                                        Panel Admin
                                    </p>
                                </div>

                                @foreach ($adminMainItems as $item)
                                    <a href="{{ route($item['route']) }}"
                                       class="flex items-center gap-3 px-4 py-2.5
                                              hover:bg-gray-50 transition-colors group/item"
                                       role="menuitem">
                                        <div class="w-8 h-8 rounded-lg {{ $item['bg'] }}
                                                    flex items-center justify-center flex-shrink-0">
                                            <svg class="w-4 h-4 {{ $item['text'] }}"
                                                 fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                 aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      stroke-width="2" d="{{ $item['icon'] }}"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-800
                                                      group-hover/item:text-gray-900">
                                                {{ $item['label'] }}
                                            </p>
                                            <p class="text-xs text-gray-400">{{ $item['desc'] }}</p>
                                        </div>
                                    </a>
                                @endforeach

                                <div class="border-t border-gray-100 mt-2 pt-2 px-4 pb-2">
                                    <p class="text-xs font-semibold text-gray-400 uppercase
                                              tracking-widest py-2">
                                        Kelola Manajemen BMN
                                    </p>
                                    <div class="grid grid-cols-2 gap-1">
                                        @foreach ($adminManajemenItems as $item)
                                            <a href="{{ route($item['route']) }}"
                                               class="px-3 py-2 text-xs text-gray-600 hover:bg-gray-50
                                                      hover:text-gray-900 rounded-lg transition-colors
                                                      text-center"
                                               role="menuitem">
                                                {{ $item['label'] }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>

            {{-- ════════════════ RIGHT: USER AREA ════════════════ --}}
            <div class="hidden lg:flex items-center gap-3">

                {{-- Notification Bell --}}
                <button type="button"
                        class="relative h-9 w-9 rounded-full bg-gray-100 hover:bg-gray-200
                               flex items-center justify-center transition-colors
                               focus:outline-none focus:ring-2 focus:ring-blue-500
                               focus:ring-offset-2"
                        aria-label="Notifikasi">
                    <svg class="w-5 h-5 text-gray-600"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    <span class="absolute top-1.5 right-1.5 h-2 w-2 bg-red-500 rounded-full"
                          aria-hidden="true"></span>
                    <span class="sr-only">Ada notifikasi baru</span>
                </button>

                {{-- ── User Dropdown ── --}}
                {{--
                    @click.outside menutup dropdown saat klik di luar.
                    Tidak pakai @mouseenter/@mouseleave di sini karena
                    user dropdown lebih natural dibuka dengan klik.
                --}}
                <div class="relative" @click.outside="userOpen = false">
                    <button @click="userOpen = !userOpen"
                            :aria-expanded="userOpen"
                            aria-haspopup="menu"
                            class="flex items-center gap-2 px-2 py-1.5 rounded-xl
                                   hover:bg-gray-50 transition-colors
                                   focus:outline-none focus:ring-2 focus:ring-blue-500
                                   focus:ring-offset-2">
                        <div class="h-8 w-8 rounded-full bg-gradient-to-br from-blue-500 to-purple-600
                                    flex items-center justify-center shadow-sm flex-shrink-0">
                            <span class="text-white text-sm font-bold leading-none">
                                {{ strtoupper(mb_substr(Auth::user()->name, 0, 1, 'UTF-8')) }}
                            </span>
                        </div>
                        <div class="hidden xl:block text-left" style="max-width:130px">
                            <p class="text-sm font-semibold text-gray-900 truncate leading-tight">
                                {{ Auth::user()->name }}
                            </p>
                            <p class="text-xs text-gray-500 truncate leading-tight">
                                {{ Auth::user()->email }}
                            </p>
                        </div>
                        <svg class="w-3.5 h-3.5 text-gray-400 transition-transform duration-200"
                             :class="{ 'rotate-180': userOpen }"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div x-show="userOpen"
                         x-cloak
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-1"
                         class="absolute right-0 top-full mt-1 w-60 bg-white rounded-2xl
                                shadow-xl border border-gray-100 py-2 z-50"
                         role="menu"
                         aria-label="Menu pengguna">

                        {{-- User info --}}
                        <div class="px-4 py-3 border-b border-gray-100">
                            <p class="text-sm font-semibold text-gray-900 truncate">
                                {{ Auth::user()->name }}
                            </p>
                            <p class="text-xs text-gray-500 truncate mt-0.5">
                                {{ Auth::user()->email }}
                            </p>
                            {{-- Role badge --}}
                            @if (Auth::user()->isSuperAdmin())
                                <span class="inline-flex items-center gap-1 mt-1.5 px-2 py-0.5
                                             rounded-full text-xs font-medium
                                             bg-purple-100 text-purple-700">
                                    <i class="fas fa-shield-alt text-xs" aria-hidden="true"></i>
                                    Super Admin
                                </span>
                            @elseif (Auth::user()->isAdmin())
                                <span class="inline-flex items-center gap-1 mt-1.5 px-2 py-0.5
                                             rounded-full text-xs font-medium
                                             bg-orange-100 text-orange-700">
                                    <i class="fas fa-user-cog text-xs" aria-hidden="true"></i>
                                    Admin
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 mt-1.5 px-2 py-0.5
                                             rounded-full text-xs font-medium
                                             bg-blue-100 text-blue-700">
                                    <i class="fas fa-user text-xs" aria-hidden="true"></i>
                                    Pengguna
                                </span>
                            @endif
                        </div>

                        <a href="{{ route('profile.edit') }}"
                           class="flex items-center gap-3 px-4 py-2.5 hover:bg-gray-50 transition-colors"
                           role="menuitem">
                            <div class="w-7 h-7 rounded-lg bg-blue-100 flex items-center
                                        justify-center flex-shrink-0">
                                <svg class="w-3.5 h-3.5 text-blue-600"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <span class="text-sm text-gray-700">Profil Saya</span>
                        </a>

                        <div class="border-t border-gray-100 mt-1 pt-1">
                            {{-- SSO-aware logout --}}
                            <form method="POST"
                                  action="{{ auth()->user()->isSSOUser()
                                             ? route('sso.logout')
                                             : route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="flex items-center gap-3 px-4 py-2.5 w-full text-left
                                               hover:bg-red-50 transition-colors"
                                        role="menuitem">
                                    <div class="w-7 h-7 rounded-lg bg-red-100 flex items-center
                                                justify-center flex-shrink-0">
                                        <svg class="w-3.5 h-3.5 text-red-600"
                                             fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                             aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                        </svg>
                                    </div>
                                    <span class="text-sm font-medium text-red-600">Keluar</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ════════════════ HAMBURGER (Mobile) ════════════════ --}}
            <div class="lg:hidden">
                <button @click="open = !open; closeAllDropdowns()"
                        :aria-expanded="open"
                        aria-controls="mobile-menu"
                        class="h-9 w-9 rounded-lg bg-gray-100 flex items-center justify-center
                               hover:bg-gray-200 transition-colors
                               focus:outline-none focus:ring-2 focus:ring-blue-500
                               focus:ring-offset-2"
                        aria-label="Toggle menu navigasi">
                    {{-- Ikon hamburger & close dengan x-cloak agar tidak FOUC --}}
                    <svg x-show="!open"
                         class="w-5 h-5 text-gray-600"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="open"
                         x-cloak
                         class="w-5 h-5 text-gray-600"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

        </div>
    </div>

    {{-- ════════════════ MOBILE MENU ════════════════ --}}
    <div id="mobile-menu"
         x-show="open"
         x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="lg:hidden bg-white border-t border-gray-100 shadow-xl
                max-h-[80vh] overflow-y-auto overscroll-contain">

        <div class="px-4 pt-3 pb-2 space-y-1">

            {{-- Main links --}}
            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-3 px-3 py-3 rounded-xl transition-colors
                      {{ $isDashboard
                         ? 'bg-blue-50 text-blue-700'
                         : 'text-gray-700 hover:bg-blue-50 hover:text-blue-700' }}">
                <div class="w-9 h-9 rounded-xl bg-blue-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-blue-600"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold">Dashboard Aset</p>
                    <p class="text-xs text-gray-500">Overview aset BMN</p>
                </div>
            </a>

            <a href="{{ route('kinerja') }}"
               class="flex items-center gap-3 px-3 py-3 rounded-xl transition-colors
                      {{ $isKinerja
                         ? 'bg-green-50 text-green-700'
                         : 'text-gray-700 hover:bg-green-50 hover:text-green-700' }}">
                <div class="w-9 h-9 rounded-xl bg-green-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-green-600"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold">Kinerja BMN</p>
                    <p class="text-xs text-gray-500">Analisis performa</p>
                </div>
            </a>

            <a href="{{ route('aplikasi-bmn.index') }}"
               class="flex items-center gap-3 px-3 py-3 rounded-xl transition-colors
                      {{ $isAplikasi
                         ? 'bg-indigo-50 text-indigo-700'
                         : 'text-gray-700 hover:bg-indigo-50 hover:text-indigo-700' }}">
                <div class="w-9 h-9 rounded-xl bg-indigo-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-indigo-600"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold">Aplikasi BMN</p>
                    <p class="text-xs text-gray-500">Daftar aplikasi BMN</p>
                </div>
            </a>

            {{-- Manajemen BMN Mobile --}}
            <div class="border-t border-gray-100 pt-3">
                <p class="px-3 pb-2 text-xs font-semibold text-gray-400 uppercase tracking-widest">
                    Manajemen BMN
                </p>
                <div class="grid grid-cols-2 gap-1.5">
                    @foreach ($manajemenItems as $item)
                        <a href="{{ route($item['route']) }}"
                           class="flex items-center gap-2 px-3 py-2.5 rounded-xl text-xs font-medium
                                  text-gray-700 border border-gray-100 hover:bg-gray-50
                                  hover:text-gray-900 transition-colors">
                            <div class="w-5 h-5 rounded-md {{ $item['bg'] }}
                                        flex items-center justify-center flex-shrink-0">
                                <svg class="w-3 h-3 {{ $item['text'] }}"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2" d="{{ $item['icon'] }}"/>
                                </svg>
                            </div>
                            <span class="truncate">{{ $item['label'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Admin Panel Mobile --}}
            @if (auth()->user()->isAdmin())
                <div class="border-t border-gray-100 pt-3">
                    <p class="px-3 pb-2 text-xs font-semibold text-gray-400 uppercase tracking-widest">
                        Panel Admin
                    </p>
                    @foreach ($adminMainItems as $item)
                        <a href="{{ route($item['route']) }}"
                           class="flex items-center gap-3 px-3 py-3 rounded-xl text-gray-700
                                  hover:bg-orange-50 hover:text-orange-700 transition-colors">
                            <div class="w-9 h-9 rounded-xl {{ $item['bg'] }}
                                        flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 {{ $item['text'] }}"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2" d="{{ $item['icon'] }}"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold">{{ $item['label'] }}</p>
                                <p class="text-xs text-gray-500">{{ $item['desc'] }}</p>
                            </div>
                        </a>
                    @endforeach

                    <div class="mt-2 px-1">
                        <p class="px-2 pb-2 text-xs font-semibold text-gray-400 uppercase tracking-widest">
                            Kelola Manajemen BMN
                        </p>
                        <div class="grid grid-cols-3 gap-1">
                            @foreach ($adminManajemenItems as $item)
                                <a href="{{ route($item['route']) }}"
                                   class="px-2 py-2 text-xs text-center text-gray-600
                                          rounded-lg border border-gray-100 hover:bg-gray-50
                                          hover:text-gray-900 transition-colors">
                                    {{ $item['label'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>

        {{-- Mobile User Footer --}}
        <div class="border-t border-gray-100 px-4 py-4 bg-gray-50">
            <div class="flex items-center gap-3 mb-3">
                <div class="h-11 w-11 rounded-full bg-gradient-to-br from-blue-500 to-purple-600
                            flex items-center justify-center shadow-sm flex-shrink-0">
                    <span class="text-white font-bold text-base leading-none">
                        {{ strtoupper(mb_substr(Auth::user()->name, 0, 1, 'UTF-8')) }}
                    </span>
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-semibold text-gray-900 truncate">
                        {{ Auth::user()->name }}
                    </p>
                    <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                </div>
            </div>

            <div class="space-y-1">
                <a href="{{ route('profile.edit') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl
                          hover:bg-white transition-colors text-gray-700">
                    <svg class="w-5 h-5 text-blue-500 flex-shrink-0"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span class="text-sm font-medium">Profil Saya</span>
                </a>

                {{-- SSO-aware logout --}}
                <form method="POST"
                      action="{{ auth()->user()->isSSOUser()
                                 ? route('sso.logout')
                                 : route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-xl
                                   hover:bg-red-50 text-red-600 w-full transition-colors">
                        <svg class="w-5 h-5 flex-shrink-0"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span class="text-sm font-medium">Keluar</span>
                    </button>
                </form>
            </div>
        </div>

    </div>
</nav>
