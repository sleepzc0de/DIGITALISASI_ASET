<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Detail Perencanaan BMN') }}
            </h2>
            <a href="{{ route('manajemen-bmn.perencanaan.index') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">
                ← Kembali ke Daftar
            </a>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Header Section -->
            <div class="bg-gradient-to-br from-indigo-500 to-purple-600 p-8 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="px-3 py-1 text-sm font-semibold rounded-full bg-white bg-opacity-20 mb-3 inline-block">
                            {{ $perencanaan->jenis_perencanaan }}
                        </span>
                        <h1 class="text-3xl font-bold mb-2">{{ $perencanaan->judul }}</h1>
                        <p class="text-indigo-100">{{ $perencanaan->nomor_dokumen }}</p>
                    </div>
                    <div>
                        <span class="px-4 py-2 text-sm font-semibold rounded-full
                            {{ $perencanaan->status == 'Disetujui' ? 'bg-green-400 text-green-900' : '' }}
                            {{ $perencanaan->status == 'Draft' ? 'bg-gray-400 text-gray-900' : '' }}
                            {{ $perencanaan->status == 'Diajukan' ? 'bg-blue-400 text-blue-900' : '' }}
                            {{ $perencanaan->status == 'Ditolak' ? 'bg-red-400 text-red-900' : '' }}
                            {{ $perencanaan->status == 'Selesai' ? 'bg-purple-400 text-purple-900' : '' }}">
                            {{ $perencanaan->status }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Content Section -->
            <div class="p-8">
                <!-- Informasi Umum -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Umum</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 rounded-xl p-5">
                            <h4 class="text-sm font-medium text-gray-500 mb-2">Kategori</h4>
                            <p class="text-lg font-semibold text-gray-900">{{ $perencanaan->kategori ?? '-' }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-5">
                            <h4 class="text-sm font-medium text-gray-500 mb-2">Tahun Anggaran</h4>
                            <p class="text-lg font-semibold text-gray-900">{{ $perencanaan->tahun_anggaran }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-5">
                            <h4 class="text-sm font-medium text-gray-500 mb-2">Tanggal Dokumen</h4>
                            <p class="text-lg font-semibold text-gray-900">{{ $perencanaan->tanggal_dokumen->format('d F Y') }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-5">
                            <h4 class="text-sm font-medium text-gray-500 mb-2">Pembuat</h4>
                            <p class="text-lg font-semibold text-gray-900">{{ $perencanaan->pembuat }}</p>
                        </div>
                    </div>
                </div>

                <!-- Deskripsi -->
                @if($perencanaan->deskripsi)
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Deskripsi</h3>
                    <div class="bg-blue-50 rounded-xl p-5">
                        <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $perencanaan->deskripsi }}</p>
                    </div>
                </div>
                @endif

                <!-- Estimasi -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Estimasi Kebutuhan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @if($perencanaan->nilai_estimasi)
                        <div class="bg-green-50 rounded-xl p-5 border-l-4 border-green-500">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Nilai Estimasi</h4>
                            <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($perencanaan->nilai_estimasi, 0, ',', '.') }}</p>
                        </div>
                        @endif
                        @if($perencanaan->volume)
                        <div class="bg-blue-50 rounded-xl p-5 border-l-4 border-blue-500">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Volume</h4>
                            <p class="text-2xl font-bold text-gray-900">{{ number_format($perencanaan->volume) }} {{ $perencanaan->satuan }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Pengesahan -->
                @if($perencanaan->pejabat_pengesah)
                <div class="mb-8 border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Pengesahan</h3>
                    <div class="bg-purple-50 rounded-xl p-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <h4 class="text-sm font-medium text-gray-600 mb-1">Pejabat Pengesah</h4>
                                <p class="font-semibold text-gray-900">{{ $perencanaan->pejabat_pengesah }}</p>
                            </div>
                            @if($perencanaan->tanggal_pengesahan)
                            <div>
                                <h4 class="text-sm font-medium text-gray-600 mb-1">Tanggal Pengesahan</h4>
                                <p class="font-semibold text-gray-900">{{ $perencanaan->tanggal_pengesahan->format('d F Y') }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endif

                <!-- Keterangan -->
                @if($perencanaan->keterangan)
                <div class="mb-8 border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Keterangan</h3>
                    <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $perencanaan->keterangan }}</p>
                </div>
                @endif

                <!-- File Dokumen -->
                @if($perencanaan->getFileUrl())
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Dokumen Lampiran</h3>
                    <a href="{{ $perencanaan->getFileUrl() }}" target="_blank" class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Download Dokumen
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
