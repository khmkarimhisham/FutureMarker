@extends('layouts.instructorNavbar')

@section('content')

<div class="row">
    @include('layouts.instructorCourseBar')
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <h4><strong><a href="{{ route('instructor.course',$course['id']) }}">{{ $course['course_name'] }}</a> ➥
                        Members</strong></h4>
                <hr class="mt-1 mb-4">
                <table class="table table-sm table-light ">
                    @foreach ($users as $user)
                    <tr class="table-active ">
                        <a href="{{ route('instrutor.userprofile',$user['id']) }}"><img
                                src="{{ asset($user['image']) }}" width="30" height="30">
                            {{ $user['name'] }}</a> </tr>
                    <hr class="my-2 ">
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>

@endsection