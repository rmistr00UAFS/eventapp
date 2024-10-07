<?php

// Set CORS headers
header("Access-Control-Allow-Origin: *"); // Allow all origins (change this to a specific origin if needed)
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // Allowed methods
header("Access-Control-Allow-Headers: Content-Type"); // Allowed headers
header("Content-Type: application/json"); // Return JSON response

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

// Get the user ID from the request (assuming it's sent as a POST request)
$user_id = isset($_POST['user_id']) ? $_POST['user_id'] : null;

if (!$user_id) {
    echo json_encode(["error" => "User ID is required."]);
    exit;
}

// Prepare and execute the SQL query to get saved events for the specified user
$stmt = $conn->prepare("SELECT * FROM `SAVED_EVENT_LIST` WHERE `user_id` = ?");
$stmt->bind_param("i", $user_id);
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
