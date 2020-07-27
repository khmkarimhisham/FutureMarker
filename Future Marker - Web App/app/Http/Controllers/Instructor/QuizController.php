<?php

namespace App\Http\Controllers\instructor;

use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Instructor\Notify;
use App\Quiz;
use App\QuizQuestion;
use App\User;
use Auth;

class QuizController extends Controller
{

    public function showCreate($id)
    {
        $user = User::findOrFail(Auth::id());
        $course = Course::findOrFail($id);
        $notifications = $user->notifications;
        return view('instructor/createQuiz', ['user' => $user, 'course' => $course, 'notifications' => $notifications]);
    }

    public function show($id)
    {
        $user = User::findOrFail(Auth::id());
        $quiz = Quiz::findOrFail($id);
        $course = $quiz->course;
        $finishedQuizzes = $quiz->finishedQuizzes;
        $notifications = $user->notifications;
        return view('instructor/quiz', ['user' => $user, 'quiz' => $quiz, 'course' => $course, 'finishedQuizzes' => $finishedQuizzes, 'notifications' => $notifications]);
    }

    public function create($id)
    {
        $course = Course::findOrFail($id);
        $quiz = new Quiz;
        $quiz->course()->associate($course);
        $quiz->quiz_deadline = request('deadline');
        $quiz->quiz_title = request('title');
        $quiz->quiz_grade = "100";
        $quiz->quiz_duration = request('duration');
        $quiz->quiz_repetition = request('attempts');
        $quiz->save();

        if (request()->has('question')) {

            for ($i = 0; $i < count(request('question')); $i++) {
                $question = new QuizQuestion;
                $question->quiz()->associate($quiz);
                $question->question = request('question')[$i];
                $question->answer_one = request('answer1')[$i];
                $question->answer_two = request('answer2')[$i];
                $question->answer_three = request('answer3')[$i];
                $question->answer_four = request('answer4')[$i];
                $question->model_answer = request('model_answer')[$i];
                $question->save();
            }
        }

        $notification_mssg = "The quiz " . $quiz->quiz_title . " has been created in " . $course->course_name . " course.";
        (new Notify)->createNotification($course, $notification_mssg);
        return redirect(route('instructor.course', $id))->with('success', 'Quiz has been created successfully.');
    }
}
