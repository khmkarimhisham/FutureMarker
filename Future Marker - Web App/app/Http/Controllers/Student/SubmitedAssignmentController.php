<?php

namespace App\Http\Controllers\Student;

use App\Assignment;
use App\FinishedAssignment;
use App\Http\Controllers\Controller;
use App\User;
use Auth;

class SubmitedAssignmentController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail(Auth::id());
        $finishedAssignment = FinishedAssignment::findOrFail($id);
        $assignment = $finishedAssignment->Assignment;
        $course = $assignment->course;
        $notifications = $user->notifications;
        return view('student/submitedAssignment', ['user' => $user, 'assignment' => $assignment, 'course' => $course, 'course' => $course, 'finishedAssignment' => $finishedAssignment, 'notifications' => $notifications]);
    }
}
