<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h2 class="font-bold text-3xl text-gray-900 leading-tight">
                    {{ __('Detail Pemanfaatan BMN') }}
                </h2>
                <p class="text-gray-600 mt-2">Informasi lengkap pemanfaatan Barang Milik Negara</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('manajemen-bmn.pemanfaatan.peta') }}"
                   class="inline-flex items-center gap-2 text-emerald-600 hover:text-emerald-800 font-medium px-4 py-2 rounded-lg hover:bg-emerald-50 transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                    </svg>
                    Lihat di Peta
                </a>
                <a href="{{ route('manajemen-bmn.pemanfaatan.index') }}"
                   class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 font-medium px-4 py-2 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Daftar
                </a>
            </div>
        </div>
    </x-slot>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100" data-aos="fade-up">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-emerald-500 via-emerald-600 to-emerald-700 p-8 text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -translate-y-32 translate-x-32"></div>
                <div class="relative z-10">
                    <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-4">
                                <span class="px-4 py-1.5 text-sm font-semibold rounded-full bg-white/20 backdrop-blur-sm">
                                    {{ $pemanfaatan->jenis_pemanfaatan }}
                                </span>
                                <span class="px-4 py-1.5 text-sm font-semibold rounded-full {{ $pemanfaatan->getStatusBadgeClass() }}">
                                    {{ $pemanfaatan->status }}
                                </span>
                            </div>
                            <h1 class="text-3xl lg:text-4xl font-bold mb-3">{{ $pemanfaatan->nama_pihak_ketiga }}</h1>
                            <div class="flex items-center gap-4 text-emerald-100">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <span>{{ $pemanfaatan->nomor_sk }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span>{{ $pemanfaatan->tanggal_mulai->format('d M Y') }} - {{ $pemanfaatan->tanggal_berakhir->format('d M Y') }}</span>
                                </div>
                            </div>
                        </div>
                        @if($pemanfaatan->isExpiringSoon())
                        <div class="bg-amber-500/20 backdrop-blur-sm border border-amber-400/30 rounded-xl p-4">
                            <div class="flex items-center gap-3">
                                <div class="bg-amber-500 rounded-full p-2">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-amber-900">Segera Berakhir</p>
                                    <p class="text-sm text-amber-800">Akan berakhir dalam {{ $pemanfaatan->tanggal_berakhir->diffInDays(now()) }} hari</p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Content Section -->
            <div class="p-8">
                <!-- Informasi Objek -->
                <div class="mb-10" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="bg-blue-100 rounded-lg p-2">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900">Informasi Objek Pemanfaatan</h3>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="bg-gradient-to-br from-blue-50 to-white rounded-xl p-6 border border-blue-100">
                            <h4 class="text-sm font-medium text-gray-600 mb-3 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                Alamat Objek
                            </h4>
                            <p class="text-gray-900 text-lg">{{ $pemanfaatan->alamat_objek }}</p>
                            @if($pemanfaatan->latitude && $pemanfaatan->longitude)
                            <div class="mt-4 p-3 bg-blue-100/50 rounded-lg">
                                <div class="flex items-center gap-2 text-sm text-blue-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                                    </svg>
                                    <span>Koordinat: {{ $pemanfaatan->latitude }}, {{ $pemanfaatan->longitude }}</span>
                                </div>
                            </div>
                            @endif
                        </div>

                        @if($pemanfaatan->deskripsi_objek)
                        <div class="bg-gradient-to-br from-gray-50 to-white rounded-xl p-6 border border-gray-100">
                            <h4 class="text-sm font-medium text-gray-600 mb-3 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Deskripsi Objek
                            </h4>
                            <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $pemanfaatan->deskripsi_objek }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Detail Luas & Nilai -->
                <div class="mb-10" data-aos="fade-up" data-aos-delay="150">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="bg-emerald-100 rounded-lg p-2">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900">Detail Luas & Nilai</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @if($pemanfaatan->luas_tanah)
                        <div class="bg-gradient-to-br from-emerald-50 to-white rounded-xl p-6 border border-emerald-100 transform hover:-translate-y-1 transition-transform duration-300">
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="text-sm font-medium text-gray-600">Luas Tanah</h4>
                                <div class="bg-emerald-100 rounded-lg p-2">
                                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-3xl font-bold text-gray-900 mb-2">{{ number_format($pemanfaatan->luas_tanah, 0, ',', '.') }} m²</p>
                            <div class="h-2 bg-emerald-100 rounded-full overflow-hidden">
                                <div class="h-full bg-emerald-500 rounded-full" style="width: 100%"></div>
                            </div>
                        </div>
                        @endif

                        @if($pemanfaatan->luas_bangunan)
                        <div class="bg-gradient-to-br from-blue-50 to-white rounded-xl p-6 border border-blue-100 transform hover:-translate-y-1 transition-transform duration-300">
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="text-sm font-medium text-gray-600">Luas Bangunan</h4>
                                <div class="bg-blue-100 rounded-lg p-2">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-3xl font-bold text-gray-900 mb-2">{{ number_format($pemanfaatan->luas_bangunan, 0, ',', '.') }} m²</p>
                            <div class="h-2 bg-blue-100 rounded-full overflow-hidden">
                                <div class="h-full bg-blue-500 rounded-full" style="width: 100%"></div>
                            </div>
                        </div>
                        @endif

                        @if($pemanfaatan->nilai_sewa_tahunan)
                        <div class="bg-gradient-to-br from-amber-50 to-white rounded-xl p-6 border border-amber-100 transform hover:-translate-y-1 transition-transform duration-300">
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="text-sm font-medium text-gray-600">Nilai Sewa Tahunan</h4>
                                <div class="bg-amber-100 rounded-lg p-2">
                                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-2xl font-bold text-gray-900 mb-2">Rp {{ number_format($pemanfaatan->nilai_sewa_tahunan, 0, ',', '.') }}</p>
                            <p class="text-sm text-gray-600">Per tahun</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Masa Pemanfaatan -->
                <div class="mb-10" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="bg-purple-100 rounded-lg p-2">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900">Masa Pemanfaatan</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="bg-gradient-to-br from-purple-50 to-white rounded-xl p-6 border border-purple-100">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Tanggal Mulai</h4>
                            <p class="text-xl font-bold text-gray-900">{{ $pemanfaatan->tanggal_mulai->format('d F Y') }}</p>
                            <p class="text-sm text-gray-500 mt-1">Awal kontrak</p>
                        </div>

                        <div class="bg-gradient-to-br from-purple-50 to-white rounded-xl p-6 border border-purple-100">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Tanggal Berakhir</h4>
                            <p class="text-xl font-bold text-gray-900">{{ $pemanfaatan->tanggal_berakhir->format('d F Y') }}</p>
                            <p class="text-sm text-gray-500 mt-1">Akhir kontrak</p>
                        </div>

                        @if($pemanfaatan->masa_pemanfaatan_bulan)
                        <div class="bg-gradient-to-br from-indigo-50 to-white rounded-xl p-6 border border-indigo-100">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Durasi</h4>
                            <p class="text-xl font-bold text-gray-900">{{ $pemanfaatan->masa_pemanfaatan_bulan }} Bulan</p>
                            <p class="text-sm text-gray-500 mt-1">Masa pemanfaatan</p>
                        </div>
                        @endif

                        <div class="bg-gradient-to-br from-gray-50 to-white rounded-xl p-6 border border-gray-100">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Sisa Waktu</h4>
                            @if($pemanfaatan->tanggal_berakhir->isPast())
                            <p class="text-xl font-bold text-red-600">Telah Berakhir</p>
                            <p class="text-sm text-red-500 mt-1">{{ $pemanfaatan->tanggal_berakhir->diffForHumans() }}</p>
                            @else
                            <p class="text-xl font-bold text-gray-900">{{ $pemanfaatan->tanggal_berakhir->diffInDays(now()) }} Hari</p>
                            <p class="text-sm text-gray-500 mt-1">Tersisa hingga berakhir</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Keterangan -->
                @if($pemanfaatan->keterangan)
                <div class="mb-10" data-aos="fade-up" data-aos-delay="250">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="bg-gray-100 rounded-lg p-2">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900">Keterangan Tambahan</h3>
                    </div>
                    <div class="bg-gradient-to-br from-gray-50 to-white rounded-xl p-6 border border-gray-100">
                        <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $pemanfaatan->keterangan }}</p>
                    </div>
                </div>
                @endif

                <!-- File SK -->
                @if($pemanfaatan->getFileUrl())
                <div class="mb-10" data-aos="fade-up" data-aos-delay="300">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="bg-emerald-100 rounded-lg p-2">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900">Dokumen SK</h3>
                    </div>
                    <div class="bg-gradient-to-br from-emerald-50 to-white rounded-xl p-6 border border-emerald-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium text-gray-900">Surat Keputusan</p>
                                <p class="text-sm text-gray-600 mt-1">Dokumen resmi pemanfaatan BMN</p>
                            </div>
                            <a href="{{ $pemanfaatan->getFileUrl() }}" target="_blank"
                               class="inline-flex items-center gap-3 px-6 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition-all duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Download SK
                            </a>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Map Preview -->
                @if($pemanfaatan->latitude && $pemanfaatan->longitude)
                <div data-aos="fade-up" data-aos-delay="350">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="bg-red-100 rounded-lg p-2">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900">Lokasi di Peta</h3>
                    </div>
                    <div class="bg-gradient-to-br from-red-50 to-white rounded-xl overflow-hidden border border-red-100">
                        <div id="mapPreview" style="height: 400px;" class="rounded-lg"></div>
                        <div class="p-4 bg-white border-t border-red-100">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>Lokasi tepat objek pemanfaatan BMN</span>
                                </div>
                                <a href="{{ route('manajemen-bmn.pemanfaatan.peta') }}"
                                   class="text-sm text-red-600 hover:text-red-800 font-medium">
                                    Lihat di peta utama →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    @if($pemanfaatan->latitude && $pemanfaatan->longitude)
    @push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <style>
        #mapPreview {
            border-radius: 0.75rem;
            z-index: 1;
        }
        .leaflet-control-zoom a {
            border-radius: 0.5rem !important;
            margin: 2px !important;
        }
    </style>
    @endpush

    @push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const lat = {{ $pemanfaatan->latitude }};
            const lng = {{ $pemanfaatan->longitude }};

            // Initialize map
            const map = L.map('mapPreview').setView([lat, lng], 15);

            // Add tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 19,
            }).addTo(map);

            // Add geocoder control
            L.Control.geocoder({
                defaultMarkGeocode: false,
                placeholder: 'Cari lokasi...',
                errorMessage: 'Lokasi tidak ditemukan'
            })
            .on('markgeocode', function(e) {
                map.setView(e.geocode.center, 16);
            })
            .addTo(map);

            // Custom icon
            const customIcon = L.divIcon({
                className: 'custom-marker',
                html: `
                    <div style="position: relative;">
                        <div style="
                            width: 40px;
                            height: 40px;
                            background: linear-gradient(135deg, #10b981, #059669);
                            border-radius: 50% 50% 50% 0;
                            transform: rotate(-45deg);
                            position: absolute;
                            top: -20px;
                            left: -20px;
                        "></div>
                        <div style="
                            width: 30px;
                            height: 30px;
                            background: white;
                            border-radius: 50%;
                            position: absolute;
                            top: -15px;
                            left: -15px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            transform: rotate(45deg);
                        ">
                            <svg style="width: 16px; height: 16px; color: #10b981;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                    </div>
                `,
                iconSize: [40, 40],
                iconAnchor: [20, 40],
                popupAnchor: [0, -40]
            });

            // Add marker with custom icon
            const marker = L.marker([lat, lng], { icon: customIcon }).addTo(map);

            // Create popup content
            const popupContent = `
                <div style="min-width: 250px; padding: 10px;">
                    <div style="font-weight: 600; font-size: 16px; color: #111827; margin-bottom: 8px;">
                        {{ $pemanfaatan->nama_pihak_ketiga }}
                    </div>
                    <div style="font-size: 14px; color: #6b7280; margin-bottom: 12px;">
                        {{ $pemanfaatan->alamat_objek }}
                    </div>
                    <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                        <span style="background: #dbeafe; color: #1e40af; padding: 4px 8px; border-radius: 20px; font-size: 12px;">
                            {{ $pemanfaatan->jenis_pemanfaatan }}
                        </span>
                        <span style="background: #dcfce7; color: #166534; padding: 4px 8px; border-radius: 20px; font-size: 12px;">
                            {{ $pemanfaatan->status }}
                        </span>
                    </div>
                </div>
            `;

            marker.bindPopup(popupContent).openPopup();

            // Add scale control
            L.control.scale({ imperial: false }).addTo(map);

            // Fit bounds with padding
            map.fitBounds([[lat - 0.001, lng - 0.001], [lat + 0.001, lng + 0.001]], {
                padding: [50, 50]
            });
        });
    </script>
    @endpush
    @endif
</x-app-layout>
