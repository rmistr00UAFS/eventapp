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
$dbname = 'D'; // Database name

// Create a connection to the database
$conn = new mysqli($host, $username, $password_db, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// Prepare and execute the SQL query to get all reviews
$stmt = $conn->prepare("SELECT * FROM `REVIEWS`");
$stmt->execute();
$result = $stmt->get_result();

$reviews = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $reviews[] = $row;
    }

    if (!empty($reviews)) {
        echo json_encode(["message" => "Reviews retrieved successfully.", "reviews" => $reviews]);
    } else {
        echo json_encode(["message" => "No reviews found."]);
    }
} else {
    echo json_encode(["error" => "SQL error: " . $conn->error]);
    exit;
}

$stmt->close();
$conn->close();
?>
