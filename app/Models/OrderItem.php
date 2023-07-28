<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    public $table = 'pesanan_produk';

    protected $primaryKey = 'id_pesanan_produk';

    protected $fillable = [
        'id_produk',
        'id_pesanan'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_produk', 'id_produk');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'id_pesanan', 'id');
    }

    // Accessor for the old 'id' attribute
    public function getIdAttribute()
    {
        return $this->attributes['id_pesanan_produk'];
    }

    // Mutator for the old 'id' attribute
    public function setIdAttribute($value)
    {
        $this->attributes['id_pesanan_produk'] = $value;
    }

    public function getKeyName()
    {
        return 'id_pesanan_produk';
    }
}