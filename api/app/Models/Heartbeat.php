<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Heartbeat extends Model
{
    use HasFactory;



    protected $fillable = [
        'application_key',
        'heartbeat_key',
        'unhealty_after_minutes',
        'last_check_in',
    ];
}
