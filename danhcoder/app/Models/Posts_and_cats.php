<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts_and_cats extends Model
{
    use HasFactory;
    protected $table = 'posts_and_cats';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'id_post',
        'id_cat',
    ];
}
