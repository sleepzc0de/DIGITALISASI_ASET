<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Tambah Data Aset') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <form action="{{ route('admin.dashboard-aset.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Kategori Aset -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori Aset</label>
                        <input type="text" name="kategori_aset" value="{{ old('kategori_aset') }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('kategori_aset')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jumlah Unit -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Unit</label>
                        <input type="number" name="jumlah_unit" value="{{ old('jumlah_unit') }}"required min="1"
class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
@error('jumlah_unit')
<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
@enderror
</div>
                <!-- Nilai Perolehan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nilai Perolehan (Rp)</label>
                    <input type="number" name="nilai_perolehan" value="{{ old('nilai_perolehan') }}" required min="0" step="0.01"
                        class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    @error('nilai_perolehan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nilai Buku -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nilai Buku (Rp)</label>
                    <input type="number" name="nilai_buku" value="{{ old('nilai_buku') }}" required min="0" step="0.01"
                        class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    @error('nilai_buku')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kondisi -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kondisi</label>
                    <select name="kondisi" required class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Pilih Kondisi</option>
                        <option value="Baik" {{ old('kondisi') == 'Baik' ? 'selected' : '' }}>Baik</option>
                        <option value="Rusak Ringan" {{ old('kondisi') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                        <option value="Rusak Berat" {{ old('kondisi') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                    </select>
                    @error('kondisi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Lokasi -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi</label>
                    <input type="text" name="lokasi" value="{{ old('lokasi') }}" required
                        class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    @error('lokasi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tahun -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                    <input type="number" name="tahun" value="{{ old('tahun', date('Y')) }}" required min="2000" max="{{ date('Y') + 1 }}"
                        class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    @error('tahun')
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
                <a href="{{ route('admin.dashboard-aset.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
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

