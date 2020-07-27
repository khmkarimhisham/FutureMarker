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
                <h5 class="card-title text-center">Edit Assignment</h5>

                <form method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="deadline">Deadline</label>
                        <input class="form-control" type="datetime-local" id="deadline" name="deadline"
                            value="{{ date('yy-m-d', strtotime($assignment['assignment_deadline']))."T".date('h:m', strtotime($assignment['assignment_deadline'])) }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="Title"
                            value="{{ $assignment['assignment_title'] }}" required>
                    </div>

                    <div class="form-group">
                        <textarea id="summernote" name="summernote" required>{!! $assignment['assignment_desc'] !!}</textarea>
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
                            placeholder="Permissible Attempts" min="1" max="99"
                            value="{{ $assignment['assignment_repetition'] }}" required>
                    </div>
                    <hr class="my-5">
                    <div class="form-group">
                        <label for="compileDegree">Compilation Mark</label>
                        <input type="number" id="compileDegree" name="compileDegree" class="form-control"
                            placeholder="Compilation Mark" min="0" max="100"
                            value="{{ $assignment['compilation_grade'] }}" onchange="checkMarks()" required>
                    </div>
                    <div class="form-group">
                        <label for="styleDegree">Style Mark</label>
                        <input type="number" id="styleDegree" name="styleDegree" class="form-control"
                            placeholder="Style Mark" min="0" max="100" value="{{ $assignment['style_grade'] }}"
                            onchange="checkMarks()" required>
                    </div>
                    <div class="form-group">
                        <label for="dynamicTestDegree">Dynamic Testing Mark</label>
                        <input type="number" id="dynamicTestDegree" name="dynamicTestDegree" class="form-control"
                            placeholder="Dynamic Testing Mark" min="0" max="100"
                            value="{{ $assignment['dynamic_test_grade'] }}" onchange="checkMarks()" required>
                    </div>
                    <div class="form-group">
                        <label for="featureTestDegree">Feature Testing Mark</label>
                        <input type="number" id="featureTestDegree" name="featureTestDegree" class="form-control"
                            placeholder="Feature Testing Mark" min="0" max="100"
                            value="{{ $assignment['feature_test_grade'] }}" onchange="checkMarks()" required>
                    </div>
                    <hr class="my-5">
                    @foreach($assignment['attachments'] as $key => $value)
                    <div class="alert alert-info">
                        <a href="{{ $value }}" download><strong>{{ $key }}</strong></a>
                    </div>
                    @endforeach
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
                        @foreach ($dynamicTests as $dynamicTest)
                        <div>
                            <div class='text-right'>
                                <a onclick='removeElement(this)'>
                                    <div class='fa fa-times'></div>
                                </a>
                            </div>
                            <div class='form-label-group'>
                                <label for='DynamicInput'>Input</label>
                                <input type='text' id='DynamicInput' name='DynamicInput[]' class='form-control'
                                    placeholder='Enter your inputs separated by space'
                                    value="{{ $dynamicTest['input'] }}">
                            </div>
                            <div class='form-label-group'>
                                <label for='DynamicOutput'>Output</label>
                                <input type='text' id='DynamicOutput' name='DynamicOutput[]' class='form-control'
                                    placeholder='Enter your output' value="{{ $dynamicTest['output'] }}" required>
                            </div>
                            <div>
                                @if ($dynamicTest['hidden'])
                                <input type='checkbox' id='DynamicHidden' name='DynamicHidden[]' value='true'
                                    onchange='isHidden(this)' checked> &nbsp;
                                <input type='hidden' id='DynamicHidden2' name='DynamicHidden[]' value='false'>
                                <label for='DynamicHidden'>Hide Input & Output</label>
                                @else
                                <input type='checkbox' id='DynamicHidden' name='DynamicHidden[]' value='true'
                                    onchange='isHidden(this)'> &nbsp;
                                <input type='hidden' id='DynamicHidden2' name='DynamicHidden[]' value='false'>
                                <label for='DynamicHidden'>Hide Input & Output</label>
                                @endif
                            </div>
                            <hr>

                        </div>
                        @endforeach


                    </div>
                    <div class="text-right">
                        <button class="btn text-white" type="button" onclick="addtoform()">
                            <div class="fa fa-plus"></div>
                        </button>
                    </div>

                    <hr class="my-5">

                    <h5 class="card-title text-left">Feature Testing</h5>
                    <input type="number" id="feature_number" name="feature_number" value="0" hidden>

                    <div id="mylocation2">
                        @foreach ($featureTests as $featureTest)
                        <div>
                            <div class='text-right'>
                                <a onclick='removeElement(this)'>
                                    <div class='fa fa-times'></div>
                                </a>
                            </div>
                            <div class='form-group'>
                                <div class='row'>
                                    <div class='col'>
                                        <label for='featureTest'>Choose Type</label>
                                        <select id='featureTest' name='featureTest[]' class='form-control'
                                            onchange='changeRegex(this)' required>
                                            <option value='{{ $featureTest['test_name'] }}' selected>
                                                {{ $featureTest['test_name'] }}</option>
                                            <option value='if statement'>if statement</option>
                                            <option value='else statement'>else statement</option>
                                            <option value='else if statement'>else if statement</option>
                                            <option value='while loop'>While Loop</option>
                                            <option value='for loop'>For Loop</option>
                                            <option value='switch statements'>Switch Statement</option>
                                            <option value='Other'>Other</option>
                                        </select>
                                    </div>

                                    <div class='col'>
                                        <label for='repetition'>Repetition Count</label>
                                        <input type='number' id='repetition' name='repetition[]' class='form-control'
                                            value='{{ $featureTest['repetition'] }}' required>
                                    </div>
                                    
                                </div>
                                <div class='form-group'>
                                    <label for='regex'>Regular Expretions</label>
                                    <textarea class='form-control' id='regex' name='regex[]' rows='3' required>{{ $featureTest['regex'] }}</textarea>
                                </div>
                            </div>
                            <hr>

                        </div>
                        @endforeach
                    </div>

                    <div class="text-right">
                        <button type="button" class="btn text-white" onclick="addtoform2()">
                            <div class="fa fa-plus"></div>
                        </button>
                    </div>

                    <hr class="my-5">
                    <div class="text-right">
                        <button type="submit" name="submit" class="btn text-white">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection