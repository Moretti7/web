<?php

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
        $sql = "SELECT users.`id`, `first_name`, `last_name`, `password`, `email`, `title` FROM users INNER JOIN role ON users.role_id = role.id;";
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
        $result = $db->query($sql);
        $user = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
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

    public static function update(mysqli $db, $userId, string $name, string $email)
    {
        echo "userId=$userId; name=$name; email=$email \n\n\n\n";
        $sql = "UPDATE users SET first_name='$name', email='$email' WHERE id='$userId'";
        $db->query($sql);

        return self::getById($db, $userId);
    }

    public static function deleteById(mysqli $db, $userId)
    {
        $sql = "DELETE FROM users WHERE id='$userId'";
        return $db->query($sql);
    }

    public function saveNew()
    {
        $name = $this->properties['name'];
        $email = $this->properties['email'];

        $sql = "INSERT INTO users (first_name, last_name, email, `password`, `role_id`) VALUES ('$name', 'placeholder', '$email', 'placeholder', 2);";
        $this->db->query($sql);

        return $this;
    }


}