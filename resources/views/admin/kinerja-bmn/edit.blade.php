<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    {{ __('Edit Data Kinerja BMN') }}
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Perbarui data kinerja - {{ $kinerjaBmn->nama_kegiatan }}
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
            <!-- Current Data Summary -->
            <div class="bg-gradient-to-r from-purple-50 to-indigo-50 rounded-2xl p-6 mb-8 border border-purple-200">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Ringkasan Data Saat Ini</h3>
                        <p class="text-sm text-gray-600">Data kinerja sebelum perubahan</p>
                    </div>
                    <div class="h-12 w-12 rounded-xl bg-purple-500 flex items-center justify-center">
                        <i class="fas fa-chart-line text-white"></i>
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
                        <div class="text-xs text-gray-600">{{ $kinerjaBmn->persentase_anggaran }}%</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-gray-900">
                            @php
                                $monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
                            @endphp
                            {{ $monthNames[$kinerjaBmn->bulan - 1] ?? $kinerjaBmn->bulan }} {{ $kinerjaBmn->tahun }}
                        </div>
                        <div class="text-xs text-gray-600">Periode</div>
                    </div>
                    <div class="text-center">
                        @php
                            $statusColors = [
                                'Completed' => 'bg-green-100 text-green-800',
                                'On Progress' => 'bg-blue-100 text-blue-800',
                                'Delayed' => 'bg-red-100 text-red-800',
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
                <div class="mt-4 text-sm text-gray-600">
                    <i class="fas fa-calendar-alt mr-1"></i>
                    Durasi: {{ $kinerjaBmn->tanggal_mulai?->format('d/m/Y') }} - {{ $kinerjaBmn->tanggal_selesai?->format('d/m/Y') ?? 'Sedang berjalan' }}
                </div>
            </div>

            <!-- Form Container -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-200">
                <!-- Form Header -->
                <div class="bg-gradient-to-r from-purple-50 to-indigo-50 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="h-10 w-10 rounded-lg bg-purple-500 flex items-center justify-center mr-3">
                            <i class="fas fa-edit text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Form Edit Kinerja</h3>
                            <p class="text-sm text-gray-600">Perbarui data kinerja dengan informasi terbaru</p>
                        </div>
                    </div>
                </div>

                <!-- Form Content -->
                <form action="{{ route('admin.kinerja-bmn.update', $kinerjaBmn) }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')

                    <!-- Success/Error Messages -->
                    @if ($errors->any())
                    <div class="mb-6 bg-gradient-to-r from-red-50 to-rose-50 border-l-4 border-red-500 rounded-xl p-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center">
                                    <i class="fas fa-exclamation-triangle text-red-600"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-sm font-medium text-red-800">Terdapat {{ $errors->count() }} kesalahan dalam pengisian form</h4>
                                <ul class="mt-1 text-sm text-red-700 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Jenis Kegiatan -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">
                                <div class="flex items-center">
                                    <i class="fas fa-tasks text-blue-500 mr-2 text-sm"></i>
                                    Jenis Kegiatan
                                    <span class="text-red-500 ml-1">*</span>
                                </div>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-project-diagram text-gray-400"></i>
                                </div>
                                <select name="jenis_kegiatan" required
                                    class="input-field pl-10 @error('jenis_kegiatan') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror">
                                    <option value="">Pilih Jenis Kegiatan</option>
                                    <option value="Pengadaan" {{ old('jenis_kegiatan', $kinerjaBmn->jenis_kegiatan) == 'Pengadaan' ? 'selected' : '' }}>Pengadaan</option>
                                    <option value="Pemeliharaan" {{ old('jenis_kegiatan', $kinerjaBmn->jenis_kegiatan) == 'Pemeliharaan' ? 'selected' : '' }}>Pemeliharaan</option>
                                    <option value="Penghapusan" {{ old('jenis_kegiatan', $kinerjaBmn->jenis_kegiatan) == 'Penghapusan' ? 'selected' : '' }}>Penghapusan</option>
                                    <option value="Rehabilitasi" {{ old('jenis_kegiatan', $kinerjaBmn->jenis_kegiatan) == 'Rehabilitasi' ? 'selected' : '' }}>Rehabilitasi</option>
                                </select>
                            </div>
                            @error('jenis_kegiatan')
                            <p class="text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- Nama Kegiatan -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">
                                <div class="flex items-center">
                                    <i class="fas fa-file-signature text-blue-500 mr-2 text-sm"></i>
                                    Nama Kegiatan
                                    <span class="text-red-500 ml-1">*</span>
                                </div>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-file-alt text-gray-400"></i>
                                </div>
                                <input type="text" name="nama_kegiatan" value="{{ old('nama_kegiatan', $kinerjaBmn->nama_kegiatan) }}" required
                                    class="input-field pl-10 @error('nama_kegiatan') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror"
                                    placeholder="Masukkan nama kegiatan">
                            </div>
                            @error('nama_kegiatan')
                            <p class="text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- Target -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">
                                <div class="flex items-center">
                                    <i class="fas fa-bullseye text-blue-500 mr-2 text-sm"></i>
                                    Target
                                    <span class="text-red-500 ml-1">*</span>
                                </div>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-flag text-gray-400"></i>
                                </div>
                                <input type="number" name="target" value="{{ old('target', $kinerjaBmn->target) }}" required min="1"
                                    class="input-field pl-10 @error('target') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror"
                                    placeholder="Masukkan target">
                            </div>
                            @error('target')
                            <p class="text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- Realisasi -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">
                                <div class="flex items-center">
                                    <i class="fas fa-check-circle text-blue-500 mr-2 text-sm"></i>
                                    Realisasi
                                    <span class="text-red-500 ml-1">*</span>
                                </div>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-chart-bar text-gray-400"></i>
                                </div>
                                <input type="number" name="realisasi" value="{{ old('realisasi', $kinerjaBmn->realisasi) }}" required min="0" max="{{ old('target', $kinerjaBmn->target) }}"
                                    class="input-field pl-10 @error('realisasi') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror"
                                    placeholder="Masukkan realisasi">
                            </div>
                            <div class="flex items-center justify-between text-xs text-gray-500">
                                <span id="persentaseDisplay">
                                    @php
                                        $persentase = $kinerjaBmn->target > 0 ? ($kinerjaBmn->realisasi / $kinerjaBmn->target) * 100 : 0;
                                    @endphp
                                    {{ number_format($persentase, 1) }}% dari target
                                </span>
                                <span class="text-blue-600 cursor-pointer" onclick="autoCalculateRealisasi()">
                                    <i class="fas fa-calculator mr-1"></i> Hitung otomatis
                                </span>
                            </div>
                            @error('realisasi')
                            <p class="text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- Anggaran -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">
                                <div class="flex items-center">
                                    <i class="fas fa-money-bill-wave text-blue-500 mr-2 text-sm"></i>
                                    Anggaran (Rp)
                                    <span class="text-red-500 ml-1">*</span>
                                </div>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500">Rp</span>
                                </div>
                                <input type="number" name="anggaran" id="anggaran" value="{{ old('anggaran', $kinerjaBmn->anggaran) }}" required min="0"
                                    class="input-field pl-12 @error('anggaran') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror"
                                    placeholder="0">
                            </div>
                            <p class="text-xs text-gray-500">Total anggaran yang dialokasikan</p>
                            @error('anggaran')
                            <p class="text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- Realisasi Anggaran -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">
                                <div class="flex items-center">
                                    <i class="fas fa-file-invoice-dollar text-blue-500 mr-2 text-sm"></i>
                                    Realisasi Anggaran (Rp)
                                    <span class="text-red-500 ml-1">*</span>
                                </div>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500">Rp</span>
                                </div>
                                <input type="number" name="realisasi_anggaran" id="realisasi_anggaran" value="{{ old('realisasi_anggaran', $kinerjaBmn->realisasi_anggaran) }}" required min="0"
                                    class="input-field pl-12 @error('realisasi_anggaran') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror"
                                    placeholder="0">
                            </div>
                            <div class="flex items-center justify-between text-xs text-gray-500">
                                <span id="persentaseAnggaranDisplay">
                                    @php
                                        $persentaseAnggaran = $kinerjaBmn->anggaran > 0 ? ($kinerjaBmn->realisasi_anggaran / $kinerjaBmn->anggaran) * 100 : 0;
                                    @endphp
                                    {{ number_format($persentaseAnggaran, 1) }}% dari anggaran
                                </span>
                                <span class="text-blue-600 cursor-pointer" onclick="autoCalculateRealisasiAnggaran()">
                                    <i class="fas fa-calculator mr-1"></i> Hitung otomatis
                                </span>
                            </div>
                            @error('realisasi_anggaran')
                            <p class="text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">
                                <div class="flex items-center">
                                    <i class="fas fa-heartbeat text-blue-500 mr-2 text-sm"></i>
                                    Status
                                    <span class="text-red-500 ml-1">*</span>
                                </div>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-clipboard-check text-gray-400"></i>
                                </div>
                                <select name="status" required
                                    class="input-field pl-10 @error('status') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror">
                                    <option value="">Pilih Status</option>
                                    <option value="On Progress" {{ old('status', $kinerjaBmn->status) == 'On Progress' ? 'selected' : '' }}>On Progress</option>
                                    <option value="Completed" {{ old('status', $kinerjaBmn->status) == 'Completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="Delayed" {{ old('status', $kinerjaBmn->status) == 'Delayed' ? 'selected' : '' }}>Delayed</option>
                                    <option value="Pending" {{ old('status', $kinerjaBmn->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                                </select>
                            </div>
                            <div class="flex items-center space-x-2 text-xs text-gray-500 mt-1">
                                <span class="px-2 py-0.5 bg-blue-100 text-blue-800 rounded">On Progress</span>
                                <span class="px-2 py-0.5 bg-green-100 text-green-800 rounded">Completed</span>
                                <span class="px-2 py-0.5 bg-red-100 text-red-800 rounded">Delayed</span>
                            </div>
                            @error('status')
                            <p class="text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- Tanggal Mulai -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">
                                <div class="flex items-center">
                                    <i class="fas fa-calendar-plus text-blue-500 mr-2 text-sm"></i>
                                    Tanggal Mulai
                                    <span class="text-red-500 ml-1">*</span>
                                </div>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-play text-gray-400"></i>
                                </div>
                                <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai', $kinerjaBmn->tanggal_mulai?->format('Y-m-d')) }}" required
                                    class="input-field pl-10 @error('tanggal_mulai') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror">
                            </div>
                            @error('tanggal_mulai')
                            <p class="text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- Tanggal Selesai -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">
                                <div class="flex items-center">
                                    <i class="fas fa-calendar-check text-blue-500 mr-2 text-sm"></i>
                                    Tanggal Selesai
                                </div>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-flag-checkered text-gray-400"></i>
                                </div>
                                <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai', $kinerjaBmn->tanggal_selesai?->format('Y-m-d')) }}"
                                    class="input-field pl-10 @error('tanggal_selesai') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror">
                            </div>
                            <p class="text-xs text-gray-500">Kosongkan jika belum selesai</p>
                            @error('tanggal_selesai')
                            <p class="text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- Bulan -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">
                                <div class="flex items-center">
                                    <i class="fas fa-calendar-alt text-blue-500 mr-2 text-sm"></i>
                                    Bulan
                                    <span class="text-red-500 ml-1">*</span>
                                </div>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-calendar text-gray-400"></i>
                                </div>
                                <select name="bulan" required
                                    class="input-field pl-10 @error('bulan') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror">
                                    <option value="">Pilih Bulan</option>
                                    @php
                                        $monthNames = [
                                            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                                            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                                            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                                        ];
                                    @endphp
                                    @for($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ old('bulan', $kinerjaBmn->bulan) == $i ? 'selected' : '' }}>
                                            {{ $monthNames[$i] }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            @error('bulan')
                            <p class="text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- Tahun -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">
                                <div class="flex items-center">
                                    <i class="fas fa-calendar-day text-blue-500 mr-2 text-sm"></i>
                                    Tahun
                                    <span class="text-red-500 ml-1">*</span>
                                </div>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-calendar-week text-gray-400"></i>
                                </div>
                                <input type="number" name="tahun" value="{{ old('tahun', $kinerjaBmn->tahun) }}" required
                                    min="2000" max="{{ date('Y') + 1 }}"
                                    class="input-field pl-10 @error('tahun') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror"
                                    placeholder="{{ date('Y') }}">
                            </div>
                            <p class="text-xs text-gray-500">Tahun pelaporan kinerja</p>
                            @error('tahun')
                            <p class="text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- Keterangan -->
                        <div class="md:col-span-2 space-y-2">
                            <label class="block text-sm font-medium text-gray-700">
                                <div class="flex items-center">
                                    <i class="fas fa-sticky-note text-blue-500 mr-2 text-sm"></i>
                                    Keterangan
                                </div>
                            </label>
                            <div class="relative">
                                <div class="absolute top-3 left-3">
                                    <i class="fas fa-comment-alt text-gray-400"></i>
                                </div>
                                <textarea name="keterangan" rows="4"
                                    class="w-full px-4 py-3 pl-10 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-all duration-200 @error('keterangan') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror"
                                    placeholder="Masukkan keterangan tambahan tentang kinerja...">{{ old('keterangan', $kinerjaBmn->keterangan) }}</textarea>
                            </div>
                            <p class="text-xs text-gray-500">Opsional: informasi tambahan tentang kinerja</p>
                            @error('keterangan')
                            <p class="text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div class="text-sm text-gray-600">
                                <i class="fas fa-info-circle text-blue-500 mr-1"></i>
                                Kolom dengan tanda <span class="text-red-500">*</span> wajib diisi
                            </div>
                            <div class="flex items-center space-x-3">
                                <a href="{{ route('admin.kinerja-bmn.index') }}"
                                   class="btn-secondary flex items-center justify-center w-full sm:w-auto">
                                    <i class="fas fa-times mr-2"></i>
                                    Batal
                                </a>
                                <button type="button" onclick="validateAndPreview()"
                                        class="btn-secondary flex items-center justify-center w-full sm:w-auto">
                                    <i class="fas fa-eye mr-2"></i>
                                    Preview
                                </button>
                                <button type="submit"
                                        class="btn-primary flex items-center justify-center w-full sm:w-auto">
                                    <i class="fas fa-save mr-2"></i>
                                    Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Form Tips -->
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                    <div class="flex items-start">
                        <div class="h-8 w-8 rounded-full bg-purple-100 flex items-center justify-center mr-3 flex-shrink-0">
                            <i class="fas fa-lightbulb text-purple-600 text-sm"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-900">Tips Editing Kinerja</h4>
                            <ul class="mt-1 text-xs text-gray-600 list-disc list-inside space-y-1">
                                <li>Pastikan realisasi tidak melebihi target yang ditetapkan</li>
                                <li>Update status menjadi "Completed" jika kegiatan telah selesai</li>
                                <li>Isi tanggal selesai untuk menandai penyelesaian kegiatan</li>
                                <li>Periksa konsistensi antara realisasi fisik dan realisasi anggaran</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Change History (Optional) -->
            @if($kinerjaBmn->created_at != $kinerjaBmn->updated_at)
            <div class="mt-6 bg-gradient-to-r from-gray-50 to-blue-50 rounded-2xl p-6 border border-gray-200">
                <div class="flex items-center mb-4">
                    <i class="fas fa-history text-gray-500 mr-2"></i>
                    <h4 class="text-sm font-medium text-gray-900">Riwayat Perubahan</h4>
                </div>
                <div class="space-y-2">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Dibuat pada:</span>
                        <span class="font-medium text-gray-900">{{ $kinerjaBmn->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Terakhir diupdate:</span>
                        <span class="font-medium text-gray-900">{{ $kinerjaBmn->updated_at->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Selisih waktu:</span>
                        <span class="font-medium text-gray-900">{{ $kinerjaBmn->created_at->diffInDays($kinerjaBmn->updated_at) }} hari</span>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    @push('scripts')
    <script>
        // Real-time percentage calculation
        const targetInput = document.querySelector('input[name="target"]');
        const realisasiInput = document.querySelector('input[name="realisasi"]');
        const persentaseDisplay = document.getElementById('persentaseDisplay');

        const anggaranInput = document.getElementById('anggaran');
        const realisasiAnggaranInput = document.getElementById('realisasi_anggaran');
        const persentaseAnggaranDisplay = document.getElementById('persentaseAnggaranDisplay');

        function updatePersentase() {
            const target = parseFloat(targetInput.value) || 0;
            const realisasi = parseFloat(realisasiInput.value) || 0;

            if (target > 0) {
                const persentase = (realisasi / target) * 100;
                persentaseDisplay.textContent = `${persentase.toFixed(1)}% dari target`;

                // Color coding
                if (persentase >= 90) {
                    persentaseDisplay.className = 'text-green-600';
                } else if (persentase >= 70) {
                    persentaseDisplay.className = 'text-yellow-600';
                } else {
                    persentaseDisplay.className = 'text-red-600';
                }

                // Validate max value
                if (realisasi > target) {
                    realisasiInput.setCustomValidity('Realisasi tidak boleh melebihi target');
                    realisasiInput.classList.add('border-red-300', 'focus:border-red-500', 'focus:ring-red-200');
                } else {
                    realisasiInput.setCustomValidity('');
                    realisasiInput.classList.remove('border-red-300', 'focus:border-red-500', 'focus:ring-red-200');
                }
            } else {
                persentaseDisplay.textContent = '0% dari target';
                persentaseDisplay.className = 'text-gray-600';
            }
        }

        function updatePersentaseAnggaran() {
            const anggaran = parseFloat(anggaranInput.value) || 0;
            const realisasiAnggaran = parseFloat(realisasiAnggaranInput.value) || 0;

            if (anggaran > 0) {
                const persentase = (realisasiAnggaran / anggaran) * 100;
                persentaseAnggaranDisplay.textContent = `${persentase.toFixed(1)}% dari anggaran`;

                // Color coding
                if (persentase <= 100) {
                    persentaseAnggaranDisplay.className = 'text-green-600';
                } else {
                    persentaseAnggaranDisplay.className = 'text-red-600';
                }

                // Validate max value suggestion
                if (realisasiAnggaran > anggaran) {
                    realisasiAnggaranInput.classList.add('border-yellow-300', 'focus:border-yellow-500', 'focus:ring-yellow-200');
                } else {
                    realisasiAnggaranInput.classList.remove('border-yellow-300', 'focus:border-yellow-500', 'focus:ring-yellow-200');
                }
            } else {
                persentaseAnggaranDisplay.textContent = '0% dari anggaran';
                persentaseAnggaranDisplay.className = 'text-gray-600';
            }
        }

        // Add event listeners
        if (targetInput && realisasiInput) {
            targetInput.addEventListener('input', updatePersentase);
            realisasiInput.addEventListener('input', updatePersentase);
        }

        if (anggaranInput && realisasiAnggaranInput) {
            anggaranInput.addEventListener('input', updatePersentaseAnggaran);
            realisasiAnggaranInput.addEventListener('input', updatePersentaseAnggaran);
        }

        // Auto-calculate functions
        function autoCalculateRealisasi() {
            const target = parseFloat(targetInput.value) || 0;
            if (target > 0) {
                // Suggest 80% of target as auto calculation
                const suggestedRealisasi = Math.round(target * 0.8);
                realisasiInput.value = suggestedRealisasi;
                updatePersentase();

                // Show notification
                showNotification(`Realisasi diatur ke ${suggestedRealisasi} (80% dari target)`);
            }
        }

        function autoCalculateRealisasiAnggaran() {
            const anggaran = parseFloat(anggaranInput.value) || 0;
            if (anggaran > 0) {
                // Suggest 85% of anggaran as auto calculation
                const suggestedRealisasiAnggaran = Math.round(anggaran * 0.85);
                realisasiAnggaranInput.value = suggestedRealisasiAnggaran;
                updatePersentaseAnggaran();

                // Show notification
                showNotification(`Realisasi anggaran diatur ke Rp ${suggestedRealisasiAnggaran.toLocaleString('id-ID')} (85% dari anggaran)`);
            }
        }

        // Form validation and preview
        function validateAndPreview() {
            const requiredFields = document.querySelectorAll('[required]');
            let isValid = true;

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('border-red-300', 'focus:border-red-500', 'focus:ring-red-200');

                    // Add error icon
                    if (!field.parentElement.querySelector('.fa-exclamation-circle')) {
                        const errorIcon = document.createElement('div');
                        errorIcon.className = 'absolute right-3 top-3';
                        errorIcon.innerHTML = '<i class="fas fa-exclamation-circle text-red-500"></i>';
                        field.parentElement.appendChild(errorIcon);
                    }
                }
            });

            if (!isValid) {
                showNotification('Harap isi semua kolom yang wajib diisi', 'error');
                return;
            }

            // Collect form data for preview
            const formData = new FormData(document.querySelector('form'));
            const previewData = {};

            for (let [key, value] of formData.entries()) {
                previewData[key] = value;
            }

            // Format dates
            const tanggalMulai = new Date(previewData.tanggal_mulai).toLocaleDateString('id-ID');
            const tanggalSelesai = previewData.tanggal_selesai ?
                new Date(previewData.tanggal_selesai).toLocaleDateString('id-ID') : 'Belum selesai';

            // Calculate percentages
            const persentaseRealisasi = previewData.target > 0 ?
                ((previewData.realisasi / previewData.target) * 100).toFixed(1) : 0;
            const persentaseAnggaran = previewData.anggaran > 0 ?
                ((previewData.realisasi_anggaran / previewData.anggaran) * 100).toFixed(1) : 0;

            // Show preview
            const previewContent = `
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="font-medium">Jenis Kegiatan:</span>
                        <span>${previewData.jenis_kegiatan}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="font-medium">Nama Kegiatan:</span>
                        <span>${previewData.nama_kegiatan}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="font-medium">Realisasi:</span>
                        <span>${previewData.realisasi}/${previewData.target} (${persentaseRealisasi}%)</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="font-medium">Anggaran:</span>
                        <span>Rp ${parseFloat(previewData.realisasi_anggaran).toLocaleString('id-ID')} / Rp ${parseFloat(previewData.anggaran).toLocaleString('id-ID')}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="font-medium">Status:</span>
                        <span>${previewData.status}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="font-medium">Periode:</span>
                        <span>${previewData.bulan}/${previewData.tahun}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="font-medium">Tanggal:</span>
                        <span>${tanggalMulai} - ${tanggalSelesai}</span>
                    </div>
                </div>
            `;

            showPreviewModal('Preview Perubahan Data', previewContent);
        }

        // Helper functions
        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 px-4 py-3 rounded-lg shadow-lg ${type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'}`;
            notification.innerHTML = `
                <div class="flex items-center">
                    <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} mr-2"></i>
                    <span>${message}</span>
                </div>
            `;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        function showPreviewModal(title, content) {
            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-center justify-center';
            modal.innerHTML = `
                <div class="relative bg-white rounded-2xl shadow-xl max-w-md w-full mx-4">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">${title}</h3>
                    </div>
                    <div class="p-6">
                        ${content}
                    </div>
                    <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
                        <button onclick="this.closest('.fixed').remove()"
                                class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                            Tutup
                        </button>
                        <button onclick="document.querySelector('form').submit()"
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Konfirmasi & Simpan
                        </button>
                    </div>
                </div>
            `;

            document.body.appendChild(modal);
        }

        // Initialize on load
        document.addEventListener('DOMContentLoaded', function() {
            updatePersentase();
            updatePersentaseAnggaran();

            // Format number inputs on blur
            document.querySelectorAll('input[type="number"][name*="anggaran"]').forEach(input => {
                input.addEventListener('blur', function() {
                    if (this.value) {
                        const value = parseFloat(this.value);
                        this.value = value;
                    }
                });
            });
        });
    </script>
    @endpush
</x-app-layout>
