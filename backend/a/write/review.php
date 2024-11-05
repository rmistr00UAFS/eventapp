<?php

// Set CORS headers
header("Access-Control-Allow-Origin: *"); // Allow all origins (change this to a specific origin if needed)
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // Allowed methods
header("Access-Control-Allow-Headers: Content-Type"); // Allowed headers
header("Content-Type: application/json"); // Return JSON response

// Get the JSON input
$dataIN = json_decode(file_get_contents('php://input'), true);

// echo json_encode($dataIN);



$userid = intval($dataIN['userid']);
$eventid = intval($dataIN['eventid']);
$comment = strval($dataIN['comment']);
$stars = intval($dataIN['stars']);




$databaseHost = '127.0.0.1';        # IP address of the DB server (localhost)
$databaseUsername = 'pmaUser';      # username used to access DB (must have been granted privileges to the EVENT_FINDER DB)
$databasePassword = 'pma';       # password of the above username
$databaseName = 'D';     # DB name


# Initiating the connection to the DB
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);



   $stmt = $mysqli->prepare("INSERT INTO `REVIEWS` ( `USERID`, `EVENTID`, `COMMENT`,`STARS`) VALUES ( ?, ?, ?,?)");
    $stmt->bind_param("iisi", $userid, $eventid, $comment,$stars);


    $stmt->execute();


    echo json_encode("review added");
?>

