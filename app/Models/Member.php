<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'surname',
        'ci',
        'gender',
        'marital_status',
        'address',
        'status',
        'phone',
        'date_of_birth',
        'image',
        'post',
    ];
}
