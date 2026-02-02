<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemanfaatan_bmns', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis_pemanfaatan', ['SK Sewa', 'Izin Penghunian']);
            $table->string('nomor_sk')->unique();
            $table->string('nama_pihak_ketiga');
            $table->string('alamat_objek');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->text('deskripsi_objek')->nullable();
            $table->decimal('luas_tanah', 12, 2)->nullable();
            $table->decimal('luas_bangunan', 12, 2)->nullable();
            $table->decimal('nilai_sewa_tahunan', 15, 2)->nullable();
            $table->date('tanggal_mulai');
            $table->date('tanggal_berakhir');
            $table->integer('masa_pemanfaatan_bulan')->nullable();
            $table->enum('status', ['Aktif', 'Berakhir', 'Diperpanjang', 'Dibatalkan'])->default('Aktif');
            $table->string('file_sk')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemanfaatan_bmns');
    }
};
