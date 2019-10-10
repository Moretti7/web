<?php

require_once '../connection.php';

$email = $_POST['email'];
$name = $_POST['name'];
$surname = $_POST['surname'];
$password = $_POST['password'];
$role = $_POST['role'] == 'admin' ? 2 : 1;

$sql = "INSERT INTO users (first_name, last_name, email, `password`, `role_id`) VALUES ('$name', '$surname', '$email', '$password', '$role');";
$conn->query($sql);

header("Location: /login.php");
?>