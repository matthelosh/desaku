<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'deskripsi'];

    public function pamong()
    {
        return $this->hasOne(Pamong::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($jabatan) {
            $jabatan->pamong()->delete();
        });
    }
}
