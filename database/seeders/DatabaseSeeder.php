<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            DashboardAsetSeeder::class,
            KinerjaBMNSeeder::class,
            AplikasiBMNSeeder::class,
            PemanfaatanBMNSeeder::class,
            PerencanaanBMNSeeder::class,
        ]);
    }
}
