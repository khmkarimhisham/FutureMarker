<?php

$assignment_ans = json_decode(file_get_contents("assignmnet.json"));

if (isset($_FILES['codeFile'])) {
    $response = json_decode("{}");
    $errors = array();
    $file_name = $_FILES['codeFile']['name'];
    $file_size = $_FILES['codeFile']['size'];
    $file_tmp = $_FILES['codeFile']['tmp_name'];
    $file_type = $_FILES['codeFile']['type'];
    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $file_path = "codeFiles/" . mt_rand(0, getrandmax()) . "/";

    if ($file_ext != "java") {
        $errors[] = 'extension not allowed, please upload java file.';
    } else if ($file_size > 2097152) {
        $errors[] = 'File size must be under 2 MB';
    } else {
        while (file_exists($file_path)) {
            $file_path = "codeFiles/" . mt_rand(0, getrandmax()) . "/";
        }

        mkdir($file_path);
        $file_full_path = $file_path . $file_name;
        move_uploaded_file($file_tmp, $file_full_path);

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

            exec('java -jar testcase_api/dist/testcase_api.jar ' . $assignment_ans->{'input'} . " " . $assignment_ans->{'output'} . " " . $file_full_path, $output4);
            $temp_json = json_decode($output4[0]);
            $response->{'TestCase'} = $temp_json->{'TestCase'};
        }
    }

    if (empty($errors) == false) {
        print_r($errors);
    }

    echo json_encode($response);
}
