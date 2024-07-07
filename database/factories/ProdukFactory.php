<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sku' => fake()->ean8(),
            'nama' => fake()->word(3),
            'foto' => 'https://loremflickr.com/320/240',
            'jenis' => 'umkm',
            'satuan' => 'bungkus',
            'berat' => '500gr',
            'dimensi' => '300x400cm',
            'deskripsi' => fake()->realText(),
            'harga' => 10000
        ];
    }
}
