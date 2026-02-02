<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-3xl text-gray-900 tracking-tight">
                    {{ __('Daftar Aplikasi BMN & Pengadaan') }}
                </h2>
                <p class="text-gray-600 mt-1">Kelola dan pantau semua aplikasi BMN dalam satu dashboard</p>
            </div>
            <div class="flex items-center space-x-3">
                @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.aplikasi-bmn.create') }}"
                   class="inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-medium rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Tambah Aplikasi
                </a>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Statistics Dashboard -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10" data-aos="fade-up">
            <!-- Total Aplikasi -->
            <div class="group bg-gradient-to-br from-blue-500 via-blue-600 to-indigo-700 rounded-2xl shadow-xl p-6 text-white transform transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-medium uppercase tracking-wider mb-2">Total Aplikasi</p>
                        <h3 class="text-4xl font-bold mb-1">{{ $stats['total'] }}</h3>
                        <p class="text-blue-200 text-xs">Seluruh aplikasi terdaftar</p>
                    </div>
                    <div class="bg-white/20 rounded-2xl p-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                        </svg>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-blue-400/30">
                    <div class="flex justify-between text-sm">
                        <span class="text-blue-100">Aktif: {{ $stats['aktif'] }}</span>
                        <span class="text-blue-100">Maintenance: {{ $stats['maintenance'] }}</span>
                    </div>
                </div>
            </div>

            <!-- Aktif -->
            <div class="group bg-gradient-to-br from-emerald-500 via-emerald-600 to-green-700 rounded-2xl shadow-xl p-6 text-white transform transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-emerald-100 text-sm font-medium uppercase tracking-wider mb-2">Aplikasi Aktif</p>
                        <h3 class="text-4xl font-bold mb-1">{{ $stats['aktif'] }}</h3>
                        <p class="text-emerald-200 text-xs">{{ number_format(($stats['aktif']/$stats['total'])*100, 0) }}% dari total</p>
                    </div>
                    <div class="bg-white/20 rounded-2xl p-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-emerald-400/30">
                    <div class="w-full bg-white/20 rounded-full h-2">
                        <div class="bg-white h-2 rounded-full" style="width: {{ ($stats['aktif']/$stats['total'])*100 }}%"></div>
                    </div>
                </div>
            </div>

            <!-- Total Users -->
            <div class="group bg-gradient-to-br from-purple-500 via-purple-600 to-pink-700 rounded-2xl shadow-xl p-6 text-white transform transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm font-medium uppercase tracking-wider mb-2">Total Pengguna</p>
                        <h3 class="text-4xl font-bold mb-1">{{ number_format($stats['total_users']) }}</h3>
                        <p class="text-purple-200 text-xs">Pengguna aktif</p>
                    </div>
                    <div class="bg-white/20 rounded-2xl p-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-purple-400/30">
                    <div class="text-sm">
                        <span class="text-purple-100">Rata-rata: {{ number_format($stats['total'] > 0 ? $stats['total_users']/$stats['total'] : 0, 0) }} user/app</span>
                    </div>
                </div>
            </div>

            <!-- Expiring Soon -->
            <div class="group bg-gradient-to-br from-amber-500 via-orange-600 to-red-700 rounded-2xl shadow-xl p-6 text-white transform transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-amber-100 text-sm font-medium uppercase tracking-wider mb-2">Segera Expired</p>
                        <h3 class="text-4xl font-bold mb-1">{{ $stats['expiring_soon'] }}</h3>
                        <p class="text-amber-200 text-xs">Dalam 30 hari ke depan</p>
                    </div>
                    <div class="bg-white/20 rounded-2xl p-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                @if($stats['expiring_soon'] > 0)
                <div class="mt-4 pt-4 border-t border-amber-400/30">
                    <div class="text-sm">
                        <span class="text-amber-100 font-medium">Perlu perhatian segera!</span>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Filter & Search Section -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg p-6 mb-8 border border-gray-200/50" data-aos="fade-up" data-aos-delay="100">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Filter & Pencarian</h3>
                    <p class="text-gray-600 text-sm">Temukan aplikasi sesuai kebutuhan</p>
                </div>
                <div class="text-sm text-gray-500">
                    Menampilkan {{ $aplikasis->total() }} aplikasi
                </div>
            </div>

            <form method="GET" action="{{ route('aplikasi-bmn.index') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                    <!-- Search Input -->
                    <div class="md:col-span-5">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <input type="text" name="search" value="{{ $search }}"
                                placeholder="Cari aplikasi, vendor, deskripsi..."
                                class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-all duration-200">
                        </div>
                    </div>

                    <!-- Kategori Filter -->
                    <div class="md:col-span-3">
                        <select name="kategori"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-all duration-200 appearance-none bg-white">
                            <option value="">Semua Kategori</option>
                            <option value="BMN" {{ $kategori == 'BMN' ? 'selected' : '' }}>BMN</option>
                            <option value="Pengadaan" {{ $kategori == 'Pengadaan' ? 'selected' : '' }}>Pengadaan</option>
                            <option value="Inventaris" {{ $kategori == 'Inventaris' ? 'selected' : '' }}>Inventaris</option>
                            <option value="Monitoring" {{ $kategori == 'Monitoring' ? 'selected' : '' }}>Monitoring</option>
                        </select>
                    </div>

                    <!-- Status Filter -->
                    <div class="md:col-span-3">
                        <select name="status"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-all duration-200 appearance-none bg-white">
                            <option value="">Semua Status</option>
                            <option value="Aktif" {{ $status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Maintenance" {{ $status == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                            <option value="Non-Aktif" {{ $status == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
                        </select>
                    </div>

                    <!-- Action Buttons -->
                    <div class="md:col-span-1 flex gap-2">
                        <button type="submit"
                            class="flex-1 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-medium rounded-xl shadow hover:shadow-lg transition-all duration-300 px-4 py-3 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                            </svg>
                        </button>
                        <a href="{{ route('aplikasi-bmn.index') }}"
                            class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-xl shadow hover:shadow-lg transition-all duration-300 px-4 py-3 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Aplikasi Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-10">
            @forelse($aplikasis as $aplikasi)
                <div class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-100"
                     data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                    <!-- Card Header with Logo -->
                    <div class="relative h-32 bg-gradient-to-br {{ $aplikasi->getKategoriGradient() }} overflow-hidden">
                        <div class="absolute inset-0 bg-black/10"></div>
                        <div class="absolute -right-6 -top-6 w-24 h-24 rounded-full bg-white/10"></div>
                        <div class="absolute -left-6 -bottom-6 w-24 h-24 rounded-full bg-white/10"></div>

                        <!-- Logo Container -->
                        <div class="absolute bottom-4 left-4 w-16 h-16 rounded-xl bg-white shadow-lg p-2 transform group-hover:scale-110 transition-transform duration-300">
                            <img src="{{ $aplikasi->getLogoUrl() }}"
                                 alt="{{ $aplikasi->nama_aplikasi }}"
                                 class="w-full h-full object-contain rounded-lg">
                        </div>

                        <!-- Status Badge -->
                        <div class="absolute top-4 right-4">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $aplikasi->getStatusBadgeClass() }} shadow">
                                {{ $aplikasi->status }}
                            </span>
                        </div>
                    </div>

                    <!-- Card Content -->
                    <div class="p-6">
                        <!-- Kategori Badge -->
                        <div class="mb-3">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $aplikasi->getKategoriBadgeClass() }}">
                                {{ $aplikasi->kategori }}
                            </span>
                        </div>

                        <!-- App Name -->
                        <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors duration-300">
                            {{ $aplikasi->nama_aplikasi }}
                        </h3>

                        <!-- Description -->
                        <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                            {{ $aplikasi->deskripsi ?? 'Tidak ada deskripsi' }}
                        </p>

                        <!-- App Details -->
                        <div class="space-y-3 mb-6">
                            @if($aplikasi->vendor)
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                <span class="truncate">{{ $aplikasi->vendor }}</span>
                            </div>
                            @endif

                            <div class="flex items-center justify-between">
                                <div class="flex items-center text-sm text-gray-600">
                                    <svg class="w-4 h-4 mr-2 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                    </svg>
                                    <span>{{ number_format($aplikasi->jumlah_user) }} Users</span>
                                </div>

                                @if($aplikasi->versi)
                                <div class="text-xs text-gray-500 font-medium">
                                    v{{ $aplikasi->versi }}
                                </div>
                                @endif
                            </div>

                            @if($aplikasi->tanggal_expired)
                            <div class="flex items-center justify-between">
                                <div class="flex items-center text-sm {{ $aplikasi->isExpiringSoon() ? 'text-amber-600 font-semibold' : '' }} {{ $aplikasi->isExpired() ? 'text-red-600 font-semibold' : '' }}">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span>Exp: {{ $aplikasi->tanggal_expired->format('d/m/Y') }}</span>
                                </div>
                                @if($aplikasi->isExpiringSoon())
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.998-.833-2.732 0L4.346 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                    </svg>
                                    Segera
                                </span>
                                @endif
                            </div>
                            @endif
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-2 pt-4 border-t border-gray-100">
                            <a href="{{ route('aplikasi-bmn.show', $aplikasi) }}"
                               class="flex-1 bg-gradient-to-r from-blue-50 to-blue-100 hover:from-blue-100 hover:to-blue-200 text-blue-700 hover:text-blue-800 font-medium rounded-xl py-2.5 text-sm text-center transition-all duration-300 group-hover:shadow-md flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Detail
                            </a>

                            @if($aplikasi->url_aplikasi)
                            <a href="{{ $aplikasi->url_aplikasi }}" target="_blank"
                               class="w-12 bg-gray-50 hover:bg-gray-100 text-gray-700 hover:text-blue-600 rounded-xl py-2.5 flex items-center justify-center transition-all duration-300 group-hover:shadow-md">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-16" data-aos="fade-up">
                    <div class="max-w-md mx-auto">
                        <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gray-100 flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Tidak ada data aplikasi</h3>
                        <p class="text-gray-600 mb-6">Tidak ada aplikasi yang sesuai dengan filter Anda</p>
                        <a href="{{ route('aplikasi-bmn.index') }}"
                           class="inline-flex items-center px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-xl shadow hover:shadow-lg transition-all duration-300">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            Reset Filter
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($aplikasis->hasPages())
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-10" data-aos="fade-up">
            {{ $aplikasis->links('vendor.pagination.tailwind') }}
        </div>
        @endif
    </div>

    <!-- Add these methods to your AplikasiBMN model -->
    @push('scripts')
    <script>
        // Add hover effects and interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Add click animation to cards
            const cards = document.querySelectorAll('.group.bg-white.rounded-2xl');
            cards.forEach(card => {
                card.addEventListener('click', function(e) {
                    if (!e.target.closest('a')) {
                        const detailLink = this.querySelector('a[href*="show"]');
                        if (detailLink) {
                            detailLink.click();
                        }
                    }
                });
            });
        });
    </script>
    @endpush
</x-app-layout>
