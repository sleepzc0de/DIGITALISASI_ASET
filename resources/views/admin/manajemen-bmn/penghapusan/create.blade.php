<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Tambah Penghapusan BMN') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <form action="{{ route('admin.manajemen-bmn.penghapusan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nomor SK -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nomor SK <span class="text-red-500">*</span></label>
                        <input type="text" name="nomor_sk" value="{{ old('nomor_sk') }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('nomor_sk')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kode Barang -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kode Barang</label>
                        <input type="text" name="kode_barang" value="{{ old('kode_barang') }}"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('kode_barang')
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

                    <!-- Alasan Penghapusan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Alasan Penghapusan <span class="text-red-500">*</span></label>
                        <select name="alasan_penghapusan" required class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Pilih Alasan</option>
                            <option value="Rusak Berat" {{ old('alasan_penghapusan') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                            <option value="Hilang" {{ old('alasan_penghapusan') == 'Hilang' ? 'selected' : '' }}>Hilang</option>
                            <option value="Kadaluarsa" {{ old('alasan_penghapusan') == 'Kadaluarsa' ? 'selected' : '' }}>Kadaluarsa</option>
                            <option value="Tidak Ekonomis" {{ old('alasan_penghapusan') == 'Tidak Ekonomis' ? 'selected' : '' }}>Tidak Ekonomis</option>
                            <option value="Force Majeure" {{ old('alasan_penghapusan') == 'Force Majeure' ? 'selected' : '' }}>Force Majeure</option>
                            <option value="Lainnya" {{ old('alasan_penghapusan') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('alasan_penghapusan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jumlah Unit -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Unit <span class="text-red-500">*</span></label>
                        <input type="number" name="jumlah_unit" value="{{ old('jumlah_unit') }}" required min="1"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('jumlah_unit')
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

                    <!-- Tanggal SK -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal SK <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_sk" value="{{ old('tanggal_sk') }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('tanggal_sk')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Penghapusan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Penghapusan <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_penghapusan" value="{{ old('tanggal_penghapusan') }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('tanggal_penghapusan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pejabat Penandatangan -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pejabat Penandatangan <span class="text-red-500">*</span></label>
                        <input type="text" name="pejabat_penandatangan" value="{{ old('pejabat_penandatangan') }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('pejabat_penandatangan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Metode Penghapusan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Metode Penghapusan</label>
                        <input type="text" name="metode_penghapusan" value="{{ old('metode_penghapusan') }}" placeholder="Pemusnahan, Pelelangan, dll"
                            class="w-full rounded-lg border-
