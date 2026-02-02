<?php

namespace App\Http\Controllers\Admin\ManajemenBMN;

use App\Http\Controllers\Controller;
use App\Models\PerencanaanBMN;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PerencanaanBMNController extends Controller
{
    public function index(Request $request)
    {
        $query = PerencanaanBMN::query();

        if ($request->has('jenis') && $request->jenis) {
            $query->where('jenis_perencanaan', $request->jenis);
        }

        $perencanaans = $query->latest()->paginate(15);
        return view('admin.manajemen-bmn.perencanaan.index', compact('perencanaans'));
    }

    public function create()
    {
        return view('admin.manajemen-bmn.perencanaan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_perencanaan' => 'required|in:RP4,RKBMN',
            'nomor_dokumen' => 'required|string|unique:perencanaan_bmns,nomor_dokumen',
            'judul' => 'required|string|max:255',
            'kategori' => 'nullable|in:Penggunaan,Pemanfaatan,Pemindahtanganan,Penghapusan',
            'deskripsi' => 'nullable|string',
            'tahun_anggaran' => 'required|integer|min:2000|max:' . (date('Y') + 5),
            'tanggal_dokumen' => 'required|date',
            'nilai_estimasi' => 'nullable|numeric|min:0',
            'volume' => 'nullable|integer|min:0',
            'satuan' => 'nullable|string|max:50',
            'status' => 'required|in:Draft,Diajukan,Disetujui,Ditolak,Selesai',
            'keterangan' => 'nullable|string',
            'file_dokumen' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'pembuat' => 'required|string|max:255',
            'pejabat_pengesah' => 'nullable|string|max:255',
            'tanggal_pengesahan' => 'nullable|date',
        ]);

        if ($request->hasFile('file_dokumen')) {
            $validated['file_dokumen'] = $request->file('file_dokumen')->store('perencanaan-bmn', 'public');
        }

        PerencanaanBMN::create($validated);

        return redirect()->route('admin.manajemen-bmn.perencanaan.index')
            ->with('success', 'Data perencanaan BMN berhasil ditambahkan.');
    }

    public function edit(PerencanaanBMN $perencanaan)
    {
        return view('admin.manajemen-bmn.perencanaan.edit', compact('perencanaan'));
    }

    public function update(Request $request, PerencanaanBMN $perencanaan)
    {
        $validated = $request->validate([
            'jenis_perencanaan' => 'required|in:RP4,RKBMN',
            'nomor_dokumen' => 'required|string|unique:perencanaan_bmns,nomor_dokumen,' . $perencanaan->id,
            'judul' => 'required|string|max:255',
            'kategori' => 'nullable|in:Penggunaan,Pemanfaatan,Pemindahtanganan,Penghapusan',
            'deskripsi' => 'nullable|string',
            'tahun_anggaran' => 'required|integer|min:2000|max:' . (date('Y') + 5),
            'tanggal_dokumen' => 'required|date',
            'nilai_estimasi' => 'nullable|numeric|min:0',
            'volume' => 'nullable|integer|min:0',
            'satuan' => 'nullable|string|max:50',
            'status' => 'required|in:Draft,Diajukan,Disetujui,Ditolak,Selesai',
            'keterangan' => 'nullable|string',
            'file_dokumen' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'pembuat' => 'required|string|max:255',
            'pejabat_pengesah' => 'nullable|string|max:255',
            'tanggal_pengesahan' => 'nullable|date',
        ]);

        if ($request->hasFile('file_dokumen')) {
            if ($perencanaan->file_dokumen && Storage::disk('public')->exists($perencanaan->file_dokumen)) {
                Storage::disk('public')->delete($perencanaan->file_dokumen);
            }
            $validated['file_dokumen'] = $request->file('file_dokumen')->store('perencanaan-bmn', 'public');
        }

        $perencanaan->update($validated);

        return redirect()->route('admin.manajemen-bmn.perencanaan.index')
            ->with('success', 'Data perencanaan BMN berhasil diperbarui.');
    }

    public function destroy(PerencanaanBMN $perencanaan)
    {
        if ($perencanaan->file_dokumen && Storage::disk('public')->exists($perencanaan->file_dokumen)) {
            Storage::disk('public')->delete($perencanaan->file_dokumen);
        }

        $perencanaan->delete();

        return redirect()->route('admin.manajemen-bmn.perencanaan.index')
            ->with('success', 'Data perencanaan BMN berhasil dihapus.');
    }
}
