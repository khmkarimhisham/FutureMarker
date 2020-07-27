@extends('layouts.instructorNavbar')

@section('content')
<div class="row">

    <div class="col-md-4">
        <div class="card mb-4 mb-md-0">
            <div class="card-body">

                <div class="text-center mb-4">
                    <img src="{{ asset($user['image']) }}" width="240" height="240"
                        class="avatar img-circle img-thumbnail" alt="avatar">

                </div>

                <div>
                    <label><strong><i class="fa fa-graduation-cap" aria-hidden="true"></i> My Courses</strong></label>
                </div>

                <hr class="mt-0">

                @foreach ($courses as $course)
                <div class="mb-3">

                    <a href="{{ route('instructor.course', $course['id']) }}"> <img
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
                        <div class="container text-right">
                            <button type="submit" name="editprofile" class="btn btn-outline-secondary text-white"
                                data-toggle="modal" data-target="#editprofile">Edit Profile</button>
                        </div>

                        <div class="modal fade" id="editprofile" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header border-bottom-0">
                                        <h5 class="modal-title" id="exampleModalLabel">Update Profile</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('instructor.profile') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="profileimage">Upload Profile Image</label>
                                                <input type="file" id="profileimage" name="profileimage"
                                                    class="text-center center-block file-upload"
                                                    style="margin-left: 40px;" accept="image/*">
                                            </div>
                                            <div class="form-group">
                                                <label for="bio">Bio</label>
                                                <input type="text" class="form-control" name="bio" id="bio"
                                                    placeholder="Enter Bio">
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input type="tel" class="form-control" id="phone" name="phone"
                                                    placeholder="Enter your phone number" pattern="[0-9]{11}">
                                            </div>

                                        </div>
                                        <div class="modal-footer border-top-0 d-flex justify-content-center">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-1">
                <div>
                    <h6><strong>Name:</strong> {{ $user['name']}}</h6>
                </div>

                <div>
                    <h6><strong>Bio: </strong>{{ $user['bio']}}</h6>
                </div>
                <br>
                <h4> <span class="label label-default">Contact Information</span></h4>
                <hr class="my-1">
                <div>
                    <h6><strong>Email:</strong> {{ $user['email']}}</h6>
                </div>

                <div>
                    <h6><strong>Phone: </strong>{{ $user['phone']}}</h6>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection