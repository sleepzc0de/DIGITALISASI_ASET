<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KinerjaBMN;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class KinerjaBMNController extends Controller
{
    public function index()
    {
        $kinerjas = KinerjaBMN::latest()->paginate(15);
        return view('admin.kinerja-bmn.index', compact('kinerjas'));
    }

    public function create()
    {
        return view('admin.kinerja-bmn.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_kegiatan' => 'required|in:Pengadaan,Pemeliharaan,Penghapusan',
            'nama_kegiatan' => 'required|string|max:255',
            'target' => 'required|integer|min:1',
            'realisasi' => 'required|integer|min:0',
            'anggaran' => 'required|numeric|min:0',
            'realisasi_anggaran' => 'required|numeric|min:0',
            'status' => 'required|in:On Progress,Completed,Delayed',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'keterangan' => 'nullable|string',
        ]);

        KinerjaBMN::create($validated);
        Cache::forget('kinerja_bmn_data');

        return redirect()->route('admin.kinerja-bmn.index')
            ->with('success', 'Data kinerja berhasil ditambahkan.');
    }

    public function edit(KinerjaBMN $kinerjaBmn)
    {
        return view('admin.kinerja-bmn.edit', compact('kinerjaBmn'));
    }

    public function update(Request $request, KinerjaBMN $kinerjaBmn)
    {
        $validated = $request->validate([
            'jenis_kegiatan' => 'required|in:Pengadaan,Pemeliharaan,Penghapusan',
            'nama_kegiatan' => 'required|string|max:255',
            'target' => 'required|integer|min:1',
            'realisasi' => 'required|integer|min:0',
            'anggaran' => 'required|numeric|min:0',
            'realisasi_anggaran' => 'required|numeric|min:0',
            'status' => 'required|in:On Progress,Completed,Delayed',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'keterangan' => 'nullable|string',
        ]);

        $kinerjaBmn->update($validated);
        Cache::forget('kinerja_bmn_data');

        return redirect()->route('admin.kinerja-bmn.index')
            ->with('success', 'Data kinerja berhasil diperbarui.');
    }

    public function destroy(KinerjaBMN $kinerjaBmn)
    {
        $kinerjaBmn->delete();
        Cache::forget('kinerja_bmn_data');

        return redirect()->route('admin.kinerja-bmn.index')
            ->with('success', 'Data kinerja berhasil dihapus.');
    }
}
