<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    public $table = "merek";

    protected $primaryKey = 'id_merek';

    protected $fillable = [
        'id_merek',
        'nama_merek',
        'slug_merek',
        'gambar_merek',
    ];

    // Accessor for the old 'id' attribute
    public function getIdAttribute()
    {
        return $this->attributes['id_merek'];
    }

    // Mutator for the old 'id' attribute
    public function setIdAttribute($value)
    {
        $this->attributes['id_merek'] = $value;
    }

    public function getKeyName()
    {
        return 'id_merek';
    }
}