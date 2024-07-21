<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use App\Models\Pamong;
use App\Models\Warga;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PamongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pamong::factory(11)->create();
        $jabatans = Jabatan::all();
        $wargas = Warga::get()->map(fn ($warga) => $warga->nik);
        foreach ($jabatans as $jabatan) {
            Pamong::create([
                'nik' => fake()->randomElement($wargas),
                'jabatan_id' => $jabatan->id,
            ]);
        }
    }
}
