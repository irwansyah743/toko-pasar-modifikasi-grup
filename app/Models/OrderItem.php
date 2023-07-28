<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    public $table = 'pesanan_produk';

    protected $fillable = [
        'id_produk',
        'id_pesanan'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_produk', 'id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'id_pesanan', 'id');
    }
}