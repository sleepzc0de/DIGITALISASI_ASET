<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penatausahaan_bmns', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang')->unique();
            $table->string('nup')->nullable(); // Nomor Urut Pendaftaran
            $table->string('nama_barang');
            $table->enum('kategori', [
                'Tanah',
                'Gedung Bangunan',
                'Rumah Negara',
                'Kendaraan Dinas Operasional',
                'Kendaraan Dinas Jabatan',
                'Kendaraan Dinas Fungsional',
                'Peralatan Kantor',
                'Lainnya'
            ]);
            $table->text('spesifikasi')->nullable();
            $table->string('merk_type')->nullable();
            $table->string('nomor_polisi')->nullable(); // Untuk kendaraan
            $table->string('tahun_pembuatan')->nullable();
            $table->integer('jumlah_unit')->default(1);
            $table->string('satuan')->default('Unit');
            $table->decimal('nilai_perolehan', 20, 2);
            $table->decimal('nilai_buku', 20, 2);
            $table->date('tanggal_perolehan');
            $table->enum('kondisi', ['Baik', 'Rusak Ringan', 'Rusak Berat'])->default('Baik');
            $table->string('lokasi');
            $table->string('pengguna')->nullable();
            $table->string('nomor_dokumen_kepemilikan')->nullable();
            $table->decimal('luas', 12, 2)->nullable(); // Untuk tanah/bangunan
            $table->string('alamat_lengkap')->nullable();
            $table->enum('status_aset', ['Digunakan', 'Tidak Digunakan', 'Dalam Perbaikan', 'Disewakan'])->default('Digunakan');
            $table->text('keterangan')->nullable();
            $table->string('foto_aset')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penatausahaan_bmns');
    }
};
