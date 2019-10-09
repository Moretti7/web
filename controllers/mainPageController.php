<?php
require_once 'connection.php';
require_once 'user.php';

$sql = "SELECT users.`id`, `first_name`, `last_name`, `password`, `email`, `photo`, `title` FROM users INNER JOIN role ON users.role_id = role.id;";
$result = $conn->query($sql);
$users = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $id = $row["id"];
        $firstName = $row["first_name"];
        $lastName = $row["last_name"];
        $password = $row["password"];
        $email = $row["email"];
        $photo = $row["photo"];
        $title = $row["title"];
        $user = new User($id, $firstName, $lastName, $password, $email, $photo, $title);
        array_push($users, $user);
	}
}

?>