<?php

namespace App\Http\Controllers\ManajemenBMN;

use App\Http\Controllers\Controller;
use App\Models\PenatausahaanBMN;
use Illuminate\Http\Request;

class PenatausahaanBMNController extends Controller
{
    public function index(Request $request)
    {
        $query = PenatausahaanBMN::query();

        if ($request->has('kategori') && $request->kategori) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->has('kondisi') && $request->kondisi) {
            $query->where('kondisi', $request->kondisi);
        }

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_barang', 'like', "%{$search}%")
                  ->orWhere('kode_barang', 'like', "%{$search}%")
                  ->orWhere('nup', 'like', "%{$search}%");
            });
        }

        $penatausahaans = $query->latest()->paginate(15);

        // Statistics
        $stats = [
            'total_aset' => PenatausahaanBMN::sum('jumlah_unit'),
            'total_nilai_buku' => PenatausahaanBMN::sum('nilai_buku'),
            'nilai_tanah' => PenatausahaanBMN::where('kategori', 'Tanah')->sum('nilai_buku'),
            'nilai_gedung' => PenatausahaanBMN::where('kategori', 'Gedung Bangunan')->sum('nilai_buku'),
            'rumah_negara' => PenatausahaanBMN::where('kategori', 'Rumah Negara')->sum('jumlah_unit'),
            'kendaraan_operasional' => PenatausahaanBMN::where('kategori', 'Kendaraan Dinas Operasional')->sum('jumlah_unit'),
            'kendaraan_jabatan' => PenatausahaanBMN::where('kategori', 'Kendaraan Dinas Jabatan')->sum('jumlah_unit'),
            'kendaraan_fungsional' => PenatausahaanBMN::where('kategori', 'Kendaraan Dinas Fungsional')->sum('jumlah_unit'),
            'kondisi_baik' => PenatausahaanBMN::where('kondisi', 'Baik')->count(),
            'kondisi_rusak_ringan' => PenatausahaanBMN::where('kondisi', 'Rusak Ringan')->count(),
            'kondisi_rusak_berat' => PenatausahaanBMN::where('kondisi', 'Rusak Berat')->count(),
        ];

        // Data untuk Chart
        $chartData = $this->getChartData();
        $trendData = $this->getTrendData();

        return view('manajemen-bmn.penatausahaan.index', compact(
            'penatausahaans',
            'stats',
            'chartData',
            'trendData'
        ));
    }

    private function getChartData()
    {
        // Distribusi Kategori
        $kategoriDistribution = PenatausahaanBMN::selectRaw('kategori, COUNT(*) as total')
            ->groupBy('kategori')
            ->get();

        // Distribusi Kondisi
        $kondisiDistribution = PenatausahaanBMN::selectRaw('kondisi, COUNT(*) as total')
            ->groupBy('kondisi')
            ->get();

        // Nilai Aset per Kategori
        $nilaiPerKategori = PenatausahaanBMN::selectRaw('kategori, SUM(nilai_buku) as total_nilai')
            ->groupBy('kategori')
            ->get();

        // Top 10 Aset dengan Nilai Tertinggi
        $topAssets = PenatausahaanBMN::orderBy('nilai_buku', 'desc')
            ->limit(10)
            ->get(['nama_barang', 'nilai_buku', 'kategori']);

        // Status Aset
        $statusDistribution = PenatausahaanBMN::selectRaw('status_aset, COUNT(*) as total')
            ->whereNotNull('status_aset')
            ->groupBy('status_aset')
            ->get();

        // Data untuk distribusi kategori
        $kategoriLabels = $kategoriDistribution->pluck('kategori')->toArray();
        $kategoriData = $kategoriDistribution->pluck('total')->toArray();

        // Warna untuk setiap kategori
        $kategoriColors = [];
        foreach ($kategoriLabels as $kategori) {
            $kategoriColors[] = match($kategori) {
                'Tanah' => '#10B981',
                'Gedung Bangunan' => '#3B82F6',
                'Rumah Negara' => '#8B5CF6',
                'Kendaraan Dinas Operasional' => '#F59E0B',
                'Kendaraan Dinas Jabatan' => '#EF4444',
                'Kendaraan Dinas Fungsional' => '#EC4899',
                'Peralatan Kantor' => '#6366F1',
                default => '#6B7280',
            };
        }

        return [
            'kategori' => [
                'labels' => $kategoriLabels,
                'data' => $kategoriData,
                'colors' => $kategoriColors
            ],
            'kondisi' => [
                'labels' => $kondisiDistribution->pluck('kondisi'),
                'data' => $kondisiDistribution->pluck('total'),
                'colors' => ['#10B981', '#F59E0B', '#EF4444'] // Baik, Rusak Ringan, Rusak Berat
            ],
            'nilai_kategori' => [
                'labels' => $nilaiPerKategori->pluck('kategori'),
                'data' => $nilaiPerKategori->pluck('total_nilai'),
            ],
            'top_assets' => $topAssets,
            'status' => [
                'labels' => $statusDistribution->pluck('status_aset'),
                'data' => $statusDistribution->pluck('total'),
                'colors' => ['#10B981', '#6B7280', '#F59E0B', '#8B5CF6'] // Digunakan, Tidak Digunakan, Dalam Perbaikan, Disewakan
            ],
        ];
    }

    private function getTrendData()
    {
        // Data untuk tren nilai aset 5 tahun terakhir
        $currentYear = date('Y');
        $years = range($currentYear - 4, $currentYear);

        // Dalam aplikasi nyata, ambil data dari database berdasarkan tahun perolehan
        // Untuk demo, kita buat data dummy
        $trendValues = [];
        foreach ($years as $year) {
            // Nilai acak antara 50-200 miliar
            $trendValues[] = rand(50000000000, 200000000000);
        }

        // Data tren kondisi aset
        $kondisiTrend = [
            'baik' => [65, 68, 72, 75, 78], // % kondisi baik
            'rusak_ringan' => [25, 22, 20, 18, 16], // % rusak ringan
            'rusak_berat' => [10, 10, 8, 7, 6], // % rusak berat
        ];

        return [
            'years' => $years,
            'trend_values' => $trendValues,
            'kondisi_trend' => $kondisiTrend,
        ];
    }

    public function show(PenatausahaanBMN $penatausahaan)
    {
        return view('manajemen-bmn.penatausahaan.show', compact('penatausahaan'));
    }
}
