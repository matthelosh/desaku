<?php

namespace Database\Seeders;

use App\Models\Dusun;
use App\Models\Rw;
use App\Models\Warga;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RwSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dusuns = Dusun::all();
        $rws = [
            [
                'name' => 'RW 01',
                'dusun_id' => 1
            ],
            [
                'name' => 'RW 02',
                'dusun_id' => 1
            ],
            [
                'name' => 'RW 03',
                'dusun_id' => 2
            ],
            [
                'name' => 'RW 04',
                'dusun_id' => 2
            ],
            [
                'name' => 'RW 05',
                'dusun_id' => 3
            ],
            [
                'name' => 'RW 06',
                'dusun_id' => 3
            ],
            [
                'name' => 'RW 07',
                'dusun_id' => 4
            ],
            [
                'name' => 'RW 08',
                'dusun_id' => 5
            ],

        ];


        foreach ($rws as $rw) {
            Rw::create(
                [
                    'nama' => $rw['name'],
                    'ketua_id' => null,
                    'dusun_id' => $rw['dusun_id']
                ]
            );
        }
    }
}
