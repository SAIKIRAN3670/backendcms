<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

include 'DbConnect.php';
$objDb = new DbConnect;
$conn = $objDb->connect();

$data = json_decode(file_get_contents("php://input"));
if (!empty($data)) {
    $username = $data->Username;
    $old_password = $data->Old_Password;
    $new_password = $data->New_Password;

    // Validate old password
    $stmt = $conn->prepare("SELECT Password FROM teacher WHERE Username = :Username");
    $stmt->bindParam(':Username', $username);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$result || $old_password !== $result['Password']) {
        $response = ['status' => 0, 'message' => 'Invalid old password.'];
        echo json_encode($response);
        exit;
    }

    // Update password
    $sql = "UPDATE teacher SET Password = :Password WHERE Username = :Username";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':Username', $username);
    $stmt->bindParam(':Password', $new_password);

    if ($stmt->execute()) {
        $response = ['status' => 1, 'message' => 'Password updated successfully.'];
    } else {
        $response = ['status' => 0, 'message' => 'Failed to update password.'];
    }
    echo json_encode($response);
}
