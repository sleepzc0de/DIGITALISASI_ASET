<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('perencanaan_bmns', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis_perencanaan', ['RP4', 'RKBMN']);
            $table->string('nomor_dokumen')->unique();
            $table->string('judul');
            $table->enum('kategori', ['Penggunaan', 'Pemanfaatan', 'Pemindahtanganan', 'Penghapusan'])->nullable();
            $table->text('deskripsi')->nullable();
            $table->integer('tahun_anggaran');
            $table->date('tanggal_dokumen');
            $table->decimal('nilai_estimasi', 20, 2)->nullable();
            $table->integer('volume')->nullable();
            $table->string('satuan')->nullable();
            $table->enum('status', ['Draft', 'Diajukan', 'Disetujui', 'Ditolak', 'Selesai'])->default('Draft');
            $table->text('keterangan')->nullable();
            $table->string('file_dokumen')->nullable();
            $table->string('pembuat');
            $table->string('pejabat_pengesah')->nullable();
            $table->date('tanggal_pengesahan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perencanaan_bmns');
    }
};
