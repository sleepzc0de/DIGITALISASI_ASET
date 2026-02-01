<?php

namespace Database\Seeders;

use App\Models\AplikasiBMN;
use Illuminate\Database\Seeder;

class AplikasiBMNSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama_aplikasi' => 'SIMAK BMN',
                'kategori' => 'BMN',
                'deskripsi' => 'Sistem Informasi Manajemen dan Akuntansi Barang Milik Negara untuk pengelolaan aset negara secara terintegrasi.',
                'versi' => '5.2.1',
                'vendor' => 'Kemenkeu RI',
                'url_aplikasi' => 'https://simak-bmn.kemenkeu.go.id',
                'pic_nama' => 'Ahmad Fauzi',
                'pic_email' => 'ahmad.fauzi@kemenkeu.go.id',
                'pic_telepon' => '021-12345678',
                'status' => 'Aktif',
                'tanggal_implementasi' => '2020-01-15',
                'tanggal_expired' => '2026-12-31',
                'jumlah_user' => 250,
                'biaya_lisensi' => 150000000,
                'periode_lisensi' => 'Tahunan',
                'fitur_utama' => "- Pencatatan dan pelaporan BMN\n- Inventarisasi aset\n- Monitoring kondisi aset\n- Laporan keuangan terintegrasi",
            ],
            [
                'nama_aplikasi' => 'E-Procurement',
                'kategori' => 'Pengadaan',
                'deskripsi' => 'Aplikasi pengadaan barang dan jasa secara elektronik untuk transparansi dan efisiensi proses tender.',
                'versi' => '3.8.0',
                'vendor' => 'LKPP',
                'url_aplikasi' => 'https://e-procurement.gov.id',
                'pic_nama' => 'Siti Nurhaliza',
                'pic_email' => 'siti.nurhaliza@lkpp.go.id',
                'pic_telepon' => '021-87654321',
                'status' => 'Aktif',
                'tanggal_implementasi' => '2019-06-01',
                'tanggal_expired' => '2025-05-31',
                'jumlah_user' => 450,
                'biaya_lisensi' => 300000000,
                'periode_lisensi' => 'Tahunan',
                'fitur_utama' => "- E-Tendering\n- E-Purchasing\n- E-Katalog\n- Monitoring pengadaan real-time\n- Integrasi SIKAP",
            ],
            [
                'nama_aplikasi' => 'Asset Tracking System',
                'kategori' => 'Inventaris',
                'deskripsi' => 'Sistem pelacakan aset berbasis barcode dan RFID untuk monitoring lokasi dan perpindahan aset secara real-time.',
                'versi' => '2.5.3',
                'vendor' => 'PT Teknologi Aset Indonesia',
                'url_aplikasi' => 'https://asset-tracking.internal',
                'pic_nama' => 'Budi Santoso',
                'pic_email' => 'budi.santoso@company.com',
                'pic_telepon' => '021-55556666',
                'status' => 'Aktif',
                'tanggal_implementasi' => '2021-03-20',
                'tanggal_expired' => '2025-03-19',
                'jumlah_user' => 120,
                'biaya_lisensi' => 85000000,
                'periode_lisensi' => 'Tahunan',
                'fitur_utama' => "- Barcode & RFID scanning\n- GPS tracking\n- Mobile app untuk field officer\n- Dashboard real-time\n- Alert notifikasi",
            ],
            [
                'nama_aplikasi' => 'Dashboard Monitoring BMN',
                'kategori' => 'Monitoring',
                'deskripsi' => 'Dashboard visualisasi data BMN untuk monitoring dan analisis kinerja pengelolaan aset secara komprehensif.',
                'versi' => '1.9.2',
                'vendor' => 'PT Solusi Digital',
                'url_aplikasi' => 'https://dashboard-bmn.internal',
                'pic_nama' => 'Dewi Lestari',
                'pic_email' => 'dewi.lestari@company.com',
                'pic_telepon' => '021-77778888',
                'status' => 'Maintenance',
                'tanggal_implementasi' => '2022-08-10',
                'tanggal_expired' => '2025-08-09',
                'jumlah_user' => 80,
                'biaya_lisensi' => 50000000,
                'periode_lisensi' => 'Tahunan',
                'fitur_utama' => "- Dashboard interaktif\n- Grafik dan chart analitik\n- Export laporan PDF/Excel\n- Custom report builder\n- API integration",
            ],
            [
                'nama_aplikasi' => 'Maintenance Management System',
                'kategori' => 'BMN',
                'deskripsi' => 'Sistem manajemen pemeliharaan aset untuk penjadwalan, tracking, dan dokumentasi kegiatan maintenance.',
                'versi' => '4.1.0',
                'vendor' => 'PT Maintenance Pro',
                'url_aplikasi' => 'https://mms.internal',
                'pic_nama' => 'Rudi Hermawan',
                'pic_email' => 'rudi.hermawan@company.com',
                'pic_telepon' => '021-99990000',
                'status' => 'Aktif',
                'tanggal_implementasi' => '2020-11-05',
                'tanggal_expired' => '2024-04-15',
                'jumlah_user' => 95,
                'biaya_lisensi' => 75000000,
                'periode_lisensi' => 'Tahunan',
                'fitur_utama' => "- Preventive maintenance scheduling\n- Work order management\n- Spare parts inventory\n- Performance analytics\n- Mobile technician app",
            ],
            [
                'nama_aplikasi' => 'E-Katalog Pengadaan',
                'kategori' => 'Pengadaan',
                'deskripsi' => 'Platform katalog elektronik untuk pengadaan barang dengan harga dan spesifikasi terstandarisasi.',
                'versi' => '2.3.1',
                'vendor' => 'LKPP',
                'url_aplikasi' => 'https://e-katalog.lkpp.go.id',
                'pic_nama' => 'Andi Wijaya',
                'pic_email' => 'andi.wijaya@lkpp.go.id',
                'pic_telepon' => '021-33334444',
                'status' => 'Aktif',
                'tanggal_implementasi' => '2018-04-12',
                'tanggal_expired' => null,
                'jumlah_user' => 500,
                'biaya_lisensi' => null,
                'periode_lisensi' => 'Selamanya',
                'fitur_utama' => "- Katalog produk terstandar\n- Perbandingan harga\n- Order online\n- Integrasi SIKAP\n- Riwayat transaksi",
            ],
        ];

        foreach ($data as $item) {
            AplikasiBMN::create($item);
        }
    }
}
