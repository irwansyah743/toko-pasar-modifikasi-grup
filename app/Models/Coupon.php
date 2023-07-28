<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    public $table = "kupon";

    protected $primaryKey = 'id_kupon';

    protected $fillable = [
        'id_kupon',
        'nama_kupon',
        'diskon_kupon',
        'validitas_kupon',
        'status',
    ];

    
    // Accessor for the old 'id' attribute
    public function getIdAttribute()
    {
        return $this->attributes['id_kupon'];
    }

    // Mutator for the old 'id' attribute
    public function setIdAttribute($value)
    {
        $this->attributes['id_kupon'] = $value;
    }

    public function getKeyName()
    {
        return 'id_kupon';
    }
}