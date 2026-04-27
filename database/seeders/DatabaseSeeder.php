<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Layanan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // DesaSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            WebsiteSeeder::class,
            FooterSeeder::class,
            HeaderSeeder::class,
            TentangKamiSeeder::class,
            LayananSeeder::class,
            KategoriSeeder::class,
            PendudukSeeder::class,
            DesaSeeder::class,
            // PostinganSeeder::class,
        ]);
    }
}
