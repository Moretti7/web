<?php
require_once '../connection.php';
require_once '../user.php';

session_start();
$id = $_POST['user'];
$sql = "DELETE FROM users WHERE id=$id;";
$result = $conn->query($sql);

header("Location: /");
?>