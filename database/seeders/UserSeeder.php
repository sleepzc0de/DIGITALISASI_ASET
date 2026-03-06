<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ── 1. Super Admin SSO ───────────────────────────────────────
        // Tidak butuh password — autentikasi via SSO Kemenkeu
        User::updateOrCreate(
            ['email' => 'auliyaputraazhari@kemenkeu.go.id'],
            [
                'name'          => 'Auliya Putra Azhari',
                'nip'           => '199609102018011005',
                'password'      => null,
                'role'          => 'admin',
                'is_super_admin' => true,
            ]
        );

        // ── 2. Admin Manual (Non-SSO) ────────────────────────────────
        // Hash::make() otomatis menggunakan PepperedHasher
        // karena sudah di-override di AppServiceProvider
        User::updateOrCreate(
            ['email' => 'admin@local.com'],
            [
                'name'          => 'Admin Local',
                'password'      => Hash::make('password'),
                'role'          => 'admin',
                'is_super_admin' => false,
            ]
        );

        // ── 3. User Biasa Manual (Non-SSO) ───────────────────────────
        User::updateOrCreate(
            ['email' => 'user@local.com'],
            [
                'name'          => 'User Biasa',
                'password'      => Hash::make('password'),
                'role'          => 'user',
                'is_super_admin' => false,
            ]
        );

        // ── 4. Developer / Testing Account ───────────────────────────
        // Hanya aktif di environment non-production
        if (! app()->isProduction()) {
            User::updateOrCreate(
                ['email' => 'dev@test.com'],
                [
                    'name'          => 'Developer',
                    'password'      => Hash::make('dev123'),
                    'role'          => 'admin',
                    'is_super_admin' => false,
                ]
            );
        }

        $this->command->info('✅ UserSeeder selesai — password di-hash dengan salt + pepper.');
    }
}
