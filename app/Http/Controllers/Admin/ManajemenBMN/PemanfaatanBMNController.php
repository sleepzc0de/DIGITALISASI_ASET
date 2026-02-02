<?php

namespace App\Http\Controllers\Admin\ManajemenBMN;

use App\Http\Controllers\Controller;
use App\Models\PemanfaatanBMN;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PemanfaatanBMNController extends Controller
{
    public function index(Request $request)
    {
        $query = PemanfaatanBMN::query();

        if ($request->has('jenis') && $request->jenis) {
            $query->where('jenis_pemanfaatan', $request->jenis);
        }

        $pemanfaatans = $query->latest()->paginate(15);
        return view('admin.manajemen-bmn.pemanfaatan.index', compact('pemanfaatans'));
    }

    public function create()
    {
        return view('admin.manajemen-bmn.pemanfaatan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_pemanfaatan' => 'required|in:SK Sewa,Izin Penghunian',
            'nomor_sk' => 'required|string|unique:pemanfaatan_bmns,nomor_sk',
            'nama_pihak_ketiga' => 'required|string|max:255',
            'alamat_objek' => 'required|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'deskripsi_objek' => 'nullable|string',
            'luas_tanah' => 'nullable|numeric|min:0',
            'luas_bangunan' => 'nullable|numeric|min:0',
            'nilai_sewa_tahunan' => 'nullable|numeric|min:0',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date|after:tanggal_mulai',
            'masa_pemanfaatan_bulan' => 'nullable|integer|min:1',
            'status' => 'required|in:Aktif,Berakhir,Diperpanjang,Dibatalkan',
            'file_sk' => 'nullable|file|mimes:pdf|max:5120',
            'keterangan' => 'nullable|string',
        ]);

        if ($request->hasFile('file_sk')) {
            $validated['file_sk'] = $request->file('file_sk')->store('pemanfaatan-bmn', 'public');
        }

        PemanfaatanBMN::create($validated);

        return redirect()->route('admin.manajemen-bmn.pemanfaatan.index')
            ->with('success', 'Data pemanfaatan BMN berhasil ditambahkan.');
    }

    public function edit(PemanfaatanBMN $pemanfaatan)
    {
        return view('admin.manajemen-bmn.pemanfaatan.edit', compact('pemanfaatan'));
    }

    public function update(Request $request, PemanfaatanBMN $pemanfaatan)
    {
        $validated = $request->validate([
            'jenis_pemanfaatan' => 'required|in:SK Sewa,Izin Penghunian',
            'nomor_sk' => 'required|string|unique:pemanfaatan_bmns,nomor_sk,' . $pemanfaatan->id,
            'nama_pihak_ketiga' => 'required|string|max:255',
            'alamat_objek' => 'required|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'deskripsi_objek' => 'nullable|string',
            'luas_tanah' => 'nullable|numeric|min:0',
            'luas_bangunan' => 'nullable|numeric|min:0',
            'nilai_sewa_tahunan' => 'nullable|numeric|min:0',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date|after:tanggal_mulai',
            'masa_pemanfaatan_bulan' => 'nullable|integer|min:1',
            'status' => 'required|in:Aktif,Berakhir,Diperpanjang,Dibatalkan',
            'file_sk' => 'nullable|file|mimes:pdf|max:5120',
            'keterangan' => 'nullable|string',
        ]);

        if ($request->hasFile('file_sk')) {
            if ($pemanfaatan->file_sk && Storage::disk('public')->exists($pemanfaatan->file_sk)) {
                Storage::disk('public')->delete($pemanfaatan->file_sk);
            }
            $validated['file_sk'] = $request->file('file_sk')->store('pemanfaatan-bmn', 'public');
        }

        $pemanfaatan->update($validated);

        return redirect()->route('admin.manajemen-bmn.pemanfaatan.index')
            ->with('success', 'Data pemanfaatan BMN berhasil diperbarui.');
    }

    public function destroy(PemanfaatanBMN $pemanfaatan)
    {
        if ($pemanfaatan->file_sk && Storage::disk('public')->exists($pemanfaatan->file_sk)) {
            Storage::disk('public')->delete($pemanfaatan->file_sk);
        }

        $pemanfaatan->delete();

        return redirect()->route('admin.manajemen-bmn.pemanfaatan.index')
            ->with('success', 'Data pemanfaatan BMN berhasil dihapus.');
    }
}
