<x-app-layout>
    {{-- <x-slot name="header">Dashboard Aset</x-slot>
    <x-slot name="subheader">Ringkasan dan analisis data aset BMN terbaru</x-slot> --}}
    <x-slot name="title">Dashboard Aset</x-slot>


    @php
        $chartKategoriLabels = $kategoriData->pluck('kategori_aset');
        $chartKategoriValues = $kategoriData->pluck('total')->map(fn($v) => (int) $v);

        $chartKondisiLabels = $kondisiData->pluck('kondisi');
        $chartKondisiValues = $kondisiData->pluck('total')->map(fn($v) => (int) $v);

        $chartNilaiLabels = $nilaiPerKategori->pluck('kategori_aset');
        $chartNilaiValues = $nilaiPerKategori
            ->pluck('total_nilai')
            ->map(fn($v) => round((float) $v / 1_000_000_000, 2));

        $chartTrendLabels = $trendTahunan->pluck('tahun')->map(fn($v) => (string) $v);
        $chartTrendValues = $trendTahunan->pluck('total')->map(fn($v) => (int) $v);

        // Format tampilan
        $totalNilaiMilliar = number_format($totalNilai / 1_000_000_000, 2, '.', ',');

        // Color map untuk badge kondisi (class ditulis literal agar Tailwind JIT tidak purge)
        $kondisiColorMap = [
            'Baik' => ['bg' => 'bg-green-100', 'text' => 'text-green-800', 'dot' => 'bg-green-500'],
            'Rusak Ringan' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-800', 'dot' => 'bg-yellow-500'],
            'Rusak Berat' => ['bg' => 'bg-red-100', 'text' => 'text-red-800', 'dot' => 'bg-red-500'],
        ];
    @endphp

    {{-- ═══════════════════════════════════════════════════════════════════
         STAT CARDS
    ════════════════════════════════════════════════════════════════════ --}}
    <section aria-label="Ringkasan statistik aset">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8" data-aos="fade-up">

            {{-- Total Unit Aset --}}
            <article
                class="bg-white rounded-2xl border border-gray-100 shadow-sm
                            hover:shadow-md hover:-translate-y-0.5
                            transition-all duration-300 p-5">
                <div class="flex items-start justify-between mb-4">
                    <div class="h-11 w-11 rounded-xl bg-gradient-to-br from-blue-500 to-blue-700
                                flex items-center justify-center shadow shadow-blue-200 flex-shrink-0"
                        aria-hidden="true">
                        <i class="fas fa-boxes text-white text-base"></i>
                    </div>
                    <span
                        class="text-xs font-semibold text-blue-700 px-2.5 py-1
                                 rounded-full bg-blue-50 border border-blue-100">
                        Aset
                    </span>
                </div>
                <p class="text-2xl font-bold text-gray-900 tabular-nums leading-tight">
                    {{ number_format($totalAset) }}
                </p>
                <p class="text-sm text-gray-500 mt-0.5">Total Unit Aset</p>
                <div class="mt-4 flex items-center gap-1.5 text-xs font-medium">
                    @if ($pertumbuhanUnit !== null)
                        @if ($pertumbuhanUnit > 0)
                            <i class="fas fa-arrow-up text-green-500" aria-hidden="true"></i>
                            <span class="text-green-600">{{ $pertumbuhanUnit }}% dari bulan lalu</span>
                        @elseif ($pertumbuhanUnit < 0)
                            <i class="fas fa-arrow-down text-red-500" aria-hidden="true"></i>
                            <span class="text-red-600">{{ abs($pertumbuhanUnit) }}% dari bulan lalu</span>
                        @else
                            <i class="fas fa-minus text-gray-400" aria-hidden="true"></i>
                            <span class="text-gray-400">Tidak ada perubahan</span>
                        @endif
                    @else
                        <i class="fas fa-minus text-gray-300" aria-hidden="true"></i>
                        <span class="text-gray-400">Belum ada data pembanding</span>
                    @endif
                </div>
            </article>

            {{-- Total Nilai --}}
            <article
                class="bg-white rounded-2xl border border-gray-100 shadow-sm
                            hover:shadow-md hover:-translate-y-0.5
                            transition-all duration-300 p-5">
                <div class="flex items-start justify-between mb-4">
                    <div class="h-11 w-11 rounded-xl bg-gradient-to-br from-emerald-500 to-green-700
                                flex items-center justify-center shadow shadow-green-200 flex-shrink-0"
                        aria-hidden="true">
                        <i class="fas fa-money-bill-wave text-white text-base"></i>
                    </div>
                    <span
                        class="text-xs font-semibold text-green-700 px-2.5 py-1
                                 rounded-full bg-green-50 border border-green-100">
                        Nilai
                    </span>
                </div>
                <p class="text-2xl font-bold text-gray-900 tabular-nums leading-tight">
                    Rp&nbsp;{{ $totalNilaiMilliar }}M
                </p>
                <p class="text-sm text-gray-500 mt-0.5">Total Nilai Aset</p>
                <div class="mt-4 flex items-center gap-1.5 text-xs font-medium">
                    @if ($pertumbuhanNilai !== null)
                        @if ($pertumbuhanNilai > 0)
                            <i class="fas fa-arrow-up text-green-500" aria-hidden="true"></i>
                            <span class="text-green-600">{{ $pertumbuhanNilai }}% pertumbuhan nilai</span>
                        @elseif ($pertumbuhanNilai < 0)
                            <i class="fas fa-arrow-down text-red-500" aria-hidden="true"></i>
                            <span class="text-red-600">{{ abs($pertumbuhanNilai) }}% penurunan nilai</span>
                        @else
                            <i class="fas fa-minus text-gray-400" aria-hidden="true"></i>
                            <span class="text-gray-400">Tidak ada perubahan nilai</span>
                        @endif
                    @else
                        <i class="fas fa-minus text-gray-300" aria-hidden="true"></i>
                        <span class="text-gray-400">Belum ada data pembanding</span>
                    @endif
                </div>
            </article>

            {{-- Jumlah Kategori --}}
            <article
                class="bg-white rounded-2xl border border-gray-100 shadow-sm
                            hover:shadow-md hover:-translate-y-0.5
                            transition-all duration-300 p-5">
                <div class="flex items-start justify-between mb-4">
                    <div class="h-11 w-11 rounded-xl bg-gradient-to-br from-violet-500 to-purple-700
                                flex items-center justify-center shadow shadow-purple-200 flex-shrink-0"
                        aria-hidden="true">
                        <i class="fas fa-layer-group text-white text-base"></i>
                    </div>
                    <span
                        class="text-xs font-semibold text-purple-700 px-2.5 py-1
                                 rounded-full bg-purple-50 border border-purple-100">
                        Kategori
                    </span>
                </div>
                <p class="text-2xl font-bold text-gray-900 tabular-nums leading-tight">
                    {{ $kategoriData->count() }}
                </p>
                <p class="text-sm text-gray-500 mt-0.5">Jumlah Kategori</p>
                <div class="mt-3 flex flex-wrap gap-1">
                    @foreach ($kategoriData->take(3) as $kat)
                        <span
                            class="inline-block text-xs px-2 py-0.5 bg-gray-100
                                     text-gray-600 rounded-full max-w-[90px] truncate"
                            title="{{ e($kat->kategori_aset) }}">
                            {{ $kat->kategori_aset }}
                        </span>
                    @endforeach
                    @if ($kategoriData->count() > 3)
                        <span class="text-xs px-2 py-0.5 bg-gray-100 text-gray-400 rounded-full">
                            +{{ $kategoriData->count() - 3 }}
                        </span>
                    @endif
                </div>
            </article>

            {{-- Kondisi Baik --}}
            <article
                class="bg-white rounded-2xl border border-gray-100 shadow-sm
                            hover:shadow-md hover:-translate-y-0.5
                            transition-all duration-300 p-5">
                <div class="flex items-start justify-between mb-4">
                    <div class="h-11 w-11 rounded-xl bg-gradient-to-br from-amber-400 to-yellow-600
                                flex items-center justify-center shadow shadow-yellow-200 flex-shrink-0"
                        aria-hidden="true">
                        <i class="fas fa-check-circle text-white text-base"></i>
                    </div>
                    <span
                        class="text-xs font-semibold text-yellow-700 px-2.5 py-1
                                 rounded-full bg-yellow-50 border border-yellow-100">
                        Kondisi
                    </span>
                </div>
                <p class="text-2xl font-bold text-gray-900 tabular-nums leading-tight">
                    {{ number_format($kondisiBaik) }}
                </p>
                <p class="text-sm text-gray-500 mt-0.5">Aset Kondisi Baik</p>
                <div class="mt-3 space-y-1.5">
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-gray-500">{{ $persentaseBaik }}% dari total</span>
                        <span class="text-green-600 font-semibold">✓ Optimal</span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-1.5 overflow-hidden">
                        <div class="h-full rounded-full bg-gradient-to-r
                                    from-green-400 to-emerald-500 transition-all duration-700"
                            style="width: {{ $persentaseBaik }}%" role="progressbar"
                            aria-valuenow="{{ $persentaseBaik }}" aria-valuemin="0" aria-valuemax="100"
                            aria-label="{{ $persentaseBaik }}% aset dalam kondisi baik">
                        </div>
                    </div>
                </div>
            </article>

        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════════════════════
         CHARTS ROW 1: Distribusi & Kondisi
    ════════════════════════════════════════════════════════════════════ --}}
    <section aria-label="Grafik distribusi dan kondisi aset">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mb-5" data-aos="fade-up" data-aos-delay="100">

            {{-- Distribusi Aset per Kategori --}}
            <div
                class="bg-white rounded-2xl border border-gray-100 shadow-sm
                        hover:shadow-md transition-shadow duration-300 p-6 flex flex-col">
                <div class="flex items-start justify-between mb-5">
                    <div>
                        <h3 class="text-sm font-bold text-gray-900">
                            Distribusi Aset per Kategori
                        </h3>
                        <p class="text-xs text-gray-500 mt-0.5">
                            Persebaran unit berdasarkan kategori
                        </p>
                    </div>
                    <div class="h-9 w-9 rounded-lg bg-blue-50 flex items-center
                                justify-center flex-shrink-0"
                        aria-hidden="true">
                        <i class="fas fa-chart-pie text-blue-600 text-sm"></i>
                    </div>
                </div>

                @if ($kategoriData->isEmpty())
                    <div class="flex-1 flex items-center justify-center min-h-[260px]">
                        <div class="text-center text-gray-400">
                            <i class="fas fa-inbox text-3xl mb-2" aria-hidden="true"></i>
                            <p class="text-sm">Belum ada data kategori</p>
                        </div>
                    </div>
                @else
                    <div class="relative flex-1 min-h-[260px]">
                        <canvas id="kategoriChart" aria-label="Grafik distribusi aset per kategori"
                            role="img"></canvas>
                    </div>
                @endif

                <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between">
                    <span class="text-xs text-gray-500">
                        Total
                        <strong class="text-gray-900 ml-1">
                            {{ number_format($totalAset) }}
                        </strong>
                        unit
                    </span>
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard-aset.index') }}"
                            class="inline-flex items-center gap-1 text-xs font-semibold
                                  text-blue-600 hover:text-blue-800 transition-colors">
                            Lihat Detail
                            <i class="fas fa-arrow-right text-xs" aria-hidden="true"></i>
                        </a>
                    @endif
                </div>
            </div>

            {{-- Kondisi Aset --}}
            <div
                class="bg-white rounded-2xl border border-gray-100 shadow-sm
                        hover:shadow-md transition-shadow duration-300 p-6 flex flex-col">
                <div class="flex items-start justify-between mb-5">
                    <div>
                        <h3 class="text-sm font-bold text-gray-900">Kondisi Aset</h3>
                        <p class="text-xs text-gray-500 mt-0.5">
                            Status kondisi seluruh aset BMN
                        </p>
                    </div>
                    <div class="h-9 w-9 rounded-lg bg-green-50 flex items-center
                                justify-center flex-shrink-0"
                        aria-hidden="true">
                        <i class="fas fa-heartbeat text-green-600 text-sm"></i>
                    </div>
                </div>

                @if ($kondisiData->isEmpty())
                    <div class="flex-1 flex items-center justify-center min-h-[260px]">
                        <div class="text-center text-gray-400">
                            <i class="fas fa-inbox text-3xl mb-2" aria-hidden="true"></i>
                            <p class="text-sm">Belum ada data kondisi</p>
                        </div>
                    </div>
                @else
                    <div class="relative flex-1 min-h-[260px]">
                        <canvas id="kondisiChart" aria-label="Grafik kondisi aset BMN" role="img"></canvas>
                    </div>
                @endif

                <div class="mt-4 pt-4 border-t border-gray-100">
                    @if ($kondisiData->isNotEmpty())
                        <div class="grid grid-cols-3 gap-3">
                            @foreach ($kondisiData as $kondisi)
                                @php
                                    $cls = $kondisiColorMap[$kondisi->kondisi] ?? [
                                        'bg' => 'bg-gray-100',
                                        'text' => 'text-gray-700',
                                        'dot' => 'bg-gray-400',
                                    ];
                                @endphp
                                <div class="text-center">
                                    <p class="text-lg font-bold text-gray-900 tabular-nums">
                                        {{ number_format($kondisi->total) }}
                                    </p>
                                    <span
                                        class="inline-flex items-center gap-1 text-xs
                                                 px-2 py-0.5 rounded-full
                                                 {{ $cls['bg'] }} {{ $cls['text'] }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $cls['dot'] }}"
                                            aria-hidden="true"></span>
                                        {{ $kondisi->kondisi }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-xs text-gray-400 text-center">Tidak ada data</p>
                    @endif
                </div>
            </div>

        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════════════════════
         CHARTS ROW 2: Nilai & Trend
    ════════════════════════════════════════════════════════════════════ --}}
    <section aria-label="Grafik nilai dan trend pengadaan aset">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mb-8" data-aos="fade-up" data-aos-delay="150">

            {{-- Nilai Aset per Kategori --}}
            <div
                class="bg-white rounded-2xl border border-gray-100 shadow-sm
                        hover:shadow-md transition-shadow duration-300 p-6 flex flex-col">
                <div class="flex items-start justify-between mb-5">
                    <div>
                        <h3 class="text-sm font-bold text-gray-900">
                            Nilai Aset per Kategori
                        </h3>
                        <p class="text-xs text-gray-500 mt-0.5">Satuan: Miliar Rupiah</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <button id="btnToggleNilai" type="button"
                            class="h-8 px-3 rounded-lg border border-gray-200 text-xs
                                       font-medium text-gray-600 hover:bg-gray-50
                                       hover:border-gray-300 transition-all
                                       inline-flex items-center gap-1.5
                                       focus:outline-none focus:ring-2 focus:ring-purple-400
                                       focus:ring-offset-1"
                            aria-label="Ganti tampilan grafik nilai">
                            <i class="fas fa-exchange-alt text-gray-400 text-xs" aria-hidden="true"></i>
                            Tampilan
                        </button>
                        <div class="h-9 w-9 rounded-lg bg-purple-50 flex items-center
                                    justify-center flex-shrink-0"
                            aria-hidden="true">
                            <i class="fas fa-chart-bar text-purple-600 text-sm"></i>
                        </div>
                    </div>
                </div>

                @if ($nilaiPerKategori->isEmpty())
                    <div class="flex-1 flex items-center justify-center min-h-[240px]">
                        <div class="text-center text-gray-400">
                            <i class="fas fa-inbox text-3xl mb-2" aria-hidden="true"></i>
                            <p class="text-sm">Belum ada data nilai</p>
                        </div>
                    </div>
                @else
                    <div class="relative flex-1 min-h-[240px]">
                        <canvas id="nilaiChart" aria-label="Grafik nilai aset per kategori" role="img"></canvas>
                    </div>
                @endif

                <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between">
                    <p class="text-xs text-gray-500">
                        Total:
                        <strong class="text-gray-900 ml-1">
                            Rp&nbsp;{{ $totalNilaiMilliar }}M
                        </strong>
                    </p>
                    <span class="text-xs text-gray-400">Miliar Rupiah</span>
                </div>
            </div>

            {{-- Trend Pengadaan Tahunan --}}
            <div
                class="bg-white rounded-2xl border border-gray-100 shadow-sm
                        hover:shadow-md transition-shadow duration-300 p-6 flex flex-col">
                <div class="flex items-start justify-between mb-5">
                    <div>
                        <h3 class="text-sm font-bold text-gray-900">
                            Trend Pengadaan Aset
                        </h3>
                        <p class="text-xs text-gray-500 mt-0.5">
                            Perkembangan 5 tahun terakhir
                        </p>
                    </div>
                    <div class="flex items-center gap-2">
                        <button id="btnDownloadTrend" type="button"
                            class="h-8 w-8 rounded-lg border border-gray-200 flex items-center
                                       justify-center hover:bg-gray-50 transition-colors
                                       focus:outline-none focus:ring-2 focus:ring-blue-500
                                       focus:ring-offset-1"
                            aria-label="Unduh grafik trend sebagai gambar">
                            <i class="fas fa-download text-gray-500 text-xs" aria-hidden="true"></i>
                        </button>
                        <div class="h-9 w-9 rounded-lg bg-indigo-50 flex items-center
                                    justify-center flex-shrink-0"
                            aria-hidden="true">
                            <i class="fas fa-chart-line text-indigo-600 text-sm"></i>
                        </div>
                    </div>
                </div>

                @if ($trendTahunan->isEmpty())
                    <div class="flex-1 flex items-center justify-center min-h-[240px]">
                        <div class="text-center text-gray-400">
                            <i class="fas fa-inbox text-3xl mb-2" aria-hidden="true"></i>
                            <p class="text-sm">Belum ada data trend</p>
                        </div>
                    </div>
                @else
                    <div class="relative flex-1 min-h-[240px]">
                        <canvas id="trendChart" aria-label="Grafik trend pengadaan aset tahunan"
                            role="img"></canvas>
                    </div>
                @endif

                <div
                    class="mt-4 pt-4 border-t border-gray-100
                            flex items-center justify-between">
                    <div class="flex items-center gap-1.5 text-xs">
                        @if ($rataRataPertumbuhanTahunan !== null)
                            <span class="text-gray-500">Rata-rata pertumbuhan:</span>
                            @if ($rataRataPertumbuhanTahunan > 0)
                                <span class="font-bold text-green-600">
                                    +{{ $rataRataPertumbuhanTahunan }}% / tahun
                                </span>
                            @elseif ($rataRataPertumbuhanTahunan < 0)
                                <span class="font-bold text-red-600">
                                    {{ $rataRataPertumbuhanTahunan }}% / tahun
                                </span>
                            @else
                                <span class="font-bold text-gray-500">0% / tahun</span>
                            @endif
                        @else
                            <span class="text-gray-400">
                                <i class="fas fa-minus text-xs mr-1" aria-hidden="true"></i>
                                Belum cukup data untuk menghitung trend
                            </span>
                        @endif
                    </div>
                    <span class="inline-flex items-center gap-1.5 text-xs text-gray-400">
                        <span class="w-4 h-0.5 rounded-full bg-blue-500 inline-block" aria-hidden="true"></span>
                        Jumlah Aset
                    </span>
                </div>
            </div>

        </div>
    </section>

    {{-- ═══ QUICK ACTIONS (SuperAdmin & Admin only) ══════════════════════ --}}
    @if (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
        <section aria-label="Aksi cepat" class="mb-8" data-aos="fade-up" data-aos-delay="200">
            <div
                class="bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50
                rounded-2xl border border-indigo-100 p-6">

                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h3 class="text-sm font-bold text-gray-900">Aksi Cepat</h3>
                        <p class="text-xs text-gray-500 mt-0.5">Kelola data aset dengan mudah</p>
                    </div>
                    <div class="h-10 w-10 rounded-xl bg-white shadow-sm flex items-center
                        justify-center"
                        aria-hidden="true">
                        <i class="fas fa-bolt text-yellow-500"></i>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">

                    {{-- Tambah Aset: hanya SuperAdmin --}}
                    @if (auth()->user()->isSuperAdmin())
                        <a href="{{ route('admin.dashboard-aset.create') }}"
                            class="group bg-white rounded-xl p-4 shadow-sm border border-transparent
                          hover:border-blue-200 hover:shadow-md transition-all duration-200
                          focus:outline-none focus:ring-2 focus:ring-blue-400">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 rounded-lg bg-blue-100 flex items-center
                                    justify-center flex-shrink-0
                                    group-hover:bg-blue-200 transition-colors"
                                    aria-hidden="true">
                                    <i class="fas fa-plus text-blue-600"></i>
                                </div>
                                <div class="min-w-0">
                                    <h4 class="text-sm font-semibold text-gray-900">Tambah Aset Baru</h4>
                                    <p class="text-xs text-gray-500 truncate">Input data aset baru</p>
                                </div>
                            </div>
                        </a>
                    @else
                        {{-- Admin biasa: tampil disabled --}}
                        <div class="bg-white/50 rounded-xl p-4 border border-gray-100
                            cursor-not-allowed select-none"
                            title="Hanya Super Admin yang dapat menambah aset" aria-disabled="true">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 rounded-lg bg-gray-100 flex items-center
                                    justify-center flex-shrink-0"
                                    aria-hidden="true">
                                    <i class="fas fa-lock text-gray-300"></i>
                                </div>
                                <div class="min-w-0">
                                    <h4 class="text-sm font-semibold text-gray-400">Tambah Aset Baru</h4>
                                    <p class="text-xs text-gray-400">Akses Super Admin</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Analisis Kinerja: SuperAdmin & Admin --}}
                    <a href="{{ route('kinerja') }}"
                        class="group bg-white rounded-xl p-4 shadow-sm border border-transparent
                      hover:border-green-200 hover:shadow-md transition-all duration-200
                      focus:outline-none focus:ring-2 focus:ring-green-400">
                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 rounded-lg bg-green-100 flex items-center
                                justify-center flex-shrink-0
                                group-hover:bg-green-200 transition-colors"
                                aria-hidden="true">
                                <i class="fas fa-chart-line text-green-600"></i>
                            </div>
                            <div class="min-w-0">
                                <h4 class="text-sm font-semibold text-gray-900">Analisis Kinerja</h4>
                                <p class="text-xs text-gray-500 truncate">Pantau performa aset</p>
                            </div>
                        </div>
                    </a>

                    {{-- Ekspor Laporan: SuperAdmin & Admin --}}
                    <button id="btnExportPdf" type="button"
                        class="group bg-white rounded-xl p-4 shadow-sm border border-transparent
                           hover:border-purple-200 hover:shadow-md transition-all duration-200
                           text-left w-full
                           focus:outline-none focus:ring-2 focus:ring-purple-400">
                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 rounded-lg bg-purple-100 flex items-center
                                justify-center flex-shrink-0
                                group-hover:bg-purple-200 transition-colors"
                                aria-hidden="true">
                                <i class="fas fa-file-export text-purple-600"></i>
                            </div>
                            <div class="min-w-0">
                                <h4 class="text-sm font-semibold text-gray-900">Ekspor Laporan</h4>
                                <p class="text-xs text-gray-500 truncate">Download PDF dashboard</p>
                            </div>
                        </div>
                    </button>

                </div>
            </div>
        </section>
    @endif

    {{-- ═══════════════════════════════════════════════════════════════════
         SCRIPTS
         - Chart.js sudah tersedia via window.Chart (didaftarkan di app.js)
         - JANGAN load Chart.js dari CDN lagi (duplikasi & konflik versi)
         - jsPDF sudah di-defer di app.blade.php
    ════════════════════════════════════════════════════════════════════ --}}
  @push('scripts')
