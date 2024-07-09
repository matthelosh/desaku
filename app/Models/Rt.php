<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rt extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'ketua',
        'rw_id',
        'dusun_id'
    ];


    function dusun()
    {
        return $this->belongsTo(Dusun::class);
    }

    function rw()
    {
        return $this->belongsTo(Rw::class);
    }

    function wargas()
    {
        return $this->hasMany(Warga::class);
    }
}
