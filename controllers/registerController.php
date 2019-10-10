<?php

require_once '../connection.php';

$email = $_POST['email'];
$name = $_POST['name'];
$surname = $_POST['surname'];
$password = $_POST['password'];
$role = $_POST['role'] == 'admin' ? 2 : 1;


$dir = "../public/images";
$filename = $_FILES["avatar"]["name"];
$path = $dir . "/" . $filename;
move_uploaded_file($_FILES["avatar"]["tmp_name"], $path);

$sql = "INSERT INTO users (first_name, last_name, email, `password`, `role_id`, photo) VALUES ('$name', '$surname', '$email', '$password', '$role', '$path');";
$conn->query($sql);

header("Location: /login.php");
?>