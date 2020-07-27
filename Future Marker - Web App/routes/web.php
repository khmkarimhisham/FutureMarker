<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/about', function () {
    return view('about');
});

Route::get('/download', 'DownloadAppController@index');

Route::get('/instructor', 'Instructor\HomeController@index')->name('instructor')->middleware('instructor');
Route::get('/instructor/messages', 'Instructor\MessagesController@index')->name('instructor.message')->middleware('instructor');
Route::post('/instructor/messages/search', 'Instructor\MessagesController@search')->name('instructor.message.search')->middleware('instructor');
Route::post('/instructor/messages/send_message/{id}', 'Instructor\MessagesController@send_message')->name('instructor.message.sendMessage')->middleware('instructor');
Route::post('/instructor/messages/newMessage', 'Instructor\MessagesController@newMessage')->name('instructor.message.newMessage')->middleware('instructor');
Route::get('/instructor/messages/{id}', 'Instructor\MessagesController@show')->name('instructor.message.show')->middleware('instructor');
Route::get('/instructor/course', 'Instructor\CourseController@index')->name('instructor.courses')->middleware('instructor');
Route::post('/instructor/course/create/{id}', 'Instructor\CourseController@create')->name('instructor.course.create')->middleware('instructor');
Route::post('/instructor/course/upload/{id}', 'Instructor\CourseController@upload')->name('instructor.course.upload')->middleware('instructor');
Route::get('/instructor/course/{id}', 'Instructor\CourseController@show')->name('instructor.course')->middleware('instructor');
Route::post('/instructor/course', 'Instructor\CourseController@store')->name('instructor.courses')->middleware('instructor');
Route::get('/instructor/profile', 'Instructor\ProfileController@index')->name('instructor.profile')->middleware('instructor');
Route::post('/instructor/profile', 'Instructor\ProfileController@update')->name('instructor.profile')->middleware('instructor');
Route::post('/instructor/{id}', 'Instructor\HomeController@comment')->name('instructor.home.comment')->middleware('instructor');
Route::get('/instructor/course/members/{id}', 'Instructor\MembersController@show')->name('instructor.course.members')->middleware('instructor');
Route::get('/instructor/course/members/userprofile/{id}', 'Instructor\ProfileController@show')->name('instrutor.userprofile')->middleware('instructor');
Route::get('/instructor/course/createAssignment/{id}', 'Instructor\AssignmentController@showCreate')->name('instructor.create.assignment')->middleware('instructor');
Route::get('/instructor/course/editAssignment/{id}', 'Instructor\AssignmentController@showEdit')->name('instructor.edit.assignment')->middleware('instructor');
Route::get('/instructor/course/createQuiz/{id}', 'Instructor\QuizController@showCreate')->name('instructor.create.quiz')->middleware('instructor');
Route::post('/instructor/course/createAssignment/{id}', 'Instructor\AssignmentController@create')->name('instructor.create.assignment')->middleware('instructor');
Route::post('/instructor/course/editAssignment/{id}', 'Instructor\AssignmentController@edit')->name('instructor.edit.assignment')->middleware('instructor');
Route::post('/instructor/course/deleteAssignment/{id}', 'Instructor\AssignmentController@delete')->name('instructor.delete.assignment')->middleware('instructor');
Route::post('/instructor/course/createQuiz/{id}', 'Instructor\QuizController@create')->name('instructor.create.quiz')->middleware('instructor');
Route::get('/instructor/course/assignment/{id}', 'Instructor\AssignmentController@show')->name('instructor.assignment')->middleware('instructor');
Route::get('/instructor/course/quiz/{id}', 'Instructor\QuizController@show')->name('instructor.quiz')->middleware('instructor');
Route::get('/instructor/course/post/{id}', 'Instructor\PostController@show')->name('instructor.post')->middleware('instructor');
Route::post('/instructor/course/post/{id}', 'Instructor\PostController@create')->name('instructor.post')->middleware('instructor');
Route::post('/instructor/course/post/comment/{id}', 'Instructor\PostController@comment')->name('instructor.comment')->middleware('instructor');
Route::get('/instructor/course/submitedAssignment/{id}', 'Instructor\AssignmentController@submitedAssignmentShow')->name('instructor.submited.assignment')->middleware('instructor');
Route::get('/instructor/course/grades/{id}', 'Instructor\CourseController@grades')->name('instructor.grades')->middleware('instructor');

Route::get('/student', 'Student\HomeController@index')->name('student')->middleware('student');
Route::get('/student/course', 'Student\CourseController@index')->name('student.courses')->middleware('student');
Route::post('/student/course', 'Student\CourseController@join')->name('student.courses')->middleware('student');
Route::get('/student/grades', 'Student\GradeController@index')->name('student.grades')->middleware('student');
Route::get('/student/course/{id}', 'Student\CourseController@show')->name('student.course')->middleware('student');
Route::get('/student/profile', 'student\ProfileController@index')->name('student.profile')->middleware('student');
Route::post('/student/profile', 'student\ProfileController@update')->name('student.profile')->middleware('student');
Route::post('/student/{id}', 'Student\HomeController@comment')->name('student.home.comment')->middleware('student');
Route::get('/student/course/members/{id}', 'student\MembersController@show')->name('student.course.members')->middleware('student');
Route::get('/student/course/members/userprofile/{id}', 'Student\ProfileController@show')->name('student.userprofile')->middleware('student');
Route::get('/student/course/assignment/{id}', 'Student\AssignmentController@show')->name('student.assignment')->middleware('student');
Route::post('/student/course/submitAssignment/{id}', 'Student\AssignmentController@submit')->name('student.submit.assignment')->middleware('student');
Route::get('/student/course/submitedAssignment/{id}', 'Student\SubmitedAssignmentController@show')->name('student.submited.assignment')->middleware('student');
Route::get('/student/course/startQuiz/{id}', 'Student\QuizController@start')->name('student.start.quiz')->middleware('student');
Route::get('/student/course/quiz/{id}', 'Student\QuizController@show')->name('student.quiz')->middleware('student');
Route::post('/student/course/submitQuiz/{id}', 'Student\QuizController@submit')->name('student.submit.quiz')->middleware('student');
Route::get('/student/course/post/{id}', 'Student\PostController@show')->name('student.post')->middleware('student');
Route::post('/student/course/post/comment/{id}', 'Student\PostController@comment')->name('student.comment')->middleware('student');
Route::get('/student/course/grade/{id}', 'Student\GradeController@show')->name('student.grade')->middleware('student');
