<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lembaga extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'tipe',
        'deskripsi',
        'is_active'
    ];

    public function members()
    {
        return $this->belongsToMany(Warga::class, 'anggotas')->withPivot('jabatan')->withTimestamps();
    }
}
