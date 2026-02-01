<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KinerjaBMN extends Model
{
    use HasFactory;
    protected $table = 'kinerja_bmns';

    protected $fillable = [
        'jenis_kegiatan',
        'nama_kegiatan',
        'target',
        'realisasi',
        'anggaran',
        'realisasi_anggaran',
        'status',
        'tanggal_mulai',
        'tanggal_selesai',
        'bulan',
        'tahun',
        'keterangan',
    ];

    protected $casts = [
        'target' => 'integer',
        'realisasi' => 'integer',
        'anggaran' => 'decimal:2',
        'realisasi_anggaran' => 'decimal:2',
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'bulan' => 'integer',
        'tahun' => 'integer',
    ];

    public function getPersentaseRealisasiAttribute(): float
    {
        return $this->target > 0 ? ($this->realisasi / $this->target) * 100 : 0;
    }

    public function getPersentaseAnggaranAttribute(): float
    {
        return $this->anggaran > 0 ? ($this->realisasi_anggaran / $this->anggaran) * 100 : 0;
    }
}
