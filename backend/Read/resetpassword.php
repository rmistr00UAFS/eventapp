<?php
// Set CORS headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

$dataIN = json_decode(file_get_contents('php://input'), true);

if (!isset($dataIN['email'])) {
    echo json_encode(["error" => "Email is required"]);
    exit;
}

$email = $dataIN['email'];

$host = 'localhost';
$username = 'pmaUser';
$password_db = 'pma';
$dbname = 'event_app_db';

$conn = new mysqli($host, $username, $password_db, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// Check if the email exists
$stmt = $conn->prepare("SELECT EMAIL FROM USER WHERE EMAIL = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo json_encode(["error" => "No user found with this email address"]);
    exit;
}

// Generate a random password
function generateRandomPassword($length = 12) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()';
    $charactersLength = strlen($characters); for ($i = 0; $i < $length; $i++) {
        $randomPassword .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomPassword;
}

$new_password = generateRandomPassword();
$hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

// Update the user's password
$stmt = $conn->prepare("UPDATE USER SET PASSWORD = ? WHERE EMAIL= ?");
$stmt->bind_param("ss", $hashed_password, $email);
$stmt->execute();

// Send the email
$subject = "Your New Password";
$message = "Your new password is: $new_password\nPlease change it after logging in.";
$headers = "From: no-reply@yourapp.com";

if (mail($email, $subject, $message, $headers)) {
    echo json_encode(["message" => "New password sent to your email"]);
} else {
    echo json_encode(["error" => "Failed to send email"]);
}

$stmt->close();
$conn->close();
?>
