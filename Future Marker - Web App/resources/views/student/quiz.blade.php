<!doctype html>

<html>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="{{ asset('CSS/navbar.css') }}" rel="stylesheet">
    <link href="{{ asset('CSS/main.css') }}" rel="stylesheet">

</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark">
        <a class="navbar-brand" href="#">{{ $quiz->quiz_title }}</a>
        <a class="ml-auto navbar-brand" href="#">Remaining Time: <strong
                id="time">{{ $quiz->quiz_duration }}</strong></a>
    </nav>

    <div class="container my-4">
        <form method="POST" id="quiz_form">

            @csrf
            <?php $i = 1 ?>
            @foreach($quiz->quizQuestions as $question)
            <div class="card my-4">
                <div class="card-body">
                    <div class="form-group">

                        <label><strong>{{ $i . " - " . $question->question }}</strong></label>
                        <hr class="my-1">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="question{{ $i }}" id="question{{ $i }}"
                                value="1">
                            <label class="form-check-label" for="question{{ $i }}">
                                {{ $question->answer_one }}
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="question{{ $i }}" id="question{{ $i }}"
                                value="2">
                            <label class="form-check-label" for="question{{ $i }}">
                                {{ $question->answer_two }}
                            </label>
                        </div>
                        @if (!empty($question->answer_three))
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="question{{ $i }}" id="question{{ $i }}"
                                value="3">
                            <label class="form-check-label" for="question{{ $i }}">
                                {{ $question->answer_three }}
                            </label>
                        </div>
                        @endif

                        @if (!empty($question->answer_four))
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="question{{ $i }}" id="question{{ $i }}"
                                value="4">
                            <label class="form-check-label" for="question{{ $i }}">
                                {{ $question->answer_four }}
                            </label>
                        </div>
                        @endif

                    </div>
                </div>
            </div>

            <?php $i++ ?>

            @endforeach
            <div class="text-right">
                <button name="ajaxSubmit" id="ajaxSubmit" class="btn text-white">Submit</button>
            </div>
        </form>
    </div>
</body>
<script type="text/javascript" src="{{ asset('js/quiz_time.js') }}"></script>



<script>
    window.onbeforeunload = function () {
        return "Do you really want to leave the quiz?";
    };
    window.onunload = function () {
        jQuery('#ajaxSubmit').click();
    }


    jQuery(document).ready(function(){
        jQuery('#ajaxSubmit').click(function(e){
            var questions_count = (document.getElementById("quiz_form").childElementCount) - 2;
            var data = {};
            var i;
            data["questions_count"] = questions_count;

            for (i = 1; i <= questions_count; i++) {
                data["question"+i] = $("input[name='question"+ i +"']:checked").val();
            }
                e.preventDefault();
            $.ajaxSetup({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });
            jQuery.ajax({

                url: "{{ url('/student/course/submitQuiz').'/'.$quiz->id }}",
                method: 'post',
                data: data,
                success: function(result){
                    window.onbeforeunload = null;
                    window.onunload = null;
                    window.location.href = result;   
                }
            });
          });
       });
</script>

</html>