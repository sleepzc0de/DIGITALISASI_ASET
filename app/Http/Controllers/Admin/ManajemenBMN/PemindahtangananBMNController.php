<?php

namespace App\Http\Controllers\Admin\ManajemenBMN;

use App\Http\Controllers\Controller;
use App\Models\PemindahtangananBMN;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PemindahtangananBMNController extends Controller
{
    public function index()
    {
        $pemindahtanganans = PemindahtangananBMN::latest()->paginate(15);
        return view('admin.manajemen-bmn.pemindahtanganan.index', compact('pemindahtanganans'));
    }

    public function create()
    {
        return view('admin.manajemen-bmn.pemindahtanganan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_laporan' => 'required|string|unique:pemindahtanganan_bmns,nomor_laporan',
            'jenis_pemindahtanganan' => 'required|in:Penjualan,Tukar Menukar,Hibah,Penyertaan Modal',
            'nama_aset' => 'required|string|max:255',
            'deskripsi_aset' => 'nullable|string',
            'nilai_perolehan' => 'required|numeric|min:0',
            'nilai_buku' => 'required|numeric|min:0',
            'nilai_pnbp' => 'required|numeric|min:0',
            'tanggal_pemindahtanganan' => 'required|date',
            'penerima' => 'required|string|max:255',
            'dasar_hukum' => 'nullable|string',
            'status_pnbp' => 'required|in:Belum Setor,Sudah Setor,Dibebaskan',
            'tanggal_setor_pnbp' => 'nullable|date',
            'nomor_bukti_setor' => 'nullable|string|max:255',
            'file_laporan' => 'nullable|file|mimes:pdf|max:5120',
            'keterangan' => 'nullable|string',
        ]);

        if ($request->hasFile('file_laporan')) {
            $validated['file_laporan'] = $request->file('file_laporan')->store('pemindahtanganan-bmn', 'public');
        }

        PemindahtangananBMN::create($validated);

        return redirect()->route('admin.manajemen-bmn.pemindahtanganan.index')
            ->with('success', 'Data pemindahtanganan BMN berhasil ditambahkan.');
    }

    public function edit(PemindahtangananBMN $pemindahtanganan)
    {
        return view('admin.manajemen-bmn.pemindahtanganan.edit', compact('pemindahtanganan'));
    }

    public function update(Request $request, PemindahtangananBMN $pemindahtanganan)
    {
        $validated = $request->validate([
            'nomor_laporan' => 'required|string|unique:pemindahtanganan_bmns,nomor_laporan,' . $pemindahtanganan->id,
            'jenis_pemindahtanganan' => 'required|in:Penjualan,Tukar Menukar,Hibah,Penyertaan Modal',
            'nama_aset' => 'required|string|max:255',
            'deskripsi_aset' => 'nullable|string',
            'nilai_perolehan' => 'required|numeric|min:0',
            'nilai_buku' => 'required|numeric|min:0',
            'nilai_pnbp' => 'required|numeric|min:0',
            'tanggal_pemindahtanganan' => 'required|date',
            'penerima' => 'required|string|max:255',
            'dasar_hukum' => 'nullable|string',
            'status_pnbp' => 'required|in:Belum Setor,Sudah Setor,Dibebaskan',
            'tanggal_setor_pnbp' => 'nullable|date',
            'nomor_bukti_setor' => 'nullable|string|max:255',
            'file_laporan' => 'nullable|file|mimes:pdf|max:5120',
            'keterangan' => 'nullable|string',
        ]);

        if ($request->hasFile('file_laporan')) {
            if ($pemindahtanganan->file_laporan && Storage::disk('public')->exists($pemindahtanganan->file_laporan)) {
                Storage::disk('public')->delete($pemindahtanganan->file_laporan);
            }
            $validated['file_laporan'] = $request->file('file_laporan')->store('pemindahtanganan-bmn', 'public');
        }

        $pemindahtanganan->update($validated);

        return redirect()->route('admin.manajemen-bmn.pemindahtanganan.index')
            ->with('success', 'Data pemindahtanganan BMN berhasil diperbarui.');
    }

    public function destroy(PemindahtangananBMN $pemindahtanganan)
    {
        if ($pemindahtanganan->file_laporan && Storage::disk('public')->exists($pemindahtanganan->file_laporan)) {
            Storage::disk('public')->delete($pemindahtanganan->file_laporan);
        }

        $pemindahtanganan->delete();

        return redirect()->route('admin.manajemen-bmn.pemindahtanganan.index')
            ->with('success', 'Data pemindahtanganan BMN berhasil dihapus.');
    }
}
