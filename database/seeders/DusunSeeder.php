<?php

namespace Database\Seeders;

use App\Models\Dusun;
use App\Models\Warga;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DusunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dusuns = ['Krajan', 'Garon', 'Gading', 'Tumpaknongko', 'Sendang Bedog'];
        $wargas = Warga::get()->map(fn ($warga) => $warga->id);
        foreach ($dusuns as $dusun) {
            Dusun::create([
                'nama' => $dusun,
                'ketua_id' => fake()->randomElement($wargas),
                'deskripsi' => 'Dusun ' . $dusun
            ]);
        }
    }
}
