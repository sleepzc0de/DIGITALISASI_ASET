<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Manajemen Daftar Aplikasi BMN') }}
            </h2>
            <a href="{{ route('admin.aplikasi-bmn.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition duration-200">
                + Tambah Aplikasi
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Filter Section -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
            <form method="GET" action="{{ route('admin.aplikasi-bmn.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <select name="kategori" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Semua Kategori</option>
                        <option value="BMN" {{ request('kategori') == 'BMN' ? 'selected' : '' }}>BMN</option>
                        <option value="Pengadaan" {{ request('kategori') == 'Pengadaan' ? 'selected' : '' }}>Pengadaan</option>
                        <option value="Inventaris" {{ request('kategori') == 'Inventaris' ? 'selected' : '' }}>Inventaris</option>
                        <option value="Monitoring" {{ request('kategori') == 'Monitoring' ? 'selected' : '' }}>Monitoring</option>
                    </select>
                </div>
                <div>
                    <select name="status" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Semua Status</option>
                        <option value="Aktif" {{ request('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Maintenance" {{ request('status') == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                        <option value="Non-Aktif" {{ request('status') == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aplikasi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vendor</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Users</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Expired</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($aplikasis as $aplikasi)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img src="{{ $aplikasi->getLogoUrl() }}" alt="{{ $aplikasi->nama_aplikasi }}" class="w-10 h-10 rounded-lg mr-3">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $aplikasi->nama_aplikasi }}</div>
                                        @if($aplikasi->versi)
                                        <div class="text-xs text-gray-500">v{{ $aplikasi->versi }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $aplikasi->getKategoriBadgeClass() }}">
                                    {{ $aplikasi->kategori }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $aplikasi->vendor ?? '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $aplikasi->getStatusBadgeClass() }}">
                                    {{ $aplikasi->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ number_format($aplikasi->jumlah_user) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @if($aplikasi->tanggal_expired)
                                    <span class="{{ $aplikasi->isExpiringSoon() ? 'text-orange-600 font-medium' : 'text-gray-900' }} {{ $aplikasi->isExpired() ? 'text-red-600 font-medium' : '' }}">
                                        {{ $aplikasi->tanggal_expired->format('d M Y') }}
                                        @if($aplikasi->isExpiringSoon())
                                            <span class="block text-xs">{{ $aplikasi->tanggal_expired->diffInDays(now()) }} hari lagi</span>
                                        @endif
                                    </span>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.aplikasi-bmn.edit', $aplikasi) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                <form action="{{ route('admin.aplikasi-bmn.destroy', $aplikasi) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin hapus aplikasi ini?')" class="text-red-600 hover:text-red-900">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">Belum ada data aplikasi</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t border-gray-200">
                {{ $aplikasis->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
