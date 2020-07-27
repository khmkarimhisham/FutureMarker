@extends('layouts.studentNavbar')

@section('content')

<div class="row">
    @include('layouts.studentCourseBar')
    <div class="col-md-5 mb-4 mb-md-0">
        <div class="card">
            <div class="card-body">
                <div>
                    <h4><strong><a href="{{ route('student.course',$course['id']) }}">{{ $course['course_name'] }}</a> ➥
                            {{ $assignment['assignment_title'] }} </strong></h4>

                </div>
                <hr class="my-2 ">
                <div class="row">
                    <div class="col">
                        <label><strong>Due:</strong> {{ $assignment['assignment_deadline'] }}</label>

                    </div>
                    <div class="col">
                        <label><strong>Permissible
                                Attempts:</strong>&nbsp;&nbsp;{{ $assignment->assignment_repetition }}</label>
                    </div>
                </div>

                <hr>
                <div class="container">

                    {!! $assignment['assignment_desc'] !!}

                </div>
                @foreach($assignment['attachments'] as $key => $value)
                <div class="alert alert-info">
                    <a href="{{ $value }}" download><strong>{{ $key }}</strong></a>
                </div>
                @endforeach
                <hr>
                <div>
                    <label><strong>Posted In: </strong>{{ $assignment['created_at'] }}</label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="raw">
                    <h5><strong>Submitted Assignmnets</strong></h5>
                    <hr class="mt-1 mb-3">

                    <?php $i = 1; ?>
                    @foreach($submitedAssignment as $submitedAssignment)
                    <div class="mb-3">
                        {{ $submitedAssignment['created_at'] }}
                        <img src="/images/assignment_image.png" width="20" height="20">
                        <a href="{{ route('student.submited.assignment',$submitedAssignment['id']) }}">Submition
                            {{ $i++ }}</a>

                    </div>

                    @endforeach


                    <div class="text-center">
                        <button type="submit" class="btn text-white" data-toggle="modal"
                            data-target="#Submitform">Submit Assignmnet</button>
                    </div>

                    <div class="modal fade" id="Submitform" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header border-bottom-0">
                                    <h5 class="modal-title" id="exampleModalLabel">Upload Assignment File</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="POST" enctype="multipart/form-data"
                                    action="{{ route('student.submit.assignment', $assignment['id']) }}">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="assignmentFiles"><strong>Assignment Files:</strong></label>
                                            <input type="file" name="assignmentFiles[]" id="assignmentFiles"
                                                accept=".java" required multiple>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-top-0 d-flex justify-content-center">
                                        <button type="submit" class="btn text-white">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection