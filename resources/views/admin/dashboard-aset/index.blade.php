<x-app-layout>
    <x-slot name="header">
        {{-- Breadcrumb --}}
        <nav aria-label="Breadcrumb" class="mb-3">
            <ol class="flex items-center gap-1.5 text-xs text-gray-500">
                <li>
                    <a href="{{ route('dashboard') }}"
                       class="flex items-center gap-1 hover:text-blue-600 transition-colors">
                        <i class="fas fa-home text-[10px]" aria-hidden="true"></i>
                        Dashboard
                    </a>
                </li>
                <li aria-hidden="true">
                    <i class="fas fa-chevron-right text-[9px] text-gray-300"></i>
                </li>
                <li>
                    <span class="font-medium text-gray-700" aria-current="page">
                        Manajemen Aset
                    </span>
                </li>
            </ol>
        </nav>

        <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
            <div class="flex items-start gap-3 min-w-0">
                <div class="flex-shrink-0 h-11 w-11 rounded-xl
                            bg-gradient-to-br from-blue-500 to-blue-700
                            flex items-center justify-center shadow-md shadow-blue-200">
                    <i class="fas fa-boxes text-white text-lg" aria-hidden="true"></i>
                </div>
                <div class="min-w-0">
                    <h2 class="text-xl font-bold text-gray-900 leading-tight">
                        Manajemen Data Aset
                    </h2>
                    <p class="mt-0.5 text-sm text-gray-500">
                        Kelola dan pantau seluruh data aset BMN secara terpusat
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-2 flex-shrink-0">
                <form method="GET" action="{{ route('admin.dashboard-aset.index') }}"
                      role="search" class="relative">
                    <label for="headerSearch" class="sr-only">Cari aset</label>
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400 text-xs" aria-hidden="true"></i>
                    </div>
                    <input id="headerSearch" type="search" name="search"
                           value="{{ request('search') }}"
                           placeholder="Cari aset…" autocomplete="off"
                           class="w-48 sm:w-56 pl-9 pr-4 py-2.5 text-sm bg-white
                                  border border-gray-300 rounded-xl shadow-sm
                                  placeholder-gray-400 text-gray-900
                                  focus:outline-none focus:ring-2 focus:ring-blue-500
                                  focus:border-blue-500 transition-all duration-200">
                    @if(request('kondisi'))
                        <input type="hidden" name="kondisi" value="{{ request('kondisi') }}">
                    @endif
                    @if(request('sort'))
                        <input type="hidden" name="sort" value="{{ request('sort') }}">
                        <input type="hidden" name="dir"  value="{{ request('dir', 'desc') }}">
                    @endif
                </form>
                <a href="{{ route('admin.dashboard-aset.create') }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5
                          bg-gradient-to-r from-blue-600 to-blue-700
                          hover:from-blue-700 hover:to-blue-800
                          text-white text-sm font-semibold rounded-xl
                          shadow-md shadow-blue-200 hover:shadow-lg hover:shadow-blue-300
                          transition-all duration-200 focus:outline-none
                          focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 whitespace-nowrap">
                    <i class="fas fa-plus text-xs" aria-hidden="true"></i>
                    Tambah Aset
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- ══════════════════════════════════════════════════════
                 SUMMARY STATS CARDS
            ══════════════════════════════════════════════════════ --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">

                {{-- Total Aset --}}
                <div class="group relative bg-white rounded-2xl border border-gray-100
                            shadow-sm hover:shadow-lg transition-all duration-300
                            overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-transparent
                                opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                    <div class="relative p-5">
                        <div class="flex items-start justify-between">
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-semibold text-gray-400 uppercase
                                          tracking-widest mb-1">
                                    Total Aset
                                </p>
                                <p class="text-3xl font-black text-gray-900 leading-none">
                                    {{ number_format($stats->total_aset ?? 0) }}
                                </p>
                                <p class="mt-2 text-xs text-gray-500 flex items-center gap-1">
                                    <i class="fas fa-layer-group text-blue-400"
                                       aria-hidden="true"></i>
                                    {{ $asets->lastPage() }} halaman data
                                </p>
                            </div>
                            <div class="flex-shrink-0 h-12 w-12 rounded-2xl
                                        bg-gradient-to-br from-blue-400 to-blue-600
                                        flex items-center justify-center
                                        shadow-md shadow-blue-200
                                        group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-boxes text-white text-lg"
                                   aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-gray-400">Halaman aktif</span>
                                <span class="font-semibold text-blue-600">
                                    #{{ $asets->currentPage() }} / {{ $asets->lastPage() }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Total Nilai Buku --}}
                <div class="group relative bg-white rounded-2xl border border-gray-100
                            shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-50 to-transparent
                                opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                    <div class="relative p-5">
                        <div class="flex items-start justify-between">
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-semibold text-gray-400 uppercase
                                          tracking-widest mb-1">
                                    Total Nilai Buku
                                </p>
                                <p class="text-2xl font-black text-gray-900 leading-none">
                                    Rp {{ number_format(($stats->total_nilai_buku ?? 0) / 1_000_000_000, 2) }}
                                    <span class="text-lg text-emerald-600">M</span>
                                </p>
                                <p class="mt-2 text-xs text-gray-500 flex items-center gap-1">
                                    <i class="fas fa-calculator text-emerald-400"
                                       aria-hidden="true"></i>
                                    Rata-rata Rp {{ number_format($stats->avg_nilai_buku ?? 0) }}
                                </p>
                            </div>
                            <div class="flex-shrink-0 h-12 w-12 rounded-2xl
                                        bg-gradient-to-br from-emerald-400 to-emerald-600
                                        flex items-center justify-center shadow-md shadow-emerald-200
                                        group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-money-bill-wave text-white text-lg"
                                   aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-gray-400">Nilai perolehan</span>
                                <span class="font-semibold text-emerald-600">
                                    Rp {{ number_format(($stats->total_nilai_perolehan ?? 0) / 1_000_000_000, 2) }}M
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Kategori --}}
                <div class="group relative bg-white rounded-2xl border border-gray-100
                            shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-violet-50 to-transparent
                                opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                    <div class="relative p-5">
                        <div class="flex items-start justify-between">
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-semibold text-gray-400 uppercase
                                          tracking-widest mb-1">
                                    Kategori
                                </p>
                                <p class="text-3xl font-black text-gray-900 leading-none">
                                    {{ number_format($stats->total_kategori ?? 0) }}
                                </p>
                                <p class="mt-2 text-xs text-gray-500 flex items-center gap-1">
                                    <i class="fas fa-map-marker-alt text-violet-400"
                                       aria-hidden="true"></i>
                                    {{ $stats->total_lokasi ?? 0 }} lokasi berbeda
                                </p>
                            </div>
                            <div class="flex-shrink-0 h-12 w-12 rounded-2xl
                                        bg-gradient-to-br from-violet-400 to-violet-600
                                        flex items-center justify-center shadow-md shadow-violet-200
                                        group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-layer-group text-white text-lg"
                                   aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-gray-400">Jenis kategori unik</span>
                                <span class="font-semibold text-violet-600">Terdaftar</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Kondisi Baik --}}
                <div class="group relative bg-white rounded-2xl border border-gray-100
                            shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-amber-50 to-transparent
                                opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                    <div class="relative p-5">
                        <div class="flex items-start justify-between">
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-semibold text-gray-400 uppercase
                                          tracking-widest mb-1">
                                    Kondisi Baik
                                </p>
                                <p class="text-3xl font-black text-gray-900 leading-none">
                                    {{ number_format($stats->total_baik ?? 0) }}
                                </p>
                                <p class="mt-2 text-xs text-gray-500 flex items-center gap-1">
                                    <i class="fas fa-exclamation-triangle text-amber-400"
                                       aria-hidden="true"></i>
                                    {{ number_format(($stats->total_rusak_ringan ?? 0) + ($stats->total_rusak_berat ?? 0)) }}
                                    perlu perhatian
                                </p>
                            </div>
                            <div class="flex-shrink-0 h-12 w-12 rounded-2xl
                                        bg-gradient-to-br from-amber-400 to-amber-600
                                        flex items-center justify-center shadow-md shadow-amber-200
                                        group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-shield-alt text-white text-lg"
                                   aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            {{-- Progress bar kondisi --}}
                            @php
                                $totalAset  = $stats->total_aset ?? 1;
                                $pctBaik    = $totalAset > 0
                                    ? round(($stats->total_baik ?? 0) / $totalAset * 100)
                                    : 0;
                            @endphp
                            <div class="flex items-center justify-between text-xs mb-1.5">
                                <span class="text-gray-400">Persentase kondisi baik</span>
                                <span class="font-semibold text-amber-600">{{ $pctBaik }}%</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-1.5">
                                <div class="bg-gradient-to-r from-amber-400 to-amber-600
                                            h-1.5 rounded-full transition-all duration-700"
                                     style="width: {{ $pctBaik }}%"
                                     role="progressbar"
                                     aria-valuenow="{{ $pctBaik }}"
                                     aria-valuemin="0"
                                     aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ══════════════════════════════════════════════════════
                 FILTER & TOOLBAR
            ══════════════════════════════════════════════════════ --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm">
                <div class="px-5 py-4">
                    <form method="GET" action="{{ route('admin.dashboard-aset.index') }}"
                          id="filterForm"
                          class="flex flex-wrap items-center gap-3">

                        {{-- Pertahankan search --}}
                        @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif

                        {{-- Filter Kondisi --}}
                        <div class="flex items-center gap-2 flex-wrap">
                            <span class="text-xs font-semibold text-gray-400 uppercase
                                         tracking-wider whitespace-nowrap">
                                Filter:
                            </span>

                            @php
                                $filterKondisi = [
                                    ''             => ['label' => 'Semua',       'active' => 'bg-gray-900 text-white', 'inactive' => 'bg-gray-100 text-gray-600 hover:bg-gray-200'],
                                    'Baik'         => ['label' => 'Baik',        'active' => 'bg-green-600 text-white','inactive' => 'bg-green-50 text-green-700 hover:bg-green-100'],
                                    'Rusak Ringan' => ['label' => 'Rusak Ringan','active' => 'bg-yellow-500 text-white','inactive' => 'bg-yellow-50 text-yellow-700 hover:bg-yellow-100'],
                                    'Rusak Berat'  => ['label' => 'Rusak Berat', 'active' => 'bg-red-600 text-white',  'inactive' => 'bg-red-50 text-red-700 hover:bg-red-100'],
                                ];
                                $activeKondisi = request('kondisi', '');
                            @endphp

                            @foreach($filterKondisi as $val => $cfg)
                                <a href="{{ request()->fullUrlWithQuery(['kondisi' => $val, 'page' => 1]) }}"
                                   class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg
                                          text-xs font-semibold transition-all duration-200
                                          {{ $activeKondisi === $val ? $cfg['active'] : $cfg['inactive'] }}"
                                   aria-pressed="{{ $activeKondisi === $val ? 'true' : 'false' }}">
                                    {{ $cfg['label'] }}
                                    @if($val && $activeKondisi === $val)
                                        <i class="fas fa-check text-[10px]" aria-hidden="true"></i>
                                    @endif
                                </a>
                            @endforeach
                        </div>

                        <div class="h-5 w-px bg-gray-200 hidden sm:block"></div>

                        {{-- Sort --}}
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-semibold text-gray-400 uppercase
                                         tracking-wider whitespace-nowrap">
                                Urut:
                            </span>
                            <select name="sort" onchange="document.getElementById('filterForm').submit()"
                                    aria-label="Urutkan berdasarkan"
                                    class="text-xs border border-gray-200 rounded-lg px-2.5 py-1.5
                                           bg-white text-gray-700 font-medium
                                           focus:outline-none focus:ring-2 focus:ring-blue-500
                                           cursor-pointer">
                                <option value="created_at"  {{ request('sort','created_at')==='created_at'  ? 'selected':'' }}>Terbaru</option>
                                <option value="kategori_aset"{{ request('sort')==='kategori_aset' ? 'selected':'' }}>Kategori</option>
                                <option value="nilai_buku"   {{ request('sort')==='nilai_buku'    ? 'selected':'' }}>Nilai Buku</option>
                                <option value="jumlah_unit"  {{ request('sort')==='jumlah_unit'   ? 'selected':'' }}>Jumlah Unit</option>
                                <option value="tahun"        {{ request('sort')==='tahun'         ? 'selected':'' }}>Tahun</option>
                            </select>
                            <a href="{{ request()->fullUrlWithQuery(['dir' => request('dir','desc') === 'desc' ? 'asc' : 'desc', 'page' => 1]) }}"
                               class="h-8 w-8 rounded-lg border border-gray-200 flex items-center
                                      justify-center text-gray-500 hover:bg-gray-50
                                      hover:text-gray-700 transition-colors"
                               title="{{ request('dir','desc') === 'desc' ? 'Menurun' : 'Menaik' }}"
                               aria-label="Toggle arah urutan">
                                <i class="fas fa-sort-amount-{{ request('dir','desc') === 'asc' ? 'up' : 'down' }} text-xs"
                                   aria-hidden="true"></i>
                            </a>
                        </div>

                        {{-- Reset --}}
                        @if(request()->hasAny(['search','kondisi','sort','dir']))
                            <div class="h-5 w-px bg-gray-200 hidden sm:block"></div>
                            <a href="{{ route('admin.dashboard-aset.index') }}"
                               class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg
                                      text-xs font-semibold text-red-600 bg-red-50
                                      hover:bg-red-100 transition-colors">
                                <i class="fas fa-times text-[10px]" aria-hidden="true"></i>
                                Reset
                            </a>
                        @endif

                        {{-- Info jumlah --}}
                        <div class="ml-auto text-xs text-gray-400 whitespace-nowrap">
                            <span class="font-semibold text-gray-700">{{ $asets->firstItem() ?? 0 }}–{{ $asets->lastItem() ?? 0 }}</span>
                            dari
                            <span class="font-semibold text-gray-700">{{ $asets->total() }}</span>
                            data
                        </div>
                    </form>
                </div>

                {{-- Active filter chips --}}
                @if(request()->hasAny(['search','kondisi']))
                <div class="px-5 pb-3 flex items-center gap-2 flex-wrap">
                    <span class="text-xs text-gray-400">Aktif:</span>
                    @if(request('search'))
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1
                                     bg-blue-50 text-blue-700 rounded-lg text-xs font-medium">
                            <i class="fas fa-search text-[10px]" aria-hidden="true"></i>
                            "{{ request('search') }}"
                            <a href="{{ request()->fullUrlWithQuery(['search' => null, 'page' => 1]) }}"
                               class="ml-0.5 hover:text-blue-900"
                               aria-label="Hapus filter pencarian">
                                <i class="fas fa-times text-[10px]" aria-hidden="true"></i>
                            </a>
                        </span>
                    @endif
                    @if(request('kondisi'))
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1
                                     bg-blue-50 text-blue-700 rounded-lg text-xs font-medium">
                            <i class="fas fa-filter text-[10px]" aria-hidden="true"></i>
                            {{ request('kondisi') }}
                            <a href="{{ request()->fullUrlWithQuery(['kondisi' => null, 'page' => 1]) }}"
                               class="ml-0.5 hover:text-blue-900"
                               aria-label="Hapus filter kondisi">
                                <i class="fas fa-times text-[10px]" aria-hidden="true"></i>
                            </a>
                        </span>
                    @endif
                </div>
                @endif
            </div>

            {{-- ══════════════════════════════════════════════════════
                 TABEL DATA
            ══════════════════════════════════════════════════════ --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full" role="table">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100">
                                @php
                                    $cols = [
                                        ['key' => 'kategori_aset', 'label' => 'Aset',        'align' => 'left'],
                                        ['key' => 'jumlah_unit',   'label' => 'Unit',         'align' => 'left'],
                                        ['key' => 'nilai_buku',    'label' => 'Nilai Buku',   'align' => 'left'],
                                        ['key' => 'kondisi',       'label' => 'Kondisi',      'align' => 'left'],
                                        ['key' => 'lokasi',        'label' => 'Lokasi',       'align' => 'left'],
                                        ['key' => 'tahun',         'label' => 'Tahun',        'align' => 'left'],
                                    ];
                                @endphp
                                @foreach($cols as $col)
                                <th scope="col"
                                    class="px-5 py-3.5 text-{{ $col['align'] }}">
                                    <a href="{{ request()->fullUrlWithQuery([
                                            'sort' => $col['key'],
                                            'dir'  => (request('sort') === $col['key'] && request('dir','desc') === 'asc') ? 'desc' : 'asc',
                                            'page' => 1
                                        ]) }}"
                                       class="inline-flex items-center gap-1.5 text-xs font-semibold
                                              text-gray-500 uppercase tracking-wider
                                              hover:text-blue-600 transition-colors group">
                                        {{ $col['label'] }}
                                        <span class="flex flex-col">
                                            @if(request('sort') === $col['key'])
                                                <i class="fas fa-sort-{{ request('dir','desc') === 'asc' ? 'up' : 'down' }}
                                                          text-blue-500 text-[10px]"
                                                   aria-hidden="true"></i>
                                            @else
                                                <i class="fas fa-sort text-gray-300 text-[10px]
                                                          group-hover:text-gray-400"
                                                   aria-hidden="true"></i>
                                            @endif
                                        </span>
                                    </a>
                                </th>
                                @endforeach
                                <th scope="col"
                                    class="px-5 py-3.5 text-right text-xs font-semibold
                                           text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-50">
                            @forelse($asets as $index => $aset)
                            @php
                                $iconMap = [
                                    'Kendaraan'  => ['icon' => 'fa-car',      'bg' => 'bg-sky-100',    'text' => 'text-sky-600'],
                                    'Elektronik' => ['icon' => 'fa-laptop',   'bg' => 'bg-indigo-100', 'text' => 'text-indigo-600'],
                                    'Furniture'  => ['icon' => 'fa-chair',    'bg' => 'bg-amber-100',  'text' => 'text-amber-600'],
                                    'Bangunan'   => ['icon' => 'fa-building', 'bg' => 'bg-slate-100',  'text' => 'text-slate-600'],
                                    'Tanah'      => ['icon' => 'fa-mountain', 'bg' => 'bg-green-100',  'text' => 'text-green-600'],
                                ];
                                $iCfg = $iconMap[$aset->kategori_aset]
                                     ?? ['icon' => 'fa-box', 'bg' => 'bg-gray-100', 'text' => 'text-gray-600'];

                                $kCfg = [
                                    'Baik'         => ['bg' => 'bg-green-50',  'text' => 'text-green-700',  'dot' => 'bg-green-500', 'border' => 'border-green-200'],
                                    'Rusak Ringan' => ['bg' => 'bg-yellow-50', 'text' => 'text-yellow-700', 'dot' => 'bg-yellow-500','border' => 'border-yellow-200'],
                                    'Rusak Berat'  => ['bg' => 'bg-red-50',    'text' => 'text-red-700',    'dot' => 'bg-red-500',   'border' => 'border-red-200'],
                                ][$aset->kondisi] ?? ['bg' => 'bg-gray-50', 'text' => 'text-gray-700', 'dot' => 'bg-gray-400', 'border' => 'border-gray-200'];

                                $usiaTahun = now()->year - $aset->tahun;
                            @endphp
                            <tr class="group hover:bg-blue-50/30 transition-colors duration-150
                                       animate-fade-in"
                                style="animation-delay: {{ $index * 30 }}ms">

                                {{-- Aset --}}
                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-xl
                                                    {{ $iCfg['bg'] }} flex items-center justify-center
                                                    group-hover:scale-105 transition-transform duration-200">
                                            <i class="fas {{ $iCfg['icon'] }} {{ $iCfg['text'] }}"
                                               aria-hidden="true"></i>
                                        </div>
                                        <div class="min-w-0">
                                            <p class="text-sm font-semibold text-gray-900 truncate
                                                       group-hover:text-blue-700 transition-colors">
                                                {{ $aset->kategori_aset }}
                                            </p>
                                            <p class="text-xs text-gray-400 font-mono mt-0.5">
                                                ASET{{ str_pad($aset->id, 4, '0', STR_PAD_LEFT) }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                {{-- Unit --}}
                                <td class="px-5 py-4">
                                    <div class="flex items-baseline gap-1">
                                        <span class="text-sm font-bold text-gray-900">
                                            {{ number_format($aset->jumlah_unit) }}
                                        </span>
                                        <span class="text-xs text-gray-400">unit</span>
                                    </div>
                                </td>

                                {{-- Nilai Buku --}}
                                <td class="px-5 py-4">
                                    <p class="text-sm font-semibold text-gray-900">
                                        Rp {{ number_format($aset->nilai_buku, 0, ',', '.') }}
                                    </p>
                                    @if($aset->nilai_buku >= 1_000_000)
                                    <p class="text-xs text-gray-400 mt-0.5">
                                        @if($aset->nilai_buku >= 1_000_000_000)
                                            ≈ {{ number_format($aset->nilai_buku / 1_000_000_000, 2) }} M
                                        @else
                                            ≈ {{ number_format($aset->nilai_buku / 1_000_000, 1) }} Jt
                                        @endif
                                    </p>
                                    @endif
                                </td>

                                {{-- Kondisi --}}
                                <td class="px-5 py-4">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1
                                                 text-xs font-semibold rounded-lg border
                                                 {{ $kCfg['bg'] }} {{ $kCfg['text'] }} {{ $kCfg['border'] }}">
                                        <span class="h-1.5 w-1.5 rounded-full {{ $kCfg['dot'] }}
                                                     animate-pulse-slow"
                                              aria-hidden="true"></span>
                                        {{ $aset->kondisi }}
                                    </span>
                                </td>

                                {{-- Lokasi --}}
                                <td class="px-5 py-4 max-w-[160px]">
                                    <div class="flex items-center gap-1.5">
                                        <i class="fas fa-map-marker-alt text-gray-300 text-xs flex-shrink-0"
                                           aria-hidden="true"></i>
                                        <span class="text-sm text-gray-600 truncate">
                                            {{ $aset->lokasi }}
                                        </span>
                                    </div>
                                </td>

                                {{-- Tahun --}}
                                <td class="px-5 py-4">
                                    <p class="text-sm font-semibold text-gray-900">
                                        {{ $aset->tahun }}
                                    </p>
                                    <p class="text-xs mt-0.5 {{ $usiaTahun > 10 ? 'text-red-400' : ($usiaTahun > 5 ? 'text-yellow-500' : 'text-gray-400') }}">
                                        {{ $usiaTahun }} tahun
                                    </p>
                                </td>

                                {{-- Aksi --}}
                                <td class="px-5 py-4">
                                    <div class="flex items-center justify-end gap-1
                                                opacity-60 group-hover:opacity-100
                                                transition-opacity duration-200">
                                        {{-- Detail --}}
                                        <a href="{{ route('admin.dashboard-aset.show', $aset) }}"
                                           class="h-8 w-8 rounded-lg flex items-center justify-center
                                                  text-gray-400 hover:text-gray-600 hover:bg-gray-100
                                                  transition-all duration-150"
                                           title="Lihat detail"
                                           aria-label="Lihat detail {{ $aset->kategori_aset }}">
                                            <i class="fas fa-eye text-xs" aria-hidden="true"></i>
                                        </a>
                                        {{-- Edit --}}
                                        <a href="{{ route('admin.dashboard-aset.edit', $aset) }}"
                                           class="h-8 w-8 rounded-lg flex items-center justify-center
                                                  text-blue-400 hover:text-blue-600 hover:bg-blue-50
                                                  transition-all duration-150"
                                           title="Edit"
                                           aria-label="Edit {{ $aset->kategori_aset }}">
                                            <i class="fas fa-edit text-xs" aria-hidden="true"></i>
                                        </a>
                                        {{-- Hapus --}}
                                        <button
                                            data-id="{{ $aset->id }}"
                                            data-name="{{ $aset->kategori_aset }}"
                                            data-url="{{ route('admin.dashboard-aset.destroy', $aset) }}"
                                            onclick="confirmDelete(this)"
                                            class="h-8 w-8 rounded-lg flex items-center justify-center
                                                   text-red-400 hover:text-red-600 hover:bg-red-50
                                                   transition-all duration-150"
                                            title="Hapus"
                                            aria-label="Hapus {{ $aset->kategori_aset }}">
                                            <i class="fas fa-trash-alt text-xs" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-5 py-20 text-center">
                                    <div class="flex flex-col items-center justify-center gap-3">
                                        <div class="h-20 w-20 rounded-2xl bg-gray-100
                                                    flex items-center justify-center">
                                            <i class="fas fa-box-open text-gray-300 text-3xl"
                                               aria-hidden="true"></i>
                                        </div>
                                        <div>
                                            <p class="text-base font-semibold text-gray-700">
                                                @if(request()->hasAny(['search','kondisi']))
                                                    Tidak ada hasil ditemukan
                                                @else
                                                    Belum ada data aset
                                                @endif
                                            </p>
                                            <p class="text-sm text-gray-400 mt-1">
                                                @if(request()->hasAny(['search','kondisi']))
                                                    Coba ubah kata kunci atau filter
                                                @else
                                                    Mulai dengan menambahkan aset pertama
                                                @endif
                                            </p>
                                        </div>
                                        @if(request()->hasAny(['search','kondisi']))
                                            <a href="{{ route('admin.dashboard-aset.index') }}"
                                               class="inline-flex items-center gap-2 px-4 py-2
                                                      bg-gray-100 hover:bg-gray-200 text-gray-700
                                                      text-sm font-medium rounded-xl transition-colors">
                                                <i class="fas fa-times text-xs" aria-hidden="true"></i>
                                                Reset Filter
                                            </a>
                                        @else
                                            <a href="{{ route('admin.dashboard-aset.create') }}"
                                               class="inline-flex items-center gap-2 px-4 py-2
                                                      bg-blue-600 hover:bg-blue-700 text-white
                                                      text-sm font-semibold rounded-xl transition-colors
                                                      shadow-md shadow-blue-200">
                                                <i class="fas fa-plus text-xs" aria-hidden="true"></i>
                                                Tambah Aset Pertama
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- ── Pagination ─────────────────────────────────── --}}
                @if($asets->hasPages())
                <div class="px-5 py-4 border-t border-gray-100 bg-gray-50/50">
                    <div class="flex flex-col sm:flex-row sm:items-center
                                sm:justify-between gap-3">
                        <p class="text-xs text-gray-500">
                            Menampilkan
                            <span class="font-semibold text-gray-700">{{ $asets->firstItem() }}</span>
                            –
                            <span class="font-semibold text-gray-700">{{ $asets->lastItem() }}</span>
                            dari
                            <span class="font-semibold text-gray-700">{{ $asets->total() }}</span>
                            data
                        </p>
                        {{ $asets->links() }}
                    </div>
                </div>
                @endif
            </div>

        </div>
    </div>

    {{-- ══════════════════════════════════════════════════════
         DELETE MODAL
    ══════════════════════════════════════════════════════ --}}
    <div id="deleteModal"
         role="dialog" aria-modal="true" aria-labelledby="deleteModalTitle"
         class="fixed inset-0 z-50 hidden">

        {{-- Overlay --}}
        <div class="absolute inset-0 bg-gray-900/50 backdrop-blur-sm"
             onclick="closeDeleteModal()" aria-hidden="true"></div>

        {{-- Panel --}}
        <div class="relative flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm
                        animate-fade-in-down overflow-hidden">

                {{-- Top accent --}}
                <div class="h-1 bg-gradient-to-r from-red-400 via-red-500 to-rose-500"></div>

                <div class="p-6">
                    {{-- Icon --}}
                    <div class="flex justify-center mb-5">
                        <div class="h-16 w-16 rounded-2xl bg-red-50 border border-red-100
                                    flex items-center justify-center">
                            <i class="fas fa-trash-alt text-red-500 text-2xl"
                               aria-hidden="true"></i>
                        </div>
                    </div>

                    {{-- Text --}}
                    <div class="text-center mb-6">
                        <h3 id="deleteModalTitle"
                            class="text-lg font-bold text-gray-900 mb-1">
                            Hapus Data Aset?
                        </h3>
                        <p class="text-sm text-gray-500 mb-3">
                            Anda akan menghapus aset:
                        </p>
                        <p id="deleteModalName"
                           class="text-base font-bold text-gray-900 px-4 py-2
                                  bg-gray-50 rounded-xl border border-gray-100">
                        </p>
                        <p class="text-xs text-red-500 mt-3 flex items-center
                                  justify-center gap-1">
                            <i class="fas fa-exclamation-circle" aria-hidden="true"></i>
                            Tindakan ini tidak dapat dibatalkan
                        </p>
                    </div>

                    {{-- Actions --}}
                    <div class="flex gap-3">
                        <button onclick="closeDeleteModal()" type="button"
                                class="flex-1 py-2.5 px-4 bg-gray-100 hover:bg-gray-200
                                       text-gray-700 font-semibold text-sm rounded-xl
                                       transition-colors focus:outline-none
                                       focus:ring-2 focus:ring-gray-400">
                            Batal
                        </button>
                        <form id="deleteForm" method="POST" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="w-full py-2.5 px-4 bg-red-600 hover:bg-red-700
                                           text-white font-semibold text-sm rounded-xl
                                           transition-colors shadow-md shadow-red-200
                                           focus:outline-none focus:ring-2 focus:ring-red-500">
                                <i class="fas fa-trash-alt mr-1.5 text-xs"
                                   aria-hidden="true"></i>
                                Ya, Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    (function () {
        'use strict';

        // ── Delete Modal ──────────────────────────────────────────────
        window.confirmDelete = function (btn) {
            document.getElementById('deleteModalName').textContent = btn.dataset.name;
            document.getElementById('deleteForm').action = btn.dataset.url;
            document.getElementById('deleteModal').classList.remove('hidden');
            // Fokus tombol batal untuk aksesibilitas keyboard
            setTimeout(function () {
                document.querySelector('#deleteModal button[onclick="closeDeleteModal()"]').focus();
            }, 50);
        };

        window.closeDeleteModal = function () {
            document.getElementById('deleteModal').classList.add('hidden');
        };

        // Escape key tutup modal
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') window.closeDeleteModal();
        });

        // ── Row hover: pre-fetch detail (opsional, UX improvement) ───
        // Biarkan browser cache halaman detail saat hover di baris
        if ('IntersectionObserver' in window) {
            document.querySelectorAll('tbody tr[class*="group"]').forEach(function (row) {
                row.addEventListener('mouseenter', function () {
                    const detailLink = row.querySelector('a[aria-label^="Lihat detail"]');
                    if (detailLink && !detailLink.dataset.prefetched) {
                        const link = document.createElement('link');
                        link.rel  = 'prefetch';
                        link.href = detailLink.href;
                        document.head.appendChild(link);
                        detailLink.dataset.prefetched = '1';
                    }
                }, { once: true });
            });
        }
    }());
    </script>
    @endpush
</x-app-layout>
