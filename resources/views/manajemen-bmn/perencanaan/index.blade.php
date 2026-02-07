<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-3xl text-gray-900 leading-tight">
                    {{ __('Perencanaan BMN') }}
                </h2>
                <p class="text-gray-600 mt-1">Kelola dokumen perencanaan BMN (RP4 & RKBMN)</p>
            </div>
            <div class="flex items-center space-x-3">
                <div class="relative group">
                    <button id="exportBtn" class="px-4 py-2.5 bg-white border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-all duration-300 flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span>Export</span>
                    </button>
                    <div class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-2xl border border-gray-200 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                        <a href="#" class="flex items-center px-4 py-3 hover:bg-blue-50 text-gray-700">
                            <svg class="w-4 h-4 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            PDF
                        </a>
                        <a href="#" class="flex items-center px-4 py-3 hover:bg-green-50 text-gray-700">
                            <svg class="w-4 h-4 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Excel
                        </a>
                    </div>
                </div>
                <button onclick="printPage()" class="px-4 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    <span>Print</span>
                </button>
            </div>
        </div>
    </x-slot>

    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-2xl shadow-soft p-6 border border-gray-100 hover:shadow-hover transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium mb-1">Total Dokumen</p>
                        <h3 class="text-3xl font-bold text-gray-900">{{ $stats['total'] }}</h3>
                        <p class="text-green-600 text-sm mt-1 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                            </svg>
                            {{ $stats['total'] > 0 ? '100%' : '0%' }}
                        </p>
                    </div>
                    <div class="h-14 w-14 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-lg shadow-blue-500/20">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-soft p-6 border border-gray-100 hover:shadow-hover transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium mb-1">Dokumen RP4</p>
                        <h3 class="text-3xl font-bold text-gray-900">{{ $stats['rp4'] }}</h3>
                        <p class="text-blue-600 text-sm mt-1 flex items-center">
                            <span class="w-2 h-2 bg-blue-500 rounded-full mr-1"></span>
                            @php
                                $percentage = $stats['total'] > 0 ? round(($stats['rp4']/$stats['total'])*100, 2) : 0;
                            @endphp
                            {{ $percentage }}% dari total
                        </p>
                    </div>
                    <div class="h-14 w-14 rounded-xl bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center shadow-lg shadow-green-500/20">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-soft p-6 border border-gray-100 hover:shadow-hover transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium mb-1">Dokumen RKBMN</p>
                        <h3 class="text-3xl font-bold text-gray-900">{{ $stats['rkbmn'] }}</h3>
                        <p class="text-purple-600 text-sm mt-1 flex items-center">
                            <span class="w-2 h-2 bg-purple-500 rounded-full mr-1"></span>
                            @php
                                $percentage = $stats['total'] > 0 ? round(($stats['rkbmn']/$stats['total'])*100, 2) : 0;
                            @endphp
                            {{ $percentage }}% dari total
                        </p>
                    </div>
                    <div class="h-14 w-14 rounded-xl bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center shadow-lg shadow-purple-500/20">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-soft p-6 border border-gray-100 hover:shadow-hover transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium mb-1">Total Nilai</p>
                        <h3 class="text-2xl font-bold text-gray-900">
                            @php
                                $totalInBillion = $stats['total_nilai'] / 1000000000;
                            @endphp
                            Rp {{ $stats['total_nilai'] > 0 ? number_format($totalInBillion, 2) : '0.00' }} M
                        </h3>
                        <p class="text-orange-600 text-sm mt-1">
                            @php
                                $totalInMillion = $stats['total_nilai'] / 1000000;
                            @endphp
                            {{ $stats['total_nilai'] > 0 ? number_format($totalInMillion, 0) : '0' }} juta
                        </p>
                    </div>
                    <div class="h-14 w-14 rounded-xl bg-gradient-to-br from-orange-500 to-orange-600 flex items-center justify-center shadow-lg shadow-orange-500/20">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Chart 1: Distribusi Jenis Dokumen -->
            <div class="bg-white rounded-2xl shadow-soft p-6 border border-gray-100 chart-container">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Distribusi Jenis Dokumen</h3>
                    <span class="text-sm text-gray-500">Total: {{ $stats['total'] }}</span>
                </div>
                <div class="h-64">
                    <canvas id="jenisChart"></canvas>
                </div>
                <div class="mt-4 grid grid-cols-2 gap-2">
                    <div class="flex items-center">
                        <div class="w-3 h-3 rounded-full bg-green-500 mr-2"></div>
                        <span class="text-sm text-gray-600">RP4: {{ $chartData['jenis']['data'][0] }} dokumen</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-3 h-3 rounded-full bg-purple-500 mr-2"></div>
                        <span class="text-sm text-gray-600">RKBMN: {{ $chartData['jenis']['data'][1] }} dokumen</span>
                    </div>
                </div>
            </div>

            <!-- Chart 2: Status Dokumen -->
            <div class="bg-white rounded-2xl shadow-soft p-6 border border-gray-100 chart-container">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Status Dokumen</h3>
                    <span class="text-sm text-gray-500">Ringkasan Status</span>
                </div>
                <div class="h-64">
                    <canvas id="statusChart"></canvas>
                </div>
                <div class="mt-4 flex flex-wrap gap-2">
                    @foreach($chartData['status']['labels'] as $index => $label)
                    <div class="flex items-center">
                        <div class="w-3 h-3 rounded-full mr-1" style="background-color: {{ $chartData['status']['colors'][$index] }}"></div>
                        <span class="text-xs text-gray-600">{{ $label }}: {{ $chartData['status']['data'][$index] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Chart 3: Trend Bulanan -->
            <div class="bg-white rounded-2xl shadow-soft p-6 border border-gray-100 chart-container">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Trend Perencanaan (6 Bulan)</h3>
                    <span class="text-sm text-gray-500">Jumlah Dokumen</span>
                </div>
                <div class="h-64">
                    <canvas id="trendChart"></canvas>
                </div>
                <div class="mt-4 text-center">
                    <span class="text-sm text-gray-500">
                        Total: {{ array_sum($chartData['trend']['data']) }} dokumen dalam 6 bulan terakhir
                    </span>
                </div>
            </div>

            <!-- Chart 4: Nilai per Kategori -->
            <div class="bg-white rounded-2xl shadow-soft p-6 border border-gray-100 chart-container">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Nilai Estimasi per Kategori</h3>
                    <span class="text-sm text-gray-500">Dalam Miliar Rupiah</span>
                </div>
                <div class="h-64">
                    <canvas id="kategoriChart"></canvas>
                </div>
                <div class="mt-4 grid grid-cols-2 gap-2">
                    @foreach($chartData['kategori']['labels'] as $index => $label)
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">{{ $label }}</span>
                        <span class="text-sm font-semibold text-gray-900">
                            Rp {{ number_format($chartData['kategori']['data'][$index], 2) }} M
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Chart 5: Perbandingan Tahun -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-soft p-6 border border-gray-100 chart-container">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Perbandingan Per Tahun</h3>
                    <span class="text-sm text-gray-500">RP4 vs RKBMN</span>
                </div>
                <div class="h-64">
                    <canvas id="tahunChart"></canvas>
                </div>
                <div class="mt-4 grid grid-cols-2 gap-4">
                    <div class="bg-gradient-to-r from-green-50 to-green-100 p-3 rounded-lg">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-green-800">Total RP4</span>
                            <span class="text-lg font-bold text-green-900">{{ $stats['rp4'] }} dokumen</span>
                        </div>
                    </div>
                    <div class="bg-gradient-to-r from-purple-50 to-purple-100 p-3 rounded-lg">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-purple-800">Total RKBMN</span>
                            <span class="text-lg font-bold text-purple-900">{{ $stats['rkbmn'] }} dokumen</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Advanced Filter Section -->
        <div class="bg-white rounded-2xl shadow-soft p-6 mb-6 border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Filter Lanjutan</h3>
                <button id="clearFilter" class="text-sm text-gray-500 hover:text-gray-700">
                    Reset Filter
                </button>
            </div>
            <form method="GET" action="{{ route('manajemen-bmn.perencanaan.index') }}" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                <div class="relative">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Dokumen</label>
                    <div class="relative">
                        <select name="jenis" class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300 appearance-none">
                            <option value="">Semua Jenis</option>
                            <option value="RP4" {{ request('jenis') == 'RP4' ? 'selected' : '' }}>RP4</option>
                            <option value="RKBMN" {{ request('jenis') == 'RKBMN' ? 'selected' : '' }}>RKBMN</option>
                        </select>
                        <div class="absolute left-3 top-3 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Anggaran</label>
                    <div class="relative">
                        <select name="tahun" class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300 appearance-none">
                            <option value="">Semua Tahun</option>
                            @for($i = date('Y') + 2; $i >= 2020; $i--)
                                <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                        <div class="absolute left-3 top-3 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <div class="relative">
                        <select name="status" class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300 appearance-none">
                            <option value="">Semua Status</option>
                            <option value="Draft" {{ request('status') == 'Draft' ? 'selected' : '' }}>Draft</option>
                            <option value="Diajukan" {{ request('status') == 'Diajukan' ? 'selected' : '' }}>Diajukan</option>
                            <option value="Disetujui" {{ request('status') == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                            <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                            <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                        <div class="absolute left-3 top-3 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                    <div class="relative">
                        <select name="kategori" class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300 appearance-none">
                            <option value="">Semua Kategori</option>
                            <option value="Penggunaan" {{ request('kategori') == 'Penggunaan' ? 'selected' : '' }}>Penggunaan</option>
                            <option value="Pemanfaatan" {{ request('kategori') == 'Pemanfaatan' ? 'selected' : '' }}>Pemanfaatan</option>
                            <option value="Pemindahtanganan" {{ request('kategori') == 'Pemindahtanganan' ? 'selected' : '' }}>Pemindahtanganan</option>
                            <option value="Penghapusan" {{ request('kategori') == 'Penghapusan' ? 'selected' : '' }}>Penghapusan</option>
                        </select>
                        <div class="absolute left-3 top-3 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="flex items-end space-x-3">
                    <button type="submit" class="flex-1 px-6 py-3.5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-medium rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 shadow-md hover:shadow-lg flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <span>Filter</span>
                    </button>
                    <button type="button" id="advancedFilterToggle" class="px-4 py-3.5 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                        </svg>
                    </button>
                </div>
            </form>

            <!-- Advanced Filter Content (Hidden by Default) -->
            <div id="advancedFilterContent" class="hidden mt-6 pt-6 border-t border-gray-200">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Range Tanggal</label>
                        <div class="grid grid-cols-2 gap-2">
                            <input type="date" name="start_date" value="{{ request('start_date') }}" class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:border-blue-500">
                            <input type="date" name="end_date" value="{{ request('end_date') }}" class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:border-blue-500">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Range Nilai</label>
                        <div class="grid grid-cols-2 gap-2">
                            <input type="number" placeholder="Min" name="min_nilai" value="{{ request('min_nilai') }}" class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:border-blue-500">
                            <input type="number" placeholder="Max" name="max_nilai" value="{{ request('max_nilai') }}" class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:border-blue-500">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pembuat</label>
                        <input type="text" placeholder="Nama pembuat" name="pembuat" value="{{ request('pembuat') }}" class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:border-blue-500">
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Terapkan Filter Lanjutan
                    </button>
                </div>
            </div>
        </div>

        <!-- Data Table -->
        <div class="bg-white rounded-2xl shadow-soft overflow-hidden border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">Daftar Perencanaan BMN</h3>
                <div class="text-sm text-gray-500">
                    @if($perencanaans->total() > 0)
                        Menampilkan {{ $perencanaans->firstItem() }}-{{ $perencanaans->lastItem() }} dari {{ $perencanaans->total() }} data
                    @else
                        Tidak ada data
                    @endif
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                <div class="flex items-center space-x-1">
                                    <span>No. Dokumen</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Judul & Deskripsi
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Jenis
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Tahun
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Nilai
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($perencanaans as $perencanaan)
                        <tr class="hover:bg-gray-50 transition-all duration-200 group">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-lg bg-gradient-to-br from-blue-100 to-blue-50 flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-medium text-gray-900">{{ $perencanaan->nomor_dokumen }}</div>
                                        <div class="text-sm text-gray-500">{{ $perencanaan->created_at->format('d/m/Y') }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="max-w-xs">
                                    <div class="font-medium text-gray-900 truncate">{{ $perencanaan->judul }}</div>
                                    <div class="text-sm text-gray-500 truncate">{{ Str::limit($perencanaan->deskripsi ?? '', 60) }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                    {{ $perencanaan->jenis_perencanaan == 'RP4' ? 'bg-green-100 text-green-800' : 'bg-purple-100 text-purple-800' }}">
                                    {{ $perencanaan->jenis_perencanaan }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-9 w-9 rounded-lg bg-gradient-to-br from-gray-100 to-gray-50 flex items-center justify-center mr-2">
                                        <span class="font-bold text-gray-700">{{ $perencanaan->tahun_anggaran }}</span>
                                    </div>
                                    <div class="text-sm text-gray-500">Anggaran</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-semibold text-gray-900">Rp {{ number_format($perencanaan->nilai_estimasi ?? 0, 0, ',', '.') }}</div>
                                @if($perencanaan->volume)
                                <div class="text-sm text-gray-500">{{ number_format($perencanaan->volume) }} {{ $perencanaan->satuan ?? '' }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="relative">
                                        <span class="px-3 py-1.5 inline-flex text-sm leading-5 font-semibold rounded-full
                                            {{ $perencanaan->getStatusBadgeClass() }} transition-all duration-300 hover:shadow-md">
                                            {{ $perencanaan->status }}
                                        </span>
                                        @if($perencanaan->status == 'Diajukan')
                                        <span class="absolute -top-1 -right-1 h-3 w-3 bg-yellow-500 rounded-full animate-pulse"></span>
                                        @elseif($perencanaan->status == 'Disetujui')
                                        <span class="absolute -top-1 -right-1 h-3 w-3 bg-green-500 rounded-full"></span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center space-x-3">
                                    <a href="{{ route('manajemen-bmn.perencanaan.show', $perencanaan) }}"
                                       class="inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-blue-50 to-blue-100 text-blue-700 rounded-lg hover:from-blue-100 hover:to-blue-200 transition-all duration-300">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        Lihat
                                    </a>
                                    @if($perencanaan->getFileUrl())
                                    <a href="{{ $perencanaan->getFileUrl() }}" target="_blank"
                                       class="inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-green-50 to-green-100 text-green-700 rounded-lg hover:from-green-100 hover:to-green-200 transition-all duration-300">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        File
                                    </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="h-24 w-24 rounded-full bg-gradient-to-br from-gray-100 to-gray-50 flex items-center justify-center mb-4">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada data ditemukan</h3>
                                    <p class="text-gray-500 mb-4">Tidak ada dokumen perencanaan BMN yang sesuai dengan filter Anda</p>
                                    <button onclick="window.location.href='{{ route('manajemen-bmn.perencanaan.index') }}'" class="px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg hover:from-blue-700 hover:to-indigo-700 transition-all duration-300">
                                        Reset Filter
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($perencanaans->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-500">
                        Halaman {{ $perencanaans->currentPage() }} dari {{ $perencanaans->lastPage() }}
                    </div>
                    <div class="flex items-center space-x-2">
                        {{ $perencanaans->links() }}
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Quick Actions -->
        <div class="mt-6 flex items-center justify-center space-x-4">
            <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
                    class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-all duration-300 flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                </svg>
                <span>Ke Atas</span>
            </button>
            <button onclick="refreshPage()"
                    class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-all duration-300 flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
                <span>Refresh</span>
            </button>
        </div>
    </div>

    @push('styles')
    <style>
        /* Animasi untuk chart */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .chart-container {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Custom scrollbar untuk chart container */
        .chart-container::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        .chart-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .chart-container::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }

        .chart-container::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Style khusus untuk print */
        @media print {
            .no-print {
                display: none !important;
            }
            .chart-container {
                break-inside: avoid;
            }
            canvas {
                max-height: 300px !important;
            }
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        // Inisialisasi Charts saat DOM siap
        document.addEventListener('DOMContentLoaded', function() {
            // Chart 1: Distribusi Jenis Dokumen (Pie Chart)
            const jenisCtx = document.getElementById('jenisChart');
            if (jenisCtx) {
                new Chart(jenisCtx, {
                    type: 'doughnut',
                    data: {
                        labels: @json($chartData['jenis']['labels']),
                        datasets: [{
                            data: @json($chartData['jenis']['data']),
                            backgroundColor: @json($chartData['jenis']['colors']),
                            borderWidth: 2,
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
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const label = context.label || '';
                                        const value = context.raw || 0;
                                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        const percentage = Math.round((value / total) * 100);
                                        return `${label}: ${value} dokumen (${percentage}%)`;
                                    }
                                }
                            }
                        },
                        cutout: '65%'
                    }
                });
            }

            // Chart 2: Status Dokumen (Bar Chart Horizontal)
            const statusCtx = document.getElementById('statusChart');
            if (statusCtx) {
                new Chart(statusCtx, {
                    type: 'bar',
                    data: {
                        labels: @json($chartData['status']['labels']),
                        datasets: [{
                            data: @json($chartData['status']['data']),
                            backgroundColor: @json($chartData['status']['colors']),
                            borderWidth: 0,
                            borderRadius: 6,
                            borderSkipped: false,
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            x: {
                                beginAtZero: true,
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    precision: 0
                                }
                            },
                            y: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            }

            // Chart 3: Trend Bulanan (Line Chart)
            const trendCtx = document.getElementById('trendChart');
            if (trendCtx) {
                new Chart(trendCtx, {
                    type: 'line',
                    data: {
                        labels: @json($chartData['trend']['labels']),
                        datasets: [{
                            label: 'Jumlah Dokumen',
                            data: @json($chartData['trend']['data']),
                            borderColor: @json($chartData['trend']['color']),
                            backgroundColor: 'rgba(59, 130, 246, 0.1)',
                            borderWidth: 3,
                            fill: true,
                            tension: 0.4,
                            pointBackgroundColor: '#ffffff',
                            pointBorderColor: @json($chartData['trend']['color']),
                            pointBorderWidth: 2,
                            pointRadius: 5,
                            pointHoverRadius: 7
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
                                mode: 'index',
                                intersect: false,
                                backgroundColor: 'rgba(0, 0, 0, 0.7)',
                                titleColor: '#ffffff',
                                bodyColor: '#ffffff',
                                borderColor: '#3B82F6',
                                borderWidth: 1
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.05)'
                                },
                                ticks: {
                                    precision: 0
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        },
                        interaction: {
                            intersect: false,
                            mode: 'nearest'
                        }
                    }
                });
            }

            // Chart 4: Nilai per Kategori (Horizontal Bar Chart)
            const kategoriCtx = document.getElementById('kategoriChart');
            if (kategoriCtx) {
                new Chart(kategoriCtx, {
                    type: 'bar',
                    data: {
                        labels: @json($chartData['kategori']['labels']),
                        datasets: [{
                            label: 'Nilai (Miliar Rp)',
                            data: @json($chartData['kategori']['data']),
                            backgroundColor: @json($chartData['kategori']['color']),
                            borderWidth: 0,
                            borderRadius: 6,
                            borderSkipped: false,
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const value = context.raw || 0;
                                        return `Rp ${value.toLocaleString('id-ID', {minimumFractionDigits: 2})} Miliar`;
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                beginAtZero: true,
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    callback: function(value) {
                                        return 'Rp ' + value.toLocaleString('id-ID', {minimumFractionDigits: 1}) + ' M';
                                    }
                                }
                            },
                            y: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            }

            // Chart 5: Perbandingan Tahun (Grouped Bar Chart)
            const tahunCtx = document.getElementById('tahunChart');
            if (tahunCtx) {
                new Chart(tahunCtx, {
                    type: 'bar',
                    data: {
                        labels: @json($chartData['tahun']['labels']),
                        datasets: [
                            {
                                label: 'RP4',
                                data: @json($chartData['tahun']['rp4']),
                                backgroundColor: @json($chartData['tahun']['colors'][0]),
                                borderWidth: 0,
                                borderRadius: 4,
                                borderSkipped: false,
                            },
                            {
                                label: 'RKBMN',
                                data: @json($chartData['tahun']['rkbmn']),
                                backgroundColor: @json($chartData['tahun']['colors'][1]),
                                borderWidth: 0,
                                borderRadius: 4,
                                borderSkipped: false,
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'top',
                                labels: {
                                    usePointStyle: true,
                                    padding: 20
                                }
                            }
                        },
                        scales: {
                            x: {
                                grid: {
                                    display: false
                                }
                            },
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.05)'
                                },
                                ticks: {
                                    precision: 0
                                }
                            }
                        },
                        interaction: {
                            intersect: false,
                            mode: 'index'
                        }
                    }
                });
            }

            // Animasi untuk chart container
            const chartContainers = document.querySelectorAll('.chart-container');
            chartContainers.forEach((container, index) => {
                container.style.opacity = '0';
                container.style.transform = 'translateY(20px)';

                setTimeout(() => {
                    container.style.transition = 'all 0.5s ease-out';
                    container.style.opacity = '1';
                    container.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });

        // Toggle advanced filter
        document.getElementById('advancedFilterToggle').addEventListener('click', function() {
            const content = document.getElementById('advancedFilterContent');
            content.classList.toggle('hidden');
            this.classList.toggle('bg-blue-100');
            this.classList.toggle('text-blue-700');

            // Toggle icon
            const icon = this.querySelector('svg');
            if (content.classList.contains('hidden')) {
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>';
            } else {
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>';
            }
        });

        // Clear filter
        document.getElementById('clearFilter').addEventListener('click', function() {
            window.location.href = "{{ route('manajemen-bmn.perencanaan.index') }}";
        });

        // Print page
        function printPage() {
            // Sembunyikan chart saat print
            const charts = document.querySelectorAll('canvas');
            charts.forEach(chart => chart.style.display = 'none');

            window.print();

            // Tampilkan kembali chart setelah print
            setTimeout(() => {
                charts.forEach(chart => chart.style.display = 'block');
            }, 100);
        }

        // Refresh page
        function refreshPage() {
            window.location.reload();
        }

        // Export functionality
        document.getElementById('exportBtn').addEventListener('click', function(e) {
            e.stopPropagation();
        });

        // Close export menu when clicking outside
        document.addEventListener('click', function() {
            const exportMenu = document.querySelector('.group .absolute');
            if (exportMenu) {
                exportMenu.classList.add('opacity-0', 'invisible');
            }
        });

        // Smooth scroll for table rows
        document.querySelectorAll('tbody tr').forEach(row => {
            row.addEventListener('click', function(e) {
                if (!e.target.closest('a') && !e.target.closest('button')) {
                    const link = this.querySelector('a[href*="show"]');
                    if (link) {
                        window.location = link.href;
                    }
                }
            });
        });

        // Add loading animation untuk table rows
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach((row, index) => {
                row.style.animationDelay = `${index * 0.05}s`;
                row.classList.add('animate-fade-in');
            });
        });

        // Submit advanced filter form
        document.querySelectorAll('#advancedFilterContent input, #advancedFilterContent select').forEach(element => {
            element.addEventListener('change', function() {
                // Add hidden inputs to main form
                const mainForm = document.querySelector('form[method="GET"]');
                const name = this.getAttribute('name');
                const value = this.value;

                // Remove existing hidden input with same name
                const existingInput = mainForm.querySelector(`input[name="${name}"]`);
                if (existingInput) {
                    existingInput.remove();
                }

                // Add new hidden input
                if (value) {
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = name;
                    hiddenInput.value = value;
                    mainForm.appendChild(hiddenInput);
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
