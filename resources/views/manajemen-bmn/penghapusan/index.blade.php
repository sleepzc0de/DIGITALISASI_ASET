<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-3xl font-bold text-gray-900 leading-tight">
                    {{ __('Penghapusan BMN - SK Penghapusan') }}
                </h2>
                <p class="text-gray-600 mt-1">Kelola Surat Keputusan Penghapusan Barang Milik Negara</p>
            </div>
            <div class="flex items-center space-x-3">
                <button onclick="window.print()" class="btn-secondary flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Cetak
                </button>
            </div>
        </div>
    </x-slot>

    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Statistics Cards with Animation -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10" data-aos="fade-up">
            <div
                class="bg-gradient-to-br from-blue-500 via-blue-600 to-blue-700 rounded-2xl shadow-xl p-6 text-white transform transition-all duration-300 hover:scale-[1.02] hover:shadow-2xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-medium uppercase tracking-wider">Total SK</p>
                        <h3 class="text-4xl font-bold mt-3 animate-pulse-slow">{{ $stats['total'] }}</h3>
                        <p class="text-blue-200 text-sm mt-2">Surat Keputusan</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-4 backdrop-blur-sm">
                        <svg class="w-8 h-8 transform transition-transform duration-300 group-hover:rotate-12"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-blue-400/30">
                    <div class="flex justify-between text-sm">
                        <span class="text-blue-200">Bulan Ini</span>
                        <span class="font-semibold">+12%</span>
                    </div>
                </div>
            </div>

            <div
                class="bg-gradient-to-br from-emerald-500 via-emerald-600 to-emerald-700 rounded-2xl shadow-xl p-6 text-white transform transition-all duration-300 hover:scale-[1.02] hover:shadow-2xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-emerald-100 text-sm font-medium uppercase tracking-wider">Selesai</p>
                        <h3 class="text-4xl font-bold mt-3">{{ $stats['selesai'] }}</h3>
                        <p class="text-emerald-200 text-sm mt-2">Penghapusan Tuntas</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-4 backdrop-blur-sm">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-emerald-400/30">
                    <div class="flex justify-between text-sm">
                        <span class="text-emerald-200">Completion Rate</span>
                        <span
                            class="font-semibold">{{ $stats['total'] > 0 ? round(($stats['selesai'] / $stats['total']) * 100, 1) : 0 }}%</span>
                    </div>
                </div>
            </div>

            <div
                class="bg-gradient-to-br from-amber-500 via-amber-600 to-amber-700 rounded-2xl shadow-xl p-6 text-white transform transition-all duration-300 hover:scale-[1.02] hover:shadow-2xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-amber-100 text-sm font-medium uppercase tracking-wider">Dalam Proses</p>
                        <h3 class="text-4xl font-bold mt-3">{{ $stats['proses'] }}</h3>
                        <p class="text-amber-200 text-sm mt-2">Sedang Diproses</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-4 backdrop-blur-sm">
                        <svg class="w-8 h-8 animate-spin-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-amber-400/30">
                    <div class="flex justify-between text-sm">
                        <span class="text-amber-200">Proses Aktif</span>
                        <span
                            class="font-semibold">{{ $stats['total'] > 0 ? round(($stats['proses'] / $stats['total']) * 100, 1) : 0 }}%</span>
                    </div>
                </div>
            </div>

            <div
                class="bg-gradient-to-br from-rose-500 via-rose-600 to-rose-700 rounded-2xl shadow-xl p-6 text-white transform transition-all duration-300 hover:scale-[1.02] hover:shadow-2xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-rose-100 text-sm font-medium uppercase tracking-wider">Total Unit</p>
                        <h3 class="text-4xl font-bold mt-3">{{ number_format($stats['total_unit']) }}</h3>
                        <p class="text-rose-200 text-sm mt-2">Unit BMN</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-4 backdrop-blur-sm">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-rose-400/30">
                    <div class="flex justify-between text-sm">
                        <span class="text-rose-200">Total Nilai</span>
                        <span class="font-semibold">Rp {{ number_format($stats['total_nilai'], 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="bg-white rounded-2xl shadow-soft p-6 mb-8 border border-gray-100" data-aos="fade-up"
            data-aos-delay="100">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Filter Data</h3>
                    <p class="text-gray-500 text-sm">Saring data berdasarkan kriteria tertentu</p>
                </div>
                <button id="resetFilter" class="text-sm text-gray-600 hover:text-blue-600 transition-colors">
                    Reset Filter
                </button>
            </div>
            <form method="GET" action="{{ route('manajemen-bmn.penghapusan.index') }}"
                class="grid grid-cols-1 md:grid-cols-4 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alasan Penghapusan</label>
                    <select name="alasan"
                        class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition-all duration-200 hover:border-gray-400">
                        <option value="">Semua Alasan</option>
                        <option value="Rusak Berat" {{ request('alasan') == 'Rusak Berat' ? 'selected' : '' }}>Rusak
                            Berat</option>
                        <option value="Hilang" {{ request('alasan') == 'Hilang' ? 'selected' : '' }}>Hilang</option>
                        <option value="Kadaluarsa" {{ request('alasan') == 'Kadaluarsa' ? 'selected' : '' }}>
                            Kadaluarsa</option>
                        <option value="Tidak Ekonomis" {{ request('alasan') == 'Tidak Ekonomis' ? 'selected' : '' }}>
                            Tidak Ekonomis</option>
                        <option value="Force Majeure" {{ request('alasan') == 'Force Majeure' ? 'selected' : '' }}>
                            Force Majeure</option>
                        <option value="Lainnya" {{ request('alasan') == 'Lainnya' ? 'selected' : '' }}>Lainnya
                        </option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status"
                        class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition-all duration-200 hover:border-gray-400">
                        <option value="">Semua Status</option>
                        <option value="Draft" {{ request('status') == 'Draft' ? 'selected' : '' }}>Draft</option>
                        <option value="Proses" {{ request('status') == 'Proses' ? 'selected' : '' }}>Proses</option>
                        <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai
                        </option>
                        <option value="Dibatalkan" {{ request('status') == 'Dibatalkan' ? 'selected' : '' }}>
                            Dibatalkan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Urutkan</label>
                    <select name="sort"
                        class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition-all duration-200 hover:border-gray-400">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                        <option value="nilai_tertinggi" {{ request('sort') == 'nilai_tertinggi' ? 'selected' : '' }}>
                            Nilai Tertinggi</option>
                        <option value="nilai_terendah" {{ request('sort') == 'nilai_terendah' ? 'selected' : '' }}>
                            Nilai Terendah</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit"
                        class="w-full px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-medium rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                        <div class="flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            Terapkan Filter
                        </div>
                    </button>
                </div>
            </form>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100" data-aos="fade-up"
            data-aos-delay="200">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Daftar SK Penghapusan</h3>
                        <p class="text-gray-500 text-sm mt-1">Total {{ $penghapusans->total() }} data ditemukan</p>
                    </div>
                    <div class="text-sm text-gray-600">
                        {{ $penghapusans->firstItem() ?? 0 }}-{{ $penghapusans->lastItem() ?? 0 }} dari
                        {{ $penghapusans->total() }}
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider bg-gradient-to-r from-gray-100 to-gray-50">
                                <div class="flex items-center">
                                    <span>Nomor SK</span>
                                    <svg class="w-4 h-4 ml-1 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                    </svg>
                                </div>
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider bg-gradient-to-r from-gray-100 to-gray-50">
                                Detail Aset
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider bg-gradient-to-r from-gray-100 to-gray-50">
                                Alasan
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider bg-gradient-to-r from-gray-100 to-gray-50">
                                Jumlah & Nilai
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider bg-gradient-to-r from-gray-100 to-gray-50">
                                Timeline
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider bg-gradient-to-r from-gray-100 to-gray-50">
                                Status
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider bg-gradient-to-r from-gray-100 to-gray-50">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($penghapusans as $penghapusan)
                            <tr
                                class="hover:bg-gradient-to-r hover:from-blue-50/50 hover:to-white transition-all duration-200 group">
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div
                                        class="font-mono font-bold text-gray-900 group-hover:text-blue-600 transition-colors">
                                        {{ $penghapusan->nomor_sk }}
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="font-medium text-gray-900 group-hover:text-gray-700 transition-colors">
                                        {{ Str::limit($penghapusan->nama_aset, 35) }}
                                    </div>
                                    @if ($penghapusan->kode_barang)
                                        <div
                                            class="text-xs text-gray-500 mt-1 bg-gray-50 px-2 py-1 rounded-lg inline-block">
                                            {{ $penghapusan->kode_barang }}
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium {{ $penghapusan->alasan_penghapusan == 'Rusak Berat'
                                            ? 'bg-red-100 text-red-800 border border-red-200'
                                            : ($penghapusan->alasan_penghapusan == 'Hilang'
                                                ? 'bg-orange-100 text-orange-800 border border-orange-200'
                                                : ($penghapusan->alasan_penghapusan == 'Kadaluarsa'
                                                    ? 'bg-yellow-100 text-yellow-800 border border-yellow-200'
                                                    : ($penghapusan->alasan_penghapusan == 'Tidak Ekonomis'
                                                        ? 'bg-blue-100 text-blue-800 border border-blue-200'
                                                        : ($penghapusan->alasan_penghapusan == 'Force Majeure'
                                                            ? 'bg-purple-100 text-purple-800 border border-purple-200'
                                                            : 'bg-gray-100 text-gray-800 border border-gray-200')))) }}">
                                        @if ($penghapusan->alasan_penghapusan == 'Rusak Berat')
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.312 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                            </svg>
                                        @elseif($penghapusan->alasan_penghapusan == 'Hilang')
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        @endif
                                        {{ $penghapusan->alasan_penghapusan }}
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="font-bold text-gray-900">
                                        {{ number_format($penghapusan->jumlah_unit) }} unit</div>
                                    <div class="text-sm text-gray-600 mt-1">Rp
                                        {{ number_format($penghapusan->nilai_buku, 0, ',', '.') }}</div>
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 font-medium">
                                        {{ $penghapusan->tanggal_sk->format('d M Y') }}</div>
                                    <div class="text-xs text-gray-500 mt-1">SK Ditetapkan</div>
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="relative">
                                            <span
                                                class="px-3 py-1.5 inline-flex text-xs leading-5 font-semibold rounded-full {{ $penghapusan->getStatusBadgeClass() }} border border-opacity-50 shadow-sm">
                                                {{ $penghapusan->status }}
                                            </span>
                                            @if ($penghapusan->status == 'Proses')
                                                <span
                                                    class="absolute -top-1 -right-1 h-3 w-3 bg-yellow-500 rounded-full animate-pulse"></span>
                                            @elseif($penghapusan->status == 'Selesai')
                                                <span
                                                    class="absolute -top-1 -right-1 h-3 w-3 bg-green-500 rounded-full"></span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="flex items-center space-x-3">
                                        <a href="{{ route('manajemen-bmn.penghapusan.show', $penghapusan) }}"
                                            class="text-blue-600 hover:text-blue-800 transition-colors group/action">
                                            <div class="flex items-center">
                                                <svg class="w-5 h-5 mr-1.5 group-hover/action:scale-110 transition-transform"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                <span class="font-medium">Detail</span>
                                            </div>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="text-gray-400">
                                        <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <p class="text-lg font-medium text-gray-600">Tidak ada data penghapusan BMN</p>
                                        <p class="text-gray-500 mt-1">Mulai dengan menambahkan data penghapusan baru
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50/50">
                <div class="flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0">
                    <div class="text-sm text-gray-700">
                        Menampilkan <span class="font-medium">{{ $penghapusans->firstItem() }}</span> sampai
                        <span class="font-medium">{{ $penghapusans->lastItem() }}</span> dari
                        <span class="font-medium">{{ $penghapusans->total() }}</span> hasil
                    </div>

                    @if ($penghapusans->hasPages())
                        <div class="flex items-center space-x-2">
                            <!-- Previous Page Link -->
                            @if ($penghapusans->onFirstPage())
                                <span
                                    class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                                    ← Previous
                                </span>
                            @else
                                <a href="{{ $penghapusans->previousPageUrl() }}"
                                    class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:shadow transition-all duration-200">
                                    ← Previous
                                </a>
                            @endif

                            <!-- Page Numbers -->
                            <div class="flex items-center space-x-1">
                                @php
                                    $current = $penghapusans->currentPage();
                                    $total = $penghapusans->lastPage();

                                    // Show first page, current page, last page, and pages around current
                                    $start = max(1, $current - 1);
                                    $end = min($total, $current + 1);
                                @endphp

                                @if ($start > 1)
                                    <a href="{{ $penghapusans->url(1) }}"
                                        class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                                        1
                                    </a>
                                    @if ($start > 2)
                                        <span class="px-2 py-2 text-gray-400">...</span>
                                    @endif
                                @endif

                                @for ($i = $start; $i <= $end; $i++)
                                    @if ($i == $current)
                                        <span
                                            class="px-3 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg">
                                            {{ $i }}
                                        </span>
                                    @else
                                        <a href="{{ $penghapusans->url($i) }}"
                                            class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                                            {{ $i }}
                                        </a>
                                    @endif
                                @endfor

                                @if ($end < $total)
                                    @if ($end < $total - 1)
                                        <span class="px-2 py-2 text-gray-400">...</span>
                                    @endif
                                    <a href="{{ $penghapusans->url($total) }}"
                                        class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                                        {{ $total }}
                                    </a>
                                @endif
                            </div>

                            <!-- Next Page Link -->
                            @if ($penghapusans->hasMorePages())
                                <a href="{{ $penghapusans->nextPageUrl() }}"
                                    class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:shadow transition-all duration-200">
                                    Next →
                                </a>
                            @else
                                <span
                                    class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                                    Next →
                                </span>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        // Reset Filter
        document.getElementById('resetFilter').addEventListener('click', function() {
            window.location.href = "{{ route('manajemen-bmn.penghapusan.index') }}";
        });

        // Table row hover effect enhancement
        document.querySelectorAll('tbody tr').forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.transform = 'translateX(4px)';
                this.style.boxShadow = '0 4px 12px rgba(0,0,0,0.05)';
            });
            row.addEventListener('mouseleave', function() {
                this.style.transform = 'translateX(0)';
                this.style.boxShadow = 'none';
            });
        });
    </script>

    <style>
        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .page-item.active .page-link {
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            color: white;
            border-color: #3b82f6;
        }

        .page-link {
            padding: 0.5rem 1rem;
            margin: 0 0.25rem;
            border-radius: 0.75rem;
            border: 1px solid #e5e7eb;
            color: #4b5563;
            transition: all 0.2s;
        }

        .page-link:hover {
            background-color: #f3f4f6;
            border-color: #d1d5db;
        }
    </style>
</x-app-layout>
