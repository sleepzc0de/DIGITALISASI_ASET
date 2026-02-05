<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Edit Pemanfaatan BMN') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <form action="{{ route('admin.manajemen-bmn.pemanfaatan.update', $pemanfaatan) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Jenis Pemanfaatan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Pemanfaatan <span class="text-red-500">*</span></label>
                        <select name="jenis_pemanfaatan" required class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Pilih Jenis</option>
                            <option value="SK Sewa" {{ old('jenis_pemanfaatan', $pemanfaatan->jenis_pemanfaatan) == 'SK Sewa' ? 'selected' : '' }}>SK Sewa</option>
                            <option value="Izin Penghunian" {{ old('jenis_pemanfaatan', $pemanfaatan->jenis_pemanfaatan) == 'Izin Penghunian' ? 'selected' : '' }}>Izin Penghunian</option>
                        </select>
                        @error('jenis_pemanfaatan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nomor SK -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nomor SK <span class="text-red-500">*</span></label>
                        <input type="text" name="nomor_sk" value="{{ old('nomor_sk', $pemanfaatan->nomor_sk) }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('nomor_sk')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nama Pihak Ketiga -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Pihak Ketiga <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_pihak_ketiga" value="{{ old('nama_pihak_ketiga', $pemanfaatan->nama_pihak_ketiga) }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('nama_pihak_ketiga')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Alamat Objek -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Objek <span class="text-red-500">*</span></label>
                        <textarea name="alamat_objek" rows="2" required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('alamat_objek', $pemanfaatan->alamat_objek) }}</textarea>
                        @error('alamat_objek')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Latitude -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Latitude</label>
                        <input type="number" name="latitude" value="{{ old('latitude', $pemanfaatan->latitude) }}" step="0.00000001" min="-90" max="90"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" placeholder="-6.200000">
                        @error('latitude')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Longitude -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Longitude</label>
                        <input type="number" name="longitude" value="{{ old('longitude', $pemanfaatan->longitude) }}" step="0.00000001" min="-180" max="180"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" placeholder="106.816666">
                        @error('longitude')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi Objek -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Objek</label>
                        <textarea name="deskripsi_objek" rows="3"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('deskripsi_objek', $pemanfaatan->deskripsi_objek) }}</textarea>
                        @error('deskripsi_objek')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Luas Tanah -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Luas Tanah (m²)</label>
                        <input type="number" name="luas_tanah" value="{{ old('luas_tanah', $pemanfaatan->luas_tanah) }}" min="0" step="0.01"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('luas_tanah')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Luas Bangunan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Luas Bangunan (m²)</label>
                        <input type="number" name="luas_bangunan" value="{{ old('luas_bangunan', $pemanfaatan->luas_bangunan) }}" min="0" step="0.01"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('luas_bangunan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nilai Sewa Tahunan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nilai Sewa Tahunan (Rp)</label>
                        <input type="number" name="nilai_sewa_tahunan" value="{{ old('nilai_sewa_tahunan', $pemanfaatan->nilai_sewa_tahunan) }}" min="0" step="0.01"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('nilai_sewa_tahunan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Masa Pemanfaatan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Masa Pemanfaatan (Bulan)</label>
                        <input type="number" name="masa_pemanfaatan_bulan" value="{{ old('masa_pemanfaatan_bulan', $pemanfaatan->masa_pemanfaatan_bulan) }}" min="1"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('masa_pemanfaatan_bulan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Mulai -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai', $pemanfaatan->tanggal_mulai->format('Y-m-d')) }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('tanggal_mulai')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Berakhir -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Berakhir <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_berakhir" value="{{ old('tanggal_berakhir', $pemanfaatan->tanggal_berakhir->format('Y-m-d')) }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('tanggal_berakhir')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status <span class="text-red-500">*</span></label>
                        <select name="status" required class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="Aktif" {{ old('status', $pemanfaatan->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Berakhir" {{ old('status', $pemanfaatan->status) == 'Berakhir' ? 'selected' : '' }}>Berakhir</option>
                            <option value="Diperpanjang" {{ old('status', $pemanfaatan->status) == 'Diperpanjang' ? 'selected' : '' }}>Diperpanjang</option>
                            <option value="Dibatalkan" {{ old('status', $pemanfaatan->status) == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- File SK -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">File SK</label>
                        @if($pemanfaatan->file_sk)
                        <div class="mb-2">
                            <a href="{{ $pemanfaatan->getFileUrl() }}" target="_blank" class="text-sm text-indigo-600 hover:text-indigo-800">
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

                    <!-- Keterangan -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                        <textarea name="keterangan" rows="3"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('keterangan', $pemanfaatan->keterangan) }}</textarea>
                        @error('keterangan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-8 flex justify-end space-x-3">
                    <a href="{{ route('admin.manajemen-bmn.pemanfaatan.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
