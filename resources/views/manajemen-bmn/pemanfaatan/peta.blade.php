<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Peta Persebaran Pemanfaatan BMN') }}
            </h2>
            <a href="{{ route('manajemen-bmn.pemanfaatan.index') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">
                ← Kembali ke Daftar
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Info Card -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
            <div class="flex items-center gap-4">
                <div class="bg-blue-100 rounded-full p-3">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Total Lokasi Pemanfaatan: {{ $pemanfaatans->count() }}</h3>
                    <p class="text-sm text-gray-600">Klik marker untuk melihat detail pemanfaatan BMN</p>
                </div>
            </div>
        </div>

        <!-- Map Container -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div id="map" style="height: 600px;"></div>
        </div>

        <!-- Legend -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mt-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Legenda</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-green-500 rounded-full"></div>
                    <span class="text-sm text-gray-700">SK Sewa</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-blue-500 rounded-full"></div>
                    <span class="text-sm text-gray-700">Izin Penghunian</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-yellow-500 rounded-full"></div>
                    <span class="text-sm text-gray-700">Segera Berakhir</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-red-500 rounded-full"></div>
                    <span class="text-sm text-gray-700">Berakhir</span>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    @endpush

    @push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // Initialize map centered on Indonesia
        const map = L.map('map').setView([-2.5489, 118.0149], 5);

        // Add tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 19,
        }).addTo(map);

        // Pemanfaatan data
        const pemanfaatans = @json($pemanfaatans);

        // Add markers
        pemanfaatans.forEach(pemanfaatan => {
            if (pemanfaatan.latitude && pemanfaatan.longitude) {
                // Determine marker color based on status
                let markerColor = 'blue';
                if (pemanfaatan.jenis_pemanfaatan === 'SK Sewa') {
                    markerColor = 'green';
                }
                if (pemanfaatan.status === 'Berakhir') {
                    markerColor = 'red';
                } else if (new Date(pemanfaatan.tanggal_berakhir) - new Date() < 30 * 24 * 60 * 60 * 1000) {
                    markerColor = 'orange';
                }

                // Create custom icon
                const icon = L.divIcon({
                    className: 'custom-marker',
                    html: `<div style="background-color: ${markerColor}; width: 24px; height: 24px; border-radius: 50%; border: 2px solid white; box-shadow: 0 2px 4px rgba(0,0,0,0.3);"></div>`,
                    iconSize: [24, 24],
                    iconAnchor: [12, 12],
                });

                // Create marker
                const marker = L.marker([pemanfaatan.latitude, pemanfaatan.longitude], { icon }).addTo(map);

                // Format currency
                const formatRupiah = (angka) => {
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0
                    }).format(angka);
                };

                // Create popup content
                const popupContent = `
                    <div class="p-2" style="min-width: 250px;">
                        <h3 class="font-semibold text-lg mb-2">${pemanfaatan.nama_pihak_ketiga}</h3>
                        <div class="space-y-1 text-sm">
                            <p><strong>Jenis:</strong> <span class="px-2 py-1 rounded-full text-xs ${pemanfaatan.jenis_pemanfaatan === 'SK Sewa' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800'}">${pemanfaatan.jenis_pemanfaatan}</span></p>
                            <p><strong>No. SK:</strong> ${pemanfaatan.nomor_sk}</p>
                            <p><strong>Alamat:</strong> ${pemanfaatan.alamat_objek}</p>
                            ${pemanfaatan.luas_tanah ? `<p><strong>Luas Tanah:</strong> ${parseFloat(pemanfaatan.luas_tanah).toLocaleString('id-ID')} m²</p>` : ''}
                            ${pemanfaatan.nilai_sewa_tahunan ? `<p><strong>Nilai Sewa:</strong> ${formatRupiah(pemanfaatan.nilai_sewa_tahunan)}/tahun</p>` : ''}
                            <p><strong>Status:</strong> <span class="px-2 py-1 rounded-full text-xs
                                ${pemanfaatan.status === 'Aktif' ? 'bg-green-100 text-green-800' : ''}
                                ${pemanfaatan.status === 'Berakhir' ? 'bg-red-100 text-red-800' : ''}
                                ${pemanfaatan.status === 'Diperpanjang' ? 'bg-blue-100 text-blue-800' : ''}
                                ${pemanfaatan.status === 'Dibatalkan' ? 'bg-gray-100 text-gray-800' : ''}
                            ">${pemanfaatan.status}</span></p>
                            <p><strong>Berakhir:</strong> ${new Date(pemanfaatan.tanggal_berakhir).toLocaleDateString('id-ID')}</p>
                        </div>
                        <a href="/manajemen-bmn/pemanfaatan/${pemanfaatan.id}" class="mt-3 inline-block px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm">
                            Lihat Detail
                        </a>
                    </div>
                `;

                marker.bindPopup(popupContent, { maxWidth: 300 });
            }
        });

        // Fit bounds if there are markers
        if (pemanfaatans.length > 0) {
            const validMarkers = pemanfaatans.filter(p => p.latitude && p.longitude);
            if (validMarkers.length > 0) {
                const group = L.featureGroup(
                    validMarkers.map(p => L.marker([p.latitude, p.longitude]))
                );
                map.fitBounds(group.getBounds().pad(0.1));
            }
        }
    </script>
    @endpush
</x-app-layout>
