<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Positions_and_roles extends Model
{
    use HasFactory;
    protected $table = 'positions_and_roles';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'id_position',
        'id_role',
    ];
}
