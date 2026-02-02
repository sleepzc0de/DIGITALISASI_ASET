<?php

namespace App\Http\Controllers\Admin\ManajemenBMN;

use App\Http\Controllers\Controller;
use App\Models\WasdalBMN;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WasdalBMNController extends Controller
{
    public function index(Request $request)
    {
        $query = WasdalBMN::query();

        if ($request->has('jenis') && $request->jenis) {
            $query->where('jenis_wasdal', $request->jenis);
        }

        $wasdals = $query->latest()->paginate(15);
        return view('admin.manajemen-bmn.wasdal.index', compact('wasdals'));
    }

    public function create()
    {
        return view('admin.manajemen-bmn.wasdal.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_wasdal' => 'required|in:Pelaporan BMN,Sensus BMN',
            'nomor_laporan' => 'required|string|unique:wasdal_bmns,nomor_laporan',
            'judul' => 'required|string|max:255',
            'periode' => 'required|in:Triwulan I,Triwulan II,Triwulan III,Triwulan IV,Semester I,Semester II,Tahunan,Insidental',
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'tanggal_laporan' => 'required|date',
            'tanggal_mulai_pelaksanaan' => 'nullable|date',
            'tanggal_selesai_pelaksanaan' => 'nullable|date|after_or_equal:tanggal_mulai_pelaksanaan',
            'jumlah_aset_tercatat' => 'nullable|integer|min:0',
            'jumlah_aset_terverifikasi' => 'nullable|integer|min:0',
            'total_nilai_buku' => 'nullable|numeric|min:0',
            'aset_kondisi_baik' => 'nullable|integer|min:0',
            'aset_kondisi_rusak_ringan' => 'nullable|integer|min:0',
            'aset_kondisi_rusak_berat' => 'nullable|integer|min:0',
            'temuan' => 'nullable|string',
            'rekomendasi' => 'nullable|string',
            'status' => 'required|in:Draft,Submitted,Reviewed,Approved,Rejected',
            'petugas_pelaksana' => 'nullable|string|max:255',
            'pejabat_penerima' => 'nullable|string|max:255',
            'file_laporan' => 'nullable|file|mimes:pdf|max:5120',
            'file_lampiran' => 'nullable|file|mimes:pdf,zip,rar|max:10240',
            'keterangan' => 'nullable|string',
        ]);

        if ($request->hasFile('file_laporan')) {
            $validated['file_laporan'] = $request->file('file_laporan')->store('wasdal-bmn/laporan', 'public');
        }

        if ($request->hasFile('file_lampiran')) {
            $validated['file_lampiran'] = $request->file('file_lampiran')->store('wasdal-bmn/lampiran', 'public');
        }

        WasdalBMN::create($validated);

        return redirect()->route('admin.manajemen-bmn.wasdal.index')
            ->with('success', 'Data wasdal BMN berhasil ditambahkan.');
    }

    public function edit(WasdalBMN $wasdal)
    {
        return view('admin.manajemen-bmn.wasdal.edit', compact('wasdal'));
    }

    public function update(Request $request, WasdalBMN $wasdal)
    {
        $validated = $request->validate([
            'jenis_wasdal' => 'required|in:Pelaporan BMN,Sensus BMN',
            'nomor_laporan' => 'required|string|unique:wasdal_bmns,nomor_laporan,' . $wasdal->id,
            'judul' => 'required|string|max:255',
            'periode' => 'required|in:Triwulan I,Triwulan II,Triwulan III,Triwulan IV,Semester I,Semester II,Tahunan,Insidental',
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'tanggal_laporan' => 'required|date',
            'tanggal_mulai_pelaksanaan' => 'nullable|date',
            'tanggal_selesai_pelaksanaan' => 'nullable|date|after_or_equal:tanggal_mulai_pelaksanaan',
            'jumlah_aset_tercatat' => 'nullable|integer|min:0',
            'jumlah_aset_terverifikasi' => 'nullable|integer|min:0',
            'total_nilai_buku' => 'nullable|numeric|min:0',
            'aset_kondisi_baik' => 'nullable|integer|min:0',
            'aset_kondisi_rusak_ringan' => 'nullable|integer|min:0',
            'aset_kondisi_rusak_berat' => 'nullable|integer|min:0',
            'temuan' => 'nullable|string',
            'rekomendasi' => 'nullable|string',
            'status' => 'required|in:Draft,Submitted,Reviewed,Approved,Rejected',
            'petugas_pelaksana' => 'nullable|string|max:255',
            'pejabat_penerima' => 'nullable|string|max:255',
            'file_laporan' => 'nullable|file|mimes:pdf|max:5120',
            'file_lampiran' => 'nullable|file|mimes:pdf,zip,rar|max:10240',
            'keterangan' => 'nullable|string',
        ]);

        if ($request->hasFile('file_laporan')) {
            if ($wasdal->file_laporan && Storage::disk('public')->exists($wasdal->file_laporan)) {
                Storage::disk('public')->delete($wasdal->file_laporan);
            }
            $validated['file_laporan'] = $request->file('file_laporan')->store('wasdal-bmn/laporan', 'public');
        }

        if ($request->hasFile('file_lampiran')) {
            if ($wasdal->file_lampiran && Storage::disk('public')->exists($wasdal->file_lampiran)) {
                Storage::disk('public')->delete($wasdal->file_lampiran);
            }
            $validated['file_lampiran'] = $request->file('file_lampiran')->store('wasdal-bmn/lampiran', 'public');
        }

        $wasdal->update($validated);

        return redirect()->route('admin.manajemen-bmn.wasdal.index')
            ->with('success', 'Data wasdal BMN berhasil diperbarui.');
    }

    public function destroy(WasdalBMN $wasdal)
    {
        if ($wasdal->file_laporan && Storage::disk('public')->exists($wasdal->file_laporan)) {
            Storage::disk('public')->delete($wasdal->file_laporan);
        }

        if ($wasdal->file_lampiran && Storage::disk('public')->exists($wasdal->file_lampiran)) {
            Storage::disk('public')->delete($wasdal->file_lampiran);
        }

        $wasdal->delete();

        return redirect()->route('admin.manajemen-bmn.wasdal.index')
            ->with('success', 'Data wasdal BMN berhasil dihapus.');
    }
}
