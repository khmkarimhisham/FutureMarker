
@extends('layouts.studentNavbar')

@section('content')

<div class="row">

    <div class="col-md-4">
        <div class="card mb-4 mb-md-0">
            <div class="card-body">

                <div class="text-center mb-4">
                    <img src="{{ asset($usrProfile['image']) }}" width="240" height="240"
                        class="avatar img-circle img-thumbnail" alt="avatar">

                </div>

                <div>
                    <label><strong><i class="fa fa-graduation-cap" aria-hidden="true"></i> {{ $usrProfile['name']}}'s Courses</strong></label>
                </div>

                <hr class="mt-0">

                @foreach ($usrProfile->Courses as $course)
                <div class="mb-3">

                    <a href="{{ route('student.course', $course['id']) }}"> <img
                            src="{{ asset($course['course_image']) }}" width="40" height="40">
                        {{ $course['course_name'] }}</a>

                </div>

                @endforeach

            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">


                <div class="row">
                    <div class="col">
                        <h4> <span class="label label-default">Personal Information</span></h4>

                    </div>

                    <div class="col">
                        <div class="text-right">
                            <a href="#" class="btn text-white">Message</a>
                        </div>
                    </div>
                </div>
                <hr class="my-1">
                <div>
                    <h6><strong>Name:</strong> {{ $usrProfile['name']}}</h6>
                </div>

                <div>
                    <h6><strong>Bio: </strong>{{ $usrProfile['bio']}}</h6>
                </div>
                <br>
                <h4> <span class="label label-default">Contact Information</span></h4>
                <hr class="my-1">
                <div>
                    <h6><strong>Email:</strong> {{ $usrProfile['email']}}</h6>
                </div>

                <div>
                    <h6><strong>Phone: </strong>{{ $usrProfile['phone']}}</h6>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection