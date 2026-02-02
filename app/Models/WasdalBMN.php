<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class WasdalBMN extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis_wasdal',
        'nomor_laporan',
        'judul',
        'periode',
        'tahun',
        'tanggal_laporan',
        'tanggal_mulai_pelaksanaan',
        'tanggal_selesai_pelaksanaan',
        'jumlah_aset_tercatat',
        'jumlah_aset_terverifikasi',
        'total_nilai_buku',
        'aset_kondisi_baik',
        'aset_kondisi_rusak_ringan',
        'aset_kondisi_rusak_berat',
        'temuan',
        'rekomendasi',
        'status',
        'petugas_pelaksana',
        'pejabat_penerima',
        'file_laporan',
        'file_lampiran',
        'keterangan',
    ];

    protected $casts = [
        'tahun' => 'integer',
        'tanggal_laporan' => 'date',
        'tanggal_mulai_pelaksanaan' => 'date',
        'tanggal_selesai_pelaksanaan' => 'date',
        'jumlah_aset_tercatat' => 'integer',
        'jumlah_aset_terverifikasi' => 'integer',
        'total_nilai_buku' => 'decimal:2',
        'aset_kondisi_baik' => 'integer',
        'aset_kondisi_rusak_ringan' => 'integer',
        'aset_kondisi_rusak_berat' => 'integer',
    ];

    public function getStatusBadgeClass(): string
    {
        return match($this->status) {
            'Draft' => 'bg-gray-100 text-gray-800',
            'Submitted' => 'bg-blue-100 text-blue-800',
            'Reviewed' => 'bg-yellow-100 text-yellow-800',
            'Approved' => 'bg-green-100 text-green-800',
            'Rejected' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getPersentaseVerifikasi(): float
    {
        if ($this->jumlah_aset_tercatat > 0) {
            return ($this->jumlah_aset_terverifikasi / $this->jumlah_aset_tercatat) * 100;
        }
        return 0;
    }

    public function getFileLaporanUrl(): ?string
    {
        if ($this->file_laporan && Storage::disk('public')->exists($this->file_laporan)) {
            return Storage::url($this->file_laporan);
        }
        return null;
    }

    public function getFileLampiranUrl(): ?string
    {
        if ($this->file_lampiran && Storage::disk('public')->exists($this->file_lampiran)) {
            return Storage::url($this->file_lampiran);
        }
        return null;
    }
}
