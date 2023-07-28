<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    public $table = 'review';

    protected $primaryKey = 'id_review';

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_produk', 'id_produk');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getIdAttribute()
    {
        return $this->attributes['id_review'];
    }

    // Mutator for the old 'id' attribute
    public function setIdAttribute($value)
    {
        $this->attributes['id_review'] = $value;
    }

    public function getKeyName()
    {
        return 'id_review';
    }
}