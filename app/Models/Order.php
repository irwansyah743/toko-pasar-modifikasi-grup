<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shipping_id',
        'transaction_id',
        'order_id',
        'gross_amount',
        'payment_type',
        'payment_code',
        'pdf_url',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class, 'order_id', 'order_id');
    }

    public function shipping()
    {
        return $this->belongsTo(Shipping::class, 'shipping_id', 'id');
    }
}