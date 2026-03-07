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
                    <span class="font-medium text-gray-700" aria-current="page">
                        Tambah Aset
                    </span>
                </li>
            </ol>
        </nav>

        <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
            <div class="flex items-start gap-3 min-w-0">
                <div class="flex-shrink-0 h-11 w-11 rounded-xl
                            bg-gradient-to-br from-emerald-500 to-emerald-700
                            flex items-center justify-center shadow-md shadow-emerald-200">
                    <i class="fas fa-plus text-white text-lg" aria-hidden="true"></i>
                </div>
                <div class="min-w-0">
                    <h2 class="text-xl font-bold text-gray-900 leading-tight">
                        Tambah Data Aset
                    </h2>
                    <p class="mt-0.5 text-sm text-gray-500">
                        Tambahkan data aset BMN baru ke dalam sistem
                    </p>
                </div>
            </div>
            <a href="{{ route('admin.dashboard-aset.index') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 self-start sm:self-auto
                      bg-white border border-gray-300 hover:border-gray-400
                      text-gray-700 hover:text-gray-900 text-sm font-medium
                      rounded-xl shadow-sm hover:shadow transition-all duration-200
                      focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">
                <i class="fas fa-arrow-left text-xs" aria-hidden="true"></i>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- ── Error Alert ────────────────────────────────────────── --}}
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
                        <ul class="text-sm text-red-600 space-y-0.5 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif

            <form action="{{ route('admin.dashboard-aset.store') }}"
                  method="POST"
                  id="asetForm"
                  novalidate>
                @csrf

                <div class="space-y-5">

                    {{-- ══════════════════════════════════════════════
                         SECTION 1 — IDENTITAS ASET
                    ══════════════════════════════════════════════ --}}
                    <div class="bg-white rounded-2xl border border-gray-100
                                shadow-sm overflow-hidden">

                        {{-- Section header --}}
                        <div class="flex items-center gap-3 px-6 py-4
                                    border-b border-gray-100 bg-gray-50/60">
                            <div class="h-8 w-8 rounded-lg bg-blue-100
                                        flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-tag text-blue-600 text-sm"
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
                                    Langkah <span class="font-bold text-blue-600">1</span> / 3
                                </span>
                            </div>
                        </div>

                        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">

                            {{-- Kategori Aset --}}
                            <div class="md:col-span-2 space-y-1.5">
                                <label for="kategori_aset"
                                       class="block text-sm font-semibold text-gray-700">
                                    Kategori Aset
                                    <span class="text-red-500 ml-0.5" aria-hidden="true">*</span>
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
                                           value="{{ old('kategori_aset') }}"
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
                                                      focus:border-blue-400 focus:ring-2
                                                      focus:ring-blue-100
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
                                    @foreach(['Kendaraan','Elektronik','Furniture','Bangunan','Tanah','Mesin'] as $kat)
                                    <button type="button"
                                            onclick="setKategori('{{ $kat }}')"
                                            class="px-2.5 py-1 text-xs font-medium rounded-lg
                                                   border border-gray-200 text-gray-600
                                                   hover:border-blue-400 hover:text-blue-600
                                                   hover:bg-blue-50 transition-all duration-150
                                                   kategori-pill">
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
                                    <span class="text-red-500 ml-0.5" aria-hidden="true">*</span>
                                </label>
                                <div class="relative flex rounded-xl overflow-hidden
                                            border transition-all duration-200
                                            @error('jumlah_unit') border-red-300
                                            @else border-gray-200 @enderror
                                            focus-within:border-blue-400
                                            focus-within:ring-2 focus-within:ring-blue-100">
                                    {{-- Minus button --}}
                                    <button type="button" onclick="stepNumber('jumlah_unit', -1)"
                                            class="px-3.5 bg-gray-50 hover:bg-gray-100
                                                   text-gray-500 hover:text-gray-700
                                                   border-r border-gray-200
                                                   transition-colors flex-shrink-0"
                                            aria-label="Kurangi jumlah unit">
                                        <i class="fas fa-minus text-xs" aria-hidden="true"></i>
                                    </button>
                                    <input type="number"
                                           id="jumlah_unit"
                                           name="jumlah_unit"
                                           value="{{ old('jumlah_unit', 1) }}"
                                           required min="1" max="999999" step="1"
                                           class="flex-1 px-4 py-3 text-sm text-center
                                                  font-semibold bg-white focus:outline-none
                                                  text-gray-900 border-0
                                                  @error('jumlah_unit') bg-red-50 @enderror">
                                    {{-- Plus button --}}
                                    <button type="button" onclick="stepNumber('jumlah_unit', 1)"
                                            class="px-3.5 bg-gray-50 hover:bg-gray-100
                                                   text-gray-500 hover:text-gray-700
                                                   border-l border-gray-200
                                                   transition-colors flex-shrink-0"
                                            aria-label="Tambah jumlah unit">
                                        <i class="fas fa-plus text-xs" aria-hidden="true"></i>
                                    </button>
                                </div>
                                @error('jumlah_unit')
                                <p class="text-xs text-red-600 flex items-center gap-1"
                                   role="alert">
                                    <i class="fas fa-exclamation-circle" aria-hidden="true"></i>
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>

                            {{-- Tahun --}}
                            <div class="space-y-1.5">
                                <label for="tahun"
                                       class="block text-sm font-semibold text-gray-700">
                                    Tahun Pengadaan
                                    <span class="text-red-500 ml-0.5" aria-hidden="true">*</span>
                                </label>
                                <div class="relative flex rounded-xl overflow-hidden
                                            border transition-all duration-200
                                            @error('tahun') border-red-300
                                            @else border-gray-200 @enderror
                                            focus-within:border-blue-400
                                            focus-within:ring-2 focus-within:ring-blue-100">
                                    <button type="button" onclick="stepNumber('tahun', -1)"
                                            class="px-3.5 bg-gray-50 hover:bg-gray-100
                                                   text-gray-500 hover:text-gray-700
                                                   border-r border-gray-200
                                                   transition-colors flex-shrink-0"
                                            aria-label="Kurangi tahun">
                                        <i class="fas fa-minus text-xs" aria-hidden="true"></i>
                                    </button>
                                    <input type="number"
                                           id="tahun"
                                           name="tahun"
                                           value="{{ old('tahun', $currentYear) }}"
                                           required min="2000" max="{{ $currentYear + 1 }}"
                                           class="flex-1 px-4 py-3 text-sm text-center
                                                  font-semibold bg-white focus:outline-none
                                                  text-gray-900 border-0
                                                  @error('tahun') bg-red-50 @enderror">
                                    <button type="button" onclick="stepNumber('tahun', 1)"
                                            class="px-3.5 bg-gray-50 hover:bg-gray-100
                                                   text-gray-500 hover:text-gray-700
                                                   border-l border-gray-200
                                                   transition-colors flex-shrink-0"
                                            aria-label="Tambah tahun">
                                        <i class="fas fa-plus text-xs" aria-hidden="true"></i>
                                    </button>
                                </div>
                                <p class="text-xs text-gray-400">
                                    Rentang: 2000 – {{ $currentYear + 1 }}
                                </p>
                                @error('tahun')
                                <p class="text-xs text-red-600 flex items-center gap-1"
                                   role="alert">
                                    <i class="fas fa-exclamation-circle" aria-hidden="true"></i>
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>

                            {{-- Kondisi --}}
                            <div class="md:col-span-2 space-y-1.5">
                                <label class="block text-sm font-semibold text-gray-700">
                                    Kondisi Aset
                                    <span class="text-red-500 ml-0.5" aria-hidden="true">*</span>
                                </label>
                                {{-- Kondisi card selector --}}
                                <div class="grid grid-cols-3 gap-3" role="radiogroup"
                                     aria-label="Pilih kondisi aset">
                                    @php
                                        $kondisiOpts = [
                                            'Baik'         => ['icon' => 'fa-check-circle',        'color' => 'green',  'desc' => 'Aset dalam kondisi prima'],
                                            'Rusak Ringan' => ['icon' => 'fa-exclamation-triangle', 'color' => 'yellow', 'desc' => 'Perlu perbaikan minor'],
                                            'Rusak Berat'  => ['icon' => 'fa-times-circle',         'color' => 'red',    'desc' => 'Perlu perbaikan besar'],
                                        ];
                                        $selectedKondisi = old('kondisi', '');
                                    @endphp
                                    @foreach($kondisiOpts as $val => $opt)
                                    @php
                                        $c = $opt['color'];
                                        $colorMap = [
                                            'green'  => ['border_active' => 'border-green-400',  'bg_active' => 'bg-green-50',  'icon_active' => 'text-green-600',  'text_active' => 'text-green-700',  'ring' => 'ring-green-200',  'border_base' => 'border-gray-200', 'hover' => 'hover:border-green-300  hover:bg-green-50/50'],
                                            'yellow' => ['border_active' => 'border-yellow-400', 'bg_active' => 'bg-yellow-50', 'icon_active' => 'text-yellow-600', 'text_active' => 'text-yellow-700', 'ring' => 'ring-yellow-200', 'border_base' => 'border-gray-200', 'hover' => 'hover:border-yellow-300 hover:bg-yellow-50/50'],
                                            'red'    => ['border_active' => 'border-red-400',    'bg_active' => 'bg-red-50',    'icon_active' => 'text-red-600',    'text_active' => 'text-red-700',    'ring' => 'ring-red-200',    'border_base' => 'border-gray-200', 'hover' => 'hover:border-red-300    hover:bg-red-50/50'],
                                        ];
                                        $cm = $colorMap[$c];
                                        $isActive = $selectedKondisi === $val;
                                    @endphp
                                    <label class="relative flex flex-col items-center gap-2
                                                  p-4 rounded-xl border-2 cursor-pointer
                                                  transition-all duration-200 text-center
                                                  {{ $isActive
                                                     ? $cm['border_active'].' '.$cm['bg_active'].' ring-2 '.$cm['ring']
                                                     : $cm['border_base'].' bg-white '.$cm['hover'] }}"
                                           id="label_kondisi_{{ $loop->index }}">
                                        <input type="radio" name="kondisi" value="{{ $val }}"
                                               class="sr-only"
                                               {{ $isActive ? 'checked' : '' }}
                                               onchange="updateKondisiUI()"
                                               aria-labelledby="label_kondisi_{{ $loop->index }}">
                                        <i class="fas {{ $opt['icon'] }} text-2xl
                                                  {{ $isActive ? $cm['icon_active'] : 'text-gray-300' }}"
                                           aria-hidden="true"></i>
                                        <span class="text-sm font-semibold
                                                     {{ $isActive ? $cm['text_active'] : 'text-gray-600' }}">
                                            {{ $val }}
                                        </span>
                                        <span class="text-xs {{ $isActive ? $cm['text_active'].' opacity-80' : 'text-gray-400' }}">
                                            {{ $opt['desc'] }}
                                        </span>
                                    </label>
                                    @endforeach
                                </div>
                                @error('kondisi')
                                <p class="text-xs text-red-600 flex items-center gap-1"
                                   role="alert">
                                    <i class="fas fa-exclamation-circle" aria-hidden="true"></i>
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>

                            {{-- Lokasi --}}
                            <div class="md:col-span-2 space-y-1.5">
                                <label for="lokasi"
                                       class="block text-sm font-semibold text-gray-700">
                                    Lokasi
                                    <span class="text-red-500 ml-0.5" aria-hidden="true">*</span>
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
                                           value="{{ old('lokasi') }}"
                                           required maxlength="200"
                                           placeholder="Contoh: Gedung A Lantai 3, Ruang Rapat"
                                           class="w-full pl-10 pr-4 py-3 text-sm rounded-xl
                                                  border transition-all duration-200
                                                  @error('lokasi')
                                                      border-red-300 bg-red-50
                                                      focus:border-red-400 focus:ring-2
                                                      focus:ring-red-100
                                                  @else
                                                      border-gray-200 bg-white
                                                      focus:border-blue-400 focus:ring-2
                                                      focus:ring-blue-100
                                                  @enderror
                                                  focus:outline-none text-gray-900
                                                  placeholder-gray-400">
                                </div>
                                @error('lokasi')
                                <p class="text-xs text-red-600 flex items-center gap-1"
                                   role="alert">
                                    <i class="fas fa-exclamation-circle" aria-hidden="true"></i>
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
                                    Data nilai perolehan dan nilai buku aset
                                </p>
                            </div>
                            <div class="ml-auto">
                                <span class="text-xs text-gray-400">
                                    Langkah <span class="font-bold text-blue-600">2</span> / 3
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
                                                     font-semibold text-gray-500 flex-shrink-0">
                                            Rp
                                        </span>
                                        <input type="number"
                                               id="nilai_perolehan"
                                               name="nilai_perolehan"
                                               value="{{ old('nilai_perolehan') }}"
                                               required min="0" max="999999999999" step="1"
                                               placeholder="0"
                                               class="flex-1 px-4 py-3 text-sm font-semibold
                                                      bg-white focus:outline-none text-gray-900
                                                      border-0
                                                      @error('nilai_perolehan') bg-red-50 @enderror"
                                               aria-describedby="np_hint">
                                    </div>
                                    <p id="np_hint" class="text-xs text-gray-400">
                                        Nilai saat pertama kali memperoleh aset
                                    </p>
                                    {{-- Live format preview --}}
                                    <p id="np_preview"
                                       class="text-xs font-medium text-emerald-600 hidden">
                                    </p>
                                    @error('nilai_perolehan')
                                    <p class="text-xs text-red-600 flex items-center gap-1"
                                       role="alert">
                                        <i class="fas fa-exclamation-circle" aria-hidden="true"></i>
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
                                                     font-semibold text-gray-500 flex-shrink-0">
                                            Rp
                                        </span>
                                        <input type="number"
                                               id="nilai_buku"
                                               name="nilai_buku"
                                               value="{{ old('nilai_buku') }}"
                                               required min="0" max="999999999999" step="1"
                                               placeholder="0"
                                               class="flex-1 px-4 py-3 text-sm font-semibold
                                                      bg-white focus:outline-none text-gray-900
                                                      border-0
                                                      @error('nilai_buku') bg-red-50 @enderror"
                                               aria-describedby="nb_hint">
                                    </div>
                                    <p id="nb_hint" class="text-xs text-gray-400">
                                        Nilai aset setelah penyusutan (≤ nilai perolehan)
                                    </p>
                                    {{-- Live format preview --}}
                                    <p id="nb_preview"
                                       class="text-xs font-medium text-emerald-600 hidden">
                                    </p>
                                    @error('nilai_buku')
                                    <p class="text-xs text-red-600 flex items-center gap-1"
                                       role="alert">
                                        <i class="fas fa-exclamation-circle" aria-hidden="true"></i>
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>

                            {{-- Auto-suggest + Depreciation visualizer --}}
                            <div id="depreciationPanel"
                                 class="hidden rounded-xl border border-emerald-100
                                        bg-emerald-50 p-4">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-calculator text-emerald-600 text-sm"
                                           aria-hidden="true"></i>
                                        <span class="text-sm font-semibold text-emerald-800">
                                            Kalkulasi Penyusutan
                                        </span>
                                    </div>
                                    <button type="button" id="applySuggestion"
                                            class="text-xs font-bold text-emerald-700
                                                   hover:text-emerald-900 underline
                                                   transition-colors">
                                        Terapkan Saran
                                    </button>
                                </div>

                                {{-- Depreciation bar --}}
                                <div class="space-y-2">
                                    <div class="flex justify-between text-xs text-emerald-700">
                                        <span>Nilai Buku Disarankan</span>
                                        <span id="suggestedLabel" class="font-bold"></span>
                                    </div>
                                    <div class="w-full bg-emerald-200 rounded-full h-2">
                                        <div id="depreciationBar"
                                             class="bg-gradient-to-r from-emerald-400
                                                    to-emerald-600 h-2 rounded-full
                                                    transition-all duration-500"
                                             style="width: 80%">
                                        </div>
                                    </div>
                                    <div class="flex justify-between text-xs text-emerald-600">
                                        <span>Penyusutan:
                                            <strong id="depreciationAmt"></strong>
                                        </span>
                                        <span id="depreciationPct" class="font-semibold"></span>
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
                                    Informasi tambahan untuk keperluan audit
                                </p>
                            </div>
                            <div class="ml-auto">
                                <span class="text-xs text-gray-400">
                                    Langkah <span class="font-bold text-blue-600">3</span> / 3
                                </span>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="relative">
                                <textarea id="keterangan"
                                          name="keterangan"
                                          rows="4" maxlength="1000"
                                          placeholder="Catatan tambahan: nomor seri, merek, kondisi detail, riwayat perbaikan, dll…"
                                          class="w-full px-4 py-3 text-sm rounded-xl
                                                 border border-gray-200 bg-white
                                                 focus:border-violet-400 focus:ring-2
                                                 focus:ring-violet-100 focus:outline-none
                                                 transition-all duration-200 resize-none
                                                 text-gray-900 placeholder-gray-400
                                                 @error('keterangan') border-red-300 bg-red-50 @enderror">{{ old('keterangan') }}</textarea>
                                {{-- Character counter --}}
                                <div class="absolute bottom-3 right-3">
                                    <span id="keteranganCount"
                                          class="text-xs text-gray-300 tabular-nums">
                                        0/1000
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
                         FORM ACTIONS
                    ══════════════════════════════════════════════ --}}
                    <div class="bg-white rounded-2xl border border-gray-100
                                shadow-sm px-6 py-5">
                        <div class="flex flex-col sm:flex-row
                                    sm:items-center sm:justify-between gap-4">

                            {{-- Tips --}}
                            <div class="flex items-start gap-2.5">
                                <div class="flex-shrink-0 h-7 w-7 rounded-lg bg-blue-50
                                            flex items-center justify-center mt-0.5">
                                    <i class="fas fa-lightbulb text-blue-500 text-xs"
                                       aria-hidden="true"></i>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-gray-700">Tips</p>
                                    <p class="text-xs text-gray-400 mt-0.5 leading-relaxed">
                                        Nilai buku ≤ nilai perolehan.
                                        Kolom <span class="text-red-500">*</span> wajib diisi.
                                    </p>
                                </div>
                            </div>

                            {{-- Buttons --}}
                            <div class="flex items-center gap-3 flex-shrink-0">
                                <a href="{{ route('admin.dashboard-aset.index') }}"
                                   class="inline-flex items-center gap-2 px-5 py-2.5
                                          bg-white border border-gray-300
                                          hover:border-gray-400 text-gray-700
                                          hover:text-gray-900 text-sm font-medium
                                          rounded-xl shadow-sm hover:shadow
                                          transition-all duration-200 focus:outline-none
                                          focus:ring-2 focus:ring-gray-400">
                                    <i class="fas fa-times text-xs" aria-hidden="true"></i>
                                    Batal
                                </a>
                                <button type="submit" id="submitBtn"
                                        class="inline-flex items-center gap-2 px-6 py-2.5
                                               bg-gradient-to-r from-emerald-600 to-emerald-700
                                               hover:from-emerald-700 hover:to-emerald-800
                                               text-white text-sm font-bold rounded-xl
                                               shadow-md shadow-emerald-200
                                               hover:shadow-lg hover:shadow-emerald-300
                                               transition-all duration-200 focus:outline-none
                                               focus:ring-2 focus:ring-emerald-500
                                               focus:ring-offset-2">
                                    <i class="fas fa-save text-xs" aria-hidden="true"></i>
                                    Simpan Data
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

        // ── Elemen ────────────────────────────────────────────────────────
        const npInput          = document.getElementById('nilai_perolehan');
        const nbInput          = document.getElementById('nilai_buku');
        const npPreview        = document.getElementById('np_preview');
        const nbPreview        = document.getElementById('nb_preview');
        const depPanel         = document.getElementById('depreciationPanel');
        const depBar           = document.getElementById('depreciationBar');
        const suggestedLabel   = document.getElementById('suggestedLabel');
        const depreciationAmt  = document.getElementById('depreciationAmt');
        const depreciationPct  = document.getElementById('depreciationPct');
        const applySuggestion  = document.getElementById('applySuggestion');
        const keteranganInput  = document.getElementById('keterangan');
        const keteranganCount  = document.getElementById('keteranganCount');
        const form             = document.getElementById('asetForm');
        const submitBtn        = document.getElementById('submitBtn');

        // ── Format Rupiah ─────────────────────────────────────────────────
        function formatRupiah(val) {
            if (!val || isNaN(val)) return null;
            const n = parseFloat(val);
            if (n >= 1_000_000_000)
                return 'Rp ' + (n / 1_000_000_000).toFixed(2) + ' Miliar';
            if (n >= 1_000_000)
                return 'Rp ' + (n / 1_000_000).toFixed(1) + ' Juta';
            if (n >= 1_000)
                return 'Rp ' + n.toLocaleString('id-ID');
            return null;
        }

        // ── Live preview nilai ────────────────────────────────────────────
        function updatePreview(input, previewEl) {
            const formatted = formatRupiah(input.value);
            if (formatted) {
                previewEl.textContent = '≈ ' + formatted;
                previewEl.classList.remove('hidden');
            } else {
                previewEl.classList.add('hidden');
            }
        }

        npInput.addEventListener('input', function () {
            updatePreview(this, npPreview);
            updateDepreciationPanel();
        });

        nbInput.addEventListener('input', function () {
            updatePreview(this, nbPreview);
        });

        // ── Depreciation panel ────────────────────────────────────────────
        function updateDepreciationPanel() {
            const np = parseFloat(npInput.value);
            if (!np || np <= 0) {
                depPanel.classList.add('hidden');
                return;
            }

            const suggested = Math.round(np * 0.8);
            const pct       = 80;
            const dep       = np - suggested;

            suggestedLabel.textContent  = 'Rp ' + suggested.toLocaleString('id-ID');
            depreciationAmt.textContent = 'Rp ' + dep.toLocaleString('id-ID');
            depreciationPct.textContent = pct + '% dari nilai perolehan';
            depBar.style.width          = pct + '%';
            depPanel.classList.remove('hidden');
        }

        applySuggestion && applySuggestion.addEventListener('click', function () {
            const np = parseFloat(npInput.value);
            if (!np) return;
            nbInput.value = Math.round(np * 0.8);
            updatePreview(nbInput, nbPreview);
            // Highlight input sebentar
            nbInput.closest('div').classList.add('ring-2', 'ring-emerald-400');
            setTimeout(function () {
                nbInput.closest('div').classList.remove('ring-2', 'ring-emerald-400');
            }, 1000);
        });

        // ── Karakter counter keterangan ───────────────────────────────────
        keteranganInput && keteranganInput.addEventListener('input', function () {
            const len = this.value.length;
            keteranganCount.textContent = len + '/1000';
            keteranganCount.className = len > 950
                ? 'text-xs text-red-400 tabular-nums'
                : len > 800
                    ? 'text-xs text-yellow-500 tabular-nums'
                    : 'text-xs text-gray-300 tabular-nums';
        });

        // ── Quick select kategori ─────────────────────────────────────────
        window.setKategori = function (val) {
            const input = document.getElementById('kategori_aset');
            input.value = val;
            // Update active pill style
            document.querySelectorAll('.kategori-pill').forEach(function (btn) {
                if (btn.textContent.trim() === val) {
                    btn.classList.add('border-blue-400', 'text-blue-600', 'bg-blue-50');
                    btn.classList.remove('border-gray-200', 'text-gray-600');
                } else {
                    btn.classList.remove('border-blue-400', 'text-blue-600', 'bg-blue-50');
                    btn.classList.add('border-gray-200', 'text-gray-600');
                }
            });
            // Trigger icon preview update
            updateKategoriIcon(val);
        };

        // ── Kondisi radio card UI update ──────────────────────────────────
        window.updateKondisiUI = function () {
            const radios = document.querySelectorAll('input[name="kondisi"]');
            const colorMap = {
                'Baik':         { border: 'border-green-400',  bg: 'bg-green-50',  icon: 'text-green-600',  text: 'text-green-700',  ring: 'ring-green-200'  },
                'Rusak Ringan': { border: 'border-yellow-400', bg: 'bg-yellow-50', icon: 'text-yellow-600', text: 'text-yellow-700', ring: 'ring-yellow-200' },
                'Rusak Berat':  { border: 'border-red-400',    bg: 'bg-red-50',    icon: 'text-red-600',    text: 'text-red-700',    ring: 'ring-red-200'    },
            };

            radios.forEach(function (radio) {
                const label = radio.closest('label');
                const icon  = label.querySelector('i');
                const spans = label.querySelectorAll('span');
                const cm    = colorMap[radio.value];

                // Reset semua
                label.className = label.className
                    .replace(/border-\S+/g, '')
                    .replace(/bg-\S+/g, '')
                    .replace(/ring-\d+\s/g, '')
                    .replace(/ring-\S+-\d+/g, '');

                if (radio.checked && cm) {
                    label.classList.add(
                        cm.border, cm.bg, 'ring-2', cm.ring,
                        'relative','flex','flex-col','items-center',
                        'gap-2','p-4','rounded-xl','border-2',
                        'cursor-pointer','transition-all','duration-200','text-center'
                    );
                    icon.className  = icon.className.replace(/text-\S+/g, cm.icon);
                    spans[0] && (spans[0].className = spans[0].className.replace(/text-\S+/g, cm.text));
                    spans[1] && (spans[1].className = spans[1].className.replace(/text-\S+/g, cm.text + ' opacity-80'));
                } else {
                    label.classList.add(
                        'border-gray-200','bg-white',
                        'hover:border-gray-300','hover:bg-gray-50/50',
                        'relative','flex','flex-col','items-center',
                        'gap-2','p-4','rounded-xl','border-2',
                        'cursor-pointer','transition-all','duration-200','text-center'
                    );
                    icon.className  = icon.className.replace(/text-\S+/g, 'text-gray-300');
                    spans[0] && (spans[0].className = spans[0].className.replace(/text-\S+/g, 'text-gray-600'));
                    spans[1] && (spans[1].className = spans[1].className.replace(/text-\S+/g, 'text-gray-400'));
                }
            });
        };

        // ── Stepper +/- ───────────────────────────────────────────────────
        window.stepNumber = function (id, delta) {
            const input = document.getElementById(id);
            const min   = parseFloat(input.min) || -Infinity;
            const max   = parseFloat(input.max) ||  Infinity;
            const curr  = parseFloat(input.value) || 0;
            input.value = Math.min(max, Math.max(min, curr + delta));
            input.dispatchEvent(new Event('input', { bubbles: true }));
        };

        // ── Focus → select all ────────────────────────────────────────────
        document.querySelectorAll('input[type="number"]').forEach(function (el) {
            el.addEventListener('focus', function () { this.select(); });
        });

        // ── Anti double-submit ────────────────────────────────────────────
        form.addEventListener('submit', function () {
            submitBtn.disabled = true;
            submitBtn.innerHTML =
                '<i class="fas fa-spinner fa-spin text-xs mr-2"></i>Menyimpan…';
        });

        // ── Init preview jika ada old() value (setelah validation error) ──
        updatePreview(npInput, npPreview);
        updatePreview(nbInput, nbPreview);
        updateDepreciationPanel();
        if (keteranganInput && keteranganInput.value) {
            keteranganInput.dispatchEvent(new Event('input'));
        }

    }());
    </script>
    @endpush
</x-app-layout>
