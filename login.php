<?php

header("Cache-Control: no-store");
header("Content-Type: text/event-stream");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods:POST,GET,PUT,DELETE');
header('Access-Control-Allow-Headers: content-type or other');
header('Content-Type: application/json');

include 'DbConnect.php';
$objDb = new DbConnect;
$conn = $objDb->connect();

$Username = $_GET['Username'];
$Password = $_GET['Password'];
$userType = $_GET['userType'];

switch ($userType) {
    case 'admin':
        $tableName = 'admin';
        $sql = "SELECT * FROM admin WHERE Username = ? AND Password = ?";
        break;
    case 'teacher':
        $tableName = 'teacher';
        $sql = "SELECT * FROM teacher WHERE Username = ? AND Password = ?";
        break;
    case 'student':
        $tableName = 'student';
        $sql = "SELECT * FROM student WHERE Username = ? AND Password = ?";
        break;
    default:
        $response = ['status' => 0, 'message' => 'Invalid user type.'];
        echo json_encode($response);
        exit;
}

$stmt = $conn->prepare($sql);
$stmt->bindParam(1, $Username);
$stmt->bindParam(2, $Password);

if ($stmt->execute() && $stmt->rowCount() > 0) {
    $response = ['status' => 200, 'message' => 'Login successful.'];
} else {
    $response = ['status' => 0, 'message' => 'Invalid Username or Password.'];
}
echo json_encode($response);
