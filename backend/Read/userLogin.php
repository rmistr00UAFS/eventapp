<?php

// Set CORS headers
header("Access-Control-Allow-Origin: *"); // Allow all origins (change this to a specific origin if needed)
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // Allowed methods
header("Access-Control-Allow-Headers: Content-Type"); // Allowed headers
header("Content-Type: application/json"); // Return JSON response

// Get the JSON input
$dataIN = json_decode(file_get_contents('php://input'), true);

// Ensure the input is valid
if (!isset($dataIN['email']) || !isset($dataIN['password'])) {
    echo json_encode(["error" => "Email and password are required."]);
    exit;
}

$email = strval($dataIN['email']); // Use the provided email
$password = strval($dataIN['password']); // Password input

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

// Prepare and execute the SQL query using a prepared statement
$stmt = $conn->prepare("SELECT * FROM `USER` WHERE `EMAIL` = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Prepare an array to hold the user data
$user = null;

if ($result) {
    if ($result->num_rows > 0) {
        // Fetch the user data
        $user = $result->fetch_assoc();
    } else {
        echo json_encode(["error" => "No user found with that email."]);
        exit;
    }
} else {
    echo json_encode(["error" => "SQL error: " . $conn->error]);
    exit;
}

// Verify the provided password against the stored hashed password
if (password_verify($password, $user['PASSWORD'])) {
    // Password is correct
    echo json_encode(["message" => "Login successful.", "userid" => $user['USERID']]);
} else {
    // Password is incorrect
    echo json_encode(["error" => "Invalid password."]);
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
