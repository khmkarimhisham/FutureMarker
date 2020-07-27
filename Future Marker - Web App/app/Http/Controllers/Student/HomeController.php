<?php

namespace App\Http\Controllers\Student;

use App\Assignment;
use App\Comment;
use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Student\Notify;
use App\Post;
use App\Quiz;
use App\User;
use Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $user = User::findOrFail($userId);
        $posts = Post::whereIn('course_id', DB::table('course_user')->where('user_id', $userId)->pluck('course_id'))
            ->orderBy('created_at', 'desc')->get();

        $assignments = Assignment::whereIn('course_id', DB::table('course_user')->where('user_id', $userId)->pluck('course_id'))
            ->orderBy('created_at', 'desc')->get();

        $quizzes = Quiz::whereIn('course_id', DB::table('course_user')->where('user_id', $userId)->pluck('course_id'))
            ->orderBy('created_at', 'desc')->get();

            $notifications = $user->notifications;
        return view('student/home', ['user' => $user, 'posts' => $posts, 'assignments' => $assignments, 'quizzes' => $quizzes, 'notifications' => $notifications]);
    }
    public function mobileIndex()
    {

        $userId = Auth::id();
        $user = User::findOrFail($userId);
        $notifications = $user->notifications;
        $posts_attch = array();
        $posts = Post::whereIn('course_id', DB::table('course_user')->where('user_id', $userId)->pluck('course_id'))
            ->orderBy('created_at', 'desc')->get();
            foreach ($posts as $post) {
                array_push($posts_attch, $post->post_attachmentFiles);
            }

        return response()->json(["user" => $user, "posts" => $posts,'posts_attch'=>$posts_attch, 'notifications' => $notifications]);

    }

    public function comment($id)
    {
        $user = User::findOrFail(Auth::id());
        $post = Post::findOrFail($id);
        $course = $post->course;
        $comment = new Comment;
        $comment->post()->associate($post);
        $comment->user()->associate($user);
        $comment->comment_content = request('comment');
        $comment->save();
        $notification_mssg = $user->name . " commented on your post.";
        (new Notify)->createOneNotification($post->user, $notification_mssg);

        return redirect(route('student'));
    }
}
