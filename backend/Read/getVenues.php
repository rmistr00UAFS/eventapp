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

// Prepare and execute the SQL query to get all venues
$stmt = $conn->prepare("SELECT * FROM `VENUE`");
$stmt->execute();
$result = $stmt->get_result();

// Prepare an array to hold the venue data
$venues = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $venues[] = $row; // Add each venue to the array
    }

    if (!empty($venues)) {
        echo json_encode(["message" => "Venues retrieved successfully.", "venues" => $venues]);
    } else {
        echo json_encode(["message" => "No venues found."]);
    }
} else {
    echo
