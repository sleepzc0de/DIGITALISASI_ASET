<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                    {{ __('Detail Pemindahtanganan BMN') }}
                </h2>
                <p class="text-gray-600 text-sm mt-1">Detail lengkap laporan pemindahtanganan BMN</p>
            </div>
            <a href="{{ route('manajemen-bmn.pemindahtanganan.index') }}"
               class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 hover:border-gray-400 transition-all duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Daftar
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Card -->
        <div class="bg-gradient-to-r from-orange-500 to-amber-500 rounded-3xl shadow-2xl overflow-hidden mb-8" data-aos="fade-up">
            <div class="p-8 text-white">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <div class="flex items-center space-x-3 mb-4">
                            @php
                                $jenisColors = [
                                    'Penjualan' => 'from-blue-500 to-blue-600',
                                    'Tukar Menukar' => 'from-emerald-500 to-emerald-600',
                                    'Hibah' => 'from-amber-500 to-amber-600',
                                    'Penyertaan Modal' => 'from-purple-500 to-purple-600'
                                ];
                                $color = $jenisColors[$pemindahtanganan->jenis_pemindahtanganan] ?? 'from-gray-500 to-gray-600';
                            @endphp
                            <span class="px-4 py-2 text-sm font-semibold rounded-full bg-white/20 backdrop-blur-sm">
                                {{ $pemindahtanganan->jenis_pemindahtanganan }}
                            </span>
                            <span class="px-4 py-2 text-sm font-semibold rounded-full {{ $pemindahtanganan->getStatusPnbpBadgeClass() }}">
                                {{ $pemindahtanganan->status_pnbp }}
                            </span>
                        </div>
                        <h1 class="text-3xl font-bold mb-3">{{ $pemindahtanganan->nama_aset }}</h1>
                        <p class="text-orange-100 text-lg">{{ $pemindahtanganan->nomor_laporan }}</p>
                    </div>
                    <div class="mt-6 lg:mt-0 lg:text-right">
                        <div class="text-4xl font-bold mb-2">Rp {{ number_format($pemindahtanganan->nilai_pnbp, 0, ',', '.') }}</div>
                        <p class="text-orange-100">Nilai PNBP</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8" data-aos="fade-up" data-aos-delay="100">
            <!-- Left Column -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Informasi Aset Card -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                            Informasi Aset
                        </h3>
                    </div>
                    <div class="p-6">
                        @if($pemindahtanganan->deskripsi_aset)
                        <div class="mb-6">
                            <h4 class="text-sm font-medium text-gray-600 mb-3 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Deskripsi Aset
                            </h4>
                            <div class="bg-blue-50/50 rounded-xl p-5 border border-blue-100">
                                <p class="text-gray-700 whitespace-pre-line leading-relaxed">{{ $pemindahtanganan->deskripsi_aset }}</p>
                            </div>
                        </div>
                        @endif

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-gradient-to-br from-blue-50 to-white rounded-xl p-5 border border-blue-100">
                                <h4 class="text-sm font-medium text-gray-600 mb-2 flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2zM9 9h6v6H9V9z"/>
                                    </svg>
                                    Nilai Perolehan
                                </h4>
                                <p class="text-2xl font-bold text-blue-600">Rp {{ number_format($pemindahtanganan->nilai_perolehan, 0, ',', '.') }}</p>
                            </div>
                            <div class="bg-gradient-to-br from-emerald-50 to-white rounded-xl p-5 border border-emerald-100">
                                <h4 class="text-sm font-medium text-gray-600 mb-2 flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Nilai Buku
                                </h4>
                                <p class="text-2xl font-bold text-emerald-600">Rp {{ number_format($pemindahtanganan->nilai_buku, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informasi PNBP Card -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden" data-aos="fade-up" data-aos-delay="150">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            Informasi PNBP
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div class="bg-gradient-to-br from-green-50 to-white rounded-xl p-6 border border-green-100">
                                <h4 class="text-sm font-medium text-gray-600 mb-3">Nilai PNBP</h4>
                                <p class="text-3xl font-bold text-gray-900">Rp {{ number_format($pemindahtanganan->nilai_pnbp, 0, ',', '.') }}</p>
                            </div>
                            <div class="bg-gradient-to-br from-purple-50 to-white rounded-xl p-6 border border-purple-100">
                                <h4 class="text-sm font-medium text-gray-600 mb-3">Status PNBP</h4>
                                <div class="flex items-center">
                                    <span class="px-4 py-2 text-base font-semibold rounded-full {{ $pemindahtanganan->getStatusPnbpBadgeClass() }}">
                                        {{ $pemindahtanganan->status_pnbp }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        @if($pemindahtanganan->status_pnbp == 'Sudah Setor')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @if($pemindahtanganan->tanggal_setor_pnbp)
                            <div class="bg-blue-50/50 rounded-xl p-5">
                                <h4 class="text-sm font-medium text-gray-600 mb-2 flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    Tanggal Setor
                                </h4>
                                <p class="text-lg font-semibold text-gray-900">{{ $pemindahtanganan->tanggal_setor_pnbp->format('d F Y') }}</p>
                            </div>
                            @endif

                            @if($pemindahtanganan->nomor_bukti_setor)
                            <div class="bg-yellow-50/50 rounded-xl p-5">
                                <h4 class="text-sm font-medium text-gray-600 mb-2 flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    Nomor Bukti Setor
                                </h4>
                                <p class="text-lg font-semibold text-gray-900">{{ $pemindahtanganan->nomor_bukti_setor }}</p>
                            </div>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-8">
                <!-- Informasi Pemindahtanganan Card -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden" data-aos="fade-up" data-aos-delay="200">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                            </svg>
                            Detail Transaksi
                        </h3>
                    </div>
                    <div class="p-6 space-y-6">
                        <div>
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Tanggal Pemindahtanganan</h4>
                            <div class="flex items-center text-gray-900">
                                <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span class="font-semibold">{{ $pemindahtanganan->tanggal_pemindahtanganan->format('d F Y') }}</span>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Penerima</h4>
                            <div class="flex items-start">
                                <svg class="w-5 h-5 mr-2 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $pemindahtanganan->penerima }}</p>
                                </div>
                            </div>
                        </div>

                        @if($pemindahtanganan->getFileUrl())
                        <div>
                            <h4 class="text-sm font-medium text-gray-600 mb-3">Dokumen</h4>
                            <a href="{{ $pemindahtanganan->getFileUrl() }}" target="_blank"
                               class="inline-flex items-center justify-center w-full px-4 py-3 bg-gradient-to-r from-orange-500 to-amber-500 text-white rounded-xl hover:from-orange-600 hover:to-amber-600 transition-all duration-200 font-medium shadow-md hover:shadow-lg">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Download Laporan
                            </a>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Status & Timeline Card -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden" data-aos="fade-up" data-aos-delay="250">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Timeline
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <div class="h-8 w-8 rounded-full bg-green-100 flex items-center justify-center">
                                        <svg class="h-4 w-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-sm font-semibold text-gray-900">Laporan Dibuat</h4>
                                    <p class="text-sm text-gray-500">{{ $pemindahtanganan->created_at->format('d M Y') }}</p>
                                </div>
                            </div>

                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center">
                                        <svg class="h-4 w-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-sm font-semibold text-gray-900">Tanggal Transaksi</h4>
                                    <p class="text-sm text-gray-500">{{ $pemindahtanganan->tanggal_pemindahtanganan->format('d M Y') }}</p>
                                </div>
                            </div>

                            @if($pemindahtanganan->status_pnbp == 'Sudah Setor' && $pemindahtanganan->tanggal_setor_pnbp)
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <div class="h-8 w-8 rounded-full bg-emerald-100 flex items-center justify-center">
                                        <svg class="h-4 w-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-sm font-semibold text-gray-900">PNBP Disetor</h4>
                                    <p class="text-sm text-gray-500">{{ $pemindahtanganan->tanggal_setor_pnbp->format('d M Y') }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Information -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-8" data-aos="fade-up" data-aos-delay="300">
            <!-- Dasar Hukum -->
            @if($pemindahtanganan->dasar_hukum)
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        Dasar Hukum
                    </h3>
                </div>
                <div class="p-6">
                    <div class="bg-indigo-50/50 rounded-xl p-5">
                        <p class="text-gray-700 whitespace-pre-line leading-relaxed">{{ $pemindahtanganan->dasar_hukum }}</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Keterangan -->
            @if($pemindahtanganan->keterangan)
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Keterangan
                    </h3>
                </div>
                <div class="p-6">
                    <div class="bg-gray-50/50 rounded-xl p-5">
                        <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $pemindahtanganan->keterangan }}</p>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Action Buttons -->
        <div class="mt-8 pt-8 border-t border-gray-200 flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
            <div class="text-sm text-gray-500">
                <p>ID: {{ $pemindahtanganan->id }} • Terakhir diperbarui: {{ $pemindahtanganan->updated_at->format('d M Y H:i') }}</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('manajemen-bmn.pemindahtanganan.index') }}"
                   class="inline-flex items-center px-5 py-2.5 border border-gray-300 rounded-xl text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 hover:border-gray-400 transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali
                </a>
                <button onclick="window.print()"
                        class="inline-flex items-center px-5 py-2.5 border border-indigo-300 rounded-xl text-sm font-medium text-indigo-700 bg-indigo-50 hover:bg-indigo-100 hover:border-indigo-400 transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    Cetak
                </button>
            </div>
        </div>
    </div>

    <style>
        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
</x-app-layout>
