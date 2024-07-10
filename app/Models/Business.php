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
        'skala',
        'logo',
        'pemilik',
        'online_store',
        'alamat',
        'kontak',
        'deskripsi'
    ];

    public function products()
    {
        return $this->hasMany(Produk::class, 'business_id', 'id');
    }
}
