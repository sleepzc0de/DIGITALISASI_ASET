<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DashboardAset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DashboardAsetController extends Controller
{
    public function index()
    {
        $asets = DashboardAset::latest()->paginate(15);
        return view('admin.dashboard-aset.index', compact('asets'));
    }

    public function create()
    {
        return view('admin.dashboard-aset.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_aset' => 'required|string|max:255',
            'jumlah_unit' => 'required|integer|min:1',
            'nilai_perolehan' => 'required|numeric|min:0',
            'nilai_buku' => 'required|numeric|min:0',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'lokasi' => 'required|string|max:255',
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'keterangan' => 'nullable|string',
        ]);

        DashboardAset::create($validated);
        Cache::forget('dashboard_aset_data');

        return redirect()->route('admin.dashboard-aset.index')
            ->with('success', 'Data aset berhasil ditambahkan.');
    }

    public function edit(DashboardAset $dashboardAset)
    {
        return view('admin.dashboard-aset.edit', compact('dashboardAset'));
    }

    public function update(Request $request, DashboardAset $dashboardAset)
    {
        $validated = $request->validate([
            'kategori_aset' => 'required|string|max:255',
            'jumlah_unit' => 'required|integer|min:1',
            'nilai_perolehan' => 'required|numeric|min:0',
            'nilai_buku' => 'required|numeric|min:0',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'lokasi' => 'required|string|max:255',
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'keterangan' => 'nullable|string',
        ]);

        $dashboardAset->update($validated);
        Cache::forget('dashboard_aset_data');

        return redirect()->route('admin.dashboard-aset.index')
            ->with('success', 'Data aset berhasil diperbarui.');
    }

    public function destroy(DashboardAset $dashboardAset)
    {
        $dashboardAset->delete();
        Cache::forget('dashboard_aset_data');

        return redirect()->route('admin.dashboard-aset.index')
            ->with('success', 'Data aset berhasil dihapus.');
    }
}
