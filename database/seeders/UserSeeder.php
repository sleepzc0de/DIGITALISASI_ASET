<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Super Admin SSO (akan auto-update dari SSO saat login)
        User::create([
            'name' => 'Auliya Putra Azhari',
            'email' => 'auliyaputraazhari@kemenkeu.go.id',
            'nip' => '199609102018011005',
            'password' => null, // SSO user tidak perlu password
            'role' => 'admin',
            'is_super_admin' => true,
        ]);

        // Admin Manual (Non-SSO) - Bisa Login dengan Email & Password
        User::create([
            'name' => 'Admin Local',
            'email' => 'admin@local.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_super_admin' => false,
        ]);

        // User Biasa Manual (Non-SSO)
        User::create([
            'name' => 'User Biasa',
            'email' => 'user@local.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'is_super_admin' => false,
        ]);

        // Developer/Testing Account
        User::create([
            'name' => 'Developer',
            'email' => 'dev@test.com',
            'password' => Hash::make('dev123'),
            'role' => 'admin',
            'is_super_admin' => false,
        ]);
    }
}
