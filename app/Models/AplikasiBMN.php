<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class AplikasiBMN extends Model
{
    use HasFactory;

    protected $table = 'aplikasi_bmns';

    protected $fillable = [
        'nama_aplikasi',
        'kategori',
        'deskripsi',
        'versi',
        'vendor',
        'url_aplikasi',
        'pic_nama',
        'pic_email',
        'pic_telepon',
        'status',
        'tanggal_implementasi',
        'tanggal_expired',
        'jumlah_user',
        'biaya_lisensi',
        'periode_lisensi',
        'fitur_utama',
        'logo',
    ];

    protected $casts = [
        'tanggal_implementasi' => 'date',
        'tanggal_expired' => 'date',
        'jumlah_user' => 'integer',
        'biaya_lisensi' => 'decimal:2',
    ];

    public function getStatusBadgeClass(): string
    {
        return match($this->status) {
            'Aktif' => 'bg-green-100 text-green-800',
            'Maintenance' => 'bg-yellow-100 text-yellow-800',
            'Non-Aktif' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getKategoriBadgeClass(): string
    {
        return match($this->kategori) {
            'BMN' => 'bg-blue-100 text-blue-800',
            'Pengadaan' => 'bg-purple-100 text-purple-800',
            'Inventaris' => 'bg-indigo-100 text-indigo-800',
            'Monitoring' => 'bg-pink-100 text-pink-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getLogoUrl(): string
    {
        if ($this->logo && Storage::disk('public')->exists($this->logo)) {
            return Storage::url($this->logo);
        }

        return 'https://ui-avatars.com/api/?name=' . urlencode($this->nama_aplikasi) . '&color=4F46E5&background=EEF2FF&size=200';
    }

    public function isExpiringSoon(): bool
    {
        if (!$this->tanggal_expired) {
            return false;
        }

        return $this->tanggal_expired->diffInDays(now()) <= 30 && $this->tanggal_expired->isFuture();
    }

    public function isExpired(): bool
    {
        if (!$this->tanggal_expired) {
            return false;
        }

        return $this->tanggal_expired->isPast();
    }
}
