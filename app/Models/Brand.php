<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    public $table = "merek";

    protected $fillable = [
        'brand_name',
        'brand_slug',
        'brand_image',
    ];
}