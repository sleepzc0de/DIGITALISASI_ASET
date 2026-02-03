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
                            <div class="bg-green-600 h-4 rounded-full transition-all duration-
