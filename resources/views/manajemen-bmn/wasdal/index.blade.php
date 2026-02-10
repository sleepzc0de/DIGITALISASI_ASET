<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-3xl text-gray-900 leading-tight tracking-tight">
                    {{ __('Wasdal BMN - Pelaporan & Sensus') }}
                </h2>
                <p class="mt-2 text-gray-600">Manajemen pengawasan dan pengendalian aset BMN</p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="#" class="btn-primary flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Laporan Baru
                </a>
            </div>
        </div>
    </x-slot>

    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <!-- Statistics Cards dengan animasi -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8" data-aos="fade-up">
            <!-- Total Laporan -->
            <div class="bg-gradient-to-br from-blue-500 via-blue-600 to-blue-700 rounded-2xl shadow-xl p-6 text-white transform transition-all duration-300 hover:scale-[1.02] hover:shadow-2xl group">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-medium uppercase tracking-wider mb-2">Total Laporan</p>
                        <h3 class="text-4xl font-bold mb-2">{{ $stats['total'] }}</h3>
                        <p class="text-blue-200 text-sm">Semua jenis laporan</p>
                    </div>
                    <div class="bg-white/20 rounded-2xl p-4 group-hover:rotate-12 transition-transform duration-300">
                        <div class="bg-white/30 rounded-full p-2">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-white/20">
                    <div class="flex items-center text-blue-200 text-sm">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                        <span>Trend: +12% dari bulan lalu</span>
                    </div>
                </div>
            </div>

            <!-- Pelaporan BMN -->
            <div class="bg-gradient-to-br from-emerald-500 via-emerald-600 to-emerald-700 rounded-2xl shadow-xl p-6 text-white transform transition-all duration-300 hover:scale-[1.02] hover:shadow-2xl group">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-emerald-100 text-sm font-medium uppercase tracking-wider mb-2">Pelaporan BMN</p>
                        <h3 class="text-4xl font-bold mb-2">{{ $stats['pelaporan'] }}</h3>
                        <p class="text-emerald-200 text-sm">Laporan rutin periodik</p>
                    </div>
                    <div class="bg-white/20 rounded-2xl p-4 group-hover:rotate-12 transition-transform duration-300">
                        <div class="bg-white/30 rounded-full p-2">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-white/20">
                    <div class="flex items-center text-emerald-200 text-sm">
                        @php
                            $pelaporanPercentage = ($stats['total'] > 0) ? round(($stats['pelaporan']/$stats['total'])*100, 0) : 0;
                        @endphp
                        <span class="px-2 py-1 rounded-full bg-white/20 text-xs">{{ $pelaporanPercentage }}% dari total</span>
                    </div>
                </div>
            </div>

            <!-- Sensus BMN -->
            <div class="bg-gradient-to-br from-violet-500 via-violet-600 to-violet-700 rounded-2xl shadow-xl p-6 text-white transform transition-all duration-300 hover:scale-[1.02] hover:shadow-2xl group">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-violet-100 text-sm font-medium uppercase tracking-wider mb-2">Sensus BMN</p>
                        <h3 class="text-4xl font-bold mb-2">{{ $stats['sensus'] }}</h3>
                        <p class="text-violet-200 text-sm">Audit fisik aset</p>
                    </div>
                    <div class="bg-white/20 rounded-2xl p-4 group-hover:rotate-12 transition-transform duration-300">
                        <div class="bg-white/30 rounded-full p-2">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-white/20">
                    <div class="flex items-center text-violet-200 text-sm">
                        @php
                            $sensusPercentage = ($stats['total'] > 0) ? round(($stats['sensus']/$stats['total'])*100, 0) : 0;
                        @endphp
                        <span class="px-2 py-1 rounded-full bg-white/20 text-xs">{{ $sensusPercentage }}% dari total</span>
                    </div>
                </div>
            </div>

            <!-- Approved -->
            <div class="bg-gradient-to-br from-amber-500 via-amber-600 to-amber-700 rounded-2xl shadow-xl p-6 text-white transform transition-all duration-300 hover:scale-[1.02] hover:shadow-2xl group">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-amber-100 text-sm font-medium uppercase tracking-wider mb-2">Approved</p>
                        <h3 class="text-4xl font-bold mb-2">{{ $stats['approved'] }}</h3>
                        <p class="text-amber-200 text-sm">Laporan disetujui</p>
                    </div>
                    <div class="bg-white/20 rounded-2xl p-4 group-hover:rotate-12 transition-transform duration-300">
                        <div class="bg-white/30 rounded-full p-2">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-white/20">
                    <div class="flex items-center text-amber-200 text-sm">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                        </svg>
                        <span>Tingkat persetujuan tinggi</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Progress Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8" data-aos="fade-up" data-aos-delay="100">
            <!-- Verification Progress -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-900">Progress Verifikasi Aset</h3>
                    <span class="text-sm font-medium text-blue-600">{{ number_format($stats['total_aset_terverifikasi']) }}/{{ number_format($stats['total_aset_tercatat']) }} aset</span>
                </div>

                @php
                    $percentage = ($stats['total_aset_tercatat'] > 0)
                        ? ($stats['total_aset_terverifikasi'] / $stats['total_aset_tercatat']) * 100
                        : 0;
                    $percentageFormatted = number_format($percentage, 1);
                @endphp

                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700">Aset Tercatat</span>
                            <span class="text-sm font-semibold text-blue-600">{{ number_format($stats['total_aset_tercatat']) }}</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-3 overflow-hidden">
                            <div class="bg-gradient-to-r from-blue-400 to-blue-600 h-3 rounded-full transition-all duration-1000 ease-out"
                                 style="width: 100%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700">Aset Terverifikasi</span>
                            <span class="text-sm font-semibold text-emerald-600">{{ number_format($stats['total_aset_terverifikasi']) }}</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-3 overflow-hidden">
                            <div class="bg-gradient-to-r from-emerald-400 to-emerald-600 h-3 rounded-full transition-all duration-1000 ease-out"
                                 style="width: {{ $percentage }}%"></div>
                        </div>
                        <div class="flex justify-between mt-2">
                            <span class="text-xs text-gray-500">{{ $percentageFormatted }}% telah diverifikasi</span>
                            <span class="text-xs font-medium text-emerald-600">
                                @if($percentage >= 80)
                                    🎉 Excellent
                                @elseif($percentage >= 60)
                                    👍 Good Progress
                                @else
                                    ⚡ Needs Attention
                                @endif
                            </span>
                        </div>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-3 gap-4">
                    <div class="text-center p-3 bg-blue-50 rounded-xl">
                        <div class="text-2xl font-bold text-blue-600">{{ number_format($stats['total_aset_tercatat']) }}</div>
                        <div class="text-sm text-gray-600">Total Aset</div>
                    </div>
                    <div class="text-center p-3 bg-emerald-50 rounded-xl">
                        <div class="text-2xl font-bold text-emerald-600">{{ number_format($stats['total_aset_terverifikasi']) }}</div>
                        <div class="text-sm text-gray-600">Terverifikasi</div>
                    </div>
                    <div class="text-center p-3 bg-amber-50 rounded-xl">
                        <div class="text-2xl font-bold text-amber-600">{{ $percentageFormatted }}%</div>
                        <div class="text-sm text-gray-600">Progress</div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-2xl shadow-lg p-6 text-white">
                <h3 class="text-xl font-bold mb-6">Statistik Cepat</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-3 bg-white/10 rounded-xl hover:bg-white/15 transition-colors">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-lg bg-blue-500/20 flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-300">Rata-rata Waktu</p>
                                <p class="font-bold">7 Hari</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between p-3 bg-white/10 rounded-xl hover:bg-white/15 transition-colors">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-lg bg-emerald-500/20 flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-300">Tingkat Akurasi</p>
                                <p class="font-bold">94.5%</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between p-3 bg-white/10 rounded-xl hover:bg-white/15 transition-colors">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-lg bg-violet-500/20 flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-violet-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-300">Update Terakhir</p>
                                <p class="font-bold">2 Jam Lalu</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-6 border border-gray-100" data-aos="fade-up" data-aos-delay="150">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Filter Laporan</h3>
                    <p class="text-gray-600 text-sm">Temukan laporan berdasarkan kriteria spesifik</p>
                </div>
                <div class="flex items-center space-x-3">
                    <button type="button" onclick="resetFilters()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                        Reset Filter
                    </button>
                </div>
            </div>

            <form method="GET" action="{{ route('manajemen-bmn.wasdal.index') }}"
                  class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Laporan</label>
                    <select name="jenis" class="w-full input-field">
                        <option value="">Semua Jenis</option>
                        <option value="Pelaporan BMN" {{ request('jenis') == 'Pelaporan BMN' ? 'selected' : '' }}>
                            Pelaporan BMN
                        </option>
                        <option value="Sensus BMN" {{ request('jenis') == 'Sensus BMN' ? 'selected' : '' }}>
                            Sensus BMN
                        </option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                    <select name="tahun" class="w-full input-field">
                        <option value="">Semua Tahun</option>
                        @for ($i = date('Y'); $i >= 2020; $i--)
                            <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>
                                {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" class="w-full input-field">
                        <option value="">Semua Status</option>
                        <option value="Draft" {{ request('status') == 'Draft' ? 'selected' : '' }}>
                            <span class="inline-flex items-center">
                                <span class="w-2 h-2 rounded-full bg-gray-400 mr-2"></span>
                                Draft
                            </span>
                        </option>
                        <option value="Submitted" {{ request('status') == 'Submitted' ? 'selected' : '' }}>
                            <span class="inline-flex items-center">
                                <span class="w-2 h-2 rounded-full bg-blue-400 mr-2"></span>
                                Submitted
                            </span>
                        </option>
                        <option value="Reviewed" {{ request('status') == 'Reviewed' ? 'selected' : '' }}>
                            <span class="inline-flex items-center">
                                <span class="w-2 h-2 rounded-full bg-yellow-400 mr-2"></span>
                                Reviewed
                            </span>
                        </option>
                        <option value="Approved" {{ request('status') == 'Approved' ? 'selected' : '' }}>
                            <span class="inline-flex items-center">
                                <span class="w-2 h-2 rounded-full bg-green-400 mr-2"></span>
                                Approved
                            </span>
                        </option>
                        <option value="Rejected" {{ request('status') == 'Rejected' ? 'selected' : '' }}>
                            <span class="inline-flex items-center">
                                <span class="w-2 h-2 rounded-full bg-red-400 mr-2"></span>
                                Rejected
                            </span>
                        </option>
                    </select>
                </div>
                <div class="flex flex-col justify-end">
                    <button type="submit"
                            class="w-full btn-primary flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Terapkan Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100" data-aos="fade-up" data-aos-delay="200">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Daftar Laporan Wasdal BMN</h3>
                        <p class="text-gray-600 text-sm">Total {{ $wasdals->total() }} laporan ditemukan</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <input type="text"
                                   placeholder="Cari laporan..."
                                   class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full sm:w-64">
                            <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center">
                                    Nomor Laporan
                                    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
                                    </svg>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Judul Laporan
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Jenis
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Periode & Tahun
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Verifikasi
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($wasdals as $wasdal)
                            @php
                                $verifikasiPercentage = $wasdal->getPersentaseVerifikasi();
                                $verifikasiFormatted = number_format($verifikasiPercentage, 1);
                                $jumlahAsetTerverifikasi = $wasdal->jumlah_aset_terverifikasi ?? 0;
                                $jumlahAsetTercatat = $wasdal->jumlah_aset_tercatat ?? 0;
                            @endphp
                            <tr class="hover:bg-blue-50/30 transition-all duration-200 group cursor-pointer"
                                onclick="window.location='{{ route('manajemen-bmn.wasdal.show', $wasdal) }}'">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-lg bg-gradient-to-br from-blue-100 to-blue-50 flex items-center justify-center group-hover:from-blue-200 transition-colors">
                                            <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-semibold text-gray-900">{{ $wasdal->nomor_laporan }}</div>
                                            <div class="text-xs text-gray-500">{{ $wasdal->tanggal_laporan->format('d/m/Y') }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900 group-hover:text-blue-600 transition-colors">
                                        {{ Str::limit($wasdal->judul, 40) }}
                                    </div>
                                    @if($wasdal->petugas_pelaksana)
                                        <div class="text-xs text-gray-500 mt-1">
                                            <svg class="inline w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                            {{ Str::limit($wasdal->petugas_pelaksana, 25) }}
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold
                                        {{ $wasdal->jenis_wasdal == 'Pelaporan BMN'
                                            ? 'bg-emerald-100 text-emerald-800 border border-emerald-200'
                                            : 'bg-violet-100 text-violet-800 border border-violet-200' }}">
                                        @if($wasdal->jenis_wasdal == 'Pelaporan BMN')
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                            </svg>
                                        @else
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                            </svg>
                                        @endif
                                        {{ $wasdal->jenis_wasdal }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 font-medium">{{ $wasdal->periode }}</div>
                                    <div class="text-xs text-gray-500">{{ $wasdal->tahun }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-24 bg-gray-100 rounded-full h-2 mr-3 overflow-hidden">
                                            <div class="h-2 rounded-full bg-gradient-to-r from-emerald-400 to-emerald-600 transition-all duration-500"
                                                style="width: {{ $verifikasiPercentage }}%"></div>
                                        </div>
                                        <span class="text-sm font-semibold {{ $verifikasiPercentage >= 80 ? 'text-emerald-600' : ($verifikasiPercentage >= 50 ? 'text-amber-600' : 'text-red-600') }}">
                                            {{ $verifikasiFormatted }}%
                                        </span>
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1">
                                        {{ number_format($jumlahAsetTerverifikasi) }}/{{ number_format($jumlahAsetTercatat) }} aset
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold
                                        {{ $wasdal->getStatusBadgeClass() }} border">
                                        @if($wasdal->status == 'Approved')
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        @elseif($wasdal->status == 'Rejected')
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        @elseif($wasdal->status == 'Reviewed')
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        @endif
                                        {{ $wasdal->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('manajemen-bmn.wasdal.show', $wasdal) }}"
                                           class="text-blue-600 hover:text-blue-800 p-2 rounded-lg hover:bg-blue-50 transition-colors"
                                           title="Detail">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </a>
                                        <button class="text-gray-400 hover:text-gray-600 p-2 rounded-lg hover:bg-gray-100 transition-colors"
                                                title="Edit">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-24 h-24 mb-4 text-gray-300">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                        </div>
                                        <h3 class="text-lg font-semibold text-gray-500 mb-2">Tidak ada data wasdal BMN</h3>
                                        <p class="text-gray-400 mb-4">Mulai dengan membuat laporan wasdal baru</p>
                                        <a href="#" class="btn-primary">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                            </svg>
                                            Buat Laporan Baru
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="text-sm text-gray-700">
                        Menampilkan
                        <span class="font-semibold">{{ $wasdals->firstItem() }}</span>
                        sampai
                        <span class="font-semibold">{{ $wasdals->lastItem() }}</span>
                        dari
                        <span class="font-semibold">{{ $wasdals->total() }}</span>
                        hasil
                    </div>
                    <div>
                        {{ $wasdals->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function resetFilters() {
            window.location.href = "{{ route('manajemen-bmn.wasdal.index') }}";
        }

        // Animasi progress bar saat scroll
        document.addEventListener('DOMContentLoaded', function() {
            const progressBars = document.querySelectorAll('.bg-gradient-to-r');
            progressBars.forEach(bar => {
                const width = bar.style.width;
                bar.style.width = '0';
                setTimeout(() => {
                    bar.style.width = width;
                }, 300);
            });
        });
    </script>

    <style>
        .animate-progress {
            transition: width 1s ease-out;
        }

        table tbody tr {
            transition: all 0.2s ease;
        }

        table tbody tr:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
    </style>
</x-app-layout>
