<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-3xl text-gray-900 leading-tight tracking-tight">
                    {{ __('Detail Wasdal BMN') }}
                </h2>
                <p class="mt-2 text-gray-600">Informasi lengkap laporan pengawasan aset</p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('manajemen-bmn.wasdal.index') }}"
                   class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Daftar
                </a>
                <button class="btn-primary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit Laporan
                </button>
            </div>
        </div>
    </x-slot>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <!-- Header Card -->
        @php
            $verifikasiPercentage = $wasdal->getPersentaseVerifikasi();
            $verifikasiFormatted = number_format($verifikasiPercentage, 1);
            $jumlahAsetTerverifikasi = $wasdal->jumlah_aset_terverifikasi ?? 0;
            $jumlahAsetTercatat = $wasdal->jumlah_aset_tercatat ?? 0;
        @endphp
        <div class="bg-gradient-to-br from-blue-600 via-blue-700 to-blue-800 rounded-3xl shadow-2xl overflow-hidden mb-8 transform transition-all duration-300 hover:shadow-3xl" data-aos="fade-up">
            <div class="p-8 text-white">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="px-4 py-1.5 text-sm font-semibold rounded-full bg-white/20 backdrop-blur-sm border border-white/30">
                                {{ $wasdal->jenis_wasdal }}
                            </span>
                            <span class="px-4 py-1.5 text-sm font-semibold rounded-full {{ $wasdal->status == 'Approved' ? 'bg-emerald-500/20 text-emerald-100 border border-emerald-500/30' : ($wasdal->status == 'Rejected' ? 'bg-red-500/20 text-red-100 border border-red-500/30' : 'bg-amber-500/20 text-amber-100 border border-amber-500/30') }}">
                                {{ $wasdal->status }}
                            </span>
                        </div>

                        <h1 class="text-3xl lg:text-4xl font-bold mb-4 leading-tight">{{ $wasdal->judul }}</h1>

                        <div class="flex flex-wrap items-center gap-4 text-blue-100">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <span class="font-medium">{{ $wasdal->nomor_laporan }}</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>{{ $wasdal->tanggal_laporan->format('d F Y') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex-shrink-0">
                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
                            <div class="text-center">
                                <div class="text-5xl font-bold mb-2">{{ $verifikasiFormatted }}%</div>
                                <div class="text-sm text-blue-200">Terverifikasi</div>
                                <div class="text-xs text-blue-300 mt-1">{{ number_format($jumlahAsetTerverifikasi) }}/{{ number_format($jumlahAsetTercatat) }} aset</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column - Main Information -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Informasi Utama -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-100 to-blue-50 flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Informasi Laporan</h3>
                            <p class="text-gray-600">Detail periode dan pelaksanaan</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-gradient-to-br from-blue-50 to-white p-5 rounded-xl border border-blue-100 transform transition-all duration-300 hover:scale-[1.02] hover:shadow-md">
                            <div class="flex items-center mb-3">
                                <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-600">Periode</h4>
                                    <p class="text-lg font-bold text-gray-900">{{ $wasdal->periode }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-violet-50 to-white p-5 rounded-xl border border-violet-100 transform transition-all duration-300 hover:scale-[1.02] hover:shadow-md">
                            <div class="flex items-center mb-3">
                                <div class="w-10 h-10 rounded-lg bg-violet-100 flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-600">Tahun</h4>
                                    <p class="text-lg font-bold text-gray-900">{{ $wasdal->tahun }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-emerald-50 to-white p-5 rounded-xl border border-emerald-100 transform transition-all duration-300 hover:scale-[1.02] hover:shadow-md">
                            <div class="flex items-center mb-3">
                                <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-600">Tanggal Laporan</h4>
                                    <p class="text-lg font-bold text-gray-900">{{ $wasdal->tanggal_laporan->format('d F Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($wasdal->tanggal_mulai_pelaksanaan)
                    <div class="mt-6 pt-6 border-t border-gray-100">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Waktu Pelaksanaan</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-gradient-to-br from-indigo-50 to-white p-4 rounded-xl border border-indigo-100">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-lg bg-indigo-100 flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-600">Mulai</p>
                                        <p class="text-base font-semibold text-gray-900">{{ $wasdal->tanggal_mulai_pelaksanaan->format('d F Y') }}</p>
                                    </div>
                                </div>
                            </div>

                            @if($wasdal->tanggal_selesai_pelaksanaan)
                            <div class="bg-gradient-to-br from-indigo-50 to-white p-4 rounded-xl border border-indigo-100">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-lg bg-indigo-100 flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-600">Selesai</p>
                                        <p class="text-base font-semibold text-gray-900">{{ $wasdal->tanggal_selesai_pelaksanaan->format('d F Y') }}</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Statistik Aset -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100" data-aos="fade-up" data-aos-delay="150">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-100 to-emerald-50 flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Statistik Aset</h3>
                            <p class="text-gray-600">Data verifikasi dan kondisi aset</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        @if($wasdal->jumlah_aset_tercatat)
                        <div class="bg-gradient-to-br from-blue-50 to-white p-5 rounded-xl border-l-4 border-blue-500 transform transition-all duration-300 hover:scale-[1.02] hover:shadow-md">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-600 mb-2">Aset Tercatat</h4>
                                    <p class="text-3xl font-bold text-gray-900">{{ number_format($wasdal->jumlah_aset_tercatat) }}</p>
                                </div>
                                <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if($wasdal->jumlah_aset_terverifikasi)
                        <div class="bg-gradient-to-br from-emerald-50 to-white p-5 rounded-xl border-l-4 border-emerald-500 transform transition-all duration-300 hover:scale-[1.02] hover:shadow-md">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-600 mb-2">Aset Terverifikasi</h4>
                                    <p class="text-3xl font-bold text-gray-900">{{ number_format($wasdal->jumlah_aset_terverifikasi) }}</p>
                                    <p class="text-sm text-gray-600 mt-1">{{ number_format($wasdal->getPersentaseVerifikasi(), 1) }}% dari total</p>
                                </div>
                                <div class="w-12 h-12 rounded-lg bg-emerald-100 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Progress Bar -->
                    @if($wasdal->jumlah_aset_tercatat && $wasdal->jumlah_aset_terverifikasi)
                    <div class="bg-gradient-to-br from-gray-50 to-white rounded-xl p-5 border border-gray-100 mb-6">
                        <div class="flex justify-between items-center mb-3">
                            <div>
                                <h4 class="text-sm font-medium text-gray-700">Progress Verifikasi</h4>
                                <p class="text-2xl font-bold text-gray-900">{{ number_format($wasdal->getPersentaseVerifikasi(), 1) }}%</p>
                            </div>
                            <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $verifikasiPercentage >= 80 ? 'bg-emerald-100 text-emerald-800' : ($verifikasiPercentage >= 50 ? 'bg-amber-100 text-amber-800' : 'bg-red-100 text-red-800') }}">
                                @if($verifikasiPercentage >= 80)
                                    🎉 Excellent
                                @elseif($verifikasiPercentage >= 50)
                                    👍 Good
                                @else
                                    ⚡ Needs Attention
                                @endif
                            </span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
                            <div class="bg-gradient-to-r from-emerald-400 to-emerald-600 h-4 rounded-full transition-all duration-1000 ease-out animate-progress" style="width: {{ $verifikasiPercentage }}%"></div>
                        </div>
                        <div class="flex justify-between text-xs text-gray-500 mt-2">
                            <span>0%</span>
                            <span>{{ number_format($jumlahAsetTerverifikasi) }}/{{ number_format($jumlahAsetTercatat) }} aset</span>
                            <span>100%</span>
                        </div>
                    </div>
                    @endif

                    <!-- Total Nilai Buku -->
                    @if($wasdal->total_nilai_buku)
                    <div class="bg-gradient-to-br from-violet-50 to-white p-5 rounded-xl border-l-4 border-violet-500 transform transition-all duration-300 hover:scale-[1.02] hover:shadow-md">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-sm font-medium text-gray-600 mb-2">Total Nilai Buku</h4>
                                <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($wasdal->total_nilai_buku, 0, ',', '.') }}</p>
                            </div>
                            <div class="w-12 h-12 rounded-lg bg-violet-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Kondisi Aset -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-100 to-amber-50 flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Kondisi Aset</h3>
                            <p class="text-gray-600">Status kondisi fisik aset</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @php
                            $asetKondisiBaik = $wasdal->aset_kondisi_baik ?? 0;
                            $asetKondisiRingan = $wasdal->aset_kondisi_rusak_ringan ?? 0;
                            $asetKondisiBerat = $wasdal->aset_kondisi_rusak_berat ?? 0;
                            $totalAset = $asetKondisiBaik + $asetKondisiRingan + $asetKondisiBerat;

                            $baikPercentage = ($totalAset > 0) ? round(($asetKondisiBaik/$totalAset)*100, 1) : 0;
                            $ringanPercentage = ($totalAset > 0) ? round(($asetKondisiRingan/$totalAset)*100, 1) : 0;
                            $beratPercentage = ($totalAset > 0) ? round(($asetKondisiBerat/$totalAset)*100, 1) : 0;
                        @endphp

                        <div class="bg-gradient-to-br from-emerald-50 to-white p-5 rounded-xl border-l-4 border-emerald-500 text-center transform transition-all duration-300 hover:scale-[1.02] hover:shadow-md">
                            <div class="w-16 h-16 rounded-full bg-emerald-100 flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Kondisi Baik</h4>
                            <p class="text-3xl font-bold text-gray-900">{{ number_format($asetKondisiBaik) }}</p>
                            <div class="text-xs text-gray-500 mt-2">
                                {{ $baikPercentage }}%
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-amber-50 to-white p-5 rounded-xl border-l-4 border-amber-500 text-center transform transition-all duration-300 hover:scale-[1.02] hover:shadow-md">
                            <div class="w-16 h-16 rounded-full bg-amber-100 flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.22 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                </svg>
                            </div>
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Rusak Ringan</h4>
                            <p class="text-3xl font-bold text-gray-900">{{ number_format($asetKondisiRingan) }}</p>
                            <div class="text-xs text-gray-500 mt-2">
                                {{ $ringanPercentage }}%
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-red-50 to-white p-5 rounded-xl border-l-4 border-red-500 text-center transform transition-all duration-300 hover:scale-[1.02] hover:shadow-md">
                            <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                                </svg>
                            </div>
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Rusak Berat</h4>
                            <p class="text-3xl font-bold text-gray-900">{{ number_format($asetKondisiBerat) }}</p>
                            <div class="text-xs text-gray-500 mt-2">
                                {{ $beratPercentage }}%
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Temuan & Rekomendasi -->
                @if($wasdal->temuan || $wasdal->rekomendasi)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @if($wasdal->temuan)
                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100" data-aos="fade-up" data-aos-delay="250">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 rounded-lg bg-amber-100 flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.22 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">Temuan</h3>
                        </div>
                        <div class="bg-amber-50 rounded-xl p-4 border border-amber-100">
                            <p class="text-gray-700 whitespace-pre-line leading-relaxed">{{ $wasdal->temuan }}</p>
                        </div>
                    </div>
                    @endif

                    @if($wasdal->rekomendasi)
                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100" data-aos="fade-up" data-aos-delay="300">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">Rekomendasi</h3>
                        </div>
                        <div class="bg-blue-50 rounded-xl p-4 border border-blue-100">
                            <p class="text-gray-700 whitespace-pre-line leading-relaxed">{{ $wasdal->rekomendasi }}</p>
                        </div>
                    </div>
                    @endif
                </div>
                @endif
            </div>

            <!-- Right Column - Side Information -->
            <div class="space-y-8">
                <!-- Petugas -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100" data-aos="fade-left">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-100 to-indigo-50 flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Petugas</h3>
                            <p class="text-gray-600">Tim pelaksana</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        @if($wasdal->petugas_pelaksana)
                        <div class="flex items-center p-3 bg-indigo-50 rounded-xl border border-indigo-100">
                            <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600">Petugas Pelaksana</p>
                                <p class="font-semibold text-gray-900">{{ $wasdal->petugas_pelaksana }}</p>
                            </div>
                        </div>
                        @endif

                        @if($wasdal->pejabat_penerima)
                        <div class="flex items-center p-3 bg-violet-50 rounded-xl border border-violet-100">
                            <div class="w-10 h-10 rounded-full bg-violet-100 flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5.121 17.804C13.031 16.534 10.145 7.404 18 10m-2.5 8H19a2 2 0 002-2v-5a2 2 0 00-2-2h-2.5M12 15v2m0 0v2m0-2h2m-2 0h-2"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600">Pejabat Penerima</p>
                                <p class="font-semibold text-gray-900">{{ $wasdal->pejabat_penerima }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Dokumen -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100" data-aos="fade-left" data-aos-delay="100">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-gray-100 to-gray-50 flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Dokumen</h3>
                            <p class="text-gray-600">Lampiran laporan</p>
                        </div>
                    </div>

                    <div class="space-y-3">
                        @if($wasdal->getFileLaporanUrl())
                        <a href="{{ $wasdal->getFileLaporanUrl() }}" target="_blank"
                           class="flex items-center justify-between p-4 bg-blue-50 rounded-xl border border-blue-100 hover:bg-blue-100 hover:border-blue-200 transition-all duration-300 group">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-lg bg-blue-100 group-hover:bg-blue-200 flex items-center justify-center mr-3 transition-colors">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">Download Laporan</p>
                                    <p class="text-sm text-gray-600">PDF Document</p>
                                </div>
                            </div>
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                        @endif

                        @if($wasdal->getFileLampiranUrl())
                        <a href="{{ $wasdal->getFileLampiranUrl() }}" target="_blank"
                           class="flex items-center justify-between p-4 bg-emerald-50 rounded-xl border border-emerald-100 hover:bg-emerald-100 hover:border-emerald-200 transition-all duration-300 group">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-lg bg-emerald-100 group-hover:bg-emerald-200 flex items-center justify-center mr-3 transition-colors">
                                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">Download Lampiran</p>
                                    <p class="text-sm text-gray-600">Supporting Files</p>
                                </div>
                            </div>
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-emerald-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                        @endif
                    </div>
                </div>

                <!-- Keterangan -->
                @if($wasdal->keterangan)
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100" data-aos="fade-left" data-aos-delay="150">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">Keterangan</h3>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                        <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $wasdal->keterangan }}</p>
                    </div>
                </div>
                @endif

                <!-- Timeline -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100" data-aos="fade-left" data-aos-delay="200">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-100 to-purple-50 flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Timeline</h3>
                            <p class="text-gray-600">Proses laporan</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                <div class="w-3 h-3 rounded-full bg-blue-600"></div>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Laporan Dibuat</p>
                                <p class="text-sm text-gray-600">{{ $wasdal->created_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-8 h-8 rounded-full {{ $wasdal->status == 'Submitted' ? 'bg-blue-100' : 'bg-gray-100' }} flex items-center justify-center mr-3">
                                <div class="w-3 h-3 rounded-full {{ $wasdal->status == 'Submitted' ? 'bg-blue-600' : 'bg-gray-400' }}"></div>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Disubmit</p>
                                <p class="text-sm text-gray-600">
                                    @if($wasdal->status == 'Submitted' || $wasdal->status == 'Reviewed' || $wasdal->status == 'Approved')
                                        {{ $wasdal->updated_at->format('d M Y, H:i') }}
                                    @else
                                        Menunggu
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-8 h-8 rounded-full {{ $wasdal->status == 'Reviewed' ? 'bg-yellow-100' : 'bg-gray-100' }} flex items-center justify-center mr-3">
                                <div class="w-3 h-3 rounded-full {{ $wasdal->status == 'Reviewed' ? 'bg-yellow-600' : 'bg-gray-400' }}"></div>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Direview</p>
                                <p class="text-sm text-gray-600">
                                    @if($wasdal->status == 'Reviewed' || $wasdal->status == 'Approved')
                                        Selesai
                                    @else
                                        Dalam antrian
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-8 h-8 rounded-full {{ $wasdal->status == 'Approved' ? 'bg-emerald-100' : ($wasdal->status == 'Rejected' ? 'bg-red-100' : 'bg-gray-100') }} flex items-center justify-center mr-3">
                                <div class="w-3 h-3 rounded-full {{ $wasdal->status == 'Approved' ? 'bg-emerald-600' : ($wasdal->status == 'Rejected' ? 'bg-red-600' : 'bg-gray-400') }}"></div>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Status Akhir</p>
                                <p class="text-sm {{ $wasdal->status == 'Approved' ? 'text-emerald-600 font-semibold' : ($wasdal->status == 'Rejected' ? 'text-red-600 font-semibold' : 'text-gray-600') }}">
                                    {{ $wasdal->status }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .animate-progress {
            transition: width 1.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .shadow-3xl {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .backdrop-blur-sm {
            backdrop-filter: blur(4px);
        }
    </style>
</x-app-layout>
