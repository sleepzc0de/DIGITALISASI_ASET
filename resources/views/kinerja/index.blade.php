<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Kinerja BMN dan Pengadaan') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <!-- Total Kegiatan -->
            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm font-medium uppercase tracking-wide">Total Kegiatan</p>
                        <h3 class="text-4xl font-bold mt-2">{{ $totalKegiatan }}</h3>
                        <p class="text-purple-100 text-sm mt-1">Kegiatan Aktif</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-4">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Kegiatan Selesai -->
            <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl shadow-xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-emerald-100 text-sm font-medium uppercase tracking-wide">Kegiatan Selesai</p>
                        <h3 class="text-4xl font-bold mt-2">{{ $kegiatanSelesai }}</h3>
                        <p class="text-emerald-100 text-sm mt-1">{{ $totalKegiatan > 0 ? round(($kegiatanSelesai / $totalKegiatan) * 100, 1) : 0 }}% dari total</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-4">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row 1 -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Realisasi per Jenis Kegiatan -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Realisasi per Jenis Kegiatan (%)</h3>
                <canvas id="realisasiChart" class="w-full" style="height: 300px;"></canvas>
            </div>

            <!-- Status Kegiatan -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Status Kegiatan</h3>
                <canvas id="statusChart" class="w-full" style="height: 300px;"></canvas>
            </div>
        </div>

        <!-- Charts Row 2 -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Anggaran vs Realisasi -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Anggaran vs Realisasi (Miliar Rp)</h3>
                <canvas id="anggaranChart" class="w-full" style="height: 300px;"></canvas>
            </div>

            <!-- Trend Bulanan -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Trend Kegiatan Bulanan {{ date('Y') }}</h3>
                <canvas id="trendBulananChart" class="w-full" style="height: 300px;"></canvas>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Realisasi Chart
        const realisasiCtx = document.getElementById('realisasiChart').getContext('2d');
        new Chart(realisasiCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($realisasiData->pluck('jenis_kegiatan')) !!},
                datasets: [{
                    label: 'Persentase Realisasi',
                    data: {!! json_encode($realisasiData->pluck('persentase')) !!},
                    backgroundColor: ['#8B5CF6', '#EC4899', '#F59E0B'],
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        grid: { color: '#F3F4F6' }
                    },
                    x: {
                        grid: { display: false }
                    }
                },
                plugins: {
                    legend: { display: false }
                }
            }
        });

        // Status Chart
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($statusData->pluck('status')) !!},
                datasets: [{
                    data: {!! json_encode($statusData->pluck('total')) !!},
                    backgroundColor: ['#3B82F6', '#10B981', '#EF4444'],
                    borderWidth: 0
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
                            font: { size: 12 }
                        }
                    }
                }
            }
        });

        // Anggaran Chart
        const anggaranCtx = document.getElementById('anggaranChart').getContext('2d');
        new Chart(anggaranCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($anggaranData->pluck('jenis_kegiatan')) !!},
                datasets: [
                    {
                        label: 'Anggaran',
                        data: {!! json_encode($anggaranData->pluck('total_anggaran')->map(fn($v) => $v / 1000000000)) !!},
                        backgroundColor: '#3B82F6',
                        borderRadius: 8
                    },
                    {
                        label: 'Realisasi',
                        data: {!! json_encode($anggaranData->pluck('total_realisasi')->map(fn($v) => $v / 1000000000)) !!},
                        backgroundColor: '#10B981',
                        borderRadius: 8
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#F3F4F6' }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });

        // Trend Bulanan Chart
        const trendBulananCtx = document.getElementById('trendBulananChart').getContext('2d');
        const bulanNames = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        new Chart(trendBulananCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($trendBulanan->pluck('bulan')->map(fn($b) => $bulanNames[$b - 1] ?? $b)) !!},
                datasets: [{
                    label: 'Jumlah Kegiatan',
                    data: {!! json_encode($trendBulanan->pluck('total')) !!},
                    borderColor: '#8B5CF6',
                    backgroundColor: 'rgba(139, 92, 246, 0.1)',
                    tension: 0.4,
                    fill: true,
                    borderWidth: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#F3F4F6' }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });
    </script>
    @endpush
</x-app-layout>