<script>
// Gunakan 'load' bukan 'DOMContentLoaded' karena app.js adalah
// ES Module yang di-defer — window.Chart baru tersedia setelah
// semua module selesai dieksekusi.
window.addEventListener('load', function () {
    (function () {
        'use strict';

        if (typeof Chart === 'undefined') {
            console.error('[Dashboard] Chart.js tidak tersedia.');
            return;
        }

        var kategoriLabels = @json($chartKategoriLabels);
        var kategoriValues = @json($chartKategoriValues);
        var kondisiLabels  = @json($chartKondisiLabels);
        var kondisiValues  = @json($chartKondisiValues);
        var nilaiLabels    = @json($chartNilaiLabels);
        var nilaiValues    = @json($chartNilaiValues);
        var trendLabels    = @json($chartTrendLabels);
        var trendValues    = @json($chartTrendValues);

        var summaryData = [
            { label: 'Total Unit Aset',   value: '{{ number_format($totalAset) }} unit' },
            { label: 'Total Nilai Aset',  value: 'Rp {{ $totalNilaiMilliar }}M' },
            { label: 'Jumlah Kategori',   value: '{{ $kategoriData->count() }} kategori' },
            { label: 'Aset Kondisi Baik', value: '{{ number_format($kondisiBaik) }} unit ({{ $persentaseBaik }}%)' },
        ];

        var PALETTE = [
            '#3B82F6', '#10B981', '#8B5CF6', '#F59E0B',
            '#EF4444', '#06B6D4', '#EC4899', '#6366F1',
            '#84CC16', '#F97316'
        ];

        var KONDISI_COLOR = {
            'Baik'         : '#10B981',
            'Rusak Ringan' : '#F59E0B',
            'Rusak Berat'  : '#EF4444'
        };

        Chart.defaults.font.family = "'Inter', system-ui, sans-serif";
        Chart.defaults.font.size   = 11;
        Chart.defaults.color       = '#6B7280';

        var TOOLTIP = {
            backgroundColor : 'rgba(17, 24, 39, 0.92)',
            titleColor      : '#F9FAFB',
            bodyColor       : '#D1D5DB',
            borderColor     : 'rgba(255,255,255,0.1)',
            borderWidth     : 1,
            padding         : 10,
            cornerRadius    : 8,
            displayColors   : true,
            boxPadding      : 4
        };

        function getCtx(id) {
            var el = document.getElementById(id);
            if (!el) return null;
            return el.getContext('2d');
        }

        function fmtRupiah(v) {
            return 'Rp\u00A0' + Number(v).toLocaleString('id-ID', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }) + 'M';
        }

        // ── Chart: Distribusi Kategori (Doughnut) ────────────────────
        var ctxKategori = getCtx('kategoriChart');
        var chartKategori = null;

        if (ctxKategori) {
            chartKategori = new Chart(ctxKategori, {
                type: 'doughnut',
                data: {
                    labels: kategoriLabels,
                    datasets: [{
                        data            : kategoriValues,
                        backgroundColor : PALETTE.slice(0, kategoriLabels.length),
                        borderWidth     : 2,
                        borderColor     : '#FFFFFF',
                        hoverOffset     : 8
                    }]
                },
                options: {
                    responsive          : true,
                    maintainAspectRatio : false,
                    cutout              : '68%',
                    animation           : { duration: 600 },
                    plugins: {
                        legend: {
                            position : 'right',
                            labels: {
                                padding      : 14,
                                usePointStyle: true,
                                pointStyle   : 'circle',
                                generateLabels: function (chart) {
                                    var base = Chart.overrides.doughnut
                                        .plugins.legend.labels.generateLabels(chart);
                                    return base.map(function (item) {
                                        return Object.assign({}, item, {
                                            text: item.text && item.text.length > 18
                                                ? item.text.slice(0, 16) + '\u2026'
                                                : item.text
                                        });
                                    });
                                }
                            }
                        },
                        tooltip: Object.assign({}, TOOLTIP, {
                            callbacks: {
                                label: function (ctx) {
                                    var total = ctx.dataset.data
                                        .reduce(function (a, b) { return a + b; }, 0);
                                    var pct = total > 0
                                        ? Math.round((ctx.raw / total) * 100) : 0;
                                    return ' ' + ctx.label + ': '
                                        + Number(ctx.raw).toLocaleString('id-ID')
                                        + ' unit (' + pct + '%)';
                                }
                            }
                        })
                    }
                }
            });
        }

        // ── Chart: Kondisi Aset (Pie) ────────────────────────────────
        var ctxKondisi = getCtx('kondisiChart');
        var chartKondisi = null;

        if (ctxKondisi) {
            var kondisiColors = kondisiLabels.map(function (l) {
                return KONDISI_COLOR[l] || '#9CA3AF';
            });

            chartKondisi = new Chart(ctxKondisi, {
                type: 'pie',
                data: {
                    labels: kondisiLabels,
                    datasets: [{
                        data            : kondisiValues,
                        backgroundColor : kondisiColors,
                        borderWidth     : 2,
                        borderColor     : '#FFFFFF',
                        hoverOffset     : 8
                    }]
                },
                options: {
                    responsive          : true,
                    maintainAspectRatio : false,
                    animation           : { duration: 600 },
                    plugins: {
                        legend: {
                            position : 'right',
                            labels: {
                                padding      : 14,
                                usePointStyle: true,
                                pointStyle   : 'circle'
                            }
                        },
                        tooltip: Object.assign({}, TOOLTIP, {
                            callbacks: {
                                label: function (ctx) {
                                    var total = ctx.dataset.data
                                        .reduce(function (a, b) { return a + b; }, 0);
                                    var pct = total > 0
                                        ? Math.round((ctx.raw / total) * 100) : 0;
                                    return ' ' + ctx.label + ': '
                                        + Number(ctx.raw).toLocaleString('id-ID')
                                        + ' (' + pct + '%)';
                                }
                            }
                        })
                    }
                }
            });
        }

        // ── Chart: Nilai per Kategori (Bar) ──────────────────────────
        var ctxNilai = getCtx('nilaiChart');
        var chartNilai = null;

        if (ctxNilai) {
            chartNilai = new Chart(ctxNilai, {
                type: 'bar',
                data: {
                    labels: nilaiLabels,
                    datasets: [{
                        label           : 'Nilai (Miliar Rp)',
                        data            : nilaiValues,
                        backgroundColor : PALETTE.slice(0, nilaiLabels.length),
                        borderRadius    : 6,
                        borderSkipped   : false,
                        maxBarThickness : 48
                    }]
                },
                options: {
                    responsive          : true,
                    maintainAspectRatio : false,
                    animation           : { duration: 500 },
                    scales: {
                        y: {
                            beginAtZero : true,
                            grid        : { color: 'rgba(0,0,0,0.04)' },
                            ticks       : {
                                callback: function (v) { return 'Rp ' + v + 'M'; }
                            }
                        },
                        x: {
                            grid : { display: false },
                            ticks: { maxRotation: 40, minRotation: 0 }
                        }
                    },
                    plugins: {
                        legend  : { display: false },
                        tooltip : Object.assign({}, TOOLTIP, {
                            callbacks: {
                                label: function (ctx) {
                                    return ' ' + fmtRupiah(ctx.parsed.y);
                                }
                            }
                        })
                    }
                }
            });

            var btnToggle = document.getElementById('btnToggleNilai');
            if (btnToggle) {
                btnToggle.addEventListener('click', function () {
                    if (!chartNilai) return;
                    var isBar = chartNilai.config.type === 'bar';
                    chartNilai.config.type = isBar ? 'line' : 'bar';
                    var ds = chartNilai.data.datasets[0];
                    if (chartNilai.config.type === 'line') {
                        ds.backgroundColor     = 'rgba(139, 92, 246, 0.12)';
                        ds.borderColor         = '#8B5CF6';
                        ds.borderWidth         = 2.5;
                        ds.tension             = 0.4;
                        ds.fill                = true;
                        ds.pointRadius         = 5;
                        ds.pointHoverRadius    = 7;
                        ds.pointBackgroundColor = '#8B5CF6';
                        ds.pointBorderColor    = '#FFFFFF';
                        ds.pointBorderWidth    = 2;
                        delete ds.borderRadius;
                        delete ds.maxBarThickness;
                    } else {
                        delete ds.borderColor;
                        delete ds.borderWidth;
                        delete ds.tension;
                        delete ds.fill;
                        delete ds.pointRadius;
                        delete ds.pointHoverRadius;
                        delete ds.pointBackgroundColor;
                        delete ds.pointBorderColor;
                        delete ds.pointBorderWidth;
                        ds.backgroundColor  = PALETTE.slice(0, nilaiLabels.length);
                        ds.borderRadius     = 6;
                        ds.maxBarThickness  = 48;
                    }
                    chartNilai.update();
                });
            }
        }

        // ── Chart: Trend Tahunan (Line + gradient) ───────────────────
        var ctxTrend = getCtx('trendChart');
        var chartTrend = null;

        if (ctxTrend) {
            var grad = ctxTrend.createLinearGradient(0, 0, 0, 260);
            grad.addColorStop(0, 'rgba(59, 130, 246, 0.22)');
            grad.addColorStop(1, 'rgba(59, 130, 246, 0.01)');

            chartTrend = new Chart(ctxTrend, {
                type: 'line',
                data: {
                    labels: trendLabels,
                    datasets: [{
                        label               : 'Jumlah Aset',
                        data                : trendValues,
                        borderColor         : '#3B82F6',
                        backgroundColor     : grad,
                        tension             : 0.4,
                        fill                : true,
                        borderWidth         : 2.5,
                        pointBackgroundColor: '#3B82F6',
                        pointBorderColor    : '#FFFFFF',
                        pointBorderWidth    : 2,
                        pointRadius         : 5,
                        pointHoverRadius    : 7
                    }]
                },
                options: {
                    responsive          : true,
                    maintainAspectRatio : false,
                    animation           : { duration: 600 },
                    interaction         : { mode: 'index', intersect: false },
                    scales: {
                        y: {
                            beginAtZero : true,
                            grid        : { color: 'rgba(0,0,0,0.04)' },
                            ticks       : { precision: 0 }
                        },
                        x: { grid: { display: false } }
                    },
                    plugins: {
                        legend  : { display: false },
                        tooltip : Object.assign({}, TOOLTIP, {
                            callbacks: {
                                label: function (ctx) {
                                    return ' ' + ctx.dataset.label + ': '
                                        + Number(ctx.parsed.y).toLocaleString('id-ID')
                                        + ' unit';
                                }
                            }
                        })
                    }
                }
            });

            var btnDownload = document.getElementById('btnDownloadTrend');
            if (btnDownload) {
                btnDownload.addEventListener('click', function () {
                    var a      = document.createElement('a');
                    a.download = 'trend-pengadaan-aset-bmn.png';
                    a.href     = chartTrend.toBase64Image('image/png', 1.0);
                    a.click();
                });
            }
        }

        // ── Export PDF ───────────────────────────────────────────────
        var btnPdf = document.getElementById('btnExportPdf');
        if (btnPdf) {
            btnPdf.addEventListener('click', function () {
                if (typeof window.jspdf === 'undefined') {
                    alert('Library PDF belum siap. Tunggu sebentar lalu coba lagi.');
                    return;
                }
                var jsPDF = window.jspdf.jsPDF;
                var doc   = new jsPDF({ orientation: 'portrait', unit: 'mm', format: 'a4' });
                var now   = new Date().toLocaleDateString('id-ID', {
                    day: 'numeric', month: 'long', year: 'numeric'
                });

                doc.setFillColor(37, 99, 235);
                doc.rect(0, 0, 210, 30, 'F');
                doc.setTextColor(255, 255, 255);
                doc.setFontSize(16);
                doc.setFont('helvetica', 'bold');
                doc.text('Laporan Dashboard Aset BMN', 14, 13);
                doc.setFontSize(9);
                doc.setFont('helvetica', 'normal');
                doc.text('Kementerian Keuangan Republik Indonesia', 14, 20);
                doc.text('Dicetak: ' + now, 14, 26);

                doc.setTextColor(17, 24, 39);
                doc.setFontSize(12);
                doc.setFont('helvetica', 'bold');
                doc.text('Ringkasan Data', 14, 42);

                var y = 50;
                doc.setFontSize(10);
                summaryData.forEach(function (row, i) {
                    if (i % 2 === 0) {
                        doc.setFillColor(239, 246, 255);
                        doc.rect(14, y - 5, 182, 9, 'F');
                    }
                    doc.setFont('helvetica', 'bold');
                    doc.setTextColor(75, 85, 99);
                    doc.text(row.label, 16, y);
                    doc.setFont('helvetica', 'normal');
                    doc.setTextColor(17, 24, 39);
                    doc.text(row.value, 110, y);
                    y += 10;
                });

                doc.setFontSize(8);
                doc.setTextColor(156, 163, 175);
                doc.text(
                    'Sistem Digitalisasi Aset \u2014 Biro Manajemen BMN dan Pengadaan',
                    14, 285
                );

                doc.save('dashboard-aset-bmn-' + new Date().getFullYear() + '.pdf');
            });
        }

        // ── Resize handler (throttled) ───────────────────────────────
        var resizeTimer = null;
        window.addEventListener('resize', function () {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function () {
                [chartKategori, chartKondisi, chartNilai, chartTrend].forEach(function (c) {
                    if (c) c.resize();
                });
            }, 200);
        }, { passive: true });

    }()); // end IIFE
}); // end window.load
</script>
@endpush

</x-app-layout>
