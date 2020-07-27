<?php

namespace App\Http\Controllers\Student;

use App\Course;
use App\Http\Controllers\Controller;
use App\User;
use Auth;

include "assets/php_file_tree.php";
include "assets/readdir.php";

class CourseController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());
        $courses = $user->courses()->get();
        $notifications = $user->notifications;
        return view('student/courses', ['user' => $user, 'courses' => $courses, 'notifications' => $notifications]);

    }

    public function show($id)
    {
        $user = User::findOrFail(Auth::id());
        $course = Course::findOrFail($id);
        $assignments = $course->assignments;
        $quizzes = $course->quizzes;
        $material = php_file_tree($course->course_material_dir, "[link]");
        $notifications = $user->notifications;
        return view('student/course', ['user' => $user, 'course' => $course, 'assignments' => $assignments, 'quizzes' => $quizzes, 'material' => $material, 'notifications' => $notifications]);
    }
    public function Mobileshow($id)
    {
        $user = User::findOrFail(Auth::id());
        $course = Course::findOrFail($id);
        $assignments_dec = array();
        $assignment_attach = array();
        $posts_attch = array();
        $assignments = $course->assignments;
        foreach ($assignments as $assignment) {
            array_push($assignments_dec, $assignment->assignment_desc);
            array_push($assignment_attach, $assignment->attachments);
        }
        $quizzes = $course->quizzes;
       // $notifications = $user->notifications;
        $material = dir_to_json($course->course_material_dir);
        $posts = $course->posts->sortByDesc('id');
        foreach ($posts as $post) {
            array_push($posts_attch, $post->post_attachmentFiles);
        }
        $users = $course->users;
        return response()->json(['assignments' => $assignments, 'assignments_dec' => $assignments_dec, 'assignment_attach' => $assignment_attach, 'posts' => $posts, 'posts_attch' => $posts_attch,
            'quizzes' => $quizzes, 'material' => $material, 'users' => $users]);
    }

    public function join()
    {
        $course = Course::where('course_access_code', request('access_code'))->first();
        if ($course != null) {
            if (!$course->users()->where('user_id', Auth::id())->exists()) {
                $course->users()->attach(Auth::id());
                return redirect(route('student.courses'))->with('success', 'You have successfully joined the course.');
            }else{
                return redirect(route('student.courses'))->with('mssg', 'You are already in this course.');
            }
        }
        return redirect(route('student.courses'))->with('error', 'Invalid access code!');
    }
    public function mobileJoin()
    {
        $this->validate(request(), [
            'course_access_code' => 'required',

        ]);
        $course = Course::where('course_access_code', request('course_access_code'))->first();
        if ($course != null) {
            if (!$course->users()->where('user_id', Auth::id())->exists()) {
                $course->users()->attach(Auth::id());
                return response()->json('success', 'You have successfully joined the course.');
                
            }else{
                return response()->json('mssg', 'You are already in this course.');
            }
        }
        return response()->json('error', 'Invalid access code!');
        
    }
}
