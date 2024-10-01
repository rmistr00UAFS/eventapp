<?php

// CORS headers
header("Access-Control-Allow-Origin: *"); // Allow all origins
header("Access-Control-Allow-Methods: GET, POST"); // Allow specific methods
header("Access-Control-Allow-Headers: Content-Type"); // Allow specific headers

require_once 'Database.php';
require_once 'DAO.php';
require_once 'UserDAO.php';

$database = new Database();
$db = $database->getConnection();

$userDAO = new UserDAO($db);

// Fetch users
$users = $userDAO->getUsers();

   // echo "<script>console.log('Debug Objects: " . $users . "' );</script>";

// Return users as JSON
echo json_encode($users);
?>
