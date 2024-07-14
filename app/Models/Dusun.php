<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dusun extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'ketua_id',
        'deskripsi'
    ];

    public function rws()
    {
        return $this->hasMany(Rw::class);
    }

    public function rts()
    {
        $this->hasManyThrough(Rt::class, Rw::class);
    }

    public function kasun()
    {
        return $this->belongsTo(Warga::class, 'ketua_id', 'id');
    }
}
