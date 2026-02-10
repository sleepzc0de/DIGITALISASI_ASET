<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <a href="{{ route('manajemen-bmn.penatausahaan.index') }}"
                   class="p-2 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                    <i class="fas fa-arrow-left text-gray-600"></i>
                </a>
                <div>
                    <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                        Detail Aset BMN
                    </h2>
                    <p class="text-gray-600 text-sm">Informasi lengkap Barang Milik Negara</p>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <button class="btn-secondary flex items-center">
                    <i class="fas fa-print mr-2"></i>
                    Cetak
                </button>
                @if(auth()->user()->isAdmin())
                <button class="btn-primary flex items-center">
                    <i class="fas fa-edit mr-2"></i>
                    Edit Aset
                </button>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column - Asset Details -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Asset Overview Card -->
                <div class="bg-white rounded-2xl shadow-soft overflow-hidden" data-aos="fade-up">
                    <div class="p-8">
                        <div class="flex flex-col md:flex-row md:items-start gap-6">
                            <!-- Asset Image -->
                            <div class="relative">
                                <div class="w-full md:w-64 h-64 rounded-2xl overflow-hidden shadow-lg">
                                    <img src="{{ $penatausahaan->getFotoUrl() }}"
                                         alt="{{ $penatausahaan->nama_barang }}"
                                         class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                                </div>
                                <div class="absolute top-4 right-4">
                                    <span class="px-3 py-1.5 text-sm font-semibold rounded-full {{ $penatausahaan->getKondisiBadgeClass() }} shadow-md">
                                        {{ $penatausahaan->kondisi }}
                                    </span>
                                </div>
                            </div>

                            <!-- Asset Info -->
                            <div class="flex-1">
                                <div class="flex items-start justify-between mb-4">
                                    <div>
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 mb-3 inline-block">
                                            {{ $penatausahaan->kategori }}
                                        </span>
                                        <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $penatausahaan->nama_barang }}</h1>
                                        <div class="flex items-center space-x-4 text-gray-600">
                                            <div class="flex items-center">
                                                <i class="fas fa-barcode mr-2"></i>
                                                <span class="font-mono">{{ $penatausahaan->kode_barang }}</span>
                                            </div>
                                            @if($penatausahaan->nup)
                                            <div class="flex items-center">
                                                <i class="fas fa-hashtag mr-2"></i>
                                                <span>NUP: {{ $penatausahaan->nup }}</span>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Quick Stats -->
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
                                    <div class="bg-gray-50 rounded-xl p-4">
                                        <div class="text-sm text-gray-600 mb-1">Nilai Buku</div>
                                        <div class="text-2xl font-bold text-gray-900">Rp {{ number_format($penatausahaan->nilai_buku, 0, ',', '.') }}</div>
                                    </div>
                                    <div class="bg-gray-50 rounded-xl p-4">
                                        <div class="text-sm text-gray-600 mb-1">Jumlah</div>
                                        <div class="text-2xl font-bold text-gray-900">{{ number_format($penatausahaan->jumlah_unit) }} {{ $penatausahaan->satuan }}</div>
                                    </div>
                                    <div class="bg-gray-50 rounded-xl p-4">
                                        <div class="text-sm text-gray-600 mb-1">Umur Aset</div>
                                        <div class="text-2xl font-bold text-gray-900">
                                            @if($penatausahaan->tahun_pembuatan && is_numeric($penatausahaan->tahun_pembuatan))
                                                {{ date('Y') - $penatausahaan->tahun_pembuatan }} tahun
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Description -->
                                @if($penatausahaan->spesifikasi)
                                <div class="mb-6">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                                        <i class="fas fa-list-ul mr-2 text-blue-600"></i>
                                        Spesifikasi
                                    </h3>
                                    <div class="bg-blue-50 rounded-xl p-5">
                                        <p class="text-gray-700 whitespace-pre-line leading-relaxed">{{ $penatausahaan->spesifikasi }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Detailed Information Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6" data-aos="fade-up" data-aos-delay="100">
                    <!-- Identification Card -->
                    <div class="bg-white rounded-2xl shadow-soft p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-fingerprint mr-2 text-purple-600"></i>
                            Identifikasi
                        </h3>
                        <div class="space-y-4">
                            @if($penatausahaan->merk_type)
                            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                <span class="text-gray-600">Merk/Type</span>
                                <span class="font-semibold text-gray-900">{{ $penatausahaan->merk_type }}</span>
                            </div>
                            @endif

                            @if($penatausahaan->tahun_pembuatan)
                            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                <span class="text-gray-600">Tahun Pembuatan</span>
                                <span class="font-semibold text-gray-900">{{ $penatausahaan->tahun_pembuatan }}</span>
                            </div>
                            @endif

                            @if($penatausahaan->nomor_polisi)
                            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                <span class="text-gray-600">Nomor Polisi</span>
                                <span class="font-semibold text-gray-900">{{ $penatausahaan->nomor_polisi }}</span>
                            </div>
                            @endif

                            @if($penatausahaan->nomor_dokumen_kepemilikan)
                            <div class="flex items-center justify-between py-2">
                                <span class="text-gray-600">No. Dokumen Kepemilikan</span>
                                <span class="font-semibold text-gray-900">{{ $penatausahaan->nomor_dokumen_kepemilikan }}</span>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Financial Information Card -->
                    <div class="bg-white rounded-2xl shadow-soft p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-chart-line mr-2 text-emerald-600"></i>
                            Informasi Keuangan
                        </h3>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                <span class="text-gray-600">Nilai Perolehan</span>
                                <span class="font-semibold text-emerald-700">Rp {{ number_format($penatausahaan->nilai_perolehan, 0, ',', '.') }}</span>
                            </div>

                            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                <span class="text-gray-600">Nilai Buku</span>
                                <span class="font-semibold text-blue-700">Rp {{ number_format($penatausahaan->nilai_buku, 0, ',', '.') }}</span>
                            </div>

                            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                <span class="text-gray-600">Tanggal Perolehan</span>
                                <span class="font-semibold text-gray-900">{{ $penatausahaan->tanggal_perolehan->format('d F Y') }}</span>
                            </div>

                            @if($penatausahaan->luas)
                            <div class="flex items-center justify-between py-2">
                                <span class="text-gray-600">Luas</span>
                                <span class="font-semibold text-gray-900">{{ number_format($penatausahaan->luas, 2, ',', '.') }} m²</span>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Location Card -->
                    <div class="bg-white rounded-2xl shadow-soft p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-map-marker-alt mr-2 text-red-600"></i>
                            Lokasi
                        </h3>
                        <div class="space-y-4">
                            <div class="py-2">
                                <div class="text-gray-600 mb-1">Lokasi</div>
                                <div class="font-semibold text-gray-900 flex items-center">
                                    <i class="fas fa-building mr-2 text-gray-400"></i>
                                    {{ $penatausahaan->lokasi }}
                                </div>
                            </div>

                            @if($penatausahaan->pengguna)
                            <div class="py-2 border-t border-gray-100">
                                <div class="text-gray-600 mb-1">Pengguna</div>
                                <div class="font-semibold text-gray-900 flex items-center">
                                    <i class="fas fa-user mr-2 text-gray-400"></i>
                                    {{ $penatausahaan->pengguna }}
                                </div>
                            </div>
                            @endif

                            @if($penatausahaan->alamat_lengkap)
                            <div class="py-2 border-t border-gray-100">
                                <div class="text-gray-600 mb-1">Alamat Lengkap</div>
                                <div class="text-gray-700">
                                    {{ $penatausahaan->alamat_lengkap }}
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Status Card -->
                    <div class="bg-white rounded-2xl shadow-soft p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-info-circle mr-2 text-amber-600"></i>
                            Status Aset
                        </h3>
                        <div class="space-y-6">
                            <div>
                                <div class="text-gray-600 mb-2">Status Penggunaan</div>
                                <div class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold
                                    {{ $penatausahaan->status_aset == 'Digunakan' ? 'bg-green-100 text-green-800' :
                                       ($penatausahaan->status_aset == 'Tidak Digunakan' ? 'bg-gray-100 text-gray-800' :
                                       ($penatausahaan->status_aset == 'Dalam Perbaikan' ? 'bg-yellow-100 text-yellow-800' :
                                       'bg-blue-100 text-blue-800')) }}">
                                    <i class="fas fa-circle text-xs mr-2
                                        {{ $penatausahaan->status_aset == 'Digunakan' ? 'text-green-500' :
                                           ($penatausahaan->status_aset == 'Tidak Digunakan' ? 'text-gray-500' :
                                           ($penatausahaan->status_aset == 'Dalam Perbaikan' ? 'text-yellow-500' :
                                           'text-blue-500')) }}"></i>
                                    {{ $penatausahaan->status_aset }}
                                </div>
                            </div>

                            <div>
                                <div class="text-gray-600 mb-2">Kondisi</div>
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center {{ $penatausahaan->getKondisiBadgeClass() }} mr-3">
                                        @if($penatausahaan->kondisi == 'Baik')
                                        <i class="fas fa-check"></i>
                                        @elseif($penatausahaan->kondisi == 'Rusak Ringan')
                                        <i class="fas fa-exclamation"></i>
                                        @else
                                        <i class="fas fa-times"></i>
                                        @endif
                                    </div>
                                    <span class="text-lg font-semibold {{
                                        $penatausahaan->kondisi == 'Baik' ? 'text-green-700' :
                                        ($penatausahaan->kondisi == 'Rusak Ringan' ? 'text-yellow-700' : 'text-red-700')
                                    }}">
                                        {{ $penatausahaan->kondisi }}
                                    </span>
                                </div>
                            </div>

                            @if($penatausahaan->keterangan)
                            <div class="pt-4 border-t border-gray-100">
                                <div class="text-gray-600 mb-2">Catatan</div>
                                <div class="text-gray-700 bg-gray-50 rounded-lg p-4">
                                    {{ $penatausahaan->keterangan }}
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Sidebar -->
            <div class="space-y-6">
                <!-- Action Panel -->
                <div class="bg-white rounded-2xl shadow-soft p-6" data-aos="fade-left">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h3>
                    <div class="space-y-3">
                        <button class="w-full flex items-center justify-between p-3 rounded-xl border border-gray-200 hover:border-blue-300 hover:bg-blue-50 transition-all duration-200 group">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center mr-3 group-hover:bg-blue-200">
                                    <i class="fas fa-history text-blue-600"></i>
                                </div>
                                <span class="font-medium text-gray-700">Riwayat Pemeliharaan</span>
                            </div>
                            <i class="fas fa-chevron-right text-gray-400 group-hover:text-blue-600"></i>
                        </button>

                        <button class="w-full flex items-center justify-between p-3 rounded-xl border border-gray-200 hover:border-green-300 hover:bg-green-50 transition-all duration-200 group">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center mr-3 group-hover:bg-green-200">
                                    <i class="fas fa-clipboard-check text-green-600"></i>
                                </div>
                                <span class="font-medium text-gray-700">Laporan Kondisi</span>
                            </div>
                            <i class="fas fa-chevron-right text-gray-400 group-hover:text-green-600"></i>
                        </button>

                        <button class="w-full flex items-center justify-between p-3 rounded-xl border border-gray-200 hover:border-purple-300 hover:bg-purple-50 transition-all duration-200 group">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center mr-3 group-hover:bg-purple-200">
                                    <i class="fas fa-file-contract text-purple-600"></i>
                                </div>
                                <span class="font-medium text-gray-700">Dokumen Legal</span>
                            </div>
                            <i class="fas fa-chevron-right text-gray-400 group-hover:text-purple-600"></i>
                        </button>

                        <button class="w-full flex items-center justify-between p-3 rounded-xl border border-gray-200 hover:border-red-300 hover:bg-red-50 transition-all duration-200 group">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-lg bg-red-100 flex items-center justify-center mr-3 group-hover:bg-red-200">
                                    <i class="fas fa-flag text-red-600"></i>
                                </div>
                                <span class="font-medium text-gray-700">Laporkan Masalah</span>
                            </div>
                            <i class="fas fa-chevron-right text-gray-400 group-hover:text-red-600"></i>
                        </button>
                    </div>
                </div>

                <!-- Metadata Panel -->
                <div class="bg-white rounded-2xl shadow-soft p-6" data-aos="fade-left" data-aos-delay="100">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Metadata</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between py-2">
                            <span class="text-gray-600">ID Database</span>
                            <span class="font-mono text-sm text-gray-900">{{ $penatausahaan->id }}</span>
                        </div>
                        <div class="flex items-center justify-between py-2 border-t border-gray-100">
                            <span class="text-gray-600">Dibuat</span>
                            <span class="text-gray-900">{{ $penatausahaan->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="flex items-center justify-between py-2 border-t border-gray-100">
                            <span class="text-gray-600">Diperbarui</span>
                            <span class="text-gray-900">{{ $penatausahaan->updated_at->format('d M Y') }}</span>
                        </div>
                        <div class="flex items-center justify-between py-2 border-t border-gray-100">
                            <span class="text-gray-600">Status Data</span>
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                Valid
                            </span>
                        </div>
                    </div>
                </div>

                <!-- QR Code Panel -->
                <div class="bg-gradient-to-br from-gray-900 to-blue-900 rounded-2xl shadow-soft p-6 text-white" data-aos="fade-left" data-aos-delay="200">
                    <div class="text-center">
                        <div class="w-32 h-32 bg-white rounded-lg mx-auto mb-4 flex items-center justify-center">
                            <!-- QR Code Placeholder -->
                            <div class="text-gray-800 text-center">
                                <i class="fas fa-qrcode text-4xl"></i>
                                <p class="text-xs mt-2">SCAN ME</p>
                            </div>
                        </div>
                        <h4 class="font-semibold mb-2">Kode Aset: {{ $penatausahaan->kode_barang }}</h4>
                        <p class="text-sm text-gray-300 mb-4">Scan untuk melihat detail aset</p>
                        <button class="w-full py-2 bg-white/10 hover:bg-white/20 rounded-lg transition-colors duration-200">
                            <i class="fas fa-download mr-2"></i>
                            Download QR Code
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .shadow-soft {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.1);
        }

        .gradient-border {
            position: relative;
            background: white;
            border-radius: 16px;
        }

        .gradient-border::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, #3b82f6, #8b5cf6);
            border-radius: 18px;
            z-index: -1;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Image zoom effect
            const assetImage = document.querySelector('img[alt*="{{ $penatausahaan->nama_barang }}"]');
            if (assetImage) {
                assetImage.parentElement.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.02)';
                });

                assetImage.parentElement.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1)';
                });
            }

            // Card hover effects
            const cards = document.querySelectorAll('.bg-white.rounded-2xl');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.classList.add('card-hover');
                });

                card.addEventListener('mouseleave', function() {
                    this.classList.remove('card-hover');
                });
            });
        });
    </script>
</x-app-layout>
