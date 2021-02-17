<?php


include $_SERVER['DOCUMENT_ROOT'].'\smd\config\database.php';



class Short {
    //Database
    private $conn;
    private $table = 'urls';

    //Table columns
    public $id;
    public $original;
    public $shortened;
    public $creation_date;
    public $expiry_date;
    public $renewable;
    public $active_period;
    public $is_enabled;

    
    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }


    //Get all
    public function getAll() {
        $query ="SELECT * FROM " . $this->table ;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

     //Get single
     public function getOneUrl() {
        $query = "SELECT
                        id, 
                        original, 
                        shortened, 
                        creation_date, 
                        expiry_date, 
                        renewable,
                        active_period,
                        is_enabled
                    FROM
                        ". $this->table ."
                            WHERE 
                            id = ?
                            LIMIT 0,1";

                    $stmt = $this->conn->prepare($query);
                    
                    $stmt->bindParam(1, $this->id);

                    $stmt->execute();

                    $data = $stmt->fetch(PDO::FETCH_ASSOC);

                    $this->original = $data['original'];
                    $this->shortened = $data['shortened'];
                    $this->creation_date = $data['creation_date'];
                    $this->expiry_date = $data['expiry_date'];
                    $this->renewable = $data['renewable'];
                    $this->active_period = $data['active_period'];
                    $this->is_enabled = $data['is_enabled'];
                    
    }

    //Get URL by generated code
    public function getOneUrlByShort() {
        $query = "SELECT
                        id, 
                        original, 
                        shortened, 
                        creation_date, 
                        expiry_date, 
                        renewable,
                        active_period,
                        is_enabled
                    FROM
                        ". $this->table ."
                            WHERE 
                            shortened = ?
                            LIMIT 0,1";

                    $stmt = $this->conn->prepare($query);
                    
                    $stmt->bindParam(1, $this->shortened);

                    $stmt->execute();

                    $data = $stmt->fetch(PDO::FETCH_ASSOC);

                    $this->original = $data['original'];
                    $this->shortened = $data['shortened'];
                    $this->creation_date = $data['creation_date'];
                    $this->expiry_date = $data['expiry_date'];
                    $this->renewable = $data['renewable'];
                    $this->active_period = $data['active_period'];
                    $this->is_enabled = $data['is_enabled'];
                    
    }

    //Get data by using the original URL
    public function fetchByUrl() {
        $query = "SELECT
                        id, 
                        original, 
                        shortened, 
                        creation_date, 
                        expiry_date, 
                        renewable,
                        active_period,
                        is_enabled
                    FROM
                        ". $this->table ."
                            WHERE 
                            original = ?
                            LIMIT 0,1";

                    $stmt = $this->conn->prepare($query);
                    
                    $stmt->bindParam(1, $this->original);

                    $stmt->execute();

                    $data = $stmt->fetch();

                 return $data;

    }

    //Get all renewable
    public function getAllRenewable() {
        $query = "SELECT * FROM ".$this->table." WHERE renewable = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }


    //Get all active 
    public function getAllActive() {
        $query = "SELECT * FROM ".$this->table." WHERE expiry_date > CURDATE() AND is_enabled = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    //Get all disabled and expired 
    public function getDisabledOrExpired() {
        $query = "SELECT * FROM ".$this->table." WHERE expiry_date < CURDATE() OR is_enabled = 0";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }


    //Delete url
    public function deleteUrl() {
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $this->id=htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(1, $this->id);
        if($stmt->execute()) {
            return true;
        }else {
            printf('Error: $s. ', $stmt->error);
            return false; 
        }
    }

    //Update url
    public function updateUrl() {
        $query = "UPDATE
                        ". $this->table ."
                    SET
                        original = :original, 
                        shortened = :shortened, 
                        creation_date = :creation_date, 
                        expiry_date = :expiry_date, 
                        renewable = :renewable,
                        active_period = :active_period,
                        is_enabled = :is_enabled
                    WHERE 
                        id = :id";


        $stmt = $this->conn->prepare($query);


            $this->original=htmlspecialchars(strip_tags($this->original));
            $this->shortened=htmlspecialchars(strip_tags($this->shortened));
            $this->creation_date=htmlspecialchars(strip_tags($this->creation_date));
            $this->expiry_date=htmlspecialchars(strip_tags($this->expiry_date));
            $this->renewable=htmlspecialchars(strip_tags($this->renewable));
            $this->id=htmlspecialchars(strip_tags($this->id));
            $this->is_enabled=htmlspecialchars(strip_tags($this->is_enabled));

            $stmt->bindParam(":original", $this->original);
            $stmt->bindParam(":shortened", $this->shortened);
            $stmt->bindParam(":creation_date", $this->creation_date);
            $stmt->bindParam(":expiry_date", $this->expiry_date);
            $stmt->bindParam(":renewable", $this->renewable);
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":active_period", $this->active_period);
            $stmt->bindParam(":is_enabled", $this->is_enabled);
        
            if($stmt->execute()){
               return true;
            }else {
                printf('Error: $s. ', $stmt->error);
                return false;
            }
        }

        //Renews URL expiration
        public function renewUrl($short,$expiration, $renewable) {
            $query = "UPDATE
            ". $this->table ."
        SET
            expiry_date = :expiration, 
            renewable = :renewable
        WHERE 
            shortened = :short";

            $stmt = $this->conn->prepare($query);

            
            $expiration=htmlspecialchars(strip_tags($expiration));
            $renewable=htmlspecialchars(strip_tags($renewable));

            $stmt->bindParam(":expiration", $expiration);
            $stmt->bindParam(":renewable", $renewable);
            $stmt->bindParam(":short", $short);

            if($stmt->execute()){
                return true;
             }else {
                 printf('Error: $s. ', $stmt->error);
                 return false;
             }
        }


        //Save new URL in the database
        public function save() {
            $query = "INSERT INTO
                        ". $this->table ."
                    SET
                        original = :original, 
                        shortened = :shortened, 
                        expiry_date = :expiry_date, 
                        renewable = :renewable, 
                        active_period = :active_period,
                        is_enabled = :is_enabled";

         $stmt = $this->conn->prepare($query);
         
         //sanitize data
         $this->original=htmlspecialchars(strip_tags($this->original));
         $this->shortened=htmlspecialchars(strip_tags($this->shortened));
         $this->expiry_date=htmlspecialchars(strip_tags($this->expiry_date));
         $this->renewable=htmlspecialchars(strip_tags($this->renewable));
        
         //bind data
            $stmt->bindParam(":original", $this->original);
            $stmt->bindParam(":shortened", $this->shortened);
            $stmt->bindParam(":expiry_date", $this->expiry_date);
            $stmt->bindParam(":renewable", $this->renewable);
           $stmt->bindParam(":is_enabled", $this->is_enabled);
            $stmt->bindParam(":active_period", $this->active_period);

            if($stmt->execute()){
                return true;
             }else {
                printf('Error: $s. ', $stmt->error);
                return false;
             }
        }



        //Get expiry_date from generated code
        public function getExpiryFromShortened($short) {
            $query = "SELECT expiry_date FROM ".$this->table." WHERE shortened = :shortened";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':shortened', $short);
            $stmt->execute();
            $row = $stmt->rowCount();
            if($row > 0){
                return $stmt->fetch();
            }
        }

        //Get URL by using generated code as parameter
        public function getUrl($code) {
            $query = "SELECT original FROM ".$this->table." WHERE shortened = :shortened";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':shortened', $code);
            $stmt->execute();
            $row = $stmt->rowCount();
            if($row > 0){
                return $stmt->fetch();
            }
        
        }
    
        //Checks if data exists in database if they don't creates new data
        public function findOrCreateUrl () {
            $data = $this->fetchByUrl();
            
            if($data){

                return $data;

            }else {
                $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_';
                $code = $this->generateString($permitted_chars, 7);
                $this->shortened = $code;
                $this->save();
                return $this;
            }
        }
      
        //Generates unique code to bind with original URL
       private function generateString($input, $strength = 7) {
        
            $input_length = strlen($input);
            $random_string = '';
            for($i = 0; $i < $strength; $i++) {
                $random_character = $input[mt_rand(0, $input_length - 1)];
                $random_string .= $random_character;
            }
        
            return $random_string;
        }
   


        // Disables URL in admin page
        public function disableUrl(){
            $query = "UPDATE
            ". $this->table ."
        SET
            is_enabled = 0
        WHERE 
            id = :id";

            $stmt = $this->conn->prepare($query);

            
            $id=htmlspecialchars(strip_tags($this->id));

            $stmt->bindParam(":id", $id);

            if($stmt->execute()){
                return true;
             }else {
                 printf('Error: $s. ', $stmt->error);
                 return false;
             }
        
        }


        // Enable URL in admin page
        public function enableUrl(){
            $query = "UPDATE
            ". $this->table ."
        SET
            is_enabled = 1
        WHERE 
            id = :id";

            $stmt = $this->conn->prepare($query);

            
            $id=htmlspecialchars(strip_tags($this->id));

            $stmt->bindParam(":id", $id);

            if($stmt->execute()){
                return true;
             }else {
                 printf('Error: $s. ', $stmt->error);
                 return false;
             }
        
        }
}


























?>