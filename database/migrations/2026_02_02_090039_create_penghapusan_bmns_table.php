<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penghapusan_bmns', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_sk')->unique();
            $table->string('nama_aset');
            $table->string('kode_barang')->nullable();
            $table->text('deskripsi_aset')->nullable();
            $table->enum('alasan_penghapusan', [
                'Rusak Berat',
                'Hilang',
                'Kadaluarsa',
                'Tidak Ekonomis',
                'Force Majeure',
                'Lainnya'
            ]);
            $table->integer('jumlah_unit');
            $table->decimal('nilai_perolehan', 20, 2);
            $table->decimal('nilai_buku', 20, 2);
            $table->date('tanggal_sk');
            $table->date('tanggal_penghapusan');
            $table->string('pejabat_penandatangan');
            $table->string('metode_penghapusan')->nullable(); // Pemusnahan, Lelang, dll
            $table->enum('status', ['Draft', 'Proses', 'Selesai', 'Dibatalkan'])->default('Draft');
            $table->string('file_sk')->nullable();
            $table->string('file_ba_penghapusan')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penghapusan_bmns');
    }
};
