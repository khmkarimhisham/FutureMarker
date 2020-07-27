@extends('layouts.instructorNavbar')

@section('content')

<div class="row">
    @include('layouts.instructorCourseBar')
    <div class="col-md-5 mb-4 mb-md-0">
        <div class="card">
            <div class="card-body">
                <h4><strong><a href="{{ route('instructor.course',$course['id']) }}">{{ $course['course_name'] }}</a> ➥
                        Assignments</strong></h4>
                <hr class="mt-1 mb-4">

                @foreach ($assignments as $assignment)
                <a href="{{ route('instructor.assignment',$assignment['id']) }}">
                    <h5>{{ $assignment->assignment_title }}</h5>
                </a>
                <hr class="mt-1 mb-3">
                @foreach ($assignment->finishedAssignments as $finishedAssignments)
                <div class="mb-1">
                    <a href="{{ route('instructor.submited.assignment',$finishedAssignments->id) }}"><img
                            src="{{ asset($finishedAssignments->user['image']) }}" width="30" height="30">
                        {{ $finishedAssignments->user['name'] }}</a>
                    <label><strong>{{ $finishedAssignments['compilation_grade'] + $finishedAssignments['style_grade'] + $finishedAssignments['dynamic_test_grade'] + $finishedAssignments['feature_test_grade'] }}%</strong></label>
                </div>
                
                @endforeach
                <hr>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h4><strong><a href="{{ route('instructor.course',$course['id']) }}">{{ $course['course_name'] }}</a> ➥
                    Quizzes</strong></h4>
            <hr class="mt-1 mb-4">

            @foreach ($quizzes as $quiz)
            <a href="{{ route('instructor.quiz',$quiz['id']) }}">
                <h5>{{ $quiz->quiz_title }}</h5>
            </a>
            <hr class="mt-1 mb-3">
            @foreach ($quiz->finishedQuizzes as $finishedQuiz)
            <div class="mb-1">
                <a href="{{ route('instrutor.userprofile',$finishedQuiz->user['id']) }}"><img
                        src="{{ asset($finishedQuiz->user['image']) }}" width="30" height="30">
                    {{ $finishedQuiz->user['name'] }}</a>
                <label><strong>{{ $finishedQuiz['quiz_grade']}}%</strong></label>
            </div>
            @endforeach
            <hr>
            @endforeach
            </div>
        </div>
    </div>
</div>

@endsection