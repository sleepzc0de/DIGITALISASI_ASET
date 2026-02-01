<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DashboardAset extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_aset',
        'jumlah_unit',
        'nilai_perolehan',
        'nilai_buku',
        'kondisi',
        'lokasi',
        'tahun',
        'keterangan',
    ];

    protected $casts = [
        'jumlah_unit' => 'integer',
        'nilai_perolehan' => 'decimal:2',
        'nilai_buku' => 'decimal:2',
        'tahun' => 'integer',
    ];
}
