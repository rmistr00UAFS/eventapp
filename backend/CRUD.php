<?php

// CORS headers
header("Access-Control-Allow-Origin: *"); // Allow all origins
header("Access-Control-Allow-Methods: GET, POST"); // Allow specific methods
header("Access-Control-Allow-Headers: Content-Type"); // Allow specific headers

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

require_once 'Database.php';
require_once 'DAO.php';
require_once 'UserDAO.php';

$database = new Database();
$db = $database->getConnection();

$userDAO = new UserDAO($db);


$firstname = 'John';
$lastname = 'Doe';
$password = 'secret';
$email = 'john@example.com';
$phone = '1234567890';
$address = '123 Main St, Springfield';

#$userDAO->createUser($userid, $firstname, $lastname, $password, $email, $phone, $address);

$users = $userDAO->getUsers();

   // echo "<script>console.log('Debug Objects: " . json_encode($users) . "' );</script>";

echo "<h2>User Table:</h2>";
echo "<table border='1'>";
echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone</th><th>Address</th></tr>";

foreach ($users as $user) {
    echo "<tr>";
    echo "<td>" . $user['USERID'] . "</td>";
    echo "<td>" . $user['FIRSTNAME'] . "</td>";
    echo "<td>" . $user['LASTNAME'] . "</td>";
    echo "<td>" . $user['EMAIL'] . "</td>";
    echo "<td>" . $user['PHONE'] . "</td>";
    echo "<td>" . $user['ADDRESS'] . "</td>";
    echo "</tr>";
}

echo "</table>";

?>
