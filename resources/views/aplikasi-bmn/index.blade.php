<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Daftar Aplikasi BMN dan Pengadaan') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Aplikasi -->
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-medium uppercase tracking-wide">Total Aplikasi</p>
                        <h3 class="text-3xl font-bold mt-2">{{ $stats['total'] }}</h3>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Aktif -->
            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl shadow-xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm font-medium uppercase tracking-wide">Aplikasi Aktif</p>
                        <h3 class="text-3xl font-bold mt-2">{{ $stats['aktif'] }}</h3>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Users -->
            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm font-medium uppercase tracking-wide">Total Pengguna</p>
                        <h3 class="text-3xl font-bold mt-2">{{ number_format($stats['total_users']) }}</h3>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Expiring Soon -->
            <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl shadow-xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-orange-100 text-sm font-medium uppercase tracking-wide">Segera Expired</p>
                        <h3 class="text-3xl font-bold mt-2">{{ $stats['expiring_soon'] }}</h3>
                        <p class="text-orange-100 text-xs mt-1">Dalam 30 hari</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter & Search -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
            <form method="GET" action="{{ route('aplikasi-bmn.index') }}"
                class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Search -->
                <div class="md:col-span-2">
                    <input type="text" name="search" value="{{ $search }}"
                        placeholder="Cari aplikasi, vendor..."
                        class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <!-- Kategori Filter -->
                <div>
                    <select name="kategori"
                        class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Semua Kategori</option>
                        <option value="BMN" {{ $kategori == 'BMN' ? 'selected' : '' }}>BMN</option>
                        <option value="Pengadaan" {{ $kategori == 'Pengadaan' ? 'selected' : '' }}>Pengadaan</option>
                        <option value="Inventaris" {{ $kategori == 'Inventaris' ? 'selected' : '' }}>Inventaris</option>
                        <option value="Monitoring" {{ $kategori == 'Monitoring' ? 'selected' : '' }}>Monitoring
                        </option>
                    </select>
                </div>

                <!-- Status Filter -->
                <div class="flex gap-2">
                    <select name="status"
                        class="flex-1 rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Semua Status</option>
                        <option value="Aktif" {{ $status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Maintenance" {{ $status == 'Maintenance' ? 'selected' : '' }}>Maintenance
                        </option>
                        <option value="Non-Aktif" {{ $status == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
                    </select>
                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                        Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Aplikasi Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @forelse($aplikasis as $aplikasi)
                <div
                    class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <!-- Header dengan Logo -->
                    <div class="bg-gradient-to-br from-indigo-500 to-purple-600 p-6 text-center">
                        <img src="{{ $aplikasi->getLogoUrl() }}" alt="{{ $aplikasi->nama_aplikasi }}"
                            class="w-20 h-20 mx-auto rounded-xl shadow-lg bg-white p-2">
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-3">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $aplikasi->nama_aplikasi }}</h3>
                            <span
                                class="px-2 py-1 text-xs font-semibold rounded-full {{ $aplikasi->getStatusBadgeClass() }}">
                                {{ $aplikasi->status }}
                            </span>
                        </div>

                        <span
                            class="inline-block px-2 py-1 text-xs font-semibold rounded-full {{ $aplikasi->getKategoriBadgeClass() }} mb-3">
                            {{ $aplikasi->kategori }}
                        </span>

                        <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                            {{ $aplikasi->deskripsi ?? 'Tidak ada deskripsi' }}
                        </p>

                        <div class="space-y-2 text-sm text-gray-600 mb-4">
                            @if ($aplikasi->vendor)
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                    <span>{{ $aplikasi->vendor }}</span>
                                </div>
                            @endif

                            @if ($aplikasi->versi)
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                    <span>v{{ $aplikasi->versi }}</span>
                                </div>
                            @endif

                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <span>{{ number_format($aplikasi->jumlah_user) }} Users</span>
                            </div>

                            @if ($aplikasi->tanggal_expired)
                                <div
                                    class="flex items-center {{ $aplikasi->isExpiringSoon() ? 'text-orange-600 font-medium' : '' }} {{ $aplikasi->isExpired() ? 'text-red-600 font-medium' : '' }}">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>Expired: {{ $aplikasi->tanggal_expired->format('d M Y') }}</span>
                                </div>
                            @endif
                        </div>

                        <div class="flex gap-2">
                            <a href="{{ route('aplikasi-bmn.show', $aplikasi) }}"
                                class="flex-1 text-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition text-sm font-medium">
                                Detail
                            </a>
                            @if ($aplikasi->url_aplikasi)
                                <a href="{{ $aplikasi->url_aplikasi }}" target="_blank"
                                    class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition text-sm font-medium">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <p class="text-gray-500">Tidak ada data aplikasi ditemukan</p>
                </div>
            @endforelse
        </div> <!-- Pagination -->
        <div class="mb-8">
            {{ $aplikasis->links() }}
        </div>
    </div>
</x-app-layout>
