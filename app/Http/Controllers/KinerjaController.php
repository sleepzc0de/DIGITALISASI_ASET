<?php

namespace App\Http\Controllers;

use App\Models\KinerjaBMN;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class KinerjaController extends Controller
{
    public function index()
    {
        $data = Cache::remember('kinerja_bmn_data', 3600, function () {
            return [
                'totalKegiatan' => KinerjaBMN::count(),
                'kegiatanSelesai' => KinerjaBMN::where('status', 'Completed')->count(),
                'realisasiData' => KinerjaBMN::selectRaw('jenis_kegiatan, AVG((realisasi * 100.0 / target)) as persentase')
                    ->groupBy('jenis_kegiatan')
                    ->get(),
                'anggaranData' => KinerjaBMN::selectRaw('jenis_kegiatan, SUM(anggaran) as total_anggaran, SUM(realisasi_anggaran) as total_realisasi')
                    ->groupBy('jenis_kegiatan')
                    ->get(),
                'statusData' => KinerjaBMN::selectRaw('status, COUNT(*) as total')
                    ->groupBy('status')
                    ->get(),
                'trendBulanan' => KinerjaBMN::selectRaw('bulan, COUNT(*) as total')
                    ->where('tahun', date('Y'))
                    ->groupBy('bulan')
                    ->orderBy('bulan')
                    ->get(),
            ];
        });

        return view('kinerja.index', $data);
    }
}
