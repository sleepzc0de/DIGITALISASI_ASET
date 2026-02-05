<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('sso_id')->nullable()->after('id');
            $table->string('nip')->nullable()->after('email');
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

        // Untuk SQL Server, buat filtered index
        if (DB::getDriverName() === 'sqlsrv') {
            DB::statement('CREATE UNIQUE INDEX users_sso_id_unique ON users(sso_id) WHERE sso_id IS NOT NULL');
            DB::statement('CREATE UNIQUE INDEX users_nip_unique ON users(nip) WHERE nip IS NOT NULL');
        } else {
            // Untuk database lain, gunakan unique constraint biasa
            Schema::table('users', function (Blueprint $table) {
                $table->unique('sso_id');
                $table->unique('nip');
            });
        }
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['sso_id']);
            $table->dropUnique(['nip']);
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
            $table->string('password')->nullable(false)->change();
        });
    }
};
