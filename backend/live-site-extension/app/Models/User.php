<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function domains()
{
    return $this->hasMany(\App\Models\DomainDetail::class, 'user_id');
}

    /**
     * Send the branded reset-password email instead of Laravel's default
     * notification mail, matching the rest of the site's transactional emails.
     */
    public function sendPasswordResetNotification($token): void
    {
        $resetUrl = route('password.reset', [
            'token' => $token,
            'email' => $this->email,
        ]);

        Mail::to($this->email)->send(new ResetPasswordMail($this, $resetUrl));
    }
}
