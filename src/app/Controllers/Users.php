<?php

namespace app\Controllers;

use mysqli;

class Users
{
    private $db;
    private $properties;

    public function __construct(mysqli $db, $properties)
    {
        $this->db = $db;
        $this->properties = $properties;
    }


    public static function getAll(mysqli $db)
    {
        $sql = "SELECT users.`id`, `first_name`, `last_name`, `password`, `email`, `title` FROM users INNER JOIN role ON users.role_id = role.id ORDER BY users.id;";
        $result = $db->query($sql);
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $user = [];
            $user['id'] = $row['id'];
            $user["first_name"] = $row["first_name"];
            $user["last_name"] = $row["last_name"];
            $user["password"] = $row["password"];
            $user["email"] = $row["email"];
            $user["role"] = $row["title"];
            array_push($users, $user);
        }

        return $users;
    }

    public static function getById(mysqli $db, $userId)
    {
        $sql = "SELECT users.`id`, `first_name`, `last_name`, `password`, `email`, `title` FROM users INNER JOIN role ON users.role_id = role.id WHERE users.id = '$userId';";
        return self::getUser($db, $sql);
    }

    public static function login(mysqli $db, $email, $password)
    {
        $sql = "SELECT users.`id`, `first_name`, `last_name`, `password`, `email`, `title` 
                FROM users INNER JOIN role ON users.role_id = role.id WHERE users.email = '$email' AND users.password = '$password';";
        return self::getUser($db, $sql);
    }

    public static function update(mysqli $db, $userId, string $firstName,
                                  string $email, string $lastName, string $password, string $role)
    {
        $roleId = $role == 'admin' ? 2 : 1;
        $sql = "UPDATE users SET first_name='$firstName', email='$email', last_name='$lastName',";
        if (isset($password) && $password != '')
        {
            $sql = $sql . "password='$password',";
        }

        $sql = $sql . "role_id=$roleId WHERE id='$userId'";
        $db->query($sql);
        return self::getById($db, $userId);
    }

    public static function deleteById(mysqli $db, $userId)
    {
        $sql = "DELETE FROM users WHERE id='$userId'";
        return $db->query($sql);
    }

    /**
     * @param mysqli $db
     * @param string $sql
     * @return array
     */
    public static function getUser(mysqli $db, string $sql)
    {
        $result = $db->query($sql);
        $user = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $user['id'] = $row['id'];
                $user["firstName"] = $row["first_name"];
                $user["lastName"] = $row["last_name"];
                $user["password"] = $row["password"];
                $user["email"] = $row["email"];
                $user["role"] = $row["title"];
            }
        }

        return $user;
    }

    public function saveNew()
    {
        $firstName = $this->properties['firstName'] ?? '';
        $lastName = $this->properties['lastName'] ?? '';
        $email = $this->properties['email'] ?? '';
        $password = $this->properties['password'] ?? '';
        $roleId = $this->properties['role'] == 'admin' ? 2 : 1;
        $sql = "INSERT INTO users (first_name, last_name, email, `password`, `role_id`) VALUES ('$firstName', '$lastName', '$email', '$password', $roleId);";
        $this->db->query($sql);

        $subject = "test-mail\n";
        $message = "Test message from php mail";

//        $result = mail($email, $subject, $message);
        return $this;
    }


}