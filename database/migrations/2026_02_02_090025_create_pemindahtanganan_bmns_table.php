<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemindahtanganan_bmns', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_laporan')->unique();
            $table->enum('jenis_pemindahtanganan', ['Penjualan', 'Tukar Menukar', 'Hibah', 'Penyertaan Modal']);
            $table->string('nama_aset');
            $table->text('deskripsi_aset')->nullable();
            $table->decimal('nilai_perolehan', 20, 2);
            $table->decimal('nilai_buku', 20, 2);
            $table->decimal('nilai_pnbp', 20, 2);
            $table->date('tanggal_pemindahtanganan');
            $table->string('penerima');
            $table->text('dasar_hukum')->nullable();
            $table->enum('status_pnbp', ['Belum Setor', 'Sudah Setor', 'Dibebaskan'])->default('Belum Setor');
            $table->date('tanggal_setor_pnbp')->nullable();
            $table->string('nomor_bukti_setor')->nullable();
            $table->string('file_laporan')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemindahtanganan_bmns');
    }
};
