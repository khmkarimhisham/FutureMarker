<?php

namespace App\Http\Controllers\Student;

use App\Course;
use App\FinishedQuiz;
use App\Http\Controllers\Controller;
use App\Quiz;
use App\User;
use Auth;

class QuizController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail(Auth::id());
        $quiz = Quiz::findOrFail($id);
        $course = $quiz->course;
        $notifications = $user->notifications;
        $attempts = $quiz->finishedQuizzes->where('user_id', $user->id)->count();
        if ($attempts >= $quiz->quiz_repetition) {
            return redirect(route('student.start.quiz', $id))->with('error', 'You have exhausted your attempts.');
        }
        return view('student/quiz', ['user' => $user, 'course' => $course, 'quiz' => $quiz, 'notifications' => $notifications]);
    }

    public function start($id)
    {
        $user = User::findOrFail(Auth::id());
        $quiz = Quiz::findOrFail($id);
        $course = $quiz->course;
        $finishedQuiz = $user->finishedQuizzes->where('quiz_id', $id)->sortByDesc('quiz_grade')->first();
        if ($finishedQuiz) {
            $grade = $finishedQuiz->quiz_grade;
        } else {
            $grade = "--";
        }
        $notifications = $user->notifications;
        return view('student/quizStart', ['user' => $user, 'course' => $course, 'quiz' => $quiz, 'grade' => $grade, 'notifications' => $notifications]);
    }

    public function submit($id)
    {
        $user = User::findOrFail(Auth::id());
        $quiz = Quiz::findOrFail($id);
        $quizQuestions = $quiz->quizQuestions;
        $finishedQuiz = new FinishedQuiz;
        $finishedQuiz->user()->associate($user);
        $finishedQuiz->quiz()->associate($quiz);
        $questions_count = request("questions_count");
        $quiz_grade = $quiz->quiz_grade;
        $total = 0;
        $e = 0;
        for ($x = 1; $x <= $questions_count; $x++) {
            if ($quizQuestions[$x - 1]->model_answer == request("question$x")) {
                $total++;
            }
        }
        $finishedQuiz->quiz_grade = ceil(($total / $questions_count) * $quiz_grade);
        $finishedQuiz->save();
        return route('student.course', $quiz->course['id']);

    }

}
