<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // These fields are allowed to be filled by the form
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'service_interest',
        'message'
    ];
}