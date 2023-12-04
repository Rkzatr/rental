<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alat extends Model
{
    use SoftDeletes;

    protected $table = 'alat';
    protected $fillable = [
        'nama',
        'kode',
        'id_kategori',
        'gambar',
        'harga',
        'deskripsi',
    ];

    public function kategori(): HasOne
    {
        return $this->hasOne(Kategori::class, 'id', 'id_kategori');
    }
}
