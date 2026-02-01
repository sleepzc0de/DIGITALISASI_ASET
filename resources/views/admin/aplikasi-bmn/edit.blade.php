<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Edit Aplikasi BMN') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <form action="{{ route('admin.aplikasi-bmn.update', $aplikasiBmn) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Logo Preview -->
                    @if ($aplikasiBmn->logo || true)
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Logo Saat Ini</label>
                            <img src="{{ $aplikasiBmn->getLogoUrl() }}" alt="{{ $aplikasiBmn->nama_aplikasi }}"
                                class="w-20 h-20 rounded-lg">
                        </div>
                    @endif

                    <!-- Nama Aplikasi -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Aplikasi <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="nama_aplikasi"
                            value="{{ old('nama_aplikasi', $aplikasiBmn->nama_aplikasi) }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('nama_aplikasi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori <span
                                class="text-red-500">*</span></label>
                        <select name="kategori" required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Pilih Kategori</option>
                            <option value="BMN"
                                {{ old('kategori', $aplikasiBmn->kategori) == 'BMN' ? 'selected' : '' }}>BMN</option>
                            <option value="Pengadaan"
                                {{ old('kategori', $aplikasiBmn->kategori) == 'Pengadaan' ? 'selected' : '' }}>Pengadaan
                            </option>
                            <option value="Inventaris"
                                {{ old('kategori', $aplikasiBmn->kategori) == 'Inventaris' ? 'selected' : '' }}>
                                Inventaris</option>
                            <option value="Monitoring"
                                {{ old('kategori', $aplikasiBmn->kategori) == 'Monitoring' ? 'selected' : '' }}>
                                Monitoring</option>
                        </select>
                        @error('kategori')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status <span
                                class="text-red-500">*</span></label>
                        <select name="status" required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="Aktif"
                                {{ old('status', $aplikasiBmn->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Maintenance"
                                {{ old('status', $aplikasiBmn->status) == 'Maintenance' ? 'selected' : '' }}>
                                Maintenance</option>
                            <option value="Non-Aktif"
                                {{ old('status', $aplikasiBmn->status) == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif
                            </option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Vendor -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Vendor/Penyedia</label>
                        <input type="text" name="vendor" value="{{ old('vendor', $aplikasiBmn->vendor) }}"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('vendor')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Versi -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Versi</label>
                        <input type="text" name="versi" value="{{ old('versi', $aplikasiBmn->versi) }}"
                            placeholder="1.0.0"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('versi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- URL Aplikasi -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">URL Aplikasi</label>
                        <input type="url" name="url_aplikasi"
                            value="{{ old('url_aplikasi', $aplikasiBmn->url_aplikasi) }}"
                            placeholder="https://example.com"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('url_aplikasi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                        <textarea name="deskripsi" rows="3"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('deskripsi', $aplikasiBmn->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jumlah User -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah User</label>
                        <input type="number" name="jumlah_user"
                            value="{{ old('jumlah_user', $aplikasiBmn->jumlah_user) }}" min="0"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('jumlah_user')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Biaya Lisensi -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Biaya Lisensi (Rp)</label>
                        <input type="number" name="biaya_lisensi"
                            value="{{ old('biaya_lisensi', $aplikasiBmn->biaya_lisensi) }}" min="0"
                            step="0.01"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('biaya_lisensi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div> <!-- Periode Lisensi -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Periode Lisensi</label>
                        <select name="periode_lisensi"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Pilih Periode</option>
                            <option value="Tahunan"
                                {{ old('periode_lisensi', $aplikasiBmn->periode_lisensi) == 'Tahunan' ? 'selected' : '' }}>
                                Tahunan</option>
                            <option value="Bulanan"
                                {{ old('periode_lisensi', $aplikasiBmn->periode_lisensi) == 'Bulanan' ? 'selected' : '' }}>
                                Bulanan</option>
                            <option value="Selamanya"
                                {{ old('periode_lisensi', $aplikasiBmn->periode_lisensi) == 'Selamanya' ? 'selected' : '' }}>
                                Selamanya</option>
                        </select>
                        @error('periode_lisensi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div> <!-- Tanggal Implementasi -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Implementasi</label>
                        <input type="date" name="tanggal_implementasi"
                            value="{{ old('tanggal_implementasi', $aplikasiBmn->tanggal_implementasi?->format('Y-m-d')) }}"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('tanggal_implementasi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div> <!-- Tanggal Expired -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Kadaluarsa</label>
                        <input type="date" name="tanggal_expired"
                            value="{{ old('tanggal_expired', $aplikasiBmn->tanggal_expired?->format('Y-m-d')) }}"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('tanggal_expired')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div> <!-- PIC Nama -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">PIC Nama</label>
                        <input type="text" name="pic_nama" value="{{ old('pic_nama', $aplikasiBmn->pic_nama) }}"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('pic_nama')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div> <!-- PIC Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">PIC Email</label>
                        <input type="email" name="pic_email"
                            value="{{ old('pic_email', $aplikasiBmn->pic_email) }}"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('pic_email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div> <!-- PIC Telepon -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">PIC Telepon</label>
                        <input type="text" name="pic_telepon"
                            value="{{ old('pic_telepon', $aplikasiBmn->pic_telepon) }}"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('pic_telepon')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div> <!-- Logo Upload -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Upload Logo Baru (opsional)</label>
                        <input type="file" name="logo" accept="image/*"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        <p class="mt-1 text-xs text-gray-500">Format: JPEG, PNG, JPG, SVG. Maksimal 2MB. Kosongkan jika
                            tidak ingin mengubah logo.</p>
                        @error('logo')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div> <!-- Fitur Utama -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Fitur Utama</label>
                        <textarea name="fitur_utama" rows="4" placeholder="Tuliskan fitur-fitur utama aplikasi..."
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('fitur_utama', $aplikasiBmn->fitur_utama) }}</textarea>
                        @error('fitur_utama')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="mt-8 flex justify-end space-x-3">
                    <a href="{{ route('admin.aplikasi-bmn.index') }}"
                        class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
