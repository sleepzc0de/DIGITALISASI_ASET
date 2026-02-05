<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Edit Wasdal BMN') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <form action="{{ route('admin.manajemen-bmn.wasdal.update', $wasdal) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Jenis Wasdal -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Wasdal <span class="text-red-500">*</span></label>
                        <select name="jenis_wasdal" required class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Pilih Jenis</option>
                            <option value="Pelaporan BMN" {{ old('jenis_wasdal', $wasdal->jenis_wasdal) == 'Pelaporan BMN' ? 'selected' : '' }}>Pelaporan BMN</option>
                            <option value="Sensus BMN" {{ old('jenis_wasdal', $wasdal->jenis_wasdal) == 'Sensus BMN' ? 'selected' : '' }}>Sensus BMN</option>
                        </select>
                        @error('jenis_wasdal')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nomor Laporan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Laporan <span class="text-red-500">*</span></label>
                        <input type="text" name="nomor_laporan" value="{{ old('nomor_laporan', $wasdal->nomor_laporan) }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('nomor_laporan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Judul -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Judul <span class="text-red-500">*</span></label>
                        <input type="text" name="judul" value="{{ old('judul', $wasdal->judul) }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('judul')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Periode -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Periode <span class="text-red-500">*</span></label>
                        <select name="periode" required class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Pilih Periode</option>
                            <option value="Triwulan I" {{ old('periode', $wasdal->periode) == 'Triwulan I' ? 'selected' : '' }}>Triwulan I</option>
                            <option value="Triwulan II" {{ old('periode', $wasdal->periode) == 'Triwulan II' ? 'selected' : '' }}>Triwulan II</option>
                            <option value="Triwulan III" {{ old('periode', $wasdal->periode) == 'Triwulan III' ? 'selected' : '' }}>Triwulan III</option>
                            <option value="Triwulan IV" {{ old('periode', $wasdal->periode) == 'Triwulan IV' ? 'selected' : '' }}>Triwulan IV</option>
                            <option value="Semester I" {{ old('periode', $wasdal->periode) == 'Semester I' ? 'selected' : '' }}>Semester I</option>
                            <option value="Semester II" {{ old('periode', $wasdal->periode) == 'Semester II' ? 'selected' : '' }}>Semester II</option>
                            <option value="Tahunan" {{ old('periode', $wasdal->periode) == 'Tahunan' ? 'selected' : '' }}>Tahunan</option>
                            <option value="Insidental" {{ old('periode', $wasdal->periode) == 'Insidental' ? 'selected' : '' }}>Insidental</option>
                        </select>
                        @error('periode')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tahun -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tahun <span class="text-red-500">*</span></label>
                        <input type="number" name="tahun" value="{{ old('tahun', $wasdal->tahun) }}" required min="2000" max="{{ date('Y') + 1 }}"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('tahun')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Laporan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Laporan <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_laporan" value="{{ old('tanggal_laporan', $wasdal->tanggal_laporan->format('Y-m-d')) }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('tanggal_laporan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status <span class="text-red-500">*</span></label>
                        <select name="status" required class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="Draft" {{ old('status', $wasdal->status) == 'Draft' ? 'selected' : '' }}>Draft</option>
                            <option value="Submitted" {{ old('status', $wasdal->status) == 'Submitted' ? 'selected' : '' }}>Submitted</option>
                            <option value="Reviewed" {{ old('status', $wasdal->status) == 'Reviewed' ? 'selected' : '' }}>Reviewed</option>
                            <option value="Approved" {{ old('status', $wasdal->status) == 'Approved' ? 'selected' : '' }}>Approved</option>
                            <option value="Rejected" {{ old('status', $wasdal->status) == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Mulai Pelaksanaan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai Pelaksanaan</label>
                        <input type="date" name="tanggal_mulai_pelaksanaan" value="{{ old('tanggal_mulai_pelaksanaan', $wasdal->tanggal_mulai_pelaksanaan?->format('Y-m-d')) }}"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('tanggal_mulai_pelaksanaan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Selesai Pelaksanaan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Selesai Pelaksanaan</label>
                        <input type="date" name="tanggal_selesai_pelaksanaan" value="{{ old('tanggal_selesai_pelaksanaan', $wasdal->tanggal_selesai_pelaksanaan?->format('Y-m-d')) }}"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('tanggal_selesai_pelaksanaan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jumlah Aset Tercatat -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Aset Tercatat</label>
                        <input type="number" name="jumlah_aset_tercatat" value="{{ old('jumlah_aset_tercatat', $wasdal->jumlah_aset_tercatat) }}" min="0"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('jumlah_aset_tercatat')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jumlah Aset Terverifikasi -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Aset Terverifikasi</label>
                        <input type="number" name="jumlah_aset_terverifikasi" value="{{ old('jumlah_aset_terverifikasi', $wasdal->jumlah_aset_terverifikasi) }}" min="0"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('jumlah_aset_terverifikasi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Total Nilai Buku -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Total Nilai Buku (Rp)</label>
                        <input type="number" name="total_nilai_buku" value="{{ old('total_nilai_buku', $wasdal->total_nilai_buku) }}" min="0" step="0.01"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('total_nilai_buku')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Aset Kondisi Baik -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Aset Kondisi Baik</label>
                        <input type="number" name="aset_kondisi_baik" value="{{ old('aset_kondisi_baik', $wasdal->aset_kondisi_baik) }}" min="0"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('aset_kondisi_baik')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Aset Kondisi Rusak Ringan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Aset Kondisi Rusak Ringan</label>
                        <input type="number" name="aset_kondisi_rusak_ringan" value="{{ old('aset_kondisi_rusak_ringan', $wasdal->aset_kondisi_rusak_ringan) }}" min="0"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('aset_kondisi_rusak_ringan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Aset Kondisi Rusak Berat -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Aset Kondisi Rusak Berat</label>
                        <input type="number" name="aset_kondisi_rusak_berat" value="{{ old('aset_kondisi_rusak_berat', $wasdal->aset_kondisi_rusak_berat) }}" min="0"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('aset_kondisi_rusak_berat')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Petugas Pelaksana -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Petugas Pelaksana</label>
                        <input type="text" name="petugas_pelaksana" value="{{ old('petugas_pelaksana', $wasdal->petugas_pelaksana) }}"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('petugas_pelaksana')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pejabat Penerima -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pejabat Penerima</label>
                        <input type="text" name="pejabat_penerima" value="{{ old('pejabat_penerima', $wasdal->pejabat_penerima) }}"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('pejabat_penerima')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Temuan -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Temuan</label>
                        <textarea name="temuan" rows="3"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('temuan', $wasdal->temuan) }}</textarea>
                        @error('temuan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Rekomendasi -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Rekomendasi</label>
                        <textarea name="rekomendasi" rows="3"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('rekomendasi', $wasdal->rekomendasi) }}</textarea>
                        @error('rekomendasi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- File Laporan -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">File Laporan</label>
                        @if($wasdal->file_laporan)
                        <div class="mb-2">
                            <a href="{{ $wasdal->getFileLaporanUrl() }}" target="_blank" class="text-sm text-indigo-600 hover:text-indigo-800">
                                📄 File laporan saat ini
                            </a>
                        </div>
                        @endif
                        <input type="file" name="file_laporan" accept=".pdf"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        <p class="mt-1 text-xs text-gray-500">Format: PDF. Maksimal 5MB. Kosongkan jika tidak ingin mengubah.</p>
                        @error('file_laporan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- File Lampiran -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">File Lampiran</label>
                        @if($wasdal->file_lampiran)
                        <div class="mb-2">
                            <a href="{{ $wasdal->getFileLampiranUrl() }}" target="_blank" class="text-sm text-indigo-600 hover:text-indigo-800">
                                📎 File lampiran saat ini
                            </a>
                        </div>
                        @endif
                        <input type="file" name="file_lampiran" accept=".pdf,.zip,.rar"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        <p class="mt-1 text-xs text-gray-500">Format: PDF, ZIP, RAR. Maksimal 10MB. Kosongkan jika tidak ingin mengubah.</p>
                        @error('file_lampiran')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Keterangan -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                        <textarea name="keterangan" rows="3"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('keterangan', $wasdal->keterangan) }}</textarea>
                        @error('keterangan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-8 flex justify-end space-x-3">
                    <a href="{{ route('admin.manajemen-bmn.wasdal.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
