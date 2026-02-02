<?php

namespace App\Http\Controllers\ManajemenBMN;

use App\Http\Controllers\Controller;
use App\Models\PenatausahaanBMN;
use Illuminate\Http\Request;

class PenatausahaanBMNController extends Controller
{
    public function index(Request $request)
    {
        $query = PenatausahaanBMN::query();

        if ($request->has('kategori') && $request->kategori) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->has('kondisi') && $request->kondisi) {
            $query->where('kondisi', $request->kondisi);
        }

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_barang', 'like', "%{$search}%")
                  ->orWhere('kode_barang', 'like', "%{$search}%")
                  ->orWhere('nup', 'like', "%{$search}%");
            });
        }

        $penatausahaans = $query->latest()->paginate(15);

        // Statistics
        $stats = [
            'total_aset' => PenatausahaanBMN::sum('jumlah_unit'),
            'total_nilai_buku' => PenatausahaanBMN::sum('nilai_buku'),
            'nilai_tanah' => PenatausahaanBMN::where('kategori', 'Tanah')->sum('nilai_buku'),
            'nilai_gedung' => PenatausahaanBMN::where('kategori', 'Gedung Bangunan')->sum('nilai_buku'),
            'rumah_negara' => PenatausahaanBMN::where('kategori', 'Rumah Negara')->sum('jumlah_unit'),
            'kendaraan_operasional' => PenatausahaanBMN::where('kategori', 'Kendaraan Dinas Operasional')->sum('jumlah_unit'),
            'kendaraan_jabatan' => PenatausahaanBMN::where('kategori', 'Kendaraan Dinas Jabatan')->sum('jumlah_unit'),
            'kendaraan_fungsional' => PenatausahaanBMN::where('kategori', 'Kendaraan Dinas Fungsional')->sum('jumlah_unit'),
            'kondisi_baik' => PenatausahaanBMN::where('kondisi', 'Baik')->count(),
            'kondisi_rusak_ringan' => PenatausahaanBMN::where('kondisi', 'Rusak Ringan')->count(),
            'kondisi_rusak_berat' => PenatausahaanBMN::where('kondisi', 'Rusak Berat')->count(),
        ];

        return view('manajemen-bmn.penatausahaan.index', compact('penatausahaans', 'stats'));
    }

    public function show(PenatausahaanBMN $penatausahaan)
    {
        return view('manajemen-bmn.penatausahaan.show', compact('penatausahaan'));
    }
}
