<?php
class Database{
  
    // specify your own database credentials
    private $host = "localhost"; //your host name
    private $db_name = "test_api";   //your database name
    private $username = "root"; //username of database server
    private $password = "";     //password of database server
    public $conn; 
    // get the database connection
    public function __construct(){
        try{
            $db = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $db->exec("set names utf8");
            $this->conn = $db;
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
    }
    public function filter($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>