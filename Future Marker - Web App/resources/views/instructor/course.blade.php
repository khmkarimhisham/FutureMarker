@extends('layouts.instructorNavbar')

@section('content')

<div class="row">
    @include('layouts.instructorCourseBar')
    <div class="col-md-5 mb-4 mb-md-0">
        <div class="card">
            <div class="card-body">
                <div>
                    <div class="row">
                        <div class="col-10">
                            <h4><strong>{{ $course['course_name'] }}</strong></h4>
                        </div>
                        <div class="col-2">
                            <div class="dropdown">
                                <div class="text-right">
                                    <a href="#" id="dropdownMenuButton" data-toggle="dropdown"><i
                                            class="fa fa-ellipsis-v" style="font-size: 28px"></i></a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#" name="createfolder" data-toggle="modal"
                                            data-target="#createfolder">Create Folder</a>
                                        <a class="dropdown-item" href="#" name="uploadfile" data-toggle="modal"
                                            data-target="#uploadfile">Upload File</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>{{ $course['course_desc'] }}</p>
                    </div>
                    <div>
                        <label><strong>Access Code : </strong> {{ $course['course_access_code'] }}</label>
                    </div>
                    <div class="modal fade" id="uploadfile" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header border-bottom-0">
                                    <h5 class="modal-title" id="exampleModalLabel">Upload File</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="POST" action="{{ route('instructor.course.upload', $course->id) }}"
                                    enctype="multipart/form-data">
                                    <div class="modal-body text-center">
                                        @csrf
                                        <div class="form-group">
                                            <select name="folder" class="browser-default custom-select" required>
                                                <option value="">- Select Folder -

                                                    @foreach($course['Folders'] as $folder)
                                                <option value="{{ $folder }}">{{ $folder }}
                                                    @endforeach

                                            </select>

                                        </div>
                                        <div class="form-group">
                                            <label for="uploadedfiles">Choose file</label>
                                            <input type="file" id="uploadedfiles" name="uploadedfiles[]"
                                                class="text-center center-block file-upload" style="margin-left: 40px;"
                                                multiple required>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-top-0 d-flex justify-content-center">
                                        <button type="submit1"
                                            class="btn btn-outline-secondary text-white">Upload</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="createfolder" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header border-bottom-0">
                                    <h5 class="modal-title" id="exampleModalLabel">Create Folder</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post" action="{{ route('instructor.course.create', $course->id) }}"
                                    enctype="multipart/form-data">



                                    <div class="modal-body text-center">
                                        @csrf
                                        <input type="text" id="Select" name="Select" class="form-control" value="2"
                                            hidden>

                                        <div class="form-group">
                                            <label for="foldername">Folder Name</label>
                                            <input type="text" class="form-control" name="foldername" id="foldername"
                                                placeholder="Folder Name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="folderfile">Choose file</label>
                                            <input type="file" id="folderfile" name="folderfile[]"
                                                class="text-center center-block file-upload" style="margin-left: 40px;"
                                                multiple>
                                        </div>



                                    </div>
                                    <div class="modal-footer border-top-0 d-flex justify-content-center">
                                        <button type="submit"
                                            class="btn btn-outline-secondary text-white">Create</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-2 ">
                <div class="container">
                    @if (empty($material))
                    <div class="text-center">
                        <h3 class="py-3 lightX">Here you're going to see the course materials, and you can add materials
                            from the three points above.</h3>
                        <img class="border-0" src="{{ asset('images/materials.png') }}" width="200" height="200">
                    </div>
                    @endif
                    {!! $material !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="raw">
                    <h5><strong><i class="fa fa-file-code-o" aria-hidden="true"></i> Assignments</strong></h5>
                    <hr class="my-2">
                    @if($assignments->count() == 0)
                    <label>There are no Assignments</label>
                    @endif

                    @foreach($assignments as $assignment)
                    {{ $assignment['assignment_deadline'] }}
                    <hr class="my-1">
                    <img src="/images/assignment_image.png" width="20" height="20">
                    <a
                        href="{{ route('instructor.assignment',$assignment['id']) }}">{{ $assignment['assignment_title'] }}</a><br><br>
                    @endforeach


                    <h5><strong><i class="fa fa-clock-o" aria-hidden="true"></i> Quizzes</strong></h5>
                    <hr class="my-2">

                    @if($quizzes->count() == 0)
                    <label>There are no Quizzes</label>
                    @endif

                    @foreach($quizzes as $quiz)
                    {{ $quiz['quiz_deadline'] }}
                    <hr class="my-1">
                    <img src="/images/quiz_image.png" width="20" height="20">
                    <a href="{{ route('instructor.quiz',$quiz['id']) }}">{{ $quiz['quiz_title'] }}</a><br><br>
                    @endforeach



                    <div class="text-center">
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('instructor.create.quiz',$course['id']) }}"
                                    class="btn text-white px-4">Create Quiz</a>
                            </div>
                            <div class="col">
                                <a href="{{ route('instructor.create.assignment',$course['id']) }}"
                                    class="btn text-white">Create Assignmnet</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="js/php_file_tree.js" type="text/javascript"></script>

@endsection