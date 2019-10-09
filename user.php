<?php
    class User {
        private $id;
        private $firstName;
        private $lastName;
        private $email;
        private $password;
        private $role;
        private $photo;

        function __construct($id, $firstName, $lastName, $password, $email, $photo, $role) {
            $this->id = $id;
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->email = $email;
            $this->password = $password;
            $this->role = $role;
            $this->photo = $photo;
        }

        function getId() {
            return $this->id; 
        }

        function getFirstName() {
            return $this->firstName; 
        }

        function getLastName() {
            return $this->lastName; 
        }

        function getEmail() {
            return $this->email; 
        }

        function getPassword() {
            return $this->password; 
        }

        function getRole() {
            return $this->role; 
        }

        function getPhoto() {
            return $this->photo; 
        }
    }
?>