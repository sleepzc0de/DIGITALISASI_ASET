<?php

namespace Database\Seeders;

use App\Models\KinerjaBMN;
use Illuminate\Database\Seeder;

class KinerjaBMNSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'jenis_kegiatan' => 'Pengadaan',
                'nama_kegiatan' => 'Pengadaan Laptop untuk Karyawan Baru',
                'target' => 50,
                'realisasi' => 45,
                'anggaran' => 500000000,
                'realisasi_anggaran' => 450000000,
                'status' => 'On Progress',
                'tanggal_mulai' => '2024-01-15',
                'tanggal_selesai' => null,
                'bulan' => 1,
                'tahun' => 2024,
            ],
            [
                'jenis_kegiatan' => 'Pemeliharaan',
                'nama_kegiatan' => 'Servis Kendaraan Dinas Rutin',
                'target' => 15,
                'realisasi' => 15,
                'anggaran' => 45000000,
                'realisasi_anggaran' => 43000000,
                'status' => 'Completed',
                'tanggal_mulai' => '2024-02-01',
                'tanggal_selesai' => '2024-02-28',
                'bulan' => 2,
                'tahun' => 2024,
            ],
            [
                'jenis_kegiatan' => 'Pengadaan',
                'nama_kegiatan' => 'Pengadaan Furniture Kantor',
                'target' => 100,
                'realisasi' => 80,
                'anggaran' => 250000000,
                'realisasi_anggaran' => 200000000,
                'status' => 'On Progress',
                'tanggal_mulai' => '2024-03-10',
                'tanggal_selesai' => null,
                'bulan' => 3,
                'tahun' => 2024,
            ],
            [
                'jenis_kegiatan' => 'Penghapusan',
                'nama_kegiatan' => 'Penghapusan Aset Rusak Berat',
                'target' => 25,
                'realisasi' => 20,
                'anggaran' => 10000000,
                'realisasi_anggaran' => 8000000,
                'status' => 'Delayed',
                'tanggal_mulai' => '2024-04-05',
                'tanggal_selesai' => null,
                'bulan' => 4,
                'tahun' => 2024,
            ],
            [
                'jenis_kegiatan' => 'Pemeliharaan',
                'nama_kegiatan' => 'Perbaikan AC Kantor',
                'target' => 30,
                'realisasi' => 30,
                'anggaran' => 60000000,
                'realisasi_anggaran' => 55000000,
                'status' => 'Completed',
                'tanggal_mulai' => '2024-05-01',
                'tanggal_selesai' => '2024-05-20',
                'bulan' => 5,
                'tahun' => 2024,
            ],
        ];

        foreach ($data as $item) {
            KinerjaBMN::create($item);
        }
    }
}
