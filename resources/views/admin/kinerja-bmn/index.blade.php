<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Manajemen Data Kinerja BMN') }}
            </h2>
            <a href="{{ route('admin.kinerja-bmn.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition duration-200">
                + Tambah Kinerja
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kegiatan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Realisasi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Anggaran</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Periode</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($kinerjas as $kinerja)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if($kinerja->jenis_kegiatan == 'Pengadaan') bg-blue-100 text-blue-800
                                    @elseif($kinerja->jenis_kegiatan == 'Pemeliharaan') bg-purple-100 text-purple-800
                                    @else bg-orange-100 text-orange-800 @endif">
                                    {{ $kinerja->jenis_kegiatan }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $kinerja->nama_kegiatan }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $kinerja->realisasi }}/{{ $kinerja->target }}</div>
                                <div class="text-xs text-gray-500">{{ number_format($kinerja->persentase_realisasi, 1) }}%</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">Rp {{ number_format($kinerja->realisasi_anggaran / 1000000, 1) }}M</div>
                                <div class="text-xs text-gray-500">dari {{ number_format($kinerja->anggaran / 1000000, 1) }}M</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if($kinerja->status == 'Completed') bg-green-100 text-green-800
                                    @elseif($kinerja->status == 'On Progress') bg-blue-100 text-blue-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ $kinerja->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ \Carbon\Carbon::create()->month($kinerja->bulan)->format('M') }} {{ $kinerja->tahun }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.kinerja-bmn.edit', $kinerja) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                <form action="{{ route('admin.kinerja-bmn.destroy', $kinerja) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin hapus data ini?')" class="text-red-600 hover:text-red-900">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">Belum ada data kinerja</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t border-gray-200">
                {{ $kinerjas->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
