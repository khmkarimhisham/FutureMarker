<?php

namespace App\Http\Controllers\instructor;

use App\Http\Controllers\Controller;
use App\User;
use Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());
        $courses = $user->courses;
        $notifications = $user->notifications;
        return view('instructor/profile', ['user' => $user, 'courses' => $courses, 'notifications' => $notifications]);

    }
    public function mobileIndex()
    {

        $user = User::findOrFail(Auth::id());
        $courses = $user->courses;
        $notifications = $user->notifications;
        return response()->json(['user' => $user, 'courses' => $courses, 'notifications' => $notifications]);
    }
    public function update()
    {
        $user = User::findOrFail(Auth::id());

        if (request()->has('profileimage')) {
            $user->image = request('profileimage')->store('public/profile_images');
        }
        if (request()->filled('bio')) {
            $user->bio = request('bio');
        }
        if (request()->filled('phone')) {
            $user->phone = request('phone');

        }

        $user->save();
        return redirect(route('instructor.profile'));
    }
    public function show($id)
    {
        if (Auth::id() == $id) {
            return redirect(route('instructor.profile'));
        } else {
            $user = User::findOrFail(Auth::id());
            $userProfile = User::findOrFail($id);
            $notifications = $user->notifications;
            return view('instructor/userprofile', ['user' => $user, 'usrProfile' => $userProfile, 'notifications' => $notifications]);
        }
    }

    public function MobileShow($id)
    {
        $user = User::findOrFail(Auth::id());
        $userProfile = User::findOrFail($id);
        $course = $userProfile->courses;
        $notifications = $user->notifications;

        return response()->json(['usrProfile' => $userProfile, 'courses' => $course, 'notifications' => $notifications]);
    }
}
