<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PemanfaatanBMN extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis_pemanfaatan',
        'nomor_sk',
        'nama_pihak_ketiga',
        'alamat_objek',
        'latitude',
        'longitude',
        'deskripsi_objek',
        'luas_tanah',
        'luas_bangunan',
        'nilai_sewa_tahunan',
        'tanggal_mulai',
        'tanggal_berakhir',
        'masa_pemanfaatan_bulan',
        'status',
        'file_sk',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_berakhir' => 'date',
        'luas_tanah' => 'decimal:2',
        'luas_bangunan' => 'decimal:2',
        'nilai_sewa_tahunan' => 'decimal:2',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'masa_pemanfaatan_bulan' => 'integer',
    ];

    public function getStatusBadgeClass(): string
    {
        return match($this->status) {
            'Aktif' => 'bg-green-100 text-green-800',
            'Berakhir' => 'bg-gray-100 text-gray-800',
            'Diperpanjang' => 'bg-blue-100 text-blue-800',
            'Dibatalkan' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function isExpiringSoon(): bool
    {
        return $this->tanggal_berakhir->diffInDays(now()) <= 30 && $this->tanggal_berakhir->isFuture();
    }

    public function getFileUrl(): ?string
    {
        if ($this->file_sk && Storage::disk('public')->exists($this->file_sk)) {
            return Storage::url($this->file_sk);
        }
        return null;
    }
}
