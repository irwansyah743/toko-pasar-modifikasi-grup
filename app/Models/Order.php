<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;

    public $table = 'pesanan';

    protected $fillable = [
        'user_id',
        'id_pengiriman',
        'id_transaksi',
        'id_pesanan',
        'nominal_total',
        'tipe_pembayaran',
        'kode_pembayaran',
        'pdf_url',
        'status',
        'tanggal_pesanan',
        'bulan_pesanan',
        'tahun_pesanan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class, 'id_pesanan', 'id_pesanan');
    }

    public function shipping()
    {
        return $this->belongsTo(Shipping::class, 'id_pengiriman', 'id_pengiriman');
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