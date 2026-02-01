<?php

namespace App\Http\Controllers;

use App\Models\DashboardAset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {
        $data = Cache::remember('dashboard_aset_data', 3600, function () {
            return [
                'totalAset' => DashboardAset::sum('jumlah_unit'),
                'totalNilai' => DashboardAset::sum('nilai_buku'),
                'kategoriData' => DashboardAset::selectRaw('kategori_aset, SUM(jumlah_unit) as total')
                    ->groupBy('kategori_aset')
                    ->get(),
                'kondisiData' => DashboardAset::selectRaw('kondisi, COUNT(*) as total')
                    ->groupBy('kondisi')
                    ->get(),
                'nilaiPerKategori' => DashboardAset::selectRaw('kategori_aset, SUM(nilai_buku) as total_nilai')
                    ->groupBy('kategori_aset')
                    ->get(),
                'trendTahunan' => DashboardAset::selectRaw('tahun, SUM(jumlah_unit) as total')
                    ->groupBy('tahun')
                    ->orderBy('tahun')
                    ->get(),
            ];
        });

        return view('dashboard.index', $data);
    }
}
