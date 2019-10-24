<?php 
    require_once '../connection.php';

    $sql = "SELECT users.`id`, `first_name`, `last_name`, `password`, `email`, `photo`, `title` FROM users INNER JOIN role ON users.role_id = role.id;";
    $result = $conn->query($sql);

    $response = [];
    while($row = $result->fetch_assoc()) {
        $user = [];
        $user['id'] = $row['id'];
        $user["first_name"] = $row["first_name"];
        $user["last_name"] = $row["last_name"];
        $user["password"] = $row["password"];
        $user["email"] = $row["email"];
        $user["photo"] = $row["photo"];
        $user["role"] = $row["title"];

        array_push($response, $user);
    }
    echo json_encode($response);
?>