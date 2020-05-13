<?php
require_once 'connection.php';

$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);

$todoId = $_REQUEST['todo_id'];
$todoTask = $data['task'];
$success = false;

try {
    $sql = "UPDATE todos SET task='{$todoTask}' WHERE id =?";
    $statement = $connection->prepare($sql);
    $success = $statement->execute([$todoId]);
}
catch (PDOException $e) {
    echo $e->getMessage();
}

echo json_encode([
    'success' => $success
]);
