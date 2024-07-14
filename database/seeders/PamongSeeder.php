<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use App\Models\Pamong;
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
        foreach ($jabatans as $jabatan) {
            Pamong::create([
                'nik' => fake('id')->ean13(),
                'nip' => fake('id')->ean13(),
                'nama' => fake('id')->name(),
                'jabatan_id' => $jabatan->id,
                'foto' => 'https://loremflickr.com/320/240/potrait',
                'gelar_belakang' => fake('id')->randomElement(['S.Pd.', 'S.Kom', 'S.Sos.', 'MM', 'M.Si.', 'M.Kom', 'SH.', 'MH.']),
                'jk' => fake('id')->randomElement(['Laki-laki', 'Perempuan']),
                'tempat_lahir' => fake('id')->city(),
                'tanggal_lahir' => fake('id')->date(),
                'agama' => fake()->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghuchu']),
                'alamat' => fake('id')->address(),
                'hp' => fake()->randomNumber(9),
                'email' => fake()->email(),
                'is_active' => true
            ]);
        }
    }
}
