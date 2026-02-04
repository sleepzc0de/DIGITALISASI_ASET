<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Detail Wasdal BMN') }}
            </h2>
            <a href="{{ route('manajemen-bmn.wasdal.index') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">
                ← Kembali ke Daftar
            </a>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Header Section -->
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-8 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="px-3 py-1 text-sm font-semibold rounded-full bg-white bg-opacity-20 mb-3 inline-block">
                            {{ $wasdal->jenis_wasdal }}
                        </span>
                        <h1 class="text-3xl font-bold mb-2">{{ $wasdal->judul }}</h1>
                        <p class="text-blue-100">{{ $wasdal->nomor_laporan }}</p>
                    </div>
                    <div>
                        <span class="px-4 py-2 text-sm font-semibold rounded-full
                            {{ $wasdal->status == 'Draft' ? 'bg-gray-400 text-gray-900' : '' }}
                            {{ $wasdal->status == 'Submitted' ? 'bg-blue-400 text-blue-900' : '' }}
                            {{ $wasdal->status == 'Reviewed' ? 'bg-yellow-400 text-yellow-900' : '' }}
                            {{ $wasdal->status == 'Approved' ? 'bg-green-400 text-green-900' : '' }}
                            {{ $wasdal->status == 'Rejected' ? 'bg-red-400 text-red-900' : '' }}">
                            {{ $wasdal->status }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Content Section -->
            <div class="p-8">
                <!-- Informasi Laporan -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Laporan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-blue-50 rounded-xl p-5">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Periode</h4>
                            <p class="text-lg font-semibold text-gray-900">{{ $wasdal->periode }}</p>
                        </div>
                        <div class="bg-purple-50 rounded-xl p-5">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Tahun</h4>
                            <p class="text-lg font-semibold text-gray-900">{{ $wasdal->tahun }}</p>
                        </div>
                        <div class="bg-green-50 rounded-xl p-5">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Tanggal Laporan</h4>
                            <p class="text-lg font-semibold text-gray-900">{{ $wasdal->tanggal_laporan->format('d F Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Pelaksanaan -->
                @if($wasdal->tanggal_mulai_pelaksanaan)
                <div class="mb-8 border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Waktu Pelaksanaan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-indigo-50 rounded-xl p-5">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Mulai</h4>
                            <p class="text-lg font-semibold text-gray-900">{{ $wasdal->tanggal_mulai_pelaksanaan->format('d F Y') }}</p>
                        </div>
                        @if($wasdal->tanggal_selesai_pelaksanaan)
                        <div class="bg-indigo-50 rounded-xl p-5">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Selesai</h4>
                            <p class="text-lg font-semibold text-gray-900">{{ $wasdal->tanggal_selesai_pelaksanaan->format('d F Y') }}</p>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Data Verifikasi Aset -->
                <div class="mb-8 border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Data Verifikasi Aset</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                        @if($wasdal->jumlah_aset_tercatat)
                        <div class="bg-blue-50 rounded-xl p-5 border-l-4 border-blue-500">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Aset Tercatat</h4>
                            <p class="text-3xl font-bold text-gray-900">{{ number_format($wasdal->jumlah_aset_tercatat) }}</p>
                        </div>
                        @endif

                        @if($wasdal->jumlah_aset_terverifikasi)
                        <div class="bg-green-50 rounded-xl p-5 border-l-4 border-green-500">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Aset Terverifikasi</h4>
                            <p class="text-3xl font-bold text-gray-900">{{ number_format($wasdal->jumlah_aset_terverifikasi) }}</p>
                            <p class="text-sm text-gray-600 mt-1">{{ number_format($wasdal->getPersentaseVerifikasi(), 1) }}% dari total</p>
                        </div>
                        @endif
                    </div>

                    <!-- Progress Bar -->
                    @if($wasdal->jumlah_aset_tercatat && $wasdal->jumlah_aset_terverifikasi)
                    <div class="bg-gray-50 rounded-xl p-5">
                        <div class="flex justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700">Progress Verifikasi</span>
                            <span class="text-sm font-semibold text-gray-900">{{ number_format($wasdal->getPersentaseVerifikasi(), 1) }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-4">
                            <div class="bg-green-600 h-4 rounded-full transition-all duration-500" style="width: {{ $wasdal->getPersentaseVerifikasi() }}%"></div>
</div>
</div>
@endif
                <!-- Total Nilai Buku -->
                @if($wasdal->total_nilai_buku)
                <div class="bg-purple-50 rounded-xl p-5 border-l-4 border-purple-500 mt-4">
                    <h4 class="text-sm font-medium text-gray-600 mb-2">Total Nilai Buku</h4>
                    <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($wasdal->total_nilai_buku, 0, ',', '.') }}</p>
                </div>
                @endif
            </div>

            <!-- Kondisi Aset -->
            <div class="mb-8 border-t border-gray-200 pt-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Kondisi Aset</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-green-50 rounded-xl p-5 border-l-4 border-green-500">
                        <h4 class="text-sm font-medium text-gray-600 mb-2">Kondisi Baik</h4>
                        <p class="text-3xl font-bold text-gray-900">{{ number_format($wasdal->aset_kondisi_baik) }}</p>
                    </div>
                    <div class="bg-yellow-50 rounded-xl p-5 border-l-4 border-yellow-500">
                        <h4 class="text-sm font-medium text-gray-600 mb-2">Rusak Ringan</h4>
                        <p class="text-3xl font-bold text-gray-900">{{ number_format($wasdal->aset_kondisi_rusak_ringan) }}</p>
                    </div>
                    <div class="bg-red-50 rounded-xl p-5 border-l-4 border-red-500">
                        <h4 class="text-sm font-medium text-gray-600 mb-2">Rusak Berat</h4>
                        <p class="text-3xl font-bold text-gray-900">{{ number_format($wasdal->aset_kondisi_rusak_berat) }}</p>
                    </div>
                </div>
            </div>

            <!-- Temuan -->
            @if($wasdal->temuan)
            <div class="mb-8 border-t border-gray-200 pt-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-3">Temuan</h3>
                <div class="bg-yellow-50 rounded-xl p-5 border-l-4 border-yellow-500">
                    <p class="text-gray-700 whitespace-pre-line leading-relaxed">{{ $wasdal->temuan }}</p>
                </div>
            </div>
            @endif

            <!-- Rekomendasi -->
            @if($wasdal->rekomendasi)
            <div class="mb-8 border-t border-gray-200 pt-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-3">Rekomendasi</h3>
                <div class="bg-blue-50 rounded-xl p-5 border-l-4 border-blue-500">
                    <p class="text-gray-700 whitespace-pre-line leading-relaxed">{{ $wasdal->rekomendasi }}</p>
                </div>
            </div>
            @endif

            <!-- Petugas -->
            <div class="mb-8 border-t border-gray-200 pt-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Petugas</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @if($wasdal->petugas_pelaksana)
                    <div class="bg-indigo-50 rounded-xl p-5">
                        <h4 class="text-sm font-medium text-gray-600 mb-2">Petugas Pelaksana</h4>
                        <p class="text-lg font-semibold text-gray-900">{{ $wasdal->petugas_pelaksana }}</p>
                    </div>
                    @endif

                    @if($wasdal->pejabat_penerima)
                    <div class="bg-purple-50 rounded-xl p-5">
                        <h4 class="text-sm font-medium text-gray-600 mb-2">Pejabat Penerima</h4>
                        <p class="text-lg font-semibold text-gray-900">{{ $wasdal->pejabat_penerima }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Keterangan -->
            @if($wasdal->keterangan)
            <div class="mb-8 border-t border-gray-200 pt-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-3">Keterangan</h3>
                <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $wasdal->keterangan }}</p>
            </div>
            @endif

            <!-- File Dokumen -->
            <div class="border-t border-gray-200 pt-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-3">Dokumen Laporan</h3>
                <div class="flex flex-wrap gap-3">
                    @if($wasdal->getFileLaporanUrl())
                    <a href="{{ $wasdal->getFileLaporanUrl() }}" target="_blank" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Download Laporan
                    </a>
                    @endif

                    @if($wasdal->getFileLampiranUrl())
                    <a href="{{ $wasdal->getFileLampiranUrl() }}" target="_blank" class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Download Lampiran
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>

