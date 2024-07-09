<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cats = ['Berita', 'Info', 'Sejarah', 'Visi', 'Organisasi'];

        foreach ($cats as $cat) {
            Category::create([
                'nama' => $cat,
                'deskripsi' => fake()->realText()
            ]);
        }
    }
}
