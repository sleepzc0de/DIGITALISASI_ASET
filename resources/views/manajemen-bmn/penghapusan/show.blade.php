<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Detail Penghapusan BMN') }}
            </h2>
            <a href="{{ route('manajemen-bmn.penghapusan.index') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">
                ← Kembali ke Daftar
            </a>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Header Section -->
            <div class="bg-gradient-to-br from-red-500 to-red-600 p-8 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="px-3 py-1 text-sm font-semibold rounded-full bg-white bg-opacity-20 mb-3 inline-block">
                            {{ $penghapusan->alasan_penghapusan }}
                        </span>
                        <h1 class="text-3xl font-bold mb-2">{{ $penghapusan->nama_aset }}</h1>
                        <p class="text-red-100">{{ $penghapusan->nomor_sk }}</p>
                    </div>
                    <div>
                        <span class="px-4 py-2 text-sm font-semibold rounded-full
                            {{ $penghapusan->status == 'Draft' ? 'bg-gray-400 text-gray-900' : '' }}
                            {{ $penghapusan->status == 'Proses' ? 'bg-blue-400 text-blue-900' : '' }}
                            {{ $penghapusan->status == 'Selesai' ? 'bg-green-400 text-green-900' : '' }}
                            {{ $penghapusan->status == 'Dibatalkan' ? 'bg-red-900 text-white' : '' }}">
                            {{ $penghapusan->status }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Content Section -->
            <div class="p-8">
                <!-- Informasi Aset -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Aset yang Dihapus</h3>

                    @if($penghapusan->kode_barang)
                    <div class="bg-gray-50 rounded-xl p-5 mb-4">
                        <h4 class="text-sm font-medium text-gray-600 mb-2">Kode Barang</h4>
                        <p class="text-lg font-semibold text-gray-900">{{ $penghapusan->kode_barang }}</p>
                    </div>
                    @endif

                    @if($penghapusan->deskripsi_aset)
                    <div class="bg-blue-50 rounded-xl p-5 mb-4">
                        <h4 class="text-sm font-medium text-gray-600 mb-2">Deskripsi Aset</h4>
                        <p class="text-gray-700 whitespace-pre-line">{{ $penghapusan->deskripsi_aset }}</p>
                    </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-orange-50 rounded-xl p-5 border-l-4 border-orange-500">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Jumlah Unit</h4>
                            <p class="text-3xl font-bold text-gray-900">{{ number_format($penghapusan->jumlah_unit) }}</p>
                        </div>
                        <div class="bg-purple-50 rounded-xl p-5 border-l-4 border-purple-500">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Nilai Perolehan</h4>
                            <p class="text-lg font-bold text-gray-900">Rp {{ number_format($penghapusan->nilai_perolehan, 0, ',', '.') }}</p>
                        </div>
                        <div class="bg-red-50 rounded-xl p-5 border-l-4 border-red-500">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Nilai Buku</h4>
                            <p class="text-lg font-bold text-gray-900">Rp {{ number_format($penghapusan->nilai_buku, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Alasan Penghapusan -->
                <div class="mb-8 border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Alasan Penghapusan</h3>
                    <div class="bg-yellow-50 rounded-xl p-5 border-l-4 border-yellow-500">
                        <p class="text-xl font-semibold text-gray-900">{{ $penghapusan->alasan_penghapusan }}</p>
                        @if($penghapusan->metode_penghapusan)
                        <p class="text-sm text-gray-600 mt-2">Metode: {{ $penghapusan->metode_penghapusan }}</p>
                        @endif
                    </div>
                </div>

                <!-- Informasi SK & Tanggal -->
                <div class="mb-8 border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi SK & Pelaksanaan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 rounded-xl p-5">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Tanggal SK</h4>
                            <p class="text-lg font-semibold text-gray-900">{{ $penghapusan->tanggal_sk->format('d F Y') }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-5">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Tanggal Penghapusan</h4>
                            <p class="text-lg font-semibold text-gray-900">{{ $penghapusan->tanggal_penghapusan->format('d F Y') }}</p>
                        </div>
                        <div class="bg-indigo-50 rounded-xl p-5 md:col-span-2">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Pejabat Penandatangan</h4>
                            <p class="text-lg font-semibold text-gray-900">{{ $penghapusan->pejabat_penandatangan }}</p>
                        </div>
                    </div>
                </div>

                <!-- Keterangan -->
                @if($penghapusan->keterangan)
                <div class="mb-8 border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Keterangan</h3>
                    <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $penghapusan->keterangan }}</p>
                </div>
                @endif

                <!-- File Dokumen -->
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Dokumen Pendukung</h3>
                    <div class="flex flex-wrap gap-3">
                        @if($penghapusan->getFileSKUrl())
                        <a href="{{ $penghapusan->getFileSKUrl() }}" target="_blank" class="inline-flex items-center px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Download SK Penghapusan
                        </a>
                        @endif

                        @if($penghapusan->getFileBAUrl())
                        <a href="{{ $penghapusan->getFileBAUrl() }}" target="_blank" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Download BA Penghapusan
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
