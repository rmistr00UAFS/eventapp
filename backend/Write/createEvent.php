<?php

// Set CORS headers
header("Access-Control-Allow-Origin: *"); // Allow all origins (change this to a specific origin if needed)
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // Allowed methods
header("Access-Control-Allow-Headers: Content-Type"); // Allowed headers
header("Content-Type: application/json"); // Return JSON response

// Get the JSON input
$dataIN = json_decode(file_get_contents('php://input'), true);

// Ensure the input is valid
if (!isset($dataIN['title']) || !isset($dataIN['event_descr']) || !isset($dataIN['date']) || !isset($dataIN['time']) || !isset($dataIN['location']) || !isset($dataIN['categoryid']) || !isset($dataIN['organizerid'])) {
    echo json_encode(["error" => "All fields (title, event_descr, date, time, location, categoryid, organizerid) are required."]);
    exit;
}


$title = strval($dataIN['title']);
$event_descr = strval($dataIN['event_descr']);
$date = strval($dataIN['date']);
$time = strval($dataIN['time']);
$location = strval($dataIN['location']);
$categoryid = intval($dataIN['categoryid']);
$organizerid = intval($dataIN['organizerid']);


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

// Check if the email already exists
$stmt = $conn->prepare("SELECT * FROM `EVENT` WHERE `TITLE` = ?");
$stmt->bind_param("s", $title);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode(["error" => "Event already exists."]);
    exit;
}

// Hash the password for security
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Prepare and execute the insert query
$stmt = $conn->prepare("INSERT INTO `EVENTS` (`TITLE`, `EVENT_DESCR`, `DATE`, `TIME`, `LOCATION`, `CATEGORYID`, `ORGANIZERID`) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssii", $title, $event_descr, $date, $time, $location, $categoryid, $organizerid);


if ($stmt->execute()) {
    echo json_encode(["message" => "Event created successfully."]);
} else {
    echo json_encode(["error" => "Error creating event: " . $stmt->error]);
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>

