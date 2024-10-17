<?php

// Set CORS headers
header("Access-Control-Allow-Origin: *"); // Allow all origins (change this to a specific origin if needed)
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // Allowed methods
header("Access-Control-Allow-Headers: Content-Type"); // Allowed headers
header("Content-Type: application/json"); // Return JSON response


$dataIN = json_decode(file_get_contents('php://input'), true);


if (!isset($dataIN['userid'])) {
    echo json_encode(["error" => "User ID is required."]);
    exit;
}

$userid = intval($dataIN['userid']);

$host = 'localhost';
$username = 'pmaUser';
$password_db = 'pma';
$dbname = 'event_app_db';



$conn = new mysqli($host, $username, $password_db, $dbname);


if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

$stmt = $conn->prepare("SELECT * FROM `SAVED_EVENT_LIST` WHERE `USERID` = ?");
$stmt->bind_param("i", $userid);
$stmt->execute();
$result = $stmt->get_result();


$saved_events = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $saved_events[] = $row;
    }

    if (!empty($saved_events)) {
        echo json_encode(["message" => "Saved events retrieved successfully.", "saved_events" => $saved_events]);
    } else {
        echo json_encode(["message" => "No saved events found for the specified user."]);
    }
} else {
    echo json_encode(["error" => "SQL error: " . $conn->error]);
    exit;
}

$stmt->close();
$conn->close();
?>
