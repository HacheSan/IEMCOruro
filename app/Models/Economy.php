<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Economy extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'income',
        'egress',
        'date',
        'total',
        'type_id',
        'member_id'
    ];
}
