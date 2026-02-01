<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    {{ __('Detail Data Aset') }}
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Informasi lengkap data aset BMN
                </p>
                <div class="flex items-center mt-2 text-sm text-gray-500">
                    <i class="fas fa-fingerprint mr-2 text-xs"></i>
                    ID: ASET{{ str_pad($dashboardAset->id, 4, '0', STR_PAD_LEFT) }}
                    <span class="mx-2">•</span>
                    <i class="fas fa-clock mr-1 text-xs"></i>
                    Terakhir diupdate: {{ $dashboardAset->updated_at->format('d/m/Y H:i') }}
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.dashboard-aset.edit', $dashboardAset) }}"
                   class="btn-primary flex items-center">
                    <i class="fas fa-edit mr-2"></i>
                    Edit
                </a>
                <a href="{{ route('admin.dashboard-aset.index') }}"
                   class="btn-secondary flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i>
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
