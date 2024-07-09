<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'jenis',
        'kategori',
        'logo',
        'pemilik',
        'alamat',
        'kontak',
        'jml_karyawan',
        'omzet',
        'deskripsi'
    ];
}
