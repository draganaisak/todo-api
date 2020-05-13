<?php
require_once 'connection.php';

$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);

$username = $data['username'];
$password = $data['password'];
$success = false;

try {
    $userInsert = "INSERT INTO users (username, password) VALUES (?, ?)";
    $statement = $connection->prepare($userInsert);
    $success = $statement->execute([$username, $password]);
}
catch (PDOException $e) {
    echo $e->getMessage();
}
echo json_encode([
    'success' => $success
]);
