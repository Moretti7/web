<?php 
    require_once '../connection.php';


    if (isset($_GET['sort'])) {
        $sort = $_GET['sort'];
        $sql = "SELECT users.`id`, `first_name`, `last_name`, `password`, `email`, `photo`, `title` FROM users INNER JOIN role ON users.role_id = role.id ORDER BY $sort;";
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
    } if (isset($_GET['search'])) {
        $search = $_GET['search'];
        $value = $_GET['value'];
        $sql = "SELECT users.`id`, `first_name`, `last_name`, `password`, `email`, `photo`, `title` FROM users INNER JOIN role ON users.role_id = role.id WHERE $search LIKE '%$value%';";
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
    } else {
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
    }
?>