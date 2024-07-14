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
            IdentitasSeeder::class,
            AdminSeeder::class,
            JabatanSeeder::class,
            AgendaSeeder::class,
            CategorySeeder::class,
            PamongSeeder::class,
            PostSeeder::class,
            WargaSeeder::class,
            DusunSeeder::class,
            RwSeeder::class,
            RtSeeder::class,
            BusinessSeeder::class,
            ProductSeeder::class,
            LembagaSeeder::class,
        ]);
    }
}
