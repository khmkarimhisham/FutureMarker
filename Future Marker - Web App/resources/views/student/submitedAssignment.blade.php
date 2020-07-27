@extends('layouts.studentNavbar')

@section('content')

<div class="row">
    @include('layouts.studentCourseBar')

    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <h4><strong>{{ $assignment['assignment_title'] }} Feedback</strong></h4>

                <form class="form-signin">
                    <ul class="treeview-animated-list pl-0">
                        <div class="card my-3 bg-light">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <i class="fas fa-angle-right"></i>
                                        <span><i></i><strong>Compilation</strong></span>
                                    </div>
                                    <div class="col text-right">
                                        <span><i></i><label><strong> {{ $finishedAssignment['compilation_grade'] }} /
                                                    {{  $assignment['compilation_grade'] }}</strong></label></span>
                                    </div>
                                </div>
                                <ul class="nested">
                                    <li>
                                        <div class="treeview-animated-element">
                                            <i></i>
                                            <p>{!! $finishedAssignment['compilation_feedback'] !!}</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card my-3 bg-light">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <i class="fas fa-angle-right"></i>
                                        <span><strong>Style</strong></span>
                                    </div>
                                    <div class="col text-right">
                                        <span><i></i><label><strong> {{ $finishedAssignment['style_grade'] }} /
                                                    {{  $assignment['style_grade'] }}</strong></label></span>
                                    </div>
                                </div>
                                <ul class="nested">
                                    <li>
                                        <div class="treeview-animated-element">
                                            <i></i><label><strong>Comments:</strong></label><br>
                                            <p>{!! $finishedAssignment['style_feedback'][0] !!}</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="treeview-animated-element">
                                            <i></i><label><strong>Indentation:</strong></label><br>
                                            <p>{!! $finishedAssignment['style_feedback'][1] !!}</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="treeview-animated-element">
                                            <i></i><label><strong>Identifiers:</strong></label><br>
                                            <p>{!! $finishedAssignment['style_feedback'][2] !!}</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        @if($finishedAssignment['dynamic_test_feedback'][0] != "")
                        <div class="card my-3 bg-light">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <i class="fas fa-angle-right"></i>
                                        <span><i></i><strong>Test Cases</strong></span>
                                    </div>
                                    <div class="col text-right">
                                        <span><i></i><label><strong> {{ $finishedAssignment['dynamic_test_grade'] }} /
                                                    {{  $assignment['dynamic_test_grade'] }}</strong></label></span>
                                    </div>
                                </div>
                                <ul class="nested">
                                    <?php $dynamic_test_feedback = $finishedAssignment['dynamic_test_feedback'] ?>
                                    @while ( sizeof($dynamic_test_feedback) )

                                    <?php
                                    $color = "";
                                    if ($dynamic_test_feedback[0] == "true") {
                                        $color = "alert-success";
                                    } else {
                                        $color = "alert-danger";
                                    }
                                    unset($dynamic_test_feedback[0]);
                                    ?>

                                    <i></i>
                                    <label>
                                        <strong>
                                            {{ array_shift($dynamic_test_feedback) }}

                                        </strong>
                                    </label>
                                    <br>
                                    <label>Input:</label>
                                    <div class='alert {{ $color }} mr-5'>
                                        {{ array_shift($dynamic_test_feedback) }}
                                    </div>

                                    <label>The Right Output:</label>
                                    <div class='alert {{ $color }} mr-5'>
                                        {{ array_shift($dynamic_test_feedback) }}
                                    </div>
                                    <label>Your Output:</label>
                                    <div class='alert {{ $color }} mr-5'>
                                        {{ array_shift($dynamic_test_feedback) }}
                                    </div>

                                    @endwhile

                                </ul>
                            </div>
                        </div>
                        @endif

                        @if($finishedAssignment['feature_test_feedback'][0] != "")
                        <div class="card my-3 bg-light">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <i class="fas fa-angle-right"></i>
                                        <span><i></i><strong>Feature Testing</strong></span>
                                    </div>
                                    <div class="col text-right">
                                        <span><i></i><label><strong> {{ $finishedAssignment['feature_test_grade'] }} /
                                                    {{  $assignment['feature_test_grade'] }}</strong></label></span>
                                    </div>
                                </div>
                                <ul class="nested">
                                    <?php $feature_test_feedback = $finishedAssignment['feature_test_feedback'] ?>
                                    @while ( sizeof($feature_test_feedback) )

                                    <?php
                                    $color2 = "";
                                    if ($feature_test_feedback[0] == "true") {
                                        $color2 = "alert-success";
                                    } else {
                                        $color2 = "alert-danger";
                                    }
                                    unset($feature_test_feedback[0]);
                                    ?>

                                    <br>

                                    <div class='alert {{ $color2 }} mr-5'>
                                        {{ array_shift($feature_test_feedback) }}
                                    </div>

                                    @endwhile

                                </ul>
                            </div>
                        </div>
                        @endif
                        <div class="card my-3 bg-light">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <i class="fas fa-angle-right"></i>
                                        <span><i></i><strong>Total Grade</strong></span>
                                    </div>
                                    <div class="col text-right ">
                                        <span><i></i><label><strong>
                                                    {{ $finishedAssignment['compilation_grade'] + $finishedAssignment['style_grade'] + $finishedAssignment['dynamic_test_grade'] + $finishedAssignment['feature_test_grade'] }}
                                                    / {{ $assignment['full_grade'] }}</strong></label></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </ul>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection