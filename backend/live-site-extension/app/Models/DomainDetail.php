<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DomainDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'domain_name',
        'start_date',
        'end_date',
    ];

    // Establish link to the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}