<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Detail Aplikasi') }}
            </h2>
            <a href="{{ route('aplikasi-bmn.index') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">
                ← Kembali ke Daftar
            </a>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Header Section -->
            <div class="bg-gradient-to-br from-indigo-500 to-purple-600 p-8 text-white">
                <div class="flex items-center gap-6">
                    <img src="{{ $aplikasiBmn->getLogoUrl() }}" alt="{{ $aplikasiBmn->nama_aplikasi }}"
                        class="w-24 h-24 rounded-2xl shadow-lg bg-white p-3">
                    <div class="flex-1">
                        <h1 class="text-3xl font-bold mb-2">{{ $aplikasiBmn->nama_aplikasi }}</h1>
                        <div class="flex gap-2">
                            <span class="px-3 py-1 text-sm font-semibold rounded-full bg-white bg-opacity-20">
                                {{ $aplikasiBmn->kategori }}
                            </span>
                            <span class="px-3 py-1 text-sm font-semibold rounded-full
                                {{ $aplikasiBmn->status == 'Aktif' ? 'bg-green-400 text-green-900' : '' }}
                                {{ $aplikasiBmn->status == 'Maintenance' ? 'bg-yellow-400 text-yellow-900' : '' }}
                                {{ $aplikasiBmn->status == 'Non-Aktif' ? 'bg-red-400 text-red-900' : '' }}">
                                {{ $aplikasiBmn->status }}
                            </span>
                            @if($aplikasiBmn->versi)
                            <span class="px-3 py-1 text-sm font-semibold rounded-full bg-white bg-opacity-20">
                                v{{ $aplikasiBmn->versi }}
                            </span>
                            @endif
                        </div>
                    </div>
                    @if($aplikasiBmn->url_aplikasi)
                    <a href="{{ $aplikasiBmn->url_aplikasi }}" target="_blank"
                        class="px-6 py-3 bg-white text-indigo-600 rounded-lg hover:bg-gray-100 transition font-semibold flex items-center gap-2">
                        Buka Aplikasi
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                    @endif
                </div>
            </div>

            <!-- Content Section -->
            <div class="p-8">
                <!-- Deskripsi -->
                @if($aplikasiBmn->deskripsi)
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Deskripsi</h3>
                    <p class="text-gray-700 leading-relaxed">{{ $aplikasiBmn->deskripsi }}</p>
                </div>
                @endif

                <!-- Info Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Vendor Info -->
                    @if($aplikasiBmn->vendor)
                    <div class="bg-gray-50 rounded-xl p-5">
                        <h4 class="text-sm font-medium text-gray-500 mb-2">Vendor/Penyedia</h4>
                        <p class="text-lg font-semibold text-gray-900">{{ $aplikasiBmn->vendor }}</p>
                    </div>
                    @endif

                    <!-- Jumlah User -->
                    <div class="bg-gray-50 rounded-xl p-5">
                        <h4 class="text-sm font-medium text-gray-500 mb-2">Jumlah Pengguna</h4>
                        <p class="text-lg font-semibold text-gray-900">{{ number_format($aplikasiBmn->jumlah_user) }} Users</p>
                    </div>

                    <!-- Tanggal Implementasi -->
                    @if($aplikasiBmn->tanggal_implementasi)
                    <div class="bg-gray-50 rounded-xl p-5">
                        <h4 class="text-sm font-medium text-gray-500 mb-2">Tanggal Implementasi</h4>
                        <p class="text-lg font-semibold text-gray-900">{{ $aplikasiBmn->tanggal_implementasi->format('d F Y') }}</p>
                    </div>
                    @endif

                    <!-- Tanggal Expired -->
                    @if($aplikasiBmn->tanggal_expired)
                    <div class="bg-gray-50 rounded-xl p-5">
                        <h4 class="text-sm font-medium text-gray-500 mb-2">Tanggal Kadaluarsa</h4>
                        <p class="text-lg font-semibold {{ $aplikasiBmn->isExpiringSoon() ? 'text-orange-600' : 'text-gray-900' }} {{ $aplikasiBmn->isExpired() ? 'text-red-600' : '' }}">
                            {{ $aplikasiBmn->tanggal_expired->format('d F Y') }}
                            @if($aplikasiBmn->isExpiringSoon())
                                <span class="text-sm">({{ $aplikasiBmn->tanggal_expired->diffInDays(now()) }} hari lagi)</span>
                            @endif
                            @if($aplikasiBmn->isExpired())
                                <span class="text-sm">(Sudah expired)</span>
                            @endif
                        </p>
                    </div>
                    @endif

                    <!-- Biaya Lisensi -->
                    @if($aplikasiBmn->biaya_lisensi)
                    <div class="bg-gray-50 rounded-xl p-5">
                        <h4 class="text-sm font-medium text-gray-500 mb-2">Biaya Lisensi</h4>
                        <p class="text-lg font-semibold text-gray-900">
                            Rp {{ number_format($aplikasiBmn->biaya_lisensi, 0, ',', '.') }}
                            @if($aplikasiBmn->periode_lisensi)
                                <span class="text-sm text-gray-600">/ {{ $aplikasiBmn->periode_lisensi }}</span>
                            @endif
                        </p>
                    </div>
                    @endif
                </div>

                <!-- PIC Section -->
                @if($aplikasiBmn->pic_nama)
                <div class="border-t border-gray-200 pt-6 mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Person In Charge (PIC)</h3>
                    <div class="bg-blue-50 rounded-xl p-5">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <h4 class="text-sm font-medium text-gray-600 mb-1">Nama</h4>
                                <p class="font-semibold text-gray-900">{{ $aplikasiBmn->pic_nama }}</p>
                            </div>
                            @if($aplikasiBmn->pic_email)
                            <div>
                                <h4 class="text-sm font-medium text-gray-600 mb-1">Email</h4>
                                <a href="mailto:{{ $aplikasiBmn->pic_email }}" class="font-semibold text-indigo-600 hover:text-indigo-800">
                                    {{ $aplikasiBmn->pic_email }}
                                </a>
                            </div>
                            @endif
                            @if($aplikasiBmn->pic_telepon)
                            <div>
                                <h4 class="text-sm font-medium text-gray-600 mb-1">Telepon</h4>
                                <a href="tel:{{ $aplikasiBmn->pic_telepon }}" class="font-semibold text-indigo-600 hover:text-indigo-800">
                                    {{ $aplikasiBmn->pic_telepon }}
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endif

                <!-- Fitur Utama -->
                @if($aplikasiBmn->fitur_utama)
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Fitur Utama</h3>
                    <div class="prose max-w-none">
                        <p class="text-gray-700 whitespace-pre-line">{{ $aplikasiBmn->fitur_utama }}</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
