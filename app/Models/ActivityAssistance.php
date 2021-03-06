<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityAssistance extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_id',
        'member_id'
    ];
}
