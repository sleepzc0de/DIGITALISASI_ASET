<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PenghapusanBMN extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_sk',
        'nama_aset',
        'kode_barang',
        'deskripsi_aset',
        'alasan_penghapusan',
        'jumlah_unit',
        'nilai_perolehan',
        'nilai_buku',
        'tanggal_sk',
        'tanggal_penghapusan',
        'pejabat_penandatangan',
        'metode_penghapusan',
        'status',
        'file_sk',
        'file_ba_penghapusan',
        'keterangan',
    ];

    protected $casts = [
        'jumlah_unit' => 'integer',
        'nilai_perolehan' => 'decimal:2',
        'nilai_buku' => 'decimal:2',
        'tanggal_sk' => 'date',
        'tanggal_penghapusan' => 'date',
    ];

    public function getStatusBadgeClass(): string
    {
        return match($this->status) {
            'Draft' => 'bg-gray-100 text-gray-800',
            'Proses' => 'bg-blue-100 text-blue-800',
            'Selesai' => 'bg-green-100 text-green-800',
            'Dibatalkan' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getFileSKUrl(): ?string
    {
        if ($this->file_sk && Storage::disk('public')->exists($this->file_sk)) {
            return Storage::url($this->file_sk);
        }
        return null;
    }

    public function getFileBAUrl(): ?string
    {
        if ($this->file_ba_penghapusan && Storage::disk('public')->exists($this->file_ba_penghapusan)) {
            return Storage::url($this->file_ba_penghapusan);
        }
        return null;
    }
}
