<?php

namespace Database\Factories;

use App\Models\Jabatan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pamong>
 */
class PamongFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jabatans = Jabatan::all();

        $jabs = $jabatans->map(fn ($j) => $j->id);
        return [
            'nik' => fake('id')->ean13(),
            'nip' => fake('id')->ean13(),
            'nama' => fake('id')->name(),
            'jabatan_id' => fake()->randomElement($jabs),
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
        ];
    }
}
