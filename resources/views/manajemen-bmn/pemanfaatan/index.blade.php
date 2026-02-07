<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h2 class="font-bold text-3xl text-gray-900 leading-tight">
                    {{ __('Pemanfaatan BMN') }}
                </h2>
                <p class="text-gray-600 mt-2">Manajemen dan monitoring pemanfaatan Barang Milik Negara</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <button id="exportCharts"
                    class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium py-2 px-4 rounded-lg shadow-sm hover:shadow transition-all duration-200 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Export Charts
                </button>
                <a href="{{ route('manajemen-bmn.pemanfaatan.peta') }}"
                    class="bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-600 hover:to-green-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                    </svg>
                    <span class="hidden sm:inline">Lihat Peta Persebaran</span>
                    <span class="sm:hidden">Peta</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8" data-aos="fade-up">
            <div
                class="bg-gradient-to-br from-blue-500 via-blue-600 to-blue-700 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-medium uppercase tracking-wider mb-2">Total Pemanfaatan</p>
                        <h3 class="text-4xl font-bold mt-2">{{ $stats['total'] }}</h3>
                        <p class="text-blue-100 text-sm mt-2">Data Terkini</p>
                    </div>
                    <div class="bg-white/20 backdrop-blur-sm rounded-full p-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-blue-400/30">
                    <div class="flex items-center text-blue-100 text-sm">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                        <span>{{ $stats['sk_sewa'] }} SK Sewa</span>
                    </div>
                </div>
            </div>

            <div
                class="bg-gradient-to-br from-emerald-500 via-emerald-600 to-emerald-700 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-emerald-100 text-sm font-medium uppercase tracking-wider mb-2">Status Aktif</p>
                        <h3 class="text-4xl font-bold mt-2">{{ $stats['aktif'] }}</h3>
                        <p class="text-emerald-100 text-sm mt-2">Dalam Masa Berlaku</p>
                    </div>
                    <div class="bg-white/20 backdrop-blur-sm rounded-full p-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-emerald-400/30">
                    <div class="flex items-center text-emerald-100 text-sm">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Berjalan dengan baik</span>
                    </div>
                </div>
            </div>

            <div
                class="bg-gradient-to-br from-purple-500 via-purple-600 to-purple-700 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm font-medium uppercase tracking-wider mb-2">SK Sewa</p>
                        <h3 class="text-4xl font-bold mt-2">{{ $stats['sk_sewa'] }}</h3>
                        <p class="text-purple-100 text-sm mt-2">Kontrak Aktif</p>
                    </div>
                    <div class="bg-white/20 backdrop-blur-sm rounded-full p-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-purple-400/30">
                    <div class="flex items-center text-purple-100 text-sm">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <span>Dokumen Terverifikasi</span>
                    </div>
                </div>
            </div>

            <div
                class="bg-gradient-to-br from-amber-500 via-amber-600 to-amber-700 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-amber-100 text-sm font-medium uppercase tracking-wider mb-2">Total Nilai Sewa</p>
                        <h3 class="text-3xl font-bold mt-2">Rp
                            {{ number_format($stats['total_nilai_sewa'] / 1000000, 1, ',', '.') }} Jt</h3>
                        <p class="text-amber-100 text-sm mt-2">Per Tahun</p>
                    </div>
                    <div class="bg-white/20 backdrop-blur-sm rounded-full p-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-amber-400/30">
                    <div class="flex items-center text-amber-100 text-sm">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        <span>Pendapatan Negara</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts & Graphs Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8" data-aos="fade-up" data-aos-delay="100">
            <!-- Chart 1: Distribusi Jenis Pemanfaatan -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Distribusi Jenis Pemanfaatan</h3>
                        <p class="text-sm text-gray-600">Perbandingan SK Sewa vs Izin Penghunian</p>
                    </div>
                    <div class="bg-blue-100 rounded-lg p-2">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                        </svg>
                    </div>
                </div>
                <div class="relative h-72">
                    <canvas id="jenisChart"></canvas>
                </div>
                <div class="mt-4 grid grid-cols-2 gap-4">
                    <div class="flex items-center gap-3 p-3 bg-emerald-50 rounded-lg">
                        <div class="w-3 h-3 bg-emerald-500 rounded-full"></div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">SK Sewa</p>
                            <p class="text-2xl font-bold text-emerald-600">{{ $chartData['jenis']['data'][0] ?? 0 }}
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 p-3 bg-blue-50 rounded-lg">
                        <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Izin Penghunian</p>
                            <p class="text-2xl font-bold text-blue-600">{{ $chartData['jenis']['data'][1] ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart 2: Distribusi Status -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Status Pemanfaatan</h3>
                        <p class="text-sm text-gray-600">Distribusi berdasarkan status aktifitas</p>
                    </div>
                    <div class="bg-purple-100 rounded-lg p-2">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                </div>
                <div class="relative h-72">
                    <canvas id="statusChart"></canvas>
                </div>
                <div class="mt-4 grid grid-cols-2 gap-3">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-emerald-500 rounded-full"></div>
                        <span class="text-xs text-gray-600">Aktif</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                        <span class="text-xs text-gray-600">Berakhir</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-amber-500 rounded-full"></div>
                        <span class="text-xs text-gray-600">Diperpanjang</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-gray-500 rounded-full"></div>
                        <span class="text-xs text-gray-600">Dibatalkan</span>
                    </div>
                </div>
            </div>

            <!-- Chart 3: Top 5 Nilai Sewa -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 lg:col-span-2">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Top 5 Nilai Sewa Tahunan</h3>
                        <p class="text-sm text-gray-600">Lima pemanfaatan dengan nilai sewa tertinggi</p>
                    </div>
                    <div class="bg-amber-100 rounded-lg p-2">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="relative h-80">
                    <canvas id="topSewaChart"></canvas>
                </div>
                <div class="mt-6 grid grid-cols-1 md:grid-cols-5 gap-4">
                    @if (isset($chartData['top_sewa']['full_labels']) && count($chartData['top_sewa']['full_labels']) > 0)
                        @foreach ($chartData['top_sewa']['full_labels'] as $index => $label)
                            <div
                                class="bg-gradient-to-br from-amber-50 to-white p-4 rounded-xl border border-amber-100">
                                <p class="text-xs font-medium text-gray-600 mb-1 truncate"
                                    title="{{ $label }}">{{ Str::limit($label, 20) }}</p>
                                <p class="text-lg font-bold text-gray-900">Rp
                                    {{ number_format(($chartData['top_sewa']['nilai_penuh'][$index] ?? 0) / 1000000, 1) }}
                                    Jt</p>
                                <div class="h-2 bg-amber-100 rounded-full mt-2 overflow-hidden">
                                    <div class="h-full bg-amber-500 rounded-full"
                                        style="width: {{ 100 - $index * 15 }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-span-5 text-center py-8 text-gray-500">
                            <svg class="w-12 h-12 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            <p>Data nilai sewa belum tersedia</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Trend Graph Section -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8 border border-gray-100" data-aos="fade-up"
            data-aos-delay="150">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6 mb-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Trend Pemanfaatan BMN</h3>
                    <p class="text-sm text-gray-600">Perkembangan data pemanfaatan dalam 6 bulan terakhir</p>
                </div>
                <div class="flex items-center gap-3">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                        <span class="text-sm text-gray-600">Jumlah Pemanfaatan</span>
                    </div>
                    <div class="text-sm text-gray-500">
                        @if (isset($graphData['months']) && count($graphData['months']) > 0)
                            Periode: {{ $graphData['months'][0] }} -
                            {{ $graphData['months'][count($graphData['months']) - 1] }}
                        @endif
                    </div>
                </div>
            </div>
            <div class="relative h-80">
                <canvas id="trendChart"></canvas>
            </div>
            <div class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-gradient-to-br from-blue-50 to-white p-4 rounded-xl border border-blue-100">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium text-gray-600">Total 6 Bulan</span>
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <p class="text-2xl font-bold text-gray-900">
                        {{ isset($graphData['monthly_data']) ? array_sum($graphData['monthly_data']) : 0 }}</p>
                    <p class="text-xs text-gray-500 mt-1">Total pemanfaatan</p>
                </div>
                <div class="bg-gradient-to-br from-emerald-50 to-white p-4 rounded-xl border border-emerald-100">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium text-gray-600">Rata-rata/Bulan</span>
                        <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <p class="text-2xl font-bold text-gray-900">
                        @if (isset($graphData['monthly_data']))
                            {{ round(array_sum($graphData['monthly_data']) / max(1, count($graphData['monthly_data'])), 1) }}
                        @else
                            0
                        @endif
                    </p>
                    <p class="text-xs text-gray-500 mt-1">Rata-rata per bulan</p>
                </div>
                <div class="bg-gradient-to-br from-purple-50 to-white p-4 rounded-xl border border-purple-100">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium text-gray-600">Bulan Tertinggi</span>
                        <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                    </div>
                    <p class="text-2xl font-bold text-gray-900">
                        @if (isset($graphData['monthly_data']) && count($graphData['monthly_data']) > 0)
                            {{ max($graphData['monthly_data']) }}
                        @else
                            0
                        @endif
                    </p>
                    <p class="text-xs text-gray-500 mt-1">
                        @if (isset($graphData['months']) && isset($graphData['monthly_data']) && count($graphData['monthly_data']) > 0)
                            {{ $graphData['months'][array_search(max($graphData['monthly_data']), $graphData['monthly_data'])] ?? 'N/A' }}
                        @else
                            N/A
                        @endif
                    </p>
                </div>
                <div class="bg-gradient-to-br from-amber-50 to-white p-4 rounded-xl border border-amber-100">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium text-gray-600">Nilai Sewa Aktif</span>
                        <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <p class="text-xl font-bold text-gray-900">
                        Rp
                        {{ isset($graphData['sewa_per_jenis']['SK Sewa']) ? number_format($graphData['sewa_per_jenis']['SK Sewa'] / 1000000000, 1) : '0' }}
                        M
                    </p>
                    <p class="text-xs text-gray-500 mt-1">Per tahun</p>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8 border border-gray-100" data-aos="fade-up"
            data-aos-delay="200">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Filter Data</h3>
                    <p class="text-sm text-gray-600">Saring data berdasarkan kriteria tertentu</p>
                </div>
                <div class="bg-blue-50 rounded-full p-2">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                </div>
            </div>
            <form method="GET" action="{{ route('manajemen-bmn.pemanfaatan.index') }}"
                class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Pemanfaatan</label>
                    <select name="jenis"
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-all duration-200 bg-white">
                        <option value="">Semua Jenis</option>
                        <option value="SK Sewa" {{ request('jenis') == 'SK Sewa' ? 'selected' : '' }}>SK Sewa</option>
                        <option value="Izin Penghunian" {{ request('jenis') == 'Izin Penghunian' ? 'selected' : '' }}>
                            Izin Penghunian</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status"
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-all duration-200 bg-white">
                        <option value="">Semua Status</option>
                        <option value="Aktif" {{ request('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Berakhir" {{ request('status') == 'Berakhir' ? 'selected' : '' }}>Berakhir
                        </option>
                        <option value="Diperpanjang" {{ request('status') == 'Diperpanjang' ? 'selected' : '' }}>
                            Diperpanjang</option>
                        <option value="Dibatalkan" {{ request('status') == 'Dibatalkan' ? 'selected' : '' }}>
                            Dibatalkan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Urutkan</label>
                    <select name="sort"
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-all duration-200 bg-white">
                        <option value="latest">Terbaru</option>
                        <option value="oldest">Terlama</option>
                        <option value="expiring">Segera Berakhir</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit"
                        class="w-full px-4 py-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition-all duration-300 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                        Terapkan Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100" data-aos="fade-up"
            data-aos-delay="250">
            <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Daftar Pemanfaatan BMN</h3>
                        <p class="text-sm text-gray-600 mt-1">Total {{ $pemanfaatans->total() }} data ditemukan</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-sm text-gray-600">Per halaman:</span>
                        <select class="text-sm border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500">
                            <option>10</option>
                            <option>25</option>
                            <option>50</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Nomor SK</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Pihak Ketiga</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Jenis</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Alamat</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Masa Berlaku</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Status</th>
                            <th
                                class="px-6 py-4 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($pemanfaatans as $pemanfaatan)
                            <tr class="hover:bg-blue-50/50 transition-colors duration-200 group">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div
                                            class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-sm font-semibold text-gray-900">
                                                {{ $pemanfaatan->nomor_sk }}</div>
                                            <div class="text-xs text-gray-500">No. Registrasi</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $pemanfaatan->nama_pihak_ketiga }}</div>
                                    <div class="text-xs text-gray-500">Mitra Kerja</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $pemanfaatan->jenis_pemanfaatan == 'SK Sewa' ? 'bg-emerald-100 text-emerald-800' : 'bg-blue-100 text-blue-800' }}">
                                        {{ $pemanfaatan->jenis_pemanfaatan }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">
                                        {{ Str::limit($pemanfaatan->alamat_objek, 30) }}</div>
                                    <div class="text-xs text-gray-500">Lokasi Objek</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $pemanfaatan->tanggal_mulai->format('d M Y') }}</div>
                                    <div class="text-xs text-gray-500">hingga
                                        {{ $pemanfaatan->tanggal_berakhir->format('d M Y') }}</div>
                                    @if ($pemanfaatan->isExpiringSoon())
                                        <span
                                            class="inline-flex items-center mt-1 px-2 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Segera berakhir
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $pemanfaatan->getStatusBadgeClass() }}">
                                        {{ $pemanfaatan->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('manajemen-bmn.pemanfaatan.show', $pemanfaatan) }}"
                                        class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-900 font-medium group-hover:translate-x-1 transition-transform duration-200">
                                        Lihat Detail
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="text-gray-400">
                                        <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                        <p class="text-lg font-medium text-gray-900">Tidak ada data pemanfaatan BMN</p>
                                        <p class="text-gray-600 mt-1">Data akan muncul setelah ditambahkan</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="text-sm text-gray-700">
                        Menampilkan <span class="font-medium">{{ $pemanfaatans->firstItem() ?? 0 }}</span>
                        sampai <span class="font-medium">{{ $pemanfaatans->lastItem() ?? 0 }}</span>
                        dari <span class="font-medium">{{ $pemanfaatans->total() }}</span> data
                    </div>
                    <div class="flex items-center space-x-2">
                        <!-- Previous Page Link -->
                        @if ($pemanfaatans->onFirstPage())
                            <span
                                class="px-3 py-1.5 text-sm font-medium text-gray-400 bg-white border border-gray-300 rounded-lg cursor-not-allowed">
                                &laquo; Sebelumnya
                            </span>
                        @else
                            <a href="{{ $pemanfaatans->previousPageUrl() }}"
                                class="px-3 py-1.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-900 transition-colors">
                                &laquo; Sebelumnya
                            </a>
                        @endif

                        <!-- Pagination Elements -->
                        @php
                            $current = $pemanfaatans->currentPage();
                            $last = $pemanfaatans->lastPage();
                            $start = max($current - 2, 1);
                            $end = min($current + 2, $last);
                        @endphp

                        @if ($start > 1)
                            <a href="{{ $pemanfaatans->url(1) }}"
                                class="px-3 py-1.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-900 transition-colors">
                                1
                            </a>
                            @if ($start > 2)
                                <span class="px-3 py-1.5 text-sm font-medium text-gray-400">...</span>
                            @endif
                        @endif

                        @for ($page = $start; $page <= $end; $page++)
                            @if ($page == $current)
                                <span
                                    class="px-3 py-1.5 text-sm font-medium text-white bg-blue-600 border border-blue-600 rounded-lg">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $pemanfaatans->url($page) }}"
                                    class="px-3 py-1.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-900 transition-colors">
                                    {{ $page }}
                                </a>
                            @endif
                        @endfor

                        @if ($end < $last)
                            @if ($end < $last - 1)
                                <span class="px-3 py-1.5 text-sm font-medium text-gray-400">...</span>
                            @endif
                            <a href="{{ $pemanfaatans->url($last) }}"
                                class="px-3 py-1.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-900 transition-colors">
                                {{ $last }}
                            </a>
                        @endif

                        <!-- Next Page Link -->
                        @if ($pemanfaatans->hasMorePages())
                            <a href="{{ $pemanfaatans->nextPageUrl() }}"
                                class="px-3 py-1.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-900 transition-colors">
                                Selanjutnya &raquo;
                            </a>
                        @else
                            <span
                                class="px-3 py-1.5 text-sm font-medium text-gray-400 bg-white border border-gray-300 rounded-lg cursor-not-allowed">
                                Selanjutnya &raquo;
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0/dist/chartjs-plugin-datalabels.min.css">
    @endpush

   @push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Helper function untuk validasi data
