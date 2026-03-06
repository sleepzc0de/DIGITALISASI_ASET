<?php

namespace Database\Seeders;

use App\Models\DashboardAset;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DashboardAsetSeeder extends Seeder
{
    public function run(): void
    {
        // Truncate dulu agar tidak duplikasi saat re-seed
        DB::table('dashboard_asets')->truncate();

        $now = now();

        $data = [
            // ── Tahun 2020 ──────────────────────────────────────────
            [
                'kategori_aset'   => 'Gedung & Bangunan',
                'jumlah_unit'     => 3,
                'nilai_perolehan' => 50_000_000_000,
                'nilai_buku'      => 45_000_000_000,
                'kondisi'         => 'Baik',
                'lokasi'          => 'Jakarta, Bandung, Surabaya',
                'tahun'           => 2020,
                'keterangan'      => 'Gedung kantor wilayah',
                'created_at'      => $now->copy()->subMonths(14),
                'updated_at'      => $now->copy()->subMonths(14),
            ],

            // ── Tahun 2021 ──────────────────────────────────────────
            [
                'kategori_aset'   => 'AC & Pendingin',
                'jumlah_unit'     => 85,
                'nilai_perolehan' => 340_000_000,
                'nilai_buku'      => 250_000_000,
                'kondisi'         => 'Rusak Ringan',
                'lokasi'          => 'Kantor Pusat',
                'tahun'           => 2021,
                'keterangan'      => 'AC split dan standing AC',
                'created_at'      => $now->copy()->subMonths(13),
                'updated_at'      => $now->copy()->subMonths(13),
            ],
            [
                'kategori_aset'   => 'Peralatan Keamanan',
                'jumlah_unit'     => 30,
                'nilai_perolehan' => 180_000_000,
                'nilai_buku'      => 130_000_000,
                'kondisi'         => 'Baik',
                'lokasi'          => 'Kantor Pusat',
                'tahun'           => 2021,
                'keterangan'      => 'CCTV dan access control',
                'created_at'      => $now->copy()->subMonths(13),
                'updated_at'      => $now->copy()->subMonths(13),
            ],

            // ── Tahun 2022 ──────────────────────────────────────────
            [
                'kategori_aset'   => 'Peralatan Kantor',
                'jumlah_unit'     => 250,
                'nilai_perolehan' => 450_000_000,
                'nilai_buku'      => 350_000_000,
                'kondisi'         => 'Rusak Ringan',
                'lokasi'          => 'Kantor Pusat',
                'tahun'           => 2022,
                'keterangan'      => 'Printer, scanner, mesin fotokopi',
                'created_at'      => $now->copy()->subMonths(12),
                'updated_at'      => $now->copy()->subMonths(12),
            ],
            [
                'kategori_aset'   => 'Peralatan Jaringan',
                'jumlah_unit'     => 45,
                'nilai_perolehan' => 270_000_000,
                'nilai_buku'      => 200_000_000,
                'kondisi'         => 'Baik',
                'lokasi'          => 'Semua Divisi',
                'tahun'           => 2022,
                'keterangan'      => 'Router, switch, access point',
                'created_at'      => $now->copy()->subMonths(12),
                'updated_at'      => $now->copy()->subMonths(12),
            ],
            [
                'kategori_aset'   => 'Kendaraan Dinas',
                'jumlah_unit'     => 5,
                'nilai_perolehan' => 1_250_000_000,
                'nilai_buku'      => 900_000_000,
                'kondisi'         => 'Rusak Ringan',
                'lokasi'          => 'Kantor Wilayah',
                'tahun'           => 2022,
                'keterangan'      => 'Kendaraan operasional kantor wilayah',
                'created_at'      => $now->copy()->subMonths(11),
                'updated_at'      => $now->copy()->subMonths(11),
            ],

            // ── Tahun 2023 ──────────────────────────────────────────
            [
                'kategori_aset'   => 'Kendaraan Dinas',
                'jumlah_unit'     => 15,
                'nilai_perolehan' => 3_500_000_000,
                'nilai_buku'      => 2_800_000_000,
                'kondisi'         => 'Baik',
                'lokasi'          => 'Kantor Pusat',
                'tahun'           => 2023,
                'keterangan'      => 'Kendaraan dinas pejabat dan operasional',
                'created_at'      => $now->copy()->subMonths(6),
                'updated_at'      => $now->copy()->subMonths(6),
            ],
            [
                'kategori_aset'   => 'Furniture',
                'jumlah_unit'     => 350,
                'nilai_perolehan' => 720_000_000,
                'nilai_buku'      => 480_000_000,
                'kondisi'         => 'Baik',
                'lokasi'          => 'Semua Kantor',
                'tahun'           => 2023,
                'keterangan'      => 'Meja, kursi, lemari arsip',
                'created_at'      => $now->copy()->subMonths(6),
                'updated_at'      => $now->copy()->subMonths(6),
            ],
            [
                'kategori_aset'   => 'Komputer & Laptop',
                'jumlah_unit'     => 80,
                'nilai_perolehan' => 640_000_000,
                'nilai_buku'      => 500_000_000,
                'kondisi'         => 'Baik',
                'lokasi'          => 'Semua Divisi',
                'tahun'           => 2023,
                'keterangan'      => 'Pengadaan laptop tahun 2023',
                'created_at'      => $now->copy()->subMonths(5),
                'updated_at'      => $now->copy()->subMonths(5),
            ],
            [
                'kategori_aset'   => 'Peralatan Kantor',
                'jumlah_unit'     => 60,
                'nilai_perolehan' => 120_000_000,
                'nilai_buku'      => 100_000_000,
                'kondisi'         => 'Rusak Berat',
                'lokasi'          => 'Kantor Wilayah',
                'tahun'           => 2023,
                'keterangan'      => 'Peralatan yang perlu penghapusan',
                'created_at'      => $now->copy()->subMonths(4),
                'updated_at'      => $now->copy()->subMonths(4),
            ],

            // ── Tahun 2024 ──────────────────────────────────────────
            [
                'kategori_aset'   => 'Komputer & Laptop',
                'jumlah_unit'     => 120,
                'nilai_perolehan' => 900_000_000,
                'nilai_buku'      => 600_000_000,
                'kondisi'         => 'Baik',
                'lokasi'          => 'Semua Divisi',
                'tahun'           => 2024,
                'keterangan'      => 'Pengadaan laptop dan PC terbaru',
                'created_at'      => $now->copy()->subMonths(2),
                'updated_at'      => $now->copy()->subMonths(2),
            ],
            [
                'kategori_aset'   => 'Peralatan Server',
                'jumlah_unit'     => 8,
                'nilai_perolehan' => 2_400_000_000,
                'nilai_buku'      => 2_200_000_000,
                'kondisi'         => 'Baik',
                'lokasi'          => 'Data Center',
                'tahun'           => 2024,
                'keterangan'      => 'Server untuk sistem digitalisasi',
                'created_at'      => $now->copy()->subMonths(2),
                'updated_at'      => $now->copy()->subMonths(2),
            ],
            [
                'kategori_aset'   => 'Furniture',
                'jumlah_unit'     => 100,
                'nilai_perolehan' => 200_000_000,
                'nilai_buku'      => 190_000_000,
                'kondisi'         => 'Baik',
                'lokasi'          => 'Kantor Pusat',
                'tahun'           => 2024,
                'keterangan'      => 'Renovasi ruang kerja baru',
                'created_at'      => $now->copy()->subMonth(),
                'updated_at'      => $now->copy()->subMonth(),
            ],
            [
                'kategori_aset'   => 'Kendaraan Dinas',
                'jumlah_unit'     => 4,
                'nilai_perolehan' => 1_200_000_000,
                'nilai_buku'      => 1_150_000_000,
                'kondisi'         => 'Baik',
                'lokasi'          => 'Kantor Pusat',
                'tahun'           => 2024,
                'keterangan'      => 'Kendaraan listrik operasional',
                'created_at'      => $now->copy()->subMonth(),
                'updated_at'      => $now->copy()->subMonth(),
            ],

            // ── Bulan lalu (untuk data pembanding pertumbuhan) ──────
            [
                'kategori_aset'   => 'Peralatan Kantor',
                'jumlah_unit'     => 25,
                'nilai_perolehan' => 75_000_000,
                'nilai_buku'      => 70_000_000,
                'kondisi'         => 'Baik',
                'lokasi'          => 'Kantor Pusat',
                'tahun'           => (int) $now->copy()->subMonth()->format('Y'),
                'keterangan'      => 'Pengadaan bulan lalu',
                'created_at'      => $now->copy()->subMonth(),
                'updated_at'      => $now->copy()->subMonth(),
            ],

            // ── Bulan ini (untuk data pertumbuhan terkini) ──────────
            [
                'kategori_aset'   => 'Komputer & Laptop',
                'jumlah_unit'     => 30,
                'nilai_perolehan' => 240_000_000,
                'nilai_buku'      => 235_000_000,
                'kondisi'         => 'Baik',
                'lokasi'          => 'Semua Divisi',
                'tahun'           => (int) $now->format('Y'),
                'keterangan'      => 'Pengadaan bulan ini',
                'created_at'      => $now->copy()->subDays(5),
                'updated_at'      => $now->copy()->subDays(5),
            ],
            [
                'kategori_aset'   => 'AC & Pendingin',
                'jumlah_unit'     => 10,
                'nilai_perolehan' => 50_000_000,
                'nilai_buku'      => 49_000_000,
                'kondisi'         => 'Baik',
                'lokasi'          => 'Kantor Pusat',
                'tahun'           => (int) $now->format('Y'),
                'keterangan'      => 'Penambahan AC ruang rapat',
                'created_at'      => $now->copy()->subDays(2),
                'updated_at'      => $now->copy()->subDays(2),
            ],
        ];

        // Insert sekaligus — jauh lebih cepat dari foreach + create()
        DB::table('dashboard_asets')->insert($data);

        $this->command->info('✅ DashboardAsetSeeder: ' . count($data) . ' data berhasil di-seed.');
    }
}
