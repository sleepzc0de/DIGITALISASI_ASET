<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('manajemen-bmn.perencanaan.index') }}"
                       class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali
                    </a>
                    <span class="text-gray-400">/</span>
                    <h2 class="font-bold text-3xl text-gray-900 leading-tight">
                        Detail Perencanaan
                    </h2>
                </div>
                <p class="text-gray-600 mt-1">Detail lengkap dokumen perencanaan BMN</p>
            </div>
            <div class="flex items-center space-x-3">
                <button onclick="printPage()" class="px-4 py-2.5 bg-white border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-all duration-300 flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    <span>Print</span>
                </button>
                @if($perencanaan->getFileUrl())
                <a href="{{ $perencanaan->getFileUrl() }}" target="_blank"
                   class="px-4 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 flex items-center space-x-2 shadow-md hover:shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span>Download</span>
                </a>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Card -->
        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl shadow-xl overflow-hidden mb-8 transform hover:shadow-2xl transition-all duration-500">
            <div class="p-8 text-white relative">
                <div class="absolute top-0 right-0 w-64 h-64 opacity-10">
                    <svg class="w-full h-full" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>

                <div class="relative z-10">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center space-x-4 mb-4">
                                <span class="px-4 py-1.5 text-sm font-semibold rounded-full bg-white/20 backdrop-blur-sm">
                                    {{ $perencanaan->jenis_perencanaan }}
                                </span>
                                <div class="relative">
                                    <span class="px-4 py-1.5 text-sm font-semibold rounded-full
                                        {{ $perencanaan->status == 'Disetujui' ? 'bg-green-500 text-white' : '' }}
                                        {{ $perencanaan->status == 'Draft' ? 'bg-gray-400 text-gray-900' : '' }}
                                        {{ $perencanaan->status == 'Diajukan' ? 'bg-blue-400 text-blue-900' : '' }}
                                        {{ $perencanaan->status == 'Ditolak' ? 'bg-red-400 text-red-900' : '' }}
                                        {{ $perencanaan->status == 'Selesai' ? 'bg-purple-400 text-purple-900' : '' }}
                                        shadow-lg">
                                        {{ $perencanaan->status }}
                                    </span>
                                    @if($perencanaan->status == 'Diajukan')
                                    <span class="absolute -top-1 -right-1 h-3 w-3 bg-yellow-500 rounded-full animate-pulse"></span>
                                    @endif
                                </div>
                            </div>

                            <h1 class="text-3xl font-bold mb-3">{{ $perencanaan->judul }}</h1>

                            <div class="flex items-center space-x-6 text-blue-100">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                                    </svg>
                                    <span>{{ $perencanaan->nomor_dokumen }}</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span>{{ $perencanaan->created_at->format('d F Y') }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="text-right">
                            @if($perencanaan->nilai_estimasi)
                            <div class="text-2xl font-bold mb-1">Rp {{ number_format($perencanaan->nilai_estimasi, 0, ',', '.') }}</div>
                            <div class="text-blue-200 text-sm">Nilai Estimasi</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column - Document Details -->
            <div class="lg:col-span-2 space-y-8">
                <!-- General Information -->
                <div class="bg-white rounded-2xl shadow-soft p-6 border border-gray-100">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-900 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Informasi Umum
                        </h3>
                        <span class="px-3 py-1 bg-blue-50 text-blue-700 rounded-lg text-sm font-medium">
                            ID: {{ $perencanaan->id }}
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div class="flex items-start space-x-3">
                                <div class="h-10 w-10 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                    </svg>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Kategori</label>
                                    <p class="text-gray-900 font-semibold">{{ $perencanaan->kategori ?? 'Tidak ditentukan' }}</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-3">
                                <div class="h-10 w-10 rounded-lg bg-green-50 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Tahun Anggaran</label>
                                    <p class="text-gray-900 font-semibold">{{ $perencanaan->tahun_anggaran }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div class="flex items-start space-x-3">
                                <div class="h-10 w-10 rounded-lg bg-purple-50 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                                    </svg>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Tanggal Dokumen</label>
                                    <p class="text-gray-900 font-semibold">{{ $perencanaan->tanggal_dokumen->format('d F Y') }}</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-3">
                                <div class="h-10 w-10 rounded-lg bg-orange-50 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Pembuat</label>
                                    <p class="text-gray-900 font-semibold">{{ $perencanaan->pembuat }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                @if($perencanaan->deskripsi)
                <div class="bg-white rounded-2xl shadow-soft p-6 border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                        </svg>
                        Deskripsi
                    </h3>
                    <div class="prose prose-blue max-w-none">
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-5">
                            <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $perencanaan->deskripsi }}</p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Estimation Details -->
                <div class="bg-white rounded-2xl shadow-soft p-6 border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        Detail Estimasi
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @if($perencanaan->nilai_estimasi)
                        <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-5 border border-green-100 transform hover:-translate-y-1 transition-all duration-300">
                            <div class="flex items-center justify-between mb-3">
                                <div class="h-12 w-12 rounded-lg bg-green-100 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <span class="text-green-600 text-sm font-medium">Nilai</span>
                            </div>
                            <h4 class="text-2xl font-bold text-gray-900 mb-1">Rp {{ number_format($perencanaan->nilai_estimasi, 0, ',', '.') }}</h4>
                            <p class="text-gray-600 text-sm">Estimasi kebutuhan dana</p>
                        </div>
                        @endif

                        @if($perencanaan->volume)
                        <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl p-5 border border-blue-100 transform hover:-translate-y-1 transition-all duration-300">
                            <div class="flex items-center justify-between mb-3">
                                <div class="h-12 w-12 rounded-lg bg-blue-100 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                    </svg>
                                </div>
                                <span class="text-blue-600 text-sm font-medium">Volume</span>
                            </div>
                            <h4 class="text-2xl font-bold text-gray-900 mb-1">{{ number_format($perencanaan->volume) }}</h4>
                            <p class="text-gray-600 text-sm">{{ $perencanaan->satuan }} yang dibutuhkan</p>
                        </div>
                        @endif

                        <div class="bg-gradient-to-br from-purple-50 to-violet-50 rounded-xl p-5 border border-purple-100 transform hover:-translate-y-1 transition-all duration-300">
                            <div class="flex items-center justify-between mb-3">
                                <div class="h-12 w-12 rounded-lg bg-purple-100 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                </div>
                                <span class="text-purple-600 text-sm font-medium">Jenis</span>
                            </div>
                            <h4 class="text-2xl font-bold text-gray-900 mb-1">{{ $perencanaan->jenis_perencanaan }}</h4>
                            <p class="text-gray-600 text-sm">Jenis dokumen perencanaan</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Additional Information -->
            <div class="space-y-8">
                <!-- Approval Information -->
                @if($perencanaan->pejabat_pengesah)
                <div class="bg-white rounded-2xl shadow-soft p-6 border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Pengesahan
                    </h3>

                    <div class="space-y-5">
                        <div class="flex items-center space-x-3">
                            <div class="h-12 w-12 rounded-full bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804l-1.12-1.12a3 3 0 01-1.022-2.122V6a3 3 0 013-3h2.16a3 3 0 012.12.879l1.12 1.12M12 9v6m-3-3h6m-6 9h6a3 3 0 003-3v-2.16a3 3 0 00-.879-2.12l-1.12-1.12a3 3 0 00-2.122-1.022H9a3 3 0 00-3 3v6a3 3 0 003 3z"/>
                                </svg>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Pejabat Pengesah</label>
                                <p class="text-gray-900 font-semibold">{{ $perencanaan->pejabat_pengesah }}</p>
                            </div>
                        </div>

                        @if($perencanaan->tanggal_pengesahan)
                        <div class="flex items-center space-x-3">
                            <div class="h-12 w-12 rounded-full bg-gradient-to-br from-blue-500 to-cyan-500 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Tanggal Pengesahan</label>
                                <p class="text-gray-900 font-semibold">{{ $perencanaan->tanggal_pengesahan->format('d F Y') }}</p>
                            </div>
                        </div>
                        @endif
                    </div>

                    @if($perencanaan->status == 'Disetujui')
                    <div class="mt-6 p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-lg border border-green-200">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-green-800 font-medium">Dokumen telah disetujui</span>
                        </div>
                    </div>
                    @endif
                </div>
                @endif

                <!-- Document File -->
                @if($perencanaan->getFileUrl())
                <div class="bg-white rounded-2xl shadow-soft p-6 border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Dokumen Lampiran
                    </h3>

                    <div class="space-y-4">
                        <div class="p-4 bg-gradient-to-r from-orange-50 to-amber-50 rounded-xl border border-orange-100">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-lg bg-orange-100 flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium text-gray-900">File Dokumen</p>
                                    <p class="text-sm text-gray-500">Format: {{ pathinfo($perencanaan->file_dokumen, PATHINFO_EXTENSION) }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <a href="{{ $perencanaan->getFileUrl() }}" target="_blank"
                               class="flex items-center justify-center px-4 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg hover:from-blue-700 hover:to-indigo-700 transition-all duration-300">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Preview
                            </a>
                            <a href="{{ $perencanaan->getFileUrl() }}" download
                               class="flex items-center justify-center px-4 py-3 bg-gradient-to-r from-green-600 to-emerald-600 text-white rounded-lg hover:from-green-700 hover:to-emerald-700 transition-all duration-300">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Download
                            </a>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Metadata -->
                <div class="bg-white rounded-2xl shadow-soft p-6 border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Metadata
                    </h3>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between py-2 border-b border-gray-100">
                            <span class="text-gray-500">Dibuat Pada</span>
                            <span class="font-medium">{{ $perencanaan->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <div class="flex items-center justify-between py-2 border-b border-gray-100">
                            <span class="text-gray-500">Diperbarui Pada</span>
                            <span class="font-medium">{{ $perencanaan->updated_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <div class="flex items-center justify-between py-2 border-b border-gray-100">
                            <span class="text-gray-500">Status</span>
                            <span class="font-medium {{ $perencanaan->status == 'Disetujui' ? 'text-green-600' : ($perencanaan->status == 'Ditolak' ? 'text-red-600' : 'text-blue-600') }}">
                                {{ $perencanaan->status }}
                            </span>
                        </div>
                        @if($perencanaan->keterangan)
                        <div class="pt-4">
                            <label class="block text-sm font-medium text-gray-500 mb-2">Catatan</label>
                            <p class="text-gray-700 text-sm bg-gray-50 p-3 rounded-lg">{{ $perencanaan->keterangan }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="mt-8 flex items-center justify-between">
            <button onclick="window.history.back()"
                    class="px-6 py-3 bg-white border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-all duration-300 flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span>Kembali ke Daftar</span>
            </button>

            <div class="flex items-center space-x-3">
                <button onclick="shareDocument()"
                        class="px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-xl hover:from-purple-700 hover:to-pink-700 transition-all duration-300 flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                    </svg>
                    <span>Bagikan</span>
                </button>

                @if($perencanaan->status != 'Selesai')
                <button onclick="markAsCompleted()"
                        class="px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 text-white rounded-xl hover:from-green-700 hover:to-emerald-700 transition-all duration-300 flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Tandai Selesai</span>
                </button>
                @endif
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        .print-only { display: none; }
        @media print {
            .no-print { display: none; }
            .print-only { display: block; }
            .bg-gradient { background: white !important; }
            .shadow-soft { box-shadow: none !important; }
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        function printPage() {
            window.print();
        }

        function shareDocument() {
            if (navigator.share) {
                navigator.share({
                    title: '{{ $perencanaan->judul }}',
                    text: 'Dokumen Perencanaan BMN: {{ $perencanaan->nomor_dokumen }}',
                    url: window.location.href,
                })
                .then(() => console.log('Berhasil dibagikan'))
                .catch((error) => console.log('Gagal membagikan:', error));
            } else {
                // Fallback for browsers that don't support Web Share API
                alert('Fitur berbagi tidak didukung di browser ini. Salin URL secara manual: ' + window.location.href);
            }
        }

        function markAsCompleted() {
            if (confirm('Apakah Anda yakin ingin menandai dokumen ini sebagai selesai?')) {
                // In a real application, you would make an AJAX request here
                alert('Dokumen berhasil ditandai sebagai selesai!');
                window.location.reload();
            }
        }

        // Add smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add animation on scroll
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.bg-white');
            elements.forEach((el, index) => {
                el.style.animationDelay = `${index * 0.1}s`;
                el.classList.add('animate-fade-in');
            });
        });
    </script>
    @endpush
</x-app-layout>
