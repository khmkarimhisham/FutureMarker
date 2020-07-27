<?php

namespace App\Http\Controllers\Instructor;

use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Instructor\Notify;
use App\Post;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

include "assets/php_file_tree.php";
include "assets/readdir.php";

class CourseController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());
        $courses = $user->courses;
        $notifications = $user->notifications;
        return view('instructor/courses', ['user' => $user, 'courses' => $courses, 'notifications' => $notifications]);
    }

    public function show($id)
    {
        $user = User::findOrFail(Auth::id());
        $course = Course::findOrFail($id);
        $assignments = $course->assignments;
        $quizzes = $course->quizzes;
        $material = php_file_tree($course->course_material_dir, "[link]");
        $notifications = $user->notifications;
        return view('instructor/course', ['user' => $user, 'course' => $course, 'assignments' => $assignments, 'quizzes' => $quizzes, 'material' => $material, 'notifications' => $notifications]);
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
        $notifications = $user->notifications;
        $material = dir_to_json($course->course_material_dir);
        $posts = $course->posts->sortByDesc('id');
        foreach ($posts as $post) {
            array_push($posts_attch, $post->post_attachmentFiles);
        }
        $users = $course->users;
        return response()->json(['assignments' => $assignments, 'assignments_dec' => $assignments_dec, 'assignment_attach' => $assignment_attach, 'posts' => $posts, 'posts_attch' => $posts_attch,
            'quizzes' => $quizzes, 'notifications' => $notifications, 'material' => $material, 'users' => $users]);
    }

    public function store()
    {
        $user = User::findOrFail(Auth::id());

        if (request()->hasFile('course_image')) {
            $course = new Course;

            $course->course_name = request('course_name');
            $course->course_desc = request('course_desc');
            $course->course_image = request('course_image')->store('public/course_images');
            $course->course_access_code = $this->generate_access_code();

            $course_material_dir = md5(uniqid() . microtime());
            $course_material_dir = "public/courses/$course_material_dir";
            if (Storage::makeDirectory($course_material_dir)) {
                $course->course_material_dir = $course_material_dir;
            }
            $course->save();
            $user->courses()->attach($course->id);
            $post = new Post;
            $post->course()->associate($course);
            $post->user()->associate($user);

            $post->post_content = "<p>Welcome to " . $course->course_name . "! My hope is that by the end of this course you have a new appreciation for
        the subject matter and will continue your education in the subject.</p>";
            $post->save();

        }
        return redirect(route('instructor.courses'));
    }

    public function Mobilestore(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        $this->validate($request, [
            'course_name' => 'required',
            'course_desc' => 'required',

        ]);
        $course = new Course();
        $course->course_name = request('course_name');
        $course->course_desc = request('course_desc');

        $course->course_image = "public/course_images/course.jpg";
        $course->course_access_code = $this->generate_access_code();
        $course_material_dir = md5(uniqid() . microtime());
        $course_material_dir = "public/courses/$course_material_dir";
        if (Storage::makeDirectory($course_material_dir)) {
            $course->course_material_dir = $course_material_dir;
        }
        if (auth()->user()->courses()->save($course)) {
            $post = new Post;
            $post->course()->associate($course);
            $post->user()->associate($user);

            $post->post_content = "<p>Welcome to " . $course->course_name . "! My hope is that by the end of this course you have a new appreciation for
        the subject matter and will continue your education in the subject.</p>";
            $accpost = new Post;
            $accpost->course()->associate($course);
            $accpost->user()->associate($user);

            $accpost->post_content = "<p>The Access Code is " . $course->course_access_code;
            $post->save();
            $accpost->save();
            return response()->json('done');
        } else {
            return response()->json('sorry', 500);
        }

    }

    public function create($id)
    {
        $course = Course::findOrFail($id);
        $course_material_dir = $course->course_material_dir;
        $foldername = request('foldername');
        Storage::makeDirectory("$course_material_dir/$foldername");
        if (request()->has('folderfile')) {
            foreach (request('folderfile') as $file) {
                $file->storeAs("$course_material_dir/$foldername", $file->getClientOriginalName());
            }
        }

        $notification_mssg = "A new Folder has been created in " . $course->course_name . " course.";
        (new Notify)->createNotification($course, $notification_mssg);

        return redirect(route('instructor.course', $id));
    }
    public function upload($id)
    {
        $user = User::findOrFail(Auth::id());
        $course = Course::findOrFail($id);

        $course_material_dir = $course->course_material_dir;
        $foldername = request('folder');
        if (request()->has('uploadedfiles')) {
            foreach (request('uploadedfiles') as $file) {
                $file->storeAs("$course_material_dir/$foldername", $file->getClientOriginalName());
            }

            $notification_mssg = "A new file has been uploaded in " . $course->course_name . " course.";
            (new Notify)->createNotification($course, $notification_mssg);
            return redirect(route('instructor.course', $id));
        }
    }

    protected function generate_access_code()
    {
        do {
            $charstr = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
            $Course_accsess_code = substr(str_shuffle($charstr), 0, 4) . '-' . substr(str_shuffle($charstr), 0, 4) . '-' . substr(str_shuffle($charstr), 0, 4);
        } while (Course::where('course_access_code', $Course_accsess_code)->count() == 1);

        return $Course_accsess_code;
    }

    protected function grades($id)
    {
        $user = User::findOrFail(Auth::id());
        $course = Course::findOrFail($id);
        $assignments = $course->assignments;
        $quizzes = $course->quizzes;
        $notifications = $user->notifications;
        return view('instructor/grades', ['user' => $user, 'course' => $course, 'assignments' => $assignments, 'quizzes' => $quizzes, 'notifications' => $notifications]);
    }
}
