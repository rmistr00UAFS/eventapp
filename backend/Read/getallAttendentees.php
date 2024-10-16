<?php

// Set CORS headers
header("Access-Control-Allow-Origin: *"); // Allow all origins (change this to a specific origin if needed)
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // Allowed methods
header("Access-Control-Allow-Headers: Content-Type"); // Allowed headers
header("Content-Type: application/json"); // Return JSON response

// Get the JSON input
$dataIN = json_decode(file_get_contents('php://input'), true);

// Extract the USERID from the input data
$USERID = (int)$dataIN['userid'];

// Database connection parameters
$host = 'localhost'; // Database host
$username = 'pmaUser'; // Database username
$password_db = 'pma'; // Database password
$dbname = 'event_app_db'; // Database name

// Create a connection to the database
$conn = new mysqli($host, $username, $password_db, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// Prepare and execute the SQL query to get attendees based on the user's saved events
$stmt = $conn->prepare("
    SELECT a.*
    FROM `ATTENDENTEE` a
    INNER JOIN `SAVED_EVENTS` se ON a.EVENTID = se.EVENTID
    WHERE se.USERID = ?
");

$stmt->bind_param("i", $USERID);
$stmt->execute();
$result = $stmt->get_result();

// Prepare an array to hold the attendee data
$attendees = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $attendees[] = $row; // Add each attendee to the array
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

// Close the statement and connection
$stmt->close();
$conn->close();

?>
