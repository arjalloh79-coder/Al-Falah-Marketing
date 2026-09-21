<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    protected $fillable = ['name', 'email', 'meeting_date', 'subject', 'confirmed_at'];

    protected $casts = [
        'confirmed_at' => 'datetime',
    ];
}
