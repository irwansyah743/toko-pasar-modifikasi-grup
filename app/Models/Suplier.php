<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suplier extends Model
{
    use HasFactory;

    public $table = "suplier";

    protected $primaryKey = 'id_suplier';

    protected $fillable = [
        'id_suplier',
        'nama_suplier',
        'alamat_suplier',
        'pengajuan_stok',
    ];

    // Accessor for the old 'id' attribute
    public function getIdAttribute()
    {
        return $this->attributes['id_suplier'];
    }

    // Mutator for the old 'id' attribute
    public function setIdAttribute($value)
    {
        $this->attributes['id_suplier'] = $value;
    }

    public function getKeyName()
    {
        return 'id_suplier';
    }
}
