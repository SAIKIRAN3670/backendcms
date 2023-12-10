<?php

// Connect to the MySQL database
$host = 'localhost';
$user = "root";
$password = "";
$dbname = "sai-project";
$mysqli = new mysqli($host, $user, $password, $dbname);

if ($mysqli->connect_errno) {
    die('Failed to connect to MySQL: ' . $mysqli->connect_error);
}

// Retrieve the number of users from the database
$query = "SELECT COUNT(*) AS num_boys FROM student WHERE Gender = 'Male'";
$result = $mysqli->query($query);
if (!$result) {
    die('Failed to retrieve number of users: ' . $mysqli->error);
}
$row = $result->fetch_assoc();
$num_boys = $row['num_boys'];

// Return the number of users as a JSON response
header('Content-Type: application/json');
echo json_encode(array('total no of Boys', $num_boys));

// Close the MySQL connection
$mysqli->close();


