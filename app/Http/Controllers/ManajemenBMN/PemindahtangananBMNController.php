<?php

namespace App\Http\Controllers\ManajemenBMN;

use App\Http\Controllers\Controller;
use App\Models\PemindahtangananBMN;
use Illuminate\Http\Request;

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

        $pemindahtanganans = $query->latest()->paginate(15);

        $stats = [
            'total' => PemindahtangananBMN::count(),
            'total_pnbp' => PemindahtangananBMN::sum('nilai_pnbp'),
            'sudah_setor' => PemindahtangananBMN::where('status_pnbp', 'Sudah Setor')->sum('nilai_pnbp'),
            'belum_setor' => PemindahtangananBMN::where('status_pnbp', 'Belum Setor')->sum('nilai_pnbp'),
        ];

        return view('manajemen-bmn.pemindahtanganan.index', compact('pemindahtanganans', 'stats'));
    }

    public function show(PemindahtangananBMN $pemindahtanganan)
    {
        return view('manajemen-bmn.pemindahtanganan.show', compact('pemindahtanganan'));
    }
}
