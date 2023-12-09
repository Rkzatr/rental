<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use function Illuminate\Events\queueable;
use Illuminate\Notifications\Notifiable;

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

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::created(function (Alat $alat) {
            $alat->kode = range("A", "Z")[$alat->id_kategori - 1]  . sprintf("%03d", Alat::where('id_kategori', $alat->id_kategori)->count());
            $alat->save();
        });
    }
}
