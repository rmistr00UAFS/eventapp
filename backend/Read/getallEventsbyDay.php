<?php

// Set CORS headers
header("Access-Control-Allow-Origin: *"); // Allow all origins (change this to a specific origin if needed)
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // Allowed methods
header("Access-Control-Allow-Headers: Content-Type"); // Allowed headers
header("Content-Type: application/json"); // Return JSON response

$host = 'localhost';
$username = 'pmaUser';
$password_db = 'pma';
$dbname = 'event_app_db';

$conn = new mysqli($host, $username, $password_db, $dbname);

$dataIN = json_decode(file_get_contents('php://input'), true);


if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

$date = isset($dataIN['date']) ? $dataIN['date'] : null;

// echo json_encode($date);

if (!$date) {
    echo json_encode(["error" => "No date provided."]);
    exit;
}

$stmt = $conn->prepare("SELECT * FROM `EVENT` WHERE `DATE` = ?");
$stmt->bind_param('s', $date);
$stmt->execute();
$result = $stmt->get_result();


$events = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }

    if (!empty($events)) {
        echo json_encode(["message" => "Events retrieved successfully.", "events" => $events]);
    } else {
        echo json_encode(["message" => "No events found for the specified date."]);
    }
} else {
    echo json_encode(["error" => "SQL error: " . $conn->error]);
    exit;
}

$stmt->close();
$conn->close();
?>
