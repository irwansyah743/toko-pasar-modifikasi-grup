<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_wishlist';

    protected $fillable = [
        'id_produk',
        'user_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_produk', 'id');
    }


    // Accessor for the old 'id' attribute
    public function getIdAttribute()
    {
        return $this->attributes['id_wishlist'];
    }

    // Mutator for the old 'id' attribute
    public function setIdAttribute($value)
    {
        $this->attributes['id_wishlist'] = $value;
    }

    public function getKeyName()
    {
        return 'id_wishlist';
    }
}