<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluarga extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_kk',
        'dusun_id',
        'rw_id',
        'rt_id',
        'tanggal_kk'
    ];

    function dusun()
    {
        return $this->belongsTo(Dusun::class);
    }
    function rw()
    {
        return $this->belongsTo(Rw::class);
    }
    function rt()
    {
        return $this->belongsTo(Rt::class);
    }
    function anggotas()
    {
        return $this->hasMany(Warga::class, 'kk_id', 'no_kk');
    }
}
