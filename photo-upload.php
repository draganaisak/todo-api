<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'connection.php';
require_once 'photo-get.php';

$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);

$file_name = uniqid().date("Y-m-d-H-i-s").md5($_FILES['file']['name']);

$destination = 'user_images/'.$file_name;

$filename = $_FILES['file']['tmp_name'];

$userId = $_GET['id'];

$success = false;

if(empty($photo)) {
    try {
        $sql = "INSERT INTO photos (user_id, photo) VALUES (?, ?)";
        $statement = $connection->prepare($sql);
        $success = $statement->execute([$userId, $destination]);
        if ($success) {
            move_uploaded_file($filename, $destination);
        }
    }
    catch (PDOException $e) {
        echo $e->getMessage();
    }
} else {
    try {
        $sql = "UPDATE photos SET photo= '$destination' WHERE user_id='$userId'";
        $statement = $connection->prepare($sql);
        $success = $statement->execute();
        if ($success) {
            move_uploaded_file($filename, $destination);
        }
    }
    catch (PDOException $e) {
        echo $e->getMessage();
    }
}

