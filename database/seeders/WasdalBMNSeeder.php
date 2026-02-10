<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WasdalBMN;
use Illuminate\Support\Facades\DB;

class WasdalBMNSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data dummy untuk WasdalBMN
        $data = [];

        $jenisOptions = ['Pelaporan BMN', 'Sensus BMN'];
        $periodeOptions = ['Triwulan I', 'Triwulan II', 'Triwulan III', 'Triwulan IV', 'Semester I', 'Semester II', 'Tahunan', 'Insidental'];
        $statusOptions = ['Draft', 'Submitted', 'Reviewed', 'Approved', 'Rejected'];
        $petugasOptions = ['Budi Santoso', 'Siti Nurhaliza', 'Ahmad Wijaya', 'Rina Andriani', 'Joko Widodo', 'Bambang Sutrisno'];
        $pejabatOptions = ['Dr. H. Ahmad Wijaya, M.Si', 'Ir. Muhammad Ali, MT', 'Prof. Dr. Hendra Gunawan', 'Drs. Bambang Sutrisno, MM'];

        // Generate 20 data dummy
        for ($i = 1; $i <= 20; $i++) {
            $jenis = $jenisOptions[array_rand($jenisOptions)];
            $periode = $periodeOptions[array_rand($periodeOptions)];
            $tahun = rand(2020, 2024);
            $status = $statusOptions[array_rand($statusOptions)];

            // Generate nomor laporan
            $prefix = ($jenis == 'Pelaporan BMN') ? 'PLP' : 'SNS';
            $nomorLaporan = "WASDAL/{$prefix}/" . str_pad($i, 3, '0', STR_PAD_LEFT) . "/{$tahun}";

            // Tanggal
            $tanggalLaporan = date('Y-m-d', strtotime("-" . rand(0, 365) . " days"));
            $tanggalMulai = date('Y-m-d', strtotime($tanggalLaporan . " -" . rand(30, 90) . " days"));
            $tanggalSelesai = date('Y-m-d', strtotime($tanggalMulai . " +" . rand(15, 60) . " days"));

            // Data aset
            $jumlahAsetTercatat = rand(100, 2000);
            $jumlahAsetTerverifikasi = rand(50, $jumlahAsetTercatat);
            $totalNilaiBuku = rand(1000000000, 100000000000);

            // Kondisi aset
            $asetKondisiBaik = rand(0, $jumlahAsetTerverifikasi);
            $sisa = $jumlahAsetTerverifikasi - $asetKondisiBaik;
            $asetKondisiRusakRingan = rand(0, $sisa);
            $asetKondisiRusakBerat = $sisa - $asetKondisiRusakRingan;

            $data[] = [
                'jenis_wasdal' => $jenis,
                'nomor_laporan' => $nomorLaporan,
                'judul' => "Laporan {$jenis} {$periode} {$tahun}",
                'periode' => $periode,
                'tahun' => $tahun,
                'tanggal_laporan' => $tanggalLaporan,
                'tanggal_mulai_pelaksanaan' => $tanggalMulai,
                'tanggal_selesai_pelaksanaan' => $tanggalSelesai,
                'jumlah_aset_tercatat' => $jumlahAsetTercatat,
                'jumlah_aset_terverifikasi' => $jumlahAsetTerverifikasi,
                'total_nilai_buku' => $totalNilaiBuku,
                'aset_kondisi_baik' => $asetKondisiBaik,
                'aset_kondisi_rusak_ringan' => $asetKondisiRusakRingan,
                'aset_kondisi_rusak_berat' => $asetKondisiRusakBerat,
                'temuan' => rand(0, 1) ? "Temuan penting dalam laporan ini:\n1. Aset belum terverifikasi\n2. Perlu perbaikan data" : null,
                'rekomendasi' => rand(0, 1) ? "Rekomendasi perbaikan:\n1. Verifikasi ulang aset\n2. Update data sistem" : null,
                'status' => $status,
                'petugas_pelaksana' => $petugasOptions[array_rand($petugasOptions)],
                'pejabat_penerima' => rand(0, 1) ? $pejabatOptions[array_rand($pejabatOptions)] : null,
                'file_laporan' => null,
                'file_lampiran' => null,
                'keterangan' => rand(0, 1) ? "Laporan {$status} pada " . date('d F Y', strtotime($tanggalLaporan)) : null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Hapus data lama
        DB::table('wasdal_bmns')->truncate();

        // Insert data baru
        DB::table('wasdal_bmns')->insert($data);

        $this->command->info('Data WasdalBMN berhasil ditambahkan: ' . count($data) . ' records');
    }
}
