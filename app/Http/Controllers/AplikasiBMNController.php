<?php

namespace App\Http\Controllers;

use App\Models\AplikasiBMN;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AplikasiBMNController extends Controller
{
    public function index(Request $request)
    {
        $kategori = $request->get('kategori');
        $status = $request->get('status');
        $search = $request->get('search');

        $query = AplikasiBMN::query();

        if ($kategori) {
            $query->where('kategori', $kategori);
        }

        if ($status) {
            $query->where('status', $status);
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama_aplikasi', 'like', "%{$search}%")
                  ->orWhere('vendor', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        $aplikasis = $query->latest()->paginate(12);

        // Statistics
        $stats = Cache::remember('aplikasi_bmn_stats', 3600, function () {
            return [
                'total' => AplikasiBMN::count(),
                'aktif' => AplikasiBMN::where('status', 'Aktif')->count(),
                'maintenance' => AplikasiBMN::where('status', 'Maintenance')->count(),
                'total_users' => AplikasiBMN::sum('jumlah_user'),
                'total_biaya' => AplikasiBMN::sum('biaya_lisensi'),
                'expiring_soon' => AplikasiBMN::whereNotNull('tanggal_expired')
                    ->whereRaw('DATEDIFF(day, GETDATE(), tanggal_expired) <= 30')
                    ->whereRaw('DATEDIFF(day, GETDATE(), tanggal_expired) >= 0')
                    ->count(),
            ];
        });

        return view('aplikasi-bmn.index', compact('aplikasis', 'stats', 'kategori', 'status', 'search'));
    }

    public function show(AplikasiBMN $aplikasiBmn)
    {
        return view('aplikasi-bmn.show', compact('aplikasiBmn'));
    }
}
