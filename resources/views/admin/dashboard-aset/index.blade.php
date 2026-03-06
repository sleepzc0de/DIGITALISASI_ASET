<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">{{ __('Manajemen Data Aset') }}</h2>
                <p class="mt-1 text-sm text-gray-600">Kelola dan pantau seluruh data aset BMN secara terpusat</p>
            </div>
            <div class="flex items-center space-x-3">
                {{-- Search: submit ke server, bukan hanya JS --}}
                <form method="GET" action="{{ route('admin.dashboard-aset.index') }}"
                      class="flex items-center gap-2" role="search">
                    <div class="relative">
                        <input type="text" name="search"
                               value="{{ request('search') }}"
                               placeholder="Cari aset..."
                               aria-label="Cari aset"
                               class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg
                                      focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                      focus:outline-none transition-all duration-200 w-full sm:w-64">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400" aria-hidden="true"></i>
                    </div>
                    {{-- Pertahankan filter kondisi yang aktif saat search --}}
                    @if(request('kondisi'))
                        <input type="hidden" name="kondisi" value="{{ request('kondisi') }}">
                    @endif
                    <button type="submit" class="sr-only">Cari</button>
                </form>
                <a href="{{ route('admin.dashboard-aset.create') }}"
                   class="btn-primary flex items-center whitespace-nowrap">
                    <i class="fas fa-plus mr-2" aria-hidden="true"></i>Tambah Aset
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- ── Summary Stats (data dari DB via $stats, bukan paginated collection) ── --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-2xl p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-blue-800 uppercase tracking-wide">Total Aset</p>
                            <h3 class="text-3xl font-bold text-gray-900 mt-2">
                                {{ number_format($stats->total_aset ?? 0) }}
                            </h3>
                        </div>
                        <div class="h-12 w-12 rounded-xl bg-blue-500 flex items-center justify-center">
                            <i class="fas fa-boxes text-white text-xl" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="mt-4 text-sm text-blue-700">
                        <i class="fas fa-list mr-1" aria-hidden="true"></i>
                        {{ $asets->lastPage() }} halaman data
                    </div>
                </div>

                <div class="bg-gradient-to-r from-green-50 to-green-100 rounded-2xl p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-green-800 uppercase tracking-wide">Total Nilai Buku</p>
                            <h3 class="text-3xl font-bold text-gray-900 mt-2">
                                Rp {{ number_format(($stats->total_nilai_buku ?? 0) / 1_000_000_000, 2) }}M
                            </h3>
                        </div>
                        <div class="h-12 w-12 rounded-xl bg-green-500 flex items-center justify-center">
                            <i class="fas fa-money-bill-wave text-white text-xl" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="mt-4 text-sm text-green-700">
                        <i class="fas fa-calculator mr-1" aria-hidden="true"></i>
                        Rata-rata Rp {{ number_format($stats->avg_nilai_buku ?? 0) }}
                    </div>
                </div>

                <div class="bg-gradient-to-r from-purple-50 to-purple-100 rounded-2xl p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-purple-800 uppercase tracking-wide">Kategori Aktif</p>
                            <h3 class="text-3xl font-bold text-gray-900 mt-2">
                                {{ number_format($stats->total_kategori ?? 0) }}
                            </h3>
                        </div>
                        <div class="h-12 w-12 rounded-xl bg-purple-500 flex items-center justify-center">
                            <i class="fas fa-layer-group text-white text-xl" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="mt-4 text-sm text-purple-700">
                        <i class="fas fa-tags mr-1" aria-hidden="true"></i>
                        {{ $stats->total_lokasi ?? 0 }} lokasi berbeda
                    </div>
                </div>
            </div>

            {{-- ── Filter & Sort ──────────────────────────────────────────────────── --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-4 mb-6">
                <form method="GET" action="{{ route('admin.dashboard-aset.index') }}"
                      class="flex flex-wrap items-center gap-3">
                    {{-- Pertahankan search yang aktif --}}
                    @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif

                    {{-- Filter Kondisi --}}
                    <select name="kondisi" onchange="this.form.submit()"
                            aria-label="Filter berdasarkan kondisi"
                            class="px-3 py-2 text-sm border border-gray-300 rounded-lg
                                   focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white">
                        <option value="">Semua Kondisi</option>
                        @foreach(['Baik','Rusak Ringan','Rusak Berat'] as $k)
                            <option value="{{ $k }}" {{ request('kondisi') === $k ? 'selected' : '' }}>
                                {{ $k }}
                            </option>
                        @endforeach
                    </select>

                    {{-- Sort --}}
                    <select name="sort" onchange="this.form.submit()"
                            aria-label="Urutkan berdasarkan"
                            class="px-3 py-2 text-sm border border-gray-300 rounded-lg
                                   focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white">
                        <option value="created_at" {{ request('sort','created_at')==='created_at' ? 'selected':'' }}>
                            Terbaru
                        </option>
                        <option value="kategori_aset" {{ request('sort')==='kategori_aset' ? 'selected':'' }}>
                            Kategori A–Z
                        </option>
                        <option value="nilai_buku" {{ request('sort')==='nilai_buku' ? 'selected':'' }}>
                            Nilai Buku
                        </option>
                        <option value="jumlah_unit" {{ request('sort')==='jumlah_unit' ? 'selected':'' }}>
                            Jumlah Unit
                        </option>
                        <option value="tahun" {{ request('sort')==='tahun' ? 'selected':'' }}>
                            Tahun
                        </option>
                    </select>

                    {{-- Arah sort --}}
                    <select name="dir" onchange="this.form.submit()"
                            aria-label="Arah urutan"
                            class="px-3 py-2 text-sm border border-gray-300 rounded-lg
                                   focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white">
                        <option value="desc" {{ request('dir','desc')==='desc' ? 'selected':'' }}>↓ Menurun</option>
                        <option value="asc"  {{ request('dir')==='asc'  ? 'selected':'' }}>↑ Menaik</option>
                    </select>

                    @if(request()->hasAny(['search','kondisi','sort','dir']))
                        <a href="{{ route('admin.dashboard-aset.index') }}"
                           class="px-3 py-2 text-sm text-red-600 hover:text-red-800
                                  hover:bg-red-50 rounded-lg transition-colors flex items-center gap-1">
                            <i class="fas fa-times" aria-hidden="true"></i> Reset
                        </a>
                    @endif

                    <div class="ml-auto text-sm text-gray-500">
                        Menampilkan
                        <span class="font-semibold text-gray-700">{{ $asets->firstItem() ?? 0 }}</span>–<span class="font-semibold text-gray-700">{{ $asets->lastItem() ?? 0 }}</span>
                        dari <span class="font-semibold text-gray-700">{{ $asets->total() }}</span>
                    </div>
                </form>
            </div>

            {{-- ── Tabel Utama ────────────────────────────────────────────────────── --}}
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                @php
                                    $cols = [
                                        ['key' => 'kategori_aset', 'label' => 'Kategori Aset'],
                                        ['key' => 'jumlah_unit',   'label' => 'Jumlah Unit'],
                                        ['key' => 'nilai_buku',    'label' => 'Nilai Buku'],
                                        ['key' => 'kondisi',       'label' => 'Kondisi'],
                                        ['key' => 'lokasi',        'label' => 'Lokasi'],
                                        ['key' => 'tahun',         'label' => 'Tahun'],
                                    ];
                                @endphp
                                @foreach($cols as $col)
                                    <th scope="col"
                                        class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        <a href="{{ request()->fullUrlWithQuery(['sort' => $col['key'], 'dir' => (request('sort') === $col['key'] && request('dir','desc') === 'asc') ? 'desc' : 'asc']) }}"
                                           class="flex items-center gap-1 hover:text-blue-600 transition-colors">
                                            {{ $col['label'] }}
                                            @if(request('sort') === $col['key'])
                                                <i class="fas fa-sort-{{ request('dir','desc') === 'asc' ? 'up' : 'down' }} text-blue-500"
                                                   aria-hidden="true"></i>
                                            @else
                                                <i class="fas fa-sort text-gray-300" aria-hidden="true"></i>
                                            @endif
                                        </a>
                                    </th>
                                @endforeach
                                <th scope="col"
                                    class="px-6 py-4 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($asets as $aset)
                            @php
                                $icons = [
                                    'Kendaraan' => 'fa-car',
                                    'Elektronik'=> 'fa-laptop',
                                    'Furniture' => 'fa-chair',
                                    'Bangunan'  => 'fa-building',
                                    'Tanah'     => 'fa-mountain',
                                ];
                                $icon = $icons[$aset->kategori_aset] ?? 'fa-box';

                                $kondisiCfg = [
                                    'Baik'         => ['bg'=>'bg-green-100', 'text'=>'text-green-800',  'icon'=>'fa-check-circle'],
                                    'Rusak Ringan' => ['bg'=>'bg-yellow-100','text'=>'text-yellow-800', 'icon'=>'fa-exclamation-triangle'],
                                    'Rusak Berat'  => ['bg'=>'bg-red-100',   'text'=>'text-red-800',    'icon'=>'fa-times-circle'],
                                ];
                                $color = $kondisiCfg[$aset->kondisi]
                                       ?? ['bg'=>'bg-gray-100','text'=>'text-gray-800','icon'=>'fa-question-circle'];
                            @endphp
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <div class="h-10 w-10 rounded-lg bg-blue-100 flex items-center
                                                    justify-center flex-shrink-0">
                                            <i class="fas {{ $icon }} text-blue-600" aria-hidden="true"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-semibold text-gray-900">
                                                {{ $aset->kategori_aset }}
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                ID: ASET{{ str_pad($aset->id, 4, '0', STR_PAD_LEFT) }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ number_format($aset->jumlah_unit) }}
                                    </div>
                                    <div class="text-xs text-gray-500">unit</div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        Rp {{ number_format($aset->nilai_buku, 0, ',', '.') }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        @if($aset->nilai_buku >= 1_000_000_000)
                                            {{ number_format($aset->nilai_buku / 1_000_000_000, 2) }}M
                                        @elseif($aset->nilai_buku >= 1_000_000)
                                            {{ number_format($aset->nilai_buku / 1_000_000, 2) }}Jt
                                        @endif
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1
                                                 text-xs font-medium rounded-full
                                                 {{ $color['bg'] }} {{ $color['text'] }}">
                                        <i class="fas {{ $color['icon'] }} text-xs" aria-hidden="true"></i>
                                        {{ $aset->kondisi }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-map-marker-alt text-gray-400 text-xs"
                                           aria-hidden="true"></i>
                                        <span class="text-sm text-gray-900">{{ $aset->lokasi }}</span>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $aset->tahun }}</div>
                                    <div class="text-xs text-gray-500">
                                        {{ now()->year - $aset->tahun }} tahun
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.dashboard-aset.show', $aset) }}"
                                           class="h-8 w-8 rounded-lg bg-gray-50 hover:bg-gray-100
                                                  flex items-center justify-center text-gray-600
                                                  hover:text-gray-800 transition-colors"
                                           title="Detail" aria-label="Lihat detail {{ $aset->kategori_aset }}">
                                            <i class="fas fa-eye text-sm" aria-hidden="true"></i>
                                        </a>
                                        <a href="{{ route('admin.dashboard-aset.edit', $aset) }}"
                                           class="h-8 w-8 rounded-lg bg-blue-50 hover:bg-blue-100
                                                  flex items-center justify-center text-blue-600
                                                  hover:text-blue-800 transition-colors"
                                           title="Edit" aria-label="Edit {{ $aset->kategori_aset }}">
                                            <i class="fas fa-edit text-sm" aria-hidden="true"></i>
                                        </a>
                                        {{--
                                            KEAMANAN: data-* dirender oleh Blade (server-side, di-escape
                                            otomatis oleh Twig/Blade). Tidak ada interpolasi string di JS.
                                        --}}
                                        <button
                                            data-id="{{ $aset->id }}"
                                            data-name="{{ $aset->kategori_aset }}"
                                            data-url="{{ route('admin.dashboard-aset.destroy', $aset) }}"
                                            onclick="confirmDelete(this)"
                                            class="h-8 w-8 rounded-lg bg-red-50 hover:bg-red-100
                                                   flex items-center justify-center text-red-600
                                                   hover:text-red-800 transition-colors"
                                            title="Hapus"
                                            aria-label="Hapus {{ $aset->kategori_aset }}">
                                            <i class="fas fa-trash-alt text-sm" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="h-16 w-16 rounded-full bg-gray-100
                                                    flex items-center justify-center mb-4">
                                            <i class="fas fa-box-open text-gray-400 text-2xl"
                                               aria-hidden="true"></i>
                                        </div>
                                        <h3 class="text-lg font-medium text-gray-900 mb-2">
                                            @if(request()->hasAny(['search','kondisi']))
                                                Tidak ada hasil untuk filter ini
                                            @else
                                                Belum ada data aset
                                            @endif
                                        </h3>
                                        <p class="text-gray-500 mb-6">
                                            @if(request()->hasAny(['search','kondisi']))
                                                Coba ubah kata kunci atau filter pencarian
                                            @else
                                                Mulai dengan menambahkan data aset pertama Anda
                                            @endif
                                        </p>
                                        @if(request()->hasAny(['search','kondisi']))
                                            <a href="{{ route('admin.dashboard-aset.index') }}"
                                               class="btn-secondary">
                                                <i class="fas fa-times mr-2" aria-hidden="true"></i>
                                                Reset Filter
                                            </a>
                                        @else
                                            <a href="{{ route('admin.dashboard-aset.create') }}"
                                               class="btn-primary">
                                                <i class="fas fa-plus mr-2" aria-hidden="true"></i>
                                                Tambah Aset Pertama
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if($asets->hasPages())
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <p class="text-sm text-gray-700">
                            Menampilkan
                            <span class="font-medium">{{ $asets->firstItem() }}</span> sampai
                            <span class="font-medium">{{ $asets->lastItem() }}</span> dari
                            <span class="font-medium">{{ $asets->total() }}</span> hasil
                        </p>
                        {{ $asets->links('vendor.pagination.tailwind') }}
                    </div>
                </div>
                @endif
            </div>

        </div>
    </div>

    {{-- ── Delete Confirmation Modal ─────────────────────────────────────────── --}}
    <div id="deleteModal" role="dialog" aria-modal="true" aria-labelledby="deleteModalTitle"
         class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm overflow-y-auto
                hidden z-50 flex items-center justify-center p-4">
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md
                    animate-fade-in-down">
            <div class="p-6 text-center">
                <div class="mx-auto flex items-center justify-center h-14 w-14
                            rounded-full bg-red-100 mb-4">
                    <i class="fas fa-exclamation-triangle text-red-600 text-2xl"
                       aria-hidden="true"></i>
                </div>
                <h3 id="deleteModalTitle"
                    class="text-lg font-bold text-gray-900 mb-2">
                    Hapus Data Aset
                </h3>
                <p class="text-sm text-gray-500 mb-1">
                    Anda akan menghapus aset:
                </p>
                {{--
                    AMAN: textContent diset via JS .textContent (bukan innerHTML),
                    sehingga tidak ada XSS meskipun nama mengandung karakter HTML.
                --}}
                <p id="deleteModalName"
                   class="text-base font-semibold text-gray-900 mb-4">
                </p>
                <p class="text-sm text-red-600 mb-6">
                    <i class="fas fa-exclamation-circle mr-1" aria-hidden="true"></i>
                    Tindakan ini tidak dapat dibatalkan.
                </p>
                <div class="flex justify-center gap-3">
                    <button onclick="closeDeleteModal()" type="button"
                            class="px-5 py-2.5 border border-gray-300 rounded-xl text-gray-700
                                   hover:bg-gray-50 font-medium transition-colors focus:outline-none
                                   focus:ring-2 focus:ring-gray-400">
                        Batal
                    </button>
                    <form id="deleteForm" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-5 py-2.5 bg-red-600 text-white rounded-xl
                                       hover:bg-red-700 font-medium transition-colors focus:outline-none
                                       focus:ring-2 focus:ring-red-500">
                            <i class="fas fa-trash-alt mr-2" aria-hidden="true"></i>Ya, Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // ── Delete Modal ───────────────────────────────────────────────────────
        // PERBAIKAN KEAMANAN: data diambil dari attribute DOM (di-escape Blade),
        // lalu ditulis ke DOM via .textContent (bukan innerHTML). Zero XSS risk.
        function confirmDelete(btn) {
            const name = btn.dataset.name;
            const url  = btn.dataset.url;

            // textContent: tidak pernah menginterpretasikan HTML
            document.getElementById('deleteModalName').textContent = name;
            document.getElementById('deleteForm').action = url;
            document.getElementById('deleteModal').classList.remove('hidden');

            // Fokus ke tombol Batal untuk aksesibilitas keyboard
            document.querySelector('#deleteModal button[onclick="closeDeleteModal()"]').focus();
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        // Tutup modal saat klik overlay (bukan konten)
        document.getElementById('deleteModal').addEventListener('click', function (e) {
            if (e.target === this) closeDeleteModal();
        });

        // Tutup modal dengan Escape (aksesibilitas)
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeDeleteModal();
        });
    </script>
    @endpush
</x-app-layout>
