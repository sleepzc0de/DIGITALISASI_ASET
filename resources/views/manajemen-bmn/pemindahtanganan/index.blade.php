<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
            <div>
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                    {{ __('Pemindahtanganan BMN - Laporan PNBP') }}
                </h2>
                <p class="text-gray-600 text-sm mt-1">Kelola laporan Pemindahtanganan Barang Milik Negara</p>
            </div>
            <div class="flex items-center space-x-2">
                <div class="relative" x-data="{ exportOpen: false }" @click.outside="exportOpen = false">
                    <button @click="exportOpen = !exportOpen"
                            class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 hover:border-gray-400 transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Ekspor
                    </button>
                    <div x-show="exportOpen" x-transition
                         class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-200 py-2 z-10">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Excel</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">PDF</a>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Statistics Cards with Animation -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10" data-aos="fade-up" data-aos-delay="100">
            <!-- Total Laporan -->
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-xl p-6 text-white transform hover:-translate-y-1 transition-transform duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-medium uppercase tracking-wide">Total Laporan</p>
                        <h3 class="text-3xl font-bold mt-2">{{ $stats['total'] }}</h3>
                        <p class="text-blue-100 text-xs mt-2">Laporan aktif</p>
                    </div>
                    <div class="bg-white/20 backdrop-blur-sm rounded-full p-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-blue-400/30">
                    <div class="flex justify-between text-sm">
                        <span class="text-blue-100">Pertumbuhan</span>
                        <span class="font-semibold">+12.5%</span>
                    </div>
                </div>
            </div>

            <!-- Total PNBP -->
            <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl shadow-xl p-6 text-white transform hover:-translate-y-1 transition-transform duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-emerald-100 text-sm font-medium uppercase tracking-wide">Total PNBP</p>
                        <h3 class="text-2xl font-bold mt-2">Rp {{ $stats['total_pnbp'] > 0 ? number_format($stats['total_pnbp'] / 1000000000, 2) : '0,00' }} M</h3>
                        <p class="text-emerald-100 text-xs mt-2">Miliar Rupiah</p>
                    </div>
                    <div class="bg-white/20 backdrop-blur-sm rounded-full p-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-emerald-400/30">
                    <div class="flex justify-between text-sm">
                        <span class="text-emerald-100">Target</span>
                        <span class="font-semibold">85%</span>
                    </div>
                </div>
            </div>

            <!-- Sudah Setor -->
            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-xl p-6 text-white transform hover:-translate-y-1 transition-transform duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm font-medium uppercase tracking-wide">Sudah Setor</p>
                        <h3 class="text-2xl font-bold mt-2">Rp {{ $stats['sudah_setor'] > 0 ? number_format($stats['sudah_setor'] / 1000000000, 2) : '0,00' }} M</h3>
                        <p class="text-purple-100 text-xs mt-2">Realiasi setoran</p>
                    </div>
                    <div class="bg-white/20 backdrop-blur-sm rounded-full p-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-purple-400/30">
                    <div class="flex justify-between text-sm">
                        <span class="text-purple-100">Waktu rata-rata</span>
                        <span class="font-semibold">14 hari</span>
                    </div>
                </div>
            </div>

            <!-- Belum Setor -->
            <div class="bg-gradient-to-br from-rose-500 to-rose-600 rounded-2xl shadow-xl p-6 text-white transform hover:-translate-y-1 transition-transform duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-rose-100 text-sm font-medium uppercase tracking-wide">Belum Setor</p>
                        <h3 class="text-2xl font-bold mt-2">Rp {{ $stats['belum_setor'] > 0 ? number_format($stats['belum_setor'] / 1000000000, 2) : '0,00' }} M</h3>
                        <p class="text-rose-100 text-xs mt-2">Perlu tindak lanjut</p>
                    </div>
                    <div class="bg-white/20 backdrop-blur-sm rounded-full p-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-rose-400/30">
                    <div class="flex justify-between text-sm">
                        <span class="text-rose-100">Tunggakan</span>
                        <span class="font-semibold">
                            @if($stats['total_pnbp'] > 0)
                                {{ number_format(($stats['belum_setor'] / $stats['total_pnbp']) * 100, 1) }}%
                            @else
                                0%
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8" data-aos="fade-up" data-aos-delay="150">
            <!-- Chart 1: Distribusi Jenis Pemindahtanganan -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Distribusi Jenis Pemindahtanganan</h3>
                    <span class="text-sm text-gray-500">Berdasarkan Jumlah</span>
                </div>
                <div class="h-64">
                    <canvas id="jenisChart"></canvas>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($jenisData as $jenis)
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">{{ $jenis->jenis_pemindahtanganan }}</span>
                            <span class="text-sm font-semibold text-gray-900">{{ $jenis->jumlah }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Chart 2: Distribusi Status PNBP -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Distribusi Status PNBP</h3>
                    <span class="text-sm text-gray-500">Berdasarkan Nilai</span>
                </div>
                <div class="h-64">
                    <canvas id="statusChart"></canvas>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <div class="space-y-3">
                        @foreach($statusData as $status)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                @php
                                    $badgeClass = match($status->status_pnbp) {
                                        'Belum Setor' => 'bg-red-100 text-red-800',
                                        'Sudah Setor' => 'bg-green-100 text-green-800',
                                        'Dibebaskan' => 'bg-blue-100 text-blue-800',
                                        default => 'bg-gray-100 text-gray-800',
                                    };
                                @endphp
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $badgeClass }}">
                                    {{ $status->status_pnbp }}
                                </span>
                            </div>
                            <span class="text-sm font-semibold text-gray-900">
                                Rp {{ number_format($status->total_pnbp, 0, ',', '.') }}
                            </span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Chart 3: Trend PNBP Per Bulan -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 lg:col-span-2">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Trend PNBP Per Bulan (12 Bulan Terakhir)</h3>
                    <span class="text-sm text-gray-500">Dalam Miliar Rupiah</span>
                </div>
                <div class="h-72">
                    <canvas id="monthlyChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Top 5 Aset dengan Nilai PNBP Tertinggi -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8 border border-gray-100" data-aos="fade-up" data-aos-delay="200">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Top 5 Aset dengan Nilai PNBP Tertinggi</h3>
                <span class="text-sm text-gray-500">Performa Terbaik</span>
            </div>
            <div class="space-y-4">
                @foreach($topAset as $index => $aset)
                <div class="flex items-center justify-between p-4 bg-gradient-to-r from-gray-50 to-white rounded-xl border border-gray-100 hover:border-indigo-200 transition-all duration-200">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <div class="h-10 w-10 rounded-lg bg-indigo-100 flex items-center justify-center">
                                <span class="text-indigo-600 font-bold">{{ $index + 1 }}</span>
                            </div>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">{{ $aset->nama_aset }}</h4>
                            <span class="inline-block mt-1 px-2 py-1 text-xs font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                {{ $aset->jenis_pemindahtanganan }}
                            </span>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-lg font-bold text-gray-900">Rp {{ number_format($aset->nilai_pnbp, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-500">Nilai PNBP</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Filter Section with Modern Design -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8 border border-gray-100" data-aos="fade-up" data-aos-delay="250">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Filter & Pencarian</h3>
                <a href="{{ route('manajemen-bmn.pemindahtanganan.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                    Reset Filter
                </a>
            </div>
            <form method="GET" action="{{ route('manajemen-bmn.pemindahtanganan.index') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Pemindahtanganan</label>
                        <select name="jenis" class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 transition-all duration-200">
                            <option value="">Semua Jenis</option>
                            <option value="Penjualan" {{ request('jenis') == 'Penjualan' ? 'selected' : '' }}>Penjualan</option>
                            <option value="Tukar Menukar" {{ request('jenis') == 'Tukar Menukar' ? 'selected' : '' }}>Tukar Menukar</option>
                            <option value="Hibah" {{ request('jenis') == 'Hibah' ? 'selected' : '' }}>Hibah</option>
                            <option value="Penyertaan Modal" {{ request('jenis') == 'Penyertaan Modal' ? 'selected' : '' }}>Penyertaan Modal</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status PNBP</label>
                        <select name="status_pnbp" class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 transition-all duration-200">
                            <option value="">Semua Status</option>
                            <option value="Belum Setor" {{ request('status_pnbp') == 'Belum Setor' ? 'selected' : '' }}>Belum Setor</option>
                            <option value="Sudah Setor" {{ request('status_pnbp') == 'Sudah Setor' ? 'selected' : '' }}>Sudah Setor</option>
                            <option value="Dibebaskan" {{ request('status_pnbp') == 'Dibebaskan' ? 'selected' : '' }}>Dibebaskan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tahun</label>
                        <select name="tahun" class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 transition-all duration-200">
                            <option value="">Semua Tahun</option>
                            @for($i = date('Y'); $i >= 2020; $i--)
                                <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="w-full px-4 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 font-medium shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                            <div class="flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                Terapkan Filter
                            </div>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100" data-aos="fade-up" data-aos-delay="300">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Daftar Laporan Pemindahtanganan</h3>
                        <p class="text-sm text-gray-600 mt-1">{{ $pemindahtanganans->total() }} data ditemukan</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <input type="text" placeholder="Cari laporan..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 w-64">
                            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                <div class="flex items-center space-x-1">
                                    <span>No. Laporan</span>
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
                                    </svg>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama Aset</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Jenis</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Penerima</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nilai PNBP</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status PNBP</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($pemindahtanganans as $pemindahtanganan)
                        <tr class="hover:bg-indigo-50/30 transition-all duration-200 group">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-gray-900">{{ $pemindahtanganan->nomor_laporan }}</div>
                                <div class="text-xs text-gray-500 mt-0.5">
                                    {{ $pemindahtanganan->tanggal_pemindahtanganan->format('d M Y') }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900 group-hover:text-indigo-700 transition-colors">
                                    {{ Str::limit($pemindahtanganan->nama_aset, 40) }}
                                </div>
                                @if($pemindahtanganan->deskripsi_aset)
                                <div class="text-xs text-gray-500 mt-1">
                                    {{ Str::limit($pemindahtanganan->deskripsi_aset, 50) }}
                                </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $jenisColors = [
                                        'Penjualan' => 'from-blue-500 to-blue-600',
                                        'Tukar Menukar' => 'from-emerald-500 to-emerald-600',
                                        'Hibah' => 'from-amber-500 to-amber-600',
                                        'Penyertaan Modal' => 'from-purple-500 to-purple-600'
                                    ];
                                    $color = $jenisColors[$pemindahtanganan->jenis_pemindahtanganan] ?? 'from-gray-500 to-gray-600';
                                @endphp
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-gradient-to-r {{ $color }} text-white shadow-sm">
                                    {{ $pemindahtanganan->jenis_pemindahtanganan }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $pemindahtanganan->penerima }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-gray-900">Rp {{ number_format($pemindahtanganan->nilai_pnbp, 0, ',', '.') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1.5 inline-flex text-xs leading-5 font-semibold rounded-full {{ $pemindahtanganan->getStatusPnbpBadgeClass() }} shadow-sm">
                                    @if($pemindahtanganan->status_pnbp == 'Sudah Setor')
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    @endif
                                    {{ $pemindahtanganan->status_pnbp }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('manajemen-bmn.pemindahtanganan.show', $pemindahtanganan) }}"
                                       class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-50 to-indigo-100 text-indigo-700 rounded-lg hover:from-indigo-100 hover:to-indigo-200 transition-all duration-200 text-sm font-medium shadow-sm hover:shadow">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        Detail
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center">
                                <div class="flex flex-col items-center justify-center py-8">
                                    <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada data pemindahtanganan</h3>
                                    <p class="text-gray-500">Mulai tambahkan laporan pemindahtanganan BMN</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200 bg-gradient-to-r from-gray-50 to-white">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-700">
                        Menampilkan <span class="font-semibold">{{ $pemindahtanganans->firstItem() }}</span>
                        sampai <span class="font-semibold">{{ $pemindahtanganans->lastItem() }}</span>
                        dari <span class="font-semibold">{{ $pemindahtanganans->total() }}</span> data
                    </div>
                    <div class="flex space-x-2">
                        {{ $pemindahtanganans->links() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8" data-aos="fade-up" data-aos-delay="350">
            <div class="bg-white rounded-2xl shadow p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 rounded-lg bg-blue-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h4 class="text-sm font-medium text-gray-900">Tahun Berjalan</h4>
                        <p class="text-2xl font-bold text-gray-900">{{ date('Y') }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 rounded-lg bg-emerald-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h4 class="text-sm font-medium text-gray-900">Rata-rata PNBP</h4>
                        <p class="text-2xl font-bold text-gray-900">
                            Rp {{ $stats['total'] > 0 ? number_format($stats['total_pnbp'] / $stats['total'], 0, ',', '.') : '0' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 rounded-lg bg-amber-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h4 class="text-sm font-medium text-gray-900">Update Terakhir</h4>
                        <p class="text-2xl font-bold text-gray-900">
                            @if($pemindahtanganans->count() > 0 && $pemindahtanganans->first()->updated_at)
                                {{ $pemindahtanganans->first()->updated_at->format('d M') }}
                            @else
                                -
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Data dari controller
            const jenisData = @json($jenisData);
            const statusData = @json($statusData);
            const bulanLabels = @json($bulanLabels);
            const bulanData = @json($bulanData);

            // Warna untuk chart
            const chartColors = [
                'rgba(59, 130, 246, 0.8)',   // Blue
                'rgba(16, 185, 129, 0.8)',   // Emerald
                'rgba(245, 158, 11, 0.8)',   // Amber
                'rgba(139, 92, 246, 0.8)',   // Purple
                'rgba(239, 68, 68, 0.8)',    // Red
                'rgba(99, 102, 241, 0.8)',   // Indigo
            ];

            // Chart 1: Distribusi Jenis Pemindahtanganan (Pie Chart)
            const jenisCtx = document.getElementById('jenisChart');
            if (jenisCtx) {
                new Chart(jenisCtx, {
                    type: 'pie',
                    data: {
                        labels: jenisData.map(item => item.jenis_pemindahtanganan),
                        datasets: [{
                            data: jenisData.map(item => item.jumlah),
                            backgroundColor: chartColors.slice(0, jenisData.length),
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
                                position: 'bottom',
                                labels: {
                                    padding: 20,
                                    usePointStyle: true,
                                    font: {
                                        size: 11
                                    }
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const label = context.label || '';
                                        const value = context.parsed;
                                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        const percentage = Math.round((value / total) * 100);
                                        return `${label}: ${value} laporan (${percentage}%)`;
                                    }
                                }
                            }
                        }
                    }
                });
            }

            // Chart 2: Distribusi Status PNBP (Doughnut Chart)
            const statusCtx = document.getElementById('statusChart');
            if (statusCtx) {
                new Chart(statusCtx, {
                    type: 'doughnut',
                    data: {
                        labels: statusData.map(item => item.status_pnbp),
                        datasets: [{
                            data: statusData.map(item => item.total_pnbp),
                            backgroundColor: [
                                'rgba(239, 68, 68, 0.8)',   // Belum Setor - merah
                                'rgba(16, 185, 129, 0.8)',  // Sudah Setor - hijau
                                'rgba(59, 130, 246, 0.8)',  // Dibebaskan - biru
                            ],
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
                                position: 'bottom',
                                labels: {
                                    padding: 20,
                                    usePointStyle: true,
                                    font: {
                                        size: 11
                                    }
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const label = context.label || '';
                                        const value = context.parsed;
                                        return `${label}: Rp ${value.toLocaleString('id-ID')}`;
                                    }
                                }
                            }
                        }
                    }
                });
            }

            // Chart 3: Trend PNBP Per Bulan (Line Chart)
            const monthlyCtx = document.getElementById('monthlyChart');
            if (monthlyCtx) {
                new Chart(monthlyCtx, {
                    type: 'line',
                    data: {
                        labels: bulanLabels,
                        datasets: [{
                            label: 'Total PNBP',
                            data: bulanData,
                            borderColor: 'rgba(59, 130, 246, 1)',
                            backgroundColor: 'rgba(59, 130, 246, 0.1)',
                            borderWidth: 3,
                            fill: true,
                            tension: 0.4,
                            pointBackgroundColor: 'rgba(59, 130, 246, 1)',
                            pointBorderColor: '#ffffff',
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
                                callbacks: {
                                    label: function(context) {
                                        return `PNBP: Rp ${context.parsed.y.toLocaleString('id-ID')}`;
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    drawBorder: false
                                },
                                ticks: {
                                    callback: function(value) {
                                        if (value >= 1000000000) {
                                            return 'Rp ' + (value / 1000000000).toFixed(1) + 'M';
                                        } else if (value >= 1000000) {
                                            return 'Rp ' + (value / 1000000).toFixed(1) + 'Jt';
                                        } else {
                                            return 'Rp ' + value.toLocaleString('id-ID');
                                        }
                                    }
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            }

            // Animasi untuk chart saat muncul
            AOS.refresh();
        });
    </script>
    @endpush

    <style>
        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .page-item .page-link {
            padding: 0.5rem 0.75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #4f46e5;
            background-color: #fff;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            transition: all 0.2s;
        }

        .page-item.active .page-link {
            z-index: 3;
            color: #fff;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            border-color: #4f46e5;
        }

        .page-item:not(.disabled) .page-link:hover {
            background-color: #f3f4f6;
            border-color: #d1d5db;
        }

        /* Chart container styling */
        canvas {
            max-width: 100%;
            height: auto !important;
        }
    </style>
</x-app-layout>
