<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            AdminSeeder::class,
            JabatanSeeder::class,
            AgendaSeeder::class,
            CategorySeeder::class,
            PamongSeeder::class,
            PostSeeder::class,
            DusunSeeder::class,
            RwSeeder::class,
            BusinessSeeder::class,
            ProductSeeder::class,
            WargaSeeder::class,
        ]);
    }
}
