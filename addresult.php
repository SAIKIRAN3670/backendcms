<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods:POST,GET,PUT,DELETE');
header('Access-Control-Allow-Headers: content-type or other');
header('Content-Type: application/json');

$host = "localhost";
$user = "root";
$password = "";
$dbname = "sai-project";

$con = mysqli_connect($host, $user, $password, $dbname);

$method = $_SERVER['REQUEST_METHOD'];
if ($con) {
    echo ("connected to database");
}

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST["name"])) {
    $name = $_POST["name"];
    $Username = $_POST["Username"];
    $class = $_POST["class"];
    $section = $_POST["section"];   
    $DateofBirth = $_POST["DateofBirth"];
    $Student_GRNO = $_POST["Student_GRNO"];
    $math = $_POST["math"];
    $science = $_POST["science"];
    $english = $_POST["english"];
    $Comp = $_POST["Comp"];
    $Sanskrit = $_POST["Sanskrit"];
    $Hindi = $_POST["Hindi"];
    $Social_s = $_POST["Social_s"];
    $Guj = $_POST["Guj"];

    $sql = "INSERT INTO result (name,Username,class,section,Student_GRNO,DateofBirth,math,science,english,Comp,Sanskrit,Hindi,Social_s,Guj) VALUES ('$name','$Username','$class','$section','$DateofBirth','$Student_GRNO', '$math', '$science', '$english','$Comp','$Sanskrit', '$Hindi', '$Social_s', '$Guj')";
    if (mysqli_query($con, $sql)) {
        $data = array("data" => "Your Data Saved successfully");
        echo json_encode($data);
    } else {
        $data = array("data" => "Error: " . $sql . "<br>" . $con->error);
        echo json_encode($data);
    }
}
$con->close();
