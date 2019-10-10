<?php
require_once '../connection.php';
require_once '../user.php';

session_start();
$id = $_POST['user'];
$email = $_POST["email"];
$password = $_POST['password'];
$name = $_POST['name'];
$surname = $_POST['surname'];
$sql = "UPDATE users SET email='$email', password='$password', first_name='$name', last_name='$surname' WHERE id=$id;";
$result = $conn->query($sql);

header("Location: /");
?>