<?php

namespace Database\Seeders;

use App\Models\Lembaga;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LembagaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lembagas = [
            [
                'kode' => 'BPD',
                'nama' => 'Badan Permusyawaratan Desa',
                'tipe' => 'Pemerintah',
                'deskripsi' => \fake('id')->realText(),
                'is_active' => true
            ],
            [
                'kode' => 'BUMDES',
                'nama' => 'Badan Usaha Milik Desa',
                'tipe' => 'Pemerintah',
                'deskripsi' => \fake('id')->realText(),
                'is_active' => true
            ],
            [
                'kode' => 'LPM',
                'nama' => 'Lembaga Pemberdayaan Masyarakat',
                'tipe' => 'Masyarakat',
                'deskripsi' => \fake('id')->realText(),
                'is_active' => true
            ],
            [
                'kode' => 'PKK',
                'nama' => 'Pembinaan Kesejahteraan Keluarga',
                'tipe' => 'Masyarakat',
                'deskripsi' => \fake('id')->realText(),
                'is_active' => true
            ],
            [
                'kode' => 'KT',
                'nama' => 'Karang Taruna',
                'tipe' => 'Masyarakat',
                'deskripsi' => \fake('id')->realText(),
                'is_active' => true
            ],
            [
                'kode' => 'LIN',
                'nama' => 'Pelindung Masyarakat (LINMAS)',
                'tipe' => 'Pemerintah',
                'deskripsi' => \fake('id')->realText(),
                'is_active' => true
            ],
            [
                'kode' => 'KIM',
                'nama' => 'Kelompok Informasi Masyarakat',
                'tipe' => 'Masyarakat',
                'deskripsi' => \fake('id')->realText(),
                'is_active' => true
            ],
            [
                'kode' => 'Pokdarwis',
                'nama' => 'Kelompok Sadar Wisata',
                'tipe' => 'Masyarakat',
                'deskripsi' => \fake('id')->realText(),
                'is_active' => true
            ],
        ];

        foreach ($lembagas as $lembaga) {
            Lembaga::create(
                [
                    'kode' => $lembaga['kode'],
                    'nama'  => $lembaga['nama'],
                    'tipe' => $lembaga['tipe'],
                    'deskripsi' => $lembaga['deskripsi'],
                    'is_active' => $lembaga['is_active']
                ]
            );
        }
    }
}
