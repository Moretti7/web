<?php

namespace app\Controllers;

use mysqli;

class Db
{
    function getConnect()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "web";
        $conn = new mysqli($servername, $username, $password, $database);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }
}