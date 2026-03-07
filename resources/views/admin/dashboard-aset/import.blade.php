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
                        Import Data
                    </span>
                </li>
            </ol>
        </nav>

        <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
            <div class="flex items-start gap-3 min-w-0">
                <div class="flex-shrink-0 h-11 w-11 rounded-xl
                            bg-gradient-to-br from-teal-500 to-teal-700
                            flex items-center justify-center shadow-md shadow-teal-200">
                    <i class="fas fa-file-import text-white text-lg" aria-hidden="true"></i>
                </div>
                <div class="min-w-0">
                    <h2 class="text-xl font-bold text-gray-900 leading-tight">
                        Import Data Aset
                    </h2>
                    <p class="mt-0.5 text-sm text-gray-500">
                        Tambahkan data aset secara massal melalui file Excel atau CSV
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
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- ══════════════════════════════════════════════════════
                 HASIL IMPORT (muncul setelah submit)
            ══════════════════════════════════════════════════════ --}}
            @if (session('import_success'))
            <div class="bg-emerald-50 border border-emerald-200 rounded-2xl p-5 animate-fade-in-down"
                 role="alert">
                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0 h-10 w-10 rounded-xl bg-emerald-100
                                flex items-center justify-center">
                        <i class="fas fa-check-circle text-emerald-600 text-lg"
                           aria-hidden="true"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-bold text-emerald-800 mb-2">
                            Import Selesai
                        </p>
                        <div class="flex flex-wrap gap-3 mb-3">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5
                                         bg-emerald-100 text-emerald-700 rounded-lg
                                         text-sm font-semibold">
                                <i class="fas fa-check text-xs" aria-hidden="true"></i>
                                {{ session('import_imported', 0) }} berhasil diimpor
                            </span>
                            @if (session('import_skipped', 0) > 0)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5
                                         bg-amber-100 text-amber-700 rounded-lg
                                         text-sm font-semibold">
                                <i class="fas fa-exclamation-triangle text-xs"
                                   aria-hidden="true"></i>
                                {{ session('import_skipped') }} baris dilewati
                            </span>
                            @endif
                        </div>
                        <p class="text-sm text-emerald-700">
                            {{ session('import_success') }}
                        </p>
                        <div class="mt-3">
                            <a href="{{ route('admin.dashboard-aset.index') }}"
                               class="inline-flex items-center gap-2 px-4 py-2
                                      bg-emerald-600 hover:bg-emerald-700 text-white
                                      text-sm font-semibold rounded-xl transition-colors
                                      shadow-sm shadow-emerald-200">
                                <i class="fas fa-list text-xs" aria-hidden="true"></i>
                                Lihat Data Aset
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if (session('import_error'))
            <div class="bg-red-50 border border-red-200 rounded-2xl p-5 animate-fade-in-down"
                 role="alert">
                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0 h-10 w-10 rounded-xl bg-red-100
                                flex items-center justify-center">
                        <i class="fas fa-times-circle text-red-600 text-lg"
                           aria-hidden="true"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-red-800 mb-1">Gagal Memproses File</p>
                        <p class="text-sm text-red-600">{{ session('import_error') }}</p>
                    </div>
                </div>
            </div>
            @endif

            @if ($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-2xl p-5 animate-fade-in-down"
                 role="alert">
                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0 h-10 w-10 rounded-xl bg-red-100
                                flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-red-600 text-lg"
                           aria-hidden="true"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-red-800 mb-1">
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

            {{-- Error detail per baris --}}
            @if (session('import_errors') && count(session('import_errors')) > 0)
            <div class="bg-white rounded-2xl border border-amber-200 shadow-sm overflow-hidden">
                <div class="flex items-center gap-3 px-5 py-4
                            border-b border-amber-100 bg-amber-50/60">
                    <div class="h-8 w-8 rounded-lg bg-amber-100
                                flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-exclamation-triangle text-amber-600 text-sm"
                           aria-hidden="true"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-gray-800">
                            Detail Baris yang Dilewati
                        </h3>
                        <p class="text-xs text-gray-500 mt-0.5">
                            {{ count(session('import_errors')) }} baris gagal divalidasi
                        </p>
                    </div>
                </div>
                <div class="divide-y divide-gray-50 max-h-72 overflow-y-auto">
                    @foreach (session('import_errors') as $errRow)
                    <div class="px-5 py-3 hover:bg-gray-50 transition-colors">
                        <div class="flex items-start gap-3">
                            <span class="inline-flex items-center px-2 py-0.5
                                         bg-red-100 text-red-700 rounded-md
                                         text-xs font-mono font-bold flex-shrink-0 mt-0.5">
                                Baris {{ $errRow['row'] }}
                            </span>
                            <div class="min-w-0">
                                <p class="text-sm font-medium text-gray-700 truncate">
                                    {{ $errRow['data'] }}
                                </p>
                                <ul class="mt-1 space-y-0.5">
                                    @foreach ($errRow['messages'] as $msg)
                                    <li class="text-xs text-red-600 flex items-center gap-1">
                                        <i class="fas fa-times text-[10px]"
                                           aria-hidden="true"></i>
                                        {{ $msg }}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- ══════════════════════════════════════════════════════
                 PANDUAN & TEMPLATE
            ══════════════════════════════════════════════════════ --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Panduan kolom --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="flex items-center gap-3 px-5 py-4
                                border-b border-gray-100 bg-gray-50/60">
                        <div class="h-8 w-8 rounded-lg bg-blue-100
                                    flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-table text-blue-600 text-sm"
                               aria-hidden="true"></i>
                        </div>
                        <h3 class="text-sm font-bold text-gray-800">
                            Format Kolom Wajib
                        </h3>
                    </div>
                    <div class="p-4 space-y-2">
                        @php
                            $columns = [
                                ['key' => 'kategori_aset',   'desc' => 'Nama kategori aset',                   'example' => 'Elektronik',     'required' => true],
                                ['key' => 'jumlah_unit',     'desc' => 'Jumlah unit (angka, min 1)',            'example' => '5',              'required' => true],
                                ['key' => 'nilai_perolehan', 'desc' => 'Nilai perolehan (angka, tanpa titik)',  'example' => '50000000',       'required' => true],
                                ['key' => 'nilai_buku',      'desc' => 'Nilai buku ≤ nilai perolehan',         'example' => '40000000',       'required' => true],
                                ['key' => 'kondisi',         'desc' => 'Baik / Rusak Ringan / Rusak Berat',    'example' => 'Baik',           'required' => true],
                                ['key' => 'lokasi',          'desc' => 'Lokasi aset (max 200 karakter)',       'example' => 'Gedung A Lt 2',  'required' => true],
                                ['key' => 'tahun',           'desc' => 'Tahun pengadaan (2000 – sekarang+1)',  'example' => '2022',           'required' => true],
                                ['key' => 'keterangan',      'desc' => 'Catatan tambahan (opsional)',          'example' => '',               'required' => false],
                            ];
                        @endphp
                        @foreach ($columns as $col)
                        <div class="flex items-start gap-2.5 px-3 py-2.5 rounded-xl
                                    {{ $col['required'] ? 'bg-gray-50' : 'bg-gray-50/40' }}">
                            <code class="text-xs font-mono font-bold text-blue-700
                                         bg-blue-50 px-1.5 py-0.5 rounded-md flex-shrink-0 mt-0.5">
                                {{ $col['key'] }}
                            </code>
                            <div class="min-w-0">
                                <p class="text-xs text-gray-600">{{ $col['desc'] }}</p>
                                @if ($col['example'])
                                <p class="text-xs text-gray-400 font-mono mt-0.5">
                                    contoh: {{ $col['example'] }}
                                </p>
                                @endif
                            </div>
                            @if ($col['required'])
                            <span class="text-red-500 text-xs flex-shrink-0 mt-0.5"
                                  aria-label="wajib">*</span>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Aturan & download template --}}
                <div class="space-y-4">
                    {{-- Download template --}}
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                        <div class="flex items-start gap-3 mb-4">
                            <div class="h-10 w-10 rounded-xl bg-teal-100
                                        flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-download text-teal-600"
                                   aria-hidden="true"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-gray-800">
                                    Template CSV
                                </h3>
                                <p class="text-xs text-gray-500 mt-0.5">
                                    Unduh template siap pakai dengan contoh data
                                </p>
                            </div>
                        </div>
                        <a href="{{ route('admin.dashboard-aset.import.template') }}"
                           class="w-full inline-flex items-center justify-center gap-2
                                  px-4 py-3 bg-gradient-to-r from-teal-600 to-teal-700
                                  hover:from-teal-700 hover:to-teal-800 text-white
                                  text-sm font-semibold rounded-xl shadow-md shadow-teal-200
                                  hover:shadow-lg transition-all duration-200
                                  focus:outline-none focus:ring-2 focus:ring-teal-500
                                  focus:ring-offset-2">
                            <i class="fas fa-file-csv text-sm" aria-hidden="true"></i>
                            Unduh Template CSV
                        </a>
                    </div>

                    {{-- Aturan --}}
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                        <div class="flex items-center gap-2 mb-3">
                            <i class="fas fa-info-circle text-blue-500 text-sm"
                               aria-hidden="true"></i>
                            <h3 class="text-sm font-bold text-gray-800">Aturan Import</h3>
                        </div>
                        <ul class="space-y-2 text-xs text-gray-600">
                            <li class="flex items-start gap-2">
                                <i class="fas fa-check text-emerald-500 mt-0.5 flex-shrink-0 text-[10px]"
                                   aria-hidden="true"></i>
                                Format file: <strong>.xlsx</strong>, <strong>.xls</strong>, atau <strong>.csv</strong>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fas fa-check text-emerald-500 mt-0.5 flex-shrink-0 text-[10px]"
                                   aria-hidden="true"></i>
                                Ukuran file maksimal <strong>5 MB</strong>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fas fa-check text-emerald-500 mt-0.5 flex-shrink-0 text-[10px]"
                                   aria-hidden="true"></i>
                                Baris pertama <strong>harus berisi nama kolom</strong> (header)
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fas fa-check text-emerald-500 mt-0.5 flex-shrink-0 text-[10px]"
                                   aria-hidden="true"></i>
                                Nilai numerik ditulis <strong>tanpa titik/koma</strong> ribuan (misal: 50000000)
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fas fa-check text-emerald-500 mt-0.5 flex-shrink-0 text-[10px]"
                                   aria-hidden="true"></i>
                                Kolom <strong>kondisi</strong> harus tepat: Baik, Rusak Ringan, atau Rusak Berat
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fas fa-info-circle text-blue-400 mt-0.5 flex-shrink-0 text-[10px]"
                                   aria-hidden="true"></i>
                                Baris dengan error <strong>dilewati</strong>, baris valid tetap disimpan
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- ══════════════════════════════════════════════════════
                 FORM UPLOAD
            ══════════════════════════════════════════════════════ --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="flex items-center gap-3 px-6 py-4
                            border-b border-gray-100 bg-gray-50/60">
                    <div class="h-8 w-8 rounded-lg bg-teal-100
                                flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-upload text-teal-600 text-sm"
                           aria-hidden="true"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-gray-800">Upload File</h3>
                        <p class="text-xs text-gray-400 mt-0.5">
                            Pilih file Excel atau CSV yang sudah diisi sesuai format
                        </p>
                    </div>
                </div>

                <form action="{{ route('admin.dashboard-aset.import.store') }}"
                      method="POST"
                      enctype="multipart/form-data"
                      id="importForm">
                    @csrf
                    <div class="p-6 space-y-5">

                        {{-- Drop zone --}}
                        <div id="dropZone"
                             class="relative border-2 border-dashed border-gray-300
                                    rounded-2xl p-10 text-center transition-all duration-200
                                    hover:border-teal-400 hover:bg-teal-50/30
                                    cursor-pointer group"
                             onclick="document.getElementById('fileInput').click()"
                             ondragover="handleDragOver(event)"
                             ondragleave="handleDragLeave(event)"
                             ondrop="handleDrop(event)">

                            {{-- Icon --}}
                            <div id="dropIcon"
                                 class="mx-auto h-16 w-16 rounded-2xl bg-gray-100
                                        flex items-center justify-center mb-4
                                        group-hover:bg-teal-100 transition-colors">
                                <i class="fas fa-cloud-upload-alt text-gray-400 text-2xl
                                          group-hover:text-teal-600 transition-colors"
                                   aria-hidden="true"></i>
                            </div>

                            {{-- Text --}}
                            <div id="dropText">
                                <p class="text-sm font-semibold text-gray-700 mb-1">
                                    Drag & drop file di sini, atau
                                    <span class="text-teal-600 underline">klik untuk memilih</span>
                                </p>
                                <p class="text-xs text-gray-400">
                                    Mendukung .xlsx, .xls, .csv — Maks. 5 MB
                                </p>
                            </div>

                            {{-- File selected indicator --}}
                            <div id="fileSelected"
                                 class="hidden flex-col items-center gap-2">
                                <i class="fas fa-file-excel text-4xl text-emerald-500"
                                   aria-hidden="true"></i>
                                <p id="fileName"
                                   class="text-sm font-semibold text-gray-800"></p>
                                <p id="fileSize"
                                   class="text-xs text-gray-400"></p>
                                <button type="button"
                                        onclick="clearFile(event)"
                                        class="text-xs text-red-500 hover:text-red-700
                                               underline transition-colors mt-1">
                                    Ganti file
                                </button>
                            </div>

                            {{-- Hidden input --}}
                            <input type="file"
                                   id="fileInput"
                                   name="file"
                                   accept=".xlsx,.xls,.csv"
                                   class="hidden"
                                   onchange="handleFileSelect(this)">
                        </div>

                        {{-- Submit --}}
                        <div class="flex flex-col sm:flex-row
                                    sm:items-center sm:justify-between gap-4
                                    pt-2 border-t border-gray-100">
                            <div class="flex items-start gap-2.5">
                                <div class="flex-shrink-0 h-7 w-7 rounded-lg bg-amber-50
                                            flex items-center justify-center mt-0.5">
                                    <i class="fas fa-shield-alt text-amber-500 text-xs"
                                       aria-hidden="true"></i>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-gray-700">
                                        Proses Import
                                    </p>
                                    <p class="text-xs text-gray-400 mt-0.5 leading-relaxed">
                                        Data akan divalidasi baris per baris.
                                        Baris valid langsung disimpan.
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
                                    <i class="fas fa-times text-xs" aria-hidden="true"></i>
                                    Batal
                                </a>
                                <button type="submit"
                                        id="submitBtn"
                                        disabled
                                        class="inline-flex items-center gap-2 px-6 py-2.5
                                               text-white text-sm font-bold rounded-xl
                                               shadow-md transition-all duration-200
                                               focus:outline-none focus:ring-2
                                               focus:ring-offset-2
                                               disabled:opacity-40 disabled:cursor-not-allowed
                                               bg-gradient-to-r from-teal-600 to-teal-700
                                               hover:from-teal-700 hover:to-teal-800
                                               shadow-teal-200 focus:ring-teal-500">
                                    <i class="fas fa-file-import text-xs"
                                       aria-hidden="true"></i>
                                    Mulai Import
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    @push('scripts')
    <script>
    (function () {
        'use strict';

        const dropZone  = document.getElementById('dropZone');
        const dropText  = document.getElementById('dropText');
        const dropIcon  = document.getElementById('dropIcon');
        const fileSel   = document.getElementById('fileSelected');
        const fileInput = document.getElementById('fileInput');
        const fileNameEl= document.getElementById('fileName');
        const fileSizeEl= document.getElementById('fileSize');
        const submitBtn = document.getElementById('submitBtn');
        const form      = document.getElementById('importForm');

        const MAX_BYTES = 5 * 1024 * 1024; // 5 MB
        const VALID_EXT = ['xlsx', 'xls', 'csv'];

        // ── Tampilkan info file terpilih ──────────────────────────────────
        function showFile(file) {
            const ext = file.name.split('.').pop().toLowerCase();

            if (!VALID_EXT.includes(ext)) {
                alert('Format tidak didukung. Gunakan .xlsx, .xls, atau .csv');
                clearFile();
                return;
            }

            if (file.size > MAX_BYTES) {
                alert('Ukuran file melebihi 5 MB.');
                clearFile();
                return;
            }

            fileNameEl.textContent = file.name;
            fileSizeEl.textContent = formatBytes(file.size);

            dropText.classList.add('hidden');
            dropIcon.classList.add('hidden');
            fileSel.classList.remove('hidden');
            fileSel.classList.add('flex');

            dropZone.classList.remove('border-gray-300');
            dropZone.classList.add('border-emerald-400', 'bg-emerald-50/30');

            submitBtn.disabled = false;
        }

        // ── Reset ─────────────────────────────────────────────────────────
        window.clearFile = function (e) {
            if (e) e.stopPropagation();
            fileInput.value = '';
            fileSel.classList.add('hidden');
            fileSel.classList.remove('flex');
            dropText.classList.remove('hidden');
            dropIcon.classList.remove('hidden');
            dropZone.classList.remove('border-emerald-400', 'bg-emerald-50/30',
                                      'border-teal-400', 'bg-teal-50/30');
            dropZone.classList.add('border-gray-300');
            submitBtn.disabled = true;
        };

        // ── File input change ─────────────────────────────────────────────
        window.handleFileSelect = function (input) {
            if (input.files && input.files[0]) {
                showFile(input.files[0]);
            }
        };

        // ── Drag & Drop ───────────────────────────────────────────────────
        window.handleDragOver = function (e) {
            e.preventDefault();
            dropZone.classList.add('border-teal-400', 'bg-teal-50/30');
            dropZone.classList.remove('border-gray-300');
        };

        window.handleDragLeave = function (e) {
            e.preventDefault();
            if (!fileInput.files.length) {
                dropZone.classList.remove('border-teal-400', 'bg-teal-50/30');
                dropZone.classList.add('border-gray-300');
            }
        };

        window.handleDrop = function (e) {
            e.preventDefault();
            const file = e.dataTransfer.files[0];
            if (!file) return;

            // Transfer ke input agar ikut submit
            const dt = new DataTransfer();
            dt.items.add(file);
            fileInput.files = dt.files;

            showFile(file);
        };

        // ── Anti double-submit ─────────────────────────────────────────────
        form.addEventListener('submit', function () {
            submitBtn.disabled = true;
            submitBtn.innerHTML =
                '<i class="fas fa-spinner fa-spin text-xs mr-1.5"></i>Memproses…';
        });

        // ── Format bytes helper ───────────────────────────────────────────
        function formatBytes(bytes) {
            if (bytes >= 1024 * 1024)
                return (bytes / 1024 / 1024).toFixed(2) + ' MB';
            if (bytes >= 1024)
                return (bytes / 1024).toFixed(1) + ' KB';
            return bytes + ' B';
        }

    }());
    </script>
    @endpush
</x-app-layout>
