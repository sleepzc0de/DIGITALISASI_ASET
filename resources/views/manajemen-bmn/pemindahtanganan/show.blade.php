<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Detail Pemindahtanganan BMN') }}
            </h2>
            <a href="{{ route('manajemen-bmn.pemindahtanganan.index') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">
                ← Kembali ke Daftar
            </a>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Header Section -->
            <div class="bg-gradient-to-br from-orange-500 to-orange-600 p-8 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="px-3 py-1 text-sm font-semibold rounded-full bg-white bg-opacity-20 mb-3 inline-block">
                            {{ $pemindahtanganan->jenis_pemindahtanganan }}
                        </span>
                        <h1 class="text-3xl font-bold mb-2">{{ $pemindahtanganan->nama_aset }}</h1>
                        <p class="text-orange-100">{{ $pemindahtanganan->nomor_laporan }}</p>
                    </div>
                    <div>
                        <span class="px-4 py-2 text-sm font-semibold rounded-full {{ $pemindahtanganan->getStatusPnbpBadgeClass() }}">
                            {{ $pemindahtanganan->status_pnbp }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Content Section -->
            <div class="p-8">
                <!-- Informasi Aset -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Aset</h3>
                    @if($pemindahtanganan->deskripsi_aset)
                    <div class="bg-blue-50 rounded-xl p-5 mb-4">
                        <h4 class="text-sm font-medium text-gray-600 mb-2">Deskripsi Aset</h4>
                        <p class="text-gray-700 whitespace-pre-line">{{ $pemindahtanganan->deskripsi_aset }}</p>
                    </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 rounded-xl p-5">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Nilai Perolehan</h4>
                            <p class="text-xl font-bold text-gray-900">Rp {{ number_format($pemindahtanganan->nilai_perolehan, 0, ',', '.') }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-5">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Nilai Buku</h4>
                            <p class="text-xl font-bold text-gray-900">Rp {{ number_format($pemindahtanganan->nilai_buku, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Informasi PNBP -->
                <div class="mb-8 border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi PNBP</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-green-50 rounded-xl p-5 border-l-4 border-green-500">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Nilai PNBP</h4>
                            <p class="text-3xl font-bold text-gray-900">Rp {{ number_format($pemindahtanganan->nilai_pnbp, 0, ',', '.') }}</p>
                        </div>
                        <div class="bg-purple-50 rounded-xl p-5 border-l-4 border-purple-500">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Status PNBP</h4>
                            <span class="inline-block px-4 py-2 text-lg font-semibold rounded-full {{ $pemindahtanganan->getStatusPnbpBadgeClass() }}">
                                {{ $pemindahtanganan->status_pnbp }}
                            </span>
                        </div>

                        @if($pemindahtanganan->tanggal_setor_pnbp)
                        <div class="bg-blue-50 rounded-xl p-5">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Tanggal Setor</h4>
                            <p class="text-lg font-semibold text-gray-900">{{ $pemindahtanganan->tanggal_setor_pnbp->format('d F Y') }}</p>
                        </div>
                        @endif

                        @if($pemindahtanganan->nomor_bukti_setor)
                        <div class="bg-yellow-50 rounded-xl p-5">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Nomor Bukti Setor</h4>
                            <p class="text-lg font-semibold text-gray-900">{{ $pemindahtanganan->nomor_bukti_setor }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Informasi Pemindahtanganan -->
                <div class="mb-8 border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Detail Pemindahtanganan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 rounded-xl p-5">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Tanggal Pemindahtanganan</h4>
                            <p class="text-lg font-semibold text-gray-900">{{ $pemindahtanganan->tanggal_pemindahtanganan->format('d F Y') }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-5">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Penerima</h4>
                            <p class="text-lg font-semibold text-gray-900">{{ $pemindahtanganan->penerima }}</p>
                        </div>
                    </div>
                </div>

                <!-- Dasar Hukum -->
                @if($pemindahtanganan->dasar_hukum)
                <div class="mb-8 border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Dasar Hukum</h3>
                    <div class="bg-indigo-50 rounded-xl p-5">
                        <p class="text-gray-700 whitespace-pre-line">{{ $pemindahtanganan->dasar_hukum }}</p>
                    </div>
                </div>
                @endif

                <!-- Keterangan -->
                @if($pemindahtanganan->keterangan)
                <div class="mb-8 border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Keterangan</h3>
                    <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $pemindahtanganan->keterangan }}</p>
                </div>
                @endif

                <!-- File Laporan -->
                @if($pemindahtanganan->getFileUrl())
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Dokumen Laporan</h3>
                    <a href="{{ $pemindahtanganan->getFileUrl() }}" target="_blank" class="inline-flex items-center px-6 py-3 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Download Laporan
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
