<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    protected $fillable = ['title', 'slug', 'category', 'author', 'image', 'content', 'read_time', 'is_featured'];

    // Automatically create slug from title
    protected static function boot() {
        parent::boot();
        static::creating(function ($blog) {
            $blog->slug = Str::slug($blog->title);
        });
    }
}