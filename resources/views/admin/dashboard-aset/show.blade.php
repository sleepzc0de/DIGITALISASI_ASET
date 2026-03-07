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
                    <a href="{{ route('admin.dashboard-aset.index') }}"
                       class="hover:text-blue-600 transition-colors">
                        Manajemen Aset
                    </a>
                </li>
                <li aria-hidden="true">
                    <i class="fas fa-chevron-right text-[9px] text-gray-300"></i>
                </li>
                <li>
                    <span class="font-medium text-gray-700 truncate
                                 max-w-[160px] inline-block"
                          aria-current="page">
                        {{ $dashboardAset->kategori_aset }}
                    </span>
                </li>
            </ol>
        </nav>

        <div class="flex flex-col gap-4 sm:flex-row sm:items-start
                    sm:justify-between">
            @php
                $iconMap = [
                    'Kendaraan'  => ['icon'=>'fa-car',      'from'=>'from-sky-500',
                                     'to'=>'to-sky-700',    'shadow'=>'shadow-sky-200'],
                    'Elektronik' => ['icon'=>'fa-laptop',   'from'=>'from-indigo-500',
                                     'to'=>'to-indigo-700', 'shadow'=>'shadow-indigo-200'],
                    'Furniture'  => ['icon'=>'fa-chair',    'from'=>'from-amber-500',
                                     'to'=>'to-amber-700',  'shadow'=>'shadow-amber-200'],
                    'Bangunan'   => ['icon'=>'fa-building', 'from'=>'from-slate-500',
                                     'to'=>'to-slate-700',  'shadow'=>'shadow-slate-200'],
                    'Tanah'      => ['icon'=>'fa-mountain', 'from'=>'from-green-500',
                                     'to'=>'to-green-700',  'shadow'=>'shadow-green-200'],
                ];
                $cfg = $iconMap[$dashboardAset->kategori_aset]
                    ?? ['icon'=>'fa-box','from'=>'from-blue-500',
                        'to'=>'to-blue-700','shadow'=>'shadow-blue-200'];

                $kondisiCfg = [
                    'Baik'         => ['bg'=>'bg-green-100', 'text'=>'text-green-700',
                                       'dot'=>'bg-green-500','border'=>'border-green-200'],
                    'Rusak Ringan' => ['bg'=>'bg-yellow-100','text'=>'text-yellow-700',
                                       'dot'=>'bg-yellow-500','border'=>'border-yellow-200'],
                    'Rusak Berat'  => ['bg'=>'bg-red-100',   'text'=>'text-red-700',
                                       'dot'=>'bg-red-500',  'border'=>'border-red-200'],
                ];
                $kc = $kondisiCfg[$dashboardAset->kondisi]
                   ?? ['bg'=>'bg-gray-100','text'=>'text-gray-700',
                       'dot'=>'bg-gray-400','border'=>'border-gray-200'];
            @endphp

            <div class="flex items-start gap-3 min-w-0">
                <div class="flex-shrink-0 h-11 w-11 rounded-xl
                            bg-gradient-to-br {{ $cfg['from'] }} {{ $cfg['to'] }}
                            flex items-center justify-center
                            shadow-md {{ $cfg['shadow'] }}">
                    <i class="fas {{ $cfg['icon'] }} text-white text-lg"
                       aria-hidden="true"></i>
                </div>
                <div class="min-w-0">
                    <h2 class="text-xl font-bold text-gray-900 leading-tight truncate">
                        {{ $dashboardAset->kategori_aset }}
                    </h2>
                    <div class="flex items-center gap-2 mt-1.5 flex-wrap">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5
                                     rounded-md text-xs font-semibold border
                                     {{ $kc['bg'] }} {{ $kc['text'] }}
                                     {{ $kc['border'] }}">
                            <span class="h-1.5 w-1.5 rounded-full
                                         {{ $kc['dot'] }} animate-pulse-slow"
                                  aria-hidden="true"></span>
                            {{ $dashboardAset->kondisi }}
                        </span>
                        <span class="inline-flex items-center gap-1 px-2 py-0.5
                                     bg-gray-100 text-gray-600 rounded-md
                                     text-xs font-mono">
                            <i class="fas fa-fingerprint text-[10px]"
                               aria-hidden="true"></i>
                            ASET{{ str_pad($dashboardAset->id, 4, '0', STR_PAD_LEFT) }}
                        </span>
                        <span class="inline-flex items-center gap-1 px-2 py-0.5
                                     bg-gray-100 text-gray-500 rounded-md text-xs">
                            <i class="fas fa-clock text-[10px]"
                               aria-hidden="true"></i>
                            {{ $dashboardAset->updated_at->diffForHumans() }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-2 flex-shrink-0
                        flex-wrap sm:flex-nowrap">
                <a href="{{ route('admin.dashboard-aset.edit', $dashboardAset) }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5
                          bg-gradient-to-r from-blue-600 to-blue-700
                          hover:from-blue-700 hover:to-blue-800
                          text-white text-sm font-semibold rounded-xl
                          shadow-md shadow-blue-200 hover:shadow-lg
                          transition-all duration-200 focus:outline-none
                          focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    <i class="fas fa-edit text-xs" aria-hidden="true"></i>
                    Edit Aset
                </a>
                <a href="{{ route('admin.dashboard-aset.index') }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5
                          bg-white border border-gray-300 hover:border-gray-400
                          text-gray-700 hover:text-gray-900 text-sm font-medium
                          rounded-xl shadow-sm hover:shadow
                          transition-all duration-200 focus:outline-none
                          focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">
                    <i class="fas fa-arrow-left text-xs" aria-hidden="true"></i>
                    Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-5">

            {{-- ══════════════════════════════════════════════════════
                 HERO STATS — 4 KPI
            ══════════════════════════════════════════════════════ --}}
            @php
                $penyusutan    = $dashboardAset->nilai_perolehan
                               - $dashboardAset->nilai_buku;
                $pctPenyusutan = $dashboardAset->nilai_perolehan > 0
                    ? round($penyusutan
                            / $dashboardAset->nilai_perolehan * 100)
                    : 0;
                $usia = now()->year - $dashboardAset->tahun;
            @endphp

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

                {{-- Jumlah Unit --}}
                <div class="group bg-white rounded-2xl border border-gray-100
                            shadow-sm hover:shadow-md transition-all duration-300 p-5">
                    <div class="flex items-center justify-between mb-3">
                        <div class="h-9 w-9 rounded-xl bg-blue-50
                                    flex items-center justify-center
                                    group-hover:bg-blue-100 transition-colors">
                            <i class="fas fa-cubes text-blue-600 text-sm"
                               aria-hidden="true"></i>
                        </div>
                        <span class="text-xs font-medium text-gray-400">Unit</span>
                    </div>
                    <p class="text-3xl font-black text-gray-900 leading-none">
                        {{ number_format($dashboardAset->jumlah_unit) }}
                    </p>
                    <p class="text-xs text-gray-400 mt-2">Jumlah Unit Aset</p>
                </div>

                {{-- Nilai Buku --}}
                <div class="group bg-white rounded-2xl border border-gray-100
                            shadow-sm hover:shadow-md transition-all duration-300 p-5">
                    <div class="flex items-center justify-between mb-3">
                        <div class="h-9 w-9 rounded-xl bg-emerald-50
                                    flex items-center justify-center
                                    group-hover:bg-emerald-100 transition-colors">
                            <i class="fas fa-file-invoice-dollar text-emerald-600 text-sm"
                               aria-hidden="true"></i>
                        </div>
                        <span class="text-xs font-medium text-gray-400">Buku</span>
                    </div>
                    <p class="text-xl font-black text-gray-900 leading-none break-all">
                        @if($dashboardAset->nilai_buku >= 1_000_000_000)
                            {{ number_format($dashboardAset->nilai_buku/1_000_000_000,2) }}
                            <span class="text-base text-emerald-600">M</span>
                        @elseif($dashboardAset->nilai_buku >= 1_000_000)
                            {{ number_format($dashboardAset->nilai_buku/1_000_000,1) }}
                            <span class="text-base text-emerald-600">Jt</span>
                        @else
                            {{ number_format($dashboardAset->nilai_buku,0,',','.') }}
                        @endif
                    </p>
                    <p class="text-xs text-gray-400 mt-2">Nilai Buku Saat Ini</p>
                </div>

                {{-- Tahun --}}
                <div class="group bg-white rounded-2xl border border-gray-100
                            shadow-sm hover:shadow-md transition-all duration-300 p-5">
                    <div class="flex items-center justify-between mb-3">
                        <div class="h-9 w-9 rounded-xl bg-violet-50
                                    flex items-center justify-center
                                    group-hover:bg-violet-100 transition-colors">
                            <i class="fas fa-calendar-alt text-violet-600 text-sm"
                               aria-hidden="true"></i>
                        </div>
                        <span class="text-xs font-medium text-gray-400">Tahun</span>
                    </div>
                    <p class="text-3xl font-black text-gray-900 leading-none">
                        {{ $dashboardAset->tahun }}
                    </p>
                    <p class="text-xs mt-2
                              {{ $usia > 10
                                 ? 'text-red-500'
                                 : ($usia > 5 ? 'text-yellow-500' : 'text-gray-400') }}">
                        {{ $usia }} tahun lalu
                    </p>
                </div>

                {{-- Penyusutan --}}
                <div class="group bg-white rounded-2xl border border-gray-100
                            shadow-sm hover:shadow-md transition-all duration-300 p-5">
                    <div class="flex items-center justify-between mb-3">
                        <div class="h-9 w-9 rounded-xl bg-amber-50
                                    flex items-center justify-center
                                    group-hover:bg-amber-100 transition-colors">
                            <i class="fas fa-chart-line text-amber-600 text-sm"
                               aria-hidden="true"></i>
                        </div>
                        <span class="text-xs font-medium text-gray-400">
                            Susut
                        </span>
                    </div>
                    <p class="text-3xl font-black leading-none
                              {{ $pctPenyusutan > 50
                                 ? 'text-red-600'
                                 : 'text-gray-900' }}">
                        {{ $pctPenyusutan }}%
                    </p>
                    <p class="text-xs text-gray-400 mt-2">Tingkat Penyusutan</p>
                </div>
            </div>

            {{-- ══════════════════════════════════════════════════════
                 MAIN CONTENT GRID
            ══════════════════════════════════════════════════════ --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

                {{-- ── KOLOM KIRI (2/3) ─────────────────────────── --}}
                <div class="lg:col-span-2 space-y-5">

                    {{-- Informasi Dasar --}}
                    <div class="bg-white rounded-2xl border border-gray-100
                                shadow-sm overflow-hidden">
                        <div class="flex items-center gap-3 px-6 py-4
                                    border-b border-gray-100 bg-gray-50/60">
                            <div class="h-8 w-8 rounded-lg bg-blue-100
                                        flex items-center justify-center">
                                <i class="fas fa-info-circle text-blue-600 text-sm"
                                   aria-hidden="true"></i>
                            </div>
                            <h3 class="text-sm font-bold text-gray-800">
                                Informasi Dasar
                            </h3>
                        </div>

                        <div class="divide-y divide-gray-50">
                            @php
                                $infoRows = [
                                    ['label' => 'Kategori Aset',
                                     'icon'  => 'fa-layer-group',
                                     'value' => $dashboardAset->kategori_aset,
                                     'mono'  => false],
                                    ['label' => 'ID Aset',
                                     'icon'  => 'fa-fingerprint',
                                     'value' => 'ASET'.str_pad($dashboardAset->id,4,'0',STR_PAD_LEFT),
                                     'mono'  => true],
                                    ['label' => 'Jumlah Unit',
                                     'icon'  => 'fa-cubes',
                                     'value' => number_format($dashboardAset->jumlah_unit).' unit',
                                     'mono'  => false],
                                    ['label' => 'Tahun Pengadaan',
                                     'icon'  => 'fa-calendar',
                                     'value' => $dashboardAset->tahun.' ('.$usia.' tahun lalu)',
                                     'mono'  => false],
                                ];
                            @endphp
                            @foreach($infoRows as $row)
                            <div class="flex items-center justify-between
                                        px-6 py-3.5 hover:bg-gray-50/60
                                        transition-colors group/row">
                                <div class="flex items-center gap-2.5 min-w-0">
                                    <i class="fas {{ $row['icon'] }} text-gray-300
                                              text-xs w-4 flex-shrink-0
                                              group-hover/row:text-blue-400
                                              transition-colors"
                                       aria-hidden="true"></i>
                                    <span class="text-sm text-gray-500">
                                        {{ $row['label'] }}
                                    </span>
                                </div>
                                <span class="text-sm font-semibold text-gray-900
                                             {{ $row['mono'] ? 'font-mono' : '' }}
                                             truncate ml-4 max-w-[55%]">
                                    {{ $row['value'] }}
                                </span>
                            </div>
                            @endforeach

                            {{-- Kondisi row (special) --}}
                            <div class="flex items-center justify-between
                                        px-6 py-3.5 hover:bg-gray-50/60
                                        transition-colors group/row">
                                <div class="flex items-center gap-2.5">
                                    <i class="fas fa-heartbeat text-gray-300
                                              text-xs w-4 flex-shrink-0
                                              group-hover/row:text-blue-400
                                              transition-colors"
                                       aria-hidden="true"></i>
                                    <span class="text-sm text-gray-500">Kondisi</span>
                                </div>
                                <span class="inline-flex items-center gap-1.5
                                             px-2.5 py-1 rounded-lg text-xs
                                             font-semibold border
                                             {{ $kc['bg'] }} {{ $kc['text'] }}
                                             {{ $kc['border'] }}">
                                    <span class="h-1.5 w-1.5 rounded-full
                                                 {{ $kc['dot'] }}"
                                          aria-hidden="true"></span>
                                    {{ $dashboardAset->kondisi }}
                                </span>
                            </div>

                            {{-- Lokasi row (special) --}}
                            <div class="flex items-center justify-between
                                        px-6 py-3.5 hover:bg-gray-50/60
                                        transition-colors group/row">
                                <div class="flex items-center gap-2.5">
                                    <i class="fas fa-map-marker-alt text-gray-300
                                              text-xs w-4 flex-shrink-0
                                              group-hover/row:text-blue-400
                                              transition-colors"
                                       aria-hidden="true"></i>
                                    <span class="text-sm text-gray-500">Lokasi</span>
                                </div>
                                <div class="flex items-center gap-2 ml-4
                                            max-w-[55%]">
                                    <span class="text-sm font-semibold
                                                 text-gray-900 truncate">
                                        {{ $dashboardAset->lokasi }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Informasi Keuangan --}}
                    <div class="bg-white rounded-2xl border border-gray-100
                                shadow-sm overflow-hidden">
                        <div class="flex items-center gap-3 px-6 py-4
                                    border-b border-gray-100 bg-gray-50/60">
                            <div class="h-8 w-8 rounded-lg bg-emerald-100
                                        flex items-center justify-center">
                                <i class="fas fa-money-bill-wave text-emerald-600 text-sm"
                                   aria-hidden="true"></i>
                            </div>
                            <h3 class="text-sm font-bold text-gray-800">
                                Informasi Keuangan
                            </h3>
                        </div>

                        <div class="p-6 space-y-5">
                            {{-- Nilai bars --}}
                            <div class="space-y-4">

                                {{-- Nilai Perolehan --}}
                                <div>
                                    <div class="flex items-center justify-between
                                                mb-1.5">
                                        <span class="text-xs font-medium text-gray-500
                                                     flex items-center gap-1.5">
                                            <i class="fas fa-tag text-gray-300 text-[10px]"
                                               aria-hidden="true"></i>
                                            Nilai Perolehan
                                        </span>
                                        <span class="text-sm font-bold text-gray-900">
                                            Rp {{ number_format($dashboardAset->nilai_perolehan,
                                                                 0, ',', '.') }}
                                        </span>
                                    </div>
                                    <div class="w-full bg-gray-100 rounded-full h-2">
                                        <div class="h-2 rounded-full bg-gradient-to-r
                                                    from-blue-400 to-blue-600"
                                             style="width:100%"
                                             role="progressbar"
                                             aria-valuenow="100"
                                             aria-valuemin="0"
                                             aria-valuemax="100">
                                        </div>
                                    </div>
                                    <p class="text-xs text-gray-400 mt-1">
                                        Nilai aset saat pertama kali diperoleh
                                    </p>
                                </div>

                                {{-- Nilai Buku --}}
                                @php
                                    $pctBuku = $dashboardAset->nilai_perolehan > 0
                                        ? round($dashboardAset->nilai_buku
                                                / $dashboardAset->nilai_perolehan * 100)
                                        : 0;
                                @endphp
                                <div>
                                    <div class="flex items-center justify-between
                                                mb-1.5">
                                        <span class="text-xs font-medium text-gray-500
                                                     flex items-center gap-1.5">
                                            <i class="fas fa-book text-gray-300 text-[10px]"
                                               aria-hidden="true"></i>
                                            Nilai Buku
                                            <span class="text-emerald-600 font-semibold">
                                                ({{ $pctBuku }}%)
                                            </span>
                                        </span>
                                        <span class="text-sm font-bold text-emerald-700">
                                            Rp {{ number_format($dashboardAset->nilai_buku,
                                                                 0, ',', '.') }}
                                        </span>
                                    </div>
                                    <div class="w-full bg-gray-100 rounded-full h-2">
                                        <div class="h-2 rounded-full
                                                    bg-gradient-to-r
                                                    from-emerald-400 to-emerald-600
                                                    transition-all duration-700"
                                             style="width:{{ $pctBuku }}%"
                                             role="progressbar"
                                             aria-valuenow="{{ $pctBuku }}"
                                             aria-valuemin="0"
                                             aria-valuemax="100">
                                        </div>
                                    </div>
                                    <p class="text-xs text-gray-400 mt-1">
                                        Nilai aset setelah penyusutan
                                    </p>
                                </div>

                                {{-- Penyusutan --}}
                                <div>
                                    <div class="flex items-center justify-between
                                                mb-1.5">
                                        <span class="text-xs font-medium text-gray-500
                                                     flex items-center gap-1.5">
                                            <i class="fas fa-arrow-down text-gray-300
                                                      text-[10px]"
                                               aria-hidden="true"></i>
                                            Penyusutan
                                            <span class="{{ $pctPenyusutan > 50
                                                            ? 'text-red-500'
                                                            : 'text-amber-500' }}
                                                         font-semibold">
                                                ({{ $pctPenyusutan }}%)
                                            </span>
                                        </span>
                                        <span class="text-sm font-bold
                                                     {{ $pctPenyusutan > 50
                                                        ? 'text-red-600'
                                                        : 'text-amber-600' }}">
                                            Rp {{ number_format($penyusutan, 0, ',', '.') }}
                                        </span>
                                    </div>
                                    <div class="w-full bg-gray-100 rounded-full h-2">
                                        <div class="h-2 rounded-full transition-all
                                                    duration-700
                                                    {{ $pctPenyusutan > 50
                                                       ? 'bg-gradient-to-r from-red-400 to-red-600'
                                                       : 'bg-gradient-to-r from-amber-400 to-amber-500' }}"
                                             style="width:{{ $pctPenyusutan }}%"
                                             role="progressbar"
                                             aria-valuenow="{{ $pctPenyusutan }}"
                                             aria-valuemin="0"
                                             aria-valuemax="100">
                                        </div>
                                    </div>
                                    <p class="text-xs mt-1
                                              {{ $pctPenyusutan > 50
                                                 ? 'text-red-400'
                                                 : 'text-gray-400' }}">
                                        {{ $pctPenyusutan > 50
                                           ? 'Penyusutan signifikan — pertimbangkan penghapusan'
                                           : 'Penyusutan dalam batas wajar' }}
                                    </p>
                                </div>
                            </div>

                            {{-- Summary row --}}
                            <div class="grid grid-cols-3 gap-3 pt-2
                                        border-t border-gray-100">
                                <div class="text-center p-3 bg-blue-50
                                            rounded-xl">
                                    <p class="text-xs text-blue-600 font-medium mb-1">
                                        Perolehan
                                    </p>
                                    <p class="text-sm font-black text-blue-900">
                                        @if($dashboardAset->nilai_perolehan >= 1_000_000_000)
                                            {{ number_format($dashboardAset->nilai_perolehan/1_000_000_000,1) }}M
                                        @else
                                            {{ number_format($dashboardAset->nilai_perolehan/1_000_000,1) }}Jt
                                        @endif
                                    </p>
                                </div>
                                <div class="text-center p-3 bg-emerald-50 rounded-xl">
                                    <p class="text-xs text-emerald-600 font-medium mb-1">
                                        Buku
                                    </p>
                                    <p class="text-sm font-black text-emerald-900">
                                        @if($dashboardAset->nilai_buku >= 1_000_000_000)
                                            {{ number_format($dashboardAset->nilai_buku/1_000_000_000,1) }}M
                                        @else
                                            {{ number_format($dashboardAset->nilai_buku/1_000_000,1) }}Jt
                                        @endif
                                    </p>
                                </div>
                                <div class="text-center p-3 rounded-xl
                                            {{ $pctPenyusutan > 50
                                               ? 'bg-red-50'
                                               : 'bg-amber-50' }}">
                                    <p class="text-xs font-medium mb-1
                                              {{ $pctPenyusutan > 50
                                                 ? 'text-red-600'
                                                 : 'text-amber-600' }}">
                                        Susut
                                    </p>
                                    <p class="text-sm font-black
                                              {{ $pctPenyusutan > 50
                                                 ? 'text-red-900'
                                                 : 'text-amber-900' }}">
                                        {{ $pctPenyusutan }}%
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Keterangan --}}
                    <div class="bg-white rounded-2xl border border-gray-100
                                shadow-sm overflow-hidden">
                        <div class="flex items-center gap-3 px-6 py-4
                                    border-b border-gray-100 bg-gray-50/60">
                            <div class="h-8 w-8 rounded-lg bg-violet-100
                                        flex items-center justify-center">
                                <i class="fas fa-sticky-note text-violet-600 text-sm"
                                   aria-hidden="true"></i>
                            </div>
                            <h3 class="text-sm font-bold text-gray-800">
                                Keterangan
                            </h3>
                        </div>
                        <div class="px-6 py-5">
                            @if($dashboardAset->keterangan)
                                <p class="text-sm text-gray-700 leading-relaxed
                                          whitespace-pre-line">
                                    {{ $dashboardAset->keterangan }}
                                </p>
                            @else
                                <div class="flex flex-col items-center
                                            justify-center py-6 gap-2">
                                    <div class="h-12 w-12 rounded-xl bg-gray-100
                                                flex items-center justify-center">
                                        <i class="fas fa-comment-slash text-gray-300
                                                  text-lg" aria-hidden="true"></i>
                                    </div>
                                    <p class="text-sm text-gray-400">
                                        Tidak ada keterangan tambahan
                                    </p>
                                    <a href="{{ route('admin.dashboard-aset.edit',
                                                      $dashboardAset) }}"
                                       class="text-xs text-blue-500
                                              hover:text-blue-700 underline
                                              transition-colors">
                                        Tambah keterangan
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- ── KOLOM KANAN (1/3) ─────────────────────────── --}}
                <div class="space-y-5">

                    {{-- Status Card --}}
                    <div class="bg-white rounded-2xl border border-gray-100
                                shadow-sm overflow-hidden">
                        <div class="flex items-center gap-3 px-5 py-4
                                    border-b border-gray-100 bg-gray-50/60">
                            <div class="h-8 w-8 rounded-lg {{ $kc['bg'] }}
                                        flex items-center justify-center">
                                <i class="fas fa-heartbeat {{ $kc['text'] }} text-sm"
                                   aria-hidden="true"></i>
                            </div>
                            <h3 class="text-sm font-bold text-gray-800">Status</h3>
                        </div>
                        <div class="p-5 space-y-4">
                            {{-- Kondisi visual --}}
                            <div class="flex flex-col items-center py-4 gap-3">
                                @php
                                    $kondisiIcon = [
                                        'Baik'         => ['icon'=>'fa-check-circle',
                                                           'size'=>'text-5xl',
                                                           'color'=>'text-green-500'],
                                        'Rusak Ringan' => ['icon'=>'fa-exclamation-triangle',
                                                           'size'=>'text-5xl',
                                                           'color'=>'text-yellow-500'],
                                        'Rusak Berat'  => ['icon'=>'fa-times-circle',
                                                           'size'=>'text-5xl',
                                                           'color'=>'text-red-500'],
                                    ];
                                    $ki = $kondisiIcon[$dashboardAset->kondisi]
                                       ?? ['icon'=>'fa-question-circle',
                                           'size'=>'text-5xl',
                                           'color'=>'text-gray-400'];
                                @endphp
                                <div class="h-20 w-20 rounded-2xl {{ $kc['bg'] }}
                                            flex items-center justify-center">
                                    <i class="fas {{ $ki['icon'] }}
                                              {{ $ki['size'] }} {{ $ki['color'] }}"
                                       aria-hidden="true"></i>
                                </div>
                                <div class="text-center">
                                    <p class="text-base font-bold {{ $kc['text'] }}">
                                        {{ $dashboardAset->kondisi }}
                                    </p>
                                    <p class="text-xs text-gray-400 mt-0.5">
                                        @switch($dashboardAset->kondisi)
                                            @case('Baik')
                                                Aset dalam kondisi prima
                                                @break
                                            @case('Rusak Ringan')
                                                Perlu perbaikan minor
                                                @break
                                            @case('Rusak Berat')
                                                Perlu perbaikan besar
                                                @break
                                        @endswitch
                                    </p>
                                </div>
                            </div>

                            {{-- Lokasi --}}
                            <div class="flex items-start gap-2.5 p-3
                                        bg-gray-50 rounded-xl">
                                <div class="h-7 w-7 rounded-lg bg-white
                                            border border-gray-200
                                            flex items-center justify-center
                                            flex-shrink-0 mt-0.5">
                                    <i class="fas fa-map-marker-alt text-gray-400
                                              text-xs" aria-hidden="true"></i>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-xs text-gray-400 mb-0.5">Lokasi</p>
                                    <p class="text-sm font-semibold text-gray-900
                                               break-words">
                                        {{ $dashboardAset->lokasi }}
                                    </p>
                                </div>
                            </div>

                            {{-- Usia aset --}}
                            <div class="flex items-center gap-2.5 p-3
                                        bg-gray-50 rounded-xl">
                                <div class="h-7 w-7 rounded-lg bg-white
                                            border border-gray-200
                                            flex items-center justify-center
                                            flex-shrink-0">
                                    <i class="fas fa-hourglass-half text-gray-400
                                              text-xs" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400 mb-0.5">
                                        Usia Aset
                                    </p>
                                    <p class="text-sm font-semibold
                                               {{ $usia > 10
                                                  ? 'text-red-600'
                                                  : ($usia > 5
                                                     ? 'text-yellow-600'
                                                     : 'text-gray-900') }}">
                                        {{ $usia }} tahun
                                        @if($usia > 10)
                                            <span class="text-xs font-normal
                                                         text-red-400">
                                                (tua)
                                            </span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Riwayat Sistem --}}
                    <div class="bg-white rounded-2xl border border-gray-100
                                shadow-sm overflow-hidden">
                        <div class="flex items-center gap-3 px-5 py-4
                                    border-b border-gray-100 bg-gray-50/60">
                            <div class="h-8 w-8 rounded-lg bg-gray-100
                                        flex items-center justify-center">
                                <i class="fas fa-history text-gray-500 text-sm"
                                   aria-hidden="true"></i>
                            </div>
                            <h3 class="text-sm font-bold text-gray-800">
                                Riwayat Sistem
                            </h3>
                        </div>
                        <div class="p-5 space-y-3">
                            {{-- Timeline --}}
                            <div class="relative pl-5">
                                <div class="absolute left-2 top-1 bottom-1
                                            w-px bg-gray-200"></div>

                                {{-- Created --}}
                                <div class="relative mb-4">
                                    <div class="absolute -left-3.5 top-1 h-3 w-3
                                                rounded-full bg-blue-500
                                                border-2 border-white"></div>
                                    <p class="text-xs font-semibold text-gray-700">
                                        Dibuat
                                    </p>
                                    <p class="text-xs text-gray-500 mt-0.5">
                                        {{ $dashboardAset->created_at
                                             ->format('d M Y, H:i') }}
                                    </p>
                                    <p class="text-xs text-gray-400">
                                        {{ $dashboardAset->created_at
                                             ->diffForHumans() }}
                                    </p>
                                </div>

                                {{-- Updated --}}
                                <div class="relative">
                                    <div class="absolute -left-3.5 top-1 h-3 w-3
                                                rounded-full
                                                {{ $dashboardAset->created_at == $dashboardAset->updated_at
                                                   ? 'bg-gray-300'
                                                   : 'bg-emerald-500' }}
                                                border-2 border-white"></div>
                                    <p class="text-xs font-semibold text-gray-700">
                                        Terakhir Diupdate
                                    </p>
                                    <p class="text-xs text-gray-500 mt-0.5">
                                        {{ $dashboardAset->updated_at
                                             ->format('d M Y, H:i') }}
                                    </p>
                                    <p class="text-xs text-gray-400">
                                        {{ $dashboardAset->updated_at
                                             ->diffForHumans() }}
                                    </p>
                                </div>
                            </div>

                            @if($dashboardAset->created_at != $dashboardAset->updated_at)
                            <div class="pt-2 border-t border-gray-100">
                                <p class="text-xs text-gray-400 text-center">
                                    Diupdate
                                    <span class="font-semibold text-gray-600">
                                        {{ $dashboardAset->created_at
                                             ->diffForHumans(
                                                 $dashboardAset->updated_at,
                                                 true) }}
                                    </span>
                                    setelah dibuat
                                </p>
                            </div>
                            @endif
                        </div>
                    </div>

                    {{-- Quick Actions --}}
                    <div class="bg-white rounded-2xl border border-gray-100
                                shadow-sm overflow-hidden">
                        <div class="flex items-center gap-3 px-5 py-4
                                    border-b border-gray-100 bg-gray-50/60">
                            <div class="h-8 w-8 rounded-lg bg-blue-100
                                        flex items-center justify-center">
                                <i class="fas fa-bolt text-blue-600 text-sm"
                                   aria-hidden="true"></i>
                            </div>
                            <h3 class="text-sm font-bold text-gray-800">
                                Aksi Cepat
                            </h3>
                        </div>
                        <div class="p-4 space-y-2">
                            <a href="{{ route('admin.dashboard-aset.edit',
                                             $dashboardAset) }}"
                               class="flex items-center gap-3 px-4 py-3
                                      rounded-xl border border-gray-200
                                      hover:border-blue-300 hover:bg-blue-50
                                      transition-all duration-200 group/action">
                                <div class="h-8 w-8 rounded-lg bg-blue-50
                                            group-hover/action:bg-blue-100
                                            flex items-center justify-center
                                            flex-shrink-0 transition-colors">
                                    <i class="fas fa-edit text-blue-600 text-xs"
                                       aria-hidden="true"></i>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-sm font-semibold text-gray-700
                                               group-hover/action:text-blue-700
                                               transition-colors">
                                        Edit Data Aset
                                    </p>
                                    <p class="text-xs text-gray-400">
                                        Perbarui informasi aset
                                    </p>
                                </div>
                                <i class="fas fa-chevron-right text-gray-300
                                          text-xs ml-auto group-hover/action:text-blue-400
                                          transition-colors"
                                   aria-hidden="true"></i>
                            </a>

                            <button type="button"
                                    onclick="copyAssetId()"
                                    class="w-full flex items-center gap-3 px-4 py-3
                                           rounded-xl border border-gray-200
                                           hover:border-violet-300 hover:bg-violet-50
                                           transition-all duration-200 group/action
                                           text-left">
                                <div class="h-8 w-8 rounded-lg bg-violet-50
                                            group-hover/action:bg-violet-100
                                            flex items-center justify-center
                                            flex-shrink-0 transition-colors">
                                    <i class="fas fa-copy text-violet-600 text-xs"
                                       aria-hidden="true"></i>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-sm font-semibold text-gray-700
                                               group-hover/action:text-violet-700
                                               transition-colors">
                                        Salin ID Aset
                                    </p>
                                    <p class="text-xs text-gray-400 font-mono">
                                        ASET{{ str_pad($dashboardAset->id, 4, '0',
                                                        STR_PAD_LEFT) }}
                                    </p>
                                </div>
                                <i class="fas fa-chevron-right text-gray-300
                                          text-xs ml-auto
                                          group-hover/action:text-violet-400
                                          transition-colors"
                                   aria-hidden="true"></i>
                            </button>

                            <button type="button"
                                    onclick="window.print()"
                                    class="w-full flex items-center gap-3 px-4 py-3
                                           rounded-xl border border-gray-200
                                           hover:border-gray-300 hover:bg-gray-50
                                           transition-all duration-200 group/action
                                           text-left">
                                <div class="h-8 w-8 rounded-lg bg-gray-50
                                            group-hover/action:bg-gray-100
                                            flex items-center justify-center
                                            flex-shrink-0 transition-colors">
                                    <i class="fas fa-print text-gray-500 text-xs"
                                       aria-hidden="true"></i>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-sm font-semibold text-gray-700
                                               transition-colors">
                                        Cetak Detail
                                    </p>
                                    <p class="text-xs text-gray-400">
                                        Print halaman ini
                                    </p>
                                </div>
                                <i class="fas fa-chevron-right text-gray-300
                                          text-xs ml-auto transition-colors"
                                   aria-hidden="true"></i>
                            </button>

                            {{-- Danger zone --}}
                            <div class="pt-2 border-t border-gray-100 mt-2">
                                <button type="button"
                                        onclick="confirmDelete()"
                                        class="w-full flex items-center gap-3 px-4 py-3
                                               rounded-xl border border-red-100
                                               hover:border-red-300 hover:bg-red-50
                                               transition-all duration-200
                                               group/action text-left">
                                    <div class="h-8 w-8 rounded-lg bg-red-50
                                                group-hover/action:bg-red-100
                                                flex items-center justify-center
                                                flex-shrink-0 transition-colors">
                                        <i class="fas fa-trash-alt text-red-500
                                                  text-xs"
                                           aria-hidden="true"></i>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-sm font-semibold text-red-600
                                                   transition-colors">
                                            Hapus Aset
                                        </p>
                                        <p class="text-xs text-red-300">
                                            Tidak dapat dibatalkan
                                        </p>
                                    </div>
                                    <i class="fas fa-chevron-right text-red-200
                                              text-xs ml-auto
                                              group-hover/action:text-red-400
                                              transition-colors"
                                       aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Bottom Actions ──────────────────────────────────── --}}
            <div class="flex flex-col sm:flex-row sm:items-center
                        sm:justify-between gap-4 pt-2">
                <p class="text-xs text-gray-400 flex items-center gap-1.5">
                    <i class="fas fa-info-circle text-blue-400"
                       aria-hidden="true"></i>
                    Tercatat sejak
                    {{ $dashboardAset->created_at->format('d F Y') }}
                </p>
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.dashboard-aset.index') }}"
                       class="inline-flex items-center gap-2 px-4 py-2.5
                              bg-white border border-gray-300
                              hover:border-gray-400 text-gray-700
                              hover:text-gray-900 text-sm font-medium
                              rounded-xl shadow-sm hover:shadow
                              transition-all duration-200">
                        <i class="fas fa-list text-xs" aria-hidden="true"></i>
                        Lihat Semua Aset
                    </a>
                    <a href="{{ route('admin.dashboard-aset.edit',
                                     $dashboardAset) }}"
                       class="inline-flex items-center gap-2 px-5 py-2.5
                              bg-gradient-to-r from-blue-600 to-blue-700
                              hover:from-blue-700 hover:to-blue-800
                              text-white text-sm font-semibold rounded-xl
                              shadow-md shadow-blue-200 hover:shadow-lg
                              transition-all duration-200">
                        <i class="fas fa-edit text-xs" aria-hidden="true"></i>
                        Edit Data Aset
                    </a>
                </div>
            </div>

        </div>
    </div>

    {{-- ── Delete Confirmation Modal ─────────────────────────────────── --}}
    <div id="deleteModal" role="dialog" aria-modal="true"
         aria-labelledby="deleteModalTitle"
         class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-gray-900/50 backdrop-blur-sm"
             onclick="closeDeleteModal()" aria-hidden="true"></div>
        <div class="relative flex items-center justify-center
                    min-h-screen p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm
                        animate-fade-in-down overflow-hidden">
                <div class="h-1 bg-gradient-to-r from-red-400
                            via-red-500 to-rose-500"></div>
                <div class="p-6">
                    <div class="flex justify-center mb-5">
                        <div class="h-16 w-16 rounded-2xl bg-red-50
                                    border border-red-100
                                    flex items-center justify-center">
                            <i class="fas fa-trash-alt text-red-500 text-2xl"
                               aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="text-center mb-6">
                        <h3 id="deleteModalTitle"
                            class="text-lg font-bold text-gray-900 mb-1">
                            Hapus Data Aset?
                        </h3>
                        <p class="text-sm text-gray-500 mb-3">
                            Anda akan menghapus aset:
                        </p>
                        <p class="text-base font-bold text-gray-900 px-4 py-2
                                  bg-gray-50 rounded-xl border border-gray-100">
                            {{ $dashboardAset->kategori_aset }}
                        </p>
                        <p class="text-xs text-red-500 mt-3
                                  flex items-center justify-center gap-1">
                            <i class="fas fa-exclamation-circle"
                               aria-hidden="true"></i>
                            Tindakan ini tidak dapat dibatalkan
                        </p>
                    </div>
                    <div class="flex gap-3">
                        <button onclick="closeDeleteModal()" type="button"
                                class="flex-1 py-2.5 px-4 bg-gray-100
                                       hover:bg-gray-200 text-gray-700
                                       font-semibold text-sm rounded-xl
                                       transition-colors focus:outline-none
                                       focus:ring-2 focus:ring-gray-400">
                            Batal
                        </button>
                        <form action="{{ route('admin.dashboard-aset.destroy',
                                             $dashboardAset) }}"
                              method="POST" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="w-full py-2.5 px-4 bg-red-600
                                           hover:bg-red-700 text-white
                                           font-semibold text-sm rounded-xl
                                           transition-colors shadow-md
                                           shadow-red-200 focus:outline-none
                                           focus:ring-2 focus:ring-red-500">
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

        // ── Copy Asset ID ─────────────────────────────────────────────────
        window.copyAssetId = function () {
            const id = 'ASET{{ str_pad($dashboardAset->id, 4, "0", STR_PAD_LEFT) }}';
            navigator.clipboard.writeText(id).then(function () {
                showToast('ID Aset berhasil disalin: ' + id, 'success');
            }).catch(function () {
                showToast('Gagal menyalin ID', 'error');
            });
        };

        // ── Delete Modal ──────────────────────────────────────────────────
        window.confirmDelete = function () {
            document.getElementById('deleteModal').classList.remove('hidden');
            setTimeout(function () {
                document.querySelector(
                    '#deleteModal button[onclick="closeDeleteModal()"]'
                ).focus();
            }, 50);
        };

        window.closeDeleteModal = function () {
            document.getElementById('deleteModal').classList.add('hidden');
        };

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') window.closeDeleteModal();
        });

        // ── Toast Notification ────────────────────────────────────────────
        function showToast(message, type) {
            type = type || 'success';
            const colors = {
                success : 'bg-gray-900 text-white',
                error   : 'bg-red-600 text-white',
            };
            const icons = {
                success : 'fa-check-circle',
                error   : 'fa-exclamation-circle',
            };

            const toast = document.createElement('div');
            toast.className =
                'fixed bottom-6 left-1/2 -translate-x-1/2 z-[9999] ' +
                'flex items-center gap-2.5 px-5 py-3 rounded-2xl ' +
                'shadow-2xl text-sm font-semibold ' +
                'animate-fade-in-down ' + colors[type];
            toast.innerHTML =
                '<i class="fas ' + icons[type] + ' text-sm"></i>' +
                '<span>' + message + '</span>';

            document.body.appendChild(toast);
            setTimeout(function () {
                toast.style.transition = 'opacity 0.3s ease';
                toast.style.opacity    = '0';
                setTimeout(function () { toast.remove(); }, 350);
            }, 2500);
        }

    }());
    </script>
    @endpush
</x-app-layout>
