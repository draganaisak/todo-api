<?php
require_once 'connection.php';

$userId = $_GET['id'];
$success = false;

try {
    $sql = "SELECT * FROM todos WHERE user_id =? ORDER BY created_at DESC";
    $statement = $connection->prepare($sql);
    $statement->execute([$userId]);
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    $tasks = $statement->fetchAll();
}
catch (PDOException $e) {
    echo $e->getMessage();
}

echo json_encode([
    'success' => $success,
    'results' => $tasks
]);
