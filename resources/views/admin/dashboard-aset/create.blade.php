<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">{{ __('Tambah Data Aset') }}</h2>
                <p class="mt-1 text-sm text-gray-600">Tambahkan data aset BMN baru ke dalam sistem</p>
            </div>
            <a href="{{ route('admin.dashboard-aset.index') }}"
               class="btn-secondary flex items-center self-start sm:self-auto">
                <i class="fas fa-arrow-left mr-2" aria-hidden="true"></i>Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-200">

                {{-- Header form --}}
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 rounded-lg bg-blue-500 flex items-center justify-center">
                            <i class="fas fa-plus text-white" aria-hidden="true"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Form Tambah Aset</h3>
                            <p class="text-sm text-gray-600">Isi semua kolom yang diperlukan dengan data yang valid</p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.dashboard-aset.store') }}"
                      method="POST"
                      id="asetForm"
                      novalidate
                      class="p-6">
                    @csrf

                    {{-- Error summary --}}
                    @if ($errors->any())
                    <div class="mb-6 bg-gradient-to-r from-red-50 to-rose-50 border-l-4
                                border-red-500 rounded-xl p-4" role="alert">
                        <div class="flex items-start gap-3">
                            <div class="h-10 w-10 rounded-full bg-red-100 flex items-center
                                        justify-center flex-shrink-0">
                                <i class="fas fa-exclamation-triangle text-red-600"
                                   aria-hidden="true"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-red-800">
                                    Terdapat {{ $errors->count() }} kesalahan dalam pengisian form
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
                            <label for="kategori_aset"
                                   class="block text-sm font-medium text-gray-700">
                                <i class="fas fa-tag text-blue-500 mr-1.5 text-sm"
                                   aria-hidden="true"></i>
                                Kategori Aset <span class="text-red-500" aria-hidden="true">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center
                                            pointer-events-none">
                                    <i class="fas fa-layer-group text-gray-400"
                                       aria-hidden="true"></i>
                                </div>
                                <input type="text" id="kategori_aset" name="kategori_aset"
                                       value="{{ old('kategori_aset') }}"
                                       required maxlength="100"
                                       autocomplete="off"
                                       list="kategori-suggestions"
                                       class="input-field pl-10
                                              @error('kategori_aset') border-red-400 focus:border-red-500
                                              focus:ring-red-200 @enderror"
                                       placeholder="Kendaraan, Elektronik, Furniture…"
                                       aria-describedby="kategori_aset_hint"
                                       aria-required="true">
                                {{-- Datalist untuk auto-suggest kategori umum --}}
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
                            <p id="kategori_aset_hint" class="text-sm text-red-600 flex items-center gap-1"
                               role="alert">
                                <i class="fas fa-exclamation-circle" aria-hidden="true"></i>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        {{-- Jumlah Unit --}}
                        <div class="space-y-1.5">
                            <label for="jumlah_unit"
                                   class="block text-sm font-medium text-gray-700">
                                <i class="fas fa-calculator text-blue-500 mr-1.5 text-sm"
                                   aria-hidden="true"></i>
                                Jumlah Unit <span class="text-red-500" aria-hidden="true">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center
                                            pointer-events-none">
                                    <i class="fas fa-hashtag text-gray-400" aria-hidden="true"></i>
                                </div>
                                <input type="number" id="jumlah_unit" name="jumlah_unit"
                                       value="{{ old('jumlah_unit') }}"
                                       required min="1" max="999999" step="1"
                                       class="input-field pl-10
                                              @error('jumlah_unit') border-red-400 @enderror"
                                       placeholder="Masukkan jumlah unit"
                                       aria-required="true">
                            </div>
                            @error('jumlah_unit')
                            <p class="text-sm text-red-600 flex items-center gap-1" role="alert">
                                <i class="fas fa-exclamation-circle" aria-hidden="true"></i>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        {{-- Nilai Perolehan --}}
                        <div class="space-y-1.5">
                            <label for="nilai_perolehan"
                                   class="block text-sm font-medium text-gray-700">
                                <i class="fas fa-money-bill-wave text-blue-500 mr-1.5 text-sm"
                                   aria-hidden="true"></i>
                                Nilai Perolehan <span class="text-red-500" aria-hidden="true">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center
                                            pointer-events-none">
                                    <span class="text-gray-500 text-sm font-medium">Rp</span>
                                </div>
                                <input type="number" id="nilai_perolehan" name="nilai_perolehan"
                                       value="{{ old('nilai_perolehan') }}"
                                       required min="0" max="999999999999" step="1"
                                       class="input-field pl-12
                                              @error('nilai_perolehan') border-red-400 @enderror"
                                       placeholder="0"
                                       aria-required="true"
                                       aria-describedby="nilai_perolehan_hint">
                            </div>
                            <p id="nilai_perolehan_hint" class="text-xs text-gray-500">
                                Nilai saat pertama kali memperoleh aset
                            </p>
                            @error('nilai_perolehan')
                            <p class="text-sm text-red-600 flex items-center gap-1" role="alert">
                                <i class="fas fa-exclamation-circle" aria-hidden="true"></i>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        {{-- Nilai Buku --}}
                        <div class="space-y-1.5">
                            <label for="nilai_buku"
                                   class="block text-sm font-medium text-gray-700">
                                <i class="fas fa-file-invoice-dollar text-blue-500 mr-1.5 text-sm"
                                   aria-hidden="true"></i>
                                Nilai Buku <span class="text-red-500" aria-hidden="true">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center
                                            pointer-events-none">
                                    <span class="text-gray-500 text-sm font-medium">Rp</span>
                                </div>
                                <input type="number" id="nilai_buku" name="nilai_buku"
                                       value="{{ old('nilai_buku') }}"
                                       required min="0" max="999999999999" step="1"
                                       class="input-field pl-12
                                              @error('nilai_buku') border-red-400 @enderror"
                                       placeholder="0"
                                       aria-required="true"
                                       aria-describedby="nilai_buku_hint">
                            </div>
                            <p id="nilai_buku_hint" class="text-xs text-gray-500">
                                Nilai aset setelah penyusutan (≤ nilai perolehan)
                            </p>
                            {{-- Suggestion auto-fill --}}
                            <div id="nilaiBukuSuggestion" class="hidden"></div>
                            @error('nilai_buku')
                            <p class="text-sm text-red-600 flex items-center gap-1" role="alert">
                                <i class="fas fa-exclamation-circle" aria-hidden="true"></i>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        {{-- Kondisi --}}
                        <div class="space-y-1.5">
                            <label for="kondisi"
                                   class="block text-sm font-medium text-gray-700">
                                <i class="fas fa-heartbeat text-blue-500 mr-1.5 text-sm"
                                   aria-hidden="true"></i>
                                Kondisi <span class="text-red-500" aria-hidden="true">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center
                                            pointer-events-none">
                                    <i class="fas fa-clipboard-check text-gray-400"
                                       aria-hidden="true"></i>
                                </div>
                                <select id="kondisi" name="kondisi" required
                                        class="input-field pl-10
                                               @error('kondisi') border-red-400 @enderror"
                                        aria-required="true">
                                    <option value="">Pilih Kondisi</option>
                                    @foreach($kondisiList as $k)
                                        <option value="{{ $k }}"
                                            {{ old('kondisi') === $k ? 'selected' : '' }}>
                                            {{ $k }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('kondisi')
                            <p class="text-sm text-red-600 flex items-center gap-1" role="alert">
                                <i class="fas fa-exclamation-circle" aria-hidden="true"></i>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        {{-- Lokasi --}}
                        <div class="space-y-1.5">
                            <label for="lokasi"
                                   class="block text-sm font-medium text-gray-700">
                                <i class="fas fa-map-marker-alt text-blue-500 mr-1.5 text-sm"
                                   aria-hidden="true"></i>
                                Lokasi <span class="text-red-500" aria-hidden="true">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center
                                            pointer-events-none">
                                    <i class="fas fa-building text-gray-400" aria-hidden="true"></i>
                                </div>
                                <input type="text" id="lokasi" name="lokasi"
                                       value="{{ old('lokasi') }}"
                                       required maxlength="200"
                                       class="input-field pl-10
                                              @error('lokasi') border-red-400 @enderror"
                                       placeholder="Contoh: Gedung A Lantai 3"
                                       aria-required="true">
                            </div>
                            @error('lokasi')
                            <p class="text-sm text-red-600 flex items-center gap-1" role="alert">
                                <i class="fas fa-exclamation-circle" aria-hidden="true"></i>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        {{-- Tahun --}}
                        <div class="space-y-1.5">
                            <label for="tahun"
                                   class="block text-sm font-medium text-gray-700">
                                <i class="fas fa-calendar-alt text-blue-500 mr-1.5 text-sm"
                                   aria-hidden="true"></i>
                                Tahun <span class="text-red-500" aria-hidden="true">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center
                                            pointer-events-none">
                                    <i class="fas fa-calendar text-gray-400" aria-hidden="true"></i>
                                </div>
                                <input type="number" id="tahun" name="tahun"
                                       value="{{ old('tahun', $currentYear) }}"
                                       required min="2000" max="{{ $currentYear + 1 }}"
                                       class="input-field pl-10
                                              @error('tahun') border-red-400 @enderror"
                                       placeholder="{{ $currentYear }}"
                                       aria-required="true"
                                       aria-describedby="tahun_hint">
                            </div>
                            <p id="tahun_hint" class="text-xs text-gray-500">
                                Tahun perolehan/pengadaan aset (2000–{{ $currentYear + 1 }})
                            </p>
                            @error('tahun')
                            <p class="text-sm text-red-600 flex items-center gap-1" role="alert">
                                <i class="fas fa-exclamation-circle" aria-hidden="true"></i>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        {{-- Keterangan --}}
                        <div class="md:col-span-2 space-y-1.5">
                            <label for="keterangan"
                                   class="block text-sm font-medium text-gray-700">
                                <i class="fas fa-sticky-note text-blue-500 mr-1.5 text-sm"
                                   aria-hidden="true"></i>
                                Keterangan
                                <span class="text-xs text-gray-400 font-normal ml-1">(opsional)</span>
                            </label>
                            <textarea id="keterangan" name="keterangan"
                                      rows="4" maxlength="1000"
                                      class="w-full px-4 py-3 rounded-xl border border-gray-300
                                             focus:border-blue-500 focus:ring-2 focus:ring-blue-200
                                             focus:outline-none transition-all duration-200 resize-none
                                             @error('keterangan') border-red-400 @enderror"
                                      placeholder="Informasi tambahan tentang aset…"
                                      aria-describedby="keterangan_hint">{{ old('keterangan') }}</textarea>
                            <div class="flex items-center justify-between">
                                <p id="keterangan_hint" class="text-xs text-gray-500">
                                    Opsional: informasi tambahan untuk audit trail
                                </p>
                                <span id="keteranganCount" class="text-xs text-gray-400">
                                    0 / 1000
                                </span>
                            </div>
                            @error('keterangan')
                            <p class="text-sm text-red-600 flex items-center gap-1" role="alert">
                                <i class="fas fa-exclamation-circle" aria-hidden="true"></i>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>

                    {{-- Form Actions --}}
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <p class="text-sm text-gray-500">
                                <i class="fas fa-info-circle text-blue-500 mr-1"
                                   aria-hidden="true"></i>
                                Kolom dengan tanda <span class="text-red-500">*</span> wajib diisi
                            </p>
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.dashboard-aset.index') }}"
                                   class="btn-secondary flex items-center">
                                    <i class="fas fa-times mr-2" aria-hidden="true"></i>Batal
                                </a>
                                <button type="submit" id="submitBtn"
                                        class="btn-primary flex items-center">
                                    <i class="fas fa-save mr-2" aria-hidden="true"></i>
                                    Simpan Data
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                {{-- Tips --}}
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                    <div class="flex items-start gap-3">
                        <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center
                                    justify-center flex-shrink-0">
                            <i class="fas fa-lightbulb text-blue-600 text-sm"
                               aria-hidden="true"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-900">Tips Pengisian</h4>
                            <ul class="mt-1 text-xs text-gray-600 list-disc list-inside space-y-1">
                                <li>Pastikan data sesuai dokumen fisik aset</li>
                                <li>Nilai buku biasanya lebih rendah dari nilai perolehan (penyusutan)</li>
                                <li>Sistem akan otomatis menyarankan nilai buku = 80% nilai perolehan</li>
                                <li>Gunakan keterangan untuk mencatat nomor seri, merek, atau informasi audit</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    (function () {
        'use strict';

        const nilaiPerolehanInput = document.getElementById('nilai_perolehan');
        const nilaiBukuInput      = document.getElementById('nilai_buku');
        const keteranganInput     = document.getElementById('keterangan');
        const keteranganCount     = document.getElementById('keteranganCount');
        const suggestionBox       = document.getElementById('nilaiBukuSuggestion');
        const form                = document.getElementById('asetForm');
        const submitBtn           = document.getElementById('submitBtn');

        // ── Karakter counter keterangan ───────────────────────────────────
        if (keteranganInput && keteranganCount) {
            const update = () => {
                const len = keteranganInput.value.length;
                keteranganCount.textContent = len + ' / 1000';
                keteranganCount.className = len > 950
                    ? 'text-xs text-red-500'
                    : 'text-xs text-gray-400';
            };
            keteranganInput.addEventListener('input', update);
            update();
        }

        // ── Auto-suggest nilai buku (80% nilai perolehan) ─────────────────
        if (nilaiPerolehanInput && nilaiBukuInput && suggestionBox) {
            nilaiPerolehanInput.addEventListener('change', function () {
                const np = parseFloat(this.value);
                if (!np || np <= 0) return;

                // Jangan override jika user sudah mengisi nilai buku sendiri
                if (nilaiBukuInput.value && parseFloat(nilaiBukuInput.value) > 0) return;

                const suggested = Math.round(np * 0.8);
                suggestionBox.className =
                    'mt-2 p-3 bg-blue-50 border border-blue-200 rounded-lg text-sm text-blue-800';
                suggestionBox.innerHTML =
                    '<div class="flex items-center justify-between gap-2">' +
                    '<span><i class="fas fa-calculator mr-1"></i> Saran nilai buku: ' +
                    '<strong>Rp ' + suggested.toLocaleString('id-ID') + '</strong>' +
                    ' (80% dari nilai perolehan)</span>' +
                    '<button type="button" id="applySuggestion" ' +
                    'class="text-blue-600 hover:text-blue-800 font-semibold whitespace-nowrap ' +
                    'underline text-xs">Terapkan</button>' +
                    '</div>';

                document.getElementById('applySuggestion')
                    .addEventListener('click', function () {
                        nilaiBukuInput.value = suggested;
                        suggestionBox.className = 'hidden';
                    });
            });
        }

        // ── Form submit: disable tombol untuk cegah double-submit ─────────
        if (form && submitBtn) {
            form.addEventListener('submit', function () {
                submitBtn.disabled = true;
                submitBtn.innerHTML =
                    '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan…';
            });
        }

        // ── Focus select all pada input angka ─────────────────────────────
        document.querySelectorAll('input[type="number"]').forEach(function (el) {
            el.addEventListener('focus', function () { this.select(); });
        });
    }());
    </script>
    @endpush
</x-app-layout>
