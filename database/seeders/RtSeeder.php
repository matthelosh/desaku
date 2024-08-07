<?php

namespace Database\Seeders;

use App\Models\Rt;
use App\Models\Rw;
use App\Models\Warga;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rws = Rw::get()->map(fn ($rw) => $rw->id);

        $rts = [
            [
                "no" => "1",
                "nama" => "RT 1",
                "rw" => "1"
            ],
            [
                "no" => "2",
                "nama" => "RT 2",
                "rw" => "1"
            ],
            [
                "no" => "3",
                "nama" => "RT 3",
                "rw" => "1"
            ],
            [
                "no" => "4",
                "nama" => "RT 4",
                "rw" => "1"
            ],
            [
                "no" => "5",
                "nama" => "RT 1",
                "rw" => "2"
            ],
            [
                "no" => "6",
                "nama" => "RT 2",
                "rw" => "2"
            ],
            [
                "no" => "7",
                "nama" => "RT 3",
                "rw" => "2"
            ],
            [
                "no" => "8",
                "nama" => "RT 4A",
                "rw" => "2"
            ],
            [
                "no" => "9",
                "nama" => "RT 4B",
                "rw" => "2"
            ],
            [
                "no" => "10",
                "nama" => "RT 5",
                "rw" => "2"
            ],
            [
                "no" => "11",
                "nama" => "RT 6",
                "rw" => "2"
            ],
            [
                "no" => "12",
                "nama" => "RT 1A",
                "rw" => "3"
            ],
            [
                "no" => "13",
                "nama" => "RT 1B",
                "rw" => "3"
            ],
            [
                "no" => "14",
                "nama" => "RT 2",
                "rw" => "3"
            ],
            [
                "no" => "15",
                "nama" => "RT 3",
                "rw" => "3"
            ],
            [
                "no" => "16",
                "nama" => "RT 1A",
                "rw" => "4"
            ],
            [
                "no" => "17",
                "nama" => "RT 1B",
                "rw" => "4"
            ],
            [
                "no" => "18",
                "nama" => "RT 2A",
                "rw" => "4"
            ],
            [
                "no" => "19",
                "nama" => "RT 2B",
                "rw" => "4"
            ],
            [
                "no" => "20",
                "nama" => "RT 1",
                "rw" => "5"
            ],
            [
                "no" => "21",
                "nama" => "RT 2",
                "rw" => "5"
            ],
            [
                "no" => "22",
                "nama" => "RT 3",
                "rw" => "5"
            ],
            [
                "no" => "23",
                "nama" => "RT 4",
                "rw" => "5"
            ],
            [
                "no" => "24",
                "nama" => "RT 5",
                "rw" => "5"
            ],
            [
                "no" => "25",
                "nama" => "RT 1A",
                "rw" => "6"
            ],
            [
                "no" => "26",
                "nama" => "RT 1B",
                "rw" => "6"
            ],
            [
                "no" => "27",
                "nama" => "RT 2",
                "rw" => "6"
            ],
            [
                "no" => "28",
                "nama" => "RT 3",
                "rw" => "6"
            ],
            [
                "no" => "29",
                "nama" => "RT 4",
                "rw" => "6"
            ],
            [
                "no" => "30",
                "nama" => "RT 5",
                "rw" => "6"
            ],
            [
                "no" => "31",
                "nama" => "RT 6",
                "rw" => "6"
            ],
            [
                "no" => "32",
                "nama" => "RT 1",
                "rw" => "7"
            ],
            [
                "no" => "33",
                "nama" => "RT 2",
                "rw" => "7"
            ],
            [
                "no" => "34",
                "nama" => "RT 3",
                "rw" => "7"
            ],
            [
                "no" => "35",
                "nama" => "RT 4",
                "rw" => "7"
            ],
            [
                "no" => "36",
                "nama" => "RT 5",
                "rw" => "7"
            ],
            [
                "no" => "37",
                "nama" => "RT 1",
                "rw" => "8"
            ],
            [
                "no" => "38",
                "nama" => "RT 2",
                "rw" => "8"
            ],
            [
                "no" => "39",
                "nama" => "RT 3A",
                "rw" => "8"
            ],
            [
                "no" => "40",
                "nama" => "RT 3B",
                "rw" => "8"
            ],
            [
                "no" => "41",
                "nama" => "RT 4",
                "rw" => "8"
            ],
            [
                "no" => "42",
                "nama" => "RT 5",
                "rw" => "8"
            ]
        ];

        foreach ($rts as $rt) {
            // $wargas = Warga::whereRtId($r)->get()->map(fn ($warga) => $warga->id);
            Rt::create(
                [
                    //'id' => $r,
                    'nama' => $rt['nama'],
                    'rw_id' => $rt['rw'],
                    'ketua_id' => null,
                ]
            );
        }
    }
}
