<?php

namespace Database\Seeders;

use App\Models\PemanfaatanBMN;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PemanfaatanBMNSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data lama jika ada
        PemanfaatanBMN::query()->delete();

        // Pastikan folder dokumen ada
        if (!Storage::disk('public')->exists('dokumen')) {
            Storage::disk('public')->makeDirectory('dokumen');
        }

        // Data dummy untuk pemanfaatan BMN
        $pemanfaatans = [
            // ==================== SK SEWA (12 Data) ====================
            [
                'jenis_pemanfaatan' => 'SK Sewa',
                'nomor_sk' => 'SK/01/BMN/2024/001',
                'nama_pihak_ketiga' => 'PT. Surya Makmur Sejahtera',
                'alamat_objek' => 'Jl. Gatot Subroto No. 12, Kuningan, Jakarta Selatan',
                'latitude' => -6.2088,
                'longitude' => 106.8456,
                'deskripsi_objek' => 'Gedung perkantoran 10 lantai dengan fasilitas lengkap: lift, AC sentral, parkir bawah tanah, dan sistem keamanan 24 jam.',
                'luas_tanah' => 2500.75,
                'luas_bangunan' => 12500.50,
                'nilai_sewa_tahunan' => 8500000000,
                'tanggal_mulai' => '2023-01-01',
                'tanggal_berakhir' => '2025-12-31',
                'masa_pemanfaatan_bulan' => 36,
                'status' => 'Aktif',
                'file_sk' => 'dokumen/sk-sewa-001.pdf',
                'keterangan' => 'Kontrak sewa untuk kantor pusat perusahaan dengan opsi perpanjangan 2 tahun.',
            ],
            [
                'jenis_pemanfaatan' => 'SK Sewa',
                'nomor_sk' => 'SK/02/BMN/2024/002',
                'nama_pihak_ketiga' => 'CV. Mandiri Jaya Property',
                'alamat_objek' => 'Jl. Sudirman Kav. 52-53, SCBD, Jakarta Selatan',
                'latitude' => -6.2249,
                'longitude' => 106.8097,
                'deskripsi_objek' => 'Ruko komersial 4 lantai di area bisnis premium, cocok untuk showroom dan retail high-end.',
                'luas_tanah' => 850.25,
                'luas_bangunan' => 3400.75,
                'nilai_sewa_tahunan' => 3250000000,
                'tanggal_mulai' => '2022-06-15',
                'tanggal_berakhir' => '2024-06-14',
                'masa_pemanfaatan_bulan' => 24,
                'status' => 'Aktif',
                'file_sk' => 'dokumen/sk-sewa-002.pdf',
                'keterangan' => 'Sewa untuk usaha retail fashion dengan pajak terpisah.',
            ],
            [
                'jenis_pemanfaatan' => 'SK Sewa',
                'nomor_sk' => 'SK/03/BMN/2023/001',
                'nama_pihak_ketiga' => 'PT. Graha Indah Sejahtera',
                'alamat_objek' => 'Jl. TB Simatupang Kav. 10, Cilandak, Jakarta Selatan',
                'latitude' => -6.3016,
                'longitude' => 106.8242,
                'deskripsi_objek' => 'Gudang logistik modern dengan kapasitas 8000 m³, dilengkapi sistem pendingin dan keamanan 24 jam.',
                'luas_tanah' => 5000.00,
                'luas_bangunan' => 3500.50,
                'nilai_sewa_tahunan' => 1250000000,
                'tanggal_mulai' => '2023-03-01',
                'tanggal_berakhir' => '2024-09-30',
                'masa_pemanfaatan_bulan' => 19,
                'status' => 'Aktif',
                'file_sk' => 'dokumen/sk-sewa-003.pdf',
                'keterangan' => 'Sewa gudang untuk penyimpanan barang elektronik dengan sistem FIFO.',
            ],
            [
                'jenis_pemanfaatan' => 'SK Sewa',
                'nomor_sk' => 'SK/04/BMN/2022/001',
                'nama_pihak_ketiga' => 'Berkah Abadi Group',
                'alamat_objek' => 'Jl. Prof. Dr. Satrio Kav. 18, Kuningan, Jakarta Selatan',
                'latitude' => -6.2279,
                'longitude' => 106.8285,
                'deskripsi_objek' => 'Lapangan parkir komersial multi-level dengan kapasitas 300 kendaraan, sistem elektronik, dan CCTV.',
                'luas_tanah' => 4500.75,
                'luas_bangunan' => null,
                'nilai_sewa_tahunan' => 650000000,
                'tanggal_mulai' => '2021-11-01',
                'tanggal_berakhir' => '2023-10-31',
                'masa_pemanfaatan_bulan' => 24,
                'status' => 'Berakhir',
                'file_sk' => 'dokumen/sk-sewa-004.pdf',
                'keterangan' => 'Kontrak parkir untuk karyawan dan pengunjung gedung perkantoran sekitar.',
            ],
            [
                'jenis_pemanfaatan' => 'SK Sewa',
                'nomor_sk' => 'SK/05/BMN/2024/003',
                'nama_pihak_ketiga' => 'PT. Mega Bangunan Indonesia',
                'alamat_objek' => 'Jl. M.H. Thamrin No. 1, Menteng, Jakarta Pusat',
                'latitude' => -6.1865,
                'longitude' => 106.8341,
                'deskripsi_objek' => 'Kios makanan dan minuman di food court dengan kapasitas 60 kursi, dapur lengkap, dan AC.',
                'luas_tanah' => 120.50,
                'luas_bangunan' => 120.50,
                'nilai_sewa_tahunan' => 280000000,
                'tanggal_mulai' => '2024-01-01',
                'tanggal_berakhir' => '2024-12-31',
                'masa_pemanfaatan_bulan' => 12,
                'status' => 'Aktif',
                'file_sk' => 'dokumen/sk-sewa-005.pdf',
                'keterangan' => 'Sewa kios untuk usaha kuliner dengan sistem bagi hasil 80:20.',
            ],
            [
                'jenis_pemanfaatan' => 'SK Sewa',
                'nomor_sk' => 'SK/06/BMN/2024/004',
                'nama_pihak_ketiga' => 'PT. Trans Retail Indonesia',
                'alamat_objek' => 'Jl. M.T. Haryono Kav. 16, Cawang, Jakarta Timur',
                'latitude' => -6.2425,
                'longitude' => 106.8616,
                'deskripsi_objek' => 'Supermarket modern dengan luas 6000 m², dilengkapi cold storage, sistem kasir modern, dan parkir luas.',
                'luas_tanah' => 6500.50,
                'luas_bangunan' => 6000.25,
                'nilai_sewa_tahunan' => 4200000000,
                'tanggal_mulai' => '2023-09-01',
                'tanggal_berakhir' => '2026-08-31',
                'masa_pemanfaatan_bulan' => 36,
                'status' => 'Aktif',
                'file_sk' => 'dokumen/sk-sewa-006.pdf',
                'keterangan' => 'Sewa untuk usaha ritel modern dengan opsi perpanjangan 2x24 bulan.',
            ],
            [
                'jenis_pemanfaatan' => 'SK Sewa',
                'nomor_sk' => 'SK/07/BMN/2023/002',
                'nama_pihak_ketiga' => 'PT. Mitra Adiperkasa',
                'alamat_objek' => 'Jl. Panglima Polim No. 1, Kebayoran Baru, Jakarta Selatan',
                'latitude' => -6.2433,
                'longitude' => 106.8004,
                'deskripsi_objek' => 'Showroom otomotif 3 lantai dengan bengkel servis dan ruang display 15 mobil.',
                'luas_tanah' => 950.75,
                'luas_bangunan' => 2850.25,
                'nilai_sewa_tahunan' => 1850000000,
                'tanggal_mulai' => '2022-04-01',
                'tanggal_berakhir' => '2024-03-31',
                'masa_pemanfaatan_bulan' => 24,
                'status' => 'Diperpanjang',
                'file_sk' => 'dokumen/sk-sewa-007.pdf',
                'keterangan' => 'Sewa untuk dealer resmi kendaraan bermotor merek ternama.',
            ],
            [
                'jenis_pemanfaatan' => 'SK Sewa',
                'nomor_sk' => 'SK/08/BMN/2024/005',
                'nama_pihak_ketiga' => 'PT. Plaza Indonesia Realty',
                'alamat_objek' => 'Jl. M.H. Thamrin No. 28-30, Menteng, Jakarta Pusat',
                'latitude' => -6.1939,
                'longitude' => 106.8235,
                'deskripsi_objek' => 'Mall premium dengan 8 lantai, 250 tenant, cinema 8 studio, food court, dan atrium luas.',
                'luas_tanah' => 22500.75,
                'luas_bangunan' => 95000.50,
                'nilai_sewa_tahunan' => 18500000000,
                'tanggal_mulai' => '2024-01-01',
                'tanggal_berakhir' => '2033-12-31',
                'masa_pemanfaatan_bulan' => 120,
                'status' => 'Aktif',
                'file_sk' => 'dokumen/sk-sewa-008.pdf',
                'keterangan' => 'Sewa jangka panjang untuk pusat perbelanjaan premium dengan sistem revenue sharing.',
            ],
            [
                'jenis_pemanfaatan' => 'SK Sewa',
                'nomor_sk' => 'SK/09/BMN/2022/002',
                'nama_pihak_ketiga' => 'PT. Astra International',
                'alamat_objek' => 'Jl. Gaya Motor Raya No. 8, Sunter, Jakarta Utara',
                'latitude' => -6.1457,
                'longitude' => 106.8912,
                'deskripsi_objek' => 'Pabrik manufaktur dengan 6 lini produksi, gudang bahan baku, dan kantor administrasi.',
                'luas_tanah' => 32500.50,
                'luas_bangunan' => 22500.25,
                'nilai_sewa_tahunan' => 12500000000,
                'tanggal_mulai' => '2020-01-01',
                'tanggal_berakhir' => '2024-12-31',
                'masa_pemanfaatan_bulan' => 60,
                'status' => 'Aktif',
                'file_sk' => 'dokumen/sk-sewa-009.pdf',
                'keterangan' => 'Sewa untuk fasilitas produksi otomotif dengan sistem royalty 5% dari penjualan.',
            ],
            [
                'jenis_pemanfaatan' => 'SK Sewa',
                'nomor_sk' => 'SK/10/BMN/2023/003',
                'nama_pihak_ketiga' => 'PT. Matahari Department Store',
                'alamat_objek' => 'Jl. Letjen S. Parman Kav. 21, Slipi, Jakarta Barat',
                'latitude' => -6.1951,
                'longitude' => 106.7975,
                'deskripsi_objek' => 'Toko serba ada dengan 6 lantai retail, kasir terpusat, ruang stok, dan sistem inventory modern.',
                'luas_tanah' => 4200.50,
                'luas_bangunan' => 21000.75,
                'nilai_sewa_tahunan' => 6500000000,
                'tanggal_mulai' => '2023-06-01',
                'tanggal_berakhir' => '2026-05-31',
                'masa_pemanfaatan_bulan' => 36,
                'status' => 'Aktif',
                'file_sk' => 'dokumen/sk-sewa-010.pdf',
                'keterangan' => 'Sewa untuk department store dengan sistem revenue sharing 15%.',
            ],
            [
                'jenis_pemanfaatan' => 'SK Sewa',
                'nomor_sk' => 'SK/11/BMN/2022/003',
                'nama_pihak_ketiga' => 'PT. Global Hotel Management',
                'alamat_objek' => 'Jl. Jend. Sudirman Kav. 10-11, Karet, Jakarta Selatan',
                'latitude' => -6.2088,
                'longitude' => 106.8225,
                'deskripsi_objek' => 'Hotel bintang 4 dengan 300 kamar, ballroom kapasitas 1000 orang, dan fasilitas konferensi lengkap.',
                'luas_tanah' => 12500.75,
                'luas_bangunan' => 52500.25,
                'nilai_sewa_tahunan' => 22500000000,
                'tanggal_mulai' => '2019-01-01',
                'tanggal_berakhir' => '2023-12-31',
                'masa_pemanfaatan_bulan' => 60,
                'status' => 'Berakhir',
                'file_sk' => 'dokumen/sk-sewa-011.pdf',
                'keterangan' => 'Kontrak sewa hotel dengan sistem management fee 8% dari pendapatan kotor.',
            ],
            [
                'jenis_pemanfaatan' => 'SK Sewa',
                'nomor_sk' => 'SK/12/BMN/2024/006',
                'nama_pihak_ketiga' => 'PT. Pertamina Retail',
                'alamat_objek' => 'Jl. D.I. Panjaitan Kav. 8, Cawang, Jakarta Timur',
                'latitude' => -6.2457,
                'longitude' => 106.8679,
                'deskripsi_objek' => 'SPBU modern dengan 12 pompa, minimarket 24 jam, car wash, dan toilet premium.',
                'luas_tanah' => 1850.50,
                'luas_bangunan' => 450.25,
                'nilai_sewa_tahunan' => 850000000,
                'tanggal_mulai' => '2024-02-15',
                'tanggal_berakhir' => '2027-02-14',
                'masa_pemanfaatan_bulan' => 36,
                'status' => 'Aktif',
                'file_sk' => 'dokumen/sk-sewa-012.pdf',
                'keterangan' => 'Sewa untuk stasiun pengisian bahan bakar umum dengan bagi hasil 70:30.',
            ],

            // ==================== IZIN PENGHUNIAN (8 Data) ====================
            [
                'jenis_pemanfaatan' => 'Izin Penghunian',
                'nomor_sk' => 'IZIN/01/BMN/2024/001',
                'nama_pihak_ketiga' => 'Yayasan Pendidikan Nasional',
                'alamat_objek' => 'Jl. Jend. Sudirman Kav. 60, Setiabudi, Jakarta Selatan',
                'latitude' => -6.2306,
                'longitude' => 106.8177,
                'deskripsi_objek' => 'Gedung sekolah 5 lantai dengan 30 ruang kelas, laboratorium IPA dan komputer, perpustakaan, dan lapangan olahraga.',
                'luas_tanah' => 5200.50,
                'luas_bangunan' => 4200.25,
                'nilai_sewa_tahunan' => null,
                'tanggal_mulai' => '2023-07-01',
                'tanggal_berakhir' => '2028-06-30',
                'masa_pemanfaatan_bulan' => 60,
                'status' => 'Aktif',
                'file_sk' => 'dokumen/izin-001.pdf',
                'keterangan' => 'Izin penggunaan untuk kegiatan pendidikan non-profit selama 5 tahun.',
            ],
            [
                'jenis_pemanfaatan' => 'Izin Penghunian',
                'nomor_sk' => 'IZIN/02/BMN/2024/002',
                'nama_pihak_ketiga' => 'RS Umum Dharma Husada',
                'alamat_objek' => 'Jl. Pangeran Antasari No. 134, Cilandak, Jakarta Selatan',
                'latitude' => -6.2732,
                'longitude' => 106.8033,
                'deskripsi_objek' => 'Gedung rumah sakit dengan 200 tempat tidur, IGD 24 jam, 5 ruang operasi, dan laboratorium medis.',
                'luas_tanah' => 12500.75,
                'luas_bangunan' => 18500.50,
                'nilai_sewa_tahunan' => null,
                'tanggal_mulai' => '2020-03-15',
                'tanggal_berakhir' => '2025-03-14',
                'masa_pemanfaatan_bulan' => 60,
                'status' => 'Diperpanjang',
                'file_sk' => 'dokumen/izin-002.pdf',
                'keterangan' => 'Izin penghunian untuk fasilitas kesehatan masyarakat dengan prioritas BPJS.',
            ],
            [
                'jenis_pemanfaatan' => 'Izin Penghunian',
                'nomor_sk' => 'IZIN/03/BMN/2023/001',
                'nama_pihak_ketiga' => 'PT. Bank Rakyat Indonesia',
                'alamat_objek' => 'Jl. Veteran No. 8, Gambir, Jakarta Pusat',
                'latitude' => -6.1720,
                'longitude' => 106.8370,
                'deskripsi_objek' => 'Gedung kantor cabang bank dengan 4 lantai, ruang teller 10 counter, ruang safe deposit, dan ruang meeting.',
                'luas_tanah' => 1850.25,
                'luas_bangunan' => 5500.75,
                'nilai_sewa_tahunan' => null,
                'tanggal_mulai' => '2019-01-01',
                'tanggal_berakhir' => '2024-01-01',
                'masa_pemanfaatan_bulan' => 60,
                'status' => 'Aktif',
                'file_sk' => 'dokumen/izin-003.pdf',
                'keterangan' => 'Izin penggunaan untuk kantor pelayanan publik perbankan dengan akses difabel.',
            ],
            [
                'jenis_pemanfaatan' => 'Izin Penghunian',
                'nomor_sk' => 'IZIN/04/BMN/2022/001',
                'nama_pihak_ketiga' => 'PT. Telekomunikasi Indonesia',
                'alamat_objek' => 'Jl. Daan Mogot KM. 11, Cengkareng, Jakarta Barat',
                'latitude' => -6.1476,
                'longitude' => 106.7189,
                'deskripsi_objek' => 'Menara telekomunikasi dengan tinggi 85 meter, dilengkapi perangkat BTS 4G/5G dan generator listrik.',
                'luas_tanah' => 350.50,
                'luas_bangunan' => 250.25,
                'nilai_sewa_tahunan' => null,
                'tanggal_mulai' => '2018-05-10',
                'tanggal_berakhir' => '2023-05-09',
                'masa_pemanfaatan_bulan' => 60,
                'status' => 'Berakhir',
                'file_sk' => 'dokumen/izin-004.pdf',
                'keterangan' => 'Izin penggunaan untuk infrastruktur telekomunikasi dengan jaminan ketersediaan sinyal 99.9%.',
            ],
            [
                'jenis_pemanfaatan' => 'Izin Penghunian',
                'nomor_sk' => 'IZIN/05/BMN/2024/003',
                'nama_pihak_ketiga' => 'Koperasi Pegawai Kementerian',
                'alamat_objek' => 'Jl. Lapangan Banteng Timur No. 4, Gambir, Jakarta Pusat',
                'latitude' => -6.1715,
                'longitude' => 106.8378,
                'deskripsi_objek' => 'Gedung serbaguna 3 lantai untuk kegiatan koperasi, pertemuan pegawai, dan pelatihan.',
                'luas_tanah' => 1250.75,
                'luas_bangunan' => 2250.50,
                'nilai_sewa_tahunan' => null,
                'tanggal_mulai' => '2024-02-01',
                'tanggal_berakhir' => '2029-01-31',
                'masa_pemanfaatan_bulan' => 60,
                'status' => 'Aktif',
                'file_sk' => 'dokumen/izin-005.pdf',
                'keterangan' => 'Izin penggunaan untuk kegiatan koperasi pegawai dengan fasilitas ruang rapat.',
            ],
            [
                'jenis_pemanfaatan' => 'Izin Penghunian',
                'nomor_sk' => 'IZIN/06/BMN/2023/002',
                'nama_pihak_ketiga' => 'Universitas Indonesia',
                'alamat_objek' => 'Jl. Salemba Raya No. 4, Senen, Jakarta Pusat',
                'latitude' => -6.1944,
                'longitude' => 106.8496,
                'deskripsi_objek' => 'Kampus dengan 10 gedung kuliah, laboratorium penelitian, perpustakaan 3 lantai, dan auditorium.',
                'luas_tanah' => 22500.50,
                'luas_bangunan' => 18500.75,
                'nilai_sewa_tahunan' => null,
                'tanggal_mulai' => '2020-08-01',
                'tanggal_berakhir' => '2030-07-31',
                'masa_pemanfaatan_bulan' => 120,
                'status' => 'Aktif',
                'file_sk' => 'dokumen/izin-006.pdf',
                'keterangan' => 'Izin penggunaan untuk kampus cabang universitas negeri dengan akreditasi A.',
            ],
            [
                'jenis_pemanfaatan' => 'Izin Penghunian',
                'nomor_sk' => 'IZIN/07/BMN/2024/004',
                'nama_pihak_ketiga' => 'Puskesmas Kecamatan Tanah Abang',
                'alamat_objek' => 'Jl. KH. Mas Mansyur No. 30, Tanah Abang, Jakarta Pusat',
                'latitude' => -6.2025,
                'longitude' => 106.8125,
                'deskripsi_objek' => 'Pusat kesehatan masyarakat dengan 5 poli, ruang bersalin, apotek, dan ruang imunisasi.',
                'luas_tanah' => 1850.75,
                'luas_bangunan' => 1250.50,
                'nilai_sewa_tahunan' => null,
                'tanggal_mulai' => '2024-03-15',
                'tanggal_berakhir' => '2029-03-14',
                'masa_pemanfaatan_bulan' => 60,
                'status' => 'Aktif',
                'file_sk' => 'dokumen/izin-007.pdf',
                'keterangan' => 'Izin penggunaan untuk fasilitas kesehatan pemerintah daerah dengan layanan 24 jam.',
            ],
            [
                'jenis_pemanfaatan' => 'Izin Penghunian',
                'nomor_sk' => 'IZIN/08/BMN/2024/005',
                'nama_pihak_ketiga' => 'PT. Pos Indonesia',
                'alamat_objek' => 'Jl. Gedung Kesenian No. 1, Pasar Baru, Jakarta Pusat',
                'latitude' => -6.1679,
                'longitude' => 106.8346,
                'deskripsi_objek' => 'Gedung kantor pos dengan 15 counter layanan, ruang sorting otomatis, gudang paket, dan sistem tracking.',
                'luas_tanah' => 2250.25,
                'luas_bangunan' => 3250.50,
                'nilai_sewa_tahunan' => null,
                'tanggal_mulai' => '2024-01-01',
                'tanggal_berakhir' => '2028-12-31',
                'masa_pemanfaatan_bulan' => 60,
                'status' => 'Aktif',
                'file_sk' => 'dokumen/izin-008.pdf',
                'keterangan' => 'Izin penggunaan untuk kantor layanan pos nasional dengan sistem digital.',
            ],
        ];

        // Insert data dengan created_at dan updated_at yang bervariasi
        foreach ($pemanfaatans as $index => $data) {
            // Buat variasi tanggal created_at (6 bulan terakhir)
            $monthsAgo = rand(0, 5);
            $createdAt = Carbon::now()->subMonths($monthsAgo)->subDays(rand(0, 30));
            $updatedAt = $createdAt->copy()->addDays(rand(0, 10));

            PemanfaatanBMN::create(array_merge($data, [
                'created_at' => $createdAt,
                'updated_at' => $updatedAt,
            ]));
        }

        // Tampilkan informasi statistik
        $total = count($pemanfaatans);
        $skSewa = collect($pemanfaatans)->where('jenis_pemanfaatan', 'SK Sewa')->count();
        $izinPenghunian = collect($pemanfaatans)->where('jenis_pemanfaatan', 'Izin Penghunian')->count();
        $aktif = collect($pemanfaatans)->where('status', 'Aktif')->count();
        $berakhir = collect($pemanfaatans)->where('status', 'Berakhir')->count();
        $diperpanjang = collect($pemanfaatans)->where('status', 'Diperpanjang')->count();

        $this->command->info('==========================================');
        $this->command->info('✅ SEEDER Pemanfaatan BMN BERHASIL DITAMBAHKAN!');
        $this->command->info('==========================================');
        $this->command->info('📊 STATISTIK DATA:');
        $this->command->info('   Total Data: ' . $total);
        $this->command->info('   SK Sewa: ' . $skSewa . ' data');
        $this->command->info('   Izin Penghunian: ' . $izinPenghunian . ' data');
        $this->command->info('   Status Aktif: ' . $aktif . ' data');
        $this->command->info('   Status Berakhir: ' . $berakhir . ' data');
        $this->command->info('   Status Diperpanjang: ' . $diperpanjang . ' data');

        // Hitung total nilai sewa aktif
        $totalNilaiSewa = collect($pemanfaatans)
            ->where('status', 'Aktif')
            ->where('jenis_pemanfaatan', 'SK Sewa')
            ->sum('nilai_sewa_tahunan');

        $this->command->info('   Total Nilai Sewa Aktif: Rp ' . number_format($totalNilaiSewa, 0, ',', '.'));
        $this->command->info('   Nilai Sewa Rata-rata: Rp ' . number_format($totalNilaiSewa / max(1, $skSewa), 0, ',', '.') . '/tahun');

        // Data untuk chart testing
        $this->command->info('📈 DATA UNTUK CHART TESTING:');
        $this->command->info('   - Distribusi jenis: ' . $skSewa . ' SK Sewa vs ' . $izinPenghunian . ' Izin Penghunian');
        $this->command->info('   - Distribusi status: ' . $aktif . ' Aktif, ' . $berakhir . ' Berakhir, ' . $diperpanjang . ' Diperpanjang');

        // Data untuk testing peta
        $this->command->info('🗺️  DATA UNTUK PETA TESTING:');
        $this->command->info('   - Semua data memiliki koordinat GPS');
        $this->command->info('   - Variasi lokasi: Jakarta Selatan, Pusat, Timur, Barat, Utara');
        $this->command->info('==========================================');
    }
}
