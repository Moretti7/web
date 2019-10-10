<?php
require_once '../connection.php';
require_once '../user.php';

session_start();
$id = $_POST['user'];
$email = $_POST["email"];
$password = $_POST['password'];
$name = $_POST['name'];
$surname = $_POST['surname'];
$role = $_POST['role'] == 'admin' ? 2 : 1;

$dir = "../public/images";
$filename = $_FILES["avatar"]["name"];
$path = $dir . "/" . $filename;

if ($filename != null) {
    move_uploaded_file($_FILES["avatar"]["tmp_name"], $path);
    $sql = "UPDATE users SET email='$email', password='$password', first_name='$name', last_name='$surname', role_id=$role, photo='$path' WHERE id=$id;";
} else
    $sql = "UPDATE users SET email='$email', password='$password', first_name='$name', last_name='$surname', role_id=$role WHERE id=$id;";
$result = $conn->query($sql);

header("Location: /");
?>