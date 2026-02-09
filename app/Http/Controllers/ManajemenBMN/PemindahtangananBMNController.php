<?php

namespace App\Http\Controllers\ManajemenBMN;

use App\Http\Controllers\Controller;
use App\Models\PemindahtangananBMN;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PemindahtangananBMNController extends Controller
{
    public function index(Request $request)
    {
        $query = PemindahtangananBMN::query();

        if ($request->has('jenis') && $request->jenis) {
            $query->where('jenis_pemindahtanganan', $request->jenis);
        }

        if ($request->has('status_pnbp') && $request->status_pnbp) {
            $query->where('status_pnbp', $request->status_pnbp);
        }

        if ($request->has('tahun') && $request->tahun) {
            $query->whereYear('tanggal_pemindahtanganan', $request->tahun);
        }

        $pemindahtanganans = $query->latest()->paginate(15);

        $stats = [
            'total' => PemindahtangananBMN::count(),
            'total_pnbp' => PemindahtangananBMN::sum('nilai_pnbp'),
            'sudah_setor' => PemindahtangananBMN::where('status_pnbp', 'Sudah Setor')->sum('nilai_pnbp'),
            'belum_setor' => PemindahtangananBMN::where('status_pnbp', 'Belum Setor')->sum('nilai_pnbp'),
        ];

        // Data untuk Chart
        // 1. Data per Jenis Pemindahtanganan
        $jenisData = PemindahtangananBMN::select('jenis_pemindahtanganan')
            ->selectRaw('COUNT(*) as jumlah, SUM(nilai_pnbp) as total_pnbp')
            ->groupBy('jenis_pemindahtanganan')
            ->get();

        // 2. Data per Status PNBP
        $statusData = PemindahtangananBMN::select('status_pnbp')
            ->selectRaw('COUNT(*) as jumlah, SUM(nilai_pnbp) as total_pnbp')
            ->groupBy('status_pnbp')
            ->get();

        // 3. Data per Bulan (12 bulan terakhir)
        $bulanLabels = [];
        $bulanData = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $bulanLabels[] = $date->format('M Y');

            $totalBulan = PemindahtangananBMN::whereYear('tanggal_pemindahtanganan', $date->year)
                ->whereMonth('tanggal_pemindahtanganan', $date->month)
                ->sum('nilai_pnbp');

            $bulanData[] = $totalBulan;
        }

        // 4. Top 5 Aset dengan Nilai PNBP Tertinggi
        $topAset = PemindahtangananBMN::select('nama_aset', 'nilai_pnbp', 'jenis_pemindahtanganan')
            ->orderBy('nilai_pnbp', 'desc')
            ->limit(5)
            ->get();

        return view('manajemen-bmn.pemindahtanganan.index', compact(
            'pemindahtanganans',
            'stats',
            'jenisData',
            'statusData',
            'bulanLabels',
            'bulanData',
            'topAset'
        ));
    }

    public function show(PemindahtangananBMN $pemindahtanganan)
    {
        return view('manajemen-bmn.pemindahtanganan.show', compact('pemindahtanganan'));
    }
}
