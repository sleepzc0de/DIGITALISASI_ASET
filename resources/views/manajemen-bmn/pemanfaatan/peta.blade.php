<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h2 class="font-bold text-3xl text-gray-900 leading-tight">
                    {{ __('Peta Persebaran Pemanfaatan BMN') }}
                </h2>
                <p class="text-gray-600 mt-2">Visualisasi spasial lokasi pemanfaatan Barang Milik Negara</p>
            </div>
            <a href="{{ route('manajemen-bmn.pemanfaatan.index') }}"
               class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 font-medium px-4 py-2 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Daftar
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8" data-aos="fade-up">
            <div class="bg-gradient-to-br from-blue-50 to-white rounded-2xl shadow-lg p-6 border border-blue-100">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Lokasi</p>
                        <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $pemanfaatans->count() }}</h3>
                    </div>
                    <div class="bg-blue-100 rounded-lg p-3">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-sm text-gray-600">Lokasi terpetakan</p>
            </div>

            <div class="bg-gradient-to-br from-emerald-50 to-white rounded-2xl shadow-lg p-6 border border-emerald-100">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-sm font-medium text-gray-600">SK Sewa</p>
                        <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $pemanfaatans->where('jenis_pemanfaatan', 'SK Sewa')->count() }}</h3>
                    </div>
                    <div class="bg-emerald-100 rounded-lg p-3">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-sm text-gray-600">Kontrak sewa aktif</p>
            </div>

            <div class="bg-gradient-to-br from-amber-50 to-white rounded-2xl shadow-lg p-6 border border-amber-100">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Izin Penghunian</p>
                        <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $pemanfaatans->where('jenis_pemanfaatan', 'Izin Penghunian')->count() }}</h3>
                    </div>
                    <div class="bg-amber-100 rounded-lg p-3">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                </div>
                <p class="text-sm text-gray-600">Izin aktif</p>
            </div>

            <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl shadow-lg p-6 border border-purple-100">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Status Aktif</p>
                        <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $pemanfaatans->where('status', 'Aktif')->count() }}</h3>
                    </div>
                    <div class="bg-purple-100 rounded-lg p-3">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-sm text-gray-600">Dalam masa berlaku</p>
            </div>
        </div>

        <!-- Map Controls -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-6 border border-gray-100" data-aos="fade-up" data-aos-delay="100">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Kontrol Peta</h3>
                    <p class="text-gray-600">Navigasi dan filter data pada peta interaktif</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <button id="resetView" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Reset View
                    </button>
                    <button id="clusterToggle" class="px-4 py-2 bg-blue-100 hover:bg-blue-200 text-blue-700 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                        Cluster: <span id="clusterStatus">ON</span>
                    </button>
                    <div class="relative">
                        <select id="filterType" class="px-4 py-2 bg-white border border-gray-300 rounded-lg font-medium appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent pr-10">
                            <option value="all">Semua Jenis</option>
                            <option value="SK Sewa">SK Sewa</option>
                            <option value="Izin Penghunian">Izin Penghunian</option>
                        </select>
                        <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Map Container -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 mb-6" data-aos="fade-up" data-aos-delay="200">
            <div id="map" style="height: 600px;"></div>
            <div class="p-4 bg-gray-50 border-t border-gray-100">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Klik marker untuk melihat detail pemanfaatan BMN</span>
                    </div>
                    <div class="text-sm text-gray-500">
                        Zoom: <span id="zoomLevel">5</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Legend and Info -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2" data-aos="fade-up" data-aos-delay="300">
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Legenda Peta</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                            <div class="w-4 h-4 bg-green-500 rounded-full shadow-md"></div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">SK Sewa</p>
                                <p class="text-xs text-gray-500">Kontrak sewa</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                            <div class="w-4 h-4 bg-blue-500 rounded-full shadow-md"></div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Izin Penghunian</p>
                                <p class="text-xs text-gray-500">Izin penggunaan</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                            <div class="w-4 h-4 bg-amber-500 rounded-full shadow-md"></div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Segera Berakhir</p>
                                <p class="text-xs text-gray-500">&lt; 30 hari</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                            <div class="w-4 h-4 bg-red-500 rounded-full shadow-md"></div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Berakhir</p>
                                <p class="text-xs text-gray-500">Masa berlaku habis</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div data-aos="fade-up" data-aos-delay="350">
                <div class="bg-gradient-to-br from-blue-50 to-white rounded-2xl shadow-lg p-6 border border-blue-100">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="bg-blue-100 rounded-lg p-2">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Panduan</h3>
                    </div>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-2 text-sm text-gray-600">
                            <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Klik marker untuk detail informasi</span>
                        </li>
                        <li class="flex items-start gap-2 text-sm text-gray-600">
                            <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Scroll untuk zoom in/out</span>
                        </li>
                        <li class="flex items-start gap-2 text-sm text-gray-600">
                            <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Drag untuk berpindah area</span>
                        </li>
                        <li class="flex items-start gap-2 text-sm text-gray-600">
                            <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Gunakan filter untuk menyaring data</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <style>
        #map {
            border-radius: 0.75rem;
            z-index: 1;
        }
        .leaflet-control-zoom a {
            border-radius: 0.5rem !important;
            margin: 2px !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .leaflet-popup-content {
            margin: 13px 19px;
        }
        .custom-cluster {
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            border-radius: 50%;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            border: 3px solid white;
        }
        .leaflet-control-geocoder-form {
            border-radius: 0.5rem !important;
        }
        .leaflet-control-geocoder-form input {
            border-radius: 0.5rem !important;
        }
    </style>
    @endpush

    @push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize map centered on Indonesia
            const map = L.map('map').setView([-2.5489, 118.0149], 5);

            // Add tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 19,
            }).addTo(map);

            // Add geocoder control
            L.Control.geocoder({
                defaultMarkGeocode: false,
                placeholder: 'Cari lokasi...',
                errorMessage: 'Lokasi tidak ditemukan',
                position: 'topleft'
            })
            .on('markgeocode', function(e) {
                map.setView(e.geocode.center, 16);
            })
            .addTo(map);

            // Initialize marker cluster group
            const markers = L.markerClusterGroup({
                chunkedLoading: true,
                showCoverageOnHover: false,
                zoomToBoundsOnClick: true,
                spiderfyOnMaxZoom: true,
                maxClusterRadius: 50,
                iconCreateFunction: function(cluster) {
                    const count = cluster.getChildCount();
                    return L.divIcon({
                        html: `<div class="custom-cluster" style="width: ${40 + (count.toString().length * 5)}px; height: ${40 + (count.toString().length * 5)}px; line-height: ${40 + (count.toString().length * 5)}px;">${count}</div>`,
                        className: 'custom-cluster',
                        iconSize: L.point(40, 40)
                    });
                }
            });

            // Pemanfaatan data from Laravel
            const pemanfaatans = @json($pemanfaatans);
            let filteredMarkers = [];

            // Format currency function
            const formatRupiah = (angka) => {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(angka);
            };

            // Function to create custom icon
            function createCustomIcon(jenis, status, isExpiring) {
                let color = 'blue';
                if (jenis === 'SK Sewa') color = 'green';
                if (status === 'Berakhir') color = 'red';
                if (isExpiring) color = 'orange';

                return L.divIcon({
                    className: 'custom-marker',
                    html: `
                        <div style="position: relative;">
                            <div style="
                                width: 36px;
                                height: 36px;
                                background: linear-gradient(135deg, ${color === 'green' ? '#10b981' : color === 'blue' ? '#3b82f6' : color === 'orange' ? '#f59e0b' : '#ef4444'}, ${color === 'green' ? '#059669' : color === 'blue' ? '#2563eb' : color === 'orange' ? '#d97706' : '#dc2626'});
                                border-radius: 50% 50% 50% 0;
                                transform: rotate(-45deg);
                                position: absolute;
                                top: -18px;
                                left: -18px;
                                box-shadow: 0 4px 8px rgba(0,0,0,0.2);
                            "></div>
                            <div style="
                                width: 26px;
                                height: 26px;
                                background: white;
                                border-radius: 50%;
                                position: absolute;
                                top: -13px;
                                left: -13px;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                transform: rotate(45deg);
                                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                            ">
                                <svg style="width: 14px; height: 14px; color: ${color === 'green' ? '#10b981' : color === 'blue' ? '#3b82f6' : color === 'orange' ? '#f59e0b' : '#ef4444'};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                        </div>
                    `,
                    iconSize: [36, 36],
                    iconAnchor: [18, 36],
                    popupAnchor: [0, -36]
                });
            }

            // Add markers to map
            function addMarkers(data) {
                markers.clearLayers();
                filteredMarkers = [];

                data.forEach(pemanfaatan => {
                    if (pemanfaatan.latitude && pemanfaatan.longitude) {
                        const isExpiring = new Date(pemanfaatan.tanggal_berakhir) - new Date() < 30 * 24 * 60 * 60 * 1000;
                        const icon = createCustomIcon(pemanfaatan.jenis_pemanfaatan, pemanfaatan.status, isExpiring);

                        const marker = L.marker([pemanfaatan.latitude, pemanfaatan.longitude], { icon });

                        // Create popup content
                        const popupContent = `
                            <div style="min-width: 280px; max-width: 320px;">
                                <div style="padding: 16px;">
                                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                                        <div style="width: 48px; height: 48px; background: linear-gradient(135deg, ${pemanfaatan.jenis_pemanfaatan === 'SK Sewa' ? '#10b981' : '#3b82f6'}, ${pemanfaatan.jenis_pemanfaatan === 'SK Sewa' ? '#059669' : '#2563eb'}); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                            <svg style="width: 24px; height: 24px; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <div style="font-size: 18px; font-weight: 600; color: #111827; margin-bottom: 4px;">
                                                ${pemanfaatan.nama_pihak_ketiga}
                                            </div>
                                            <div style="font-size: 14px; color: #6b7280;">
                                                ${pemanfaatan.nomor_sk}
                                            </div>
                                        </div>
                                    </div>

                                    <div style="margin-bottom: 16px;">
                                        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                                            <svg style="width: 16px; height: 16px; color: #6b7280;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            <span style="font-size: 14px; color: #6b7280;">${pemanfaatan.alamat_objek.substring(0, 100)}${pemanfaatan.alamat_objek.length > 100 ? '...' : ''}</span>
                                        </div>

                                        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 12px;">
                                            <svg style="width: 16px; height: 16px; color: #6b7280;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            <span style="font-size: 14px; color: #6b7280;">
                                                ${new Date(pemanfaatan.tanggal_mulai).toLocaleDateString('id-ID')} - ${new Date(pemanfaatan.tanggal_berakhir).toLocaleDateString('id-ID')}
                                            </span>
                                        </div>
                                    </div>

                                    <div style="display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap;">
                                        <span style="background: ${pemanfaatan.jenis_pemanfaatan === 'SK Sewa' ? '#d1fae5' : '#dbeafe'}; color: ${pemanfaatan.jenis_pemanfaatan === 'SK Sewa' ? '#065f46' : '#1e40af'}; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 500;">
                                            ${pemanfaatan.jenis_pemanfaatan}
                                        </span>
                                        <span style="background: ${pemanfaatan.status === 'Aktif' ? '#d1fae5' : pemanfaatan.status === 'Berakhir' ? '#fee2e2' : pemanfaatan.status === 'Diperpanjang' ? '#dbeafe' : '#f3f4f6'}; color: ${pemanfaatan.status === 'Aktif' ? '#065f46' : pemanfaatan.status === 'Berakhir' ? '#991b1b' : pemanfaatan.status === 'Diperpanjang' ? '#1e40af' : '#374151'}; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 500;">
                                            ${pemanfaatan.status}
                                        </span>
                                    </div>

                                    <div style="border-top: 1px solid #e5e7eb; padding-top: 16px;">
                                        <a href="/manajemen-bmn/pemanfaatan/${pemanfaatan.id}" style="display: block; width: 100%; text-align: center; padding: 10px 16px; background: linear-gradient(135deg, #3b82f6, #8b5cf6); color: white; border-radius: 8px; text-decoration: none; font-weight: 500; transition: all 0.2s;">
                                            Lihat Detail Lengkap
                                        </a>
                                    </div>
                                </div>
                            </div>
                        `;

                        marker.bindPopup(popupContent);
                        markers.addLayer(marker);
                        filteredMarkers.push(marker);
                    }
                });

                map.addLayer(markers);
            }

            // Initial add all markers
            addMarkers(pemanfaatans);

            // Fit bounds if there are markers
            if (filteredMarkers.length > 0) {
                const group = L.featureGroup(filteredMarkers);
                map.fitBounds(group.getBounds().pad(0.1));
            }

            // Zoom level display
            map.on('zoomend', function() {
                document.getElementById('zoomLevel').textContent = map.getZoom();
            });

            // Control buttons
            document.getElementById('resetView').addEventListener('click', function() {
                if (filteredMarkers.length > 0) {
                    const group = L.featureGroup(filteredMarkers);
                    map.fitBounds(group.getBounds().pad(0.1));
                } else {
                    map.setView([-2.5489, 118.0149], 5);
                }
            });

            let clusterEnabled = true;
            document.getElementById('clusterToggle').addEventListener('click', function() {
                clusterEnabled = !clusterEnabled;
                if (clusterEnabled) {
                    map.addLayer(markers);
                    document.getElementById('clusterStatus').textContent = 'ON';
                    this.classList.remove('bg-gray-100', 'text-gray-700');
                    this.classList.add('bg-blue-100', 'text-blue-700');
                } else {
                    map.removeLayer(markers);
                    filteredMarkers.forEach(marker => {
                        map.addLayer(marker);
                    });
                    document.getElementById('clusterStatus').textContent = 'OFF';
                    this.classList.remove('bg-blue-100', 'text-blue-700');
                    this.classList.add('bg-gray-100', 'text-gray-700');
                }
            });

            // Filter functionality
            document.getElementById('filterType').addEventListener('change', function() {
                const filterValue = this.value;
                let filteredData;

                if (filterValue === 'all') {
                    filteredData = pemanfaatans;
                } else {
                    filteredData = pemanfaatans.filter(p => p.jenis_pemanfaatan === filterValue);
                }

                addMarkers(filteredData);
            });

            // Add scale control
            L.control.scale({ imperial: false }).addTo(map);

            // Add fullscreen control
            L.control.fullscreen({
                position: 'topleft',
                title: 'Tampilan Penuh',
                titleCancel: 'Keluar dari Tampilan Penuh',
                forceSeparateButton: true
            }).addTo(map);
        });
    </script>
    @endpush
</x-app-layout>
