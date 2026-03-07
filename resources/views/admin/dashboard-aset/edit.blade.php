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
                    <a href="{{ route('admin.dashboard-aset.show', $dashboardAset) }}"
                       class="hover:text-blue-600 transition-colors truncate
                              max-w-[120px] inline-block">
                        {{ $dashboardAset->kategori_aset }}
                    </a>
                </li>
                <li aria-hidden="true">
                    <i class="fas fa-chevron-right text-[9px] text-gray-300"></i>
                </li>
                <li>
                    <span class="font-medium text-gray-700" aria-current="page">Edit</span>
                </li>
            </ol>
        </nav>

        <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
            <div class="flex items-start gap-3 min-w-0">
                <div class="flex-shrink-0 h-11 w-11 rounded-xl
                            bg-gradient-to-br from-violet-500 to-violet-700
                            flex items-center justify-center shadow-md shadow-violet-200">
                    <i class="fas fa-edit text-white text-lg" aria-hidden="true"></i>
                </div>
                <div class="min-w-0">
                    <h2 class="text-xl font-bold text-gray-900 leading-tight">
                        Edit Data Aset
                    </h2>
                    <p class="mt-0.5 text-sm text-gray-500 truncate">
                        {{ $dashboardAset->kategori_aset }}
                    </p>
                    <div class="flex items-center gap-2 mt-1.5 flex-wrap">
                        <span class="inline-flex items-center gap-1 px-2 py-0.5
                                     bg-gray-100 text-gray-600 rounded-md
                                     text-xs font-mono">
                            <i class="fas fa-fingerprint text-[10px]"
                               aria-hidden="true"></i>
                            ASET{{ str_pad($dashboardAset->id, 4, '0', STR_PAD_LEFT) }}
                        </span>
                        <span class="inline-flex items-center gap-1 px-2 py-0.5
                                     bg-gray-100 text-gray-600 rounded-md text-xs">
                            <i class="fas fa-clock text-[10px]" aria-hidden="true"></i>
                            {{ $dashboardAset->updated_at->format('d M Y, H:i') }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-2 flex-shrink-0 flex-wrap sm:flex-nowrap">
                <a href="{{ route('admin.dashboard-aset.show', $dashboardAset) }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5
                          bg-white border border-gray-300 hover:border-gray-400
                          text-gray-700 hover:text-gray-900 text-sm font-medium
                          rounded-xl shadow-sm hover:shadow transition-all duration-200
                          focus:outline-none focus:ring-2 focus:ring-gray-400
                          focus:ring-offset-2">
                    <i class="fas fa-eye text-xs" aria-hidden="true"></i>
                    Preview
                </a>
                <a href="{{ route('admin.dashboard-aset.index') }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5
                          bg-white border border-gray-300 hover:border-gray-400
                          text-gray-700 hover:text-gray-900 text-sm font-medium
                          rounded-xl shadow-sm hover:shadow transition-all duration-200
                          focus:outline-none focus:ring-2 focus:ring-gray-400
                          focus:ring-offset-2">
                    <i class="fas fa-arrow-left text-xs" aria-hidden="true"></i>
                    Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- ── Error Alert ─────────────────────────────────────────── --}}
            @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 rounded-2xl p-4
                        animate-fade-in-down" role="alert">
                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0 h-9 w-9 rounded-xl bg-red-100
                                flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-red-600 text-sm"
                           aria-hidden="true"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-red-800 mb-1">
                            {{ $errors->count() }} kesalahan ditemukan
                        </p>
                        <ul class="text-sm text-red-600 space-y-0.5
                                   list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif

            {{-- ── Snapshot Card (data sebelum edit) ──────────────────── --}}
            @php
                $snapKondisi = [
                    'Baik'         => ['bg'=>'bg-green-100', 'text'=>'text-green-700',
                                       'dot'=>'bg-green-500'],
                    'Rusak Ringan' => ['bg'=>'bg-yellow-100','text'=>'text-yellow-700',
                                       'dot'=>'bg-yellow-500'],
                    'Rusak Berat'  => ['bg'=>'bg-red-100',   'text'=>'text-red-700',
                                       'dot'=>'bg-red-500'],
                ];
                $sk = $snapKondisi[$dashboardAset->kondisi]
                   ?? ['bg'=>'bg-gray-100','text'=>'text-gray-700','dot'=>'bg-gray-400'];
                $penyusutan    = $dashboardAset->nilai_perolehan - $dashboardAset->nilai_buku;
                $pctPenyusutan = $dashboardAset->nilai_perolehan > 0
                    ? round($penyusutan / $dashboardAset->nilai_perolehan * 100)
                    : 0;
                $usia = now()->year - $dashboardAset->tahun;
            @endphp

            <div class="mb-5 bg-white rounded-2xl border border-gray-100
                        shadow-sm overflow-hidden">
                <div class="flex items-center gap-3 px-5 py-3.5
                            border-b border-gray-100 bg-gray-50/60">
                    <i class="fas fa-history text-gray-400 text-sm"
                       aria-hidden="true"></i>
                    <span class="text-sm font-semibold text-gray-700">
                        Data Sebelum Perubahan
                    </span>
                    <span class="ml-auto text-xs text-gray-400">
                        Dibuat {{ $dashboardAset->created_at->format('d M Y') }}
                    </span>
                </div>
                <div class="px-5 py-4 grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <div class="text-center">
                        <p class="text-2xl font-black text-gray-900">
                            {{ $dashboardAset->jumlah_unit }}
                        </p>
                        <p class="text-xs text-gray-400 mt-0.5">Unit</p>
                    </div>
                    <div class="text-center">
                        <p class="text-lg font-black text-gray-900 leading-tight">
                            Rp {{ number_format($dashboardAset->nilai_buku/1_000_000, 1) }}Jt
                        </p>
                        <p class="text-xs text-gray-400 mt-0.5">Nilai Buku</p>
                    </div>
                    <div class="text-center">
                        <p class="text-2xl font-black text-gray-900">
                            {{ $dashboardAset->tahun }}
                        </p>
                        <p class="text-xs text-gray-400 mt-0.5">
                            {{ $usia }} tahun lalu
                        </p>
                    </div>
                    <div class="text-center">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1
                                     rounded-full text-xs font-semibold
                                     {{ $sk['bg'] }} {{ $sk['text'] }}">
                            <span class="h-1.5 w-1.5 rounded-full {{ $sk['dot'] }}"
                                  aria-hidden="true"></span>
                            {{ $dashboardAset->kondisi }}
                        </span>
                        <p class="text-xs text-gray-400 mt-1.5">Kondisi</p>
                    </div>
                </div>
                {{-- Penyusutan progress --}}
                <div class="px-5 pb-4">
                    <div class="flex items-center justify-between text-xs
                                text-gray-500 mb-1.5">
                        <span>Penyusutan saat ini</span>
                        <span class="font-semibold">
                            {{ $pctPenyusutan }}%
                            (Rp {{ number_format($penyusutan, 0, ',', '.') }})
                        </span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-1.5">
                        <div class="h-1.5 rounded-full transition-all duration-700
                                    {{ $pctPenyusutan > 50
                                       ? 'bg-gradient-to-r from-red-400 to-red-500'
                                       : 'bg-gradient-to-r from-emerald-400 to-emerald-500' }}"
                             style="width: {{ $pctPenyusutan }}%"
                             role="progressbar"
                             aria-valuenow="{{ $pctPenyusutan }}"
                             aria-valuemin="0" aria-valuemax="100">
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── FORM ────────────────────────────────────────────────── --}}
            <form action="{{ route('admin.dashboard-aset.update', $dashboardAset) }}"
                  method="POST"
                  id="asetForm"
                  novalidate>
                @csrf
                @method('PUT')

                <div class="space-y-5">

                    {{-- ══════════════════════════════════════════════
                         SECTION 1 — IDENTITAS ASET
                    ══════════════════════════════════════════════ --}}
                    <div class="bg-white rounded-2xl border border-gray-100
                                shadow-sm overflow-hidden">
                        <div class="flex items-center gap-3 px-6 py-4
                                    border-b border-gray-100 bg-gray-50/60">
                            <div class="h-8 w-8 rounded-lg bg-violet-100
                                        flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-tag text-violet-600 text-sm"
                                   aria-hidden="true"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-gray-800">
                                    Identitas Aset
                                </h3>
                                <p class="text-xs text-gray-400 mt-0.5">
                                    Informasi dasar pengenal aset
                                </p>
                            </div>
                            <div class="ml-auto">
                                <span class="text-xs text-gray-400">
                                    Langkah
                                    <span class="font-bold text-violet-600">1</span> / 3
                                </span>
                            </div>
                        </div>

                        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">

                            {{-- Kategori Aset --}}
                            <div class="md:col-span-2 space-y-1.5">
                                <label for="kategori_aset"
                                       class="block text-sm font-semibold text-gray-700">
                                    Kategori Aset
                                    <span class="text-red-500 ml-0.5"
                                          aria-hidden="true">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5
                                                flex items-center pointer-events-none">
                                        <i class="fas fa-layer-group text-gray-400 text-sm"
                                           aria-hidden="true"></i>
                                    </div>
                                    <input type="text"
                                           id="kategori_aset"
                                           name="kategori_aset"
                                           value="{{ old('kategori_aset',
                                                         $dashboardAset->kategori_aset) }}"
                                           required maxlength="100" autocomplete="off"
                                           list="kategori-suggestions"
                                           placeholder="Ketik atau pilih kategori…"
                                           class="w-full pl-10 pr-4 py-3 text-sm rounded-xl
                                                  border transition-all duration-200
                                                  @error('kategori_aset')
                                                      border-red-300 bg-red-50
                                                      focus:border-red-400 focus:ring-2
                                                      focus:ring-red-100
                                                  @else
                                                      border-gray-200 bg-white
                                                      focus:border-violet-400 focus:ring-2
                                                      focus:ring-violet-100
                                                  @enderror
                                                  focus:outline-none text-gray-900
                                                  placeholder-gray-400">
                                    <datalist id="kategori-suggestions">
                                        <option value="Kendaraan">
                                        <option value="Elektronik">
                                        <option value="Furniture">
                                        <option value="Bangunan">
                                        <option value="Tanah">
                                        <option value="Peralatan Kantor">
                                        <option value="Mesin">
                                    </datalist>
                                </div>
                                @error('kategori_aset')
                                <p class="text-xs text-red-600 flex items-center gap-1"
                                   role="alert">
                                    <i class="fas fa-exclamation-circle"
                                       aria-hidden="true"></i>
                                    {{ $message }}
                                </p>
                                @enderror

                                {{-- Quick select pills --}}
                                <div class="flex flex-wrap gap-2 pt-1">
                                    <span class="text-xs text-gray-400 self-center">
                                        Pilih cepat:
                                    </span>
                                    @php
                                        $currentKat = old('kategori_aset',
                                                          $dashboardAset->kategori_aset);
                                    @endphp
                                    @foreach(['Kendaraan','Elektronik','Furniture',
                                              'Bangunan','Tanah','Mesin'] as $kat)
                                    <button type="button"
                                            onclick="setKategori('{{ $kat }}')"
                                            class="px-2.5 py-1 text-xs font-medium rounded-lg
                                                   border transition-all duration-150
                                                   kategori-pill
                                                   {{ $currentKat === $kat
                                                      ? 'border-violet-400 text-violet-600 bg-violet-50'
                                                      : 'border-gray-200 text-gray-600 hover:border-violet-300 hover:text-violet-600 hover:bg-violet-50' }}">
                                        {{ $kat }}
                                    </button>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Jumlah Unit --}}
                            <div class="space-y-1.5">
                                <label for="jumlah_unit"
                                       class="block text-sm font-semibold text-gray-700">
                                    Jumlah Unit
                                    <span class="text-red-500 ml-0.5"
                                          aria-hidden="true">*</span>
                                </label>
                                <div class="relative flex rounded-xl overflow-hidden
                                            border transition-all duration-200
                                            @error('jumlah_unit') border-red-300
                                            @else border-gray-200 @enderror
                                            focus-within:border-violet-400
                                            focus-within:ring-2
                                            focus-within:ring-violet-100">
                                    <button type="button"
                                            onclick="stepNumber('jumlah_unit', -1)"
                                            class="px-3.5 bg-gray-50 hover:bg-gray-100
                                                   text-gray-500 hover:text-gray-700
                                                   border-r border-gray-200
                                                   transition-colors flex-shrink-0"
                                            aria-label="Kurangi jumlah unit">
                                        <i class="fas fa-minus text-xs"
                                           aria-hidden="true"></i>
                                    </button>
                                    <input type="number"
                                           id="jumlah_unit"
                                           name="jumlah_unit"
                                           value="{{ old('jumlah_unit',
                                                         $dashboardAset->jumlah_unit) }}"
                                           required min="1" max="999999" step="1"
                                           class="flex-1 px-4 py-3 text-sm text-center
                                                  font-semibold bg-white focus:outline-none
                                                  text-gray-900 border-0
                                                  @error('jumlah_unit') bg-red-50 @enderror">
                                    <button type="button"
                                            onclick="stepNumber('jumlah_unit', 1)"
                                            class="px-3.5 bg-gray-50 hover:bg-gray-100
                                                   text-gray-500 hover:text-gray-700
                                                   border-l border-gray-200
                                                   transition-colors flex-shrink-0"
                                            aria-label="Tambah jumlah unit">
                                        <i class="fas fa-plus text-xs"
                                           aria-hidden="true"></i>
                                    </button>
                                </div>
                                {{-- Delta indicator --}}
                                <p id="unitDelta" class="text-xs hidden"></p>
                                @error('jumlah_unit')
                                <p class="text-xs text-red-600 flex items-center gap-1"
                                   role="alert">
                                    <i class="fas fa-exclamation-circle"
                                       aria-hidden="true"></i>
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>

                            {{-- Tahun --}}
                            <div class="space-y-1.5">
                                <label for="tahun"
                                       class="block text-sm font-semibold text-gray-700">
                                    Tahun Pengadaan
                                    <span class="text-red-500 ml-0.5"
                                          aria-hidden="true">*</span>
                                </label>
                                <div class="relative flex rounded-xl overflow-hidden
                                            border transition-all duration-200
                                            @error('tahun') border-red-300
                                            @else border-gray-200 @enderror
                                            focus-within:border-violet-400
                                            focus-within:ring-2
                                            focus-within:ring-violet-100">
                                    <button type="button"
                                            onclick="stepNumber('tahun', -1)"
                                            class="px-3.5 bg-gray-50 hover:bg-gray-100
                                                   text-gray-500 hover:text-gray-700
                                                   border-r border-gray-200
                                                   transition-colors flex-shrink-0"
                                            aria-label="Kurangi tahun">
                                        <i class="fas fa-minus text-xs"
                                           aria-hidden="true"></i>
                                    </button>
                                    <input type="number"
                                           id="tahun"
                                           name="tahun"
                                           value="{{ old('tahun',
                                                         $dashboardAset->tahun) }}"
                                           required min="2000"
                                           max="{{ $currentYear + 1 }}"
                                           class="flex-1 px-4 py-3 text-sm text-center
                                                  font-semibold bg-white focus:outline-none
                                                  text-gray-900 border-0
                                                  @error('tahun') bg-red-50 @enderror">
                                    <button type="button"
                                            onclick="stepNumber('tahun', 1)"
                                            class="px-3.5 bg-gray-50 hover:bg-gray-100
                                                   text-gray-500 hover:text-gray-700
                                                   border-l border-gray-200
                                                   transition-colors flex-shrink-0"
                                            aria-label="Tambah tahun">
                                        <i class="fas fa-plus text-xs"
                                           aria-hidden="true"></i>
                                    </button>
                                </div>
                                <p id="tahunAgeLabel"
                                   class="text-xs text-gray-400"></p>
                                @error('tahun')
                                <p class="text-xs text-red-600 flex items-center gap-1"
                                   role="alert">
                                    <i class="fas fa-exclamation-circle"
                                       aria-hidden="true"></i>
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>

                            {{-- Kondisi --}}
                            <div class="md:col-span-2 space-y-1.5">
                                <label class="block text-sm font-semibold text-gray-700">
                                    Kondisi Aset
                                    <span class="text-red-500 ml-0.5"
                                          aria-hidden="true">*</span>
                                </label>
                                <div class="grid grid-cols-3 gap-3"
                                     role="radiogroup"
                                     aria-label="Pilih kondisi aset">
                                    @php
                                        $kondisiOpts = [
                                            'Baik'         => [
                                                'icon' => 'fa-check-circle',
                                                'color'=> 'green',
                                                'desc' => 'Aset dalam kondisi prima',
                                            ],
                                            'Rusak Ringan' => [
                                                'icon' => 'fa-exclamation-triangle',
                                                'color'=> 'yellow',
                                                'desc' => 'Perlu perbaikan minor',
                                            ],
                                            'Rusak Berat'  => [
                                                'icon' => 'fa-times-circle',
                                                'color'=> 'red',
                                                'desc' => 'Perlu perbaikan besar',
                                            ],
                                        ];
                                        $colorMap = [
                                            'green'  => [
                                                'ba' => 'border-green-400',
                                                'bg' => 'bg-green-50',
                                                'ic' => 'text-green-600',
                                                'tx' => 'text-green-700',
                                                'rg' => 'ring-green-200',
                                                'hv' => 'hover:border-green-300 hover:bg-green-50/50',
                                            ],
                                            'yellow' => [
                                                'ba' => 'border-yellow-400',
                                                'bg' => 'bg-yellow-50',
                                                'ic' => 'text-yellow-600',
                                                'tx' => 'text-yellow-700',
                                                'rg' => 'ring-yellow-200',
                                                'hv' => 'hover:border-yellow-300 hover:bg-yellow-50/50',
                                            ],
                                            'red'    => [
                                                'ba' => 'border-red-400',
                                                'bg' => 'bg-red-50',
                                                'ic' => 'text-red-600',
                                                'tx' => 'text-red-700',
                                                'rg' => 'ring-red-200',
                                                'hv' => 'hover:border-red-300 hover:bg-red-50/50',
                                            ],
                                        ];
                                        $selectedKondisi = old('kondisi',
                                                               $dashboardAset->kondisi);
                                    @endphp

                                    @foreach($kondisiOpts as $val => $opt)
                                    @php
                                        $cm       = $colorMap[$opt['color']];
                                        $isActive = $selectedKondisi === $val;
                                    @endphp
                                    <label class="relative flex flex-col items-center
                                                  gap-2 p-4 rounded-xl border-2
                                                  cursor-pointer transition-all
                                                  duration-200 text-center
                                                  {{ $isActive
                                                     ? $cm['ba'].' '.$cm['bg'].' ring-2 '.$cm['rg']
                                                     : 'border-gray-200 bg-white '.$cm['hv'] }}"
                                           id="label_kondisi_{{ $loop->index }}">
                                        <input type="radio"
                                               name="kondisi"
                                               value="{{ $val }}"
                                               class="sr-only"
                                               {{ $isActive ? 'checked' : '' }}
                                               onchange="updateKondisiUI()"
                                               aria-labelledby="label_kondisi_{{ $loop->index }}">
                                        <i class="fas {{ $opt['icon'] }} text-2xl
                                                  {{ $isActive
                                                     ? $cm['ic']
                                                     : 'text-gray-300' }}"
                                           aria-hidden="true"></i>
                                        <span class="text-sm font-semibold
                                                     {{ $isActive
                                                        ? $cm['tx']
                                                        : 'text-gray-600' }}">
                                            {{ $val }}
                                        </span>
                                        <span class="text-xs
                                                     {{ $isActive
                                                        ? $cm['tx'].' opacity-80'
                                                        : 'text-gray-400' }}">
                                            {{ $opt['desc'] }}
                                        </span>
                                    </label>
                                    @endforeach
                                </div>
                                @error('kondisi')
                                <p class="text-xs text-red-600 flex items-center gap-1"
                                   role="alert">
                                    <i class="fas fa-exclamation-circle"
                                       aria-hidden="true"></i>
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>

                            {{-- Lokasi --}}
                            <div class="md:col-span-2 space-y-1.5">
                                <label for="lokasi"
                                       class="block text-sm font-semibold text-gray-700">
                                    Lokasi
                                    <span class="text-red-500 ml-0.5"
                                          aria-hidden="true">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5
                                                flex items-center pointer-events-none">
                                        <i class="fas fa-map-marker-alt text-gray-400 text-sm"
                                           aria-hidden="true"></i>
                                    </div>
                                    <input type="text"
                                           id="lokasi"
                                           name="lokasi"
                                           value="{{ old('lokasi',
                                                         $dashboardAset->lokasi) }}"
                                           required maxlength="200"
                                           placeholder="Contoh: Gedung A Lantai 3"
                                           class="w-full pl-10 pr-4 py-3 text-sm
                                                  rounded-xl border transition-all
                                                  duration-200
                                                  @error('lokasi')
                                                      border-red-300 bg-red-50
                                                      focus:border-red-400 focus:ring-2
                                                      focus:ring-red-100
                                                  @else
                                                      border-gray-200 bg-white
                                                      focus:border-violet-400 focus:ring-2
                                                      focus:ring-violet-100
                                                  @enderror
                                                  focus:outline-none text-gray-900
                                                  placeholder-gray-400">
                                </div>
                                @error('lokasi')
                                <p class="text-xs text-red-600 flex items-center gap-1"
                                   role="alert">
                                    <i class="fas fa-exclamation-circle"
                                       aria-hidden="true"></i>
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- ══════════════════════════════════════════════
                         SECTION 2 — NILAI KEUANGAN
                    ══════════════════════════════════════════════ --}}
                    <div class="bg-white rounded-2xl border border-gray-100
                                shadow-sm overflow-hidden">
                        <div class="flex items-center gap-3 px-6 py-4
                                    border-b border-gray-100 bg-gray-50/60">
                            <div class="h-8 w-8 rounded-lg bg-emerald-100
                                        flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-money-bill-wave text-emerald-600 text-sm"
                                   aria-hidden="true"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-gray-800">
                                    Nilai Keuangan
                                </h3>
                                <p class="text-xs text-gray-400 mt-0.5">
                                    Perbarui nilai perolehan dan nilai buku
                                </p>
                            </div>
                            <div class="ml-auto">
                                <span class="text-xs text-gray-400">
                                    Langkah
                                    <span class="font-bold text-violet-600">2</span> / 3
                                </span>
                            </div>
                        </div>

                        <div class="p-6 space-y-5">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                                {{-- Nilai Perolehan --}}
                                <div class="space-y-1.5">
                                    <label for="nilai_perolehan"
                                           class="block text-sm font-semibold text-gray-700">
                                        Nilai Perolehan
                                        <span class="text-red-500 ml-0.5"
                                              aria-hidden="true">*</span>
                                    </label>
                                    <div class="relative flex rounded-xl overflow-hidden
                                                border transition-all duration-200
                                                @error('nilai_perolehan') border-red-300
                                                @else border-gray-200 @enderror
                                                focus-within:border-emerald-400
                                                focus-within:ring-2
                                                focus-within:ring-emerald-100">
                                        <span class="px-4 flex items-center bg-gray-50
                                                     border-r border-gray-200 text-sm
                                                     font-semibold text-gray-500
                                                     flex-shrink-0">
                                            Rp
                                        </span>
                                        <input type="number"
                                               id="nilai_perolehan"
                                               name="nilai_perolehan"
                                               value="{{ old('nilai_perolehan',
                                                             $dashboardAset->nilai_perolehan) }}"
                                               required min="0" max="999999999999"
                                               step="1" placeholder="0"
                                               class="flex-1 px-4 py-3 text-sm
                                                      font-semibold bg-white
                                                      focus:outline-none text-gray-900
                                                      border-0
                                                      @error('nilai_perolehan')
                                                          bg-red-50
                                                      @enderror">
                                    </div>
                                    <p id="np_preview"
                                       class="text-xs font-medium text-emerald-600 hidden">
                                    </p>
                                    {{-- Delta dari nilai asli --}}
                                    <p id="npDelta" class="text-xs hidden"></p>
                                    @error('nilai_perolehan')
                                    <p class="text-xs text-red-600 flex items-center gap-1"
                                       role="alert">
                                        <i class="fas fa-exclamation-circle"
                                           aria-hidden="true"></i>
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>

                                {{-- Nilai Buku --}}
                                <div class="space-y-1.5">
                                    <label for="nilai_buku"
                                           class="block text-sm font-semibold text-gray-700">
                                        Nilai Buku
                                        <span class="text-red-500 ml-0.5"
                                              aria-hidden="true">*</span>
                                    </label>
                                    <div class="relative flex rounded-xl overflow-hidden
                                                border transition-all duration-200
                                                @error('nilai_buku') border-red-300
                                                @else border-gray-200 @enderror
                                                focus-within:border-emerald-400
                                                focus-within:ring-2
                                                focus-within:ring-emerald-100">
                                        <span class="px-4 flex items-center bg-gray-50
                                                     border-r border-gray-200 text-sm
                                                     font-semibold text-gray-500
                                                     flex-shrink-0">
                                            Rp
                                        </span>
                                        <input type="number"
                                               id="nilai_buku"
                                               name="nilai_buku"
                                               value="{{ old('nilai_buku',
                                                             $dashboardAset->nilai_buku) }}"
                                               required min="0" max="999999999999"
                                               step="1" placeholder="0"
                                               class="flex-1 px-4 py-3 text-sm
                                                      font-semibold bg-white
                                                      focus:outline-none text-gray-900
                                                      border-0
                                                      @error('nilai_buku')
                                                          bg-red-50
                                                      @enderror">
                                    </div>
                                    <p id="nb_preview"
                                       class="text-xs font-medium text-emerald-600 hidden">
                                    </p>
                                    <p id="nbDelta" class="text-xs hidden"></p>
                                    @error('nilai_buku')
                                    <p class="text-xs text-red-600 flex items-center gap-1"
                                       role="alert">
                                        <i class="fas fa-exclamation-circle"
                                           aria-hidden="true"></i>
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>

                            {{-- Live Depreciation Panel --}}
                            <div id="depreciationPanel"
                                 class="rounded-xl border border-emerald-100
                                        bg-emerald-50 p-4">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-chart-line text-emerald-600 text-sm"
                                           aria-hidden="true"></i>
                                        <span class="text-sm font-semibold text-emerald-800">
                                            Penyusutan Terkini
                                        </span>
                                    </div>
                                    <button type="button" id="applySuggestion"
                                            class="hidden text-xs font-bold text-emerald-700
                                                   hover:text-emerald-900 underline
                                                   transition-colors">
                                        Terapkan Saran (80%)
                                    </button>
                                </div>
                                <div class="space-y-2">
                                    <div class="flex justify-between text-xs
                                                text-emerald-700">
                                        <span>Nilai Buku / Nilai Perolehan</span>
                                        <span id="depRatio" class="font-bold"></span>
                                    </div>
                                    <div class="w-full bg-emerald-200 rounded-full h-2">
                                        <div id="depBar"
                                             class="h-2 rounded-full transition-all
                                                    duration-500 bg-gradient-to-r
                                                    from-emerald-400 to-emerald-600"
                                             style="width:0%"
                                             role="progressbar"
                                             aria-valuenow="0"
                                             aria-valuemin="0"
                                             aria-valuemax="100">
                                        </div>
                                    </div>
                                    <div class="flex justify-between text-xs
                                                text-emerald-600">
                                        <span>Penyusutan:
                                            <strong id="depAmt"></strong>
                                        </span>
                                        <span id="depPct" class="font-semibold"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ══════════════════════════════════════════════
                         SECTION 3 — KETERANGAN
                    ══════════════════════════════════════════════ --}}
                    <div class="bg-white rounded-2xl border border-gray-100
                                shadow-sm overflow-hidden">
                        <div class="flex items-center gap-3 px-6 py-4
                                    border-b border-gray-100 bg-gray-50/60">
                            <div class="h-8 w-8 rounded-lg bg-violet-100
                                        flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-sticky-note text-violet-600 text-sm"
                                   aria-hidden="true"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-gray-800">
                                    Keterangan
                                    <span class="ml-1.5 text-xs font-normal
                                                 text-gray-400">(opsional)</span>
                                </h3>
                                <p class="text-xs text-gray-400 mt-0.5">
                                    Catat perubahan penting untuk keperluan audit
                                </p>
                            </div>
                            <div class="ml-auto">
                                <span class="text-xs text-gray-400">
                                    Langkah
                                    <span class="font-bold text-violet-600">3</span> / 3
                                </span>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="relative">
                                <textarea id="keterangan"
                                          name="keterangan"
                                          rows="4"
                                          maxlength="1000"
                                          placeholder="Catatan perubahan: alasan update, kondisi terbaru, riwayat perbaikan, dll…"
                                          class="w-full px-4 py-3 text-sm rounded-xl
                                                 border border-gray-200 bg-white
                                                 focus:border-violet-400 focus:ring-2
                                                 focus:ring-violet-100 focus:outline-none
                                                 transition-all duration-200 resize-none
                                                 text-gray-900 placeholder-gray-400
                                                 @error('keterangan')
                                                     border-red-300 bg-red-50
                                                 @enderror">{{ old('keterangan', $dashboardAset->keterangan) }}</textarea>
                                <div class="absolute bottom-3 right-3">
                                    <span id="keteranganCount"
                                          class="text-xs text-gray-300 tabular-nums">
                                        {{ strlen(old('keterangan',
                                                       $dashboardAset->keterangan ?? '')) }}/1000
                                    </span>
                                </div>
                            </div>
                            @error('keterangan')
                            <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1"
                               role="alert">
                                <i class="fas fa-exclamation-circle" aria-hidden="true"></i>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>

                    {{-- ══════════════════════════════════════════════
                         RIWAYAT PERUBAHAN
                    ══════════════════════════════════════════════ --}}
                    @if($dashboardAset->created_at != $dashboardAset->updated_at)
                    <div class="bg-white rounded-2xl border border-gray-100
                                shadow-sm overflow-hidden">
                        <div class="flex items-center gap-3 px-6 py-4
                                    border-b border-gray-100 bg-gray-50/60">
                            <div class="h-8 w-8 rounded-lg bg-gray-100
                                        flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-history text-gray-500 text-sm"
                                   aria-hidden="true"></i>
                            </div>
                            <h3 class="text-sm font-bold text-gray-700">
                                Riwayat Perubahan
                            </h3>
                        </div>
                        <div class="px-6 py-4 grid grid-cols-3 gap-6 text-sm">
                            <div>
                                <p class="text-xs text-gray-400 mb-1">Dibuat</p>
                                <p class="font-semibold text-gray-900">
                                    {{ $dashboardAset->created_at->format('d M Y') }}
                                </p>
                                <p class="text-xs text-gray-400">
                                    {{ $dashboardAset->created_at->format('H:i') }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 mb-1">
                                    Terakhir Diupdate
                                </p>
                                <p class="font-semibold text-gray-900">
                                    {{ $dashboardAset->updated_at->format('d M Y') }}
                                </p>
                                <p class="text-xs text-gray-400">
                                    {{ $dashboardAset->updated_at->format('H:i') }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 mb-1">Selisih</p>
                                <p class="font-semibold text-gray-900">
                                    {{ $dashboardAset->created_at
                                         ->diffForHumans($dashboardAset->updated_at,
                                                         true) }}
                                </p>
                                <p class="text-xs text-gray-400">sejak dibuat</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- ══════════════════════════════════════════════
                         FORM ACTIONS
                    ══════════════════════════════════════════════ --}}
                    <div class="bg-white rounded-2xl border border-gray-100
                                shadow-sm px-6 py-5">
                        <div class="flex flex-col sm:flex-row
                                    sm:items-center sm:justify-between gap-4">
                            <div class="flex items-start gap-2.5">
                                <div class="flex-shrink-0 h-7 w-7 rounded-lg
                                            bg-violet-50 flex items-center
                                            justify-center mt-0.5">
                                    <i class="fas fa-shield-alt text-violet-500 text-xs"
                                       aria-hidden="true"></i>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-gray-700">
                                        Audit Trail
                                    </p>
                                    <p class="text-xs text-gray-400 mt-0.5
                                               leading-relaxed">
                                        Perubahan akan dicatat otomatis oleh sistem.
                                        Kolom <span class="text-red-500">*</span> wajib diisi.
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 flex-shrink-0">
                                <a href="{{ route('admin.dashboard-aset.index') }}"
                                   class="inline-flex items-center gap-2 px-5 py-2.5
                                          bg-white border border-gray-300
                                          hover:border-gray-400 text-gray-700
                                          hover:text-gray-900 text-sm font-medium
                                          rounded-xl shadow-sm hover:shadow
                                          transition-all duration-200 focus:outline-none
                                          focus:ring-2 focus:ring-gray-400">
                                    <i class="fas fa-times text-xs"
                                       aria-hidden="true"></i>
                                    Batal
                                </a>
                                <button type="submit" id="submitBtn"
                                        class="inline-flex items-center gap-2 px-6 py-2.5
                                               bg-gradient-to-r from-violet-600
                                               to-violet-700 hover:from-violet-700
                                               hover:to-violet-800 text-white text-sm
                                               font-bold rounded-xl shadow-md
                                               shadow-violet-200 hover:shadow-lg
                                               hover:shadow-violet-300 transition-all
                                               duration-200 focus:outline-none
                                               focus:ring-2 focus:ring-violet-500
                                               focus:ring-offset-2">
                                    <i class="fas fa-save text-xs"
                                       aria-hidden="true"></i>
                                    Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </div>

                </div>{{-- end space-y-5 --}}
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
    (function () {
        'use strict';

        // ── Nilai asal (untuk delta comparison) ──────────────────────────
        const ORIG = {
            np:   {{ (float) $dashboardAset->nilai_perolehan }},
            nb:   {{ (float) $dashboardAset->nilai_buku }},
            unit: {{ (int)   $dashboardAset->jumlah_unit }},
        };
        const CURRENT_YEAR = {{ (int) $currentYear }};

        // ── Elemen ────────────────────────────────────────────────────────
        const npInput    = document.getElementById('nilai_perolehan');
        const nbInput    = document.getElementById('nilai_buku');
        const npPreview  = document.getElementById('np_preview');
        const nbPreview  = document.getElementById('nb_preview');
        const npDelta    = document.getElementById('npDelta');
        const nbDelta    = document.getElementById('nbDelta');
        const unitInput  = document.getElementById('jumlah_unit');
        const unitDelta  = document.getElementById('unitDelta');
        const tahunInput = document.getElementById('tahun');
        const tahunAge   = document.getElementById('tahunAgeLabel');
        const depBar     = document.getElementById('depBar');
        const depRatio   = document.getElementById('depRatio');
        const depAmt     = document.getElementById('depAmt');
        const depPct     = document.getElementById('depPct');
        const applyBtn   = document.getElementById('applySuggestion');
        const ktInput    = document.getElementById('keterangan');
        const ktCount    = document.getElementById('keteranganCount');
        const form       = document.getElementById('asetForm');
        const submitBtn  = document.getElementById('submitBtn');

        // ── Format Rupiah ─────────────────────────────────────────────────
        function fmt(val) {
            const n = parseFloat(val);
            if (!n || isNaN(n)) return null;
            if (n >= 1_000_000_000)
                return 'Rp ' + (n / 1_000_000_000).toFixed(2) + ' Miliar';
            if (n >= 1_000_000)
                return 'Rp ' + (n / 1_000_000).toFixed(1) + ' Juta';
            if (n >= 1_000)
                return 'Rp ' + n.toLocaleString('id-ID');
            return null;
        }

        // ── Live preview ──────────────────────────────────────────────────
        function updatePreview(input, previewEl) {
            const f = fmt(input.value);
            if (f) {
                previewEl.textContent = '≈ ' + f;
                previewEl.classList.remove('hidden');
            } else {
                previewEl.classList.add('hidden');
            }
        }

        // ── Delta indicator (perubahan dari nilai asli) ───────────────────
        function updateDelta(newVal, origVal, el, prefix) {
            prefix = prefix || '';
            const diff = newVal - origVal;
            if (!diff || isNaN(diff)) {
                el.classList.add('hidden');
                return;
            }
            const sign    = diff > 0 ? '+' : '';
            const color   = diff > 0
                ? 'text-emerald-600'
                : 'text-red-500';
            const arrow   = diff > 0 ? '↑' : '↓';
            const fmtDiff = prefix + sign
                + Math.abs(diff).toLocaleString('id-ID');

            el.className  = 'text-xs font-medium ' + color;
            el.textContent = arrow + ' ' + fmtDiff
                + ' dari nilai sebelumnya';
            el.classList.remove('hidden');
        }

        // ── Depreciation panel ────────────────────────────────────────────
        function updateDepPanel() {
            const np  = parseFloat(npInput.value) || 0;
            const nb  = parseFloat(nbInput.value) || 0;
            if (!np) return;

            const dep     = Math.max(0, np - nb);
            const pct     = Math.round((nb / np) * 100);
            const depPct2 = 100 - pct;

            depRatio.textContent =
                'Rp ' + nb.toLocaleString('id-ID') +
                ' / Rp ' + np.toLocaleString('id-ID');
            depAmt.textContent   = 'Rp ' + dep.toLocaleString('id-ID');
            depPct.textContent   = depPct2 + '% penyusutan';
            depBar.style.width   = Math.min(100, pct) + '%';
            depBar.setAttribute('aria-valuenow', pct);

            // Warna bar: merah jika penyusutan > 50%
            depBar.className = depBar.className
                .replace(/from-\S+/g, '')
                .replace(/to-\S+/g, '');
            if (depPct2 > 50) {
                depBar.classList.add('from-red-400', 'to-red-500');
            } else {
                depBar.classList.add('from-emerald-400', 'to-emerald-600');
            }

            // Tampilkan tombol saran jika nilai buku berbeda signifikan
            // dari 80% nilai perolehan
            const suggested = Math.round(np * 0.8);
            if (Math.abs(nb - suggested) > np * 0.05 && np > 0) {
                applyBtn.classList.remove('hidden');
                applyBtn.textContent =
                    'Terapkan Saran (Rp '
                    + suggested.toLocaleString('id-ID') + ')';
            } else {
                applyBtn.classList.add('hidden');
            }
        }

        // ── Tahun → usia label ────────────────────────────────────────────
        function updateTahunAge() {
            const y    = parseInt(tahunInput.value);
            const usia = CURRENT_YEAR - y;
            if (!isNaN(usia) && usia >= 0) {
                tahunAge.textContent = 'Usia aset: ' + usia + ' tahun';
                tahunAge.className   = 'text-xs ' + (
                    usia > 10 ? 'text-red-500'
                  : usia > 5  ? 'text-yellow-500'
                  : 'text-gray-400'
                );
            } else {
                tahunAge.textContent = '';
            }
        }

        // ── Event listeners ───────────────────────────────────────────────
        npInput.addEventListener('input', function () {
            updatePreview(this, npPreview);
            updateDelta(parseFloat(this.value)||0, ORIG.np, npDelta, 'Rp ');
            updateDepPanel();
        });

        nbInput.addEventListener('input', function () {
            updatePreview(this, nbPreview);
            updateDelta(parseFloat(this.value)||0, ORIG.nb, nbDelta, 'Rp ');
            updateDepPanel();
        });

        unitInput.addEventListener('input', function () {
            const diff = parseInt(this.value) - ORIG.unit;
            if (diff !== 0 && !isNaN(diff)) {
                const sign  = diff > 0 ? '+' : '';
                const color = diff > 0 ? 'text-emerald-600' : 'text-red-500';
                const arrow = diff > 0 ? '↑' : '↓';
                unitDelta.className   = 'text-xs font-medium ' + color;
                unitDelta.textContent =
                    arrow + ' ' + sign + diff + ' unit dari sebelumnya';
                unitDelta.classList.remove('hidden');
            } else {
                unitDelta.classList.add('hidden');
            }
        });

        tahunInput.addEventListener('input', function () {
            updateTahunAge();
            updateDelta(parseInt(this.value)||0, ORIG.nb, null);
        });

        applyBtn.addEventListener('click', function () {
            const np = parseFloat(npInput.value);
            if (!np) return;
            nbInput.value = Math.round(np * 0.8);
            nbInput.dispatchEvent(new Event('input', { bubbles: true }));
            // Flash highlight
            const wrapper = nbInput.closest('div');
            wrapper.classList.add('ring-2', 'ring-emerald-400');
            setTimeout(function () {
                wrapper.classList.remove('ring-2', 'ring-emerald-400');
            }, 1000);
        });

        // ── Karakter counter --─────────────────────────────────────────────
        ktInput && ktInput.addEventListener('input', function () {
            const len      = this.value.length;
            ktCount.textContent = len + '/1000';
            ktCount.className   = 'text-xs tabular-nums ' + (
                len > 950 ? 'text-red-400'
              : len > 800 ? 'text-yellow-500'
              : 'text-gray-300'
            );
        });

        // ── Quick select kategori ─────────────────────────────────────────
        window.setKategori = function (val) {
            document.getElementById('kategori_aset').value = val;
            document.querySelectorAll('.kategori-pill').forEach(function (btn) {
                const active = btn.textContent.trim() === val;
                btn.classList.toggle('border-violet-400', active);
                btn.classList.toggle('text-violet-600',   active);
                btn.classList.toggle('bg-violet-50',      active);
                btn.classList.toggle('border-gray-200',  !active);
                btn.classList.toggle('text-gray-600',    !active);
            });
        };

        // ── Kondisi radio card UI ─────────────────────────────────────────
        window.updateKondisiUI = function () {
            const cm = {
                'Baik':         { ba:'border-green-400',  bg:'bg-green-50',
                                  ic:'text-green-600',    tx:'text-green-700',
                                  rg:'ring-green-200' },
                'Rusak Ringan': { ba:'border-yellow-400', bg:'bg-yellow-50',
                                  ic:'text-yellow-600',   tx:'text-yellow-700',
                                  rg:'ring-yellow-200' },
                'Rusak Berat':  { ba:'border-red-400',    bg:'bg-red-50',
                                  ic:'text-red-600',      tx:'text-red-700',
                                  rg:'ring-red-200' },
            };
            document.querySelectorAll('input[name="kondisi"]')
                .forEach(function (radio) {
                    const label  = radio.closest('label');
                    const icon   = label.querySelector('i');
                    const spans  = label.querySelectorAll('span');
                    const active = radio.checked;
                    const c      = cm[radio.value];
                    if (!c) return;

                    // Reset border/bg/ring
                    ['border-green-400','border-yellow-400','border-red-400',
                     'border-gray-200','bg-green-50','bg-yellow-50','bg-red-50',
                     'bg-white','ring-2','ring-green-200','ring-yellow-200',
                     'ring-red-200'].forEach(function (cls) {
                        label.classList.remove(cls);
                    });

                    if (active) {
                        label.classList.add(c.ba, c.bg, 'ring-2', c.rg);
                        icon.className  = icon.className
                            .replace(/text-\S+/g, '') + ' ' + c.ic;
                        if (spans[0]) spans[0].className =
                            spans[0].className.replace(/text-\S+/g,'') +' '+ c.tx;
                        if (spans[1]) spans[1].className =
                            spans[1].className.replace(/text-\S+/g,'')
                            +' '+ c.tx +' opacity-80';
                    } else {
                        label.classList.add('border-gray-200', 'bg-white');
                        icon.className  = icon.className
                            .replace(/text-\S+/g, '') + ' text-gray-300';
                        if (spans[0]) spans[0].className =
                            spans[0].className.replace(/text-\S+/g,'')
                            + ' text-gray-600';
                        if (spans[1]) spans[1].className =
                            spans[1].className.replace(/text-\S+/g,'')
                            + ' text-gray-400';
                    }
                });
        };

        // ── Stepper +/− ───────────────────────────────────────────────────
        window.stepNumber = function (id, delta) {
            const el  = document.getElementById(id);
            const min = parseFloat(el.min) || -Infinity;
            const max = parseFloat(el.max) ||  Infinity;
            el.value  = Math.min(max, Math.max(min,
                (parseFloat(el.value) || 0) + delta));
            el.dispatchEvent(new Event('input', { bubbles: true }));
        };

        // ── Focus → select all ────────────────────────────────────────────
        document.querySelectorAll('input[type="number"]')
            .forEach(function (el) {
                el.addEventListener('focus', function () { this.select(); });
            });

        // ── Anti double-submit ────────────────────────────────────────────
        form.addEventListener('submit', function () {
            submitBtn.disabled = true;
            submitBtn.innerHTML =
                '<i class="fas fa-spinner fa-spin text-xs mr-2"></i>Menyimpan…';
        });

        // ── Init (populate on load) ───────────────────────────────────────
        updatePreview(npInput, npPreview);
        updatePreview(nbInput, nbPreview);
        updateDepPanel();
        updateTahunAge();
        if (ktInput && ktInput.value)
            ktInput.dispatchEvent(new Event('input'));

    }());
    </script>
    @endpush
</x-app-layout>
