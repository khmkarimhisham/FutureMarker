@extends('layouts.instructorNavbar')

@section('content')

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4 mb-md-0">
            <div class="card-body">
                <div>
                    <h4><strong><i class="fa fa-picture-o" aria-hidden="true"></i> Posts</strong></h4>
                </div>

                <hr class="mt-2 mb-4 ">
                @if ($posts->isEmpty())
                <div class="text-center">
                    <h3 class="py-3 lightX">Here you're going to see the latest course updates.</h3>
                    <img class="border-0" src="{{ asset('images/empty_posts.png') }}" width="100%" height="auto"
                        style=" max-width: 300px;">
                </div>

                @endif

                @foreach($posts as $post)
                <div class="container">

                    <div class="row">
                        <div class="col">
                            <a href="{{ route('instrutor.userprofile',$post['user']['id']) }}"><img
                                    src="{{asset($post['user']['image'])}}" width="30" height="30">
                                {{ $post['user']['name'] }}</a> ➥ <a
                                href="{{ route('instructor.course',$post['course']['id']) }}">{{ $post['course']['course_name'] }}</a>
                        </div>
                        <div class="col">
                            <div class="text-right">
                                <p>{{$post['created_at']}}</p>
                            </div>
                        </div>
                    </div>
                    <hr class="mt-1 mb-3">

                    {!!$post['post_content']!!}
                    @foreach($post['post_attachmentFiles'] as $key => $value)
                    <div class="alert alert-info">
                        <a href="{{ $value }}" download><strong>{{ $key }}</strong></a>
                    </div>
                    @endforeach

                    <hr class="mt-1 mb-4">
                    <!-- Single Comment -->
                    @foreach($post['comments'] as $comment)
                    <div class="container mx-4">
                        <div class="row m-auto">
                            <div class="col">
                                <a href="{{ route('instrutor.userprofile',$comment['user']['id']) }}"><img
                                        src="{{asset($comment['user']['image'])}}" width="30" height="30">
                                    {{ $comment['user']['name'] }}</a>
                            </div>
                            <div class="col">
                                <div class="text-right">
                                    <p>{{ $comment['created_at'] }}</p>
                                </div>
                            </div>
                        </div>
                        <hr class="my-0">
                        <div class="media-body mx-3">
                            {{ $comment['comment_content'] }}
                        </div>
                    </div>
                    <hr>
                    @endforeach

                    <!-- Comments Form -->
                    <div class="card my-4">
                        <h5 class="card-header">Leave a Comment:</h5>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data"
                                action="{{ route('instructor.home.comment',$post['id']) }}">
                                @csrf
                                <div class="form-group">
                                    <textarea class="form-control" rows="2" id="comment" name="comment" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Comment</button>
                            </form>
                        </div>
                    </div>
                </div>
                <hr class="my-5">

                @endforeach

            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="raw">
                    <h5><strong><i class="fa fa-graduation-cap" aria-hidden="true"></i> Courses</strong></h5>
                    <hr class="mt-2 mb-4 ">

                    @if ($courses->isEmpty())
                    <div class="text-center">
                        <h3 class="py-3 lightX">Here you're going to see your courses.</h3>
                        <img class="border-0" src="{{ asset('images/online-learning.png') }}" width="100%" height="auto"
                            style=" max-width: 300px;">
                    </div>

                    @endif

                    @foreach ($courses as $course)

                    <div class="mb-2">
                        <img src="{{ asset($course['course_image']) }}" width="40" height="40">
                        <a
                            href="{{ route('instructor.course', $course['id']) }}"><strong>{{ $course['course_name'] }}</strong></a>
                    </div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection