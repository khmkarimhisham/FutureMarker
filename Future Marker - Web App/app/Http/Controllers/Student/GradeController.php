<?php

namespace App\Http\Controllers\student;

use App\Course;
use App\FinishedAssignment;
use App\FinishedQuiz;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Support\Facades\DB;

class GradeController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());
        $courses = $user->courses;

        $finishedAssignments = array();
        $finishedQuizzes = array();
        foreach ($courses as $course) {
            array_push($finishedAssignments, FinishedAssignment::whereIn('assignment_id', DB::table('assignments')->where('course_id', $course['id'])->pluck('id'))->where('user_id', $user->id)->get());

            array_push($finishedQuizzes, FinishedQuiz::whereIn('quiz_id', DB::table('quizzes')->where('course_id', $course['id'])->pluck('id'))->where('user_id', $user->id)->get());

        }
        $notifications = $user->notifications;
        return view('student/grades', ['user' => $user, 'courses' => $courses, 'finishedAssignments' => $finishedAssignments, 'finishedQuizzes' => $finishedQuizzes, 'notifications' => $notifications]);

    }
    public function mobileIndex()
    {
        $user = User::findOrFail(Auth::id());
        $courses = $user->courses;
        $finishedAssignments = array();
        $finishedQuizzes = array();
        $assignments=array();
        $Quizzes=array();
        foreach ($courses as $course) {
            array_push($finishedAssignments, FinishedAssignment::whereIn('assignment_id', DB::table('assignments')->where('course_id', $course['id'])->pluck('id'))->where('user_id', $user->id)->with('assignment')->get());
           
            array_push($finishedQuizzes, FinishedQuiz::whereIn('quiz_id', DB::table('quizzes')->where('course_id', $course['id'])->pluck('id'))->where('user_id', $user->id)->with('quiz')->get());
       
        }
        

        $notifications = $user->notifications;
        return response()->json( ['user' => $user, 'courses' => $courses, 'finishedAssignments' => $finishedAssignments, 'finishedQuizzes' => $finishedQuizzes, 'notifications' => $notifications]);

    }
    public function show($id)
    {
        $user = User::findOrFail(Auth::id());
        $course = Course::findOrFail($id);
        $finishedAssignments = FinishedAssignment::whereIn('assignment_id', DB::table('assignments')->where('course_id', $id)->pluck('id'))->where('user_id', $user->id)->get();

        $finishedQuizzes = FinishedQuiz::whereIn('quiz_id', DB::table('quizzes')->where('course_id', $id)->pluck('id'))->where('user_id', $user->id)->get();

        $notifications = $user->notifications;
        return view('student/grade', ['user' => $user, 'course' => $course, 'finishedAssignments' => $finishedAssignments, 'finishedQuizzes' => $finishedQuizzes, 'notifications' => $notifications]);

    }
    public function mobileShow($id)
    {
        $user = User::findOrFail(Auth::id());
        $course = Course::findOrFail($id);
        $assignments=array();
        $Quizzes=array();
        $finishedAssignments = FinishedAssignment::whereIn('assignment_id', DB::table('assignments')->where('course_id', $id)->pluck('id'))->where('user_id', $user->id)->get();
        foreach($finishedAssignments as $finishedAssignment){
             array_push($assignments,$finishedAssignment->assignment);

        }
        $finishedQuizzes = FinishedQuiz::whereIn('quiz_id', DB::table('quizzes')->where('course_id', $id)->pluck('id'))->where('user_id', $user->id)->get();
        foreach($finishedQuizzes as $finishedQuiz){
            array_push($Quizzes,$finishedQuiz->quiz);

       }
        $notifications = $user->notifications;
        return response()->json(['user' => $user, 'course' => $course, 'finishedAssignments' => $finishedAssignments, 'finishedQuizzes' => $finishedQuizzes, 'notifications' => $notifications]);

    }
}
