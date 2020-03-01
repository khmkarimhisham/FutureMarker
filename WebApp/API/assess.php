<?php

require '../DB/db.php';
function indentation_msg($x)
{
    if (preg_match_all("/[1-9]*:/", $x, $matches)) {
        $output = "";
        for ($z = 0; $z < count($matches[0]); $z++) {
            $output .= "Line " . str_replace(":", "", $matches[0][$z]) . " has incorrect indentation<br>";
        }
        return ($output);
    } else {
        return "Your code is very clear";
    }
}
function identifiers_msg($x)
{
    if (preg_match_all("/[1-9]*:/", $x, $matches)) {
        $output = "";
        for ($z = 0; $z < count($matches[0]); $z++) {
            $output .= "The identifier name should be more obvious at line " . str_replace(":", "", $matches[0][$z]) . "<br>";
        }
        return ($output);
    } else {
        return "Your identifiers name are clear";
    }
}

if (isset($_FILES['codeFile'])) {
    $error_message = "";
    $Assignment_ID = $_POST['Assignment_ID'];
    $Student_ID = $_POST['Student_ID'];
    $Course_ID = $_POST['Course_ID'];
    $response = json_decode("{}");
    $file_name = $_FILES['codeFile']['name'];
    $file_size = $_FILES['codeFile']['size'];
    $file_tmp = $_FILES['codeFile']['tmp_name'];
    $file_type = $_FILES['codeFile']['type'];
    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $file_path = "submitted_assignment/" . mt_rand(0, getrandmax()) . "/";

    while (file_exists($file_path)) {
        $file_path = "submitted_assignment/" . mt_rand(0, getrandmax()) . "/";
    }

    mkdir($file_path);
    $file_full_path =  $file_path . $file_name;

    $sql = "SELECT * FROM `assignment` WHERE `Assignment_ID` = '$Assignment_ID'";
    $result = mysqli_query($db_connection, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $ass_full_grade = $row['Full_grade'];
        $ass_compilation_grade = $row['Compilation_grade'];
        $ass_style_grade = $row['Style_grade'];
        $ass_dynamic_test_grade = $row['Dynamic_test_grade'];
        $ass_feature_test_grade = $row['Feature_test_grade'];
    }

    if (move_uploaded_file($file_tmp, $file_full_path)) {

        exec("java -jar .\compiler_api\dist\compiler_api.jar $file_full_path", $output1);
        $temp_json = json_decode($output1[0]);
        $response->{'build'} = $temp_json->{'build'};
        $response->{'error'} = $temp_json->{'error'};

        if ($response->{'build'} = true) {
            exec("java -jar .\commentChecker_api\dist\commentChecker_api.jar $file_full_path", $output2);
            $temp_json = json_decode($output2[0]);
            $response->{'commentsCount'} = $temp_json->{'commentsCount'};
            $response->{'linesCount'} = $temp_json->{'linesCount'};
            $response->{'percentage'} = $temp_json->{'percentage'};

            exec("java -jar indentation_api.jar $file_full_path", $output3);
            $temp_json = json_decode($output3[0]);
            $response->{'Indentation output'} = $temp_json->{'Indentation output'};
            $response->{'Identifiers output'} = $temp_json->{'Identifiers output'};
            $response->{'Indentation Grade'} = $temp_json->{'Indentation Grade'};
            $response->{'Identifiers Grade'} = $temp_json->{'Identifiers Grade'};

            $sql = "SELECT * FROM `dynamic_test` WHERE `Assignment_ID` = '$Assignment_ID'";
            $result = mysqli_query($db_connection, $sql);
            $done_dynamic_test_feedback = "";
            $done_feature_test_feedback = "";
            if (mysqli_num_rows($result) > 0) {
                $dynamic_count = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    exec("java -jar testcase_api/dist/testcase_api.jar \"" . $row['Input'] . "\" \"" . $row['output']  . "\" \"" . $file_full_path . "\"", $output4);
                    $temp_json = json_decode($output4[0]);
                    $tests[$dynamic_count] = $temp_json->{'TestCase'};
                    $dynamic_count++;
                }
                $response->{'TestCase'} = $tests;
            }

            $done_compilation_grade = 0;
            $done_style_grade = 0;
            $done_dynamic_test_grade = 0;
            $done_feature_test_grade = 0;

            if ($response->{'build'}) {
                $compilation_feedback = "The code compiled successfully";
                $done_compilation_grade = $ass_dynamic_test_grade;
                $done_dynamic_test_grade = (array_count_values($response->{'TestCase'})['true'] / $dynamic_count) * $ass_dynamic_test_grade;
            } else {
                $compilation_feedback = "The code failed to compile";
            }
            if ($response->{'percentage'} < 0.1) {
                $comment_feedback = "You need to clarify your code by using more comments";
            } else {
                $comment_feedback = "Your comments made the code clear";
            }

            $indentation_feedback = indentation_msg($response->{'Indentation output'});

            $Identifiers_feedback = identifiers_msg($response->{'Identifiers output'});

            $done_style_grade = (($response->{'Indentation Grade'} + $response->{'Identifiers Grade'} +  $response->{'percentage'}) / 3) * $ass_style_grade;


            $sql = "INSERT INTO `doing_assignment`(`Student_ID`, `Assignment_ID`, `Assignment_dir`, `Assignment_main`, `Compilation_grade`, `Compilation_feedback`, `Style_grade`, `Comment_feedback`, `Indentation_feedback`, `Methods_feedback`, `Identifiers_feedback`, `Dynamic_test_grade`, `Dynamic_test_feedback`, `Feature_test_grade`, Feature_test_feedback) VALUES ('$Student_ID', '$Assignment_ID', '$file_full_path', '$file_full_path', '$done_compilation_grade', '$compilation_feedback', '$done_style_grade', '$comment_feedback', '$indentation_feedback', null, '$Identifiers_feedback', '$done_dynamic_test_grade', '$done_dynamic_test_feedback', '$done_feature_test_grade', '$done_feature_test_feedback')";
            $result = mysqli_query($db_connection, $sql);
            if ($result) {
                header("Location: ../Assignment_body.php?course_id=$Course_ID&assignment_id=$Assignment_ID&submit=true");
            } else {
                header("Location: ../Assignment_body.php?course_id=$Course_ID&assignment_id=$Assignment_ID&submit=false");
            }
        }
    }
}
