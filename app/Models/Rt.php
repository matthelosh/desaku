<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rt extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = [
        'nama',
        'ketua',
        'rw_id',
        'dusun_id'
    ];


    function dusun()
    {
        return $this->belongsToThrough(Dusun::class, Rw::class);
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
