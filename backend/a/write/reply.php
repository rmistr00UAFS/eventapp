<?php

// Set CORS headers
header("Access-Control-Allow-Origin: *"); // Allow all origins (change this to a specific origin if needed)
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // Allowed methods
header("Access-Control-Allow-Headers: Content-Type"); // Allowed headers
header("Content-Type: application/json"); // Return JSON response


$dataIN = json_decode(file_get_contents('php://input'), true);

// echo json_encode($dataIN."rep");

$reviewid = intval($dataIN['reviewid']);
$userid = intval($dataIN['userid']);
$reply=$dataIN['reply'];





$databaseHost = '127.0.0.1';        # IP address of the DB server (localhost)
$databaseUsername = 'pmaUser';      # username used to access DB (must have been granted privileges to the EVENT_FINDER DB)
$databasePassword = 'pma';       # password of the above username
$databaseName = 'D';     # DB name


# Initiating the connection to the DB
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);



   $stmt = $mysqli->prepare("INSERT INTO `REPLY` ( `REVIEWID`, `USERID`, `REPLY`) VALUES ( ?, ?, ?)");
    $stmt->bind_param("iis", $reviewid, $userid, $reply);


    $stmt->execute();


    echo json_encode("yes");



?>
