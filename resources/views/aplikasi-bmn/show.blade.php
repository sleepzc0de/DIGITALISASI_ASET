<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('aplikasi-bmn.index') }}"
                       class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors duration-200 group">
                        <svg class="w-5 h-5 mr-1 transform group-hover:-translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Kembali ke Daftar
                    </a>
                    <div class="h-6 w-px bg-gray-300"></div>
                    <h2 class="font-bold text-2xl text-gray-900 tracking-tight">Detail Aplikasi</h2>
                </div>
                <p class="text-gray-600 mt-1">Informasi lengkap aplikasi BMN</p>
            </div>
            <div class="flex items-center space-x-3">
                @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.aplikasi-bmn.edit', $aplikasiBmn) }}"
                   class="inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white font-medium rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                </a>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Hero Section -->
        <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-3xl shadow-2xl overflow-hidden mb-8" data-aos="fade-up">
            <div class="p-8 md:p-10">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-20 h-20 rounded-2xl bg-white/10 backdrop-blur-sm p-3 shadow-lg">
                                <img src="{{ $aplikasiBmn->getLogoUrl() }}"
                                     alt="{{ $aplikasiBmn->nama_aplikasi }}"
                                     class="w-full h-full object-contain">
                            </div>
                            <div>
                                <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">{{ $aplikasiBmn->nama_aplikasi }}</h1>
                                <div class="flex flex-wrap gap-2">
                                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-white/20 text-white backdrop-blur-sm">
                                        {{ $aplikasiBmn->kategori }}
                                    </span>
                                    <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $aplikasiBmn->getStatusBadgeClass() }}">
                                        {{ $aplikasiBmn->status }}
                                    </span>
                                    @if($aplikasiBmn->versi)
                                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-white/20 text-white backdrop-blur-sm">
                                        v{{ $aplikasiBmn->versi }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if($aplikasiBmn->deskripsi)
                        <p class="text-white/90 text-lg leading-relaxed max-w-3xl">
                            {{ $aplikasiBmn->deskripsi }}
                        </p>
                        @endif
                    </div>

                    @if($aplikasiBmn->url_aplikasi)
                    <a href="{{ $aplikasiBmn->url_aplikasi }}" target="_blank"
                       class="inline-flex items-center px-6 py-3.5 bg-white text-indigo-600 hover:bg-gray-50 font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 whitespace-nowrap">
                        Buka Aplikasi
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
            <!-- Left Column - Details -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Key Information Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6" data-aos="fade-up" data-aos-delay="100">
                    <!-- Vendor Card -->
                    @if($aplikasiBmn->vendor)
                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Vendor/Penyedia</h3>
                                <p class="text-xl font-bold text-gray-900 mt-1">{{ $aplikasiBmn->vendor }}</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Users Card -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 rounded-xl bg-purple-50 flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Jumlah Pengguna</h3>
                                <p class="text-xl font-bold text-gray-900 mt-1">{{ number_format($aplikasiBmn->jumlah_user) }} Users</p>
                            </div>
                        </div>
                    </div>

                    <!-- Implementation Date -->
                    @if($aplikasiBmn->tanggal_implementasi)
                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Tanggal Implementasi</h3>
                                <p class="text-xl font-bold text-gray-900 mt-1">{{ $aplikasiBmn->tanggal_implementasi->format('d F Y') }}</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Expiry Date -->
                    @if($aplikasiBmn->tanggal_expired)
                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-shadow duration-300 {{ $aplikasiBmn->isExpiringSoon() ? 'border-amber-200 bg-gradient-to-br from-white to-amber-50' : '' }} {{ $aplikasiBmn->isExpired() ? 'border-red-200 bg-gradient-to-br from-white to-red-50' : '' }}">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 rounded-xl {{ $aplikasiBmn->isExpiringSoon() ? 'bg-amber-100' : ($aplikasiBmn->isExpired() ? 'bg-red-100' : 'bg-orange-50') }} flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 {{ $aplikasiBmn->isExpiringSoon() ? 'text-amber-600' : ($aplikasiBmn->isExpired() ? 'text-red-600' : 'text-orange-600') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium {{ $aplikasiBmn->isExpiringSoon() ? 'text-amber-700' : ($aplikasiBmn->isExpired() ? 'text-red-700' : 'text-gray-500') }} uppercase tracking-wider">Tanggal Kadaluarsa</h3>
                                <p class="text-xl font-bold {{ $aplikasiBmn->isExpiringSoon() ? 'text-amber-800' : ($aplikasiBmn->isExpired() ? 'text-red-800' : 'text-gray-900') }} mt-1">
                                    {{ $aplikasiBmn->tanggal_expired->format('d F Y') }}
                                </p>
                                @if($aplikasiBmn->isExpiringSoon())
                                <div class="mt-2 inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-amber-100 text-amber-800">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.998-.833-2.732 0L4.346 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                    </svg>
                                    {{ $aplikasiBmn->tanggal_expired->diffInDays(now()) }} hari lagi
                                </div>
                                @endif
                                @if($aplikasiBmn->isExpired())
                                <div class="mt-2 inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Sudah expired
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- License Cost -->
                    @if($aplikasiBmn->biaya_lisensi)
                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Biaya Lisensi</h3>
                                <p class="text-xl font-bold text-gray-900 mt-1">
                                    Rp {{ number_format($aplikasiBmn->biaya_lisensi, 0, ',', '.') }}
                                    @if($aplikasiBmn->periode_lisensi)
                                    <span class="text-sm text-gray-600 font-normal">/ {{ $aplikasiBmn->periode_lisensi }}</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Main Features -->
                @if($aplikasiBmn->fitur_utama)
                <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center mr-4">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Fitur Utama</h3>
                    </div>
                    <div class="prose max-w-none">
                        <div class="text-gray-700 leading-relaxed whitespace-pre-line bg-gray-50 rounded-xl p-6">
                            {{ $aplikasiBmn->fitur_utama }}
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Column - PIC & Actions -->
            <div class="space-y-8">
                <!-- PIC Section -->
                @if($aplikasiBmn->pic_nama)
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100" data-aos="fade-left" data-aos-delay="300">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-cyan-600 flex items-center justify-center mr-4">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Person In Charge (PIC)</h3>
                    </div>

                    <div class="space-y-5">
                        <!-- PIC Name -->
                        <div class="flex items-start">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center mr-3 flex-shrink-0">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Nama PIC</p>
                                <p class="font-semibold text-gray-900">{{ $aplikasiBmn->pic_nama }}</p>
                            </div>
                        </div>

                        <!-- PIC Email -->
                        @if($aplikasiBmn->pic_email)
                        <div class="flex items-start">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center mr-3 flex-shrink-0">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Email</p>
                                <a href="mailto:{{ $aplikasiBmn->pic_email }}"
                                   class="font-semibold text-blue-600 hover:text-blue-800 transition-colors duration-200">
                                    {{ $aplikasiBmn->pic_email }}
                                </a>
                            </div>
                        </div>
                        @endif

                        <!-- PIC Phone -->
                        @if($aplikasiBmn->pic_telepon)
                        <div class="flex items-start">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center mr-3 flex-shrink-0">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Telepon</p>
                                <a href="tel:{{ $aplikasiBmn->pic_telepon }}"
                                   class="font-semibold text-blue-600 hover:text-blue-800 transition-colors duration-200">
                                    {{ $aplikasiBmn->pic_telepon }}
                                </a>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Contact Button -->
                    @if($aplikasiBmn->pic_email || $aplikasiBmn->pic_telepon)
                    <div class="mt-6 pt-6 border-t border-gray-100">
                        <div class="flex gap-2">
                            @if($aplikasiBmn->pic_email)
                            <a href="mailto:{{ $aplikasiBmn->pic_email }}"
                               class="flex-1 bg-blue-50 hover:bg-blue-100 text-blue-700 hover:text-blue-800 font-medium rounded-xl py-2.5 text-sm text-center transition-all duration-300 flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                Email
                            </a>
                            @endif
                            @if($aplikasiBmn->pic_telepon)
                            <a href="tel:{{ $aplikasiBmn->pic_telepon }}"
                               class="flex-1 bg-green-50 hover:bg-green-100 text-green-700 hover:text-green-800 font-medium rounded-xl py-2.5 text-sm text-center transition-all duration-300 flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                Telepon
                            </a>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
                @endif

                <!-- Quick Stats -->
                <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-2xl shadow-xl p-6 text-white" data-aos="fade-left" data-aos-delay="400">
                    <h3 class="text-lg font-bold mb-4">Ringkasan</h3>
                    <div class="space-y-4">
                        <div>
                            <p class="text-gray-300 text-sm mb-1">Status</p>
                            <div class="flex items-center">
                                <div class="w-3 h-3 rounded-full {{ $aplikasiBmn->status == 'Aktif' ? 'bg-green-500' : ($aplikasiBmn->status == 'Maintenance' ? 'bg-yellow-500' : 'bg-red-500') }} mr-2"></div>
                                <span class="font-semibold">{{ $aplikasiBmn->status }}</span>
                            </div>
                        </div>
                        <div>
                            <p class="text-gray-300 text-sm mb-1">Kategori</p>
                            <span class="font-semibold">{{ $aplikasiBmn->kategori }}</span>
                        </div>
                        <div>
                            <p class="text-gray-300 text-sm mb-1">Jumlah User</p>
                            <span class="font-semibold">{{ number_format($aplikasiBmn->jumlah_user) }}</span>
                        </div>
                        @if($aplikasiBmn->versi)
                        <div>
                            <p class="text-gray-300 text-sm mb-1">Versi</p>
                            <span class="font-semibold">v{{ $aplikasiBmn->versi }}</span>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100" data-aos="fade-left" data-aos-delay="500">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Aksi Cepat</h3>
                    <div class="space-y-3">
                        @if($aplikasiBmn->url_aplikasi)
                        <a href="{{ $aplikasiBmn->url_aplikasi }}" target="_blank"
                           class="w-full bg-gradient-to-r from-indigo-50 to-purple-50 hover:from-indigo-100 hover:to-purple-100 text-indigo-700 hover:text-indigo-800 font-medium rounded-xl py-3 px-4 text-sm text-center transition-all duration-300 flex items-center justify-center border border-indigo-100">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                            Buka Aplikasi
                        </a>
                        @endif

                        @if(auth()->user()->isAdmin())
                        <div class="grid grid-cols-2 gap-3">
                            <a href="{{ route('admin.aplikasi-bmn.edit', $aplikasiBmn) }}"
                               class="bg-amber-50 hover:bg-amber-100 text-amber-700 hover:text-amber-800 font-medium rounded-xl py-3 px-4 text-sm text-center transition-all duration-300 flex items-center justify-center border border-amber-100">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit
                            </a>
                            <form action="{{ route('admin.aplikasi-bmn.destroy', $aplikasiBmn) }}" method="POST"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus aplikasi ini?')"
                                  class="contents">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="w-full bg-red-50 hover:bg-red-100 text-red-700 hover:text-red-800 font-medium rounded-xl py-3 px-4 text-sm text-center transition-all duration-300 flex items-center justify-center border border-red-100">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add AOS initialization -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize AOS
            AOS.init({
                duration: 600,
                once: true,
                offset: 50
            });

            // Add smooth scrolling for internal links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
    </script>
</x-app-layout>
