<?php
// Set CORS headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

$dataIN = json_decode(file_get_contents('php://input'), true);



// Send the email
$to      = "ronakmystery@gmail.com";
// The message
$message = "wskwjbs";


// Send
mail($to, 'My Subject', $message);
?>
