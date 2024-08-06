<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jabatans = [
            'Kepala Desa',
            'Sekretaris',
            'Kaur Keuangan',
            'Kaur Perencanaan',
            'Kaur Tu dan Umum',
            'Kasi Kesejahteraan',
            'Kasi Pelayanan',
            'Kasi Pemerintahan',
            'Operator'
        ];

        foreach ($jabatans as $jabatan) {
            Jabatan::create(
                [
                    'nama' => $jabatan,
                    'deskripsi' => 'Jabatan ' . $jabatan
                ]
            );
        }
    }
}
