<?php

namespace Database\Seeders;

use App\Models\Dusun;
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

        foreach ($dusuns as $dusun) {
            Dusun::create([
                'nama' => $dusun,
                'kasun' => 'Kosong',
                'deskripsi' => 'Dusun ' . $dusun
            ]);
        }
    }
}