function safeChartData(data, fallback) {
    if (!data || !Array.isArray(data) || data.length === 0) {
        return fallback;
    }
    return data.map(item => item === null ? 0 : item);
}

// Helper function untuk validasi labels
function safeChartLabels(labels, fallback) {
    if (!labels || !Array.isArray(labels) || labels.length === 0) {
        return fallback;
    }
    return labels;
}

document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM Loaded - Initializing charts...');

    // 1. CHART JENIS PEMANFAATAN
    const jenisCanvas = document.getElementById('jenisChart');
    if (jenisCanvas) {
        console.log('Initializing jenisChart...');

        const jenisLabels = safeChartLabels(@json($chartData['jenis']['labels'] ?? []), ['SK Sewa', 'Izin Penghunian']);
        const jenisData = safeChartData(@json($chartData['jenis']['data'] ?? []), [0, 0]);
        const jenisColors = safeChartData(@json($chartData['jenis']['colors'] ?? []), ['#10b981', '#3b82f6']);

        // Pastikan ada data minimal
        if (jenisData.every(item => item === 0)) {
            jenisData[0] = 1; // Set minimal 1 untuk menghindari error
        }

        try {
            const jenisCtx = jenisCanvas.getContext('2d');
            new Chart(jenisCtx, {
                type: 'doughnut',
                data: {
                    labels: jenisLabels,
                    datasets: [{
                        data: jenisData,
                        backgroundColor: jenisColors,
                        borderWidth: 3,
                        borderColor: '#ffffff',
                        hoverOffset: 15
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 15,
                                usePointStyle: true,
                                font: {
                                    size: 12
                                }
                            }
                        }
                    },
                    cutout: '70%'
                }
            });
            console.log('jenisChart initialized successfully');
        } catch (error) {
            console.error('Error initializing jenisChart:', error);
            // Tampilkan fallback message
            jenisCanvas.parentElement.innerHTML = '<div class="text-center py-8 text-gray-500">Data chart tidak dapat ditampilkan</div>';
        }
    } else {
        console.warn('jenisChart canvas not found');
    }

    // 2. CHART STATUS PEMANFAATAN
    const statusCanvas = document.getElementById('statusChart');
    if (statusCanvas) {
        console.log('Initializing statusChart...');

        const statusLabels = safeChartLabels(@json($chartData['status']['labels'] ?? []), ['Aktif', 'Berakhir', 'Diperpanjang', 'Dibatalkan']);
        const statusData = safeChartData(@json($chartData['status']['data'] ?? []), [1, 0, 0, 0]);
        const statusColors = safeChartData(@json($chartData['status']['colors'] ?? []), ['#10b981', '#ef4444', '#f59e0b', '#6b7280']);

        try {
            const statusCtx = statusCanvas.getContext('2d');
            new Chart(statusCtx, {
                type: 'pie',
                data: {
                    labels: statusLabels,
                    datasets: [{
                        data: statusData,
                        backgroundColor: statusColors,
                        borderWidth: 3,
                        borderColor: '#ffffff',
                        hoverOffset: 15
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
            console.log('statusChart initialized successfully');
        } catch (error) {
            console.error('Error initializing statusChart:', error);
            statusCanvas.parentElement.innerHTML = '<div class="text-center py-8 text-gray-500">Data chart tidak dapat ditampilkan</div>';
        }
    }

    // 3. CHART TOP 5 NILAI SEWA
    const topSewaCanvas = document.getElementById('topSewaChart');
    if (topSewaCanvas) {
        console.log('Initializing topSewaChart...');

        const topLabels = safeChartLabels(@json($chartData['top_sewa']['labels'] ?? []), ['Data 1', 'Data 2', 'Data 3', 'Data 4', 'Data 5']);
        const topData = safeChartData(@json($chartData['top_sewa']['data'] ?? []), [0, 0, 0, 0, 0]);
        const fullLabels = safeChartLabels(@json($chartData['top_sewa']['full_labels'] ?? []), []);
        const nilaiPenuh = safeChartData(@json($chartData['top_sewa']['nilai_penuh'] ?? []), []);

        // Jika semua data 0, buat data dummy
        if (topData.every(item => item === 0)) {
            topLabels.length = 0;
            topData.length = 0;
            topLabels.push('Belum ada data');
            topData.push(1);
        }

        try {
            const topCtx = topSewaCanvas.getContext('2d');

            // Create gradient
            const gradient = topCtx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(59, 130, 246, 0.8)');
            gradient.addColorStop(1, 'rgba(59, 130, 246, 0.1)');

            new Chart(topCtx, {
                type: 'bar',
                data: {
                    labels: topLabels,
                    datasets: [{
                        label: 'Nilai Sewa (dalam juta)',
                        data: topData,
                        backgroundColor: gradient,
                        borderColor: '#3b82f6',
                        borderWidth: 2,
                        borderRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    if (fullLabels[context.dataIndex] && nilaiPenuh[context.dataIndex] > 0) {
                                        return [
                                            fullLabels[context.dataIndex],
                                            `Nilai: Rp ${formatRupiah(nilaiPenuh[context.dataIndex])}/tahun`
                                        ];
                                    }
                                    return `Nilai: Rp ${context.raw} juta`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + value + ' Jt';
                                }
                            }
                        }
                    }
                }
            });
            console.log('topSewaChart initialized successfully');
        } catch (error) {
            console.error('Error initializing topSewaChart:', error);
            topSewaCanvas.parentElement.innerHTML = '<div class="text-center py-8 text-gray-500">Data chart tidak dapat ditampilkan</div>';
        }
    }

    // 4. CHART TREND
    const trendCanvas = document.getElementById('trendChart');
    if (trendCanvas) {
        console.log('Initializing trendChart...');

        const trendLabels = safeChartLabels(@json($graphData['months'] ?? []), ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun']);
        const trendData = safeChartData(@json($graphData['monthly_data'] ?? []), [0, 0, 0, 0, 0, 0]);
        const trendColors = safeChartData(@json($graphData['monthly_colors'] ?? []), []);

        try {
            const trendCtx = trendCanvas.getContext('2d');

            // Create gradient untuk area chart
            const gradient = trendCtx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(59, 130, 246, 0.3)');
            gradient.addColorStop(1, 'rgba(59, 130, 246, 0.05)');

            new Chart(trendCtx, {
                type: 'line',
                data: {
                    labels: trendLabels,
                    datasets: [{
                        label: 'Jumlah Pemanfaatan',
                        data: trendData,
                        borderColor: '#3b82f6',
                        backgroundColor: gradient,
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#3b82f6',
                        pointBorderWidth: 3,
                        pointRadius: 5
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
            console.log('trendChart initialized successfully');
        } catch (error) {
            console.error('Error initializing trendChart:', error);
            trendCanvas.parentElement.innerHTML = '<div class="text-center py-8 text-gray-500">Data chart tidak dapat ditampilkan</div>';
        }
    }

    // Helper function untuk format Rupiah
    function formatRupiah(angka) {
        if (!angka || isNaN(angka)) return '0';
        return new Intl.NumberFormat('id-ID', {
            minimumFractionDigits: 0
        }).format(angka);
    }

    console.log('All charts initialized');
});
</script>
@endpush
</x-app-layout>
