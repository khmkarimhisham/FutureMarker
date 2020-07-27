
@extends('layouts.studentNavbar')

@section('content')

<div class="row">
    @include('layouts.studentCourseBar')
    
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">

                <h4><strong><a href="{{ route('student.course',$course['id']) }}">{{ $course['course_name'] }}</a> ➥
                    Members</strong></h4>
                    <hr class="mt-1 mb-4">
                    <table class="table table-sm table-light ">
                    @foreach ($users as $User)
                    <tr class="table-active ">
                    <a href="{{ route('student.userprofile',$User['id']) }}"><img src="{{ asset($User['image']) }}" width="30" height="30">
                            {{ $User['name'] }}</a> </tr>
                    <hr class="my-2 ">
                    @endforeach
                </table>
            </div>
        </div>
    </div>

@endsection