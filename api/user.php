<?php
require_once '../connection.php';
require_once '../user.php';

function findUser($id, $conn) {
    $sql = "SELECT users.`id`, `first_name`, `last_name`, `password`, `email`, `photo`, `title` FROM users INNER JOIN role ON users.role_id = role.id WHERE users.id = '$id';";
    $result = $conn->query($sql);
    $user = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $id = $row["id"];
            $user['id'] = $row['id'];
            $user["firstName"] = $row["first_name"];
            $user["lastName"] = $row["last_name"];
            $user["password"] = $row["password"];
            $user["email"] = $row["email"];
            $user["photo"] = $row["photo"];
            $user["role"] = $row["title"];
        }
    }
    return $user;
}


switch($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if (isset($_GET['id'])) {
            echo json_encode(findUser($_GET['id'], $conn));
        } else {
            $email = $_GET['email'];
            $password = $_GET['password'];

            $sql = "SELECT users.`id`, `first_name`, `last_name`, `password`, `email`, `photo`, `title` FROM users INNER JOIN role ON users.role_id = role.id WHERE email = '$email' AND password = '$password';";
            $result = $conn->query($sql);
            $user = [];
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $id = $row["id"];
                    $user['id'] = $row['id'];
                    $user["firstName"] = $row["first_name"];
                    $user["lastName"] = $row["last_name"];
                    $user["password"] = $row["password"];
                    $user["email"] = $row["email"];
                    $user["photo"] = $row["photo"];
                    $user["role"] = $row["title"];
                }
            echo json_encode($user);
            }
        }
        break;
    case 'POST':
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
        echo 'successful';
        break;
    case 'PUT':
        $params = array();
        parse_str(file_get_contents('php://input'), $params);
        
        $sql = "UPDATE users SET ";

        if(isset($params['email'])) {
            $email = $params['email'];
            $sql = $sql . 'email = "' . $email . '", ';
        }

        if(isset($params['name'])) {
            $name = $params['name'];
            $sql = $sql . 'first_name = "' . $name . '", ';
        }

        if(isset($params['surname'])) {
            $surname = $params['surname'];
            $sql = $sql . 'last_name = "' . $surname .'", ';
        }

        if(isset($params['password'])) {
            $password = $params['password'];
            $sql = $sql . 'password = "' . $password.'", ';
        }

        $role = $params['role'] == 'admin' ? 2 : 1;
        $id = $params['id'];
        $sql = $sql . 'role_id = ' . $role . ' WHERE id ='. $id .';';

        echo $sql;

        $conn->query($sql);

        break;
    case 'DELETE':
        $params = array();
        parse_str(file_get_contents('php://input'), $params);
        $id = $params['id'];
        $sql = "DELETE FROM users WHERE id=$id";
        $conn->query($sql);
        echo 'successful';
        break;
    
}