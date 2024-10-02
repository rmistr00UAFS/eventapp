<?php
// Set CORS headers
header("Access-Control-Allow-Origin: *"); // Allow all origins (change this to a specific origin if needed)
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // Allowed methods
header("Access-Control-Allow-Headers: Content-Type"); // Allowed headers

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

require_once 'Database.php';
require_once 'DAO.php';
require_once 'UserDAO.php';

$database = new Database();
$db = $database->getConnection();

$userDAO = new UserDAO($db);


$data = json_decode(file_get_contents('php://input'), true);



$firstname = $data['firstname']; // Changed to array notation
$lastname = $data['lastname']; // Changed to array notation
$password = $data['password']; // Hash this before using in production
$email = $data['email']; // Changed to array notation
$phone = $data['phone']; // Changed to array notation
$address = $data['address']; // Changed to array notation

$firstname = strval($firstname);
$lastname = strval($lastname);
$password = strval($password);
$email = strval($email);
$phone = strval($phone);
$address = strval($address);

// $firstname = 'John';
// $lastname = 'Doe';
// $password = 'secret';
// $email = 'john@example.com';
// $phone = '1234567890';
// $address = '123 Main St, Springfield';


// Create the user using the UserDAO
if($firstname!==''){
$userDAO->createUser($firstname, $lastname, $password, $email, $phone, $address);
}
// if ($result) {
//     echo json_encode(['message' => 'User created successfully']);
// } else {
//     echo json_encode(['message' => 'Failed to create user']);
//     http_response_code(500); // Internal server error
// }
//
echo json_encode($data);

?>
