<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Warga>
 */
class WargaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kk_id' => fake('id')->randomNumber(8),
            'nik' => fake('id')->ean13(),
            'nama' => fake()->name(),
            'jk' => fake()->randomElement(['Laki-laki', 'Perempuan']),
            'tempat_lahir' => 'Tulungagung',
            'tanggal_lahir' => fake()->date(),
            'agama' => fake()->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghuchu']),
            'rt_id' => fake()->numberBetween(1, 48),
            'rw_id' => fake()->numberBetween(1, 8),
            'dusun_id' => fake()->numberBetween(1, 5),
            'pendidikan' => fake()->randomElement(['Tidak Sekolah', 'SD/Sederajat', 'SLTP/Sederajat', 'SLTA/Sederajat', 'DII', 'DIII', 'DIV', 'S1', 'S2', 'S3']),
            'pekerjaan' => fake()->randomElement(['Tidak Bekerja', 'Ibu Rumah Tangga', 'Pelajar', 'TNI/Polri', 'PNS', 'Karyawan Swasta', 'Petani/Pekebun', 'Nelayan', 'Guru', 'Buruh', 'Wiraswasta', 'Pegawai Desa']),
            'ayah' => fake()->name(),
            'ibu' => fake()->name(),
            'foto' => 'https://loremflickr.com/320/240/person'
        ];
    }
}
