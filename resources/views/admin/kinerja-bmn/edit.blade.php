<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Edit Data Kinerja BMN') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <form action="{{ route('admin.kinerja-bmn.update', $kinerjaBmn) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Jenis Kegiatan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kegiatan</label>
                        <select name="jenis_kegiatan" required class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Pilih Jenis</option>
                            <option value="Pengadaan" {{ old('jenis_kegiatan', $kinerjaBmn->jenis_kegiatan) == 'Pengadaan' ? 'selected' : '' }}>Pengadaan</option>
                            <option value="Pemeliharaan" {{ old('jenis_kegiatan', $kinerjaBmn->jenis_kegiatan) == 'Pemeliharaan' ? 'selected' : '' }}>Pemeliharaan</option>
                            <option value="Penghapusan" {{ old('jenis_kegiatan', $kinerjaBmn->jenis_kegiatan) == 'Penghapusan' ? 'selected' : '' }}>Penghapusan</option>
                        </select>
                        @error('jenis_kegiatan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nama Kegiatan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Kegiatan</label>
                        <input type="text" name="nama_kegiatan" value="{{ old('nama_kegiatan', $kinerjaBmn->nama_kegiatan) }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('nama_kegiatan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Target -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Target</label>
                        <input type="number" name="target" value="{{ old('target', $kinerjaBmn->target) }}" required min="1"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('target')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Realisasi -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Realisasi</label>
                        <input type="number" name="realisasi" value="{{ old('realisasi', $kinerjaBmn->realisasi) }}" required min="0"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('realisasi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Anggaran -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Anggaran (Rp)</label>
                        <input type="number" name="anggaran" value="{{ old('anggaran', $kinerjaBmn->anggaran) }}" required min="0" step="0.01"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('anggaran')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Realisasi Anggaran -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Realisasi Anggaran (Rp)</label>
                        <input type="number" name="realisasi_anggaran" value="{{ old('realisasi_anggaran', $kinerjaBmn->realisasi_anggaran) }}" required min="0" step="0.01"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('realisasi_anggaran')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select name="status" required class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Pilih Status</option>
                            <option value="On Progress" {{ old('status', $kinerjaBmn->status) == 'On Progress' ? 'selected' : '' }}>On Progress</option>
                            <option value="Completed" {{ old('status', $kinerjaBmn->status) == 'Completed' ? 'selected' : '' }}>Completed</option>
                            <option value="Delayed" {{ old('status', $kinerjaBmn->status) == 'Delayed' ? 'selected' : '' }}>Delayed</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Mulai -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai', $kinerjaBmn->tanggal_mulai?->format('Y-m-d')) }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('tanggal_mulai')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Selesai -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai', $kinerjaBmn->tanggal_selesai?->format('Y-m-d')) }}"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('tanggal_selesai')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Bulan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Bulan</label>
                        <select name="bulan" required class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Pilih Bulan</option>
                            @for($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ old('bulan', $kinerjaBmn->bulan) == $i ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create()->month($i)->format('F') }}
                                </option>
                            @endfor
                        </select>
                        @error('bulan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tahun -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                        <input type="number" name="tahun" value="{{ old('tahun', $kinerjaBmn->tahun) }}" required min="2000" max="{{ date('Y') + 1 }}"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('tahun')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Keterangan -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                        <textarea name="keterangan" rows="3"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('keterangan', $kinerjaBmn->keterangan) }}</textarea>
                        @error('keterangan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-8 flex justify-end space-x-3">
                    <a href="{{ route('admin.kinerja-bmn.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
