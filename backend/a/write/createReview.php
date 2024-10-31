<?php

// Set CORS headers
header("Access-Control-Allow-Origin: *"); // Allow all origins (change this to a specific origin if needed)
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // Allowed methods
header("Access-Control-Allow-Headers: Content-Type"); // Allowed headers
header("Content-Type: application/json"); // Return JSON response

// Get the JSON input
$dataIN = json_decode(file_get_contents('php://input'), true);

// echo json_encode($dataIN);



$reviewID = intval($dataIN['reviewid']);
$userID = intval($dataIN['userid']);
$eventID = intval($dataIN['eventid']);
$comment = strval($dataIN['comment']);
$stars = intval($dataIN['stars']);




$host = 'localhost'; // Database host
$username = 'pmaUser'; // Database username
$password_db = 'pma'; // Database password
$dbname = 'event_app_db'; // Database name

$conn = new mysqli($host, $username, $password_db, $dbname);



// Prepare and execute the insert query
$stmt = $conn->prepare("INSERT INTO `REVIEWS` (`REVIEWID`, `USERID`, `EVENTID`, `COMMENT`, `STARS`) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("iiisi", $reviewID, $userID, $eventID, $comment, $stars);


if ($stmt->execute()) {
    echo json_encode(["message" => "Event created successfully."]);
} else {
    echo json_encode(["error" => "Error creating event: " . $stmt->error]);
}


$stmt->close();
$conn->close();
?>

