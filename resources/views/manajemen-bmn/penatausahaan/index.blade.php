<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-3xl text-gray-900 leading-tight">
                    {{ __('Penatausahaan BMN') }}
                </h2>
                <p class="text-gray-600 mt-2">Dashboard Manajemen dan Administrasi Barang Milik Negara</p>
            </div>
            <div class="flex items-center space-x-3">
                <button class="btn-secondary flex items-center">
                    <i class="fas fa-file-export mr-2"></i>
                    Ekspor
                </button>
                @if(auth()->user()->isAdmin())
                <button class="btn-primary flex items-center">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Aset
                </button>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Statistics Overview -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8" data-aos="fade-up">
            <div class="relative overflow-hidden bg-gradient-to-br from-blue-500 via-blue-600 to-indigo-700 rounded-2xl shadow-xl p-6 text-white transform transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-white/10 rounded-full blur-xl"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-medium uppercase tracking-wider mb-2">Total Aset</p>
                        <h3 class="text-4xl font-bold">{{ number_format($stats['total_aset']) }}</h3>
                        <p class="text-blue-100 text-sm mt-2">Unit</p>
                    </div>
                    <div class="bg-white/20 rounded-full p-3 backdrop-blur-sm">
                        <i class="fas fa-boxes text-2xl"></i>
                    </div>
                </div>
                <div class="relative mt-4 pt-4 border-t border-white/20">
                    <p class="text-blue-100 text-sm">📈 <span class="font-semibold">+12%</span> dari bulan lalu</p>
                </div>
            </div>

            <div class="relative overflow-hidden bg-gradient-to-br from-emerald-500 via-emerald-600 to-green-700 rounded-2xl shadow-xl p-6 text-white transform transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-white/10 rounded-full blur-xl"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <p class="text-emerald-100 text-sm font-medium uppercase tracking-wider mb-2">Total Nilai Buku</p>
                        <h3 class="text-3xl font-bold">Rp {{ number_format($stats['total_nilai_buku'] / 1000000000, 2) }}M</h3>
                        <p class="text-emerald-100 text-sm mt-2">Miliar Rupiah</p>
                    </div>
                    <div class="bg-white/20 rounded-full p-3 backdrop-blur-sm">
                        <i class="fas fa-coins text-2xl"></i>
                    </div>
                </div>
                <div class="relative mt-4 pt-4 border-t border-white/20">
                    <p class="text-emerald-100 text-sm">💰 <span class="font-semibold">+8.5%</span> pertumbuhan nilai</p>
                </div>
            </div>

            <div class="relative overflow-hidden bg-gradient-to-br from-purple-500 via-purple-600 to-violet-700 rounded-2xl shadow-xl p-6 text-white transform transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-white/10 rounded-full blur-xl"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm font-medium uppercase tracking-wider mb-2">Kondisi Baik</p>
                        <h3 class="text-4xl font-bold">{{ number_format($stats['kondisi_baik']) }}</h3>
                        <p class="text-purple-100 text-sm mt-2">
                            @if($stats['total_aset'] > 0)
                                {{ round(($stats['kondisi_baik']/$stats['total_aset'])*100, 1) }}% dari total
                            @else
                                0% dari total
                            @endif
                        </p>
                    </div>
                    <div class="bg-white/20 rounded-full p-3 backdrop-blur-sm">
                        <i class="fas fa-check-circle text-2xl"></i>
                    </div>
                </div>
                <div class="relative mt-4 pt-4 border-t border-white/20">
                    <p class="text-purple-100 text-sm">🔄 <span class="font-semibold">{{ $stats['kondisi_baik'] }} aset</span> siap pakai</p>
                </div>
            </div>

            <div class="relative overflow-hidden bg-gradient-to-br from-amber-500 via-amber-600 to-orange-700 rounded-2xl shadow-xl p-6 text-white transform transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-white/10 rounded-full blur-xl"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <p class="text-amber-100 text-sm font-medium uppercase tracking-wider mb-2">Perlu Perbaikan</p>
                        <h3 class="text-4xl font-bold">{{ number_format($stats['kondisi_rusak_ringan'] + $stats['kondisi_rusak_berat']) }}</h3>
                        <p class="text-amber-100 text-sm mt-2">Perlu penanganan</p>
                    </div>
                    <div class="bg-white/20 rounded-full p-3 backdrop-blur-sm">
                        <i class="fas fa-tools text-2xl"></i>
                    </div>
                </div>
                <div class="relative mt-4 pt-4 border-t border-white/20">
                    <p class="text-amber-100 text-sm">⚠️ <span class="font-semibold">{{ $stats['kondisi_rusak_berat'] }}</span> perlu penggantian</p>
                </div>
            </div>
        </div>

        <!-- Charts & Analytics Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8" data-aos="fade-up" data-aos-delay="100">
            <!-- Chart 1: Distribusi Aset per Kategori -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-soft p-6 chart-card">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Distribusi Aset per Kategori</h3>
                        <p class="text-sm text-gray-600">Berdasarkan jumlah unit</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button class="text-xs px-3 py-1 rounded-full bg-blue-100 text-blue-600 font-medium active-filter">
                            Unit
                        </button>
                        <button class="text-xs px-3 py-1 rounded-full bg-gray-100 text-gray-600 font-medium">
                            Nilai
                        </button>
                    </div>
                </div>
                <div class="h-80">
                    <canvas id="chartKategori"></canvas>
                </div>
            </div>

            <!-- Chart 2: Status Kondisi Aset -->
            <div class="bg-white rounded-2xl shadow-soft p-6 chart-card">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Status Kondisi</h3>
                        <p class="text-sm text-gray-600">Kondisi keseluruhan aset</p>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-gray-900">
                            @if($stats['total_aset'] > 0)
                                {{ round(($stats['kondisi_baik']/$stats['total_aset'])*100, 1) }}%
                            @else
                                0%
                            @endif
                        </p>
                        <p class="text-sm text-gray-600">Kondisi Baik</p>
                    </div>
                </div>
                <div class="h-64">
                    <canvas id="chartKondisi"></canvas>
                </div>
                <div class="grid grid-cols-3 gap-4 mt-4">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-green-600">{{ $stats['kondisi_baik'] }}</div>
                        <div class="text-sm text-gray-600">Baik</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-yellow-600">{{ $stats['kondisi_rusak_ringan'] }}</div>
                        <div class="text-sm text-gray-600">Rusak Ringan</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-red-600">{{ $stats['kondisi_rusak_berat'] }}</div>
                        <div class="text-sm text-gray-600">Rusak Berat</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Second Row Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8" data-aos="fade-up" data-aos-delay="150">
            <!-- Chart 3: Tren Nilai Aset -->
            <div class="bg-white rounded-2xl shadow-soft p-6 chart-card">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Tren Nilai Aset</h3>
                        <p class="text-sm text-gray-600">5 Tahun Terakhir</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-medium text-green-600">
                            <i class="fas fa-arrow-up mr-1"></i> 12.5%
                        </p>
                        <p class="text-xs text-gray-600">Pertumbuhan</p>
                    </div>
                </div>
                <div class="h-64">
                    <canvas id="chartTren"></canvas>
                </div>
            </div>

            <!-- Chart 4: Top 5 Aset Nilai Tertinggi -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-soft p-6 chart-card">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Top 5 Aset Nilai Tertinggi</h3>
                        <p class="text-sm text-gray-600">Berdasarkan nilai buku</p>
                    </div>
                    <button class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                        Lihat Semua →
                    </button>
                </div>
                <div class="space-y-4">
                    @php $counter = 1; @endphp
                    @foreach($chartData['top_assets']->take(5) as $index => $asset)
                    <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg transition-colors">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-lg bg-gradient-to-br {{
                                $asset->kategori == 'Tanah' ? 'from-green-500 to-emerald-600' :
                                ($asset->kategori == 'Gedung Bangunan' ? 'from-blue-500 to-cyan-600' :
                                ($asset->kategori == 'Rumah Negara' ? 'from-purple-500 to-violet-600' :
                                'from-gray-500 to-gray-600'))
                            }} flex items-center justify-center">
                                <span class="text-white font-bold">{{ $counter++ }}</span>
                            </div>
                            <div class="max-w-xs">
                                <h4 class="font-medium text-gray-900 truncate">{{ $asset->nama_barang }}</h4>
                                <p class="text-xs text-gray-500">{{ $asset->kategori }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-gray-900">Rp {{ number_format($asset->nilai_buku / 1000000000, 2) }}M</p>
                            <p class="text-xs text-gray-500">Nilai Buku</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Status Penggunaan Aset -->
        <div class="bg-white rounded-2xl shadow-soft p-6 mb-8 chart-card" data-aos="fade-up" data-aos-delay="200">
            <h3 class="text-lg font-bold text-gray-900 mb-6">Status Penggunaan Aset</h3>
            <div class="h-64">
                <canvas id="chartStatus"></canvas>
            </div>
        </div>

        <!-- Kategori Aset dengan Progress Bars -->
        <div class="bg-white rounded-2xl shadow-soft p-6 mb-8" data-aos="fade-up" data-aos-delay="100">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-gray-900">Distribusi Nilai Aset per Kategori</h3>
                <span class="text-sm text-gray-500">Berdasarkan Nilai Buku</span>
            </div>
            <div class="space-y-6">
                @php
                    $kategoriData = [
                        ['name' => 'Tanah', 'value' => $stats['nilai_tanah'], 'color' => 'from-green-500 to-emerald-600', 'icon' => 'fas fa-mountain', 'count' => 'Nilai'],
                        ['name' => 'Gedung & Bangunan', 'value' => $stats['nilai_gedung'], 'color' => 'from-blue-500 to-cyan-600', 'icon' => 'fas fa-building', 'count' => 'Nilai'],
                        ['name' => 'Rumah Negara', 'value' => $stats['rumah_negara'] * 1000000000, 'color' => 'from-purple-500 to-violet-600', 'icon' => 'fas fa-home', 'count' => $stats['rumah_negara'] . ' Unit'],
                        ['name' => 'Kendaraan Operasional', 'value' => $stats['kendaraan_operasional'] * 500000000, 'color' => 'from-orange-500 to-amber-600', 'icon' => 'fas fa-truck', 'count' => $stats['kendaraan_operasional'] . ' Unit'],
                        ['name' => 'Kendaraan Jabatan', 'value' => $stats['kendaraan_jabatan'] * 800000000, 'color' => 'from-red-500 to-rose-600', 'icon' => 'fas fa-car', 'count' => $stats['kendaraan_jabatan'] . ' Unit'],
                        ['name' => 'Kendaraan Fungsional', 'value' => $stats['kendaraan_fungsional'] * 600000000, 'color' => 'from-pink-500 to-rose-500', 'icon' => 'fas fa-shuttle-van', 'count' => $stats['kendaraan_fungsional'] . ' Unit'],
                    ];
                    $maxValue = max(array_column($kategoriData, 'value'));
                    $maxValue = $maxValue > 0 ? $maxValue : 1;
                @endphp

                @foreach($kategoriData as $item)
                    <div class="group hover:bg-gray-50 p-3 rounded-xl transition-all duration-300">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br {{ $item['color'] }} flex items-center justify-center">
                                    <i class="{{ $item['icon'] }} text-white"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">{{ $item['name'] }}</h4>
                                    <p class="text-sm text-gray-500">{{ $item['count'] }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-gray-900">Rp {{ number_format($item['value'] / 1000000000, 2) }}M</p>
                                <p class="text-sm text-gray-500">
                                    @if($stats['total_nilai_buku'] > 0)
                                        {{ round(($item['value']/$stats['total_nilai_buku'])*100, 1) }}%
                                    @else
                                        0%
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="h-2 rounded-full bg-gradient-to-r {{ $item['color'] }} transition-all duration-1000 ease-out progress-bar-animate"
                                 style="width: {{ ($item['value']/$maxValue)*100 }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Search & Filter dengan Tabs -->
        <div class="bg-white rounded-2xl shadow-soft p-6 mb-6" data-aos="fade-up" data-aos-delay="200">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 mb-6">
                <div class="flex space-x-1 bg-gray-100 p-1 rounded-xl">
                    <button class="px-4 py-2 rounded-lg font-medium text-gray-700 hover:bg-white hover:shadow-sm transition-all duration-200 active-tab">
                        Semua Aset
                    </button>
                    <button class="px-4 py-2 rounded-lg font-medium text-gray-700 hover:bg-white hover:shadow-sm transition-all duration-200">
                        Aktif
                    </button>
                    <button class="px-4 py-2 rounded-lg font-medium text-gray-700 hover:bg-white hover:shadow-sm transition-all duration-200">
                        Dalam Perawatan
                    </button>
                </div>

                <div class="flex items-center space-x-3">
                    <div class="relative">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="text"
                               placeholder="Cari aset..."
                               class="pl-10 pr-4 py-2.5 w-full lg:w-64 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all duration-200">
                    </div>
                    <button class="p-2.5 rounded-xl border border-gray-300 hover:bg-gray-50 transition-colors" title="Filter Lanjutan">
                        <i class="fas fa-sliders-h text-gray-600"></i>
                    </button>
                </div>
            </div>

            <form method="GET" action="{{ route('manajemen-bmn.penatausahaan.index') }}" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                    <select name="kategori" class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 py-2.5 px-4 outline-none transition-all duration-200">
                        <option value="">Semua Kategori</option>
                        <option value="Tanah" {{ request('kategori') == 'Tanah' ? 'selected' : '' }}>Tanah</option>
                        <option value="Gedung Bangunan" {{ request('kategori') == 'Gedung Bangunan' ? 'selected' : '' }}>Gedung Bangunan</option>
                        <option value="Rumah Negara" {{ request('kategori') == 'Rumah Negara' ? 'selected' : '' }}>Rumah Negara</option>
                        <option value="Kendaraan Dinas Operasional" {{ request('kategori') == 'Kendaraan Dinas Operasional' ? 'selected' : '' }}>Kendaraan Operasional</option>
                        <option value="Kendaraan Dinas Jabatan" {{ request('kategori') == 'Kendaraan Dinas Jabatan' ? 'selected' : '' }}>Kendaraan Jabatan</option>
                        <option value="Kendaraan Dinas Fungsional" {{ request('kategori') == 'Kendaraan Dinas Fungsional' ? 'selected' : '' }}>Kendaraan Fungsional</option>
                        <option value="Peralatan Kantor" {{ request('kategori') == 'Peralatan Kantor' ? 'selected' : '' }}>Peralatan Kantor</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kondisi</label>
                    <select name="kondisi" class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 py-2.5 px-4 outline-none transition-all duration-200">
                        <option value="">Semua Kondisi</option>
                        <option value="Baik" {{ request('kondisi') == 'Baik' ? 'selected' : '' }}>Baik</option>
                        <option value="Rusak Ringan" {{ request('kondisi') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                        <option value="Rusak Berat" {{ request('kondisi') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi</label>
                    <select class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 py-2.5 px-4 outline-none transition-all duration-200">
                        <option>Semua Lokasi</option>
                        <option>Gedung Utama</option>
                        <option>Kantor Cabang</option>
                        <option>Gudang</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-2.5 px-6 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                        Terapkan Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Table dengan Card Design -->
        <div class="bg-white rounded-2xl shadow-soft overflow-hidden" data-aos="fade-up" data-aos-delay="300">
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Daftar Aset BMN</h3>
                    <p class="text-sm text-gray-600">{{ $penatausahaans->total() }} aset ditemukan</p>
                </div>
                <div class="flex items-center space-x-3">
                    <select class="rounded-lg border-gray-300 text-sm py-1.5 px-3">
                        <option>10 per halaman</option>
                        <option>25 per halaman</option>
                        <option>50 per halaman</option>
                    </select>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <span>Kode Barang</span>
                                    <i class="fas fa-sort ml-2 text-gray-400"></i>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <span>Nama Barang</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Jumlah</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nilai Buku</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kondisi</th>
                            <th class="px-6 py-4 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($penatausahaans as $penatausahaan)
                        <tr class="hover:bg-gray-50 transition-all duration-200 group">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-gray-900">{{ $penatausahaan->kode_barang }}</div>
                                @if($penatausahaan->nup)
                                <div class="text-xs text-gray-500 mt-1">
                                    <i class="fas fa-hashtag mr-1"></i>NUP: {{ $penatausahaan->nup }}
                                </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="relative">
                                        <img src="{{ $penatausahaan->getFotoUrl() }}"
                                             alt="{{ $penatausahaan->nama_barang }}"
                                             class="w-12 h-12 rounded-lg object-cover shadow-sm">
                                        <div class="absolute -bottom-1 -right-1 w-5 h-5 rounded-full bg-blue-500 border-2 border-white flex items-center justify-center">
                                            <i class="fas fa-camera text-white text-xs"></i>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-semibold text-gray-900 group-hover:text-blue-600 transition-colors">
                                            {{ $penatausahaan->nama_barang }}
                                        </div>
                                        @if($penatausahaan->merk_type)
                                        <div class="text-xs text-gray-500 flex items-center mt-1">
                                            <i class="fas fa-tag mr-1"></i>{{ $penatausahaan->merk_type }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex flex-col space-y-1">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $penatausahaan->getKategoriBadgeClass() }} w-fit">
                                        {{ $penatausahaan->kategori }}
                                    </span>
                                    @if($penatausahaan->status_aset)
                                    <span class="text-xs text-gray-600 flex items-center">
                                        <i class="fas fa-circle text-xs mr-1 {{ $penatausahaan->status_aset == 'Digunakan' ? 'text-green-500' : 'text-gray-400' }}"></i>
                                        {{ $penatausahaan->status_aset }}
                                    </span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-gray-900">
                                    {{ number_format($penatausahaan->jumlah_unit) }} {{ $penatausahaan->satuan }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-gray-900">
                                    Rp {{ number_format($penatausahaan->nilai_buku, 0, ',', '.') }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    @if($penatausahaan->tanggal_perolehan)
                                    {{ $penatausahaan->tanggal_perolehan->format('M Y') }}
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="relative">
                                        <div class="w-8 h-8 rounded-full flex items-center justify-center {{ $penatausahaan->getKondisiBadgeClass() }}">
                                            @if($penatausahaan->kondisi == 'Baik')
                                            <i class="fas fa-check text-xs"></i>
                                            @elseif($penatausahaan->kondisi == 'Rusak Ringan')
                                            <i class="fas fa-exclamation text-xs"></i>
                                            @else
                                            <i class="fas fa-times text-xs"></i>
                                            @endif
                                        </div>
                                    </div>
                                    <span class="ml-2 text-sm font-medium {{
                                        $penatausahaan->kondisi == 'Baik' ? 'text-green-700' :
                                        ($penatausahaan->kondisi == 'Rusak Ringan' ? 'text-yellow-700' : 'text-red-700')
                                    }}">
                                        {{ $penatausahaan->kondisi }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('manajemen-bmn.penatausahaan.show', $penatausahaan) }}"
                                       class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors duration-200 group/item">
                                        <i class="fas fa-eye mr-1.5"></i>
                                        <span>Detail</span>
                                    </a>
                                    @if(auth()->user()->isAdmin())
                                    <button class="p-1.5 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mb-4">
                                        <i class="fas fa-inbox text-gray-400 text-2xl"></i>
                                    </div>
                                    <h4 class="text-lg font-semibold text-gray-700 mb-2">Tidak ada data</h4>
                                    <p class="text-gray-500">Tidak ada data penatausahaan BMN yang ditemukan</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="text-sm text-gray-700 mb-4 md:mb-0">
                        Menampilkan <span class="font-semibold">{{ $penatausahaans->firstItem() ?? 0 }}</span>
                        sampai <span class="font-semibold">{{ $penatausahaans->lastItem() ?? 0 }}</span>
                        dari <span class="font-semibold">{{ $penatausahaans->total() }}</span> aset
                    </div>
                    <div class="flex items-center space-x-2">
                        <!-- Simple Pagination -->
                        @if ($penatausahaans->hasPages())
                            <div class="flex items-center space-x-2">
                                {{-- Previous Page Link --}}
                                @if (!$penatausahaans->onFirstPage())
                                    <a href="{{ $penatausahaans->previousPageUrl() }}"
                                       class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                @endif

                                {{-- Pagination Elements --}}
                                @php
                                    $current = $penatausahaans->currentPage();
                                    $last = $penatausahaans->lastPage();
                                    $start = max($current - 1, 1);
                                    $end = min($current + 1, $last);
                                @endphp

                                @for ($i = $start; $i <= $end; $i++)
                                    @if ($i == $current)
                                        <span class="px-3 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg">
                                            {{ $i }}
                                        </span>
                                    @else
                                        <a href="{{ $penatausahaans->url($i) }}"
                                           class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                                            {{ $i }}
                                        </a>
                                    @endif
                                @endfor

                                {{-- Next Page Link --}}
                                @if ($penatausahaans->hasMorePages())
                                    <a href="{{ $penatausahaans->nextPageUrl() }}"
                                       class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Data dari controller
            const chartData = @json($chartData);
            const trendData = @json($trendData);

            // Chart 1: Distribusi Aset per Kategori (Doughnut)
            const ctxKategori = document.getElementById('chartKategori');
            if (ctxKategori && chartData.kategori.labels.length > 0) {
                new Chart(ctxKategori, {
                    type: 'doughnut',
                    data: {
                        labels: chartData.kategori.labels,
                        datasets: [{
                            data: chartData.kategori.data,
                            backgroundColor: chartData.kategori.colors,
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
                                        size: 12
                                    }
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        let label = context.label || '';
                                        if (label) {
                                            label += ': ';
                                        }
                                        if (context.parsed !== null) {
                                            label += context.parsed + ' unit';
                                        }
                                        return label;
                                    }
                                }
                            }
                        },
                        cutout: '65%'
                    }
                });
            } else {
                // Jika tidak ada data, tampilkan placeholder
                ctxKategori.parentElement.innerHTML = `
                    <div class="flex flex-col items-center justify-center h-full">
                        <div class="text-gray-400 mb-2">
                            <i class="fas fa-chart-pie text-4xl"></i>
                        </div>
                        <p class="text-gray-500">Tidak ada data untuk ditampilkan</p>
                    </div>
                `;
            }

            // Chart 2: Status Kondisi Aset (Pie)
            const ctxKondisi = document.getElementById('chartKondisi');
            if (ctxKondisi && chartData.kondisi.labels.length > 0) {
                new Chart(ctxKondisi, {
                    type: 'pie',
                    data: {
                        labels: chartData.kondisi.labels,
                        datasets: [{
                            data: chartData.kondisi.data,
                            backgroundColor: chartData.kondisi.colors,
                            borderWidth: 2,
                            borderColor: '#ffffff'
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
                                    font: {
                                        size: 12
                                    }
                                }
                            }
                        }
                    }
                });
            }

            // Chart 3: Tren Nilai Aset (Line)
            const ctxTren = document.getElementById('chartTren');
            if (ctxTren) {
                new Chart(ctxTren, {
                    type: 'line',
                    data: {
                        labels: trendData.years,
                        datasets: [{
                            label: 'Nilai Aset (Miliar Rupiah)',
                            data: trendData.trend_values,
                            borderColor: '#3B82F6',
                            backgroundColor: 'rgba(59, 130, 246, 0.1)',
                            borderWidth: 3,
                            fill: true,
                            tension: 0.4,
                            pointBackgroundColor: '#3B82F6',
                            pointBorderColor: '#ffffff',
                            pointBorderWidth: 2,
                            pointRadius: 6
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
                                        let label = context.dataset.label || '';
                                        if (label) {
                                            label += ': ';
                                        }
                                        if (context.parsed.y !== null) {
                                            label += 'Rp ' + (context.parsed.y / 1000000000).toFixed(2) + 'M';
                                        }
                                        return label;
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: false,
                                ticks: {
                                    callback: function(value) {
                                        return 'Rp ' + (value / 1000000000).toFixed(0) + 'M';
                                    }
                                },
                                grid: {
                                    drawBorder: false
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

            // Chart 4: Status Penggunaan Aset (Bar)
            const ctxStatus = document.getElementById('chartStatus');
            if (ctxStatus && chartData.status.labels.length > 0) {
                new Chart(ctxStatus, {
                    type: 'bar',
                    data: {
                        labels: chartData.status.labels,
                        datasets: [{
                            label: 'Jumlah Aset',
                            data: chartData.status.data,
                            backgroundColor: chartData.status.colors,
                            borderWidth: 0,
                            borderRadius: 8,
                            barPercentage: 0.6
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
                                grid: {
                                    drawBorder: false
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
                        }
                    }
                });
            }

            // Animasi untuk progress bars
            const progressBars = document.querySelectorAll('.progress-bar-animate');
            progressBars.forEach(bar => {
                const width = bar.style.width;
                bar.style.width = '0';
                setTimeout(() => {
                    bar.style.width = width;
                }, 500);
            });

            // Interaksi untuk filter buttons
            document.querySelectorAll('.active-filter').forEach(button => {
                button.addEventListener('click', function() {
                    document.querySelectorAll('.active-filter').forEach(btn => {
                        btn.classList.remove('bg-blue-100', 'text-blue-600');
                        btn.classList.add('bg-gray-100', 'text-gray-600');
                    });
                    this.classList.remove('bg-gray-100', 'text-gray-600');
                    this.classList.add('bg-blue-100', 'text-blue-600');
                });
            });

            // Hover effects untuk chart cards
            document.querySelectorAll('.chart-card').forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                    this.style.boxShadow = '0 20px 40px rgba(0, 0, 0, 0.1)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.05)';
                });
            });
        });

        // Download chart sebagai gambar
        function downloadChart(chartId, fileName) {
            const chart = Chart.getChart(chartId);
            if (chart) {
                const link = document.createElement('a');
                link.download = fileName + '.png';
                link.href = chart.toBase64Image();
                link.click();
            }
        }
    </script>

    <style>
        .active-tab {
            background: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .table-row-hover {
            transition: all 0.2s ease;
        }

        .table-row-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .shadow-soft {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .chart-container {
            position: relative;
            height: 300px;
        }

        .progress-bar-animate {
            transition: width 1.5s ease-in-out;
        }

        .chart-card {
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .chart-card:hover {
            border-color: #e5e7eb;
        }

        .active-filter {
            background-color: #dbeafe;
            color: #1d4ed8;
        }

        /* Responsive chart adjustments */
        @media (max-width: 768px) {
            .chart-mobile {
                height: 250px !important;
            }

            .chart-card {
                margin-bottom: 1rem;
            }
        }
    </style>
</x-app-layout>
