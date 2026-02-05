<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Kelola Penatausahaan BMN') }}
            </h2>
            <a href="{{ route('admin.manajemen-bmn.penatausahaan.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition duration-200">
                + Tambah Data BMN
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Filter Section -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
            <form method="GET" action="{{ route('admin.manajemen-bmn.penatausahaan.index') }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <select name="kategori" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Semua Kategori</option>
                        <option value="Tanah" {{ request('kategori') == 'Tanah' ? 'selected' : '' }}>Tanah</option>
                        <option value="Gedung Bangunan" {{ request('kategori') == 'Gedung Bangunan' ? 'selected' : '' }}>Gedung Bangunan</option>
                        <option value="Rumah Negara" {{ request('kategori') == 'Rumah Negara' ? 'selected' : '' }}>Rumah Negara</option>
                        <option value="Kendaraan Dinas Operasional" {{ request('kategori') == 'Kendaraan Dinas Operasional' ? 'selected' : '' }}>Kendaraan Dinas Operasional</option>
                        <option value="Kendaraan Dinas Jabatan" {{ request('kategori') == 'Kendaraan Dinas Jabatan' ? 'selected' : '' }}>Kendaraan Dinas Jabatan</option>
                        <option value="Kendaraan Dinas Fungsional" {{ request('kategori') == 'Kendaraan Dinas Fungsional' ? 'selected' : '' }}>Kendaraan Dinas Fungsional</option>
                        <option value="Peralatan Kantor" {{ request('kategori') == 'Peralatan Kantor' ? 'selected' : '' }}>Peralatan Kantor</option>
                        <option value="Lainnya" {{ request('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode Barang</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Barang</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kondisi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($penatausahaans as $penatausahaan)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $penatausahaan->kode_barang }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                <div class="flex items-center">
                                    <img src="{{ $penatausahaan->getFotoUrl() }}" alt="{{ $penatausahaan->nama_barang }}"
                                        class="h-10 w-10 rounded-lg object-cover mr-3">
                                    <span>{{ Str::limit($penatausahaan->nama_barang, 30) }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $penatausahaan->getKategoriBadgeClass() }}">
                                    {{ $penatausahaan->kategori }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $penatausahaan->getKondisiBadgeClass() }}">
                                    {{ $penatausahaan->kondisi }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                {{ Str::limit($penatausahaan->lokasi, 25) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                    {{ $penatausahaan->status_aset }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.manajemen-bmn.penatausahaan.edit', $penatausahaan) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                <form action="{{ route('admin.manajemen-bmn.penatausahaan.destroy', $penatausahaan) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin hapus data ini?')" class="text-red-600 hover:text-red-900">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">Belum ada data penatausahaan BMN</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $penatausahaans->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
