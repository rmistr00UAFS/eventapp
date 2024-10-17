<?php

// Set CORS headers
header("Access-Control-Allow-Origin: *"); // Allow all origins (change this to a specific origin if needed)
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // Allowed methods
header("Access-Control-Allow-Headers: Content-Type"); // Allowed headers
header("Content-Type: application/json"); // Return JSON response


$dataIN = json_decode(file_get_contents('php://input'), true);

// echo json_encode($dataIN);


$ca_id = strval($dataIN['ca_id']);
$type = strval($dataIN['type']);
$name = strval($dataIN['name']);
$eventid = strval($dataIN['eventid']);



$host = 'localhost';
$username = 'pmaUser';
$password_db = 'pma';
$dbname = 'event_app_db';

$conn = new mysqli($host, $username, $password_db, $dbname);

$categories = [
    ['type' => 'Music', 'name' => 'Concerts', 'eventid' => 1],
    ['type' => 'Sports', 'name' => 'Football', 'eventid' => 2],
    ['type' => 'Education', 'name' => 'Workshops', 'eventid' => 3],
    ['type' => 'Art', 'name' => 'Exhibitions', 'eventid' => 4],
    ['type' => 'Technology', 'name' => 'Tech Conferences', 'eventid' => 5]
];


foreach ($categories as $category) {
    $stmt = $conn->prepare("INSERT INTO `CATEGORY` (`TYPE`, `NAME`, `EVENTID`) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $category['type'], $category['name'], $category['eventid']);

    if ($stmt->execute()) {
        echo json_encode(["message" => $category['name'] . " category inserted successfully."]);
    } else {
        echo json_encode(["error" => "Error inserting " . $category['name'] . " category: " . $stmt->error]);
    }
}


$stmt->close();
$conn->close();
?>

