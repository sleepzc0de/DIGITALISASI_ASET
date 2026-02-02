<?php

namespace App\Http\Controllers\Admin\ManajemenBMN;

use App\Http\Controllers\Controller;
use App\Models\PenghapusanBMN;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PenghapusanBMNController extends Controller
{
    public function index()
    {
        $penghapusans = PenghapusanBMN::latest()->paginate(15);
        return view('admin.manajemen-bmn.penghapusan.index', compact('penghapusans'));
    }

    public function create()
    {
        return view('admin.manajemen-bmn.penghapusan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_sk' => 'required|string|unique:penghapusan_bmns,nomor_sk',
            'nama_aset' => 'required|string|max:255',
            'kode_barang' => 'nullable|string|max:100',
            'deskripsi_aset' => 'nullable|string',
            'alasan_penghapusan' => 'required|in:Rusak Berat,Hilang,Kadaluarsa,Tidak Ekonomis,Force Majeure,Lainnya',
            'jumlah_unit' => 'required|integer|min:1',
            'nilai_perolehan' => 'required|numeric|min:0',
            'nilai_buku' => 'required|numeric|min:0',
            'tanggal_sk' => 'required|date',
            'tanggal_penghapusan' => 'required|date|after_or_equal:tanggal_sk',
            'pejabat_penandatangan' => 'required|string|max:255',
            'metode_penghapusan' => 'nullable|string|max:255',
            'status' => 'required|in:Draft,Proses,Selesai,Dibatalkan',
            'file_sk' => 'nullable|file|mimes:pdf|max:5120',
            'file_ba_penghapusan' => 'nullable|file|mimes:pdf|max:5120',
            'keterangan' => 'nullable|string',
        ]);

        if ($request->hasFile('file_sk')) {
            $validated['file_sk'] = $request->file('file_sk')->store('penghapusan-bmn/sk', 'public');
        }

        if ($request->hasFile('file_ba_penghapusan')) {
            $validated['file_ba_penghapusan'] = $request->file('file_ba_penghapusan')->store('penghapusan-bmn/ba', 'public');
        }

        PenghapusanBMN::create($validated);

        return redirect()->route('admin.manajemen-bmn.penghapusan.index')
            ->with('success', 'Data penghapusan BMN berhasil ditambahkan.');
    }

    public function edit(PenghapusanBMN $penghapusan)
    {
        return view('admin.manajemen-bmn.penghapusan.edit', compact('penghapusan'));
    }

    public function update(Request $request, PenghapusanBMN $penghapusan)
    {
        $validated = $request->validate([
            'nomor_sk' => 'required|string|unique:penghapusan_bmns,nomor_sk,' . $penghapusan->id,
            'nama_aset' => 'required|string|max:255',
            'kode_barang' => 'nullable|string|max:100',
            'deskripsi_aset' => 'nullable|string',
            'alasan_penghapusan' => 'required|in:Rusak Berat,Hilang,Kadaluarsa,Tidak Ekonomis,Force Majeure,Lainnya',
            'jumlah_unit' => 'required|integer|min:1',
            'nilai_perolehan' => 'required|numeric|min:0',
            'nilai_buku' => 'required|numeric|min:0',
            'tanggal_sk' => 'required|date',
            'tanggal_penghapusan' => 'required|date|after_or_equal:tanggal_sk',
            'pejabat_penandatangan' => 'required|string|max:255',
            'metode_penghapusan' => 'nullable|string|max:255',
            'status' => 'required|in:Draft,Proses,Selesai,Dibatalkan',
            'file_sk' => 'nullable|file|mimes:pdf|max:5120',
            'file_ba_penghapusan' => 'nullable|file|mimes:pdf|max:5120',
            'keterangan' => 'nullable|string',
        ]);

        if ($request->hasFile('file_sk')) {
            if ($penghapusan->file_sk && Storage::disk('public')->exists($penghapusan->file_sk)) {
                Storage::disk('public')->delete($penghapusan->file_sk);
            }
            $validated['file_sk'] = $request->file('file_sk')->store('penghapusan-bmn/sk', 'public');
        }

        if ($request->hasFile('file_ba_penghapusan')) {
            if ($penghapusan->file_ba_penghapusan && Storage::disk('public')->exists($penghapusan->file_ba_penghapusan)) {
                Storage::disk('public')->delete($penghapusan->file_ba_penghapusan);
            }
            $validated['file_ba_penghapusan'] = $request->file('file_ba_penghapusan')->store('penghapusan-bmn/ba', 'public');
        }

        $penghapusan->update($validated);

        return redirect()->route('admin.manajemen-bmn.penghapusan.index')
            ->with('success', 'Data penghapusan BMN berhasil diperbarui.');
    }

    public function destroy(PenghapusanBMN $penghapusan)
    {
        if ($penghapusan->file_sk && Storage::disk('public')->exists($penghapusan->file_sk)) {
            Storage::disk('public')->delete($penghapusan->file_sk);
        }

        if ($penghapusan->file_ba_penghapusan && Storage::disk('public')->exists($penghapusan->file_ba_penghapusan)) {
            Storage::disk('public')->delete($penghapusan->file_ba_penghapusan);
        }

        $penghapusan->delete();

        return redirect()->route('admin.manajemen-bmn.penghapusan.index')
            ->with('success', 'Data penghapusan BMN berhasil dihapus.');
    }
}
