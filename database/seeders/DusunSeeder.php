<?php

namespace Database\Seeders;

use App\Models\Dusun;
use App\Models\Warga;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DusunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dusuns = ['Krajan', 'Garon', 'Gading', 'Tumpak Nongko', 'Sendang Bedog'];
        foreach ($dusuns as $dusun) {
            Dusun::create(
                [
                    'nama' => $dusun,
                    'ketua_id' => null,
                    'deskripsi' => 'Dusun ' . $dusun
                ]
            );
        }
    }
}
