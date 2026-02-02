<?php

namespace App\Http\Controllers\Admin\ManajemenBMN;

use App\Http\Controllers\Controller;
use App\Models\PenatausahaanBMN;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PenatausahaanBMNController extends Controller
{
    public function index(Request $request)
    {
        $query = PenatausahaanBMN::query();

        if ($request->has('kategori') && $request->kategori) {
            $query->where('kategori', $request->kategori);
        }

        $penatausahaans = $query->latest()->paginate(15);
        return view('admin.manajemen-bmn.penatausahaan.index', compact('penatausahaans'));
    }

    public function create()
    {
        return view('admin.manajemen-bmn.penatausahaan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_barang' => 'required|string|unique:penatausahaan_bmns,kode_barang',
            'nup' => 'nullable|string|max:100',
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|in:Tanah,Gedung Bangunan,Rumah Negara,Kendaraan Dinas Operasional,Kendaraan Dinas Jabatan,Kendaraan Dinas Fungsional,Peralatan Kantor,Lainnya',
            'spesifikasi' => 'nullable|string',
            'merk_type' => 'nullable|string|max:255',
            'nomor_polisi' => 'nullable|string|max:20',
            'tahun_pembuatan' => 'nullable|string|max:4',
            'jumlah_unit' => 'required|integer|min:1',
            'satuan' => 'required|string|max:50',
            'nilai_perolehan' => 'required|numeric|min:0',
            'nilai_buku' => 'required|numeric|min:0',
            'tanggal_perolehan' => 'required|date',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'lokasi' => 'required|string|max:255',
            'pengguna' => 'nullable|string|max:255',
            'nomor_dokumen_kepemilikan' => 'nullable|string|max:255',
            'luas' => 'nullable|numeric|min:0',
            'alamat_lengkap' => 'nullable|string',
            'status_aset' => 'required|in:Digunakan,Tidak Digunakan,Dalam Perbaikan,Disewakan',
            'keterangan' => 'nullable|string',
            'foto_aset' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto_aset')) {
            $validated['foto_aset'] = $request->file('foto_aset')->store('penatausahaan-bmn', 'public');
        }

        PenatausahaanBMN::create($validated);

        return redirect()->route('admin.manajemen-bmn.penatausahaan.index')
            ->with('success', 'Data penatausahaan BMN berhasil ditambahkan.');
    }

    public function edit(PenatausahaanBMN $penatausahaan)
    {
        return view('admin.manajemen-bmn.penatausahaan.edit', compact('penatausahaan'));
    }

    public function update(Request $request, PenatausahaanBMN $penatausahaan)
    {
        $validated = $request->validate([
            'kode_barang' => 'required|string|unique:penatausahaan_bmns,kode_barang,' . $penatausahaan->id,
            'nup' => 'nullable|string|max:100',
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|in:Tanah,Gedung Bangunan,Rumah Negara,Kendaraan Dinas Operasional,Kendaraan Dinas Jabatan,Kendaraan Dinas Fungsional,Peralatan Kantor,Lainnya',
            'spesifikasi' => 'nullable|string',
            'merk_type' => 'nullable|string|max:255',
            'nomor_polisi' => 'nullable|string|max:20',
            'tahun_pembuatan' => 'nullable|string|max:4',
            'jumlah_unit' => 'required|integer|min:1',
            'satuan' => 'required|string|max:50',
            'nilai_perolehan' => 'required|numeric|min:0',
            'nilai_buku' => 'required|numeric|min:0',
            'tanggal_perolehan' => 'required|date',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'lokasi' => 'required|string|max:255',
            'pengguna' => 'nullable|string|max:255',
            'nomor_dokumen_kepemilikan' => 'nullable|string|max:255',
            'luas' => 'nullable|numeric|min:0',
            'alamat_lengkap' => 'nullable|string',
            'status_aset' => 'required|in:Digunakan,Tidak Digunakan,Dalam Perbaikan,Disewakan',
            'keterangan' => 'nullable|string',
            'foto_aset' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto_aset')) {
            if ($penatausahaan->foto_aset && Storage::disk('public')->exists($penatausahaan->foto_aset)) {
                Storage::disk('public')->delete($penatausahaan->foto_aset);
            }
            $validated['foto_aset'] = $request->file('foto_aset')->store('penatausahaan-bmn', 'public');
        }

        $penatausahaan->update($validated);

        return redirect()->route('admin.manajemen-bmn.penatausahaan.index')
            ->with('success', 'Data penatausahaan BMN berhasil diperbarui.');
    }

    public function destroy(PenatausahaanBMN $penatausahaan)
    {
        if ($penatausahaan->foto_aset && Storage::disk('public')->exists($penatausahaan->foto_aset)) {
            Storage::disk('public')->delete($penatausahaan->foto_aset);
        }

        $penatausahaan->delete();

        return redirect()->route('admin.manajemen-bmn.penatausahaan.index')
            ->with('success', 'Data penatausahaan BMN berhasil dihapus.');
    }
}
