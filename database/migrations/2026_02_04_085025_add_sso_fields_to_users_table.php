<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('sso_id')->nullable()->unique()->after('id');
            $table->string('nip')->nullable()->unique()->after('email');
            $table->string('nik')->nullable()->after('nip');
            $table->string('jabatan')->nullable()->after('nik');
            $table->string('unit_kerja')->nullable()->after('jabatan');
            $table->string('kode_satker')->nullable()->after('unit_kerja');
            $table->string('nama_satker')->nullable()->after('kode_satker');
            $table->string('avatar')->nullable()->after('nama_satker');
            $table->json('sso_data')->nullable()->after('avatar');
            $table->timestamp('last_sso_login')->nullable()->after('sso_data');

            // Make password nullable untuk SSO users
            $table->string('password')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'sso_id',
                'nip',
                'nik',
                'jabatan',
                'unit_kerja',
                'kode_satker',
                'nama_satker',
                'avatar',
                'sso_data',
                'last_sso_login'
            ]);
        });
    }
};
