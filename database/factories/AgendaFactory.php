<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agenda>
 */
class AgendaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => fake('id')->sentence(),
            'mulai' => fake('id')->dateTimeBetween('-6 months', '+6 months'),
            'selesai' => fake('id')->dateTimeBetween('-6 months', '+6 months'),
            'lokasi' => fake()->sentence(),
            'pelaksana' => fake('id')->name(),
            'deskripsi' => fake('id')->randomHtml(),
            'status' => 'rencana'
        ];
    }
}
