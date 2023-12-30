<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class RentalDetail extends Model
{
    use SoftDeletes;

    protected $table = 'rental_detail';
    protected $fillable = [
        'id_alat', 'id_rental', 'qty'
    ];

    public function alat(): HasOne
    {
        return $this->hasOne(Alat::class, 'id', 'id_alat');
    }
}
