@extends('layouts.instructorNavbar')

@section('content')
<script type="text/javascript" src="{{ asset('js/create_assignment.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/like_btn.js') }}"></script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote-lite.min.js"></script>


<div class="row">
    @include('layouts.instructorCourseBar')
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <h4><strong><a href="{{ route('instructor.course',$course['id']) }}">{{ $course['course_name'] }}</a> ➥
                        Posts</strong></h4>
                <hr class="my-1">
                <form id="post_form" method="post" enctype="multipart/form-data">

                    @csrf
                    <div class="form-group">
                        <textarea id="summernote" name="summernote" required></textarea>
                        <script>
                            $('#summernote').summernote({
                                    placeholder: 'Descraption',
                                    tabsize: 10,
                                    height: 200,
                                    toolbar: [
                                        ['style', ['style']],
                                        ['font', ['bold', 'underline', 'clear']],
                                        ['color', ['color']],
                                        ['para', ['ul', 'ol', 'paragraph']],
                                        ['table', ['table']],
                                        ['insert', ['link', 'picture', 'video']],
                                        ['view', ['fullscreen', 'codeview', 'help']]
                                    ]
                                });
                        </script>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="attachmentFiles">Upload Attachment</label>
                            </div>
                            <div class="col">
                                <input type="file" class="form-control-file" id="attachmentFiles"
                                    name="attachmentFiles[]" multiple>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" form="post_form" class="btn text-white">Post</button>
                    </div>
                </form>

                <hr class="my-5">

                @foreach($posts as $post)
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <a href="{{ route('instrutor.userprofile',$post['user']['id']) }}"><img
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
                                <a href="{{ route('instrutor.userprofile',$comment['user']['id']) }}"><img
                                        src="{{asset($comment['user']['image'])}}" width="30" height="30">
                                    {{ $comment['user']['name'] }}</a>
                            </div>
                            <div class="col ">
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
                                action="{{ route('instructor.comment',$post['id']) }}">
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