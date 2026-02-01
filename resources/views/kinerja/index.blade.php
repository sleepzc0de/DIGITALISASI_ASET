<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    {{ __('Kinerja BMN dan Pengadaan') }}
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Analisis performa dan monitoring kegiatan pengadaan aset
                </p>
            </div>
            <div class="flex items-center space-x-3">
                <button class="btn-secondary flex items-center">
                    <i class="fas fa-filter mr-2"></i>
                    Filter
                </button>
                <button class="btn-primary flex items-center">
                    <i class="fas fa-download mr-2"></i>
                    Ekspor
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8" data-aos="fade-up">
                <!-- Total Kegiatan -->
                <div class="card-gradient transform hover:-translate-y-1 transition-all duration-300 border-l-4 border-purple-500">
                    <div class="flex items-center justify-between mb-4">
                        <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center shadow-lg">
                            <i class="fas fa-tasks text-white text-xl"></i>
                        </div>
                        <div class="text-right">
                            @php
                                $selesaiPercentage = $totalKegiatan > 0 ? round(($kegiatanSelesai / $totalKegiatan) * 100, 1) : 0;
                                $trendClass = $selesaiPercentage >= 80 ? 'text-green-600' : ($selesaiPercentage >= 50 ? 'text-yellow-600' : 'text-red-600');
                            @endphp
                            <div class="text-sm font-medium {{ $trendClass }}">{{ $selesaiPercentage }}%</div>
                            <div class="text-xs text-gray-500">Selesai</div>
                        </div>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ $totalKegiatan }}</h3>
                    <p class="text-gray-600 text-sm">Total Kegiatan</p>
                    <div class="mt-4">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500">{{ $kegiatanSelesai }} selesai</span>
                            <span class="text-gray-500">{{ $totalKegiatan - $kegiatanSelesai }} berjalan</span>
                        </div>
                        <div class="mt-2 h-2 bg-gray-200 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-purple-500 to-purple-600 rounded-full" style="width: {{ $selesaiPercentage }}%"></div>
                        </div>
                    </div>
                </div>

                <!-- Kegiatan Selesai -->
                <div class="card-gradient transform hover:-translate-y-1 transition-all duration-300 border-l-4 border-emerald-500">
                    <div class="flex items-center justify-between mb-4">
                        <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center shadow-lg">
                            <i class="fas fa-check-circle text-white text-xl"></i>
                        </div>
                        <div class="text-right">
                            <div class="text-sm font-medium text-emerald-600">On Track</div>
                            <div class="text-xs text-gray-500">Status</div>
                        </div>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ $kegiatanSelesai }}</h3>
                    <p class="text-gray-600 text-sm">Kegiatan Selesai</p>
                    <div class="mt-4 flex items-center text-sm">
                        <div class="flex items-center text-emerald-600">
                            <i class="fas fa-trophy mr-2"></i>
                            <span>Pencapaian Optimal</span>
                        </div>
                    </div>
                </div>

                <!-- Rata-rata Realisasi -->
                <div class="card-gradient transform hover:-translate-y-1 transition-all duration-300 border-l-4 border-blue-500">
                    <div class="flex items-center justify-between mb-4">
                        <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-lg">
                            <i class="fas fa-chart-line text-white text-xl"></i>
                        </div>
                        <div class="text-right">
                            @php
                                $avgRealisasi = $realisasiData->avg('persentase') ?? 0;
                                $trendIcon = $avgRealisasi >= 90 ? 'fa-arrow-up' : ($avgRealisasi >= 70 ? 'fa-minus' : 'fa-arrow-down');
                                $trendColor = $avgRealisasi >= 90 ? 'text-green-600' : ($avgRealisasi >= 70 ? 'text-yellow-600' : 'text-red-600');
                            @endphp
                            <div class="text-sm font-medium {{ $trendColor }}">
                                <i class="fas {{ $trendIcon }} mr-1"></i>
                                {{ number_format($avgRealisasi, 1) }}%
                            </div>
                            <div class="text-xs text-gray-500">Rata-rata</div>
                        </div>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ number_format($avgRealisasi, 1) }}%</h3>
                    <p class="text-gray-600 text-sm">Realisasi Rata-rata</p>
                    <div class="mt-4">
                        <div class="flex items-center text-sm {{ $trendColor }}">
                            <i class="fas fa-chart-bar mr-2"></i>
                            <span>{{ $realisasiData->count() }} jenis kegiatan</span>
                        </div>
                    </div>
                </div>

                <!-- Efisiensi Anggaran -->
                <div class="card-gradient transform hover:-translate-y-1 transition-all duration-300 border-l-4 border-cyan-500">
                    <div class="flex items-center justify-between mb-4">
                        <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-cyan-500 to-cyan-600 flex items-center justify-center shadow-lg">
                            <i class="fas fa-money-bill-wave text-white text-xl"></i>
                        </div>
                        <div class="text-right">
                            @php
                                $totalAnggaran = $anggaranData->sum('total_anggaran');
                                $totalRealisasi = $anggaranData->sum('total_realisasi');
                                $efisiensi = $totalAnggaran > 0 ? round((($totalAnggaran - $totalRealisasi) / $totalAnggaran) * 100, 1) : 0;
                                $efColor = $efisiensi > 0 ? 'text-green-600' : 'text-red-600';
                            @endphp
                            <div class="text-sm font-medium {{ $efColor }}">{{ $efisiensi }}%</div>
                            <div class="text-xs text-gray-500">Efisiensi</div>
                        </div>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-1">Rp {{ number_format($totalAnggaran / 1000000000, 1) }}M</h3>
                    <p class="text-gray-600 text-sm">Total Anggaran</p>
                    <div class="mt-4">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500">Realisasi: Rp {{ number_format($totalRealisasi / 1000000000, 1) }}M</span>
                            <span class="{{ $efColor }} font-medium">{{ $efisiensi }}%</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Performance Charts -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8" data-aos="fade-up" data-aos-delay="100">
                <!-- Realisasi per Jenis Kegiatan -->
                <div class="card group hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Realisasi per Jenis Kegiatan</h3>
                            <p class="text-sm text-gray-500 mt-1">Persentase pencapaian target</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="h-10 w-10 rounded-lg bg-purple-50 flex items-center justify-center group-hover:bg-purple-100 transition-colors">
                                <i class="fas fa-chart-bar text-purple-600"></i>
                            </div>
                        </div>
                    </div>
                    <div class="relative h-72">
                        <canvas id="realisasiChart"></canvas>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-600">
                                Rata-rata realisasi: <span class="font-bold text-gray-900">{{ number_format($realisasiData->avg('persentase') ?? 0, 1) }}%</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 rounded-full bg-purple-500 mr-2"></div>
                                    <span class="text-xs text-gray-600">Pengadaan</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-3 h-3 rounded-full bg-pink-500 mr-2"></div>
                                    <span class="text-xs text-gray-600">Pemeliharaan</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status Kegiatan -->
                <div class="card group hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Status Kegiatan</h3>
                            <p class="text-sm text-gray-500 mt-1">Distribusi berdasarkan status</p>
                        </div>
                        <div class="h-10 w-10 rounded-lg bg-green-50 flex items-center justify-center group-hover:bg-green-100 transition-colors">
                            <i class="fas fa-chart-pie text-green-600"></i>
                        </div>
                    </div>
                    <div class="relative h-72">
                        <canvas id="statusChart"></canvas>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <div class="grid grid-cols-3 gap-4">
                            @foreach($statusData as $status)
                                @php
                                    $colors = [
                                        'Selesai' => ['bg' => 'bg-green-100', 'text' => 'text-green-800', 'icon' => 'fa-check-circle'],
                                        'Berjalan' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-800', 'icon' => 'fa-spinner'],
                                        'Tertunda' => ['bg' => 'bg-red-100', 'text' => 'text-red-800', 'icon' => 'fa-clock'],
                                    ];
                                    $config = $colors[$status->status] ?? ['bg' => 'bg-gray-100', 'text' => 'text-gray-800', 'icon' => 'fa-question'];
                                @endphp
                                <div class="text-center">
                                    <div class="text-xl font-bold">{{ $status->total }}</div>
                                    <div class="flex items-center justify-center mt-1">
                                        <i class="fas {{ $config['icon'] }} text-xs mr-1 {{ $config['text'] }}"></i>
                                        <span class="text-xs px-2 py-1 rounded-full {{ $config['bg'] }} {{ $config['text'] }}">{{ $status->status }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Budget & Trend Charts -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8" data-aos="fade-up" data-aos-delay="200">
                <!-- Anggaran vs Realisasi -->
                <div class="card group hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Anggaran vs Realisasi</h3>
                            <p class="text-sm text-gray-500 mt-1">Perbandingan dalam Miliar Rupiah</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center">
                                <div class="w-2 h-2 rounded-full bg-blue-600"></div>
                            </div>
                            <div class="h-8 w-8 rounded-full bg-green-100 flex items-center justify-center">
                                <div class="w-2 h-2 rounded-full bg-green-600"></div>
                            </div>
                        </div>
                    </div>
                    <div class="relative h-72">
                        <canvas id="anggaranChart"></canvas>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <div class="flex items-center justify-between">
                            <div class="text-sm">
                                <span class="text-gray-600">Total:</span>
                                <span class="font-bold text-gray-900 ml-2">Rp {{ number_format($totalAnggaran / 1000000000, 1) }}M</span>
                            </div>
                            <div class="text-sm">
                                <span class="text-green-600">Realisasi: {{ $totalAnggaran > 0 ? round(($totalRealisasi / $totalAnggaran) * 100, 1) : 0 }}%</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Trend Kegiatan Bulanan -->
                <div class="card group hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Trend Kegiatan {{ date('Y') }}</h3>
                            <p class="text-sm text-gray-500 mt-1">Perkembangan bulanan</p>
                        </div>
                        <div class="h-10 w-10 rounded-lg bg-indigo-50 flex items-center justify-center group-hover:bg-indigo-100 transition-colors">
                            <i class="fas fa-chart-line text-indigo-600"></i>
                        </div>
                    </div>
                    <div class="relative h-72">
                        <canvas id="trendBulananChart"></canvas>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <div class="flex items-center justify-between">
                            <div class="text-sm">
                                @php
                                    $currentMonth = date('n');
                                    $currentMonthData = $trendBulanan->where('bulan', $currentMonth)->first();
                                    $prevMonthData = $trendBulanan->where('bulan', $currentMonth - 1)->first();
                                    $growth = $prevMonthData && $prevMonthData->total > 0 ?
                                        round((($currentMonthData->total ?? 0) - $prevMonthData->total) / $prevMonthData->total * 100, 1) : 0;
                                @endphp
                                <span class="text-gray-600">Bulan ini:</span>
                                <span class="font-bold text-gray-900 ml-2">{{ $currentMonthData->total ?? 0 }} kegiatan</span>
                                <span class="ml-2 {{ $growth >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                    ({{ $growth >= 0 ? '+' : '' }}{{ $growth }}%)
                                </span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <button class="text-sm text-indigo-600 hover:text-indigo-800 flex items-center">
                                    <i class="fas fa-calendar-alt mr-1"></i>
                                    Tahun {{ date('Y') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Performance Summary Table -->
            <div class="card mb-8" data-aos="fade-up" data-aos-delay="300">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Ringkasan Kinerja</h3>
                        <p class="text-sm text-gray-500 mt-1">Detail performa per jenis kegiatan</p>
                    </div>
                    <button class="text-sm text-blue-600 hover:text-blue-800 flex items-center">
                        <i class="fas fa-eye mr-2"></i>
                        Lihat Detail
                    </button>
                </div>

                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jenis Kegiatan
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jumlah
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Realisasi
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Anggaran (M)
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($realisasiData as $item)
                                @php
                                    $anggaranItem = $anggaranData->where('jenis_kegiatan', $item->jenis_kegiatan)->first();
                                    $status = $item->persentase >= 90 ? 'Selesai' : ($item->persentase >= 70 ? 'Berjalan' : 'Tertunda');
                                    $statusColors = [
                                        'Selesai' => 'bg-green-100 text-green-800',
                                        'Berjalan' => 'bg-blue-100 text-blue-800',
                                        'Tertunda' => 'bg-red-100 text-red-800',
                                    ];
                                @endphp
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-8 w-8 rounded-lg bg-gray-100 flex items-center justify-center mr-3">
                                                <i class="fas fa-project-diagram text-gray-600"></i>
                                            </div>
                                            <span class="font-medium text-gray-900">{{ $item->jenis_kegiatan }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-gray-900">{{ $item->total ?? 0 }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-24 bg-gray-200 rounded-full h-2 mr-3">
                                                <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-2 rounded-full"
                                                     style="width: {{ $item->persentase }}%"></div>
                                            </div>
                                            <span class="text-gray-900 font-medium">{{ $item->persentase }}%</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-gray-900">Rp {{ number_format(($anggaranItem->total_anggaran ?? 0) / 1000000000, 1) }}M</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 text-xs rounded-full {{ $statusColors[$status] }}">
                                            {{ $status }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    <div class="flex items-center justify-between text-sm text-gray-600">
                        <div>
                            Menampilkan {{ $realisasiData->count() }} dari {{ $realisasiData->count() }} jenis kegiatan
                        </div>
                        <div class="flex items-center space-x-4">
                            <button class="flex items-center text-blue-600 hover:text-blue-800">
                                <i class="fas fa-file-export mr-2"></i>
                                Ekspor Data
                            </button>
                            <button class="flex items-center text-blue-600 hover:text-blue-800">
                                <i class="fas fa-print mr-2"></i>
                                Cetak Laporan
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6" data-aos="fade-up" data-aos-delay="400">
                <a href="{{ route('admin.kinerja-bmn.create') }}" class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-6">
                        <div class="h-12 w-12 rounded-xl bg-white/20 flex items-center justify-center">
                            <i class="fas fa-plus text-xl"></i>
                        </div>
                        <i class="fas fa-arrow-right text-lg opacity-75"></i>
                    </div>
                    <h4 class="text-xl font-bold mb-2">Tambah Data Kinerja</h4>
                    <p class="text-blue-100 text-sm">Input data kinerja dan pengadaan baru</p>
                </a>

                <a href="#" class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-6 text-white hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-6">
                        <div class="h-12 w-12 rounded-xl bg-white/20 flex items-center justify-center">
                            <i class="fas fa-chart-pie text-xl"></i>
                        </div>
                        <i class="fas fa-arrow-right text-lg opacity-75"></i>
                    </div>
                    <h4 class="text-xl font-bold mb-2">Analisis Mendalam</h4>
                    <p class="text-purple-100 text-sm">Analisis detail performa dengan berbagai parameter</p>
                </a>

                <a href="#" class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl p-6 text-white hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-6">
                        <div class="h-12 w-12 rounded-xl bg-white/20 flex items-center justify-center">
                            <i class="fas fa-file-alt text-xl"></i>
                        </div>
                        <i class="fas fa-arrow-right text-lg opacity-75"></i>
                    </div>
                    <h4 class="text-xl font-bold mb-2">Laporan Bulanan</h4>
                    <p class="text-emerald-100 text-sm">Generate laporan kinerja bulanan otomatis</p>
                </a>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Initialize AOS
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 800,
                once: true,
                offset: 100
            });
        }

        // Chart colors
        const chartColors = {
            blue: '#3B82F6',
            purple: '#8B5CF6',
            pink: '#EC4899',
            yellow: '#F59E0B',
            green: '#10B981',
            indigo: '#6366F1',
            red: '#EF4444',
            cyan: '#06B6D4',
            emerald: '#10B981'
        };

        // Realisasi Chart
        const realisasiCtx = document.getElementById('realisasiChart').getContext('2d');
        const realisasiChart = new Chart(realisasiCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($realisasiData->pluck('jenis_kegiatan')) !!},
                datasets: [{
                    label: 'Persentase Realisasi',
                    data: {!! json_encode($realisasiData->pluck('persentase')) !!},
                    backgroundColor: [
                        chartColors.purple,
                        chartColors.pink,
                        chartColors.yellow,
                        chartColors.blue,
                        chartColors.green,
                        chartColors.indigo
                    ],
                    borderRadius: 8,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        grid: {
                            drawBorder: false,
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            callback: function(value) {
                                return value + '%';
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.dataset.label}: ${context.parsed.y}%`;
                            }
                        }
                    }
                }
            }
        });

        // Status Chart
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        const statusChart = new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($statusData->pluck('status')) !!},
                datasets: [{
                    data: {!! json_encode($statusData->pluck('total')) !!},
                    backgroundColor: [chartColors.green, chartColors.blue, chartColors.red],
                    borderWidth: 2,
                    borderColor: '#FFFFFF',
                    hoverOffset: 15
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'right',
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
                                const value = context.raw || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = Math.round((value / total) * 100);
                                return `${label}: ${value} kegiatan (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });

        // Anggaran Chart
        const anggaranCtx = document.getElementById('anggaranChart').getContext('2d');
        const anggaranChart = new Chart(anggaranCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($anggaranData->pluck('jenis_kegiatan')) !!},
                datasets: [
                    {
                        label: 'Anggaran',
                        data: {!! json_encode($anggaranData->pluck('total_anggaran')->map(fn($v) => $v / 1000000000)) !!},
                        backgroundColor: chartColors.blue,
                        borderRadius: 8,
                        borderSkipped: false,
                    },
                    {
                        label: 'Realisasi',
                        data: {!! json_encode($anggaranData->pluck('total_realisasi')->map(fn($v) => $v / 1000000000)) !!},
                        backgroundColor: chartColors.green,
                        borderRadius: 8,
                        borderSkipped: false,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false,
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value + 'M';
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.dataset.label}: Rp ${context.parsed.y} Miliar`;
                            }
                        }
                    }
                }
            }
        });

        // Trend Bulanan Chart
        const trendBulananCtx = document.getElementById('trendBulananChart').getContext('2d');
        const bulanNames = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        const trendBulananChart = new Chart(trendBulananCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($trendBulanan->pluck('bulan')->map(fn($b) => $bulanNames[$b - 1] ?? $b)) !!},
                datasets: [{
                    label: 'Jumlah Kegiatan',
                    data: {!! json_encode($trendBulanan->pluck('total')) !!},
                    borderColor: chartColors.purple,
                    backgroundColor: 'rgba(139, 92, 246, 0.1)',
                    tension: 0.4,
                    fill: true,
                    borderWidth: 3,
                    pointBackgroundColor: chartColors.purple,
                    pointBorderColor: '#FFFFFF',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false,
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
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.dataset.label}: ${context.parsed.y} kegiatan`;
                            }
                        }
                    }
                }
            }
        });

        // Add resize listener for better responsiveness
        window.addEventListener('resize', function() {
            realisasiChart.resize();
            statusChart.resize();
            anggaranChart.resize();
            trendBulananChart.resize();
        });
    </script>
    @endpush
</x-app-layout>
