<?php

if (isset($_FILES['codeFile'])) {
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


        exec("java -jar .\compiler_api\dist\compiler_api.jar $file_full_path", $compileOutput);
        //if (file_exists($assignmentPath)) {unlink($assignmentPath);}
        echo $compileOutput[0] . "\n";


        exec("java -jar .\commentChecker_api\dist\commentChecker_api.jar $file_full_path", $commentOutput);
        echo $commentOutput[0] . "\n";


        exec("java -jar .\indentation_api\dist\indentation_api.jar $file_full_path", $indentationOutput);
        echo $indentationOutput[0] . "\n";
    }

    if (empty($errors) == false) {
        print_r($errors);
    }
}

/*

    exec("java -jar .\compiler_api\dist\compiler_api.jar $file_full_path", $compileOutput);
    //if (file_exists($assignmentPath)) {unlink($assignmentPath);}

    echo $compileOutput[0] . "\n";

    exec("java -jar .\commentChecker_api\dist\commentChecker_api.jar $file_full_path", $commentOutput);
    echo $commentOutput[0] . "\n";


    exec("java -jar .\indentation_api\dist\indentation_api.jar $file_full_path", $indentationOutput);
    echo $indentationOutput[0] . "\n";

*/

//$data = json_decode(file_get_contents("php://input"));
//$assignmentPath = $data->file;










//echo "encode";
//echo (json_encode($a));

//var_dump($data);
//echo $data->file;
//echo $data;

/*

echo $data;

$json = addslashes($data);
$ss = "java -jar .\dist\compiler_api\compiler_api.jar \"$json\"";
echo $ss;
exec($ss, $output);

echo $output[0];

$rest_json = file_get_contents("php://input");
$json = json_decode($rest_json, true);
print_r($json);
if(isset($_POST)){
    print_r($_POST);
}

if (isset($_POST['file'])) {
    echo "helllo";
    //$json = addslashes(json_encode($_POST));
    // exec("java -jar .\dist\compiler_api\compiler_api.jar \"$json\"", $output);
    // echo $output[0];
}
*/
