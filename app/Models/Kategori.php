<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
    use SoftDeletes;

    protected $table = 'kategori';
    protected $fillable = [
        'label',
        'gambar',
    ];

    public function alat(): HasMany
    {
        return $this->hasMany(Alat::class, 'id_kategori', 'id');
    }
}
