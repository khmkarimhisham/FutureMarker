@extends('layouts.studentNavbar')

@section('content')

<div class="row">
    @include('layouts.studentCourseBar')

    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <div class="mt-5">
                    <h1>{{ $quiz->quiz_title }}</h1>
                    <label><strong>Duration: {{ $quiz->quiz_duration }} MIN</strong></label>
                    <hr>
                    <div class="row">
                        <div class="col-8">
                            <label><strong>DUE:</strong>&nbsp;&nbsp;{{ $quiz->quiz_deadline }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <strong>Permissible Attempts:</strong>&nbsp;&nbsp;{{ $quiz->quiz_repetition }} </label>
                            <p>This is multiple choice system restricted by a specified time determined by the
                                instructor,
                                evaluating your marks directly after finishing or quitting it based on your answered
                                questions.</p>
                        </div>
                        <div class="col">
                            <div class="text-right">
                                <a href="{{ route('student.quiz', $quiz['id']) }}" class="btn text-white">Strat Quiz</a>
                            </div>
                        </div>
                    </div>

                    <hr class="mt-3">
                    <div class="row mt-4">
                        <div class="col">
                            <label><strong>Receive grade</strong></label>
                        </div>
                        <div class="col pr-4">
                            <div class="text-right">
                                <label><strong>Grade:</strong>&nbsp;&nbsp;{{ $grade }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection