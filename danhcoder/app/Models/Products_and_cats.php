<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products_and_cats extends Model
{
    use HasFactory;
    protected $table = 'products_and_cats';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'id_product',
        'id_cat',
    ];
}
