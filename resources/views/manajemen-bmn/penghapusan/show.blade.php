<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between">
            <div>
                <h2 class="font-semibold text-3xl font-bold text-gray-900 leading-tight">
                    {{ __('Detail Penghapusan BMN') }}
                </h2>
                <div class="flex items-center mt-2 text-sm text-gray-600">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Detail lengkap Surat Keputusan Penghapusan Barang Milik Negara
                </div>
            </div>
            <div class="mt-4 md:mt-0 flex items-center space-x-3">
                <a href="{{ route('manajemen-bmn.penghapusan.index') }}"
                   class="btn-secondary flex items-center group">
                    <svg class="w-4 h-4 mr-2 transform transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Daftar
                </a>
                <button onclick="window.print()" class="btn-secondary flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    Cetak
                </button>
            </div>
        </div>
    </x-slot>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Card -->
        <div class="bg-gradient-to-br from-gray-900 to-blue-900 rounded-3xl shadow-2xl overflow-hidden mb-8 transform transition-all duration-500 hover:shadow-3xl" data-aos="fade-up">
            <div class="p-8 md:p-10">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between">
                    <div class="mb-6 lg:mb-0 lg:mr-8">
                        <div class="inline-flex items-center px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm text-white text-sm font-medium mb-4">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            {{ $penghapusan->alasan_penghapusan }}
                        </div>
                        <h1 class="text-3xl md:text-4xl font-bold text-white mb-3 leading-tight">
                            {{ $penghapusan->nama_aset }}
                        </h1>
                        <div class="flex items-center text-blue-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span class="font-mono tracking-wide">{{ $penghapusan->nomor_sk }}</span>
                        </div>
                    </div>
                    <div class="flex flex-col items-center lg:items-end">
                        <div class="px-6 py-3 rounded-full bg-white/20 backdrop-blur-sm mb-4">
                            <span class="text-lg font-bold text-white {{
                                $penghapusan->status == 'Selesai' ? 'bg-gradient-to-r from-green-400 to-emerald-400 bg-clip-text text-transparent' :
                                ($penghapusan->status == 'Proses' ? 'bg-gradient-to-r from-yellow-400 to-amber-400 bg-clip-text text-transparent' :
                                ($penghapusan->status == 'Draft' ? 'bg-gradient-to-r from-gray-400 to-gray-300 bg-clip-text text-transparent' :
                                'bg-gradient-to-r from-red-400 to-rose-400 bg-clip-text text-transparent'))
                            }}">
                                {{ $penghapusan->status }}
                            </span>
                        </div>
                        <div class="text-white/80 text-sm">
                            Terakhir diperbarui: {{ $penghapusan->updated_at->format('d M Y H:i') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Decorative waves -->
            <div class="h-2 bg-gradient-to-r from-blue-500/30 via-purple-500/30 to-pink-500/30"></div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Informasi Aset -->
                <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100 transform transition-all duration-300 hover:shadow-xl" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-100 to-blue-50 flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Informasi Aset</h3>
                            <p class="text-gray-600">Detail aset yang akan dihapus</p>
                        </div>
                    </div>

                    <!-- Kode Barang -->
                    @if($penghapusan->kode_barang)
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kode Barang</label>
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-4 border border-blue-100">
                            <div class="font-mono font-bold text-lg text-blue-700">{{ $penghapusan->kode_barang }}</div>
                        </div>
                    </div>
                    @endif

                    <!-- Deskripsi Aset -->
                    @if($penghapusan->deskripsi_aset)
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Aset</label>
                        <div class="bg-gray-50 rounded-xl p-5 border-l-4 border-blue-500">
                            <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $penghapusan->deskripsi_aset }}</p>
                        </div>
                    </div>
                    @endif

                    <!-- Stats Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                        <div class="bg-gradient-to-br from-orange-50 to-amber-50 rounded-2xl p-6 border border-orange-100 transform transition-all duration-300 hover:scale-[1.02] hover:shadow-lg">
                            <div class="flex items-center mb-3">
                                <div class="w-10 h-10 rounded-lg bg-orange-100 flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Jumlah Unit</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ number_format($penghapusan->jumlah_unit) }}</p>
                                </div>
                            </div>
                            <div class="text-xs text-gray-500">Unit BMN yang dihapus</div>
                        </div>

                        <div class="bg-gradient-to-br from-purple-50 to-violet-50 rounded-2xl p-6 border border-purple-100 transform transition-all duration-300 hover:scale-[1.02] hover:shadow-lg">
                            <div class="flex items-center mb-3">
                                <div class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Nilai Perolehan</p>
                                    <p class="text-lg font-bold text-gray-900">Rp {{ number_format($penghapusan->nilai_perolehan, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            <div class="text-xs text-gray-500">Nilai awal perolehan aset</div>
                        </div>

                        <div class="bg-gradient-to-br from-rose-50 to-pink-50 rounded-2xl p-6 border border-rose-100 transform transition-all duration-300 hover:scale-[1.02] hover:shadow-lg">
                            <div class="flex items-center mb-3">
                                <div class="w-10 h-10 rounded-lg bg-rose-100 flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 8h6m-5 0a3 3 0 110 6H9l3 3m-3-6h6m6 1a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Nilai Buku</p>
                                    <p class="text-lg font-bold text-gray-900">Rp {{ number_format($penghapusan->nilai_buku, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            <div class="text-xs text-gray-500">Nilai saat penghapusan</div>
                        </div>
                    </div>
                </div>

                <!-- Alasan & Metode Penghapusan -->
                <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100 transform transition-all duration-300 hover:shadow-xl" data-aos="fade-up" data-aos-delay="150">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-yellow-100 to-yellow-50 flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.312 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Alasan Penghapusan</h3>
                            <p class="text-gray-600">Dasar dan metode penghapusan</p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="bg-gradient-to-r from-yellow-50 to-amber-50 rounded-xl p-6 border-l-4 border-yellow-500">
                            <h4 class="text-lg font-bold text-gray-900 mb-2">{{ $penghapusan->alasan_penghapusan }}</h4>
                            @if($penghapusan->keterangan)
                            <p class="text-gray-700 mt-3">{{ $penghapusan->keterangan }}</p>
                            @endif
                        </div>

                        @if($penghapusan->metode_penghapusan)
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Metode Penghapusan</label>
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                                    </svg>
                                </div>
                                <span class="text-lg font-semibold text-gray-900">{{ $penghapusan->metode_penghapusan }}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-8">
                <!-- Timeline & Pejabat -->
                <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100" data-aos="fade-up" data-aos-delay="200">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Timeline Penghapusan
                    </h3>

                    <div class="space-y-6">
                        <div class="relative pl-8 pb-8">
                            <div class="absolute left-0 top-0 w-6 h-6 bg-blue-500 rounded-full border-4 border-white shadow"></div>
                            <div class="absolute left-3 top-6 bottom-0 w-0.5 bg-gradient-to-b from-blue-200 to-transparent"></div>
                            <div>
                                <p class="text-sm font-medium text-gray-600">Tanggal SK</p>
                                <p class="text-lg font-bold text-gray-900">{{ $penghapusan->tanggal_sk->format('d F Y') }}</p>
                                <p class="text-sm text-gray-500 mt-1">Surat Keputusan ditetapkan</p>
                            </div>
                        </div>

                        <div class="relative pl-8">
                            <div class="absolute left-0 top-0 w-6 h-6 bg-green-500 rounded-full border-4 border-white shadow"></div>
                            <div>
                                <p class="text-sm font-medium text-gray-600">Tanggal Penghapusan</p>
                                <p class="text-lg font-bold text-gray-900">{{ $penghapusan->tanggal_penghapusan->format('d F Y') }}</p>
                                <p class="text-sm text-gray-500 mt-1">Pelaksanaan penghapusan</p>
                            </div>
                        </div>

                        <div class="mt-8 pt-6 border-t border-gray-200">
                            <h4 class="text-sm font-medium text-gray-700 mb-3">Pejabat Penandatangan</h4>
                            <div class="flex items-center p-4 bg-gradient-to-r from-gray-50 to-white rounded-xl border border-gray-200">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center mr-3">
                                    <span class="text-white font-bold">{{ substr($penghapusan->pejabat_penandatangan, 0, 1) }}</span>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $penghapusan->pejabat_penandatangan }}</p>
                                    <p class="text-xs text-gray-600">Penandatangan SK</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dokumen Pendukung -->
                <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100" data-aos="fade-up" data-aos-delay="250">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Dokumen Pendukung
                    </h3>

                    <div class="space-y-4">
                        @if($penghapusan->getFileSKUrl())
                        <a href="{{ $penghapusan->getFileSKUrl() }}" target="_blank"
                           class="group flex items-center justify-between p-4 bg-gradient-to-r from-red-50 to-rose-50 rounded-xl border border-red-100 hover:border-red-300 transition-all duration-300 transform hover:-translate-y-1">
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-lg bg-red-100 flex items-center justify-center mr-4 group-hover:bg-red-200 transition-colors">
                                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">SK Penghapusan</p>
                                    <p class="text-sm text-gray-600">Download file SK</p>
                                </div>
                            </div>
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-red-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                        </a>
                        @endif

                        @if($penghapusan->getFileBAUrl())
                        <a href="{{ $penghapusan->getFileBAUrl() }}" target="_blank"
                           class="group flex items-center justify-between p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border border-blue-100 hover:border-blue-300 transition-all duration-300 transform hover:-translate-y-1">
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center mr-4 group-hover:bg-blue-200 transition-colors">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">BA Penghapusan</p>
                                    <p class="text-sm text-gray-600">Download berita acara</p>
                                </div>
                            </div>
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                        </a>
                        @endif

                        @if(!$penghapusan->getFileSKUrl() && !$penghapusan->getFileBAUrl())
                        <div class="text-center py-8">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <p class="text-gray-500">Tidak ada dokumen tersedia</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Status Info -->
                <div class="bg-gradient-to-br from-gray-50 to-white rounded-2xl shadow-lg p-8 border border-gray-200">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Status Informasi</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center p-3 bg-white rounded-xl border border-gray-200">
                            <span class="text-gray-700">Status Proses</span>
                            <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $penghapusan->getStatusBadgeClass() }}">
                                {{ $penghapusan->status }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-white rounded-xl border border-gray-200">
                            <span class="text-gray-700">ID Data</span>
                            <span class="font-mono text-sm text-blue-600">{{ $penghapusan->id }}</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-white rounded-xl border border-gray-200">
                            <span class="text-gray-700">Dibuat</span>
                            <span class="text-sm text-gray-600">{{ $penghapusan->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-white rounded-xl border border-gray-200">
                            <span class="text-gray-700">Diperbarui</span>
                            <span class="text-sm text-gray-600">{{ $penghapusan->updated_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                background: white !important;
            }
            .bg-gradient-to-br {
                background: #1e40af !important;
                color: white !important;
            }
        }

        .shadow-3xl {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
    </style>
</x-app-layout>
