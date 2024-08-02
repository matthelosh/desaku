<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'foto',
        'lokasi',
        'kategori',
        'pengelola',
        'harga_tiket',
        'buka',
        'tutup',
        'is_active'
    ];
}
