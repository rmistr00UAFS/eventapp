<?php

// Set CORS headers
header("Access-Control-Allow-Origin: *"); // Allow all origins (change this to a specific origin if needed)
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // Allowed methods
header("Access-Control-Allow-Headers: Content-Type"); // Allowed headers
header("Content-Type: application/json"); // Return JSON response

// Get the JSON input
$dataIN = json_decode(file_get_contents('php://input'), true);

// Ensure the input is valid
if (!isset($dataIN['userid'])) {
    echo json_encode(["error" => "User ID is required."]);
    exit;
}

$userid = intval($dataIN['userid']); // Use the provided user ID

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

// Prepare and execute the SQL query to get saved events for the specified user
$stmt = $conn->prepare("SELECT * FROM `SAVED_EVENT_LIST` WHERE `USERID` = ?");
$stmt->bind_param("i", $userid);
$stmt->execute();
$result = $stmt->get_result();

// Prepare an array to hold the saved event data
$saved_events = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $saved_events[] = $row; // Add each saved event to the array
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

// Close the statement and connection
$stmt->close();
$conn->close();
?>
