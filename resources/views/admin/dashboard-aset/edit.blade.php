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
                    <a href="{{ route('admin.dashboard-aset.index') }}" class="hover:text-blue-600 transition-colors">
                        Manajemen Aset
                    </a>
                </li>
                <li aria-hidden="true">
                    <i class="fas fa-chevron-right text-[9px] text-gray-300"></i>
                </li>
                <li>
                    <a href="{{ route('admin.dashboard-aset.show', $dashboardAset) }}"
                        class="hover:text-blue-600 transition-colors truncate max-w-[120px] inline-block">
                        {{ $dashboardAset->kategori_aset }}
                    </a>
                </li>
                <li aria-hidden="true">
                    <i class="fas fa-chevron-right text-[9px] text-gray-300"></i>
                </li>
                <li>
                    <span class="font-medium text-gray-700" aria-current="page">
                        Edit
                    </span>
                </li>
            </ol>
        </nav>

        {{-- Header utama --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

            {{-- Judul + meta --}}
            <div class="flex items-start gap-3 min-w-0">
                <div
                    class="flex-shrink-0 h-11 w-11 rounded-xl
                        bg-gradient-to-br from-violet-500 to-violet-700
                        flex items-center justify-center shadow-md shadow-violet-200">
                    <i class="fas fa-edit text-white text-lg" aria-hidden="true"></i>
                </div>
                <div class="min-w-0">
                    <h2 class="text-xl font-bold text-gray-900 leading-tight truncate">
                        Edit Data Aset
                    </h2>
                    <p class="mt-0.5 text-sm text-gray-500 leading-snug truncate">
                        {{ $dashboardAset->kategori_aset }}
                    </p>
                    {{-- Meta badge --}}
                    <div class="flex items-center gap-2 mt-1.5 flex-wrap">
                        <span
                            class="inline-flex items-center gap-1 px-2 py-0.5
                                 bg-gray-100 text-gray-600 rounded-md text-xs font-mono">
                            <i class="fas fa-fingerprint text-[10px]" aria-hidden="true"></i>
                            ASET{{ str_pad($dashboardAset->id, 4, '0', STR_PAD_LEFT) }}
                        </span>
                        <span
                            class="inline-flex items-center gap-1 px-2 py-0.5
                                 bg-gray-100 text-gray-600 rounded-md text-xs">
                            <i class="fas fa-clock text-[10px]" aria-hidden="true"></i>
                            {{ $dashboardAset->updated_at->format('d M Y, H:i') }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Aksi --}}
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

            {{-- Ringkasan data saat ini --}}
            <div
                class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-6 mb-8
                        border border-blue-200">
                <h3 class="text-sm font-semibold text-gray-700 mb-4 flex items-center gap-2">
                    <i class="fas fa-history text-blue-500" aria-hidden="true"></i>
                    Data Sebelum Perubahan
                </h3>
                @php
                    $kondisiColors = [
                        'Baik' => 'bg-green-100 text-green-800',
                        'Rusak Ringan' => 'bg-yellow-100 text-yellow-800',
                        'Rusak Berat' => 'bg-red-100 text-red-800',
                    ];
                @endphp
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
                    <div>
                        <div class="text-xl font-bold text-gray-900">{{ $dashboardAset->jumlah_unit }}</div>
                        <div class="text-xs text-gray-500 mt-1">Unit</div>
                    </div>
                    <div>
                        <div class="text-lg font-bold text-gray-900">
                            Rp {{ number_format($dashboardAset->nilai_buku / 1_000_000, 1) }}Jt
                        </div>
                        <div class="text-xs text-gray-500 mt-1">Nilai Buku</div>
                    </div>
                    <div>
                        <div class="text-xl font-bold text-gray-900">{{ $dashboardAset->tahun }}</div>
                        <div class="text-xs text-gray-500 mt-1">Tahun</div>
                    </div>
                    <div>
                        <span
                            class="px-3 py-1 rounded-full text-xs font-medium
                                     {{ $kondisiColors[$dashboardAset->kondisi] ?? 'bg-gray-100 text-gray-800' }}">
                            {{ $dashboardAset->kondisi }}
                        </span>
                        <div class="text-xs text-gray-500 mt-1">Kondisi</div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-200">
                {{-- Header --}}
                <div
                    class="bg-gradient-to-r from-purple-50 to-indigo-50 px-6 py-4
                            border-b border-gray-200">
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 rounded-lg bg-purple-500 flex items-center justify-center">
                            <i class="fas fa-edit text-white" aria-hidden="true"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Form Edit Aset</h3>
                            <p class="text-sm text-gray-600">Perbarui data aset dengan informasi terbaru</p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.dashboard-aset.update', $dashboardAset) }}" method="POST" id="asetForm"
                    novalidate class="p-6">
                    @csrf
                    @method('PUT')

                    {{-- Error summary --}}
                    @if ($errors->any())
                        <div class="mb-6 bg-red-50 border-l-4 border-red-500 rounded-xl p-4" role="alert">
                            <div class="flex items-start gap-3">
                                <div
                                    class="h-10 w-10 rounded-full bg-red-100 flex items-center
                                        justify-center flex-shrink-0">
                                    <i class="fas fa-exclamation-triangle text-red-600" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-red-800">
                                        Terdapat {{ $errors->count() }} kesalahan
                                    </h4>
                                    <ul class="mt-1 text-sm text-red-700 list-disc list-inside space-y-0.5">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Kategori Aset --}}
                        <div class="space-y-1.5">
                            <label for="kategori_aset" class="block text-sm font-medium text-gray-700">
                                <i class="fas fa-tag text-blue-500 mr-1.5 text-sm" aria-hidden="true"></i>
                                Kategori Aset <span class="text-red-500" aria-hidden="true">*</span>
                            </label>
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 left-0 pl-3 flex items-center
                                            pointer-events-none">
                                    <i class="fas fa-layer-group text-gray-400" aria-hidden="true"></i>
                                </div>
                                <input type="text" id="kategori_aset" name="kategori_aset"
                                    value="{{ old('kategori_aset', $dashboardAset->kategori_aset) }}" required
                                    maxlength="100" autocomplete="off" list="kategori-suggestions"
                                    class="input-field pl-10
                                              @error('kategori_aset') border-red-400 @enderror"
                                    placeholder="Kendaraan, Elektronik, Furniture…">
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
                                <p class="text-sm text-red-600 flex items-center gap-1" role="alert">
                                    <i class="fas fa-exclamation-circle" aria-hidden="true"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Jumlah Unit --}}
                        <div class="space-y-1.5">
                            <label for="jumlah_unit" class="block text-sm font-medium text-gray-700">
                                <i class="fas fa-calculator text-blue-500 mr-1.5" aria-hidden="true"></i>
                                Jumlah Unit <span class="text-red-500" aria-hidden="true">*</span>
                            </label>
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 left-0 pl-3 flex items-center
                                            pointer-events-none">
                                    <i class="fas fa-hashtag text-gray-400" aria-hidden="true"></i>
                                </div>
                                <input type="number" id="jumlah_unit" name="jumlah_unit"
                                    value="{{ old('jumlah_unit', $dashboardAset->jumlah_unit) }}" required
                                    min="1" max="999999" step="1"
                                    class="input-field pl-10
                                              @error('jumlah_unit') border-red-400 @enderror">
                            </div>
                            @error('jumlah_unit')
                                <p class="text-sm text-red-600 flex items-center gap-1" role="alert">
                                    <i class="fas fa-exclamation-circle" aria-hidden="true"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Nilai Perolehan --}}
                        <div class="space-y-1.5">
                            <label for="nilai_perolehan" class="block text-sm font-medium text-gray-700">
                                <i class="fas fa-money-bill-wave text-blue-500 mr-1.5" aria-hidden="true"></i>
                                Nilai Perolehan <span class="text-red-500" aria-hidden="true">*</span>
                            </label>
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 left-0 pl-3 flex items-center
                                            pointer-events-none">
                                    <span class="text-gray-500 text-sm font-medium">Rp</span>
                                </div>
                                <input type="number" id="nilai_perolehan" name="nilai_perolehan"
                                    value="{{ old('nilai_perolehan', $dashboardAset->nilai_perolehan) }}" required
                                    min="0" max="999999999999"
                                    class="input-field pl-12
                                              @error('nilai_perolehan') border-red-400 @enderror"
                                    placeholder="0">
                            </div>
                            <p class="text-xs text-gray-500">Nilai saat pertama kali memperoleh aset</p>
                            @error('nilai_perolehan')
                                <p class="text-sm text-red-600 flex items-center gap-1" role="alert">
                                    <i class="fas fa-exclamation-circle" aria-hidden="true"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Nilai Buku --}}
                        <div class="space-y-1.5">
                            <label for="nilai_buku" class="block text-sm font-medium text-gray-700">
                                <i class="fas fa-file-invoice-dollar text-blue-500 mr-1.5" aria-hidden="true"></i>
                                Nilai Buku <span class="text-red-500" aria-hidden="true">*</span>
                            </label>
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 left-0 pl-3 flex items-center
                                            pointer-events-none">
                                    <span class="text-gray-500 text-sm font-medium">Rp</span>
                                </div>
                                <input type="number" id="nilai_buku" name="nilai_buku"
                                    value="{{ old('nilai_buku', $dashboardAset->nilai_buku) }}" required
                                    min="0" max="999999999999"
                                    class="input-field pl-12
                                              @error('nilai_buku') border-red-400 @enderror"
                                    placeholder="0">
                            </div>
                            <p class="text-xs text-gray-500">Nilai aset setelah penyusutan (≤ nilai perolehan)</p>
                            <div id="nilaiBukuSuggestion" class="hidden"></div>
                            @error('nilai_buku')
                                <p class="text-sm text-red-600 flex items-center gap-1" role="alert">
                                    <i class="fas fa-exclamation-circle" aria-hidden="true"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Kondisi --}}
                        <div class="space-y-1.5">
                            <label for="kondisi" class="block text-sm font-medium text-gray-700">
                                <i class="fas fa-heartbeat text-blue-500 mr-1.5" aria-hidden="true"></i>
                                Kondisi <span class="text-red-500" aria-hidden="true">*</span>
                            </label>
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 left-0 pl-3 flex items-center
                                            pointer-events-none">
                                    <i class="fas fa-clipboard-check text-gray-400" aria-hidden="true"></i>
                                </div>
                                <select id="kondisi" name="kondisi" required
                                    class="input-field pl-10
                                               @error('kondisi') border-red-400 @enderror">
                                    <option value="">Pilih Kondisi</option>
                                    @foreach ($kondisiList as $k)
                                        <option value="{{ $k }}"
                                            {{ old('kondisi', $dashboardAset->kondisi) === $k ? 'selected' : '' }}>
                                            {{ $k }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex gap-2 mt-1">
                                <span
                                    class="px-2 py-0.5 bg-green-100 text-green-800
                                             rounded text-xs">Baik</span>
                                <span
                                    class="px-2 py-0.5 bg-yellow-100 text-yellow-800
                                             rounded text-xs">Rusak
                                    Ringan</span>
                                <span
                                    class="px-2 py-0.5 bg-red-100 text-red-800
                                             rounded text-xs">Rusak
                                    Berat</span>
                            </div>
                            @error('kondisi')
                                <p class="text-sm text-red-600 flex items-center gap-1" role="alert">
                                    <i class="fas fa-exclamation-circle" aria-hidden="true"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Lokasi --}}
                        <div class="space-y-1.5">
                            <label for="lokasi" class="block text-sm font-medium text-gray-700">
                                <i class="fas fa-map-marker-alt text-blue-500 mr-1.5" aria-hidden="true"></i>
                                Lokasi <span class="text-red-500" aria-hidden="true">*</span>
                            </label>
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 left-0 pl-3 flex items-center
                                            pointer-events-none">
                                    <i class="fas fa-building text-gray-400" aria-hidden="true"></i>
                                </div>
                                <input type="text" id="lokasi" name="lokasi"
                                    value="{{ old('lokasi', $dashboardAset->lokasi) }}" required maxlength="200"
                                    class="input-field pl-10
                                              @error('lokasi') border-red-400 @enderror"
                                    placeholder="Gedung A Lantai 3">
                            </div>
                            @error('lokasi')
                                <p class="text-sm text-red-600 flex items-center gap-1" role="alert">
                                    <i class="fas fa-exclamation-circle" aria-hidden="true"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Tahun --}}
                        <div class="space-y-1.5">
                            <label for="tahun" class="block text-sm font-medium text-gray-700">
                                <i class="fas fa-calendar-alt text-blue-500 mr-1.5" aria-hidden="true"></i>
                                Tahun <span class="text-red-500" aria-hidden="true">*</span>
                            </label>
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 left-0 pl-3 flex items-center
                                            pointer-events-none">
                                    <i class="fas fa-calendar text-gray-400" aria-hidden="true"></i>
                                </div>
                                <input type="number" id="tahun" name="tahun"
                                    value="{{ old('tahun', $dashboardAset->tahun) }}" required min="2000"
                                    max="{{ $currentYear + 1 }}"
                                    class="input-field pl-10
                                              @error('tahun') border-red-400 @enderror"
                                    placeholder="{{ $currentYear }}">
                            </div>
                            <p class="text-xs text-gray-500">
                                Tahun perolehan/pengadaan aset (2000–{{ $currentYear + 1 }})
                            </p>
                            @error('tahun')
                                <p class="text-sm text-red-600 flex items-center gap-1" role="alert">
                                    <i class="fas fa-exclamation-circle" aria-hidden="true"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Keterangan --}}
                        <div class="md:col-span-2 space-y-1.5">
                            <label for="keterangan" class="block text-sm font-medium text-gray-700">
                                <i class="fas fa-sticky-note text-blue-500 mr-1.5" aria-hidden="true"></i>
                                Keterangan
                                <span class="text-xs text-gray-400 font-normal ml-1">(opsional)</span>
                            </label>
                            <textarea id="keterangan" name="keterangan" rows="4" maxlength="1000"
                                class="w-full px-4 py-3 rounded-xl border border-gray-300
                                             focus:border-blue-500 focus:ring-2 focus:ring-blue-200
                                             focus:outline-none transition-all duration-200 resize-none
                                             @error('keterangan') border-red-400 @enderror"
                                placeholder="Informasi tambahan untuk audit trail…">{{ old('keterangan', $dashboardAset->keterangan) }}</textarea>
                            <div class="flex items-center justify-between">
                                <p class="text-xs text-gray-500">Opsional: catat perubahan penting untuk audit</p>
                                <span id="keteranganCount" class="text-xs text-gray-400">
                                    {{ strlen(old('keterangan', $dashboardAset->keterangan ?? '')) }} / 1000
                                </span>
                            </div>
                            @error('keterangan')
                                <p class="text-sm text-red-600 flex items-center gap-1" role="alert">
                                    <i class="fas fa-exclamation-circle" aria-hidden="true"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    {{-- Form Actions --}}
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div
                            class="flex flex-col sm:flex-row sm:items-center
                                    sm:justify-between gap-4">
                            <p class="text-sm text-gray-500">
                                <i class="fas fa-info-circle text-blue-500 mr-1" aria-hidden="true"></i>
                                Kolom dengan tanda <span class="text-red-500">*</span> wajib diisi
                            </p>
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.dashboard-aset.index') }}"
                                    class="btn-secondary flex items-center">
                                    <i class="fas fa-times mr-2" aria-hidden="true"></i>Batal
                                </a>
                                <button type="submit" id="submitBtn" class="btn-primary flex items-center">
                                    <i class="fas fa-save mr-2" aria-hidden="true"></i>
                                    Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                {{-- Tips --}}
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                    <div class="flex items-start gap-3">
                        <div
                            class="h-8 w-8 rounded-full bg-purple-100 flex items-center
                                    justify-center flex-shrink-0">
                            <i class="fas fa-lightbulb text-purple-600 text-sm" aria-hidden="true"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-900">Tips Editing</h4>
                            <ul class="mt-1 text-xs text-gray-600 list-disc list-inside space-y-1">
                                <li>Pastikan perubahan sesuai dokumen fisik terbaru</li>
                                <li>Update nilai buku sesuai penyusutan yang berlaku</li>
                                <li>Catat perubahan penting di keterangan untuk audit trail</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Riwayat perubahan --}}
            @if ($dashboardAset->created_at != $dashboardAset->updated_at)
                <div class="mt-6 bg-gray-50 rounded-2xl p-5 border border-gray-200">
                    <h4 class="text-sm font-medium text-gray-700 mb-3 flex items-center gap-2">
                        <i class="fas fa-history text-gray-500" aria-hidden="true"></i>
                        Riwayat Perubahan
                    </h4>
                    <div class="grid grid-cols-3 gap-4 text-sm">
                        <div>
                            <p class="text-xs text-gray-500">Dibuat</p>
                            <p class="font-medium text-gray-900">
                                {{ $dashboardAset->created_at->format('d/m/Y H:i') }}
                            </p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Diupdate</p>
                            <p class="font-medium text-gray-900">
                                {{ $dashboardAset->updated_at->format('d/m/Y H:i') }}
                            </p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Selisih</p>
                            <p class="font-medium text-gray-900">
                                {{ $dashboardAset->created_at->diffForHumans($dashboardAset->updated_at, true) }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
        <script>
            (function() {
                'use strict';

                const nilaiBukuInput = document.getElementById('nilai_buku');
                const nilaiPerInput = document.getElementById('nilai_perolehan');
                const keteranganEl = document.getElementById('keterangan');
                const keteranganCount = document.getElementById('keteranganCount');
                const suggestionBox = document.getElementById('nilaiBukuSuggestion');
                const form = document.getElementById('asetForm');
                const submitBtn = document.getElementById('submitBtn');

                // Karakter counter
                if (keteranganEl && keteranganCount) {
                    keteranganEl.addEventListener('input', function() {
                        const len = this.value.length;
                        keteranganCount.textContent = len + ' / 1000';
                        keteranganCount.className = len > 950 ?
                            'text-xs text-red-500' :
                            'text-xs text-gray-400';
                    });
                }

                // Saran nilai buku saat nilai perolehan diubah
                if (nilaiPerInput && nilaiBukuInput && suggestionBox) {
                    // Simpan nilai asli untuk perbandingan rasio
                    const origPerolehan = parseFloat(nilaiPerInput.value) || 0;
                    const origBuku = parseFloat(nilaiBukuInput.value) || 0;
                    const origRatio = origPerolehan > 0 ? origBuku / origPerolehan : 0.8;

                    nilaiPerInput.addEventListener('change', function() {
                        const newPerolehan = parseFloat(this.value);
                        if (!newPerolehan || newPerolehan <= 0) return;

                        const suggested = Math.round(newPerolehan * origRatio);
                        const current = parseFloat(nilaiBukuInput.value) || 0;

                        // Tampilkan saran hanya jika nilainya berbeda signifikan (> 10%)
                        if (Math.abs(suggested - current) > current * 0.1) {
                            suggestionBox.className =
                                'mt-2 p-3 bg-blue-50 border border-blue-200 rounded-lg text-sm text-blue-800';
                            suggestionBox.innerHTML =
                                '<div class="flex items-center justify-between gap-2">' +
                                '<span><i class="fas fa-calculator mr-1"></i> Saran nilai buku: ' +
                                '<strong>Rp ' + suggested.toLocaleString('id-ID') + '</strong></span>' +
                                '<button type="button" id="applySuggestion" ' +
                                'class="text-blue-600 hover:text-blue-800 font-semibold underline text-xs">' +
                                'Terapkan</button></div>';

                            document.getElementById('applySuggestion')
                                .addEventListener('click', function() {
                                    nilaiBukuInput.value = suggested;
                                    suggestionBox.className = 'hidden';
                                });
                        }
                    });
                }

                // Focus → select all
                document.querySelectorAll('input[type="number"]').forEach(function(el) {
                    el.addEventListener('focus', function() {
                        this.select();
                    });
                });

                // Anti double-submit
                if (form && submitBtn) {
                    form.addEventListener('submit', function() {
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan…';
                    });
                }
            }());
        </script>
    @endpush
</x-app-layout>
