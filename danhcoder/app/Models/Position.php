<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;
    protected $table = 'positions';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'title',
        'describe'
    ];
}
