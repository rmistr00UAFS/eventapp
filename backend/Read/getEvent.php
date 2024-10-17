<?php

// Set CORS headers
header("Access-Control-Allow-Origin: *"); // Allow all origins (change this to a specific origin if needed)
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // Allowed methods
header("Access-Control-Allow-Headers: Content-Type"); // Allowed headers
header("Content-Type: application/json"); // Return JSON response

$dataIN = json_decode(file_get_contents('php://input'), true);


if (!isset($dataIN['email']) || !isset($dataIN['password'])) {
    echo json_encode(["error" => "Email and password are required."]);
    exit;
}

$email = strval($dataIN['email']);
$password = strval($dataIN['password']);


$host = 'localhost';
$username = 'pmaUser';
$password_db = 'pma';
$dbname = 'event_app_db';


$conn = new mysqli($host, $username, $password_db, $dbname);


if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}


$stmt = $conn->prepare("SELECT * FROM `USER` WHERE `EMAIL` = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();


$user = null;

if ($result) {
    if ($result->num_rows > 0) {

        $user = $result->fetch_assoc();
    } else {
        echo json_encode(["error" => "No user found with that email."]);
        exit;
    }
} else {
    echo json_encode(["error" => "SQL error: " . $conn->error]);
    exit;
}


if (password_verify($password, $user['PASSWORD'])) {
    echo json_encode(["message" => "Login successful.", "userid" => $user['USERID']]);

} else {
    echo json_encode(["error" => "Invalid password."]);
}


$stmt->close();
$conn->close();
?>
