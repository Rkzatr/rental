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
    protected $casts = [
        'tgl_sewa' => 'datetime:Y-m-d',
        'tgl_kembali' => 'datetime:Y-m-d',
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];

    public function detail(): HasMany
    {
        return $this->hasMany(RentalDetail::class, 'id_rental', 'id');
    }
}
