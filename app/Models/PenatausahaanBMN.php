<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PenatausahaanBMN extends Model
{
    use HasFactory;

     protected $table = 'penatausahaan_bmns';

    protected $fillable = [
        'kode_barang',
        'nup',
        'nama_barang',
        'kategori',
        'spesifikasi',
        'merk_type',
        'nomor_polisi',
        'tahun_pembuatan',
        'jumlah_unit',
        'satuan',
        'nilai_perolehan',
        'nilai_buku',
        'tanggal_perolehan',
        'kondisi',
        'lokasi',
        'pengguna',
        'nomor_dokumen_kepemilikan',
        'luas',
        'alamat_lengkap',
        'status_aset',
        'keterangan',
        'foto_aset',
    ];

    protected $casts = [
        'jumlah_unit' => 'integer',
        'nilai_perolehan' => 'decimal:2',
        'nilai_buku' => 'decimal:2',
        'tanggal_perolehan' => 'date',
        'luas' => 'decimal:2',
    ];

    public function getKondisiBadgeClass(): string
    {
        return match($this->kondisi) {
            'Baik' => 'bg-green-100 text-green-800',
            'Rusak Ringan' => 'bg-yellow-100 text-yellow-800',
            'Rusak Berat' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getKategoriBadgeClass(): string
    {
        return match($this->kategori) {
            'Tanah' => 'bg-green-100 text-green-800',
            'Gedung Bangunan' => 'bg-blue-100 text-blue-800',
            'Rumah Negara' => 'bg-purple-100 text-purple-800',
            'Kendaraan Dinas Operasional' => 'bg-orange-100 text-orange-800',
            'Kendaraan Dinas Jabatan' => 'bg-red-100 text-red-800',
            'Kendaraan Dinas Fungsional' => 'bg-pink-100 text-pink-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getFotoUrl(): string
    {
        if ($this->foto_aset && Storage::disk('public')->exists($this->foto_aset)) {
            return Storage::url($this->foto_aset);
        }
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->nama_barang) . '&color=4F46E5&background=EEF2FF&size=200';
    }
}
