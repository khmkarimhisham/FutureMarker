@extends('layouts.studentNavbar')

@section('content')

<div class="row">
    @include('layouts.studentCourseBar')

    <div class="col-md-5 mb-4 mb-md-0">
        <div class="card">
            <div class="card-body">
                <div>
                    <h4><strong>{{ $course['course_name'] }}</strong></h4>
                </div>
                <div>
                    <p>{{ $course['course_desc'] }}</p>
                </div>
                <div>
                    <label>Access Code : {{ $course['course_access_code'] }}</label>
                </div>
                <hr class="my-2 ">
                <div class="container">
                    @if (empty($material))
                    <div class="text-center">
                        <h3 class="py-3 lightX">Here you're going to see the course materials, and you can add materials
                            from the three points above.</h3>
                        <img class="border-0" src="{{ asset('images/materials.png') }}" width="200" height="200">
                    </div>
                    @endif
                    {!! $material !!}
                </div>
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
                    {{ $assignment['assignment_deadline'] }}
                    <hr class="my-1">
                    <img src="/images/assignment_image.png" width="20" height="20">
                    <a
                        href="{{ route('student.assignment',$assignment['id']) }}">{{ $assignment['assignment_title'] }}</a><br><br>
                    @endforeach

                    <h5><strong><i class="fa fa-clock-o" aria-hidden="true"></i> Quizzes</strong></h5>
                    <hr class="my-2">

                    @if($quizzes->count() == 0)
                    <label>There are no Quizzes</label>
                    @endif

                    @foreach($quizzes as $quiz)
                    {{ $quiz['quiz_deadline'] }}
                    <hr class="my-1">
                    <img src="/images/quiz_image.png" width="20" height="20">
                    <a href="{{ route("student.start.quiz",$quiz['id']) }}">{{ $quiz['quiz_title'] }}</a><br><br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection