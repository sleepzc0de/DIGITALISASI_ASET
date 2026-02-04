<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Kelola Perencanaan BMN') }}
            </h2>
            <a href="{{ route('admin.manajemen-bmn.perencanaan.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition duration-200">
                + Tambah Perencanaan
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Filter Section -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
            <form method="GET" action="{{ route('admin.manajemen-bmn.perencanaan.index') }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <select name="jenis" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Semua Jenis</option>
                        <option value="RP4" {{ request('jenis') == 'RP4' ? 'selected' : '' }}>RP4</option>
                        <option value="RKBMN" {{ request('jenis') == 'RKBMN' ? 'selected' : '' }}>RKBMN</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="w-full px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                        Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomor Dokumen</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tahun</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($perencanaans as $perencanaan)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $perencanaan->nomor_dokumen }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                {{ Str::limit($perencanaan->judul, 50) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $perencanaan->jenis_perencanaan == 'RP4' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                    {{ $perencanaan->jenis_perencanaan }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $perencanaan->tahun_anggaran }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $perencanaan->getStatusBadgeClass() }}">
                                    {{ $perencanaan->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.manajemen-bmn.perencanaan.edit', $perencanaan) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                <form action="{{ route('admin.manajemen-bmn.perencanaan.destroy', $perencanaan) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin hapus data ini?')" class="text-red-600 hover:text-red-900">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada data perencanaan BMN</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t border-gray-200">
                {{ $perencanaans->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
