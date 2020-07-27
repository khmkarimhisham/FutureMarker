@extends('layouts.studentNavbar')

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
                            <a href="{{ route('student.userprofile',$post['user']['id']) }}"><img src="{{asset($post['user']['image'])}}" width="30" height="30">
                                {{ $post['user']['name'] }}</a> ➥ <a
                                href="{{ route('student.course',$post['course']['id']) }}">{{ $post['course']['course_name'] }}</a>
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
                                <a href="{{ route('student.userprofile',$comment['user']['id']) }}"><img src="{{asset($comment['user']['image'])}}" width="30" height="30">
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

    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="raw">
                    <h5><strong>Upcoming</strong></h5>
                    <hr class="my-2">


                    <h5><strong><i class="fa fa-file-code-o" aria-hidden="true"></i> Assignments</strong></h5>
                    <hr class="my-2">
                    @if($assignments->count() == 0)
                    <label>There are no Assignments</label>
                    @endif

                    @foreach($assignments as $assignment)
                    <div class="mb-3">
                        {{ $assignment['assignment_deadline'] }}
                        <hr class="my-1">
                        <img src="/images/assignment_image.png" width="20" height="20">
                        <a
                            href="{{ route('student.assignment',$assignment['id']) }}">{{ $assignment['assignment_title'] }}</a>
                        ➥
                        <a
                            href="{{ route('student.course',$assignment['course']['id']) }}">{{ $assignment['course']['course_name'] }}</a>
                    </div>
                    @endforeach

                    <h5><strong><i class="fa fa-clock-o" aria-hidden="true"></i> Quizzes</strong></h5>
                    <hr class="my-2">

                    @if($quizzes->count() == 0)
                    <label>There are no Quizzes</label>
                    @endif

                    @foreach($quizzes as $quiz)
                    <div class="mb-3">
                        {{ $quiz['quiz_deadline'] }}
                        <hr class="my-1">
                        <img src="/images/quiz_image.png" width="20" height="20">
                        <a href="{{ route("student.start.quiz",$quiz['id']) }}">{{ $quiz['quiz_title'] }}</a>
                        ➥
                        <a
                            href="{{ route('student.course',$quiz['course']['id']) }}">{{ $quiz['course']['course_name'] }}</a>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>




@endsection