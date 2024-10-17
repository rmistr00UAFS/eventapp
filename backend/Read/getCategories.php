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

if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}


$stmt = $conn->prepare("SELECT * FROM `CATEGORY`");
$stmt->execute();
$result = $stmt->get_result();


$cats = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $cats[] = $row;
    }

    if (!empty($cats)) {
        echo json_encode(["message" => "Categoryies retrieved successfully.", "cats" => $cats]);
    } else {
        echo json_encode(["message" => "No category found."]);
    }
} else {
    echo json_encode(["error" => "SQL error: " . $conn->error]);
    exit;
}


$stmt->close();
$conn->close();
?>
