@extends('layouts.instructorNavbar')

@section('content')
<script type="text/javascript" src="{{ asset('js/create_assignment.js') }}"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote-lite.min.js"></script>

<div class="row">
    @include('layouts.instructorCourseBar')
    <div class="col-9">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center">Create Assignment</h5>

                <form method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="deadline">Deadline</label>
                        <input class="form-control" type="datetime-local" id="deadline" name="deadline" required>
                    </div>

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="Title" required>
                    </div>

                    <div class="form-group">
                        <textarea id="summernote" name="summernote" required></textarea>
                        <script>
                            $('#summernote').summernote({
                                    placeholder: 'Descraption',
                                    tabsize: 10,
                                    height: 300,
                                    toolbar: [
                                        ['style', ['style']],
                                        ['font', ['bold', 'underline', 'clear']],
                                        ['color', ['color']],
                                        ['para', ['ul', 'ol', 'paragraph']],
                                        ['table', ['table']],
                                        ['insert', ['link', 'picture', 'video']],
                                        ['view', ['fullscreen', 'codeview', 'help']]
                                    ]
                                });
                        </script>
                    </div>
                    <div class="form-group">
                        <label for="attempts">Permissible Attempts</label>
                        <input type="number" id="attempts" name="attempts" class="form-control"
                            placeholder="Permissible Attempts" min="1" max="99" required>
                    </div>
                    <hr class="my-5">
                    <div class="form-group">
                        <label for="compileDegree">Compilation Mark</label>
                        <input type="number" id="compileDegree" name="compileDegree" class="form-control"
                            placeholder="Compilation Mark" min="0" max="100" value="10" onchange="checkMarks()"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="styleDegree">Style Mark</label>
                        <input type="number" id="styleDegree" name="styleDegree" class="form-control"
                            placeholder="Style Mark" min="0" max="100" value="20" onchange="checkMarks()" required>
                    </div>
                    <div class="form-group">
                        <label for="dynamicTestDegree">Dynamic Testing Mark</label>
                        <input type="number" id="dynamicTestDegree" name="dynamicTestDegree" class="form-control"
                            placeholder="Dynamic Testing Mark" min="0" max="100" value="40" onchange="checkMarks()"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="featureTestDegree">Feature Testing Mark</label>
                        <input type="number" id="featureTestDegree" name="featureTestDegree" class="form-control"
                            placeholder="Feature Testing Mark" min="0" max="100" value="30" onchange="checkMarks()"
                            required>
                    </div>
                    <hr class="my-5">
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="attachmentFiles">Upload Attachment</label>
                            </div>
                            <div class="col">
                                <input type="file" class="form-control-file" id="attachmentFiles"
                                    name="attachmentFiles[]" multiple>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="attach_model">Upload Model Answer</label>
                            </div>
                            <div class="col">
                                <input type="file" class="form-control-file" id="modelAnswerFiles"
                                    name="modelAnswerFiles[]" multiple>
                            </div>
                        </div>
                    </div>
                    <hr class="my-5">
                    <h5 class="text-left">Dynamic Testing</h5>


                    <div id="mylocation">

                    </div>
                    <div class="text-right">
                        <button class="btn text-white" type="button" onclick="addtoform()"><div class="fa fa-plus"></div></button>
                    </div>

                    <hr class="my-5">

                    <h5 class="card-title text-left">Feature Testing</h5>
                    <input type="number" id="feature_number" name="feature_number" value="0" hidden>

                    <div id="mylocation2">
                    </div>

                    <div class="text-right">
                        <button type="button" class="btn text-white" onclick="addtoform2()"><div class="fa fa-plus"></div></button>
                    </div>

                    <hr class="my-5">
                    <div class="text-right">
                        <button type="submit" name="submit" class="btn text-white">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection