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

// Get the user ID from the request
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : null;

if (!$user_id) {
    echo json_encode(["error" => "No user ID provided."]);
    exit;
}

// Prepare and execute the SQL query to get user data by ID
$stmt = $conn->prepare("SELECT * FROM `USER` WHERE `user_id` = ?");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if user data was found
if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc();
    echo json_encode(["message" => "User retrieved successfully.", "user" => $user_data]);
} else {
    echo json_encode(["message" => "No user found for the specified ID."]);
}

// Close the statement and connection
$stmt->close();
$conn->close();

?>
