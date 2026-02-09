<?php

namespace Database\Seeders;

use App\Models\PemindahtangananBMN;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PemindahtangananBMNSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data lama jika ada
        DB::table('pemindahtanganan_bmns')->truncate();

        $data = [
            // Penjualan - Sudah Setor
            [
                'nomor_laporan' => 'PNBP/001/' . date('Y'),
                'jenis_pemindahtanganan' => 'Penjualan',
                'nama_aset' => 'Mobil Dinas Toyota Fortuner 2020',
                'deskripsi_aset' => 'Kendaraan dinas operasional dengan kondisi baik, kilometer 45.000, perawatan rutin terpenuhi.',
                'nilai_perolehan' => 650000000,
                'nilai_buku' => 450000000,
                'nilai_pnbp' => 520000000,
                'tanggal_pemindahtanganan' => Carbon::create(2024, 1, 15),
                'penerima' => 'PT. Mitra Sejahtera',
                'dasar_hukum' => 'Peraturan Menteri Keuangan No. 190/PMK.06/2020 tentang Pemindahtanganan BMN',
                'status_pnbp' => 'Sudah Setor',
                'tanggal_setor_pnbp' => Carbon::create(2024, 1, 30),
                'nomor_bukti_setor' => 'STP-001/PNBP/2024',
                'file_laporan' => 'laporan-penjualan-fortuner.pdf',
                'keterangan' => 'Penjualan melalui lelang terbuka dengan penawaran tertinggi.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_laporan' => 'PNBP/002/' . date('Y'),
                'jenis_pemindahtanganan' => 'Penjualan',
                'nama_aset' => 'Gedung Perkantoran Lt. 3 - Jl. Sudirman',
                'deskripsi_aset' => 'Gedung perkantoran 3 lantai, luas 1500m², tahun bangun 2015, kondisi sangat baik.',
                'nilai_perolehan' => 12500000000,
                'nilai_buku' => 9500000000,
                'nilai_pnbp' => 11000000000,
                'tanggal_pemindahtanganan' => Carbon::create(2024, 2, 10),
                'penerima' => 'PT. Properti Maju',
                'dasar_hukum' => 'Peraturan Pemerintah No. 27 Tahun 2014 tentang Pengelolaan Barang Milik Negara/Daerah',
                'status_pnbp' => 'Sudah Setor',
                'tanggal_setor_pnbp' => Carbon::create(2024, 2, 28),
                'nomor_bukti_setor' => 'STP-002/PNBP/2024',
                'file_laporan' => 'laporan-penjualan-gedung.pdf',
                'keterangan' => 'Penjualan melalui tender dengan evaluasi kualifikasi dan harga.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Tukar Menukar - Sudah Setor
            [
                'nomor_laporan' => 'PNBP/003/' . date('Y'),
                'jenis_pemindahtanganan' => 'Tukar Menukar',
                'nama_aset' => 'Tanah Kavling Komersial - BSD City',
                'deskripsi_aset' => 'Tanah seluas 5000m² di kawasan komersial BSD City, sertifikat SHM, sudah ber-IMB.',
                'nilai_perolehan' => 3500000000,
                'nilai_buku' => 2800000000,
                'nilai_pnbp' => 3200000000,
                'tanggal_pemindahtanganan' => Carbon::create(2024, 3, 5),
                'penerima' => 'PT. Sentra Land',
                'dasar_hukum' => 'Peraturan Menteri Keuangan No. 154/PMK.06/2018 tentang Tukar Menukar BMN',
                'status_pnbp' => 'Sudah Setor',
                'tanggal_setor_pnbp' => Carbon::create(2024, 3, 20),
                'nomor_bukti_setor' => 'STP-003/PNBP/2024',
                'file_laporan' => 'laporan-tukar-menukar-tanah.pdf',
                'keterangan' => 'Tukar menukar dengan tanah di lokasi strategis untuk pembangunan kantor baru.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Hibah - Dibebaskan
            [
                'nomor_laporan' => 'PNBP/004/' . date('Y'),
                'jenis_pemindahtanganan' => 'Hibah',
                'nama_aset' => 'Perangkat Komputer dan Printer (50 unit)',
                'deskripsi_aset' => 'Perangkat komputer bekas pakai kondisi baik, masih layak operasional untuk pendidikan.',
                'nilai_perolehan' => 250000000,
                'nilai_buku' => 75000000,
                'nilai_pnbp' => 0,
                'tanggal_pemindahtanganan' => Carbon::create(2024, 4, 1),
                'penerima' => 'SMK Negeri 5 Jakarta',
                'dasar_hukum' => 'Peraturan Pemerintah No. 6 Tahun 2006 tentang Pengelolaan Barang Milik Negara',
                'status_pnbp' => 'Dibebaskan',
                'tanggal_setor_pnbp' => null,
                'nomor_bukti_setor' => null,
                'file_laporan' => 'laporan-hibah-komputer.pdf',
                'keterangan' => 'Hibah untuk mendukung pendidikan vokasi di sekolah kejuruan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_laporan' => 'PNBP/005/' . date('Y'),
                'jenis_pemindahtanganan' => 'Hibah',
                'nama_aset' => 'Mobil Ambulans',
                'deskripsi_aset' => 'Kendaraan ambulans standar rumah sakit, tahun 2018, kondisi operasional, siap pakai.',
                'nilai_perolehan' => 350000000,
                'nilai_buku' => 150000000,
                'nilai_pnbp' => 0,
                'tanggal_pemindahtanganan' => Carbon::create(2024, 4, 15),
                'penerima' => 'RSUD Kota Jakarta',
                'dasar_hukum' => 'Peraturan Menteri Kesehatan No. 30 Tahun 2019 tentang Hibah Alat Kesehatan',
                'status_pnbp' => 'Dibebaskan',
                'tanggal_setor_pnbp' => null,
                'nomor_bukti_setor' => null,
                'file_laporan' => 'laporan-hibah-ambulans.pdf',
                'keterangan' => 'Hibah untuk mendukung layanan kesehatan masyarakat.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Penyertaan Modal - Belum Setor
            [
                'nomor_laporan' => 'PNBP/006/' . date('Y'),
                'jenis_pemindahtanganan' => 'Penyertaan Modal',
                'nama_aset' => 'Gedung Pusat Inovasi Digital',
                'deskripsi_aset' => 'Gedung 5 lantai dengan fasilitas lengkap untuk pusat inovasi dan start-up digital.',
                'nilai_perolehan' => 85000000000,
                'nilai_buku' => 70000000000,
                'nilai_pnbp' => 75000000000,
                'tanggal_pemindahtanganan' => Carbon::create(2024, 5, 10),
                'penerima' => 'PT. Inovasi Digital Indonesia',
                'dasar_hukum' => 'Undang-Undang No. 1 Tahun 2004 tentang Perbendaharaan Negara',
                'status_pnbp' => 'Belum Setor',
                'tanggal_setor_pnbp' => null,
                'nomor_bukti_setor' => null,
                'file_laporan' => 'laporan-penyertaan-modal-gedung.pdf',
                'keterangan' => 'Penyertaan modal pemerintah dalam Badan Usaha Milik Negara untuk pengembangan ekosistem digital.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Penjualan - Belum Setor
            [
                'nomor_laporan' => 'PNBP/007/' . date('Y'),
                'jenis_pemindahtanganan' => 'Penjualan',
                'nama_aset' => 'Peralatan Medis USG 4D',
                'deskripsi_aset' => 'Alat ultrasonografi 4 dimensi merk GE Healthcare, tahun 2021, kondisi sangat baik.',
                'nilai_perolehan' => 1850000000,
                'nilai_buku' => 1450000000,
                'nilai_pnbp' => 1650000000,
                'tanggal_pemindahtanganan' => Carbon::create(2024, 5, 20),
                'penerima' => 'RS. Siloam Hospitals',
                'dasar_hukum' => 'Peraturan Menteri Kesehatan No. 40 Tahun 2018 tentang Penjualan Aset Kesehatan',
                'status_pnbp' => 'Belum Setor',
                'tanggal_setor_pnbp' => null,
                'nomor_bukti_setor' => null,
                'file_laporan' => 'laporan-penjualan-usg.pdf',
                'keterangan' => 'Penjualan melalui lelang terbatas kepada rumah sakit swasta.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Tukar Menukar - Belum Setor
            [
                'nomor_laporan' => 'PNBP/008/' . date('Y'),
                'jenis_pemindahtanganan' => 'Tukar Menukar',
                'nama_aset' => 'Fasilitas Laboratorium Kimia',
                'deskripsi_aset' => 'Laboratorium kimia lengkap dengan peralatan analisis modern untuk penelitian.',
                'nilai_perolehan' => 3250000000,
                'nilai_buku' => 2450000000,
                'nilai_pnbp' => 2850000000,
                'tanggal_pemindahtanganan' => Carbon::create(2024, 6, 5),
                'penerima' => 'Universitas Indonesia',
                'dasar_hukum' => 'Peraturan Menteri Pendidikan No. 25 Tahun 2020 tentang Tukar Menukar Aset Pendidikan',
                'status_pnbp' => 'Belum Setor',
                'tanggal_setor_pnbp' => null,
                'nomor_bukti_setor' => null,
                'file_laporan' => 'laporan-tukar-menukar-lab.pdf',
                'keterangan' => 'Tukar menukar dengan fasilitas penelitian di kampus baru.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Penjualan - Sudah Setor (nilai kecil)
            [
                'nomor_laporan' => 'PNBP/009/' . date('Y'),
                'jenis_pemindahtanganan' => 'Penjualan',
                'nama_aset' => 'Kendaraan Operasional Pick Up',
                'deskripsi_aset' => 'Kendaraan pick up Mitsubishi L300 tahun 2019, kondisi baik, kilometer 75.000.',
                'nilai_perolehan' => 185000000,
                'nilai_buku' => 95000000,
                'nilai_pnbp' => 125000000,
                'tanggal_pemindahtanganan' => Carbon::create(2024, 6, 15),
                'penerima' => 'CV. Mandiri Jaya',
                'dasar_hukum' => 'Peraturan Menteri Keuangan No. 190/PMK.06/2020 tentang Pemindahtanganan BMN',
                'status_pnbp' => 'Sudah Setor',
                'tanggal_setor_pnbp' => Carbon::create(2024, 6, 30),
                'nomor_bukti_setor' => 'STP-009/PNBP/2024',
                'file_laporan' => 'laporan-penjualan-pickup.pdf',
                'keterangan' => 'Penjualan melalui pelelangan umum kendaraan dinas.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Penyertaan Modal - Sudah Setor
            [
                'nomor_laporan' => 'PNBP/010/' . date('Y'),
                'jenis_pemindahtanganan' => 'Penyertaan Modal',
                'nama_aset' => 'Saham PT. Bank Negara',
                'deskripsi_aset' => 'Saham pemerintah dalam bank BUMN sebesar 15% dari total saham.',
                'nilai_perolehan' => 500000000000,
                'nilai_buku' => 750000000000,
                'nilai_pnbp' => 600000000000,
                'tanggal_pemindahtanganan' => Carbon::create(2024, 7, 1),
                'penerima' => 'PT. Bank Negara Indonesia Tbk',
                'dasar_hukum' => 'Undang-Undang No. 17 Tahun 2003 tentang Keuangan Negara',
                'status_pnbp' => 'Sudah Setor',
                'tanggal_setor_pnbp' => Carbon::create(2024, 7, 15),
                'nomor_bukti_setor' => 'STP-010/PNBP/2024',
                'file_laporan' => 'laporan-penyertaan-modal-saham.pdf',
                'keterangan' => 'Penyertaan modal tambahan untuk penguatan modal bank BUMN.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Data tahun sebelumnya untuk testing filter
            [
                'nomor_laporan' => 'PNBP/011/2023',
                'jenis_pemindahtanganan' => 'Penjualan',
                'nama_aset' => 'Gudang Penyimpanan - Cikarang',
                'deskripsi_aset' => 'Gudang industri luas 3000m² di kawasan industri Cikarang, tahun bangun 2018.',
                'nilai_perolehan' => 4500000000,
                'nilai_buku' => 3800000000,
                'nilai_pnbp' => 4200000000,
                'tanggal_pemindahtanganan' => Carbon::create(2023, 11, 10),
                'penerima' => 'PT. Logistik Indonesia',
                'dasar_hukum' => 'Peraturan Menteri Keuangan No. 190/PMK.06/2020 tentang Pemindahtanganan BMN',
                'status_pnbp' => 'Sudah Setor',
                'tanggal_setor_pnbp' => Carbon::create(2023, 11, 25),
                'nomor_bukti_setor' => 'STP-011/PNBP/2023',
                'file_laporan' => 'laporan-penjualan-gudang-2023.pdf',
                'keterangan' => 'Penjualan aset gudang non-aktif untuk efisiensi aset.',
                'created_at' => Carbon::create(2023, 11, 10),
                'updated_at' => Carbon::create(2023, 11, 25),
            ],
            [
                'nomor_laporan' => 'PNBP/012/2023',
                'jenis_pemindahtanganan' => 'Hibah',
                'nama_aset' => 'Buku Perpustakaan (5000 judul)',
                'deskripsi_aset' => 'Koleksi buku perpustakaan berbagai bidang ilmu, kondisi baik, layak baca.',
                'nilai_perolehan' => 350000000,
                'nilai_buku' => 120000000,
                'nilai_pnbp' => 0,
                'tanggal_pemindahtanganan' => Carbon::create(2023, 12, 5),
                'penerima' => 'Perpustakaan Nasional',
                'dasar_hukum' => 'Peraturan Pemerintah No. 6 Tahun 2006 tentang Pengelolaan Barang Milik Negara',
                'status_pnbp' => 'Dibebaskan',
                'tanggal_setor_pnbp' => null,
                'nomor_bukti_setor' => null,
                'file_laporan' => 'laporan-hibah-buku-2023.pdf',
                'keterangan' => 'Hibah untuk menambah koleksi perpustakaan nasional.',
                'created_at' => Carbon::create(2023, 12, 5),
                'updated_at' => Carbon::create(2023, 12, 5),
            ],
            [
                'nomor_laporan' => 'PNBP/013/2022',
                'jenis_pemindahtanganan' => 'Tukar Menukar',
                'nama_aset' => 'Tanah Kavling - Bogor',
                'deskripsi_aset' => 'Tanah seluas 10.000m² di kawasan Bogor, sertifikat SHM, rencana untuk pembangunan asrama.',
                'nilai_perolehan' => 8500000000,
                'nilai_buku' => 7200000000,
                'nilai_pnbp' => 8000000000,
                'tanggal_pemindahtanganan' => Carbon::create(2022, 8, 20),
                'penerima' => 'PT. Properti Nusantara',
                'dasar_hukum' => 'Peraturan Menteri Keuangan No. 154/PMK.06/2018 tentang Tukar Menukar BMN',
                'status_pnbp' => 'Sudah Setor',
                'tanggal_setor_pnbp' => Carbon::create(2022, 9, 5),
                'nomor_bukti_setor' => 'STP-013/PNBP/2022',
                'file_laporan' => 'laporan-tukar-menukar-tanah-2022.pdf',
                'keterangan' => 'Tukar menukar untuk mendapatkan lokasi yang lebih strategis.',
                'created_at' => Carbon::create(2022, 8, 20),
                'updated_at' => Carbon::create(2022, 9, 5),
            ],
            [
                'nomor_laporan' => 'PNBP/014/2022',
                'jenis_pemindahtanganan' => 'Penyertaan Modal',
                'nama_aset' => 'Mesin Produksi Pabrik',
                'deskripsi_aset' => 'Mesin-mesin produksi industri tekstil dari Jepang, kondisi operasional baik.',
                'nilai_perolehan' => 12500000000,
                'nilai_buku' => 8500000000,
                'nilai_pnbp' => 9500000000,
                'tanggal_pemindahtanganan' => Carbon::create(2022, 10, 15),
                'penerima' => 'PT. Textile Mandiri',
                'dasar_hukum' => 'Undang-Undang No. 1 Tahun 2004 tentang Perbendaharaan Negara',
                'status_pnbp' => 'Belum Setor',
                'tanggal_setor_pnbp' => null,
                'nomor_bukti_setor' => null,
                'file_laporan' => 'laporan-penyertaan-modal-mesin-2022.pdf',
                'keterangan' => 'Penyertaan modal untuk revitalisasi industri tekstil nasional.',
                'created_at' => Carbon::create(2022, 10, 15),
                'updated_at' => Carbon::create(2022, 10, 15),
            ],
            [
                'nomor_laporan' => 'PNBP/015/2021',
                'jenis_pemindahtanganan' => 'Penjualan',
                'nama_aset' => 'Kapal Patroli',
                'deskripsi_aset' => 'Kapal patroli cepat 35 meter, tahun pembuatan 2015, kondisi baik, siap operasi.',
                'nilai_perolehan' => 45000000000,
                'nilai_buku' => 32000000000,
                'nilai_pnbp' => 38000000000,
                'tanggal_pemindahtanganan' => Carbon::create(2021, 6, 30),
                'penerima' => 'PT. Pelayaran Nusantara',
                'dasar_hukum' => 'Peraturan Menteri Perhubungan No. 45 Tahun 2019 tentang Penjualan Kapal Negara',
                'status_pnbp' => 'Sudah Setor',
                'tanggal_setor_pnbp' => Carbon::create(2021, 7, 15),
                'nomor_bukti_setor' => 'STP-015/PNBP/2021',
                'file_laporan' => 'laporan-penjualan-kapal-2021.pdf',
                'keterangan' => 'Penjualan aset kapal non-aktif untuk efisiensi armada.',
                'created_at' => Carbon::create(2021, 6, 30),
                'updated_at' => Carbon::create(2021, 7, 15),
            ],
        ];

        // Insert data ke database
        foreach ($data as $item) {
            PemindahtangananBMN::create($item);
        }

        $this->command->info('Seeder PemindahtangananBMN berhasil dijalankan!');
        $this->command->info('Total data: ' . count($data));

        // Tampilkan statistik
        $total = PemindahtangananBMN::count();
        $totalPnbp = PemindahtangananBMN::sum('nilai_pnbp');
        $sudahSetor = PemindahtangananBMN::where('status_pnbp', 'Sudah Setor')->sum('nilai_pnbp');
        $belumSetor = PemindahtangananBMN::where('status_pnbp', 'Belum Setor')->sum('nilai_pnbp');

        $this->command->info("\nStatistik:");
        $this->command->info("Total Laporan: {$total}");
        $this->command->info("Total PNBP: Rp " . number_format($totalPnbp, 0, ',', '.'));
        $this->command->info("Sudah Setor: Rp " . number_format($sudahSetor, 0, ',', '.'));
        $this->command->info("Belum Setor: Rp " . number_format($belumSetor, 0, ',', '.'));
    }
}
