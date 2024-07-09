<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    use HasFactory;

    protected $fillable = [
        'kk_id',
        'nik',
        'nama',
        'jk',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'rt_id',
        'rw_id',
        'dusun_id',
        'pendidikan',
        'pekerjaan',
        'ayah',
        'ibu',
        'foto'
    ];

    public function dusun()
    {
        return $this->belongsTo(Dusun::class);
    }
    public function rw()
    {
        return $this->belongsTo(Rw::class);
    }
    public function rt()
    {
        return $this->belongsTo(Rt::class);
    }
    public function keluarga()
    {
        return $this->belongsTo(Keluarga::class, 'no_kk', 'no_kk');
    }
}
