<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Detail Data BMN') }}
            </h2>
            <a href="{{ route('manajemen-bmn.penatausahaan.index') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">
                ← Kembali ke Daftar
            </a>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Header Section -->
            <div class="bg-gradient-to-br from-indigo-500 to-purple-600 p-8 text-white">
                <div class="flex items-start justify-between">
                    <div class="flex items-start gap-6">
                        <img src="{{ $penatausahaan->getFotoUrl() }}" alt="{{ $penatausahaan->nama_barang }}"
                            class="w-24 h-24 rounded-xl shadow-lg object-cover bg-white p-2">
                        <div>
                            <span class="px-3 py-1 text-sm font-semibold rounded-full bg-white bg-opacity-20 mb-3 inline-block">
                                {{ $penatausahaan->kategori }}
                            </span>
                            <h1 class="text-3xl font-bold mb-2">{{ $penatausahaan->nama_barang }}</h1>
                            <p class="text-indigo-100">{{ $penatausahaan->kode_barang }}</p>
                            @if($penatausahaan->nup)
                            <p class="text-indigo-100 text-sm">NUP: {{ $penatausahaan->nup }}</p>
                            @endif
                        </div>
                    </div>
                    <div>
                        <span class="px-4 py-2 text-sm font-semibold rounded-full {{ $penatausahaan->getKondisiBadgeClass() }}">
                            {{ $penatausahaan->kondisi }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Content Section -->
            <div class="p-8">
                <!-- Identifikasi Barang -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Identifikasi Barang</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @if($penatausahaan->merk_type)
                        <div class="bg-gray-50 rounded-xl p-5">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Merk/Type</h4>
                            <p class="text-lg font-semibold text-gray-900">{{ $penatausahaan->merk_type }}</p>
                        </div>
                        @endif

                        @if($penatausahaan->tahun_pembuatan)
                        <div class="bg-gray-50 rounded-xl p-5">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Tahun Pembuatan</h4>
                            <p class="text-lg font-semibold text-gray-900">{{ $penatausahaan->tahun_pembuatan }}</p>
                        </div>
                        @endif

                        @if($penatausahaan->nomor_polisi)
                        <div class="bg-blue-50 rounded-xl p-5">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Nomor Polisi</h4>
                            <p class="text-lg font-semibold text-gray-900">{{ $penatausahaan->nomor_polisi }}</p>
                        </div>
                        @endif

                        @if($penatausahaan->nomor_dokumen_kepemilikan)
                        <div class="bg-purple-50 rounded-xl p-5">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Nomor Dokumen Kepemilikan</h4>
                            <p class="text-lg font-semibold text-gray-900">{{ $penatausahaan->nomor_dokumen_kepemilikan }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Spesifikasi -->
                @if($penatausahaan->spesifikasi)
                <div class="mb-8 border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Spesifikasi</h3>
                    <div class="bg-blue-50 rounded-xl p-5">
                        <p class="text-gray-700 whitespace-pre-line">{{ $penatausahaan->spesifikasi }}</p>
                    </div>
                </div>
                @endif

                <!-- Jumlah & Nilai -->
                <div class="mb-8 border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Jumlah & Nilai</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="bg-green-50 rounded-xl p-5 border-l-4 border-green-500">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Jumlah</h4>
                            <p class="text-2xl font-bold text-gray-900">{{ number_format($penatausahaan->jumlah_unit) }}</p>
                            <p class="text-sm text-gray-600">{{ $penatausahaan->satuan }}</p>
                        </div>
                        <div class="bg-blue-50 rounded-xl p-5 border-l-4 border-blue-500">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Nilai Perolehan</h4>
                            <p class="text-lg font-bold text-gray-900">Rp {{ number_format($penatausahaan->nilai_perolehan, 0, ',', '.') }}</p>
                        </div>
                        <div class="bg-purple-50 rounded-xl p-5 border-l-4 border-purple-500">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Nilai Buku</h4>
                            <p class="text-lg font-bold text-gray-900">Rp {{ number_format($penatausahaan->nilai_buku, 0, ',', '.') }}</p>
                        </div>
                        <div class="bg-orange-50 rounded-xl p-5 border-l-4 border-orange-500">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Tanggal Perolehan</h4>
                            <p class="text-lg font-bold text-gray-900">{{ $penatausahaan->tanggal_perolehan->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Luas (untuk Tanah/Bangunan) -->
                @if($penatausahaan->luas)
                <div class="mb-8 border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Luas</h3>
                    <div class="bg-green-50 rounded-xl p-5 border-l-4 border-green-500">
                        <p class="text-3xl font-bold text-gray-900">{{ number_format($penatausahaan->luas, 2, ',', '.') }} m²</p>
                    </div>
                </div>
                @endif

                <!-- Lokasi & Pengguna -->
                <div class="mb-8 border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Lokasi & Pengguna</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-indigo-50 rounded-xl p-5">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Lokasi</h4>
                            <p class="text-lg font-semibold text-gray-900">{{ $penatausahaan->lokasi }}</p>
                        </div>
                        @if($penatausahaan->pengguna)
                        <div class="bg-purple-50 rounded-xl p-5">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Pengguna</h4>
                            <p class="text-lg font-semibold text-gray-900">{{ $penatausahaan->pengguna }}</p>
                        </div>
                        @endif
                    </div>

                    @if($penatausahaan->alamat_lengkap)
                    <div class="bg-gray-50 rounded-xl p-5 mt-4">
                        <h4 class="text-sm font-medium text-gray-600 mb-2">Alamat Lengkap</h4>
                        <p class="text-gray-700">{{ $penatausahaan->alamat_lengkap }}</p>
                    </div>
                    @endif
                </div>

                <!-- Status Aset -->
                <div class="mb-8 border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Status Aset</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-yellow-50 rounded-xl p-5 border-l-4 border-yellow-500">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Status Penggunaan</h4>
                            <p class="text-lg font-semibold text-gray-900">{{ $penatausahaan->status_aset }}</p>
                        </div>
                        <div class="bg-{{ $penatausahaan->kondisi == 'Baik' ? 'green' : ($penatausahaan->kondisi == 'Rusak Ringan' ? 'yellow' : 'red') }}-50 rounded-xl p-5 border-l-4 border-{{ $penatausahaan->kondisi == 'Baik' ? 'green' : ($penatausahaan->kondisi == 'Rusak Ringan' ? 'yellow' : 'red') }}-500">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Kondisi</h4>
                            <p class="text-lg font-semibold text-gray-900">{{ $penatausahaan->kondisi }}</p>
                        </div>
                    </div>
                </div>

                <!-- Keterangan -->
                @if($penatausahaan->keterangan)
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Keterangan</h3>
                    <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $penatausahaan->keterangan }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
