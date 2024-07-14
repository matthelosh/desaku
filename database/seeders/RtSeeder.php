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
        for ($r = 1; $r < 48; $r++) {
            $wargas = Warga::whereRtId($r)->get()->map(fn ($warga) => $warga->id);
            Rt::create([
                'id' => $r,
                'nama' => 'RT ' . ($r < 10 ? '00' . $r : '0' . $r),
                'rw_id' => fake()->randomElement($rws),
                'ketua_id' => fake()->randomElement($wargas),
            ]);
        }
    }
}
