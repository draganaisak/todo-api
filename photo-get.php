<?php
require_once 'connection.php';

$userId = $_GET['id'];
$photo = null;

try {
    $sql = "SELECT * FROM photos WHERE user_id =?";
    $statement = $connection->prepare($sql);
    $statement->execute([$userId]);
    $photo = $statement->fetch();
}
catch (PDOException $e) {
    echo $e->getMessage();
}

echo json_encode($photo);