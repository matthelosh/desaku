<?php

namespace Database\Seeders;

use App\Models\Identitas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IdentitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Identitas::create([
            'nama' => 'Samar',
            'status' => 'Desa',
            'kode_pum' => null,
            'kecamatan' => 'Pagerwojo',
            'kode_pos' => '66262',
            'kabupaten' => 'Tulungagung',
            'provinsi' => 'Jawa Timur',
            'luas' => '7,54 Km persegi',
            'tahun_dibentuk' => '-',
            'bujur' => '7.9862599',
            'lintang' => '111.7680192',
            'dpl' => '',
            'telp' => '-',
            'email' => 'info@samar.desa.id',
            'website' => 'samar.desa.id'
        ]);
    }
}
