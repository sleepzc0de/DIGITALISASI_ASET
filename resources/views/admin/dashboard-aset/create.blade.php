<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    {{ __('Tambah Data Aset') }}
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Tambahkan data aset BMN baru ke dalam sistem
                </p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.dashboard-aset.index') }}" class="btn-secondary flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Form Container -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-200">
                <!-- Form Header -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="h-10 w-10 rounded-lg bg-blue-500 flex items-center justify-center mr-3">
                            <i class="fas fa-plus text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Form Tambah Aset</h3>
                            <p class="text-sm text-gray-600">Isi semua kolom yang diperlukan dengan data yang valid</p>
                        </div>
                    </div>
                </div>

                <!-- Form Content -->
                <form action="{{ route('admin.dashboard-aset.store') }}" method="POST" class="p-6">
                    @csrf

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
                                <input type="text" name="kategori_aset" value="{{ old('kategori_aset') }}" required
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
                                <input type="number" name="jumlah_unit" value="{{ old('jumlah_unit') }}" required min="1"
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
                                <input type="number" name="nilai_perolehan" value="{{ old('nilai_perolehan') }}" required min="0"
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
                                <input type="number" name="nilai_buku" value="{{ old('nilai_buku') }}" required min="0"
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
                                    <option value="Baik" {{ old('kondisi') == 'Baik' ? 'selected' : '' }}>
                                        Baik
                                    </option>
                                    <option value="Rusak Ringan" {{ old('kondisi') == 'Rusak Ringan' ? 'selected' : '' }}>
                                        Rusak Ringan
                                    </option>
                                    <option value="Rusak Berat" {{ old('kondisi') == 'Rusak Berat' ? 'selected' : '' }}>
                                        Rusak Berat
                                    </option>
                                </select>
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
                                <input type="text" name="lokasi" value="{{ old('lokasi') }}" required
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
                                <input type="number" name="tahun" value="{{ old('tahun', date('Y')) }}" required
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
                                    placeholder="Masukkan keterangan tambahan tentang aset...">{{ old('keterangan') }}</textarea>
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
                                <button type="submit"
                                        class="btn-primary flex items-center justify-center w-full sm:w-auto">
                                    <i class="fas fa-save mr-2"></i>
                                    Simpan Data
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Form Tips -->
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                    <div class="flex items-start">
                        <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center mr-3 flex-shrink-0">
                            <i class="fas fa-lightbulb text-blue-600 text-sm"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-900">Tips Pengisian</h4>
                            <ul class="mt-1 text-xs text-gray-600 list-disc list-inside space-y-1">
                                <li>Pastikan data yang dimasukkan sesuai dengan dokumen fisik aset</li>
                                <li>Nilai buku biasanya lebih rendah dari nilai perolehan karena penyusutan</li>
                                <li>Periksa kembali tahun pengadaan untuk memastikan keakuratan</li>
                                <li>Gunakan keterangan untuk mencatat informasi penting lainnya</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Format input nilai dengan separator ribuan
        document.querySelectorAll('input[type="number"][name*="nilai"]').forEach(input => {
            input.addEventListener('blur', function() {
                if (this.value) {
                    const value = parseFloat(this.value).toLocaleString('id-ID');
                    this.value = value.replace(/,/g, '');
                }
            });

            input.addEventListener('focus', function() {
                this.select();
            });
        });

        // Auto-calculate nilai buku jika kosong
        const nilaiPerolehanInput = document.querySelector('input[name="nilai_perolehan"]');
        const nilaiBukuInput = document.querySelector('input[name="nilai_buku"]');

        if (nilaiPerolehanInput && nilaiBukuInput) {
            nilaiPerolehanInput.addEventListener('blur', function() {
                if (this.value && !nilaiBukuInput.value) {
                    // Default: nilai buku = 80% dari nilai perolehan
                    const nilaiBuku = Math.round(this.value * 0.8);
                    nilaiBukuInput.value = nilaiBuku;
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
                    field.classList.add('border-red-300');
                    field.classList.add('focus:border-red-500');
                    field.classList.add('focus:ring-red-200');
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
    </script>
    @endpush
</x-app-layout>
