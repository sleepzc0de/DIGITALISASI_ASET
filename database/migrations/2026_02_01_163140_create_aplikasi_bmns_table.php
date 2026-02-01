<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aplikasi_bmns', function (Blueprint $table) {
            $table->id();
            $table->string('nama_aplikasi');
            $table->string('kategori'); // BMN, Pengadaan, Inventaris, Monitoring
            $table->text('deskripsi')->nullable();
            $table->string('versi')->nullable();
            $table->string('vendor')->nullable();
            $table->string('url_aplikasi')->nullable();
            $table->string('pic_nama')->nullable(); // Person In Charge
            $table->string('pic_email')->nullable();
            $table->string('pic_telepon')->nullable();
            $table->enum('status', ['Aktif', 'Maintenance', 'Non-Aktif'])->default('Aktif');
            $table->date('tanggal_implementasi')->nullable();
            $table->date('tanggal_expired')->nullable();
            $table->integer('jumlah_user')->default(0);
            $table->decimal('biaya_lisensi', 15, 2)->nullable();
            $table->string('periode_lisensi')->nullable(); // Tahunan, Bulanan, Selamanya
            $table->text('fitur_utama')->nullable();
            $table->string('logo')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aplikasi_bmns');
    }
};
