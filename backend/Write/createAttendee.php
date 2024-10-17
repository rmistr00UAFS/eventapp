<?php

// Set CORS headers
header("Access-Control-Allow-Origin: *"); // Allow all origins (change this to a specific origin if needed)
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // Allowed methods
header("Access-Control-Allow-Headers: Content-Type"); // Allowed headers
header("Content-Type: application/json"); // Return JSON response


$dataIN = json_decode(file_get_contents('php://input'), true);

// echo json_encode($dataIN);




$at_id = strval($dataIN['at_id']);
$email = strval($dataIN['email']);
$phone = strval($dataIN['phone']);
$address = strval($dataIN['address']);
$coordinates = strval($dataIN['coordinates']);
$time = strval($dataIN['time']);
$date = intval($dataIN['date']);
$eventid = intval($dataIN['eventid']);
$userid = intval($dataIN['userid']);




$host = 'localhost';
$username = 'pmaUser';
$password_db = 'pma';
$dbname = 'event_app_db';

// Create a connection to the database
$conn = new mysqli($host, $username, $password_db, $dbname);


$stmt = $conn->prepare("INSERT INTO `ATTENDEE` (`AT_ID`, `EMAIL`, `PHONE`, `ADDRESS`, `COORDINATES`, `TIME`, `DATE`, `EVENTID`, `USERID`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("issssssii", $at_id, $email, $phone, $address, $coordinates, $time, $date, $eventid, $userid);


if ($stmt->execute()) {
    echo json_encode(["message" => "Attendee created successfully."]);
} else {
    echo json_encode(["error" => "Error creating attendee: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
