<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PerencanaanBMN extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis_perencanaan',
        'nomor_dokumen',
        'judul',
        'kategori',
        'deskripsi',
        'tahun_anggaran',
        'tanggal_dokumen',
        'nilai_estimasi',
        'volume',
        'satuan',
        'status',
        'keterangan',
        'file_dokumen',
        'pembuat',
        'pejabat_pengesah',
        'tanggal_pengesahan',
    ];

    protected $casts = [
        'tanggal_dokumen' => 'date',
        'tanggal_pengesahan' => 'date',
        'nilai_estimasi' => 'decimal:2',
        'tahun_anggaran' => 'integer',
        'volume' => 'integer',
    ];

    public function getStatusBadgeClass(): string
    {
        return match($this->status) {
            'Draft' => 'bg-gray-100 text-gray-800',
            'Diajukan' => 'bg-blue-100 text-blue-800',
            'Disetujui' => 'bg-green-100 text-green-800',
            'Ditolak' => 'bg-red-100 text-red-800',
            'Selesai' => 'bg-purple-100 text-purple-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getFileUrl(): ?string
    {
        if ($this->file_dokumen && Storage::disk('public')->exists($this->file_dokumen)) {
            return Storage::url($this->file_dokumen);
        }
        return null;
    }
}
