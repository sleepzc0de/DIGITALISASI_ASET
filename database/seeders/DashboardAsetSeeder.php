<?php

namespace Database\Seeders;

use App\Models\DashboardAset;
use Illuminate\Database\Seeder;

class DashboardAsetSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'kategori_aset' => 'Kendaraan Dinas',
                'jumlah_unit' => 15,
                'nilai_perolehan' => 3500000000,
                'nilai_buku' => 2800000000,
                'kondisi' => 'Baik',
                'lokasi' => 'Kantor Pusat',
                'tahun' => 2023,
            ],
            [
                'kategori_aset' => 'Komputer & Laptop',
                'jumlah_unit' => 120,
                'nilai_perolehan' => 900000000,
                'nilai_buku' => 600000000,
                'kondisi' => 'Baik',
                'lokasi' => 'Semua Divisi',
                'tahun' => 2024,
            ],
            [
                'kategori_aset' => 'Peralatan Kantor',
                'jumlah_unit' => 250,
                'nilai_perolehan' => 450000000,
                'nilai_buku' => 350000000,
                'kondisi' => 'Rusak Ringan',
                'lokasi' => 'Kantor Pusat',
                'tahun' => 2022,
            ],
            [
                'kategori_aset' => 'Gedung & Bangunan',
                'jumlah_unit' => 3,
                'nilai_perolehan' => 50000000000,
                'nilai_buku' => 45000000000,
                'kondisi' => 'Baik',
                'lokasi' => 'Jakarta, Bandung, Surabaya',
                'tahun' => 2020,
            ],
            [
                'kategori_aset' => 'Furniture',
                'jumlah_unit' => 350,
                'nilai_perolehan' => 720000000,
                'nilai_buku' => 480000000,
                'kondisi' => 'Baik',
                'lokasi' => 'Semua Kantor',
                'tahun' => 2023,
            ],
            [
                'kategori_aset' => 'AC & Pendingin',
                'jumlah_unit' => 85,
                'nilai_perolehan' => 340000000,
                'nilai_buku' => 250000000,
                'kondisi' => 'Rusak Ringan',
                'lokasi' => 'Kantor Pusat',
                'tahun' => 2021,
            ],
        ];
        foreach ($data as $item) {
            DashboardAset::create($item);
        }
    }
}
