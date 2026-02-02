<?php

namespace App\Http\Controllers\ManajemenBMN;

use App\Http\Controllers\Controller;
use App\Models\PerencanaanBMN;
use Illuminate\Http\Request;

class PerencanaanBMNController extends Controller
{
    public function index(Request $request)
    {
        $query = PerencanaanBMN::query();

        if ($request->has('jenis') && $request->jenis) {
            $query->where('jenis_perencanaan', $request->jenis);
        }

        if ($request->has('tahun') && $request->tahun) {
            $query->where('tahun_anggaran', $request->tahun);
        }

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $perencanaans = $query->latest()->paginate(15);

        $stats = [
            'total' => PerencanaanBMN::count(),
            'rp4' => PerencanaanBMN::where('jenis_perencanaan', 'RP4')->count(),
            'rkbmn' => PerencanaanBMN::where('jenis_perencanaan', 'RKBMN')->count(),
            'disetujui' => PerencanaanBMN::where('status', 'Disetujui')->count(),
            'total_nilai' => PerencanaanBMN::sum('nilai_estimasi'),
        ];

        return view('manajemen-bmn.perencanaan.index', compact('perencanaans', 'stats'));
    }

    public function show(PerencanaanBMN $perencanaan)
    {
        return view('manajemen-bmn.perencanaan.show', compact('perencanaan'));
    }
}
