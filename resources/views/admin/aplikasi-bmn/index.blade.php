<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-bold text-3xl text-gray-900 tracking-tight">
                    {{ __('Manajemen Aplikasi BMN') }}
                </h2>
                <p class="text-gray-600 mt-1">Kelola data aplikasi BMN dan Pengadaan</p>
            </div>
            <a href="{{ route('admin.aplikasi-bmn.create') }}"
               class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Tambah Aplikasi
            </a>
        </div>
    </x-slot>

    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Filter Section -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8" data-aos="fade-up">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Filter Data</h3>
                    <p class="text-gray-600 text-sm">Saring data aplikasi berdasarkan kategori dan status</p>
                </div>
                <div class="text-sm text-gray-500">
                    Total: {{ $aplikasis->total() }} aplikasi
                </div>
            </div>

            <form method="GET" action="{{ route('admin.aplikasi-bmn.index') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Kategori Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <select name="kategori"
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-all duration-200">
                            <option value="">Semua Kategori</option>
                            <option value="BMN" {{ request('kategori') == 'BMN' ? 'selected' : '' }}>BMN</option>
                            <option value="Pengadaan" {{ request('kategori') == 'Pengadaan' ? 'selected' : '' }}>Pengadaan</option>
                            <option value="Inventaris" {{ request('kategori') == 'Inventaris' ? 'selected' : '' }}>Inventaris</option>
                            <option value="Monitoring" {{ request('kategori') == 'Monitoring' ? 'selected' : '' }}>Monitoring</option>
                        </select>
                    </div>

                    <!-- Status Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select name="status"
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-all duration-200">
                            <option value="">Semua Status</option>
                            <option value="Aktif" {{ request('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Maintenance" {{ request('status') == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                            <option value="Non-Aktif" {{ request('status') == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
                        </select>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-end gap-2">
                        <button type="submit"
                                class="flex-1 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-medium rounded-xl shadow hover:shadow-lg transition-all duration-300 px-4 py-3">
                            Terapkan Filter
                        </button>
                        <a href="{{ route('admin.aplikasi-bmn.index') }}"
                           class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-xl shadow hover:shadow-lg transition-all duration-300 px-4 py-3 text-center">
                            Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden" data-aos="fade-up" data-aos-delay="100">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                        <tr>
                            <th scope="col" class="px-8 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Aplikasi
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Kategori
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Vendor
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Users
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Expired
                            </th>
                            <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($aplikasis as $aplikasi)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <!-- Aplikasi -->
                                <td class="px-8 py-4">
                                    <div class="flex items-center">
                                        <div class="h-12 w-12 flex-shrink-0 rounded-xl bg-gradient-to-br from-blue-100 to-indigo-100 p-2">
                                            <img class="h-8 w-8 object-contain" src="{{ $aplikasi->getLogoUrl() }}" alt="{{ $aplikasi->nama_aplikasi }}">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-semibold text-gray-900">{{ $aplikasi->nama_aplikasi }}</div>
                                            @if($aplikasi->versi)
                                                <div class="text-xs text-gray-500">v{{ $aplikasi->versi }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                <!-- Kategori -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $aplikasi->getKategoriBadgeClass() }}">
                                        {{ $aplikasi->kategori }}
                                    </span>
                                </td>

                                <!-- Vendor -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $aplikasi->vendor ?? '-' }}</div>
                                </td>

                                <!-- Status -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $aplikasi->getStatusBadgeClass() }}">
                                        {{ $aplikasi->status }}
                                    </span>
                                </td>

                                <!-- Users -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ number_format($aplikasi->jumlah_user) }}</div>
                                </td>

                                <!-- Expired -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($aplikasi->tanggal_expired)
                                        <div class="text-sm {{ $aplikasi->isExpiringSoon() ? 'text-amber-600 font-semibold' : ($aplikasi->isExpired() ? 'text-red-600 font-semibold' : 'text-gray-900') }}">
                                            {{ $aplikasi->tanggal_expired->format('d/m/Y') }}
                                        </div>
                                        @if($aplikasi->isExpiringSoon())
                                            <div class="text-xs text-amber-500">{{ $aplikasi->tanggal_expired->diffInDays(now()) }} hari lagi</div>
                                        @endif
                                        @if($aplikasi->isExpired())
                                            <div class="text-xs text-red-500">Sudah expired</div>
                                        @endif
                                    @else
                                        <span class="text-sm text-gray-400">-</span>
                                    @endif
                                </td>

                                <!-- Actions -->
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-3">
                                        <a href="{{ route('aplikasi-bmn.show', $aplikasi) }}"
                                           class="text-blue-600 hover:text-blue-900 transition-colors duration-200"
                                           title="Lihat Detail">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.aplikasi-bmn.edit', $aplikasi) }}"
                                           class="text-amber-600 hover:text-amber-900 transition-colors duration-200"
                                           title="Edit">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.aplikasi-bmn.destroy', $aplikasi) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                    onclick="confirmDelete(this.form)"
                                                    class="text-red-600 hover:text-red-900 transition-colors duration-200"
                                                    title="Hapus">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="h-16 w-16 rounded-full bg-gray-100 flex items-center justify-center mb-4">
                                            <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>
                                        <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada data aplikasi</h3>
                                        <p class="text-gray-500 mb-4">Tambahkan aplikasi pertama Anda</p>
                                        <a href="{{ route('admin.aplikasi-bmn.create') }}"
                                           class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                            Tambah Aplikasi
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($aplikasis->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $aplikasis->links() }}
                </div>
            @endif
        </div>
    </div>

    <script>
        function confirmDelete(form) {
            if (confirm('Apakah Anda yakin ingin menghapus aplikasi ini?')) {
                form.submit();
            }
        }
    </script>
</x-app-layout>
