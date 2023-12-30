<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rental extends Model
{
    use SoftDeletes;

    protected $table = 'rental';
    protected $fillable = [
        'tgl_sewa', 'tgl_kembali', 'status', 'harga', 'id_customer', 'denda', 'file'
    ];

    public function detail(): HasMany
    {
        return $this->hasMany(RentalDetail::class, 'id_rental', 'id');
    }
}
