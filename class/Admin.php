<?php
    
include '../config/database.php';
    
class Admin {
        private $conn;
        private $table = 'login_system';
        public $id;
        public $username;
        public $password;

        public function __construct() {
            $database = new Database();
            $this->conn = $database->connect();
        }

        //Authenticates user
        public function isAdmin($user, $pass) {
            $query = 'SELECT * FROM '.$this->table.' WHERE username = :user  AND password = :pass';
            $stmt = $this->conn->prepare($query);
            $cleanUser = htmlspecialchars($user);
            $cleanPass = htmlspecialchars($pass);
            
            $stmt->bindParam(":user", $cleanUser);
            $stmt->bindParam(":pass", $cleanPass);
            
            if($stmt->execute()){
                $row = $stmt->rowCount();
                if($row == 0){
                    return false;
                }else {
                     return true;
                }
            }else {
                echo json_encode("Error while executing");
            }


        }
    }



?>