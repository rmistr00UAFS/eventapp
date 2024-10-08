<?php

// Set CORS headers
header("Access-Control-Allow-Origin: *"); // Allow all origins (change this to a specific origin if needed)
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // Allowed methods
header("Access-Control-Allow-Headers: Content-Type"); // Allowed headers
header("Content-Type: application/json"); // Return JSON response

// Get the JSON input
$dataIN = json_decode(file_get_contents('php://input'), true);


$userid =(int)$dataIN['userid']; // Password input



// Database connection parameters
$host = 'localhost'; // Database host
$username = 'pmaUser'; // Database username
$password_db = 'pma'; // Database password
$dbname = 'event_app_db'; // Database name

// Create a connection to the database
$conn = new mysqli($host, $username, $password_db, $dbname);



$stmt = $conn->prepare("SELECT * FROM `EVENT` WHERE `USERID` = ?");
$stmt->bind_param("i", $userid); // "i" specifies the type integer for userid
$stmt->execute();
$result = $stmt->get_result();

// Prepare an array to hold the event data
$events = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $events[] = $row; // Add each event to the array
    }

    if (!empty($events)) {
        echo json_encode(["message" => "Events retrieved successfully.", "events" => $events]);
    } else {
        echo json_encode(["message" => "No events found for the specified userid."]);
    }
} else {
    echo json_encode(["error" => "SQL error: " . $conn->error]);
    exit;
}



// Close the statement and connection
$stmt->close();
$conn->close();
?>
