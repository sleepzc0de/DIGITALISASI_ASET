<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-900">
            {{ __('Dashboard Aset') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            Ringkasan dan analisis data aset BMN terbaru
        </p>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8" data-aos="fade-up">
                <!-- Total Aset Card -->
                <div class="card-gradient transform hover:-translate-y-1 transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-lg">
                            <i class="fas fa-boxes text-white text-xl"></i>
                        </div>
                        <span class="text-sm font-medium text-blue-600 px-3 py-1 rounded-full bg-blue-100">Aset</span>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ number_format($totalAset) }}</h3>
                    <p class="text-gray-600 text-sm">Total Unit Aset</p>
                    <div class="mt-4 flex items-center text-sm text-green-600">
                        <i class="fas fa-arrow-up mr-1"></i>
                        <span>5.2% dari bulan lalu</span>
                    </div>
                </div>

                <!-- Total Nilai Card -->
                <div class="card-gradient transform hover:-translate-y-1 transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center shadow-lg">
                            <i class="fas fa-money-bill-wave text-white text-xl"></i>
                        </div>
                        <span class="text-sm font-medium text-green-600 px-3 py-1 rounded-full bg-green-100">Nilai</span>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-1">Rp {{ number_format($totalNilai / 1000000000, 2) }}M</h3>
                    <p class="text-gray-600 text-sm">Total Nilai Aset</p>
                    <div class="mt-4 flex items-center text-sm text-green-600">
                        <i class="fas fa-arrow-up mr-1"></i>
                        <span>3.8% pertumbuhan</span>
                    </div>
                </div>

                <!-- Kategori Aktif Card -->
                <div class="card-gradient transform hover:-translate-y-1 transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center shadow-lg">
                            <i class="fas fa-layer-group text-white text-xl"></i>
                        </div>
                        <span class="text-sm font-medium text-purple-600 px-3 py-1 rounded-full bg-purple-100">Kategori</span>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ $kategoriData->count() }}</h3>
                    <p class="text-gray-600 text-sm">Jumlah Kategori</p>
                    <div class="mt-4">
                        <div class="flex items-center space-x-2">
                            @foreach($kategoriData->take(3) as $kategori)
                                <span class="text-xs px-2 py-1 bg-gray-100 rounded-full">{{ $kategori->kategori_aset }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Kondisi Baik Card -->
                <div class="card-gradient transform hover:-translate-y-1 transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-yellow-500 to-yellow-600 flex items-center justify-center shadow-lg">
                            <i class="fas fa-check-circle text-white text-xl"></i>
                        </div>
                        <span class="text-sm font-medium text-yellow-600 px-3 py-1 rounded-full bg-yellow-100">Kondisi</span>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-1">
                        @if($kondisiData->where('kondisi', 'Baik')->first())
                            {{ number_format($kondisiData->where('kondisi', 'Baik')->first()->total) }}
                        @else
                            0
                        @endif
                    </h3>
                    <p class="text-gray-600 text-sm">Aset dalam Kondisi Baik</p>
                    <div class="mt-4">
                        @php
                            $totalKondisi = $kondisiData->sum('total');
                            $baik = $kondisiData->where('kondisi', 'Baik')->first()->total ?? 0;
                            $percentage = $totalKondisi > 0 ? round(($baik / $totalKondisi) * 100) : 0;
                        @endphp
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-600">{{ $percentage }}% dari total</span>
                            <span class="font-medium text-green-600">✓ Optimal</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8" data-aos="fade-up" data-aos-delay="100">
                <!-- Distribusi Aset per Kategori -->
                <div class="card group hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Distribusi Aset per Kategori</h3>
                            <p class="text-sm text-gray-500 mt-1">Persebaran unit aset berdasarkan kategori</p>
                        </div>
                        <div class="h-10 w-10 rounded-lg bg-blue-50 flex items-center justify-center group-hover:bg-blue-100 transition-colors">
                            <i class="fas fa-chart-pie text-blue-600"></i>
                        </div>
                    </div>
                    <div class="relative h-80">
                        <canvas id="kategoriChart"></canvas>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-600">Total {{ number_format($totalAset) }} unit</span>
                            <a href="{{ route('admin.dashboard-aset.index') }}" class="text-blue-600 hover:text-blue-800 font-medium flex items-center">
                                Detail
                                <i class="fas fa-arrow-right ml-1 text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Kondisi Aset -->
                <div class="card group hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Kondisi Aset</h3>
                            <p class="text-sm text-gray-500 mt-1">Status kondisi seluruh aset BMN</p>
                        </div>
                        <div class="h-10 w-10 rounded-lg bg-green-50 flex items-center justify-center group-hover:bg-green-100 transition-colors">
                            <i class="fas fa-heartbeat text-green-600"></i>
                        </div>
                    </div>
                    <div class="relative h-80">
                        <canvas id="kondisiChart"></canvas>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <div class="grid grid-cols-3 gap-4">
                            @foreach($kondisiData as $kondisi)
                                @php
                                    $color = [
                                        'Baik' => 'bg-green-100 text-green-800',
                                        'Rusak Ringan' => 'bg-yellow-100 text-yellow-800',
                                        'Rusak Berat' => 'bg-red-100 text-red-800',
                                    ][$kondisi->kondisi] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <div class="text-center">
                                    <div class="text-xl font-bold">{{ number_format($kondisi->total) }}</div>
                                    <span class="text-xs px-2 py-1 rounded-full {{ $color }}">{{ $kondisi->kondisi }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Secondary Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6" data-aos="fade-up" data-aos-delay="200">
                <!-- Nilai Aset per Kategori -->
                <div class="card group hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Nilai Aset per Kategori</h3>
                            <p class="text-sm text-gray-500 mt-1">Dalam satuan Miliar Rupiah</p>
                        </div>
                        <div class="h-10 w-10 rounded-lg bg-purple-50 flex items-center justify-center group-hover:bg-purple-100 transition-colors">
                            <i class="fas fa-chart-bar text-purple-600"></i>
                        </div>
                    </div>
                    <div class="relative h-72">
                        <canvas id="nilaiChart"></canvas>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <div class="flex items-center justify-between">
                            <div class="text-sm">
                                <span class="text-gray-600">Total Nilai:</span>
                                <span class="font-bold text-gray-900 ml-2">Rp {{ number_format($totalNilai / 1000000000, 2) }}M</span>
                            </div>
                            <button onclick="toggleChartType('nilaiChart')" class="text-sm text-blue-600 hover:text-blue-800 flex items-center">
                                <i class="fas fa-exchange-alt mr-1"></i>
                                Tampilan
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Trend Pengadaan Tahunan -->
                <div class="card group hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Trend Pengadaan Aset</h3>
                            <p class="text-sm text-gray-500 mt-1">Perkembangan selama 5 tahun terakhir</p>
                        </div>
                        <div class="h-10 w-10 rounded-lg bg-indigo-50 flex items-center justify-center group-hover:bg-indigo-100 transition-colors">
                            <i class="fas fa-chart-line text-indigo-600"></i>
                        </div>
                    </div>
                    <div class="relative h-72">
                        <canvas id="trendChart"></canvas>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <div class="flex items-center justify-between text-sm">
                            <div>
                                <span class="text-gray-600">Rata-rata pertumbuhan:</span>
                                <span class="font-bold text-green-600 ml-2">+12.5% per tahun</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <button class="h-8 w-8 rounded-full border border-gray-300 flex items-center justify-center hover:bg-gray-50">
                                    <i class="fas fa-download text-gray-600 text-xs"></i>
                                </button>
                                <button class="h-8 w-8 rounded-full border border-gray-300 flex items-center justify-center hover:bg-gray-50">
                                    <i class="fas fa-expand text-gray-600 text-xs"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mt-8" data-aos="fade-up" data-aos-delay="300">
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Aksi Cepat</h3>
                            <p class="text-sm text-gray-600 mt-1">Kelola data aset dengan cepat</p>
                        </div>
                        <i class="fas fa-bolt text-yellow-500 text-2xl"></i>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a href="{{ route('admin.dashboard-aset.create') }}" class="bg-white rounded-xl p-4 shadow-sm hover:shadow-md transition-shadow duration-300 group">
                            <div class="flex items-center space-x-3">
                                <div class="h-10 w-10 rounded-lg bg-blue-100 flex items-center justify-center group-hover:bg-blue-200 transition-colors">
                                    <i class="fas fa-plus text-blue-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900">Tambah Aset Baru</h4>
                                    <p class="text-xs text-gray-500">Input data aset baru</p>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('kinerja') }}" class="bg-white rounded-xl p-4 shadow-sm hover:shadow-md transition-shadow duration-300 group">
                            <div class="flex items-center space-x-3">
                                <div class="h-10 w-10 rounded-lg bg-green-100 flex items-center justify-center group-hover:bg-green-200 transition-colors">
                                    <i class="fas fa-chart-line text-green-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900">Analisis Kinerja</h4>
                                    <p class="text-xs text-gray-500">Pantau performa aset</p>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="bg-white rounded-xl p-4 shadow-sm hover:shadow-md transition-shadow duration-300 group">
                            <div class="flex items-center space-x-3">
                                <div class="h-10 w-10 rounded-lg bg-purple-100 flex items-center justify-center group-hover:bg-purple-200 transition-colors">
                                    <i class="fas fa-file-export text-purple-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900">Ekspor Laporan</h4>
                                    <p class="text-xs text-gray-500">Download data dashboard</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });

        // Chart colors
        const chartColors = {
            blue: '#3B82F6',
            purple: '#8B5CF6',
            pink: '#EC4899',
            yellow: '#F59E0B',
            green: '#10B981',
            indigo: '#6366F1',
            red: '#EF4444',
            cyan: '#06B6D4'
        };

        // Kategori Chart
        const kategoriCtx = document.getElementById('kategoriChart').getContext('2d');
        const kategoriChart = new Chart(kategoriCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($kategoriData->pluck('kategori_aset')) !!},
                datasets: [{
                    data: {!! json_encode($kategoriData->pluck('total')) !!},
                    backgroundColor: Object.values(chartColors),
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
                                return `${label}: ${value} unit (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });

        // Kondisi Chart
        const kondisiCtx = document.getElementById('kondisiChart').getContext('2d');
        const kondisiChart = new Chart(kondisiCtx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($kondisiData->pluck('kondisi')) !!},
                datasets: [{
                    data: {!! json_encode($kondisiData->pluck('total')) !!},
                    backgroundColor: [chartColors.green, chartColors.yellow, chartColors.red],
                    borderWidth: 2,
                    borderColor: '#FFFFFF',
                    hoverOffset: 15
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
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
                    }
                }
            }
        });

        // Nilai Chart
        const nilaiCtx = document.getElementById('nilaiChart').getContext('2d');
        const nilaiChart = new Chart(nilaiCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($nilaiPerKategori->pluck('kategori_aset')) !!},
                datasets: [{
                    label: 'Nilai (Miliar Rp)',
                    data: {!! json_encode($nilaiPerKategori->pluck('total_nilai')->map(fn($v) => $v / 1000000000)) !!},
                    backgroundColor: chartColors.purple,
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
                        },
                        ticks: {
                            maxRotation: 45
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
                                return `Nilai: Rp ${context.parsed.y} Miliar`;
                            }
                        }
                    }
                }
            }
        });

        // Trend Chart
        const trendCtx = document.getElementById('trendChart').getContext('2d');
        const trendChart = new Chart(trendCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($trendTahunan->pluck('tahun')) !!},
                datasets: [{
                    label: 'Jumlah Aset',
                    data: {!! json_encode($trendTahunan->pluck('total')) !!},
                    borderColor: chartColors.blue,
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.4,
                    fill: true,
                    borderWidth: 3,
                    pointBackgroundColor: chartColors.blue,
                    pointBorderColor: '#FFFFFF',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8
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
                                return `${context.dataset.label}: ${context.parsed.y} unit`;
                            }
                        }
                    }
                }
            }
        });

        // Toggle chart type function
        function toggleChartType(chartId) {
            const chart = chartId === 'nilaiChart' ? nilaiChart : trendChart;
            const newType = chart.config.type === 'bar' ? 'line' : 'bar';

            chart.config.type = newType;
            chart.update();
        }

        // Add resize listener for better responsiveness
        window.addEventListener('resize', function() {
            kategoriChart.resize();
            kondisiChart.resize();
            nilaiChart.resize();
            trendChart.resize();
        });
    </script>
    @endpush
</x-app-layout>
