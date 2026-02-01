<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AplikasiBMN;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class AplikasiBMNController extends Controller
{
    public function index(Request $request)
    {
        $query = AplikasiBMN::query();

        if ($request->has('kategori') && $request->kategori) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $aplikasis = $query->latest()->paginate(15);

        return view('admin.aplikasi-bmn.index', compact('aplikasis'));
    }

    public function create()
    {
        return view('admin.aplikasi-bmn.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_aplikasi' => 'required|string|max:255',
            'kategori' => 'required|in:BMN,Pengadaan,Inventaris,Monitoring',
            'deskripsi' => 'nullable|string',
            'versi' => 'nullable|string|max:50',
            'vendor' => 'nullable|string|max:255',
            'url_aplikasi' => 'nullable|url|max:255',
            'pic_nama' => 'nullable|string|max:255',
            'pic_email' => 'nullable|email|max:255',
            'pic_telepon' => 'nullable|string|max:20',
            'status' => 'required|in:Aktif,Maintenance,Non-Aktif',
            'tanggal_implementasi' => 'nullable|date',
            'tanggal_expired' => 'nullable|date|after_or_equal:tanggal_implementasi',
            'jumlah_user' => 'nullable|integer|min:0',
            'biaya_lisensi' => 'nullable|numeric|min:0',
            'periode_lisensi' => 'nullable|in:Tahunan,Bulanan,Selamanya',
            'fitur_utama' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('aplikasi-logos', 'public');
        }

        AplikasiBMN::create($validated);
        Cache::forget('aplikasi_bmn_stats');

        return redirect()->route('admin.aplikasi-bmn.index')
            ->with('success', 'Data aplikasi berhasil ditambahkan.');
    }

    public function edit(AplikasiBMN $aplikasiBmn)
    {
        return view('admin.aplikasi-bmn.edit', compact('aplikasiBmn'));
    }

    public function update(Request $request, AplikasiBMN $aplikasiBmn)
    {
        $validated = $request->validate([
            'nama_aplikasi' => 'required|string|max:255',
            'kategori' => 'required|in:BMN,Pengadaan,Inventaris,Monitoring',
            'deskripsi' => 'nullable|string',
            'versi' => 'nullable|string|max:50',
            'vendor' => 'nullable|string|max:255',
            'url_aplikasi' => 'nullable|url|max:255',
            'pic_nama' => 'nullable|string|max:255',
            'pic_email' => 'nullable|email|max:255',
            'pic_telepon' => 'nullable|string|max:20',
            'status' => 'required|in:Aktif,Maintenance,Non-Aktif',
            'tanggal_implementasi' => 'nullable|date',
            'tanggal_expired' => 'nullable|date|after_or_equal:tanggal_implementasi',
            'jumlah_user' => 'nullable|integer|min:0',
            'biaya_lisensi' => 'nullable|numeric|min:0',
            'periode_lisensi' => 'nullable|in:Tahunan,Bulanan,Selamanya',
            'fitur_utama' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            // Delete old logo
            if ($aplikasiBmn->logo && Storage::disk('public')->exists($aplikasiBmn->logo)) {
                Storage::disk('public')->delete($aplikasiBmn->logo);
            }

            $validated['logo'] = $request->file('logo')->store('aplikasi-logos', 'public');
        }

        $aplikasiBmn->update($validated);
        Cache::forget('aplikasi_bmn_stats');

        return redirect()->route('admin.aplikasi-bmn.index')
            ->with('success', 'Data aplikasi berhasil diperbarui.');
    }

    public function destroy(AplikasiBMN $aplikasiBmn)
    {
        // Delete logo if exists
        if ($aplikasiBmn->logo && Storage::disk('public')->exists($aplikasiBmn->logo)) {
            Storage::disk('public')->delete($aplikasiBmn->logo);
        }

        $aplikasiBmn->delete();
        Cache::forget('aplikasi_bmn_stats');

        return redirect()->route('admin.aplikasi-bmn.index')
            ->with('success', 'Data aplikasi berhasil dihapus.');
    }
}
