<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pamong extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'nip',
        'gelar_depan',
        'nama',
        'foto',
        'gelar_belakang',
        'jk',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'alamat',
        'hp',
        'email',
        'is_active'
    ];
}
