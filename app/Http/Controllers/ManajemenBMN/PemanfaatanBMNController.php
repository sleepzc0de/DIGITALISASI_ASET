<?php

namespace App\Http\Controllers\ManajemenBMN;

use App\Http\Controllers\Controller;
use App\Models\PemanfaatanBMN;
use Illuminate\Http\Request;

class PemanfaatanBMNController extends Controller
{
    public function index(Request $request)
    {
        $query = PemanfaatanBMN::query();

        if ($request->has('jenis') && $request->jenis) {
            $query->where('jenis_pemanfaatan', $request->jenis);
        }

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $pemanfaatans = $query->latest()->paginate(15);

        $stats = [
            'total' => PemanfaatanBMN::count(),
            'aktif' => PemanfaatanBMN::where('status', 'Aktif')->count(),
            'sk_sewa' => PemanfaatanBMN::where('jenis_pemanfaatan', 'SK Sewa')->count(),
            'izin_penghunian' => PemanfaatanBMN::where('jenis_pemanfaatan', 'Izin Penghunian')->count(),
            'total_nilai_sewa' => PemanfaatanBMN::where('status', 'Aktif')->sum('nilai_sewa_tahunan'),
        ];

        return view('manajemen-bmn.pemanfaatan.index', compact('pemanfaatans', 'stats'));
    }

    public function show(PemanfaatanBMN $pemanfaatan)
    {
        return view('manajemen-bmn.pemanfaatan.show', compact('pemanfaatan'));
    }

    public function peta()
    {
        $pemanfaatans = PemanfaatanBMN::where('status', 'Aktif')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        return view('manajemen-bmn.pemanfaatan.peta', compact('pemanfaatans'));
    }
}
