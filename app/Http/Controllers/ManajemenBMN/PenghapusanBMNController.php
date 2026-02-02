<?php

namespace App\Http\Controllers\ManajemenBMN;

use App\Http\Controllers\Controller;
use App\Models\PenghapusanBMN;
use Illuminate\Http\Request;

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

        $penghapusans = $query->latest()->paginate(15);

        $stats = [
            'total' => PenghapusanBMN::count(),
            'selesai' => PenghapusanBMN::where('status', 'Selesai')->count(),
            'proses' => PenghapusanBMN::where('status', 'Proses')->count(),
            'total_nilai' => PenghapusanBMN::sum('nilai_buku'),
            'total_unit' => PenghapusanBMN::sum('jumlah_unit'),
        ];

        return view('manajemen-bmn.penghapusan.index', compact('penghapusans', 'stats'));
    }

    public function show(PenghapusanBMN $penghapusan)
    {
        return view('manajemen-bmn.penghapusan.show', compact('penghapusan'));
    }
}
