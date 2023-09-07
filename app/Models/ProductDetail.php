<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;

    public $table = 'produk_detail';

    protected $primaryKey = 'id_produk_detail';

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_produk', 'id_produk');
    }

    // Accessor for the old 'id' attribute
    public function getIdAttribute()
    {
        return $this->attributes['id_produk_detail'];
    }

    // Mutator for the old 'id' attribute
    public function setIdAttribute($value)
    {
        $this->attributes['id_produk_detail'] = $value;
    }

    public function getKeyName()
    {
        return 'id_produk_detail';
    }
}
