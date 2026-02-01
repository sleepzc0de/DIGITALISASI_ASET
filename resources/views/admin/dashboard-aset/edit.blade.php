<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    {{ __('Edit Data Aset') }}
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Edit data aset BMN - {{ $dashboardAset->kategori_aset }}
                </p>
                <div class="flex items-center mt-2 text-sm text-gray-500">
                    <i class="fas fa-fingerprint mr-2 text-xs"></i>
                    ID: ASET{{ str_pad($dashboardAset->id, 4, '0', STR_PAD_LEFT) }}
                    <span class="mx-2">•</span>
                    <i class="fas fa-clock mr-1 text-xs"></i>
                    Terakhir diupdate: {{ $dashboardAset->updated_at->format('d/m/Y H:i') }}
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.dashboard-aset.show', $dashboardAset) }}"
                   class="btn-secondary flex items-center">
                    <i class="fas fa-eye mr-2"></i>
                    Preview
                </a>
                <a href="{{ route('admin.dashboard-aset.index') }}"
                   class="btn-secondary flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Current Data Summary -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-6 mb-8 border border-blue-200">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Ringkasan Data Saat Ini</h3>
                        <p class="text-sm text-gray-600">Data aset sebelum perubahan</p>
                    </div>
                    <div class="h-12 w-12 rounded-xl bg-blue-500 flex items-center justify-center">
                        <i class="fas fa-history text-white"></i>
                    </div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-gray-900">{{ $dashboardAset->jumlah_unit }}</div>
                        <div class="text-xs text-gray-600">Unit</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-gray-900">Rp {{ number_format($dashboardAset->nilai_buku / 1000000, 1) }}Jt</div>
                        <div class="text-xs text-gray-600">Nilai Buku</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-gray-900">{{ $dashboardAset->tahun }}</div>
                        <div class="text-xs text-gray-600">Tahun</div>
                    </div>
                    <div class="text-center">
                        @php
                            $kondisiColors = [
                                'Baik' => 'bg-green-100 text-green-800',
                                'Rusak Ringan' => 'bg-yellow-100 text-yellow-800',
                                'Rusak Berat' => 'bg-red-100 text-red-800',
                            ];
                        @endphp
                        <div class="text-2xl font-bold text-gray-900">
                            <span class="text-xs px-3 py-1 rounded-full {{ $kondisiColors[$dashboardAset->kondisi] }}">
                                {{ $dashboardAset->kondisi }}
                            </span>
                        </div>
                        <div class="text-xs text-gray-600">Kondisi</div>
                    </div>
                </div>
            </div>

            <!-- Form Container -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-200">
                <!-- Form Header -->
                <div class="bg-gradient-to-r from-purple-50 to-indigo-50 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="h-10 w-10 rounded-lg bg-purple-500 flex items-center justify-center mr-3">
                            <i class="fas fa-edit text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Form Edit Aset</h3>
                            <p class="text-sm text-gray-600">Perbarui data aset dengan informasi terbaru</p>
                        </div>
                    </div>
                </div>

                <!-- Form Content -->
                <form action="{{ route('admin.dashboard-aset.update', $dashboardAset) }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')

                    <!-- Success/Error Messages -->
                    @if ($errors->any())
                    <div class="mb-6 bg-gradient-to-r from-red-50 to-rose-50 border-l-4 border-red-500 rounded-xl p-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center">
                                    <i class="fas fa-exclamation-triangle text-red-600"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-sm font-medium text-red-800">Terdapat {{ $errors->count() }} kesalahan dalam pengisian form</h4>
                                <ul class="mt-1 text-sm text-red-700 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Kategori Aset -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">
                                <div class="flex items-center">
                                    <i class="fas fa-tag text-blue-500 mr-2 text-sm"></i>
                                    Kategori Aset
                                    <span class="text-red-500 ml-1">*</span>
                                </div>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-layer-group text-gray-400"></i>
                                </div>
                                <input type="text" name="kategori_aset" value="{{ old('kategori_aset', $dashboardAset->kategori_aset) }}" required
                                    class="input-field pl-10 @error('kategori_aset') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror"
                                    placeholder="Contoh: Kendaraan, Elektronik, Furniture">
                            </div>
                            @error('kategori_aset')
                            <p class="text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- Jumlah Unit -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">
                                <div class="flex items-center">
                                    <i class="fas fa-calculator text-blue-500 mr-2 text-sm"></i>
                                    Jumlah Unit
                                    <span class="text-red-500 ml-1">*</span>
                                </div>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-hashtag text-gray-400"></i>
                                </div>
                                <input type="number" name="jumlah_unit" value="{{ old('jumlah_unit', $dashboardAset->jumlah_unit) }}" required min="1"
                                    class="input-field pl-10 @error('jumlah_unit') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror"
                                    placeholder="Masukkan jumlah unit">
                            </div>
                            @error('jumlah_unit')
                            <p class="text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- Nilai Perolehan -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">
                                <div class="flex items-center">
                                    <i class="fas fa-money-bill-wave text-blue-500 mr-2 text-sm"></i>
                                    Nilai Perolehan
                                    <span class="text-red-500 ml-1">*</span>
                                </div>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500">Rp</span>
                                </div>
                                <input type="number" name="nilai_perolehan" value="{{ old('nilai_perolehan', $dashboardAset->nilai_perolehan) }}" required min="0"
                                    class="input-field pl-12 @error('nilai_perolehan') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror"
                                    placeholder="0">
                            </div>
                            <p class="text-xs text-gray-500">Nilai saat pertama kali memperoleh aset</p>
                            @error('nilai_perolehan')
                            <p class="text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- Nilai Buku -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">
                                <div class="flex items-center">
                                    <i class="fas fa-file-invoice-dollar text-blue-500 mr-2 text-sm"></i>
                                    Nilai Buku
                                    <span class="text-red-500 ml-1">*</span>
                                </div>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500">Rp</span>
                                </div>
                                <input type="number" name="nilai_buku" value="{{ old('nilai_buku', $dashboardAset->nilai_buku) }}" required min="0"
                                    class="input-field pl-12 @error('nilai_buku') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror"
                                    placeholder="0">
                            </div>
                            <p class="text-xs text-gray-500">Nilai aset setelah penyusutan</p>
                            @error('nilai_buku')
                            <p class="text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- Kondisi -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">
                                <div class="flex items-center">
                                    <i class="fas fa-heartbeat text-blue-500 mr-2 text-sm"></i>
                                    Kondisi
                                    <span class="text-red-500 ml-1">*</span>
                                </div>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-clipboard-check text-gray-400"></i>
                                </div>
                                <select name="kondisi" required
                                    class="input-field pl-10 @error('kondisi') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror">
                                    <option value="">Pilih Kondisi</option>
                                    <option value="Baik" {{ old('kondisi', $dashboardAset->kondisi) == 'Baik' ? 'selected' : '' }}>
                                        Baik
                                    </option>
                                    <option value="Rusak Ringan" {{ old('kondisi', $dashboardAset->kondisi) == 'Rusak Ringan' ? 'selected' : '' }}>
                                        Rusak Ringan
                                    </option>
                                    <option value="Rusak Berat" {{ old('kondisi', $dashboardAset->kondisi) == 'Rusak Berat' ? 'selected' : '' }}>
                                        Rusak Berat
                                    </option>
                                </select>
                            </div>
                            <div class="flex items-center space-x-2 text-xs text-gray-500 mt-1">
                                <span class="px-2 py-0.5 bg-green-100 text-green-800 rounded">Baik</span>
                                <span class="px-2 py-0.5 bg-yellow-100 text-yellow-800 rounded">Rusak Ringan</span>
                                <span class="px-2 py-0.5 bg-red-100 text-red-800 rounded">Rusak Berat</span>
                            </div>
                            @error('kondisi')
                            <p class="text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- Lokasi -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">
                                <div class="flex items-center">
                                    <i class="fas fa-map-marker-alt text-blue-500 mr-2 text-sm"></i>
                                    Lokasi
                                    <span class="text-red-500 ml-1">*</span>
                                </div>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-building text-gray-400"></i>
                                </div>
                                <input type="text" name="lokasi" value="{{ old('lokasi', $dashboardAset->lokasi) }}" required
                                    class="input-field pl-10 @error('lokasi') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror"
                                    placeholder="Contoh: Gedung A Lantai 3">
                            </div>
                            @error('lokasi')
                            <p class="text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- Tahun -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">
                                <div class="flex items-center">
                                    <i class="fas fa-calendar-alt text-blue-500 mr-2 text-sm"></i>
                                    Tahun
                                    <span class="text-red-500 ml-1">*</span>
                                </div>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-calendar text-gray-400"></i>
                                </div>
                                <input type="number" name="tahun" value="{{ old('tahun', $dashboardAset->tahun) }}" required
                                    min="2000" max="{{ date('Y') + 1 }}"
                                    class="input-field pl-10 @error('tahun') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror"
                                    placeholder="{{ date('Y') }}">
                            </div>
                            <p class="text-xs text-gray-500">Tahun perolehan/pengadaan aset</p>
                            @error('tahun')
                            <p class="text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- Keterangan -->
                        <div class="md:col-span-2 space-y-2">
                            <label class="block text-sm font-medium text-gray-700">
                                <div class="flex items-center">
                                    <i class="fas fa-sticky-note text-blue-500 mr-2 text-sm"></i>
                                    Keterangan
                                </div>
                            </label>
                            <div class="relative">
                                <div class="absolute top-3 left-3">
                                    <i class="fas fa-comment-alt text-gray-400"></i>
                                </div>
                                <textarea name="keterangan" rows="4"
                                    class="w-full px-4 py-3 pl-10 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-all duration-200 @error('keterangan') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror"
                                    placeholder="Masukkan keterangan tambahan tentang aset...">{{ old('keterangan', $dashboardAset->keterangan) }}</textarea>
                            </div>
                            <p class="text-xs text-gray-500">Opsional: informasi tambahan tentang aset</p>
                            @error('keterangan')
                            <p class="text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div class="text-sm text-gray-600">
                                <i class="fas fa-info-circle text-blue-500 mr-1"></i>
                                Kolom dengan tanda <span class="text-red-500">*</span> wajib diisi
                            </div>
                            <div class="flex items-center space-x-3">
                                <a href="{{ route('admin.dashboard-aset.index') }}"
                                   class="btn-secondary flex items-center justify-center w-full sm:w-auto">
                                    <i class="fas fa-times mr-2"></i>
                                    Batal
                                </a>
                                <button type="button" onclick="showPreview()"
                                        class="btn-secondary flex items-center justify-center w-full sm:w-auto">
                                    <i class="fas fa-eye mr-2"></i>
                                    Preview
                                </button>
                                <button type="submit"
                                        class="btn-primary flex items-center justify-center w-full sm:w-auto">
                                    <i class="fas fa-save mr-2"></i>
                                    Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Form Tips -->
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                    <div class="flex items-start">
                        <div class="h-8 w-8 rounded-full bg-purple-100 flex items-center justify-center mr-3 flex-shrink-0">
                            <i class="fas fa-lightbulb text-purple-600 text-sm"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-900">Tips Editing</h4>
                            <ul class="mt-1 text-xs text-gray-600 list-disc list-inside space-y-1">
                                <li>Pastikan perubahan data sesuai dengan dokumen fisik terbaru</li>
                                <li>Periksa kondisi aset sebelum memperbarui status</li>
                                <li>Update nilai buku sesuai dengan penyusutan yang berlaku</li>
                                <li>Catat perubahan penting dalam keterangan untuk audit trail</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Change History (Optional) -->
            @if($dashboardAset->created_at != $dashboardAset->updated_at)
            <div class="mt-6 bg-gradient-to-r from-gray-50 to-blue-50 rounded-2xl p-6 border border-gray-200">
                <div class="flex items-center mb-4">
                    <i class="fas fa-history text-gray-500 mr-2"></i>
                    <h4 class="text-sm font-medium text-gray-900">Riwayat Perubahan</h4>
                </div>
                <div class="space-y-2">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Dibuat pada:</span>
                        <span class="font-medium text-gray-900">{{ $dashboardAset->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Terakhir diupdate:</span>
                        <span class="font-medium text-gray-900">{{ $dashboardAset->updated_at->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Selisih waktu:</span>
                        <span class="font-medium text-gray-900">{{ $dashboardAset->created_at->diffInDays($dashboardAset->updated_at) }} hari</span>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    @push('scripts')
    <script>
        // Format input nilai dengan separator ribuan
        document.querySelectorAll('input[type="number"][name*="nilai"]').forEach(input => {
            // Format on blur
            input.addEventListener('blur', function() {
                if (this.value) {
                    const formattedValue = parseFloat(this.value).toLocaleString('id-ID');
                    // Store original value in data attribute
                    this.dataset.originalValue = this.value;
                    // Update display (but keep original for form submission)
                    const display = this.parentElement.querySelector('.value-display');
                    if (display) {
                        display.textContent = 'Rp ' + formattedValue;
                    }
                }
            });

            // Show original on focus
            input.addEventListener('focus', function() {
                this.select();
                const display = this.parentElement.querySelector('.value-display');
                if (display) {
                    display.textContent = '';
                }
            });
        });

        // Auto-calculate nilai buku jika perolehan diubah
        const nilaiPerolehanInput = document.querySelector('input[name="nilai_perolehan"]');
        const nilaiBukuInput = document.querySelector('input[name="nilai_buku"]');

        if (nilaiPerolehanInput && nilaiBukuInput) {
            nilaiPerolehanInput.addEventListener('change', function() {
                const oldNilaiBuku = parseFloat(nilaiBukuInput.dataset.originalValue || nilaiBukuInput.value);
                const newNilaiPerolehan = parseFloat(this.value);
                const oldNilaiPerolehan = parseFloat(this.dataset.originalValue || this.defaultValue);

                // Only auto-calculate if nilai buku hasn't been manually changed much
                if (oldNilaiBuku && oldNilaiPerolehan) {
                    const ratio = oldNilaiBuku / oldNilaiPerolehan;
                    const suggestedNilaiBuku = Math.round(newNilaiPerolehan * ratio);

                    // Show suggestion tooltip
                    if (Math.abs(suggestedNilaiBuku - oldNilaiBuku) > (oldNilaiBuku * 0.1)) {
                        showCalculationSuggestion(suggestedNilaiBuku);
                    }
                }
            });
        }

        // Form validation feedback
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('border-red-300', 'focus:border-red-500', 'focus:ring-red-200');

                    // Add error icon
                    const errorIcon = document.createElement('div');
                    errorIcon.className = 'absolute right-3 top-3';
                    errorIcon.innerHTML = '<i class="fas fa-exclamation-circle text-red-500"></i>';

                    if (!field.parentElement.querySelector('.fa-exclamation-circle')) {
                        field.parentElement.appendChild(errorIcon);
                    }
                } else {
                    field.classList.remove('border-red-300', 'focus:border-red-500', 'focus:ring-red-200');
                    const errorIcon = field.parentElement.querySelector('.fa-exclamation-circle');
                    if (errorIcon) {
                        errorIcon.parentElement.remove();
                    }
                }
            });

            if (!isValid) {
                e.preventDefault();

                // Scroll to first error
                const firstError = form.querySelector('.border-red-300');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstError.focus();
                }
            }
        });

        // Show preview function
        function showPreview() {
            // Collect form data
            const formData = new FormData(form);
            const previewData = {};

            for (let [key, value] of formData.entries()) {
                previewData[key] = value;
            }

            // Show preview in modal (simplified)
            alert('Preview Data:\n\n' +
                  'Kategori: ' + previewData.kategori_aset + '\n' +
                  'Jumlah Unit: ' + previewData.jumlah_unit + '\n' +
                  'Nilai Buku: Rp ' + Number(previewData.nilai_buku).toLocaleString('id-ID') + '\n' +
                  'Kondisi: ' + previewData.kondisi + '\n' +
                  'Lokasi: ' + previewData.lokasi);
        }

        // Show calculation suggestion
        function showCalculationSuggestion(suggestedValue) {
            const suggestionDiv = document.createElement('div');
            suggestionDiv.className = 'mt-2 p-3 bg-blue-50 border border-blue-200 rounded-lg text-sm text-blue-800';
            suggestionDiv.innerHTML = `
                <div class="flex items-center justify-between">
                    <div>
                        <i class="fas fa-calculator mr-2"></i>
                        <span>Saran nilai buku: <strong>Rp ${suggestedValue.toLocaleString('id-ID')}</strong></span>
                    </div>
                    <button type="button" onclick="applySuggestion(${suggestedValue})" class="text-blue-600 hover:text-blue-800 font-medium">
                        Terapkan
                    </button>
                </div>
            `;

            const existingSuggestion = document.querySelector('.suggestion-box');
            if (existingSuggestion) {
                existingSuggestion.remove();
            }

            suggestionDiv.classList.add('suggestion-box');
            nilaiBukuInput.parentElement.appendChild(suggestionDiv);
        }

        // Apply suggestion
        function applySuggestion(value) {
            nilaiBukuInput.value = value;
            const suggestionBox = document.querySelector('.suggestion-box');
            if (suggestionBox) {
                suggestionBox.remove();
            }
        }
    </script>
    @endpush
</x-app-layout>
