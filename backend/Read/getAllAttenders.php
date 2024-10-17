<?php

// Set CORS headers
header("Access-Control-Allow-Origin: *"); // Allow all origins (change this to a specific origin if needed)
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // Allowed methods
header("Access-Control-Allow-Headers: Content-Type"); // Allowed headers
header("Content-Type: application/json"); // Return JSON response

$dataIN = json_decode(file_get_contents('php://input'), true);

$EVENTID = (int)$dataIN['eventid'];

$host = 'localhost';
$username = 'pmaUser';
$password_db = 'pma';
$dbname = 'event_app_db';

$conn = new mysqli($host, $username, $password_db, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

$stmt = $conn->prepare("
    SELECT * FROM `SAVED_EVENTS` WHERE `EVENTID` = ?
");

$stmt->bind_param("i", $EVENTID);
$stmt->execute();
$result = $stmt->get_result();

$attendees = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $attendees[] = $row;
    }

    if (!empty($attendees)) {
        echo json_encode(["message" => "Attendees retrieved successfully.", "attendees" => $attendees]);
    } else {
        echo json_encode(["message" => "No attendees found for the given user ID."]);
    }
} else {
    echo json_encode(["error" => "SQL error: " . $conn->error]);
    exit;
}

$stmt->close();
$conn->close();

?>
