<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;

    public $table = 'penjualan';

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
        'order_date',
        'order_month',
        'order_year',
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

    // Tambahkan method untuk cek jangka waktu pembayaran 1x24 jam
    public function isWithinPaymentPeriod()
    {
        $order = Order::find($orderId);
    if ($order->isWithinPaymentPeriod()) {
     // Pelanggan masih bisa melakukan pembayaran
    } else {
    // Batas waktu pembayaran sudah terlewati
    }
        return Carbon::now()->lte($this->created_at->addHours(24));
    }
}