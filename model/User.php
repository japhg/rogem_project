<?php
class User
{
    public $connect;
    public $username;
    public $password;

    public function __construct($connect)
    {
        $this->connect = $connect;
    }

    /*
    |------------------------------------------------------------
    | Function for Login
    |------------------------------------------------------------
    */
    public function login()
    {
        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(1, $this->username);
        if ($stmt->execute()) {
            return $stmt;
        }
    }

    /*
    |------------------------------------------------------------
    | Function for Registering new user
    |------------------------------------------------------------
    */
    public function register($data = [])
    {
        $query = "INSERT INTO users(username, password, firstname, middlename, lastname, email_address) 
        VALUES(?, ?, ?, ?, ?, ?)";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(1, $data['username']);
        $stmt->bindParam(2, $data['password']);
        $stmt->bindParam(3, $data['firstname']);
        $stmt->bindParam(4, $data['middlename']);
        $stmt->bindParam(5, $data['lastname']);
        $stmt->bindParam(6, $data['email_address']);
        if ($stmt->execute()) {
            return $stmt;
        }
    }
    

    /*
    |------------------------------------------------------------
    | Function for saving logs
    |------------------------------------------------------------
    */
    public function logs($username, $name, $usertype, $count)
    {
        $query = "INSERT INTO logs (username, name, user_type, count_visit) VALUES (?, ?, ?, ?)";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $name);
        $stmt->bindParam(3, $usertype);
        $stmt->bindParam(4, $count);
        if ($stmt->execute()) {
            return $stmt;
        }
    }

    /*
    |------------------------------------------------------------
    | Function for getting all users - Super Admin part
    |------------------------------------------------------------
    */
    public function getAllUsers()
    {
        $query = "SELECT * FROM users";
        $stmt = $this->connect->prepare($query);
        if ($stmt->execute()) {
            return $stmt;
        }
    }

    /*
    |------------------------------------------------------------
    | Function for adding new user - Super Admin part
    |------------------------------------------------------------
    */
    public function addUsers($data = [])
    {
        $query = "INSERT INTO users(username, password, firstname, middlename, lastname, email_address, user_type) 
        VALUES(?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(1, $data['username']);
        $stmt->bindParam(2, $data['password']);
        $stmt->bindParam(3, $data['firstname']);
        $stmt->bindParam(4, $data['middlename']);
        $stmt->bindParam(5, $data['lastname']);
        $stmt->bindParam(6, $data['email_address']);
        $stmt->bindParam(7, $data['user_type']);
        if ($stmt->execute()) {
            return $stmt;
        }
    }

    /*
    |------------------------------------------------------------
    | Function for selecting user with ID - Super Admin part
    |------------------------------------------------------------
    */
    public function getUser($id)
    {
        $query = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(1, $id);
        if($stmt->execute()) {
            return $stmt;
        }
    }

    /*
    |------------------------------------------------------------
    | Function for updating user - Super Admin part
    |------------------------------------------------------------
    */
    public function updateUser($data = [])
    {
        $query = "UPDATE users SET username = ?, firstname = ?, middlename = ?, lastname = ?, email_address = ?, user_type = ? WHERE id = ?";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(1, $data['username']);
        $stmt->bindParam(2, $data['firstname']);
        $stmt->bindParam(3, $data['middlename']);
        $stmt->bindParam(4, $data['lastname']);
        $stmt->bindParam(5, $data['email_address']);
        $stmt->bindParam(6, $data['user_type']);
        $stmt->bindParam(7, $data['user_id']);
        if ($stmt->execute()) {
            return $stmt;
        }
    }
}