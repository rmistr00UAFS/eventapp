<?php

// CORS headers
header("Access-Control-Allow-Origin: *"); // Allow all origins
header("Access-Control-Allow-Methods: GET, POST"); // Allow specific methods
header("Access-Control-Allow-Headers: Content-Type"); // Allow specific headers



// Get the input from the request
$data = json_decode(file_get_contents('php://input'), true);

$user = $data['username']."jsd";

echo json_encode($user);

// $email = $data['email'];
//
// // Validate input
// if (empty($user) || empty($email)) {
//     echo json_encode(["success" => false, "message" => "All fields are required."]);
//     exit();
// }

// // Prepare and bind
// $stmt = $conn->prepare("INSERT INTO users (username, email) VALUES (?, ?)");
// $stmt->bind_param("ss", $user, $email);
//
// // Execute the statement
// if ($stmt->execute()) {
//     echo json_encode(["success" => true]);
// } else {
//     echo json_encode(["success" => false, "message" => "Error: " . $stmt->error]);
// }

// // Close connection
// $stmt->close();
// $conn->close();
?>
