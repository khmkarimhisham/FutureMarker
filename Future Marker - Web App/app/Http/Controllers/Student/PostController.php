<?php

namespace App\Http\Controllers\student;

use App\Comment;
use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Student\Notify;
use App\Post;
use App\User;
use Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail(Auth::id());
        $course = Course::findOrFail($id);
        $posts = $course->posts->sortByDesc('id');
        $notifications = $user->notifications;
        return view('student/posts', ['user' => $user, 'posts' => $posts, 'course' => $course, 'notifications' => $notifications]);
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

        return redirect(route('student.post', $course->id));
    }
    public function mobileComment($id)
    {

        $this->validate(request(), [
            'comment_content' => 'required',

        ]);
        $user = User::findOrFail(Auth::id());
        $post = Post::findOrFail($id);
        $course = $post->course;
        $comment = new Comment;
        $comment->post()->associate($post);
        $comment->user()->associate($user);
        $comment->comment_content = request('comment_content');
        if (auth()->user()->comments()->save($comment)) {
            $notification_mssg = $user->name . " commented on your post.";
            (new Notify)->createOneNotification($post->user, $notification_mssg);
            return response()->json('done');
        } else {
            return response()->json('sorry', 500);
        }

    }
}
