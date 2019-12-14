<?php

namespace app\Controllers;

use mysqli;
use Dotenv\Dotenv;

class Db
{
    private $host;
    private $user;
    private $password;
    private $dbName;

    public function __construct()
    {
        $dotEnv = Dotenv::createImmutable(__DIR__ . '/../../../');//change to path to .env
        $dotEnv->load();
        $this->host = getenv('DB_HOST');
        $this->password = getenv('DB_PASSWORD');
        $this->user = getenv('DB_USER');
        $this->dbName = getenv('DB_DATABASE');

    }

    function getConnect()
    {
        $conn = new mysqli($this->host, $this->user, $this->password, $this->dbName);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }
}