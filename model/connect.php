<?php
class Database{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "rogem";
    private $connect;
    
    /*
    |------------------------------------------------------------
    | Function for Connecting database to your site
    |------------------------------------------------------------
    */
    public function connect(){
        $this->connect;
        try {
            $this->connect = new PDO("mysql:host=$this->servername; dbname=$this->database", $this->username, $this->password);
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        return $this->connect;
    }
}
