<?php

namespace App\Http\Controllers\ManajemenBMN;

use App\Http\Controllers\Controller;
use App\Models\PerencanaanBMN;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PerencanaanBMNController extends Controller
{
    public function index(Request $request)
    {
        $query = PerencanaanBMN::query();

        // Filter berdasarkan parameter request
        if ($request->has('jenis') && $request->jenis) {
            $query->where('jenis_perencanaan', $request->jenis);
        }

        if ($request->has('tahun') && $request->tahun) {
            $query->where('tahun_anggaran', $request->tahun);
        }

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        if ($request->has('kategori') && $request->kategori) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->has('pembuat') && $request->pembuat) {
            $query->where('pembuat', 'like', '%' . $request->pembuat . '%');
        }

        if ($request->has('start_date') && $request->start_date) {
            $query->where('tanggal_dokumen', '>=', $request->start_date);
        }

        if ($request->has('end_date') && $request->end_date) {
            $query->where('tanggal_dokumen', '<=', $request->end_date);
        }

        if ($request->has('min_nilai') && $request->min_nilai) {
            $query->where('nilai_estimasi', '>=', $request->min_nilai);
        }

        if ($request->has('max_nilai') && $request->max_nilai) {
            $query->where('nilai_estimasi', '<=', $request->max_nilai);
        }

        // Pagination dengan query string
        $perencanaans = $query->latest()->paginate(10)->withQueryString();

        // Statistik utama
        $stats = [
            'total' => PerencanaanBMN::count(),
            'rp4' => PerencanaanBMN::where('jenis_perencanaan', 'RP4')->count(),
            'rkbmn' => PerencanaanBMN::where('jenis_perencanaan', 'RKBMN')->count(),
            'disetujui' => PerencanaanBMN::where('status', 'Disetujui')->count(),
            'total_nilai' => PerencanaanBMN::sum('nilai_estimasi'),
        ];

        // Data untuk chart
        $chartData = $this->getChartData();

        return view('manajemen-bmn.perencanaan.index', compact('perencanaans', 'stats', 'chartData'));
    }

    public function show(PerencanaanBMN $perencanaan)
    {
        return view('manajemen-bmn.perencanaan.show', compact('perencanaan'));
    }

    private function getChartData()
    {
        // Data untuk chart distribusi jenis
        $jenisData = [
            'labels' => ['RP4', 'RKBMN'],
            'data' => [
                PerencanaanBMN::where('jenis_perencanaan', 'RP4')->count(),
                PerencanaanBMN::where('jenis_perencanaan', 'RKBMN')->count()
            ],
            'colors' => ['#10B981', '#8B5CF6']
        ];

        // Data untuk chart status
        $statusData = [
            'labels' => ['Draft', 'Diajukan', 'Disetujui', 'Ditolak', 'Selesai'],
            'data' => [
                PerencanaanBMN::where('status', 'Draft')->count(),
                PerencanaanBMN::where('status', 'Diajukan')->count(),
                PerencanaanBMN::where('status', 'Disetujui')->count(),
                PerencanaanBMN::where('status', 'Ditolak')->count(),
                PerencanaanBMN::where('status', 'Selesai')->count()
            ],
            'colors' => ['#9CA3AF', '#3B82F6', '#10B981', '#EF4444', '#8B5CF6']
        ];

        // Data untuk chart trend per bulan (6 bulan terakhir)
        $trendData = $this->getMonthlyTrendData();

        // Data untuk chart nilai per kategori
        $kategoriData = $this->getKategoriData();

        // Data untuk chart pembanding tahun
        $tahunData = $this->getYearlyComparisonData();

        return [
            'jenis' => $jenisData,
            'status' => $statusData,
            'trend' => $trendData,
            'kategori' => $kategoriData,
            'tahun' => $tahunData,
        ];
    }

    private function getMonthlyTrendData()
    {
        $months = [];
        $data = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months[] = $date->format('M');

            $count = PerencanaanBMN::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->count();
            $data[] = $count;
        }

        return [
            'labels' => $months,
            'data' => $data,
            'color' => '#3B82F6'
        ];
    }

    private function getKategoriData()
    {
        $kategoriLabels = ['Penggunaan', 'Pemanfaatan', 'Pemindahtanganan', 'Penghapusan'];
        $kategoriData = [];

        foreach ($kategoriLabels as $kategori) {
            $total = PerencanaanBMN::where('kategori', $kategori)->sum('nilai_estimasi');
            $kategoriData[] = $total > 0 ? ($total / 1000000000) : 0; // Convert to billions
        }

        return [
            'labels' => $kategoriLabels,
            'data' => $kategoriData,
            'color' => '#10B981'
        ];
    }

    private function getYearlyComparisonData()
    {
        $years = [2022, 2023, 2024, 2025];
        $rp4Data = [];
        $rkbmnData = [];

        foreach ($years as $year) {
            $rp4Data[] = PerencanaanBMN::where('jenis_perencanaan', 'RP4')
                ->where('tahun_anggaran', $year)
                ->count();

            $rkbmnData[] = PerencanaanBMN::where('jenis_perencanaan', 'RKBMN')
                ->where('tahun_anggaran', $year)
                ->count();
        }

        return [
            'labels' => $years,
            'rp4' => $rp4Data,
            'rkbmn' => $rkbmnData,
            'colors' => ['#10B981', '#8B5CF6']
        ];
    }
}
