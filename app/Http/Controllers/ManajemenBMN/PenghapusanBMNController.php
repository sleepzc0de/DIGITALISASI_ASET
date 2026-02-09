<?php

namespace App\Http\Controllers\ManajemenBMN;

use App\Http\Controllers\Controller;
use App\Models\PenghapusanBMN;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PenghapusanBMNController extends Controller
{
    public function index(Request $request)
    {
        $query = PenghapusanBMN::query();

        if ($request->has('alasan') && $request->alasan) {
            $query->where('alasan_penghapusan', $request->alasan);
        }

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        if ($request->has('sort') && $request->sort) {
            switch ($request->sort) {
                case 'oldest':
                    $query->orderBy('tanggal_sk', 'asc');
                    break;
                case 'nilai_tertinggi':
                    $query->orderBy('nilai_buku', 'desc');
                    break;
                case 'nilai_terendah':
                    $query->orderBy('nilai_buku', 'asc');
                    break;
                default:
                    $query->latest();
            }
        } else {
            $query->latest();
        }

        $penghapusans = $query->paginate(15);

        $stats = [
            'total' => PenghapusanBMN::count(),
            'selesai' => PenghapusanBMN::where('status', 'Selesai')->count(),
            'proses' => PenghapusanBMN::where('status', 'Proses')->count(),
            'total_nilai' => PenghapusanBMN::sum('nilai_buku'),
            'total_unit' => PenghapusanBMN::sum('jumlah_unit'),
        ];

        // Data untuk chart
        $chartData = $this->getChartData();

        return view('manajemen-bmn.penghapusan.index', compact('penghapusans', 'stats', 'chartData'));
    }

    private function getChartData()
    {
        // 1. Distribusi Alasan Penghapusan (Pie Chart)
        $alasanData = PenghapusanBMN::select('alasan_penghapusan', DB::raw('count(*) as total'))
            ->groupBy('alasan_penghapusan')
            ->get();

        // 2. Trend Bulanan (Line Chart) - 12 bulan terakhir (SQL Server compatible)
        $startDate = now()->subMonths(11)->startOfMonth();
        $endDate = now()->endOfMonth();

        $monthlyTrend = PenghapusanBMN::select(
                DB::raw("FORMAT(tanggal_sk, 'yyyy-MM') as month"),
                DB::raw('count(*) as total_sk'),
                DB::raw('sum(nilai_buku) as total_nilai')
            )
            ->whereBetween('tanggal_sk', [$startDate, $endDate])
            ->groupBy(DB::raw("FORMAT(tanggal_sk, 'yyyy-MM')"))
            ->orderBy('month')
            ->get();

        // Alternatif jika FORMAT tidak bekerja, gunakan CONVERT:
        // DB::raw("CONVERT(varchar(7), tanggal_sk, 120) as month")

        // Format data bulanan
        $trendLabels = [];
        $trendDataSK = [];
        $trendDataNilai = [];

        for ($i = 11; $i >= 0; $i--) {
            $month = now()->subMonths($i)->format('Y-m');
            $monthLabel = now()->subMonths($i)->format('M Y');

            $trendLabels[] = $monthLabel;

            $monthData = $monthlyTrend->firstWhere('month', $month);
            $trendDataSK[] = $monthData ? $monthData->total_sk : 0;
            $trendDataNilai[] = $monthData ? $monthData->total_nilai / 1000000 : 0; // Dalam juta
        }

        // 3. Distribusi Nilai Buku per Status (Bar Chart)
        $statusValueData = PenghapusanBMN::select('status', DB::raw('sum(nilai_buku) as total_nilai'))
            ->groupBy('status')
            ->get();

        // 4. Top 5 Aset dengan Nilai Buku Tertinggi
        $topAssets = PenghapusanBMN::select('nama_aset', 'nilai_buku')
            ->orderBy('nilai_buku', 'desc')
            ->limit(5)
            ->get();

        return [
            'alasan' => [
                'labels' => $alasanData->pluck('alasan_penghapusan')->toArray(),
                'data' => $alasanData->pluck('total')->toArray(),
                'colors' => [
                    '#FF6B6B', // Rusak Berat
                    '#4ECDC4', // Hilang
                    '#FFD166', // Kadaluarsa
                    '#06D6A0', // Tidak Ekonomis
                    '#118AB2', // Force Majeure
                    '#073B4C', // Lainnya
                ]
            ],
            'trend' => [
                'labels' => $trendLabels,
                'sk_data' => $trendDataSK,
                'nilai_data' => $trendDataNilai,
            ],
            'status_value' => [
                'labels' => $statusValueData->pluck('status')->toArray(),
                'data' => $statusValueData->pluck('total_nilai')->map(function ($value) {
                    return $value / 1000000; // Convert to millions
                })->toArray(),
            ],
            'top_assets' => [
                'labels' => $topAssets->pluck('nama_aset')->map(function ($name) {
                    return strlen($name) > 30 ? substr($name, 0, 30) . '...' : $name;
                })->toArray(),
                'data' => $topAssets->pluck('nilai_buku')->map(function ($value) {
                    return $value / 1000000; // Convert to millions
                })->toArray(),
            ],
            'status_distribution' => [
                'draft' => PenghapusanBMN::where('status', 'Draft')->count(),
                'proses' => PenghapusanBMN::where('status', 'Proses')->count(),
                'selesai' => PenghapusanBMN::where('status', 'Selesai')->count(),
                'dibatalkan' => PenghapusanBMN::where('status', 'Dibatalkan')->count(),
            ]
        ];
    }

    public function show(PenghapusanBMN $penghapusan)
    {
        return view('manajemen-bmn.penghapusan.show', compact('penghapusan'));
    }
}
