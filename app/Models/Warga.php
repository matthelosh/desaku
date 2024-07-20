<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Warga extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = [
        'kk_id',
        'nik',
        'nama',
        'jk',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'rt_id',
        'pendidikan',
        'pekerjaan',
        'ayah',
        'ibu',
        'foto'
    ];

    public function dusun()
    {
        return $this->belongsToThrough(Dusun::class, [Rw::class, Rt::class]);
    }
    public function rw()
    {
        return $this->belongsToThrough(Rw::class, Rt::class);
    }
    public function rt()
    {
        return $this->belongsTo(Rt::class);
    }
    public function keluarga()
    {
        return $this->belongsTo(Keluarga::class, 'no_kk', 'no_kk');
    }

    public function lembaga()
    {
        return $this->belongsToMany(Lembaga::class, 'anggotas')->withPivot('jabatan');
    }

    public function pamong()
    {
        return $this->hasOne(Pamong::class, 'nik', 'nik');
    }
}
