<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', 'Auth\MobileAuthController@login');
Route::post('/register', 'Auth\MobileAuthController@register');

Route::middleware('auth:api')->group(function () {
    Route::get('/homeData', 'Instructor\HomeController@mobileIndex');
    Route::get('/userData', 'Instructor\ProfileController@mobileIndex');
    Route::post('/createCourse','Instructor\CourseController@Mobilestore');
    Route::get('/getContent/{id}','Instructor\CourseController@Mobileshow');
    Route::get('/getuser/{id}','Instructor\ProfileController@MobileShow');
    Route::post('/createAssignment/{id}','Instructor\AssignmentController@mobileCreate');
    Route::post('/createPost/{id}','Instructor\PostController@mobileCreate');
    Route::post('/createComment/{id}','Instructor\PostController@mobileComment');

    /*********************************************student******************************************************* */
    Route::get('/ShomeData', 'Student\HomeController@mobileIndex');
    Route::get('/SuserData', 'Student\ProfileController@mobileIndex');
    Route::get('/Sgetuser/{id}','Student\ProfileController@mobileShow');
    Route::get('/SgetContent/{id}','Student\CourseController@Mobileshow');
    Route::post('/joinCourse','Student\CourseController@mobileJoin');
    Route::post('/ScreateComment/{id}','Student\PostController@mobileComment');
    Route::get('/courseGrade/{id}','Student\GradeController@mobileShow');
    Route::get('/StudentGrade','Student\GradeController@mobileIndex');



});
