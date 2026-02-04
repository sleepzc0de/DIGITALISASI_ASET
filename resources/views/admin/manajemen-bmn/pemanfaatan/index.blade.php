<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Kelola Pemanfaatan BMN') }}
            </h2>
            <a href="{{ route('admin.manajemen-bmn.pemanfaatan.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition duration-200">
                + Tambah Pemanfaatan
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Filter Section -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
            <form method="GET" action="{{ route('admin.manajemen-bmn.pemanfaatan.index') }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <select name="jenis" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Semua Jenis</option>
                        <option value="SK Sewa" {{ request('jenis') == 'SK Sewa' ? 'selected' : '' }}>SK Sewa</option>
                        <option value="Izin Penghunian" {{ request('jenis') == 'Izin Penghunian' ? 'selected' : '' }}>Izin Penghunian</option>
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomor SK</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pihak Ketiga</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($pemanfaatans as $pemanfaatan)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $pemanfaatan->nomor_sk }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                {{ $pemanfaatan->nama_pihak_ketiga }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $pemanfaatan->jenis_pemanfaatan == 'SK Sewa' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ $pemanfaatan->jenis_pemanfaatan }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                {{ Str::limit($pemanfaatan->alamat_objek, 30) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $pemanfaatan->getStatusBadgeClass() }}">
                                    {{ $pemanfaatan->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.manajemen-bmn.pemanfaatan.edit', $pemanfaatan) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                <form action="{{ route('admin.manajemen-bmn.pemanfaatan.destroy', $pemanfaatan) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin hapus data ini?')" class="text-red-600 hover:text-red-900">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada data pemanfaatan BMN</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t border-gray-200">
                {{ $pemanfaatans->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
