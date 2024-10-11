<?php

header("Access-Control-Allow-Origin: *"); // Allow all origins (change this to a specific origin if needed)
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // Allowed methods
header("Access-Control-Allow-Headers: Content-Type"); // Allowed headers
header("Content-Type: application/json"); // Return JSON response

$_POST = json_decode(file_get_contents('php://input'), true);

// echo json_encode($dataIN);

// // Ensure the input is valid
// if (!isset($dataIN['title']) || !isset($dataIN['info']) || !isset($dataIN['date']) || !isset($dataIN['time']) || !isset($dataIN['address']) || !isset($dataIN['coordinates']) || !isset($dataIN['categoryid']) || !isset($dataIN['organizerid'])) {
//     echo json_encode(["error" => "All fields (title, info, date, time, address, coordinates, categoryid, organizerid) are required."]);
//     exit;
// }



$eventid = (int) intval($dataIN['eventid']);



$host = 'localhost';
$username = 'pmaUser';
$password_db = 'pma';
$dbname = 'event_app_db';


$conn = new mysqli($host, $username, $password_db, $dbname);


if (isset($_POST['eventid']) && !empty($_POST['eventid'])) {

    $eventid = intval($_POST['eventid']);


$stmt = $conn->prepare("DELETE FROM `EVENT` WHERE `EVENTID` = ?");
$stmt->bind_param("i", $eventid);


if ($stmt->execute()) {
    echo json_encode(["message" => "Event deleted successfully."]);
} else {
    echo json_encode(["error" => "Error deleting event: " . $stmt->error]);
}

$stmt->close();
$conn->close();
} else {
    echo "Error: Eventid is required and cannot be null.";
}


?>

