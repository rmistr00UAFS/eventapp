<?php

header("Access-Control-Allow-Origin: *"); // Allow all origins (change this to a specific origin if needed)
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // Allowed methods
header("Access-Control-Allow-Headers: Content-Type"); // Allowed headers
header("Content-Type: application/json"); // Return JSON response

$dataIN = json_decode(file_get_contents('php://input'), true);

// echo json_encode($dataIN);

// // Ensure the input is valid
// if (!isset($dataIN['title']) || !isset($dataIN['info']) || !isset($dataIN['date']) || !isset($dataIN['time']) || !isset($dataIN['address']) || !isset($dataIN['coordinates']) || !isset($dataIN['categoryid']) || !isset($dataIN['organizerid'])) {
//     echo json_encode(["error" => "All fields (title, info, date, time, address, coordinates, categoryid, organizerid) are required."]);
//     exit;
// }



// $id = strval($dataIN['id']);
$eventid = (int) intval($dataIN['eventid']);
$userid =(int) intval($dataIN['userid']);




$host = 'localhost';
$username = 'pmaUser';
$password_db = 'pma';
$dbname = 'event_app_db';


$conn = new mysqli($host, $username, $password_db, $dbname);



$stmt = $conn->prepare("DELETE FROM `SAVED_EVENTS` WHERE `EVENTID` = ? AND `USERID` = ?");
$stmt->bind_param("ii", $eventid, $userid);


if ($stmt->execute()) {
    echo json_encode(["message" => "Saved event deleted successfully."]);
} else {
    echo json_encode(["error" => "Error deleting event: " . $stmt->error]);
}

$stmt->close();
$conn->close();
} else {
    echo "Error: Both userid and eventid are required and cannot be null.";
}


?>

