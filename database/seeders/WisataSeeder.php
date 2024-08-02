<?php

namespace Database\Seeders;

use App\Models\Wisata;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WisataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            Wisata::Create(
                [
                    'nama' => \fake('id_ID')->word(),
                    'foto' => null,
                    'lokasi' => fake('id_ID')->address(),
                    'kategori' => fake()->randomElement(
                        ['Agrowisata', 'Edupark', 'Hiburan', 'Alam', 'Lain']
                    ),
                    'pengelola' => fake()->name(),
                    'harga_tiket' => fake()->randomElement(
                        [10000, 15000, 5000, 50000]
                    ),
                    'buka' => '90:00WIB',
                    'tutup' => '17:00WIB',
                    'is_active' => true,
                ]
            );
        }
    }
}
