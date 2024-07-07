<?php

namespace Database\Seeders;

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
        Pamong::factory(10)->create();
    }
}
