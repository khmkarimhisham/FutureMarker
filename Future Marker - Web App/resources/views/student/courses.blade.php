@extends('layouts.studentNavbar')

@section('content')



<div class="text-right">
    <button type="button" class="btn text-white" data-toggle="modal" data-target="#joinForm">
        Join Course
    </button>
</div>


<div class="modal fade" id="joinForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="exampleModalLabel">Join Course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <input class="form-control" id="access_code" name="access_code"
                                placeholder="Enter Access Code" require>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 d-flex justify-content-center">
                        <button class="btn text-white">Join</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@if ($courses->isEmpty())
<div class="text-center">
    <h3 class="py-3 lightX">Here you're going to see your courses.</h3>
    <img class="border-0" src="{{ asset('images/online-learning.png') }}" width="100%" height="auto" style=" max-width: 400px;">
</div>
@endif

<div class="row">
    @foreach($courses as $course)
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <a href="{{ route('student.course',$course['id']) }}">
            <div class="card my-4 text-center shadow bg-white rounded">
                <img class="card-img-top" style="height: 200px;"  src="{{ asset($course['course_image']) }}">
                <div class="card-body">
                    <h4 class="card-title">{{ $course['course_name'] }}</h4>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>

@endsection