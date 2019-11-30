<?php 
    require_once '../connection.php';

    $email = $_GET['email'];

    $sql = "SELECT `email` FROM users WHERE email = '$email';";
    $result = $conn->query($sql);

    if ($row = $result->fetch_assoc()) {
        echo $sql;
    } else {
        echo 'ok';
    }

?>