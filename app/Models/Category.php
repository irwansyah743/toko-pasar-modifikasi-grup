<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $table = "kategori";

    protected $primaryKey = 'id_kategori';

    protected $fillable = [
        'id_kategori',
        'nama_kategori',
        'slug_kategori',
        'ikon_kategori',
        'gambar_kategori',
    ];

    // Accessor for the old 'id' attribute
    public function getIdAttribute()
    {
        return $this->attributes['id_kategori'];
    }

    // Mutator for the old 'id' attribute
    public function setIdAttribute($value)
    {
        $this->attributes['id_kategori'] = $value;
    }

    public function getKeyName()
    {
        return 'id_kategori';
    }
}