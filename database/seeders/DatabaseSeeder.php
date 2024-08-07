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
            PermissionSeeder::class,
            RoleSeeder::class,
            IdentitasSeeder::class,
            AdminSeeder::class,
            JabatanSeeder::class,
            AgendaSeeder::class,
            CategorySeeder::class,
            PostSeeder::class,
            DusunSeeder::class,
            RwSeeder::class,
            RtSeeder::class,
            WargaSeeder::class,
            PamongSeeder::class,
            LembagaSeeder::class,
            BusinessSeeder::class,
            ProductSeeder::class,
            WisataSeeder::class,
        ]);
    }
}
