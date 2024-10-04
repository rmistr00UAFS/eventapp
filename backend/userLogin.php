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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get JSON input
    $data = json_decode(file_get_contents("php://input"));

    $email = $data->email;
    $password = $data->password;

    $user = $userDAO->login($email,$password);

    if ($user) {

        if (password_verify($password, $user['password'])) {

            session_start();
            $_SESSION['userid'] = $user['userid'];
            $_SESSION['email'] = $user['email'];

            echo json_encode([
                'message' => 'Login successful',
                'user' => $user
            ]);
        } else {
            http_response_code(401);

            echo json_encode(['message' => 'Invalid password']);
        }
    } else {

        http_response_code(404);
        echo json_encode(['message' => 'User not found']);
    }
} else {

    $users = $userDAO->getUsers();
    echo json_encode($users);
}
?>
