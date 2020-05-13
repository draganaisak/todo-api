<?php
require_once 'connection.php';

$username = $_GET['username'];
$success = false;

try {
    $sql = "SELECT username FROM users WHERE username =?";
    $statement = $connection->prepare($sql);
    $statement->execute([$username]);
    $users = $statement->fetch();
}
catch (PDOException $e) {
    echo $e->getMessage();
}
if(!empty($users)) {
    $success = true;
}

echo json_encode([
    'success' => $success
]);
