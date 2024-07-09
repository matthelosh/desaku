<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dusun extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kasun',
        'deskripsi'
    ];

    public function rws()
    {
        return $this->hasMany(Rw::class);
    }

    public function rts()
    {
        $this->hasMany(Rt::class);
    }

    public function wargas()
    {
        return $this->hasMany(Warga::class);
    }
}
