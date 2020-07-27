@extends('layouts.studentNavbar')

@section('content')
<div class="col">
    <div class="card">
        <div class="card-body">

            <h4 class="text-center"><strong>Courses Grades</strong></h4>
            <hr class="my-1">
            <?php $i=0?>
            @foreach($courses as $course)
            <a href="{{ route('student.course',$course['id']) }}"><h3 class="text-center mt-5 mb-3">{{ $course['course_name'] }}</h3></a>
            <div class="table-responsive">
                <table class="table table-bordered">

                    <thead>
                        <tr class="main-color">
                            <th class="text-center w-50">Assignments</th>
                            <th class="text-center w-50">Total Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($finishedAssignments[$i] as $finishedAssignment)
                        <tr>
                            <th class="text-center w-50">
                                <a href="{{ route('student.assignment',$finishedAssignment->assignment['id'] ) }}">
                                    {{ $finishedAssignment->assignment['assignment_title']  }}
                                </a>
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
                        @foreach ($finishedQuizzes[$i] as $finishedquiz)
                        <tr>
                            <th class="text-center w-50">
                                <a href="{{ route('student.quiz',$finishedquiz->quiz['id'] ) }}">
                                    {{ $finishedquiz->quiz['quiz_title']  }}
                                </a>
                            </th>
                            <th class="text-center w-50">
                                {{ $finishedquiz['quiz_grade']  }}
                                / {{ $finishedquiz->quiz['quiz_grade'] }}</th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <?php $i++?>
            @endforeach

        </div>
    </div>
</div>
@endsection