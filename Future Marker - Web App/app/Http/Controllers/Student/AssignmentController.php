<?php

namespace App\Http\Controllers\Student;

use App\Assignment;
use App\Course;
use App\Http\Controllers\Controller;
use App\User;
use Auth;

class AssignmentController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail(Auth::id());
        $assignment = Assignment::findOrFail($id);
        $course = $assignment->course;
        $finishedAssignment = $assignment->finishedAssignments->where('user_id', Auth::id());
        $notifications = $user->notifications;

        return view('student/assignment', ['user' => $user, 'assignment' => $assignment, 'course' => $course, 'submitedAssignment' => $finishedAssignment, 'notifications' => $notifications]);
    }

    public function submit($id)
    {
        $user = User::findOrFail(Auth::id());
        $assignment = Assignment::findOrFail($id);

        $attempts = $assignment->finishedAssignments->where('user_id', $user->id)->count();
        if ($attempts >= $assignment->assignment_repetition) {
            return redirect(route('student.assignment', $id))->with('error', 'You have exhausted your attempts.');
        }

        if (request()->has('assignmentFiles')) {
            $assignment_dir = md5(uniqid() . microtime());
            foreach (request('assignmentFiles') as $file) {
                $file->storeAs('public/assignments/submited/' . $assignment_dir, $file->getClientOriginalName());
            }

            exec("java -jar API/dist/API.jar " . $user->id . " " . $id . " " . "storage/assignments/submited/$assignment_dir", $output);

            if ($output[0] == "true") {
                return redirect(route('student.assignment', $id))->with('mssg', 'Assignment has been submited successfully.');
            } else {
                return redirect(route('student.assignment', $id))->with('mssg', 'Assignment failed to submit.');
            }
        }
    }
}
