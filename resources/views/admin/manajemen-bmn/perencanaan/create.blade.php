<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Tambah Perencanaan BMN') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <form action="{{ route('admin.manajemen-bmn.perencanaan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Jenis Perencanaan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Perencanaan <span class="text-red-500">*</span></label>
                        <select name="jenis_perencanaan" required class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Pilih Jenis</option>
                            <option value="RP4" {{ old('jenis_perencanaan') == 'RP4' ? 'selected' : '' }}>RP4</option>
                            <option value="RKBMN" {{ old('jenis_perencanaan') == 'RKBMN' ? 'selected' : '' }}>RKBMN</option>
                        </select>
                        @error('jenis_perencanaan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nomor Dokumen -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Dokumen <span class="text-red-500">*</span></label>
                        <input type="text" name="nomor_dokumen" value="{{ old('nomor_dokumen') }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('nomor_dokumen')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Judul -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Judul <span class="text-red-500">*</span></label>
                        <input type="text" name="judul" value="{{ old('judul') }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('judul')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <select name="kategori" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Pilih Kategori</option>
                            <option value="Penggunaan" {{ old('kategori') == 'Penggunaan' ? 'selected' : '' }}>Penggunaan</option>
                            <option value="Pemanfaatan" {{ old('kategori') == 'Pemanfaatan' ? 'selected' : '' }}>Pemanfaatan</option>
                            <option value="Pemindahtanganan" {{ old('kategori') == 'Pemindahtanganan' ? 'selected' : '' }}>Pemindahtanganan</option>
                            <option value="Penghapusan" {{ old('kategori') == 'Penghapusan' ? 'selected' : '' }}>Penghapusan</option>
                        </select>
                        @error('kategori')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tahun Anggaran -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tahun Anggaran <span class="text-red-500">*</span></label>
                        <input type="number" name="tahun_anggaran" value="{{ old('tahun_anggaran', date('Y')) }}" required min="2000" max="{{ date('Y') + 5 }}"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('tahun_anggaran')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Dokumen -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Dokumen <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_dokumen" value="{{ old('tanggal_dokumen') }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('tanggal_dokumen')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nilai Estimasi -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nilai Estimasi (Rp)</label>
                        <input type="number" name="nilai_estimasi" value="{{ old('nilai_estimasi') }}" min="0" step="0.01"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('nilai_estimasi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Volume -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Volume</label>
                        <input type="number" name="volume" value="{{ old('volume') }}" min="0"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('volume')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Satuan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Satuan</label>
                        <input type="text" name="satuan" value="{{ old('satuan') }}" placeholder="Unit, m², dll"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('satuan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status <span class="text-red-500">*</span></label>
                        <select name="status" required class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="Draft" {{ old('status') == 'Draft' ? 'selected' : '' }}>Draft</option>
                            <option value="Diajukan" {{ old('status') == 'Diajukan' ? 'selected' : '' }}>Diajukan</option>
                            <option value="Disetujui" {{ old('status') == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                            <option value="Ditolak" {{ old('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                            <option value="Selesai" {{ old('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pembuat -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pembuat <span class="text-red-500">*</span></label>
                        <input type="text" name="pembuat" value="{{ old('pembuat') }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('pembuat')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pejabat Pengesah -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pejabat Pengesah</label>
                        <input type="text" name="pejabat_pengesah" value="{{ old('pejabat_pengesah') }}"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('pejabat_pengesah')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Pengesahan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Pengesahan</label>
                        <input type="date" name="tanggal_pengesahan" value="{{ old('tanggal_pengesahan') }}"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('tanggal_pengesahan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                        <textarea name="deskripsi" rows="3"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- File Dokumen -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">File Dokumen</label>
                        <input type="file" name="file_dokumen" accept=".pdf,.doc,.docx"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        <p class="mt-1 text-xs text-gray-500">Format: PDF, DOC, DOCX. Maksimal 5MB</p>
                        @error('file_dokumen')
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
                    <a href="{{ route('admin.manajemen-bmn.perencanaan.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
