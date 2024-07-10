<?php

namespace Database\Seeders;

use App\Models\Dusun;
use App\Models\Rw;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RwSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dusuns = Dusun::get()->map(fn ($dusun) => $dusun->id);
        $rws = [1, 2, 3, 4, 5, 6, 7, 8];

        foreach ($rws as $rw) {
            Rw::create([
                'nama' => 'RW 0' . $rw,
                'ketua' => fake('id_ID')->name(),
                'dusun_id' => fake()->randomElement($dusuns)
            ]);
        }
    }
}
