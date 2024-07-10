<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Business>
 */
class BusinessFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => fake()->company(),
            'jenis' => fake()->randomElement([
                "Perdagangan",
                "Jasa",
                "Produksi",
                "Pertambangan",
                "Pariwisata",
                "Pertanian",
                "Keuangan",
                "Peternakan",
                "Pendidikan",
                "Kesenian",
                "Hiburan"
            ]),
            'skala' => fake()->randomElement(['Mikro', 'Kecil', 'Menengah', 'Besar']),
            'logo' => null,
            'pemilik' => fake()->name(),
            'online_store' => null,
            'alamat' => fake('id_ID')->address(),
            'kontak' => fake()->phoneNumber(),
            'deskripsi' => fake()->realText()
        ];
    }
}
