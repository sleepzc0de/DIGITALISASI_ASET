<?php

namespace App\Http\Controllers\ManajemenBMN;

use App\Http\Controllers\Controller;
use App\Models\WasdalBMN;
use Illuminate\Http\Request;

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

        return view('manajemen-bmn.wasdal.index', compact('wasdals', 'stats'));
    }

    public function show(WasdalBMN $wasdal)
    {
        return view('manajemen-bmn.wasdal.show', compact('wasdal'));
    }
}
