<?php

namespace App\Http\Controllers\instructor;

use App\Comment;
use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Instructor\Notify;
use App\Post;
use App\User;
use Auth;

class PostController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail(Auth::id());
        $course = Course::findOrFail($id);
        $posts = $course->posts->sortByDesc('id');
        $notifications = $user->notifications;

        return view('instructor/posts', ['user' => $user, 'posts' => $posts, 'course' => $course, 'notifications' => $notifications]);
    }

    public function create($id)
    {
        $user = User::findOrFail(Auth::id());
        $course = Course::findOrFail($id);
        $post = new Post;
        $post->course()->associate($course);
        $post->user()->associate($user);

        $post->post_content = request('summernote');

        if (request()->has('attachmentFiles')) {
            $post_attachment = md5(uniqid() . microtime());
            foreach (request('attachmentFiles') as $file) {
                $file->storeAs('public/posts/attachments/' . $post_attachment, $file->getClientOriginalName());
            }
            $post->post_attachment = 'public/posts/attachments/' . $post_attachment;
        }

        $post->save();
        $notification_mssg = $user->name . " posted in " . $course->course_name . ".";
        (new Notify)->createNotification($course, $notification_mssg);
        return redirect(route('instructor.post', $course->id));
    }
    public function mobileCreate($id)
    {
        $this->validate(request(), [
            'post_content' => 'required',

        ]);
        $user = User::findOrFail(Auth::id());
        $course = Course::findOrFail($id);
        $post = new Post;
        $post->course()->associate($course);
        $post->user()->associate($user);

        $post->post_content = request('post_content');

        if (auth()->user()->posts()->save($post)) {
            $notification_mssg = $user->name . " posted in " . $course->course_name . ".";
            (new Notify)->createNotification($course, $notification_mssg);
            return response()->json('done');
        } else {
            return response()->json('sorry', 500);
        }

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
        return redirect(route('instructor.post', $course->id));
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
