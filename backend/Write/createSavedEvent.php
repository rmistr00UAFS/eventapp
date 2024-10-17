<?php

// Set CORS headers
header("Access-Control-Allow-Origin: *"); // Allow all origins (change this to a specific origin if needed)
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // Allowed methods
header("Access-Control-Allow-Headers: Content-Type"); // Allowed headers
header("Content-Type: application/json"); // Return JSON response

$_POST = json_decode(file_get_contents('php://input'), true);

// echo json_encode($dataIN);


$eventid = (int) intval($dataIN['eventid']);
$userid =(int) intval($dataIN['userid']);




$host = 'localhost';
$username = 'pmaUser';
$password_db = 'pma';
$dbname = 'event_app_db';



$conn = new mysqli($host, $username, $password_db, $dbname);


if (isset($_POST['userid'], $_POST['eventid']) && !empty($_POST['userid']) && !empty($_POST['eventid'])) {

    $userid = intval($_POST['userid']);
    $eventid = intval($_POST['eventid']);



$stmt = $conn->prepare("INSERT INTO `SAVED_EVENTS` ( `EVENTID`, `USERID`) VALUES ( ?, ?)");
$stmt->bind_param("ii", $eventid, $userid);


if ($stmt->execute()) {
    echo json_encode(["message" => "Saved event added successfully."]);
} else {
    echo json_encode(["error" => "Error adding event: " . $stmt->error]);
}

$stmt->close();
$conn->close();

} else {

    echo "Error: Both userid and eventid are required and cannot be null.";
}


?>

