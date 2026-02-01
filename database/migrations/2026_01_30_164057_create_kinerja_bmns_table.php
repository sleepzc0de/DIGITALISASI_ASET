<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kinerja_bmns', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_kegiatan'); // Pengadaan, Pemeliharaan, Penghapusan
            $table->string('nama_kegiatan');
            $table->integer('target');
            $table->integer('realisasi');
            $table->decimal('anggaran', 20, 2);
            $table->decimal('realisasi_anggaran', 20, 2);
            $table->string('status'); // On Progress, Completed, Delayed
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai')->nullable();
            $table->integer('bulan');
            $table->integer('tahun');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kinerja_bmns');
    }
};
