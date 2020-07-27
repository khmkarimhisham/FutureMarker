@extends('layouts.studentNavbar')

@section('content')

<div class="row">
    @include('layouts.studentCourseBar')

    <div class="col-md-9">
        <div class="card">
            <div class="card-body">

                <h4><strong>{{ $course['course_name'] }} ➥ Grades</strong></h4>
                <hr class="my-1">
                <table class="table table-sm table-light ">
                    <thead>
                        <tr class="main-color">
                            <th class="text-center w-50">Assignments</th>
                            <th class="text-center w-50">Total Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($finishedAssignments as $finishedAssignment)
                        <tr>
                            <th class="text-center w-50"> <a href="{{ route('student.assignment',$finishedAssignment['assignment_id']) }}">{{ $finishedAssignment->assignment['assignment_title']  }}</a>
                            </th>
                            <th class="text-center w-50">
                                {{ $finishedAssignment['compilation_grade'] + $finishedAssignment['style_grade'] + $finishedAssignment['dynamic_test_grade'] + $finishedAssignment['feature_test_grade'] }}
                                / {{ $finishedAssignment->assignment['full_grade'] }}</th>
                        </tr>
                        @endforeach
                    </tbody>
                    <thead>
                        <tr class="main-color">
                            <th class="text-center w-50">Quizzes</th>
                            <th class="text-center w-50">Total Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($finishedQuizzes as $finishedquiz)
                        <tr>
                            <th class="text-center w-50"> {{ $finishedquiz->quiz['quiz_title']  }}</th>
                            <th class="text-center w-50">
                                {{ $finishedquiz['quiz_grade']  }}
                                / {{ $finishedquiz->quiz['quiz_grade'] }}</th>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    @endsection