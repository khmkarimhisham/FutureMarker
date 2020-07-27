@extends('layouts.instructorNavbar')

@section('content')
<script type="text/javascript" src="{{ asset('js/create_quiz.js') }}"></script>

<div class="row">
    @include('layouts.instructorCourseBar')

    <div class="col-9">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center">Create Quiz</h5>

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
                        <label for="duration">Duration in minutes</label>
                        <input type="number" id="duration" name="duration" class="form-control"
                            placeholder="Duration in minutes" min="1" max="180" required>
                    </div>

                    <div class="form-group">
                        <label for="attempts">Permissible Attempts</label>
                        <input type="number" id="attempts" name="attempts" class="form-control"
                            placeholder="Permissible Attempts" min="1" max="99" required>
                    </div>

                    <hr class="my-5">

                    <div id="mylocation">
                        <div>
                            <div class='form-label-group mt-3'>
                                <label for='question'>Question</label>
                                <input type='text' id='question' name='question[]' class='form-control'
                                    placeholder='Question' required>
                            </div>
                            <div class='form-label-group mt-3'>
                                <label for='answer1'>Answer 1</label>
                                <input type='text' id='answer1' name='answer1[]' class='form-control'
                                    placeholder='Answer' required>
                            </div>
                            <div class='form-label-group mt-3'>
                                <label for='answer2'>Answer 2</label>
                                <input type='text' id='answer2' name='answer2[]' class='form-control'
                                    placeholder='Answer' required>
                            </div>
                            <div class='form-label-group mt-3'>
                                <label for='answer3'>Answer 3</label>
                                <input type='text' id='answer3' name='answer3[]' class='form-control'
                                    placeholder='Answer'>
                            </div>
                            <div class='form-label-group mt-3'>
                                <label for='answer4'>Answer 4</label>
                                <input type='text' id='answer4' name='answer4[]' class='form-control'
                                    placeholder='Answer'>
                            </div>

                            <div class='form-group mt-3'>
                                <label for='model_answer'>Model Answer</label>
                                <select class="form-control" name="model_answer[]" id="model_answer">
                                    <option value="1">Answer 1</option>
                                    <option value="2">Answer 2</option>
                                    <option value="3">Answer 3</option>
                                    <option value="4">Answer 4</option>
                                </select>
                            </div>

                            <hr class='my-5'>
                        </div>

                    </div>
                    <div class="text-center">
                        <button class="btn text-white" type="button" onclick="addtoform()">Add Question</button>
                    </div>


                    <hr class="my-5">
                    <div class="text-right">
                        <button type="submit" name="submit" class="btn text-white">Submit</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>




@endsection