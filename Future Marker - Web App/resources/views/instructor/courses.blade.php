@extends('layouts.instructorNavbar')

@section('content')


<div class="text-right">
    <button type="button" class="btn text-white" data-toggle="modal" data-target="#addForm">Create New
        Course
    </button>
</div>

<div class="modal fade" id="addForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="exampleModalLabel">Create New Course</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="course_name">CourseName</label>
                        <input type="text" class="form-control" name="course_name" id="course_name" required>
                    </div>
                    <div class="form-group">
                        <label for="course_desc">Course Description</label>
                        <textarea class="form-control" rows="4" name="course_desc" id="course_desc" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="course_image">Course Image</label>
                        <input type="file" name="course_image" id="course_image" accept="image/*"
                            required>
                    </div>
                </div>
                <div class="modal-footer border-top-0 d-flex justify-content-center">
                    <button type="submit" class="btn text-white">Submit</button>
                </div>
            </form>
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
        <a href="{{ route('instructor.course',$course['id']) }}">
            <div class="card my-4 text-center shadow bg-white rounded">
                <img class="card-img-top" style="height: 200px;" src="{{ asset($course['course_image']) }}">
                <div class="card-body">
                    <h4 class="card-title">{{ $course['course_name'] }}</h4>
                </div>
            </div>
        </a>
    </div>
    @endforeach

</div>


@endsection