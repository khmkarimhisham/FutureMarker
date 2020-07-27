@extends('layouts.instructorNavbar')

@section('content')

<div class="row">
    @include('layouts.instructorCourseBar')
    <div class="col-md-6 mb-4 mb-md-0">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-10">
                        <h4><strong><a href="{{ route('instructor.course',$course['id']) }}">{{ $course['course_name'] }}</a> ➥ {{ $assignment['assignment_title'] }}</strong></h4>
                    </div>
                    <div class="col-2">
                        <div class="dropdown">
                            <div class="text-right">
                                <a href="#" id="dropdownMenuButton" data-toggle="dropdown"><i class="fa fa-ellipsis-v"
                                        style="font-size: 28px"></i></a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item"
                                        href="{{ route('instructor.edit.assignment',$assignment['id']) }}"
                                        name="edit">Edit</a>
                                    {{-- <a class="dropdown-item" href="{{ route('instructor.delete.assignment',$assignment['id']) }}"
                                    name="delete">Delete</a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-2 ">
                <div class="row">
                    <div class="col">
                        <label><strong>Due:</strong> {{ $assignment['assignment_deadline'] }}</label>
                    </div>
                    <div class="col">
                        <label><strong>Posted In:</strong> {{ $assignment['created_at'] }}</label>
                    </div>
                </div>
                <hr class="mt-0">

                <h6><strong>Description:</strong></h6>
                <hr class="mt-0">

                <div class="container">

                    {!! $assignment['assignment_desc'] !!}

                </div>
                @foreach($assignment['attachments'] as $key => $value)
                <div class="alert alert-info">
                    <a href="{{ $value }}" download><strong>{{ $key }}</strong></a>
                </div>
                @endforeach
                <hr>
                <h6><strong>Permissible Attempts:</strong> {{ $assignment['assignment_repetition'] }} </h6>
                <hr>
                <h6><strong>Compilation Mark:</strong> {{ $assignment['compilation_grade'] }} </h6>
                <hr>
                <h6><strong>Style Mark:</strong> {{ $assignment['style_grade'] }} </h6>
                <hr>
                <h6><strong>Dynamic Testing Mark:</strong> {{ $assignment['dynamic_test_grade'] }} </h6>
                <hr>
                <h6><strong>Feature Testing Mark:</strong> {{ $assignment['feature_test_grade'] }} </h6>
                @if (count($dynamicTests) != 0)
                <hr>
                <h6><strong>Dynamic Tests:</strong></h6>
                <hr class="mt-0 mb-2">
                @foreach ($dynamicTests as $dynamicTest)
                <label>Input: {{ $dynamicTest->input }}</label><br>
                <label>Output: {{ $dynamicTest->output }}</label><br>
                <label>Hidden: {{ $dynamicTest->hidden }}</label><br>
                <hr class="my-2">
                @endforeach
                @endif

                @if (count($featureTests) != 0)
                <hr>
                <h6><strong>Feature Tests:</strong></h6>
                <hr class="mt-0 mb-2">
                @foreach ($featureTests as $featureTest)
                <label>Feature: {{ $featureTest->test_name }}</label><br>
                <label>Regular Expretions: {{ $featureTest->regex }}</label><br>
                <label>Repetition: {{ $featureTest->repetition }}</label><br>
                <hr class="my-2">
                @endforeach
                @endif

            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="raw">
                    <h5><strong>Submitted Assignments</strong></h5>
                    <hr class="my-2">
                    @foreach ($submitedAssignments as $submitedAssignment)
                    <div class="my-3">
                        <a href="{{ route('instructor.submited.assignment',$submitedAssignment->id) }}"><img
                                src="{{ asset($submitedAssignment->user['image']) }}" width="30" height="30">
                            {{ $submitedAssignment->user['name'] }}</a>
                        <label><strong>{{ $submitedAssignment['compilation_grade'] + $submitedAssignment['style_grade'] + $submitedAssignment['dynamic_test_grade'] + $submitedAssignment['feature_test_grade'] }}%</strong></label>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection