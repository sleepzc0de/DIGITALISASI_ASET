<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.aplikasi-bmn.index') }}"
                       class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors duration-200 group">
                        <svg class="w-5 h-5 mr-1 transform group-hover:-translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Kembali
                    </a>
                    <div class="h-6 w-px bg-gray-300"></div>
                    <h2 class="font-bold text-3xl text-gray-900 tracking-tight">Tambah Aplikasi Baru</h2>
                </div>
                <p class="text-gray-600 mt-1">Isi form berikut untuk menambahkan aplikasi baru</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <form action="{{ route('admin.aplikasi-bmn.store') }}" method="POST" enctype="multipart/form-data" data-aos="fade-up">
            @csrf

            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <!-- Form Header -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-8 py-6 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-500 flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Informasi Aplikasi</h3>
                            <p class="text-gray-600 text-sm">Lengkapi data aplikasi yang akan ditambahkan</p>
                        </div>
                    </div>
                </div>

                <!-- Form Content -->
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Left Column -->
                        <div class="space-y-6">
                            <!-- Nama Aplikasi -->
                            <div>
                                <label class="block text-sm font-medium text-gray-900 mb-2">
                                    Nama Aplikasi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="nama_aplikasi" value="{{ old('nama_aplikasi') }}" required
                                       class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-all duration-200"
                                       placeholder="Masukkan nama aplikasi">
                                @error('nama_aplikasi')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Kategori -->
                            <div>
                                <label class="block text-sm font-medium text-gray-900 mb-2">
                                    Kategori <span class="text-red-500">*</span>
                                </label>
                                <select name="kategori" required
                                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-all duration-200">
                                    <option value="">Pilih Kategori</option>
                                    <option value="BMN" {{ old('kategori') == 'BMN' ? 'selected' : '' }}>BMN</option>
                                    <option value="Pengadaan" {{ old('kategori') == 'Pengadaan' ? 'selected' : '' }}>Pengadaan</option>
                                    <option value="Inventaris" {{ old('kategori') == 'Inventaris' ? 'selected' : '' }}>Inventaris</option>
                                    <option value="Monitoring" {{ old('kategori') == 'Monitoring' ? 'selected' : '' }}>Monitoring</option>
                                </select>
                                @error('kategori')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Vendor -->
                            <div>
                                <label class="block text-sm font-medium text-gray-900 mb-2">Vendor/Penyedia</label>
                                <input type="text" name="vendor" value="{{ old('vendor') }}"
                                       class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-all duration-200"
                                       placeholder="Nama vendor atau penyedia">
                                @error('vendor')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Versi -->
                            <div>
                                <label class="block text-sm font-medium text-gray-900 mb-2">Versi</label>
                                <input type="text" name="versi" value="{{ old('versi') }}"
                                       class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-all duration-200"
                                       placeholder="Contoh: 1.0.0">
                                @error('versi')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- URL Aplikasi -->
                            <div>
                                <label class="block text-sm font-medium text-gray-900 mb-2">URL Aplikasi</label>
                                <input type="url" name="url_aplikasi" value="{{ old('url_aplikasi') }}"
                                       class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-all duration-200"
                                       placeholder="https://example.com">
                                @error('url_aplikasi')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div>
                                <label class="block text-sm font-medium text-gray-900 mb-2">
                                    Status <span class="text-red-500">*</span>
                                </label>
                                <select name="status" required
                                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-all duration-200">
                                    <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="Maintenance" {{ old('status') == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                                    <option value="Non-Aktif" {{ old('status') == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
                                </select>
                                @error('status')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-6">
                            <!-- Logo Aplikasi -->
                            <div>
                                <label class="block text-sm font-medium text-gray-900 mb-2">Logo Aplikasi</label>
                                <div class="mt-1 flex items-center space-x-4">
                                    <div class="h-24 w-24 rounded-xl bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center overflow-hidden">
                                        <img id="logo-preview" class="h-16 w-16 object-contain hidden" alt="Logo preview">
                                        <svg id="logo-placeholder" class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <input type="file" name="logo" id="logo-input" accept="image/*"
                                               class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-colors duration-200">
                                        <p class="mt-2 text-xs text-gray-500">Format: JPEG, PNG, JPG, SVG. Maksimal 2MB</p>
                                        @error('logo')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Jumlah User -->
                            <div>
                                <label class="block text-sm font-medium text-gray-900 mb-2">Jumlah User</label>
                                <input type="number" name="jumlah_user" value="{{ old('jumlah_user', 0) }}" min="0"
                                       class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-all duration-200">
                                @error('jumlah_user')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Biaya Lisensi -->
                            <div>
                                <label class="block text-sm font-medium text-gray-900 mb-2">Biaya Lisensi (Rp)</label>
                                <input type="number" name="biaya_lisensi" value="{{ old('biaya_lisensi') }}" min="0" step="0.01"
                                       class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-all duration-200"
                                       placeholder="0.00">
                                @error('biaya_lisensi')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Periode Lisensi -->
                            <div>
                                <label class="block text-sm font-medium text-gray-900 mb-2">Periode Lisensi</label>
                                <select name="periode_lisensi"
                                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-all duration-200">
                                    <option value="">Pilih Periode</option>
                                    <option value="Tahunan" {{ old('periode_lisensi') == 'Tahunan' ? 'selected' : '' }}>Tahunan</option>
                                    <option value="Bulanan" {{ old('periode_lisensi') == 'Bulanan' ? 'selected' : '' }}>Bulanan</option>
                                    <option value="Selamanya" {{ old('periode_lisensi') == 'Selamanya' ? 'selected' : '' }}>Selamanya</option>
                                </select>
                                @error('periode_lisensi')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Two Column Layout for Dates -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
                        <!-- Tanggal Implementasi -->
                        <div>
                            <label class="block text-sm font-medium text-gray-900 mb-2">Tanggal Implementasi</label>
                            <input type="date" name="tanggal_implementasi" value="{{ old('tanggal_implementasi') }}"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-all duration-200">
                            @error('tanggal_implementasi')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal Kadaluarsa -->
                        <div>
                            <label class="block text-sm font-medium text-gray-900 mb-2">Tanggal Kadaluarsa</label>
                            <input type="date" name="tanggal_expired" value="{{ old('tanggal_expired') }}"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-all duration-200">
                            @error('tanggal_expired')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- PIC Information -->
                    <div class="mt-8 pt-8 border-t border-gray-200">
                        <h4 class="text-lg font-semibold text-gray-900 mb-6">Person In Charge (PIC)</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- PIC Nama -->
                            <div>
                                <label class="block text-sm font-medium text-gray-900 mb-2">Nama PIC</label>
                                <input type="text" name="pic_nama" value="{{ old('pic_nama') }}"
                                       class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-all duration-200">
                                @error('pic_nama')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- PIC Email -->
                            <div>
                                <label class="block text-sm font-medium text-gray-900 mb-2">Email PIC</label>
                                <input type="email" name="pic_email" value="{{ old('pic_email') }}"
                                       class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-all duration-200">
                                @error('pic_email')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- PIC Telepon -->
                            <div>
                                <label class="block text-sm font-medium text-gray-900 mb-2">Telepon PIC</label>
                                <input type="text" name="pic_telepon" value="{{ old('pic_telepon') }}"
                                       class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-all duration-200">
                                @error('pic_telepon')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi dan Fitur Utama -->
                    <div class="mt-8 space-y-8">
                        <!-- Deskripsi -->
                        <div>
                            <label class="block text-sm font-medium text-gray-900 mb-2">Deskripsi</label>
                            <textarea name="deskripsi" rows="3"
                                      class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-all duration-200"
                                      placeholder="Deskripsi singkat tentang aplikasi">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Fitur Utama -->
                        <div>
                            <label class="block text-sm font-medium text-gray-900 mb-2">Fitur Utama</label>
                            <textarea name="fitur_utama" rows="4"
                                      class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-all duration-200"
                                      placeholder="Tuliskan fitur-fitur utama aplikasi">{{ old('fitur_utama') }}</textarea>
                            @error('fitur_utama')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="mt-10 pt-8 border-t border-gray-200 flex justify-end space-x-4">
                        <a href="{{ route('admin.aplikasi-bmn.index') }}"
                           class="px-8 py-3 border border-gray-300 text-gray-700 font-medium rounded-xl hover:bg-gray-50 transition-all duration-200">
                            Batal
                        </a>
                        <button type="submit"
                                class="px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-medium rounded-xl shadow-lg hover:shadow-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-200">
                            Simpan Aplikasi
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Logo preview
        document.getElementById('logo-input').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('logo-preview').src = e.target.result;
                    document.getElementById('logo-preview').classList.remove('hidden');
                    document.getElementById('logo-placeholder').classList.add('hidden');
                }
                reader.readAsDataURL(file);
            }
        });

        // Form validation
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                const requiredFields = form.querySelectorAll('[required]');
                let valid = true;

                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        valid = false;
                        field.classList.add('border-red-500');
                    } else {
                        field.classList.remove('border-red-500');
                    }
                });

                if (!valid) {
                    e.preventDefault();
                    alert('Harap lengkapi semua field yang wajib diisi!');
                }
            });
        });
    </script>
</x-app-layout>
