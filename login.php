<?php
include_once("connection.php");

$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);

$username = $data['username'];
$password = $data['password'];
$userFound = false;

try {
    $sql = "SELECT * FROM users WHERE username =? && password =?";
    $statement = $connection->prepare($sql);
    $statement->execute([$username, $password]);
    $user = $statement->fetch();
}
catch (PDOException $e) {
    echo $e->getMessage();
}
if(!empty($user)) {
    $userFound = true;
}

echo json_encode([
    'success' => $userFound,
    'user' => [
        'username' => $user['username'],
        'id' => $user['id']
    ],
    'token' => 123
]);
