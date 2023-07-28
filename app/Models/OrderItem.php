<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    public $table = 'penjualan_produk';

    protected $fillable = [
        'id_produk',
        'order_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_produk', 'id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}