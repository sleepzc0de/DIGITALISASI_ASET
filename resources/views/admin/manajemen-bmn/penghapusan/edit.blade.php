<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Edit Penghapusan BMN') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <form action="{{ route('admin.manajemen-bmn.penghapusan.update', $penghapusan) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nomor SK -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nomor SK <span class="text-red-500">*</span></label>
                        <input type="text" name="nomor_sk" value="{{ old('nomor_sk', $penghapusan->nomor_sk) }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('nomor_sk')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kode Barang -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kode Barang</label>
                        <input type="text" name="kode_barang" value="{{ old('kode_barang', $penghapusan->kode_barang) }}"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('kode_barang')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nama Aset -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Aset <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_aset" value="{{ old('nama_aset', $penghapusan->nama_aset) }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('nama_aset')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi Aset -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Aset</label>
                        <textarea name="deskripsi_aset" rows="3"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('deskripsi_aset', $penghapusan->deskripsi_aset) }}</textarea>
                        @error('deskripsi_aset')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Alasan Penghapusan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Alasan Penghapusan <span class="text-red-500">*</span></label>
                        <select name="alasan_penghapusan" required class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Pilih Alasan</option>
                            <option value="Rusak Berat" {{ old('alasan_penghapusan', $penghapusan->alasan_penghapusan) == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                            <option value="Hilang" {{ old('alasan_penghapusan', $penghapusan->alasan_penghapusan) == 'Hilang' ? 'selected' : '' }}>Hilang</option>
                            <option value="Kadaluarsa" {{ old('alasan_penghapusan', $penghapusan->alasan_penghapusan) == 'Kadaluarsa' ? 'selected' : '' }}>Kadaluarsa</option>
                            <option value="Tidak Ekonomis" {{ old('alasan_penghapusan', $penghapusan->alasan_penghapusan) == 'Tidak Ekonomis' ? 'selected' : '' }}>Tidak Ekonomis</option>
                            <option value="Force Majeure" {{ old('alasan_penghapusan', $penghapusan->alasan_penghapusan) == 'Force Majeure' ? 'selected' : '' }}>Force Majeure</option>
                            <option value="Lainnya" {{ old('alasan_penghapusan', $penghapusan->alasan_penghapusan) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('alasan_penghapusan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jumlah Unit -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Unit <span class="text-red-500">*</span></label>
                        <input type="number" name="jumlah_unit" value="{{ old('jumlah_unit', $penghapusan->jumlah_unit) }}" required min="1"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('jumlah_unit')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nilai Perolehan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nilai Perolehan (Rp) <span class="text-red-500">*</span></label>
                        <input type="number" name="nilai_perolehan" value="{{ old('nilai_perolehan', $penghapusan->nilai_perolehan) }}" required min="0" step="0.01"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('nilai_perolehan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nilai Buku -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nilai Buku (Rp) <span class="text-red-500">*</span></label>
                        <input type="number" name="nilai_buku" value="{{ old('nilai_buku', $penghapusan->nilai_buku) }}" required min="0" step="0.01"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('nilai_buku')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal SK -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal SK <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_sk" value="{{ old('tanggal_sk', $penghapusan->tanggal_sk->format('Y-m-d')) }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('tanggal_sk')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Penghapusan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Penghapusan <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_penghapusan" value="{{ old('tanggal_penghapusan', $penghapusan->tanggal_penghapusan->format('Y-m-d')) }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('tanggal_penghapusan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pejabat Penandatangan -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pejabat Penandatangan <span class="text-red-500">*</span></label>
                        <input type="text" name="pejabat_penandatangan" value="{{ old('pejabat_penandatangan', $penghapusan->pejabat_penandatangan) }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('pejabat_penandatangan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Metode Penghapusan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Metode Penghapusan</label>
                        <input type="text" name="metode_penghapusan" value="{{ old('metode_penghapusan', $penghapusan->metode_penghapusan) }}" placeholder="Pemusnahan, Pelelangan, dll"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('metode_penghapusan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status <span class="text-red-500">*</span></label>
                        <select name="status" required class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="Draft" {{ old('status', $penghapusan->status) == 'Draft' ? 'selected' : '' }}>Draft</option>
                            <option value="Proses" {{ old('status', $penghapusan->status) == 'Proses' ? 'selected' : '' }}>Proses</option>
                            <option value="Selesai" {{ old('status', $penghapusan->status) == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="Dibatalkan" {{ old('status', $penghapusan->status) == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- File SK -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">File SK</label>
                        @if($penghapusan->file_sk)
                        <div class="mb-2">
                            <a href="{{ $penghapusan->getFileSKUrl() }}" target="_blank" class="text-sm text-indigo-600 hover:text-indigo-800">
                                📄 File SK saat ini
                            </a>
                        </div>
                        @endif
                        <input type="file" name="file_sk" accept=".pdf"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        <p class="mt-1 text-xs text-gray-500">Format: PDF. Maksimal 5MB. Kosongkan jika tidak ingin mengubah.</p>
                        @error('file_sk')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- File BA Penghapusan -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">File Berita Acara Penghapusan</label>
                        @if($penghapusan->file_ba_penghapusan)
                        <div class="mb-2">
                            <a href="{{ $penghapusan->getFileBAUrl() }}" target="_blank" class="text-sm text-indigo-600 hover:text-indigo-800">
                                📄 File BA Penghapusan saat ini
                            </a>
                        </div>
                        @endif
                        <input type="file" name="file_ba_penghapusan" accept=".pdf"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        <p class="mt-1 text-xs text-gray-500">Format: PDF. Maksimal 5MB. Kosongkan jika tidak ingin mengubah.</p>
                        @error('file_ba_penghapusan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Keterangan -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                        <textarea name="keterangan" rows="3"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('keterangan', $penghapusan->keterangan) }}</textarea>
                        @error('keterangan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-8 flex justify-end space-x-3">
                    <a href="{{ route('admin.manajemen-bmn.penghapusan.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
