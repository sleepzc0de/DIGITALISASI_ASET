<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    {{ __('Manajemen Data Aset') }}
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Kelola dan pantau seluruh data aset BMN secara terpusat
                </p>
            </div>
            <div class="flex items-center space-x-3">
                <div class="relative">
                    <input type="text" placeholder="Cari aset..."
                           class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition-all duration-200 w-full sm:w-64">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
                <a href="{{ route('admin.dashboard-aset.create') }}" class="btn-primary flex items-center">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Aset
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Summary Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-2xl p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-blue-800 uppercase tracking-wide">Total Aset</p>
                            <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ number_format($asets->total()) }}</h3>
                        </div>
                        <div class="h-12 w-12 rounded-xl bg-blue-500 flex items-center justify-center">
                            <i class="fas fa-boxes text-white text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 text-sm text-blue-700">
                        <i class="fas fa-chart-line mr-1"></i>
                        {{ $asets->lastPage() }} halaman data
                    </div>
                </div>

                <div class="bg-gradient-to-r from-green-50 to-green-100 rounded-2xl p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-green-800 uppercase tracking-wide">Total Nilai</p>
                            <h3 class="text-3xl font-bold text-gray-900 mt-2">
                                Rp {{ number_format($asets->sum('nilai_buku') / 1000000000, 2) }}M
                            </h3>
                        </div>
                        <div class="h-12 w-12 rounded-xl bg-green-500 flex items-center justify-center">
                            <i class="fas fa-money-bill-wave text-white text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 text-sm text-green-700">
                        <i class="fas fa-calculator mr-1"></i>
                        Rata-rata Rp {{ number_format($asets->avg('nilai_buku')) }}
                    </div>
                </div>

                <div class="bg-gradient-to-r from-purple-50 to-purple-100 rounded-2xl p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-purple-800 uppercase tracking-wide">Kategori Aktif</p>
                            <h3 class="text-3xl font-bold text-gray-900 mt-2">
                                {{ $asets->unique('kategori_aset')->count() }}
                            </h3>
                        </div>
                        <div class="h-12 w-12 rounded-xl bg-purple-500 flex items-center justify-center">
                            <i class="fas fa-layer-group text-white text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 text-sm text-purple-700">
                        <i class="fas fa-tags mr-1"></i>
                        {{ $asets->unique('lokasi')->count() }} lokasi berbeda
                    </div>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="flex items-center space-x-4">
                        <button class="px-4 py-2 bg-blue-50 text-blue-700 rounded-lg font-medium hover:bg-blue-100 transition-colors flex items-center">
                            <i class="fas fa-filter mr-2"></i>
                            Semua Aset
                            <i class="fas fa-chevron-down ml-2 text-xs"></i>
                        </button>
                        <button class="px-4 py-2 text-gray-700 rounded-lg font-medium hover:bg-gray-100 transition-colors flex items-center">
                            <i class="fas fa-sort-amount-down mr-2"></i>
                            Urutkan
                        </button>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="text-sm text-gray-600">
                            Menampilkan <span class="font-bold">{{ $asets->firstItem() ?? 0 }}-{{ $asets->lastItem() ?? 0 }}</span>
                            dari <span class="font-bold">{{ $asets->total() }}</span> data
                        </div>
                        <button class="h-10 w-10 rounded-lg border border-gray-300 flex items-center justify-center hover:bg-gray-50">
                            <i class="fas fa-download text-gray-600"></i>
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
                                        Kategori Aset
                                        <i class="fas fa-sort ml-2 text-gray-400"></i>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    <div class="flex items-center">
                                        Jumlah Unit
                                        <i class="fas fa-sort ml-2 text-gray-400"></i>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    <div class="flex items-center">
                                        Nilai Buku
                                        <i class="fas fa-sort ml-2 text-gray-400"></i>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    <div class="flex items-center">
                                        Kondisi
                                        <i class="fas fa-sort ml-2 text-gray-400"></i>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    <div class="flex items-center">
                                        Lokasi
                                        <i class="fas fa-sort ml-2 text-gray-400"></i>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    <div class="flex items-center">
                                        Tahun
                                        <i class="fas fa-sort ml-2 text-gray-400"></i>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($asets as $aset)
                            <tr class="hover:bg-gray-50 transition-colors group">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 rounded-lg bg-blue-100 flex items-center justify-center mr-3">
                                            @php
                                                $icons = [
                                                    'Kendaraan' => 'fa-car',
                                                    'Elektronik' => 'fa-laptop',
                                                    'Furniture' => 'fa-chair',
                                                    'Bangunan' => 'fa-building',
                                                    'Tanah' => 'fa-mountain',
                                                ];
                                                $icon = $icons[$aset->kategori_aset] ?? 'fa-box';
                                            @endphp
                                            <i class="fas {{ $icon }} text-blue-600"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-semibold text-gray-900">{{ $aset->kategori_aset }}</div>
                                            <div class="text-xs text-gray-500">ID: ASET{{ str_pad($aset->id, 4, '0', STR_PAD_LEFT) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ number_format($aset->jumlah_unit) }}</div>
                                    <div class="text-xs text-gray-500">unit</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">Rp {{ number_format($aset->nilai_buku, 0, ',', '.') }}</div>
                                    <div class="text-xs text-gray-500">
                                        @if($aset->nilai_buku > 1000000000)
                                            {{ number_format($aset->nilai_buku / 1000000000, 2) }}M
                                        @elseif($aset->nilai_buku > 1000000)
                                            {{ number_format($aset->nilai_buku / 1000000, 2) }}Jt
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $kondisiColors = [
                                            'Baik' => ['bg' => 'bg-green-100', 'text' => 'text-green-800', 'icon' => 'fa-check-circle'],
                                            'Rusak Ringan' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-800', 'icon' => 'fa-exclamation-triangle'],
                                            'Rusak Berat' => ['bg' => 'bg-red-100', 'text' => 'text-red-800', 'icon' => 'fa-times-circle'],
                                        ];
                                        $color = $kondisiColors[$aset->kondisi] ?? ['bg' => 'bg-gray-100', 'text' => 'text-gray-800', 'icon' => 'fa-question-circle'];
                                    @endphp
                                    <div class="flex items-center">
                                        <i class="fas {{ $color['icon'] }} text-xs mr-2 {{ $color['text'] }}"></i>
                                        <span class="px-3 py-1 text-xs font-medium rounded-full {{ $color['bg'] }} {{ $color['text'] }}">
                                            {{ $aset->kondisi }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <i class="fas fa-map-marker-alt text-gray-400 mr-2"></i>
                                        <span class="text-sm text-gray-900">{{ $aset->lokasi }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $aset->tahun }}</div>
                                    <div class="text-xs text-gray-500">
                                        {{ now()->year - $aset->tahun }} tahun
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="{{ route('admin.dashboard-aset.edit', $aset) }}"
                                           class="h-8 w-8 rounded-lg bg-blue-50 hover:bg-blue-100 flex items-center justify-center text-blue-600 hover:text-blue-800 transition-colors"
                                           title="Edit">
                                            <i class="fas fa-edit text-sm"></i>
                                        </a>
                                        <button onclick="showDetailModal({{ $aset->id }})"
                                                class="h-8 w-8 rounded-lg bg-gray-50 hover:bg-gray-100 flex items-center justify-center text-gray-600 hover:text-gray-800 transition-colors"
                                                title="Detail">
                                            <i class="fas fa-eye text-sm"></i>
                                        </button>
                                        <button onclick="confirmDelete({{ $aset->id }}, '{{ addslashes($aset->kategori_aset) }}')"
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
                                            <i class="fas fa-box-open text-gray-400 text-2xl"></i>
                                        </div>
                                        <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada data aset</h3>
                                        <p class="text-gray-500 mb-6">Mulai dengan menambahkan data aset pertama Anda</p>
                                        <a href="{{ route('admin.dashboard-aset.create') }}" class="btn-primary">
                                            <i class="fas fa-plus mr-2"></i>
                                            Tambah Aset Pertama
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($asets->hasPages())
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div class="text-sm text-gray-700 mb-4 sm:mb-0">
                            Menampilkan <span class="font-medium">{{ $asets->firstItem() }}</span> sampai
                            <span class="font-medium">{{ $asets->lastItem() }}</span> dari
                            <span class="font-medium">{{ $asets->total() }}</span> hasil
                        </div>
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                            {{ $asets->links('vendor.pagination.tailwind') }}
                        </nav>
                    </div>
                </div>
                @endif
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
                <h3 class="text-lg font-medium text-gray-900 mb-2">Hapus Data Aset</h3>
                <p class="text-sm text-gray-500 mb-6" id="deleteModalText">
                    Apakah Anda yakin ingin menghapus data aset ini? Tindakan ini tidak dapat dibatalkan.
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

            text.innerHTML = `Apakah Anda yakin ingin menghapus data aset <strong>"${name}"</strong>? Tindakan ini tidak dapat dibatalkan.`;
            // Perbaikan: Gunakan route yang benar dengan parameter ID
            form.action = `{{ route('admin.dashboard-aset.destroy', ':id') }}`.replace(':id', id);

            modal.classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        // Show Detail Modal
        function showDetailModal(id) {
            // Implement detail modal logic here
            alert(`Detail aset dengan ID: ${id}`);
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
    </script>
    @endpush
</x-app-layout>
