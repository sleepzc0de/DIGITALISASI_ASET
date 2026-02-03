<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Detail Pemanfaatan BMN') }}
            </h2>
            <div class="flex gap-3">
                <a href="{{ route('manajemen-bmn.pemanfaatan.peta') }}" class="text-green-600 hover:text-green-800 font-medium">
                    📍 Lihat di Peta
                </a>
                <a href="{{ route('manajemen-bmn.pemanfaatan.index') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">
                    ← Kembali ke Daftar
                </a>
            </div>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Header Section -->
            <div class="bg-gradient-to-br from-green-500 to-green-600 p-8 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="px-3 py-1 text-sm font-semibold rounded-full bg-white bg-opacity-20 mb-3 inline-block">
                            {{ $pemanfaatan->jenis_pemanfaatan }}
                        </span>
                        <h1 class="text-3xl font-bold mb-2">{{ $pemanfaatan->nama_pihak_ketiga }}</h1>
                        <p class="text-green-100">{{ $pemanfaatan->nomor_sk }}</p>
                    </div>
                    <div>
                        <span class="px-4 py-2 text-sm font-semibold rounded-full {{ $pemanfaatan->getStatusBadgeClass() }}">
                            {{ $pemanfaatan->status }}
                        </span>
                        @if($pemanfaatan->isExpiringSoon())
                        <div class="mt-2">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-orange-400 text-orange-900">
                                ⚠️ Segera Berakhir
                            </span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Content Section -->
            <div class="p-8">
                <!-- Informasi Objek -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Objek Pemanfaatan</h3>
                    <div class="bg-blue-50 rounded-xl p-5 mb-4">
                        <h4 class="text-sm font-medium text-gray-600 mb-2">Alamat Objek</h4>
                        <p class="text-gray-900">{{ $pemanfaatan->alamat_objek }}</p>
                        @if($pemanfaatan->latitude && $pemanfaatan->longitude)
                        <p class="text-sm text-gray-500 mt-2">
                            📍 Koordinat: {{ $pemanfaatan->latitude }}, {{ $pemanfaatan->longitude }}
                        </p>
                        @endif
                    </div>

                    @if($pemanfaatan->deskripsi_objek)
                    <div class="bg-gray-50 rounded-xl p-5">
                        <h4 class="text-sm font-medium text-gray-600 mb-2">Deskripsi</h4>
                        <p class="text-gray-700 whitespace-pre-line">{{ $pemanfaatan->deskripsi_objek }}</p>
                    </div>
                    @endif
                </div>

                <!-- Luas dan Nilai -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Detail Luas & Nilai</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @if($pemanfaatan->luas_tanah)
                        <div class="bg-green-50 rounded-xl p-5 border-l-4 border-green-500">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Luas Tanah</h4>
                            <p class="text-2xl font-bold text-gray-900">{{ number_format($pemanfaatan->luas_tanah, 0, ',', '.') }} m²</p>
                        </div>
                        @endif

                        @if($pemanfaatan->luas_bangunan)
                        <div class="bg-blue-50 rounded-xl p-5 border-l-4 border-blue-500">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Luas Bangunan</h4>
                            <p class="text-2xl font-bold text-gray-900">{{ number_format($pemanfaatan->luas_bangunan, 0, ',', '.') }} m²</p>
                        </div>
                        @endif

                        @if($pemanfaatan->nilai_sewa_tahunan)
                        <div class="bg-yellow-50 rounded-xl p-5 border-l-4 border-yellow-500">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Nilai Sewa Tahunan</h4>
                            <p class="text-xl font-bold text-gray-900">Rp {{ number_format($pemanfaatan->nilai_sewa_tahunan, 0, ',', '.') }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Masa Pemanfaatan -->
                <div class="mb-8 border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Masa Pemanfaatan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-purple-50 rounded-xl p-5">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Tanggal Mulai</h4>
                            <p class="text-lg font-semibold text-gray-900">{{ $pemanfaatan->tanggal_mulai->format('d F Y') }}</p>
                        </div>
                        <div class="bg-purple-50 rounded-xl p-5">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Tanggal Berakhir</h4>
                            <p class="text-lg font-semibold text-gray-900">{{ $pemanfaatan->tanggal_berakhir->format('d F Y') }}</p>
                            @if($pemanfaatan->isExpiringSoon())
                            <p class="text-sm text-orange-600 mt-1">
                                ⚠️ Akan berakhir dalam {{ $pemanfaatan->tanggal_berakhir->diffInDays(now()) }} hari
                            </p>
                            @endif
                        </div>
                        @if($pemanfaatan->masa_pemanfaatan_bulan)
                        <div class="bg-indigo-50 rounded-xl p-5">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Masa Pemanfaatan</h4>
                            <p class="text-lg font-semibold text-gray-900">{{ $pemanfaatan->masa_pemanfaatan_bulan }} Bulan</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Keterangan -->
                @if($pemanfaatan->keterangan)
                <div class="mb-8 border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Keterangan</h3>
                    <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $pemanfaatan->keterangan }}</p>
                </div>
                @endif

                <!-- File SK -->
                @if($pemanfaatan->getFileUrl())
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Dokumen SK</h3>
                    <a href="{{ $pemanfaatan->getFileUrl() }}" target="_blank" class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Download SK
                    </a>
                </div>
                @endif

                <!-- Map Preview -->
                @if($pemanfaatan->latitude && $pemanfaatan->longitude)
                <div class="border-t border-gray-200 pt-6 mt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Lokasi di Peta</h3>
                    <div id="mapPreview" style="height: 300px;" class="rounded-xl overflow-hidden"></div>
                </div>
                @endif
            </div>
        </div>
    </div>

    @if($pemanfaatan->latitude && $pemanfaatan->longitude)
    @push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    @endpush

    @push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        const map = L.map('mapPreview').setView([{{ $pemanfaatan->latitude }}, {{ $pemanfaatan->longitude }}], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        const marker = L.marker([{{ $pemanfaatan->latitude }}, {{ $pemanfaatan->longitude }}]).addTo(map);
        marker.bindPopup("<b>{{ $pemanfaatan->nama_pihak_ketiga }}</b><br>{{ $pemanfaatan->alamat_objek }}").openPopup();
    </script>
    @endpush
    @endif
</x-app-layout>
