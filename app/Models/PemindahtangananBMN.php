<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PemindahtangananBMN extends Model
{
    use HasFactory;

     protected $table = 'pemindahtanganan_bmns';

    protected $fillable = [
        'nomor_laporan',
        'jenis_pemindahtanganan',
        'nama_aset',
        'deskripsi_aset',
        'nilai_perolehan',
        'nilai_buku',
        'nilai_pnbp',
        'tanggal_pemindahtanganan',
        'penerima',
        'dasar_hukum',
        'status_pnbp',
        'tanggal_setor_pnbp',
        'nomor_bukti_setor',
        'file_laporan',
        'keterangan',
    ];

    protected $casts = [
        'nilai_perolehan' => 'decimal:2',
        'nilai_buku' => 'decimal:2',
        'nilai_pnbp' => 'decimal:2',
        'tanggal_pemindahtanganan' => 'date',
        'tanggal_setor_pnbp' => 'date',
    ];

    public function getStatusPnbpBadgeClass(): string
    {
        return match($this->status_pnbp) {
            'Belum Setor' => 'bg-red-100 text-red-800',
            'Sudah Setor' => 'bg-green-100 text-green-800',
            'Dibebaskan' => 'bg-blue-100 text-blue-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getFileUrl(): ?string
    {
        if ($this->file_laporan && Storage::disk('public')->exists($this->file_laporan)) {
            return Storage::url($this->file_laporan);
        }
        return null;
    }
}
