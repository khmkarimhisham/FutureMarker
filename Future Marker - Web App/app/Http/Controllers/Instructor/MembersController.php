<?php

namespace App\Http\Controllers\instructor;

use App\Course;
use App\Http\Controllers\Controller;
use App\User;
use Auth;

class MembersController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail(Auth::id());
        $course = Course::findOrFail($id);
        $users = $course->users;
        $notifications = $user->notifications;

        return view('instructor/members', ['user' => $user, 'users' => $users, 'course' => $course , 'notifications' => $notifications]);

    }
}
