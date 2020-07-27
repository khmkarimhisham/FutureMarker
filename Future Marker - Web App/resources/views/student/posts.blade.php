@extends('layouts.studentNavbar')

@section('content')

<div class="row">
    @include('layouts.studentCourseBar')
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <h4><strong><a href="{{ route('student.course',$course['id']) }}">{{ $course['course_name'] }}</a> ➥
                        Posts</strong></h4>
                <hr class="mt-1 mb-4">

                @foreach($posts as $post)
                <div class="container">

                    <div class="row">
                        <div class="col">
                            <a href="{{ route('student.userprofile',$post['user']['id']) }}"><img
                                    src="{{asset($post['user']['image'])}}" width="30" height="30">
                                {{ $post['user']['name'] }}</a>
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
                                <a href="{{ route('student.userprofile',$comment['user']['id']) }}"><img
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
                                action="{{ route('student.home.comment',$post['id']) }}">
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
</div>

@endsection