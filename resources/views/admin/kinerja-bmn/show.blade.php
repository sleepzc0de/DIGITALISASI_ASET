<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    {{ __('Detail Data Kinerja BMN') }}
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Informasi lengkap data kinerja dan kegiatan
                </p>
                <div class="flex items-center mt-2 text-sm text-gray-500">
                    <i class="fas fa-fingerprint mr-2 text-xs"></i>
                    ID: K{{ str_pad($kinerjaBmn->id, 4, '0', STR_PAD_LEFT) }}
                    <span class="mx-2">•</span>
                    <i class="fas fa-clock mr-1 text-xs"></i>
                    Terakhir diupdate: {{ $kinerjaBmn->updated_at->format('d/m/Y H:i') }}
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.kinerja-bmn.edit', $kinerjaBmn) }}"
                   class="btn-primary flex items-center">
                    <i class="fas fa-edit mr-2"></i>
                    Edit
                </a>
                <a href="{{ route('admin.kinerja-bmn.index') }}"
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
            <div class="bg-gradient-to-r from-purple-50 to-indigo-50 rounded-2xl p-6 mb-8 border border-purple-200">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">{{ $kinerjaBmn->nama_kegiatan }}</h3>
                        <p class="text-sm text-gray-600">Detail informasi kinerja</p>
                    </div>
                    <div class="h-12 w-12 rounded-xl bg-purple-500 flex items-center justify-center">
                        @php
                            $jenisIcons = [
                                'Pengadaan' => 'fa-shopping-cart',
                                'Pemeliharaan' => 'fa-tools',
                                'Penghapusan' => 'fa-trash-alt',
                                'Rehabilitasi' => 'fa-hammer',
                            ];
                            $jenisIcon = $jenisIcons[$kinerjaBmn->jenis_kegiatan] ?? 'fa-project-diagram';
                        @endphp
                        <i class="fas {{ $jenisIcon }} text-white text-xl"></i>
                    </div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-gray-900">{{ $kinerjaBmn->realisasi }}/{{ $kinerjaBmn->target }}</div>
                        <div class="text-xs text-gray-600">Realisasi</div>
                        <div class="text-xs {{ $kinerjaBmn->persentase_realisasi >= 90 ? 'text-green-600' : ($kinerjaBmn->persentase_realisasi >= 70 ? 'text-yellow-600' : 'text-red-600') }}">
                            {{ number_format($kinerjaBmn->persentase_realisasi, 1) }}%
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-gray-900">Rp {{ number_format($kinerjaBmn->realisasi_anggaran / 1000000, 1) }}M</div>
                        <div class="text-xs text-gray-600">Anggaran</div>
                        <div class="text-xs {{ $kinerjaBmn->persentase_anggaran <= 100 ? 'text-green-600' : 'text-red-600' }}">
                            {{ number_format($kinerjaBmn->persentase_anggaran, 1) }}%
                        </div>
                    </div>
                    <div class="text-center">
                        @php
                            $monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
                        @endphp
                        <div class="text-2xl font-bold text-gray-900">{{ $monthNames[$kinerjaBmn->bulan - 1] ?? $kinerjaBmn->bulan }} {{ $kinerjaBmn->tahun }}</div>
                        <div class="text-xs text-gray-600">Periode</div>
                    </div>
                    <div class="text-center">
                        @php
                            $statusColors = [
                                'Completed' => 'bg-green-100 text-green-800',
                                'On Progress' => 'bg-blue-100 text-blue-800',
                                'Delayed' => 'bg-red-100 text-red-800',
                                'Pending' => 'bg-yellow-100 text-yellow-800',
                            ];
                        @endphp
                        <div class="text-2xl font-bold text-gray-900">
                            <span class="text-sm px-3 py-1 rounded-full {{ $statusColors[$kinerjaBmn->status] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ $kinerjaBmn->status }}
                            </span>
                        </div>
                        <div class="text-xs text-gray-600">Status</div>
                    </div>
                </div>
            </div>

            <!-- Performance Metrics -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Realisasi Progress -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-chart-line text-purple-500 mr-2"></i>
                        Realisasi Fisik
                    </h4>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="text-2xl font-bold text-gray-900">{{ $kinerjaBmn->realisasi }}/{{ $kinerjaBmn->target }}</div>
                                <div class="text-sm text-gray-600">Capai target</div>
                            </div>
                            <div class="text-2xl font-bold {{ $kinerjaBmn->persentase_realisasi >= 90 ? 'text-green-600' : ($kinerjaBmn->persentase_realisasi >= 70 ? 'text-yellow-600' : 'text-red-600') }}">
                                {{ number_format($kinerjaBmn->persentase_realisasi, 1) }}%
                            </div>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-4">
                            <div class="h-4 rounded-full {{ $kinerjaBmn->persentase_realisasi >= 90 ? 'bg-green-500' : ($kinerjaBmn->persentase_realisasi >= 70 ? 'bg-yellow-500' : 'bg-red-500') }}"
                                 style="width: {{ min($kinerjaBmn->persentase_realisasi, 100) }}%"></div>
                        </div>
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>0%</span>
                            <span>100%</span>
                        </div>
                    </div>
                </div>

                <!-- Anggaran Progress -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-money-bill-wave text-purple-500 mr-2"></i>
                        Realisasi Anggaran
                    </h4>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="text-2xl font-bold text-gray-900">Rp {{ number_format($kinerjaBmn->realisasi_anggaran, 0, ',', '.') }}</div>
                                <div class="text-sm text-gray-600">Dari Rp {{ number_format($kinerjaBmn->anggaran, 0, ',', '.') }}</div>
                            </div>
                            <div class="text-2xl font-bold {{ $kinerjaBmn->persentase_anggaran <= 100 ? 'text-green-600' : 'text-red-600' }}">
                                {{ number_format($kinerjaBmn->persentase_anggaran, 1) }}%
                            </div>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-4">
                            <div class="h-4 rounded-full {{ $kinerjaBmn->persentase_anggaran <= 100 ? 'bg-green-500' : 'bg-red-500' }}"
                                 style="width: {{ min($kinerjaBmn->persentase_anggaran, 100) }}%"></div>
                        </div>
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>0%</span>
                            <span>100%</span>
                        </div>
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
                            <i class="fas fa-info-circle text-purple-500 mr-2"></i>
                            Informasi Dasar
                        </h4>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Jenis Kegiatan</span>
                                <span class="text-sm font-medium text-gray-900">{{ $kinerjaBmn->jenis_kegiatan }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Nama Kegiatan</span>
                                <span class="text-sm font-medium text-gray-900">{{ $kinerjaBmn->nama_kegiatan }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Status</span>
                                <span class="px-3 py-1 text-xs font-medium rounded-full {{ $statusColors[$kinerjaBmn->status] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $kinerjaBmn->status }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Periode</span>
                                <span class="text-sm font-medium text-gray-900">
                                    {{ $monthNames[$kinerjaBmn->bulan - 1] ?? $kinerjaBmn->bulan }} {{ $kinerjaBmn->tahun }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Timeline Card -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-calendar-alt text-purple-500 mr-2"></i>
                            Timeline Kegiatan
                        </h4>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Tanggal Mulai</span>
                                <span class="text-sm font-medium text-gray-900">
                                    {{ $kinerjaBmn->tanggal_mulai?->format('d/m/Y') ?? 'Belum ditentukan' }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Tanggal Selesai</span>
                                <span class="text-sm font-medium text-gray-900">
                                    {{ $kinerjaBmn->tanggal_selesai?->format('d/m/Y') ?? 'Masih berjalan' }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Durasi</span>
                                @if($kinerjaBmn->tanggal_mulai && $kinerjaBmn->tanggal_selesai)
                                    @php
                                        $start = \Carbon\Carbon::parse($kinerjaBmn->tanggal_mulai);
                                        $end = \Carbon\Carbon::parse($kinerjaBmn->tanggal_selesai);
                                        $duration = $start->diffInDays($end);
                                    @endphp
                                    <span class="text-sm font-medium text-gray-900">{{ $duration }} hari</span>
                                @elseif($kinerjaBmn->tanggal_mulai)
                                    @php
                                        $start = \Carbon\Carbon::parse($kinerjaBmn->tanggal_mulai);
                                        $now = now();
                                        $duration = $start->diffInDays($now);
                                    @endphp
                                    <span class="text-sm font-medium text-gray-900">{{ $duration }} hari (berjalan)</span>
                                @else
                                    <span class="text-sm font-medium text-gray-900">-</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <!-- Financial Information Card -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-file-invoice-dollar text-purple-500 mr-2"></i>
                            Informasi Keuangan
                        </h4>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Anggaran</span>
                                <span class="text-sm font-medium text-gray-900">Rp {{ number_format($kinerjaBmn->anggaran, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Realisasi Anggaran</span>
                                <span class="text-sm font-medium text-gray-900">Rp {{ number_format($kinerjaBmn->realisasi_anggaran, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Sisa Anggaran</span>
                                @php
                                    $sisaAnggaran = $kinerjaBmn->anggaran - $kinerjaBmn->realisasi_anggaran;
                                @endphp
                                <div class="text-right">
                                    <div class="text-sm font-medium {{ $sisaAnggaran >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                        Rp {{ number_format(abs($sisaAnggaran), 0, ',', '.') }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ $sisaAnggaran >= 0 ? 'Tersisa' : 'Over budget' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Information Card -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-sticky-note text-purple-500 mr-2"></i>
                            Keterangan
                        </h4>
                        <div class="text-sm text-gray-700">
                            @if($kinerjaBmn->keterangan)
                                {{ $kinerjaBmn->keterangan }}
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
                                <span class="font-medium text-gray-900">{{ $kinerjaBmn->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-600">Terakhir diupdate:</span>
                                <span class="font-medium text-gray-900">{{ $kinerjaBmn->updated_at->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="text-sm text-gray-600">
                    <i class="fas fa-info-circle text-purple-500 mr-1"></i>
                    Data kinerja ini tercatat dalam sistem sejak {{ $kinerjaBmn->created_at->format('d F Y') }}
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.kinerja-bmn.index') }}"
                       class="btn-secondary flex items-center justify-center w-full sm:w-auto">
                        <i class="fas fa-list mr-2"></i>
                        Lihat Semua Kinerja
                    </a>
                    <a href="{{ route('admin.kinerja-bmn.edit', $kinerjaBmn) }}"
                       class="btn-primary flex items-center justify-center w-full sm:w-auto">
                        <i class="fas fa-edit mr-2"></i>
                        Edit Data Kinerja
                    </a>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Copy ID functionality
        function copyKinerjaId() {
            const kinerjaId = 'K{{ str_pad($kinerjaBmn->id, 4, '0', STR_PAD_LEFT) }}';
            navigator.clipboard.writeText(kinerjaId).then(() => {
                alert('ID Kinerja berhasil disalin: ' + kinerjaId);
            });
        }

        // Print functionality
        function printKinerjaDetail() {
            window.print();
        }

        // Share functionality
        function shareKinerjaDetail() {
            if (navigator.share) {
                navigator.share({
                    title: 'Detail Kinerja: {{ $kinerjaBmn->nama_kegiatan }}',
                    text: 'Lihat detail kinerja {{ $kinerjaBmn->nama_kegiatan }} dengan realisasi {{ $kinerjaBmn->persentase_realisasi }}%',
                    url: window.location.href,
                });
            } else {
                alert('Fitur share tidak didukung di browser ini. Anda dapat menyalin URL dari address bar.');
            }
        }

        // Calculate efficiency
        function calculateEfficiency() {
            const realisasi = {{ $kinerjaBmn->persentase_realisasi }};
            const anggaran = {{ $kinerjaBmn->persentase_anggaran }};

            // Simple efficiency formula (70% realisasi, 30% anggaran)
            const efficiency = (realisasi * 0.7) + ((100 - Math.min(anggaran, 100)) * 0.3);

            let efficiencyText = '';
            let efficiencyClass = '';

            if (efficiency >= 85) {
                efficiencyText = 'Sangat Efisien';
                efficiencyClass = 'text-green-600';
            } else if (efficiency >= 70) {
                efficiencyText = 'Efisien';
                efficiencyClass = 'text-yellow-600';
            } else {
                efficiencyText = 'Perlu Perbaikan';
                efficiencyClass = 'text-red-600';
            }

            alert(`Tingkat Efisiensi: ${efficiency.toFixed(1)}%\nKategori: ${efficiencyText}`);
        }
    </script>
    @endpush
</x-app-layout>
