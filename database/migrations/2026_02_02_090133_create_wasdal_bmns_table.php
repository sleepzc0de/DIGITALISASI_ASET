<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wasdal_bmns', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis_wasdal', ['Pelaporan BMN', 'Sensus BMN']);
            $table->string('nomor_laporan')->unique();
            $table->string('judul');
            $table->enum('periode', ['Triwulan I', 'Triwulan II', 'Triwulan III', 'Triwulan IV', 'Semester I', 'Semester II', 'Tahunan', 'Insidental']);
            $table->integer('tahun');
            $table->date('tanggal_laporan');
            $table->date('tanggal_mulai_pelaksanaan')->nullable();
            $table->date('tanggal_selesai_pelaksanaan')->nullable();
            $table->integer('jumlah_aset_tercatat')->nullable();
            $table->integer('jumlah_aset_terverifikasi')->nullable();
            $table->decimal('total_nilai_buku', 20, 2)->nullable();
            $table->integer('aset_kondisi_baik')->default(0);
            $table->integer('aset_kondisi_rusak_ringan')->default(0);
            $table->integer('aset_kondisi_rusak_berat')->default(0);
            $table->text('temuan')->nullable();
            $table->text('rekomendasi')->nullable();
            $table->enum('status', ['Draft', 'Submitted', 'Reviewed', 'Approved', 'Rejected'])->default('Draft');
            $table->string('petugas_pelaksana')->nullable();
            $table->string('pejabat_penerima')->nullable();
            $table->string('file_laporan')->nullable();
            $table->string('file_lampiran')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wasdal_bmns');
    }
};
