<?php

// Set CORS headers
header("Access-Control-Allow-Origin: *"); // Allow all origins (change this to a specific origin if needed)
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // Allowed methods
header("Access-Control-Allow-Headers: Content-Type"); // Allowed headers
header("Content-Type: application/json"); // Return JSON response

// Get the JSON input
$dataIN = json_decode(file_get_contents('php://input'), true);

// Ensure the input is valid
if (!isset($dataIN['email']) || !isset($dataIN['password']) || !isset($dataIN['firstname']) || !isset($dataIN['lastname']) || !isset($dataIN['phone']) || !isset($dataIN['address'])) {
    echo json_encode(["error" => "All fields (email, password, firstname, lastname, phone, address) are required."]);
    exit;
}

// Retrieve and sanitize input
$firstname = strval($dataIN['firstname']);
$lastname = strval($dataIN['lastname']);
$email = strval($dataIN['email']);
$password = strval($dataIN['password']);
$phone = strval($dataIN['phone']);
$address = strval($dataIN['address']);

// Database connection parameters
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
$stmt = $conn->prepare("SELECT * FROM `USER` WHERE `EMAIL` = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode(["error" => "Email already exists."]);
    exit;
}

// Hash the password for security
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Prepare and execute the insert query
$stmt = $conn->prepare("INSERT INTO `USER` (`FIRSTNAME`, `LASTNAME`, `EMAIL`, `password`, `PHONE`, `ADDRESS`) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $firstname, $lastname, $email, $hashedPassword, $phone, $address);

if ($stmt->execute()) {
    echo json_encode(["message" => "User created successfully."]);
} else {
    echo json_encode(["error" => "Error creating user: " . $stmt->error]);
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>

