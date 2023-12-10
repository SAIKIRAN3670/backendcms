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


$sql = "SELECT * FROM cocircular WHERE Username = ?";
$stmt = $conn->prepare($sql);
$stmt->bindParam(1, $Username);

if ($stmt->execute() && $stmt->rowCount() > 0) {
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $response = ['status' => 200, 'message' => 'Profile details retrieved successfully.', 'data' => $rows];
} else {
    $response = ['status' => 0, 'message' => 'No profile found for the given Username.'];
}
echo json_encode($response);
