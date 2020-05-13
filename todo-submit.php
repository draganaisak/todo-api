<?php
require_once 'connection.php';

$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);

$userId = $_GET['id'];
$task = $data['task'];
$success = false;

try {
    $todoInsert = "INSERT INTO todos (user_id, task) VALUES (?, ?)";
    $statement = $connection->prepare($todoInsert);
    $success=$statement->execute([$userId, $task]);
}
catch (PDOException $e) {
    echo $e->getMessage();
}

echo json_encode([
    'success' => $success
]);
