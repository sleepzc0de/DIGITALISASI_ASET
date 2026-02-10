<?php

namespace App\Http\Controllers\ManajemenBMN;

use App\Http\Controllers\Controller;
use App\Models\WasdalBMN;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WasdalBMNController extends Controller
{
    public function index(Request $request)
    {
        $query = WasdalBMN::query();

        if ($request->has('jenis') && $request->jenis) {
            $query->where('jenis_wasdal', $request->jenis);
        }

        if ($request->has('tahun') && $request->tahun) {
            $query->where('tahun', $request->tahun);
        }

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $wasdals = $query->latest()->paginate(15);

        $stats = [
            'total' => WasdalBMN::count(),
            'pelaporan' => WasdalBMN::where('jenis_wasdal', 'Pelaporan BMN')->count(),
            'sensus' => WasdalBMN::where('jenis_wasdal', 'Sensus BMN')->count(),
            'approved' => WasdalBMN::where('status', 'Approved')->count(),
            'total_aset_tercatat' => WasdalBMN::sum('jumlah_aset_tercatat'),
            'total_aset_terverifikasi' => WasdalBMN::sum('jumlah_aset_terverifikasi'),
        ];

        // Data untuk chart
        $chartData = $this->getChartData();

        return view('manajemen-bmn.wasdal.index', compact('wasdals', 'stats', 'chartData'));
    }

    public function show(WasdalBMN $wasdal)
    {
        return view('manajemen-bmn.wasdal.show', compact('wasdal'));
    }

    /**
     * Get data untuk chart dashboard
     */
    private function getChartData()
    {
        // 1. Data trend laporan per tahun
        $trendData = WasdalBMN::select(DB::raw('tahun, COUNT(*) as total'))
            ->groupBy('tahun')
            ->orderBy('tahun', 'asc')
            ->get()
            ->pluck('total', 'tahun')
            ->toArray();

        // 2. Data distribusi status laporan
        $statusData = WasdalBMN::select(DB::raw('status, COUNT(*) as total'))
            ->groupBy('status')
            ->get()
            ->pluck('total', 'status')
            ->toArray();

        // 3. Data perbandingan jumlah aset terverifikasi vs tercatat per tahun
        $verifikasiData = WasdalBMN::select(
            DB::raw('tahun,
                        SUM(jumlah_aset_tercatat) as total_tercatat,
                        SUM(jumlah_aset_terverifikasi) as total_terverifikasi')
        )
            ->whereNotNull('jumlah_aset_tercatat')
            ->whereNotNull('jumlah_aset_terverifikasi')
            ->groupBy('tahun')
            ->orderBy('tahun', 'asc')
            ->get();

        // 4. Data jenis laporan per bulan (tahun ini)
        $currentYear = date('Y');
        $jenisPerBulan = WasdalBMN::select(
            DB::raw('MONTH(created_at) as bulan,
                jenis_wasdal,
                COUNT(*) as total')
        )
            ->whereYear('created_at', $currentYear)
            ->groupBy(DB::raw('MONTH(created_at), jenis_wasdal')) // Perubahan di sini
            ->orderBy('bulan', 'asc')
            ->get();

        // Format data untuk chart line per jenis
        $jenisLabels = [];
        $pelaporanData = [];
        $sensusData = [];

        for ($i = 1; $i <= 12; $i++) {
            $jenisLabels[] = date('M', mktime(0, 0, 0, $i, 1));
            $pelaporanData[$i] = 0;
            $sensusData[$i] = 0;
        }

        foreach ($jenisPerBulan as $data) {
            if ($data->jenis_wasdal == 'Pelaporan BMN') {
                $pelaporanData[$data->bulan] = $data->total;
            } else {
                $sensusData[$data->bulan] = $data->total;
            }
        }

        return [
            'trend' => [
                'labels' => array_keys($trendData),
                'data' => array_values($trendData),
            ],
            'status' => [
                'labels' => array_keys($statusData),
                'data' => array_values($statusData),
                'colors' => [
                    'Draft' => '#9CA3AF',
                    'Submitted' => '#3B82F6',
                    'Reviewed' => '#F59E0B',
                    'Approved' => '#10B981',
                    'Rejected' => '#EF4444',
                ]
            ],
            'verifikasi' => [
                'labels' => $verifikasiData->pluck('tahun')->toArray(),
                'tercatat' => $verifikasiData->pluck('total_tercatat')->toArray(),
                'terverifikasi' => $verifikasiData->pluck('total_terverifikasi')->toArray(),
            ],
            'jenis_per_bulan' => [
                'labels' => $jenisLabels,
                'pelaporan' => array_values($pelaporanData),
                'sensus' => array_values($sensusData),
            ]
        ];
    }
}
