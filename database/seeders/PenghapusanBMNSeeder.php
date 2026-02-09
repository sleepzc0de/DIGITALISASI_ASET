<?php

namespace Database\Seeders;

use App\Models\PenghapusanBMN;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PenghapusanBMNSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $alasanPenghapusan = [
            'Rusak Berat',
            'Hilang',
            'Kadaluarsa',
            'Tidak Ekonomis',
            'Force Majeure',
            'Lainnya'
        ];

        $status = ['Draft', 'Proses', 'Selesai', 'Dibatalkan'];

        $metodePenghapusan = ['Pemusnahan', 'Lelang', 'Penjualan', 'Pembuangan', 'Daur Ulang'];

        $pejabatPenandatangan = [
            'Dr. Ahmad Mansur, M.Si.',
            'Prof. Dr. Sri Mulyani, M.Ec.',
            'Drs. Bambang Brodjonegoro, M.Sc.',
            'Ir. Rizal Djalil, M.Eng.',
            'Drs. Suahasil Nazara, M.Sc., Ph.D.',
            'Prof. Dr. Febrio Kacaribu, M.Sc.'
        ];

        $asetData = [
            [
                'nama' => 'Komputer Desktop Dell Optiplex 7070',
                'kode' => 'BMN-KOMP-2021-001',
                'deskripsi' => 'Unit komputer desktop dengan spesifikasi Intel Core i7, RAM 16GB, SSD 512GB, digunakan untuk administrasi keuangan.'
            ],
            [
                'nama' => 'Mobil Dinas Toyota Fortuner',
                'kode' => 'BMN-KDR-2020-015',
                'deskripsi' => 'Kendaraan dinas dengan plat merah, tahun produksi 2020, kondisi mesin sudah tidak layak operasi.'
            ],
            [
                'nama' => 'AC Split Panasonic 2PK',
                'kode' => 'BMN-AC-2018-023',
                'deskripsi' => 'Air conditioner split type 2PK, sudah tidak dingin dan biaya perbaikan melebihi nilai ekonomis.'
            ],
            [
                'nama' => 'Printer Canon MP287',
                'kode' => 'BMN-PRT-2019-045',
                'deskripsi' => 'Printer multifungsi dengan kondisi kepala print rusak berat dan spare part tidak tersedia.'
            ],
            [
                'nama' => 'Server HP ProLiant DL380',
                'kode' => 'BMN-SVR-2017-012',
                'deskripsi' => 'Server rack mount dengan spesifikasi dual Xeon, 64GB RAM, sudah melewati masa pakai ekonomis.'
            ],
            [
                'nama' => 'Meja Rapat Kayu Jati',
                'kode' => 'BMN-MJR-2015-078',
                'deskripsi' => 'Meja rapat ukuran 3x1 meter, bahan kayu jati, kondisi lapuk dan rayap.'
            ],
            [
                'nama' => 'Laptop Lenovo ThinkPad X1',
                'kode' => 'BMN-LTP-2020-033',
                'deskripsi' => 'Laptop business series, kondisi LCD pecah dan motherboard short circuit.'
            ],
            [
                'nama' => 'Projector Epson EB-X41',
                'kode' => 'BMN-PRJ-2019-019',
                'deskripsi' => 'Projector dengan lampu projector habis dan harga pengganti tidak ekonomis.'
            ],
            [
                'nama' => 'Lemari Arsip Besi 4 Pintu',
                'kode' => 'BMN-LMR-2016-067',
                'deskripsi' => 'Lemari arsip besi dengan kondisi karat berat dan pintu tidak dapat ditutup.'
            ],
            [
                'nama' => 'Mesin Fotocopy Ricoh MP C307',
                'kode' => 'BMN-FTC-2018-028',
                'deskripsi' => 'Mesin fotocopy warna dengan total cetak 1.2 juta lembar, sudah melewati masa pakai.'
            ],
            [
                'nama' => 'Kursi Kantor Ergonomis',
                'kode' => 'BMN-KRS-2019-052',
                'deskripsi' => 'Kursi kantor dengan mekanisme dudukan rusak dan kain jok sobek.'
            ],
            [
                'nama' => 'Scanner Fujitsu fi-7160',
                'kode' => 'BMN-SCN-2020-014',
                'deskripsi' => 'Scanner dokumen high-speed dengan sensor CCD rusak.'
            ],
            [
                'nama' => 'Genset Honda EU30is',
                'kode' => 'BMN-GEN-2017-031',
                'deskripsi' => 'Genset portable 3kVA dengan kondisi mesin tidak bisa start dan spare part langka.'
            ],
            [
                'nama' => 'Camera CCTV Hikvision',
                'kode' => 'BMN-CCTV-2019-025',
                'deskripsi' => 'Camera IP dome 4MP dengan kondisi lensa buram dan kabel putus.'
            ],
            [
                'nama' => 'Whiteboard Magnetik 2x1m',
                'kode' => 'BMN-WBD-2018-041',
                'deskripsi' => 'Papan tulis magnetik dengan permukaan sudah tidak rata dan tidak bisa dibersihkan.'
            ]
        ];

        // Generate SK Number counter
        $year = date('Y');
        $skCounter = 1;

        // Clear existing data
        PenghapusanBMN::truncate();

        for ($i = 0; $i < 50; $i++) {
            $aset = $asetData[array_rand($asetData)];
            $alasan = $alasanPenghapusan[array_rand($alasanPenghapusan)];
            $statusItem = $status[array_rand($status)];
            $metode = ($alasan == 'Rusak Berat' || $alasan == 'Kadaluarsa')
                ? 'Pemusnahan'
                : (($alasan == 'Tidak Ekonomis') ? 'Lelang' : $metodePenghapusan[array_rand($metodePenghapusan)]);

            // Generate SK Number
            $skNumber = sprintf('SK/%03d/B.%02d/KM.%02d/%d',
                $skCounter++,
                rand(1, 12),
                rand(1, 20),
                $year
            );

            // Tanggal acak dalam 2 tahun terakhir
            $tanggalSK = Carbon::now()->subDays(rand(1, 730));
            $tanggalPenghapusan = $tanggalSK->copy()->addDays(rand(7, 90));

            // Nilai perolehan dan nilai buku (dengan penyusutan 10-70%)
            $nilaiPerolehan = rand(5000000, 500000000);
            $penyusutan = rand(10, 70);
            $nilaiBuku = $nilaiPerolehan - ($nilaiPerolehan * ($penyusutan / 100));

            // Jumlah unit
            $jumlahUnit = rand(1, ($alasan == 'Hilang' ? 5 : 50));

            // Generate keterangan berdasarkan alasan
            $keterangan = $this->generateKeterangan($alasan, $aset['nama']);

            PenghapusanBMN::create([
                'nomor_sk' => $skNumber,
                'nama_aset' => $aset['nama'],
                'kode_barang' => $aset['kode'],
                'deskripsi_aset' => $aset['deskripsi'],
                'alasan_penghapusan' => $alasan,
                'jumlah_unit' => $jumlahUnit,
                'nilai_perolehan' => $nilaiPerolehan,
                'nilai_buku' => max(0, $nilaiBuku), // Pastikan tidak negatif
                'tanggal_sk' => $tanggalSK->format('Y-m-d'),
                'tanggal_penghapusan' => $tanggalPenghapusan->format('Y-m-d'),
                'pejabat_penandatangan' => $pejabatPenandatangan[array_rand($pejabatPenandatangan)],
                'metode_penghapusan' => $metode,
                'status' => $statusItem,
                'file_sk' => rand(0, 1) ? 'dokumen/sk/' . $skNumber . '.pdf' : null,
                'file_ba_penghapusan' => $statusItem == 'Selesai' ? 'dokumen/ba/BA-' . $skNumber . '.pdf' : null,
                'keterangan' => $keterangan,
                'created_at' => $tanggalSK,
                'updated_at' => $statusItem == 'Selesai' ? $tanggalPenghapusan : $tanggalSK->addDays(rand(1, 30))
            ]);
        }

        $this->command->info('✅ 50 data Penghapusan BMN berhasil ditambahkan!');
        $this->command->info('📊 Statistik:');
        $this->command->info('   - Total SK: ' . PenghapusanBMN::count());
        $this->command->info('   - Selesai: ' . PenghapusanBMN::where('status', 'Selesai')->count());
        $this->command->info('   - Proses: ' . PenghapusanBMN::where('status', 'Proses')->count());
        $this->command->info('   - Draft: ' . PenghapusanBMN::where('status', 'Draft')->count());
        $this->command->info('   - Dibatalkan: ' . PenghapusanBMN::where('status', 'Dibatalkan')->count());
    }

    private function generateKeterangan(string $alasan, string $namaAset): string
    {
        $keteranganTemplates = [
            'Rusak Berat' => [
                "Aset {$namaAset} telah mengalami kerusakan berat dan tidak dapat diperbaiki lagi.",
                "Kondisi {$namaAset} sudah tidak memungkinkan untuk dipergunakan karena kerusakan komponen utama.",
                "Setelah dilakukan assesment teknis, {$namaAset} dinyatakan rusak berat dan tidak ekonomis untuk diperbaiki.",
                "Kerusakan pada {$namaAset} sudah mencapai tingkat yang tidak dapat diperbaiki sesuai standar teknis."
            ],
            'Hilang' => [
                "Aset {$namaAset} dilaporkan hilang setelah proses inventarisasi rutin.",
                "Berdasarkan berita acara kehilangan nomor BA/HLG/{$this->generateRandomNumber()}/2024, {$namaAset} dinyatakan hilang.",
                "Setelah investigasi selama 30 hari, {$namaAset} tidak ditemukan dan dinyatakan hilang.",
                "Kehilangan {$namaAset} telah dilaporkan ke pihak berwenang dan tidak ditemukan dalam pencarian."
            ],
            'Kadaluarsa' => [
                "{$namaAset} telah melewati masa pakai teknis (expired) sesuai dengan spesifikasi pabrikan.",
                "Masa pakai {$namaAset} sudah habis berdasarkan sertifikat kalibrasi dan dokumentasi teknis.",
                "Aset ini sudah kadaluarsa dan tidak memenuhi standar keamanan operasional.",
                "Berdasarkan rekomendasi tim teknis, {$namaAset} sudah melewati batas usia pakai yang aman."
            ],
            'Tidak Ekonomis' => [
                "Biaya perbaikan {$namaAset} melebihi 50% dari nilai buku sehingga tidak ekonomis untuk diperbaiki.",
                "Analisis ekonomi menunjukkan bahwa maintenance cost {$namaAset} lebih tinggi daripada nilai manfaatnya.",
                "Aset ini sudah tidak ekonomis dioperasikan karena biaya operasional dan perawatan yang tinggi.",
                "Studi kelayakan menunjukan bahwa penggantian {$namaAset} lebih ekonomis daripada perbaikan."
            ],
            'Force Majeure' => [
                "{$namaAset} rusak akibat bencana alam yang terjadi di lokasi penyimpanan.",
                "Kerusakan terjadi karena force majeure (kebakaran) yang melanda gudang penyimpanan.",
                "Aset terkena dampak banjir bandang yang menyebabkan kerusakan permanen.",
                "Bencana alam menyebabkan {$namaAset} rusak total dan tidak dapat diperbaiki."
            ],
            'Lainnya' => [
                "{$namaAset} dihapuskan berdasarkan kebijakan efisiensi aset pemerintah.",
                "Penghapusan dilakukan sebagai bagian dari program modernisasi peralatan kantor.",
                "Aset ini sudah tidak sesuai dengan kebutuhan operasional instansi saat ini.",
                "Penghapusan berdasarkan rekomendasi audit internal untuk optimalisasi aset."
            ]
        ];

        $templates = $keteranganTemplates[$alasan] ?? $keteranganTemplates['Lainnya'];
        return $templates[array_rand($templates)];
    }

    private function generateRandomNumber(): string
    {
        return str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
    }
}
