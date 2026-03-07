<x-app-layout>
   <x-slot name="header">
    {{-- Breadcrumb --}}
    <nav aria-label="Breadcrumb" class="mb-3">
        <ol class="flex items-center gap-1.5 text-xs text-gray-500">
            <li>
                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-1 hover:text-blue-600 transition-colors">
                    <i class="fas fa-home text-[10px]" aria-hidden="true"></i>
                    Dashboard
                </a>
            </li>
            <li aria-hidden="true">
                <i class="fas fa-chevron-right text-[9px] text-gray-300"></i>
            </li>
            <li>
                <a href="{{ route('admin.dashboard-aset.index') }}"
                   class="hover:text-blue-600 transition-colors">
                    Manajemen Aset
                </a>
            </li>
            <li aria-hidden="true">
                <i class="fas fa-chevron-right text-[9px] text-gray-300"></i>
            </li>
            <li>
                <span class="font-medium text-gray-700 truncate max-w-[160px] inline-block"
                      aria-current="page">
                    {{ $dashboardAset->kategori_aset }}
                </span>
            </li>
        </ol>
    </nav>

    {{-- Header utama --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

        {{-- Judul + meta --}}
        <div class="flex items-start gap-3 min-w-0">
            @php
                $iconMap = [
                    'Kendaraan'  => ['icon' => 'fa-car',      'from' => 'from-sky-500',    'to' => 'to-sky-700',    'shadow' => 'shadow-sky-200'],
                    'Elektronik' => ['icon' => 'fa-laptop',   'from' => 'from-indigo-500', 'to' => 'to-indigo-700', 'shadow' => 'shadow-indigo-200'],
                    'Furniture'  => ['icon' => 'fa-chair',    'from' => 'from-amber-500',  'to' => 'to-amber-700',  'shadow' => 'shadow-amber-200'],
                    'Bangunan'   => ['icon' => 'fa-building', 'from' => 'from-slate-500',  'to' => 'to-slate-700',  'shadow' => 'shadow-slate-200'],
                    'Tanah'      => ['icon' => 'fa-mountain', 'from' => 'from-green-500',  'to' => 'to-green-700',  'shadow' => 'shadow-green-200'],
                ];
                $cfg = $iconMap[$dashboardAset->kategori_aset]
                    ?? ['icon' => 'fa-box', 'from' => 'from-blue-500', 'to' => 'to-blue-700', 'shadow' => 'shadow-blue-200'];

                $kondisiCfg = [
                    'Baik'         => ['bg' => 'bg-green-100',  'text' => 'text-green-700',  'dot' => 'bg-green-500'],
                    'Rusak Ringan' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-700', 'dot' => 'bg-yellow-500'],
                    'Rusak Berat'  => ['bg' => 'bg-red-100',    'text' => 'text-red-700',    'dot' => 'bg-red-500'],
                ];
                $kCfg = $kondisiCfg[$dashboardAset->kondisi]
                     ?? ['bg' => 'bg-gray-100', 'text' => 'text-gray-700', 'dot' => 'bg-gray-400'];
            @endphp

            <div class="flex-shrink-0 h-11 w-11 rounded-xl
                        bg-gradient-to-br {{ $cfg['from'] }} {{ $cfg['to'] }}
                        flex items-center justify-center
                        shadow-md {{ $cfg['shadow'] }}">
                <i class="fas {{ $cfg['icon'] }} text-white text-lg"
                   aria-hidden="true"></i>
            </div>

            <div class="min-w-0">
                <h2 class="text-xl font-bold text-gray-900 leading-tight truncate">
                    {{ $dashboardAset->kategori_aset }}
                </h2>
                {{-- Kondisi badge + ID --}}
                <div class="flex items-center gap-2 mt-1 flex-wrap">
                    <span class="inline-flex items-center gap-1.5 px-2 py-0.5
                                 {{ $kCfg['bg'] }} {{ $kCfg['text'] }}
                                 rounded-md text-xs font-medium">
                        <span class="h-1.5 w-1.5 rounded-full {{ $kCfg['dot'] }}"
                              aria-hidden="true"></span>
                        {{ $dashboardAset->kondisi }}
                    </span>
                    <span class="inline-flex items-center gap-1 px-2 py-0.5
                                 bg-gray-100 text-gray-600 rounded-md text-xs font-mono">
                        <i class="fas fa-fingerprint text-[10px]" aria-hidden="true"></i>
                        ASET{{ str_pad($dashboardAset->id, 4, '0', STR_PAD_LEFT) }}
                    </span>
                    <span class="inline-flex items-center gap-1 px-2 py-0.5
                                 bg-gray-100 text-gray-600 rounded-md text-xs">
                        <i class="fas fa-clock text-[10px]" aria-hidden="true"></i>
                        {{ $dashboardAset->updated_at->diffForHumans() }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Aksi --}}
        <div class="flex items-center gap-2 flex-shrink-0 flex-wrap sm:flex-nowrap">
            <a href="{{ route('admin.dashboard-aset.edit', $dashboardAset) }}"
               class="inline-flex items-center gap-2 px-4 py-2.5
                      bg-gradient-to-r from-blue-600 to-blue-700
                      hover:from-blue-700 hover:to-blue-800
                      text-white text-sm font-semibold rounded-xl
                      shadow-md shadow-blue-200 hover:shadow-lg
                      transition-all duration-200 focus:outline-none
                      focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                <i class="fas fa-edit text-xs" aria-hidden="true"></i>
                Edit Aset
            </a>
            <a href="{{ route('admin.dashboard-aset.index') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5
                      bg-white border border-gray-300 hover:border-gray-400
                      text-gray-700 hover:text-gray-900 text-sm font-medium
                      rounded-xl shadow-sm hover:shadow transition-all duration-200
                      focus:outline-none focus:ring-2 focus:ring-gray-400
                      focus:ring-offset-2">
                <i class="fas fa-arrow-left text-xs" aria-hidden="true"></i>
                Kembali
            </a>
        </div>
    </div>
</x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Overview Card -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-6 mb-8 border border-blue-200">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">{{ $dashboardAset->kategori_aset }}</h3>
                        <p class="text-sm text-gray-600">Detail informasi aset</p>
                    </div>
                    <div class="h-12 w-12 rounded-xl bg-blue-500 flex items-center justify-center">
                        @php
                            $icons = [
                                'Kendaraan' => 'fa-car',
                                'Elektronik' => 'fa-laptop',
                                'Furniture' => 'fa-chair',
                                'Bangunan' => 'fa-building',
                                'Tanah' => 'fa-mountain',
                            ];
                            $icon = $icons[$dashboardAset->kategori_aset] ?? 'fa-box';
                        @endphp
                        <i class="fas {{ $icon }} text-white text-xl"></i>
                    </div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-gray-900">{{ $dashboardAset->jumlah_unit }}</div>
                        <div class="text-xs text-gray-600">Jumlah Unit</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-gray-900">Rp {{ number_format($dashboardAset->nilai_buku, 0, ',', '.') }}</div>
                        <div class="text-xs text-gray-600">Nilai Buku</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-gray-900">{{ $dashboardAset->tahun }}</div>
                        <div class="text-xs text-gray-600">Tahun</div>
                    </div>
                    <div class="text-center">
                        @php
                            $kondisiColors = [
                                'Baik' => 'bg-green-100 text-green-800',
                                'Rusak Ringan' => 'bg-yellow-100 text-yellow-800',
                                'Rusak Berat' => 'bg-red-100 text-red-800',
                            ];
                        @endphp
                        <div class="text-2xl font-bold text-gray-900">
                            <span class="text-sm px-3 py-1 rounded-full {{ $kondisiColors[$dashboardAset->kondisi] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ $dashboardAset->kondisi }}
                            </span>
                        </div>
                        <div class="text-xs text-gray-600">Kondisi</div>
                    </div>
                </div>
            </div>

            <!-- Detail Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-6">
                    <!-- Basic Information Card -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                            Informasi Dasar
                        </h4>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Kategori Aset</span>
                                <span class="text-sm font-medium text-gray-900">{{ $dashboardAset->kategori_aset }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Jumlah Unit</span>
                                <span class="text-sm font-medium text-gray-900">{{ number_format($dashboardAset->jumlah_unit) }} unit</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Tahun Pengadaan</span>
                                <span class="text-sm font-medium text-gray-900">{{ $dashboardAset->tahun }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Usia Aset</span>
                                <span class="text-sm font-medium text-gray-900">{{ now()->year - $dashboardAset->tahun }} tahun</span>
                            </div>
                        </div>
                    </div>

                    <!-- Condition & Location Card -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-map-marker-alt text-blue-500 mr-2"></i>
                            Lokasi & Kondisi
                        </h4>
                        <div class="space-y-4">
                            <div>
                                <span class="text-sm text-gray-600">Lokasi</span>
                                <div class="flex items-center mt-1">
                                    <i class="fas fa-building text-gray-400 mr-2"></i>
                                    <span class="text-sm font-medium text-gray-900">{{ $dashboardAset->lokasi }}</span>
                                </div>
                            </div>
                            <div>
                                <span class="text-sm text-gray-600">Kondisi</span>
                                <div class="mt-1">
                                    <span class="px-3 py-1 text-sm font-medium rounded-full {{ $kondisiColors[$dashboardAset->kondisi] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ $dashboardAset->kondisi }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <!-- Financial Information Card -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-money-bill-wave text-blue-500 mr-2"></i>
                            Informasi Keuangan
                        </h4>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Nilai Perolehan</span>
                                <span class="text-sm font-medium text-gray-900">Rp {{ number_format($dashboardAset->nilai_perolehan, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Nilai Buku</span>
                                <span class="text-sm font-medium text-gray-900">Rp {{ number_format($dashboardAset->nilai_buku, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Penyusutan</span>
                                @php
                                    $penyusutan = $dashboardAset->nilai_perolehan - $dashboardAset->nilai_buku;
                                    $persentasePenyusutan = $dashboardAset->nilai_perolehan > 0 ? ($penyusutan / $dashboardAset->nilai_perolehan) * 100 : 0;
                                @endphp
                                <div class="text-right">
                                    <div class="text-sm font-medium text-gray-900">Rp {{ number_format($penyusutan, 0, ',', '.') }}</div>
                                    <div class="text-xs text-gray-500">{{ number_format($persentasePenyusutan, 1) }}%</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Information Card -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-sticky-note text-blue-500 mr-2"></i>
                            Keterangan
                        </h4>
                        <div class="text-sm text-gray-700">
                            @if($dashboardAset->keterangan)
                                {{ $dashboardAset->keterangan }}
                            @else
                                <span class="text-gray-400">Tidak ada keterangan tambahan</span>
                            @endif
                        </div>
                    </div>

                    <!-- Timestamps Card -->
                    <div class="bg-gray-50 rounded-2xl border border-gray-200 p-6">
                        <h4 class="text-sm font-medium text-gray-900 mb-3 flex items-center">
                            <i class="fas fa-history text-gray-500 mr-2"></i>
                            Riwayat Sistem
                        </h4>
                        <div class="space-y-2">
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-600">Dibuat pada:</span>
                                <span class="font-medium text-gray-900">{{ $dashboardAset->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-600">Terakhir diupdate:</span>
                                <span class="font-medium text-gray-900">{{ $dashboardAset->updated_at->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="text-sm text-gray-600">
                    <i class="fas fa-info-circle text-blue-500 mr-1"></i>
                    Data aset ini tercatat dalam sistem sejak {{ $dashboardAset->created_at->format('d F Y') }}
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.dashboard-aset.index') }}"
                       class="btn-secondary flex items-center justify-center w-full sm:w-auto">
                        <i class="fas fa-list mr-2"></i>
                        Lihat Semua Aset
                    </a>
                    <a href="{{ route('admin.dashboard-aset.edit', $dashboardAset) }}"
                       class="btn-primary flex items-center justify-center w-full sm:w-auto">
                        <i class="fas fa-edit mr-2"></i>
                        Edit Data Aset
                    </a>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Copy ID functionality
        function copyAssetId() {
            const assetId = 'ASET{{ str_pad($dashboardAset->id, 4, '0', STR_PAD_LEFT) }}';
            navigator.clipboard.writeText(assetId).then(() => {
                alert('ID Aset berhasil disalin: ' + assetId);
            });
        }

        // Print functionality
        function printAssetDetail() {
            window.print();
        }

        // Share functionality
        function shareAssetDetail() {
            if (navigator.share) {
                navigator.share({
                    title: 'Detail Aset: {{ $dashboardAset->kategori_aset }}',
                    text: 'Lihat detail aset {{ $dashboardAset->kategori_aset }} dengan ID: ASET{{ str_pad($dashboardAset->id, 4, "0", STR_PAD_LEFT) }}',
                    url: window.location.href,
                });
            } else {
                alert('Fitur share tidak didukung di browser ini. Anda dapat menyalin URL dari address bar.');
            }
        }
    </script>
    @endpush
</x-app-layout>
