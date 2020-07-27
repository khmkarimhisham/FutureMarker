<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Auth;
use App\Notification;
class Notify extends Controller
{
    public function createNotification($course, $notification_mssg)
    {
        foreach ($course->users->where('id', '!=', Auth::id()) as $n_user) {
            $notification = new Notification;
            $notification->user()->associate($n_user);
            $notification->content = $notification_mssg;
            $notification->save();
        }
    }

    public function createOneNotification($user, $notification_mssg)
    {
        if ($user->id != Auth::id()) {
            $notification = new Notification;
            $notification->user()->associate($user);
            $notification->content = $notification_mssg;
            $notification->save();
        }
    }
}
