<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'sku',
        'nama',
        'foto',
        'jenis',
        'satuan',
        'berat',
        'link',
        'deskripsi',
        'harga'
    ];

    public function produsen()
    {
        return $this->belongsTo(Business::class, 'business_id', 'id');
    }
}
