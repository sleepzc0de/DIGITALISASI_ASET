<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    {{ __('Manajemen Data Kinerja BMN') }}
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Kelola data kinerja dan monitoring kegiatan pengadaan BMN
                </p>
            </div>
            <div class="flex items-center space-x-3">
                <div class="relative">
                    <input type="text" placeholder="Cari kegiatan..."
                           class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition-all duration-200 w-full sm:w-64">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
                <a href="{{ route('admin.kinerja-bmn.create') }}" class="btn-primary flex items-center">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Kinerja
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Summary Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Kegiatan -->
                <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-2xl p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-blue-800 uppercase tracking-wide">Total Kegiatan</p>
                            <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ number_format($kinerjas->total()) }}</h3>
                        </div>
                        <div class="h-12 w-12 rounded-xl bg-blue-500 flex items-center justify-center">
                            <i class="fas fa-tasks text-white text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 text-sm text-blue-700">
                        <i class="fas fa-chart-line mr-1"></i>
                        {{ $kinerjas->lastPage() }} halaman data
                    </div>
                </div>

                <!-- Rata-rata Realisasi -->
                <div class="bg-gradient-to-r from-green-50 to-green-100 rounded-2xl p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-green-800 uppercase tracking-wide">Rata-rata Realisasi</p>
                            <h3 class="text-3xl font-bold text-gray-900 mt-2">
                                {{ number_format($kinerjas->avg('persentase_realisasi') ?? 0, 1) }}%
                            </h3>
                        </div>
                        <div class="h-12 w-12 rounded-xl bg-green-500 flex items-center justify-center">
                            <i class="fas fa-percentage text-white text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 text-sm text-green-700">
                        <i class="fas fa-trophy mr-1"></i>
                        Target: 100%
                    </div>
                </div>

                <!-- Total Anggaran -->
                <div class="bg-gradient-to-r from-purple-50 to-purple-100 rounded-2xl p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-purple-800 uppercase tracking-wide">Total Anggaran</p>
                            <h3 class="text-3xl font-bold text-gray-900 mt-2">
                                Rp {{ number_format($kinerjas->sum('anggaran') / 1000000000, 1) }}M
                            </h3>
                        </div>
                        <div class="h-12 w-12 rounded-xl bg-purple-500 flex items-center justify-center">
                            <i class="fas fa-money-bill-wave text-white text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 text-sm text-purple-700">
                        <i class="fas fa-calculator mr-1"></i>
                        Realisasi: Rp {{ number_format($kinerjas->sum('realisasi_anggaran') / 1000000000, 1) }}M
                    </div>
                </div>

                <!-- Kegiatan Selesai -->
                <div class="bg-gradient-to-r from-cyan-50 to-cyan-100 rounded-2xl p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-cyan-800 uppercase tracking-wide">Kegiatan Selesai</p>
                            <h3 class="text-3xl font-bold text-gray-900 mt-2">
                                {{ $kinerjas->where('status', 'Completed')->count() }}
                            </h3>
                        </div>
                        <div class="h-12 w-12 rounded-xl bg-cyan-500 flex items-center justify-center">
                            <i class="fas fa-check-circle text-white text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 text-sm text-cyan-700">
                        <i class="fas fa-chart-pie mr-1"></i>
                        {{ $kinerjas->count() > 0 ? round(($kinerjas->where('status', 'Completed')->count() / $kinerjas->count()) * 100, 1) : 0 }}% dari total
                    </div>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="flex items-center space-x-4">
                        <button class="px-4 py-2 bg-blue-50 text-blue-700 rounded-lg font-medium hover:bg-blue-100 transition-colors flex items-center">
                            <i class="fas fa-filter mr-2"></i>
                            Semua Status
                            <i class="fas fa-chevron-down ml-2 text-xs"></i>
                        </button>
                        <button class="px-4 py-2 text-gray-700 rounded-lg font-medium hover:bg-gray-100 transition-colors flex items-center">
                            <i class="fas fa-sort-amount-down mr-2"></i>
                            Urutkan
                        </button>
                        <div class="flex items-center space-x-2">
                            <span class="text-sm text-gray-600">Periode:</span>
                            <select class="text-sm border border-gray-300 rounded-lg px-3 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option>Semua</option>
                                <option>2024</option>
                                <option>2023</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="text-sm text-gray-600">
                            Menampilkan <span class="font-bold">{{ $kinerjas->firstItem() ?? 0 }}-{{ $kinerjas->lastItem() ?? 0 }}</span>
                            dari <span class="font-bold">{{ $kinerjas->total() }}</span> data
                        </div>
                        <button class="h-10 w-10 rounded-lg border border-gray-300 flex items-center justify-center hover:bg-gray-50">
                            <i class="fas fa-download text-gray-600"></i>
                        </button>
                        <button class="h-10 w-10 rounded-lg border border-gray-300 flex items-center justify-center hover:bg-gray-50">
                            <i class="fas fa-print text-gray-600"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Main Table -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    <div class="flex items-center">
                                        Jenis Kegiatan
                                        <i class="fas fa-sort ml-2 text-gray-400"></i>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    <div class="flex items-center">
                                        Nama Kegiatan
                                        <i class="fas fa-sort ml-2 text-gray-400"></i>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    <div class="flex items-center">
                                        Realisasi
                                        <i class="fas fa-sort ml-2 text-gray-400"></i>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    <div class="flex items-center">
                                        Anggaran
                                        <i class="fas fa-sort ml-2 text-gray-400"></i>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    <div class="flex items-center">
                                        Status
                                        <i class="fas fa-sort ml-2 text-gray-400"></i>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    <div class="flex items-center">
                                        Periode
                                        <i class="fas fa-sort ml-2 text-gray-400"></i>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($kinerjas as $kinerja)
                            <tr class="hover:bg-gray-50 transition-colors group">
                                <!-- Jenis Kegiatan -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $jenisColors = [
                                            'Pengadaan' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-800', 'icon' => 'fa-shopping-cart'],
                                            'Pemeliharaan' => ['bg' => 'bg-purple-100', 'text' => 'text-purple-800', 'icon' => 'fa-tools'],
                                            'Rehabilitasi' => ['bg' => 'bg-orange-100', 'text' => 'text-orange-800', 'icon' => 'fa-hammer'],
                                            'Lainnya' => ['bg' => 'bg-gray-100', 'text' => 'text-gray-800', 'icon' => 'fa-ellipsis-h'],
                                        ];
                                        $jenis = $jenisColors[$kinerja->jenis_kegiatan] ?? $jenisColors['Lainnya'];
                                    @endphp
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 rounded-lg {{ $jenis['bg'] }} flex items-center justify-center mr-3">
                                            <i class="fas {{ $jenis['icon'] }} {{ $jenis['text'] }}"></i>
                                        </div>
                                        <span class="text-sm font-medium {{ $jenis['text'] }}">
                                            {{ $kinerja->jenis_kegiatan }}
                                        </span>
                                    </div>
                                </td>

                                <!-- Nama Kegiatan -->
                                <td class="px-6 py-4">
                                    <div class="text-sm font-semibold text-gray-900">{{ $kinerja->nama_kegiatan }}</div>
                                    <div class="text-xs text-gray-500 mt-1 flex items-center">
                                        <i class="fas fa-clock text-gray-400 mr-1 text-xs"></i>
                                        ID: K{{ str_pad($kinerja->id, 4, '0', STR_PAD_LEFT) }}
                                    </div>
                                </td>

                                <!-- Realisasi -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-24 mr-3">
                                            <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                                                @php
                                                    $percentage = $kinerja->persentase_realisasi;
                                                    $color = $percentage >= 90 ? 'bg-green-500' : ($percentage >= 70 ? 'bg-yellow-500' : 'bg-red-500');
                                                @endphp
                                                <div class="h-full {{ $color }} rounded-full" style="width: {{ min($percentage, 100) }}%"></div>
                                            </div>
                                        </div>
                                        <div class="text-left">
                                            <div class="text-sm font-medium text-gray-900">{{ $kinerja->realisasi }}/{{ $kinerja->target }}</div>
                                            <div class="text-xs {{ $percentage >= 90 ? 'text-green-600' : ($percentage >= 70 ? 'text-yellow-600' : 'text-red-600') }}">
                                                {{ number_format($kinerja->persentase_realisasi, 1) }}%
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Anggaran -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        Rp {{ number_format($kinerja->realisasi_anggaran / 1000000, 1) }}M
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        dari Rp {{ number_format($kinerja->anggaran / 1000000, 1) }}M
                                    </div>
                                    @php
                                        $anggaranPercentage = $kinerja->anggaran > 0 ? ($kinerja->realisasi_anggaran / $kinerja->anggaran) * 100 : 0;
                                    @endphp
                                    <div class="text-xs {{ $anggaranPercentage <= 100 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ number_format($anggaranPercentage, 1) }}% anggaran
                                    </div>
                                </td>

                                <!-- Status -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $statusColors = [
                                            'Completed' => ['bg' => 'bg-green-100', 'text' => 'text-green-800', 'icon' => 'fa-check-circle'],
                                            'On Progress' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-800', 'icon' => 'fa-spinner'],
                                            'Pending' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-800', 'icon' => 'fa-clock'],
                                            'Cancelled' => ['bg' => 'bg-red-100', 'text' => 'text-red-800', 'icon' => 'fa-times-circle'],
                                        ];
                                        $status = $statusColors[$kinerja->status] ?? ['bg' => 'bg-gray-100', 'text' => 'text-gray-800', 'icon' => 'fa-question-circle'];
                                    @endphp
                                    <div class="flex items-center">
                                        <i class="fas {{ $status['icon'] }} text-xs mr-2 {{ $status['text'] }}"></i>
                                        <span class="px-3 py-1 text-xs font-medium rounded-full {{ $status['bg'] }} {{ $status['text'] }}">
                                            {{ $kinerja->status }}
                                        </span>
                                    </div>
                                </td>

                                <!-- Periode -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        @php
                                            $monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
                                        @endphp
                                        {{ $monthNames[$kinerja->bulan - 1] ?? $kinerja->bulan }} {{ $kinerja->tahun }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        @php
                                            $now = now();
                                            $periodeDate = Carbon\Carbon::create($kinerja->tahun, $kinerja->bulan, 1);
                                            $monthsDiff = $now->diffInMonths($periodeDate);
                                            if ($monthsDiff == 0) {
                                                echo 'Bulan ini';
                                            } elseif ($monthsDiff == 1) {
                                                echo '1 bulan lalu';
                                            } elseif ($monthsDiff < 12) {
                                                echo $monthsDiff . ' bulan lalu';
                                            } else {
                                                echo floor($monthsDiff / 12) . ' tahun lalu';
                                            }
                                        @endphp
                                    </div>
                                </td>

                                <!-- Aksi -->
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="{{ route('admin.kinerja-bmn.edit', $kinerja) }}"
                                           class="h-8 w-8 rounded-lg bg-blue-50 hover:bg-blue-100 flex items-center justify-center text-blue-600 hover:text-blue-800 transition-colors"
                                           title="Edit">
                                            <i class="fas fa-edit text-sm"></i>
                                        </a>
                                        <button onclick="showDetailModal({{ $kinerja->id }})"
                                                class="h-8 w-8 rounded-lg bg-gray-50 hover:bg-gray-100 flex items-center justify-center text-gray-600 hover:text-gray-800 transition-colors"
                                                title="Detail">
                                            <i class="fas fa-eye text-sm"></i>
                                        </button>
                                        <button onclick="confirmDelete({{ $kinerja->id }}, '{{ addslashes($kinerja->nama_kegiatan) }}')"
                                                class="h-8 w-8 rounded-lg bg-red-50 hover:bg-red-100 flex items-center justify-center text-red-600 hover:text-red-800 transition-colors"
                                                title="Hapus">
                                            <i class="fas fa-trash-alt text-sm"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="h-16 w-16 rounded-full bg-gray-100 flex items-center justify-center mb-4">
                                            <i class="fas fa-chart-line text-gray-400 text-2xl"></i>
                                        </div>
                                        <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada data kinerja</h3>
                                        <p class="text-gray-500 mb-6">Mulai dengan menambahkan data kinerja pertama Anda</p>
                                        <a href="{{ route('admin.kinerja-bmn.create') }}" class="btn-primary">
                                            <i class="fas fa-plus mr-2"></i>
                                            Tambah Data Kinerja
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($kinerjas->hasPages())
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div class="text-sm text-gray-700 mb-4 sm:mb-0">
                            Menampilkan <span class="font-medium">{{ $kinerjas->firstItem() }}</span> sampai
                            <span class="font-medium">{{ $kinerjas->lastItem() }}</span> dari
                            <span class="font-medium">{{ $kinerjas->total() }}</span> hasil
                        </div>
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                            {{ $kinerjas->links('vendor.pagination.tailwind') }}
                        </nav>
                    </div>
                </div>
                @endif
            </div>

            <!-- Quick Insights -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-200">
                    <div class="flex items-center mb-4">
                        <div class="h-10 w-10 rounded-lg bg-blue-500 flex items-center justify-center mr-3">
                            <i class="fas fa-bullseye text-white"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-900">Kinerja Terbaik</h4>
                            <p class="text-xs text-gray-600">Realisasi tertinggi</p>
                        </div>
                    </div>
                    @if($kinerjas->count() > 0)
                        @php $best = $kinerjas->sortByDesc('persentase_realisasi')->first(); @endphp
                        <div class="text-2xl font-bold text-gray-900">{{ $best->persentase_realisasi }}%</div>
                        <div class="text-sm text-gray-600 mt-1">{{ $best->nama_kegiatan }}</div>
                    @else
                        <div class="text-sm text-gray-500">Tidak ada data</div>
                    @endif
                </div>

                <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-2xl p-6 border border-green-200">
                    <div class="flex items-center mb-4">
                        <div class="h-10 w-10 rounded-lg bg-green-500 flex items-center justify-center mr-3">
                            <i class="fas fa-calendar-check text-white"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-900">Kegiatan Terbaru</h4>
                            <p class="text-xs text-gray-600">Bulan ini</p>
                        </div>
                    </div>
                    @php
                        $currentMonth = now()->month;
                        $currentYear = now()->year;
                        $thisMonthCount = $kinerjas->where('bulan', $currentMonth)->where('tahun', $currentYear)->count();
                    @endphp
                    <div class="text-2xl font-bold text-gray-900">{{ $thisMonthCount }}</div>
                    <div class="text-sm text-gray-600 mt-1">kegiatan aktif bulan ini</div>
                </div>

                <div class="bg-gradient-to-r from-purple-50 to-purple-100 rounded-2xl p-6 border border-purple-200">
                    <div class="flex items-center mb-4">
                        <div class="h-10 w-10 rounded-lg bg-purple-500 flex items-center justify-center mr-3">
                            <i class="fas fa-exclamation-triangle text-white"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-900">Perlu Perhatian</h4>
                            <p class="text-xs text-gray-600">Realisasi di bawah 70%</p>
                        </div>
                    </div>
                    @php
                        $lowPerformance = $kinerjas->where('persentase_realisasi', '<', 70)->count();
                    @endphp
                    <div class="text-2xl font-bold text-gray-900">{{ $lowPerformance }}</div>
                    <div class="text-sm text-gray-600 mt-1">kegiatan perlu evaluasi</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-2xl bg-white">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                    <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Hapus Data Kinerja</h3>
                <p class="text-sm text-gray-500 mb-6" id="deleteModalText">
                    Apakah Anda yakin ingin menghapus data kinerja ini? Tindakan ini tidak dapat dibatalkan.
                </p>
                <div class="flex justify-center space-x-3">
                    <button onclick="closeDeleteModal()"
                            class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                        Batal
                    </button>
                    <form id="deleteForm" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                            Ya, Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Delete Confirmation
        function confirmDelete(id, name) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');
            const text = document.getElementById('deleteModalText');

            text.innerHTML = `Apakah Anda yakin ingin menghapus data kinerja <strong>"${name}"</strong>? Tindakan ini tidak dapat dibatalkan.`;
            form.action = `{{ route('admin.kinerja-bmn.destroy', ':id') }}`.replace(':id', id);

            modal.classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        // Show Detail Modal
        function showDetailModal(id) {
            // Implement detail modal logic here
            alert(`Detail kinerja dengan ID: ${id}`);
        }

        // Search functionality
        document.querySelector('input[type="text"]').addEventListener('keyup', function(e) {
            if (e.key === 'Enter') {
                // Implement search logic here
                console.log('Searching for:', this.value);
            }
        });

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('deleteModal');
            if (event.target == modal) {
                closeDeleteModal();
            }
        }

        // Initialize tooltips for progress bars
        document.querySelectorAll('.progress-bar-container').forEach(container => {
            const progressBar = container.querySelector('.progress-bar');
            const percentage = container.dataset.percentage;

            container.addEventListener('mouseenter', () => {
                const tooltip = document.createElement('div');
                tooltip.className = 'absolute z-10 px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm';
                tooltip.textContent = `${percentage}% realisasi`;
                tooltip.style.bottom = '100%';
                tooltip.style.left = '50%';
                tooltip.style.transform = 'translateX(-50%)';
                tooltip.style.marginBottom = '8px';

                container.style.position = 'relative';
                container.appendChild(tooltip);
            });

            container.addEventListener('mouseleave', () => {
                const tooltip = container.querySelector('.tooltip');
                if (tooltip) tooltip.remove();
            });
        });
    </script>
    @endpush
</x-app-layout>
