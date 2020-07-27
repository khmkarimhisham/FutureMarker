@extends('layouts.instructorNavbar')

@section('content')

<div class="row">
    @include('layouts.instructorCourseBar')
    <div class="col-md-6 mb-4 mb-md-0">
        <div class="card">
            <div class="card-body">

                <h4><strong><a href="{{ route('instructor.course',$course['id']) }}">{{ $course['course_name'] }}</a> ➥ {{ $quiz['quiz_title'] }}</strong></h4>

                <div class="row">
                    <div class="col">
                        <label><strong>Due:</strong> {{ $quiz['quiz_deadline'] }}</label>
                    </div>
                    <div class="col">
                        <label><strong>Posted In:</strong> {{ $quiz['created_at'] }}</label>
                    </div>
                </div>
                <label><strong>Permissible Attempts:</strong>&nbsp;&nbsp;{{ $quiz['quiz_repetition'] }} </label>
                <hr class="mt-1 mb-4">

                @php
                $i = 1;
                @endphp

                @foreach ($quiz->quizQuestions as $question)


                <label><strong>Question {{ $i++ }}: </strong>{{ $question->question }}</label><br>

                <label><strong>Answer 1: </strong> {{ $question->answer_one }}</label><br>

                <label><strong>Answer 2: </strong> {{ $question->answer_two }}</label><br>

                @if ($question->answer_three!= null)
                <label><strong>Answer 3: </strong> {{ $question->answer_three }}</label><br>
                @endif

                @if ($question->answer_four!= null)
                <label><strong>Answer 4: </strong> {{ $question->answer_four }}</label><br>
                @endif

                <hr class="my-2">
                @endforeach

            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5><strong>Quiz Results</strong></h5>
                <hr class="mt-2 mb-3">
                @foreach ($finishedQuizzes as $finishedQuiz)
                <div class="mb-3">
                    <a href="{{ route('instrutor.userprofile',$finishedQuiz->user['id']) }}"><img
                            src="{{ asset($finishedQuiz->user['image']) }}" width="30" height="30">
                        {{ $finishedQuiz->user['name'] }}</a>

                    <label><strong>{{ $finishedQuiz->quiz_grade }}%</strong></label>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection