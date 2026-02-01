<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dashboard_asets', function (Blueprint $table) {
            $table->id();
            $table->string('kategori_aset');
            $table->integer('jumlah_unit');
            $table->decimal('nilai_perolehan', 20, 2);
            $table->decimal('nilai_buku', 20, 2);
            $table->string('kondisi'); // Baik, Rusak Ringan, Rusak Berat
            $table->string('lokasi');
            $table->integer('tahun');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dashboard_asets');
    }
};
