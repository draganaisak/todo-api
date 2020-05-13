<?php
require_once 'connection.php';

$todoId = $_REQUEST['todo_id'];
$success = false;

try {
    $sql = "DELETE FROM todos WHERE id =?";
    $statement = $connection->prepare($sql);
    $success = $statement->execute([$todoId]);
}
catch (PDOException $e) {
    echo $e->getMessage();
}

echo json_encode([
    'success' => $success
]);


