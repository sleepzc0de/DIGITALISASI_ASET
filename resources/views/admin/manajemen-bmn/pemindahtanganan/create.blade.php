<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Tambah Pemindahtanganan BMN') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <form action="{{ route('admin.manajemen-bmn.pemindahtanganan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nomor Laporan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Laporan <span class="text-red-500">*</span></label>
                        <input type="text" name="nomor_laporan" value="{{ old('nomor_laporan') }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('nomor_laporan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jenis Pemindahtanganan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Pemindahtanganan <span class="text-red-500">*</span></label>
                        <select name="jenis_pemindahtanganan" required class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Pilih Jenis</option>
                            <option value="Penjualan" {{ old('jenis_pemindahtanganan') == 'Penjualan' ? 'selected' : '' }}>Penjualan</option>
                            <option value="Tukar Menukar" {{ old('jenis_pemindahtanganan') == 'Tukar Menukar' ? 'selected' : '' }}>Tukar Menukar</option>
                            <option value="Hibah" {{ old('jenis_pemindahtanganan') == 'Hibah' ? 'selected' : '' }}>Hibah</option>
                            <option value="Penyertaan Modal" {{ old('jenis_pemindahtanganan') == 'Penyertaan Modal' ? 'selected' : '' }}>Penyertaan Modal</option>
                        </select>
                        @error('jenis_pemindahtanganan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nama Aset -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Aset <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_aset" value="{{ old('nama_aset') }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('nama_aset')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi Aset -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Aset</label>
                        <textarea name="deskripsi_aset" rows="3"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('deskripsi_aset') }}</textarea>
                        @error('deskripsi_aset')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nilai Perolehan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nilai Perolehan (Rp) <span class="text-red-500">*</span></label>
                        <input type="number" name="nilai_perolehan" value="{{ old('nilai_perolehan') }}" required min="0" step="0.01"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('nilai_perolehan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nilai Buku -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nilai Buku (Rp) <span class="text-red-500">*</span></label>
                        <input type="number" name="nilai_buku" value="{{ old('nilai_buku') }}" required min="0" step="0.01"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('nilai_buku')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nilai PNBP -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nilai PNBP (Rp) <span class="text-red-500">*</span></label>
                        <input type="number" name="nilai_pnbp" value="{{ old('nilai_pnbp') }}" required min="0" step="0.01"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('nilai_pnbp')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Pemindahtanganan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Pemindahtanganan <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_pemindahtanganan" value="{{ old('tanggal_pemindahtanganan') }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('tanggal_pemindahtanganan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Penerima -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Penerima <span class="text-red-500">*</span></label>
                        <input type="text" name="penerima" value="{{ old('penerima') }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('penerima')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Dasar Hukum -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Dasar Hukum</label>
                        <textarea name="dasar_hukum" rows="2"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('dasar_hukum') }}</textarea>
                        @error('dasar_hukum')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status PNBP -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status PNBP <span class="text-red-500">*</span></label>
                        <select name="status_pnbp" required class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="Belum Setor" {{ old('status_pnbp') == 'Belum Setor' ? 'selected' : '' }}>Belum Setor</option>
                            <option value="Sudah Setor" {{ old('status_pnbp') == 'Sudah Setor' ? 'selected' : '' }}>Sudah Setor</option>
                            <option value="Dibebaskan" {{ old('status_pnbp') == 'Dibebaskan' ? 'selected' : '' }}>Dibebaskan</option>
                        </select>
                        @error('status_pnbp')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                      <!-- Tanggal Setor PNBP -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Setor PNBP</label>
                    <input type="date" name="tanggal_setor_pnbp" value="{{ old('tanggal_setor_pnbp') }}"
                        class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    @error('tanggal_setor_pnbp')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nomor Bukti Setor -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Bukti Setor</label>
                    <input type="text" name="nomor_bukti_setor" value="{{ old('nomor_bukti_setor') }}"
                        class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    @error('nomor_bukti_setor')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- File Laporan -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">File Laporan</label>
                    <input type="file" name="file_laporan" accept=".pdf"
                        class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    <p class="mt-1 text-xs text-gray-500">Format: PDF. Maksimal 5MB</p>
                    @error('file_laporan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Keterangan -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                    <textarea name="keterangan" rows="3"
                        class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('keterangan') }}</textarea>
                    @error('keterangan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-8 flex justify-end space-x-3">
                <a href="{{ route('admin.manajemen-bmn.pemindahtanganan.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
</x-app-layout>

