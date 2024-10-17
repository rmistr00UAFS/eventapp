
<?php

// Set CORS headers
header("Access-Control-Allow-Origin: *"); // Allow all origins (change this to a specific origin if needed)
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // Allowed methods
header("Access-Control-Allow-Headers: Content-Type"); // Allowed headers
header("Content-Type: application/json"); // Return JSON response


$dataIN = json_decode(file_get_contents('php://input'), true);

$USERID = (int)$dataIN['userid'];


$host = 'localhost';
$username = 'pmaUser';
$password_db = 'pma';
$dbname = 'event_app_db';


$conn = new mysqli($host, $username, $password_db, $dbname);


if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}



$stmt = $conn->prepare("
    SELECT e.*
    FROM `EVENT` e
    INNER JOIN `SAVED_EVENTS` se ON e.EVENTID = se.EVENTID
    WHERE se.USERID = ?
");


$stmt->bind_param("i", $USERID);
$stmt->execute();
$result = $stmt->get_result();


$events = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }

    if (!empty($events)) {
        echo json_encode(["message" => "Events retrieved successfully.", "events" => $events]);
    } else {
        echo json_encode(["message" => "No events found."]);
    }
} else {
    echo json_encode(["error" => "SQL error: " . $conn->error]);
    exit;
}

$stmt->close();
$conn->close();
?>
