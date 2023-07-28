<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultiImg extends Model
{
    use HasFactory;

    public $table = "gambar_produk";

    protected $primaryKey = 'id_gambar_produk';

    protected $fillable = [
        'id_produk',
        'nama_gambar_produk',
    ];

    // Accessor for the old 'id' attribute
    public function getIdAttribute()
    {
        return $this->attributes['id_gambar_produk'];
    }

    // Mutator for the old 'id' attribute
    public function setIdAttribute($value)
    {
        $this->attributes['id_gambar_produk'] = $value;
    }
}