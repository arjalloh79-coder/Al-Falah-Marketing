<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function read(Notification $notification)
    {
        $notification->update(['read_at' => now()]);

        return redirect($notification->url);
    }

    public function readAll()
    {
        Notification::unread()->update(['read_at' => now()]);

        return back();
    }
}
