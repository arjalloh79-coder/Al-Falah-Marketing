<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'source',
        'first_name',
        'last_name',
        'business',
        'email',
        'phone',
        'service_interest',
        'message',
        'status',
        'next_step',
        'notes',
    ];
}
