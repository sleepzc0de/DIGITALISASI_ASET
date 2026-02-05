<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Edit Data Penatausahaan BMN') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <form action="{{ route('admin.manajemen-bmn.penatausahaan.update', $penatausahaan) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Kode Barang -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kode Barang <span class="text-red-500">*</span></label>
                        <input type="text" name="kode_barang" value="{{ old('kode_barang', $penatausahaan->kode_barang) }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('kode_barang')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- NUP -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">NUP (Nomor Urut Pendaftaran)</label>
                        <input type="text" name="nup" value="{{ old('nup', $penatausahaan->nup) }}"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('nup')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nama Barang -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Barang <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_barang" value="{{ old('nama_barang', $penatausahaan->nama_barang) }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('nama_barang')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                        <select name="kategori" required class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Pilih Kategori</option>
                            <option value="Tanah" {{ old('kategori', $penatausahaan->kategori) == 'Tanah' ? 'selected' : '' }}>Tanah</option>
                            <option value="Gedung Bangunan" {{ old('kategori', $penatausahaan->kategori) == 'Gedung Bangunan' ? 'selected' : '' }}>Gedung Bangunan</option>
                            <option value="Rumah Negara" {{ old('kategori', $penatausahaan->kategori) == 'Rumah Negara' ? 'selected' : '' }}>Rumah Negara</option>
                            <option value="Kendaraan Dinas Operasional" {{ old('kategori', $penatausahaan->kategori) == 'Kendaraan Dinas Operasional' ? 'selected' : '' }}>Kendaraan Dinas Operasional</option>
                            <option value="Kendaraan Dinas Jabatan" {{ old('kategori', $penatausahaan->kategori) == 'Kendaraan Dinas Jabatan' ? 'selected' : '' }}>Kendaraan Dinas Jabatan</option>
                            <option value="Kendaraan Dinas Fungsional" {{ old('kategori', $penatausahaan->kategori) == 'Kendaraan Dinas Fungsional' ? 'selected' : '' }}>Kendaraan Dinas Fungsional</option>
                            <option value="Peralatan Kantor" {{ old('kategori', $penatausahaan->kategori) == 'Peralatan Kantor' ? 'selected' : '' }}>Peralatan Kantor</option>
                            <option value="Lainnya" {{ old('kategori', $penatausahaan->kategori) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('kategori')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kondisi -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kondisi <span class="text-red-500">*</span></label>
                        <select name="kondisi" required class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="Baik" {{ old('kondisi', $penatausahaan->kondisi) == 'Baik' ? 'selected' : '' }}>Baik</option>
                            <option value="Rusak Ringan" {{ old('kondisi', $penatausahaan->kondisi) == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                            <option value="Rusak Berat" {{ old('kondisi', $penatausahaan->kondisi) == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                        </select>
                        @error('kondisi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Spesifikasi -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Spesifikasi</label>
                        <textarea name="spesifikasi" rows="2"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('spesifikasi', $penatausahaan->spesifikasi) }}</textarea>
                        @error('spesifikasi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Merk/Type -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Merk/Type</label>
                        <input type="text" name="merk_type" value="{{ old('merk_type', $penatausahaan->merk_type) }}"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('merk_type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nomor Polisi -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Polisi</label>
                        <input type="text" name="nomor_polisi" value="{{ old('nomor_polisi', $penatausahaan->nomor_polisi) }}" placeholder="Untuk kendaraan"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('nomor_polisi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tahun Pembuatan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tahun Pembuatan</label>
                        <input type="text" name="tahun_pembuatan" value="{{ old('tahun_pembuatan', $penatausahaan->tahun_pembuatan) }}" maxlength="4" placeholder="2024"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('tahun_pembuatan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jumlah Unit -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Unit <span class="text-red-500">*</span></label>
                        <input type="number" name="jumlah_unit" value="{{ old('jumlah_unit', $penatausahaan->jumlah_unit) }}" required min="1"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('jumlah_unit')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Satuan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Satuan <span class="text-red-500">*</span></label>
                        <input type="text" name="satuan" value="{{ old('satuan', $penatausahaan->satuan) }}" required placeholder="Unit, Buah, m², dll"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('satuan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nilai Perolehan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nilai Perolehan (Rp) <span class="text-red-500">*</span></label>
                        <input type="number" name="nilai_perolehan" value="{{ old('nilai_perolehan', $penatausahaan->nilai_perolehan) }}" required min="0" step="0.01"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('nilai_perolehan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nilai Buku -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nilai Buku (Rp) <span class="text-red-500">*</span></label>
                        <input type="number" name="nilai_buku" value="{{ old('nilai_buku', $penatausahaan->nilai_buku) }}" required min="0" step="0.01"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('nilai_buku')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Perolehan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Perolehan <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_perolehan" value="{{ old('tanggal_perolehan', $penatausahaan->tanggal_perolehan->format('Y-m-d')) }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('tanggal_perolehan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Lokasi -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi <span class="text-red-500">*</span></label>
                        <input type="text" name="lokasi" value="{{ old('lokasi', $penatausahaan->lokasi) }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('lokasi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pengguna -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pengguna</label>
                        <input type="text" name="pengguna" value="{{ old('pengguna', $penatausahaan->pengguna) }}"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('pengguna')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status Aset -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status Aset <span class="text-red-500">*</span></label>
                        <select name="status_aset" required class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="Digunakan" {{ old('status_aset', $penatausahaan->status_aset) == 'Digunakan' ? 'selected' : '' }}>Digunakan</option>
                            <option value="Tidak Digunakan" {{ old('status_aset', $penatausahaan->status_aset) == 'Tidak Digunakan' ? 'selected' : '' }}>Tidak Digunakan</option>
                            <option value="Dalam Perbaikan" {{ old('status_aset', $penatausahaan->status_aset) == 'Dalam Perbaikan' ? 'selected' : '' }}>Dalam Perbaikan</option>
                            <option value="Disewakan" {{ old('status_aset', $penatausahaan->status_aset) == 'Disewakan' ? 'selected' : '' }}>Disewakan</option>
                        </select>
                        @error('status_aset')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nomor Dokumen Kepemilikan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Dokumen Kepemilikan</label>
                        <input type="text" name="nomor_dokumen_kepemilikan" value="{{ old('nomor_dokumen_kepemilikan', $penatausahaan->nomor_dokumen_kepemilikan) }}" placeholder="Untuk tanah/bangunan"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('nomor_dokumen_kepemilikan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Luas -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Luas (m²)</label>
                        <input type="number" name="luas" value="{{ old('luas', $penatausahaan->luas) }}" min="0" step="0.01" placeholder="Untuk tanah/bangunan"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('luas')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Alamat Lengkap -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap</label>
                        <textarea name="alamat_lengkap" rows="2" placeholder="Untuk tanah/bangunan"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('alamat_lengkap', $penatausahaan->alamat_lengkap) }}</textarea>
                        @error('alamat_lengkap')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Foto Aset -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Foto Aset</label>
                        @if($penatausahaan->foto_aset)
                        <div class="mb-3">
                            <img src="{{ $penatausahaan->getFotoUrl() }}" alt="{{ $penatausahaan->nama_barang }}" class="h-32 w-32 rounded-lg object-cover border-2 border-gray-200">
                            <p class="mt-1 text-xs text-gray-500">Foto saat ini</p>
                        </div>
                        @endif
                        <input type="file" name="foto_aset" accept="image/jpeg,image/png,image/jpg"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        <p class="mt-1 text-xs text-gray-500">Format: JPEG, PNG, JPG. Maksimal 2MB. Kosongkan jika tidak ingin mengubah.</p>
                        @error('foto_aset')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Keterangan -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                        <textarea name="keterangan" rows="3"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('keterangan', $penatausahaan->keterangan) }}</textarea>
                        @error('keterangan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-8 flex justify-end space-x-3">
                    <a href="{{ route('admin.manajemen-bmn.penatausahaan.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
