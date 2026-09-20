<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentPiece extends Model
{
    protected $fillable = [
        'type', 'platform', 'topic', 'title', 'body', 'metadata',
        'status', 'scheduled_at', 'published_at', 'external_post_id',
        'last_error', 'created_by',
    ];

    protected $casts = [
        'metadata' => 'array',
        'scheduled_at' => 'datetime',
        'published_at' => 'datetime',
    ];
}
