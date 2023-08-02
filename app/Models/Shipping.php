<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    public $table = 'pengiriman';

    protected $primaryKey = 'id_pengiriman';

    protected $fillable = [
        'id_pengiriman',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'alamat',
        'nama_pengiriman',
        'email_pengiriman',
        'no_telepon_pengiriman',
        'status_pengiriman',
        'kode_pos',
        'resi',
        'kurir',
        'ongkos_kirim',
        'catatan'
    ];

    // Accessor for the old 'id' attribute
    public function getIdAttribute()
    {
        return $this->attributes['id_pengiriman'];
    }

    // Mutator for the old 'id' attribute
    public function setIdAttribute($value)
    {
        $this->attributes['id_pengiriman'] = $value;
    }

    public function getKeyName()
    {
        return 'id_pengiriman';
    }
}
