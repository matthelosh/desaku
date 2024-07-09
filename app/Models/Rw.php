<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rw extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'ketua',
        'dusun_id'
    ];


    function dusun()
    {
        return $this->belongsTo(Dusun::class);
    }

    function rts()
    {
        return $this->hasMany(Rt::class);
    }

    function wargas()
    {
        return $this->hasMany(Warga::class);
    }
}
