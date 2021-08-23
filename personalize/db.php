<?php
// required headers

 
// database connection will be here
    class Database{
        //LOCAL
        private $host = 'localhost';
        private $db_name = 'db_personalize';
        private $username = 'root';
        private $password = '';
		
		//private $host = 'localhost';
        //private $db_name = 'id11317872_db_personalize';
        //private $username = 'id11317872_admin';
        //private $password = 'S@ggers666';
        
		
		//private $db_name = 'id11317872_db_personalize';
        //private $username = 'admin';
        //private $password = 'admin';
        private $conn ;
        
        public $dns = "dev.sagarpatil.in";
        //db connect
        public function getConnection(){
            $this->nconnect();
        }
        public function nconnect(){
            $this->conn = null;
            try{
                // DB1
                //$this->conn = new PDO("mysql:host=".$this->host.";dbname=db1", $this->username, $this->password);
                //PFDB
                //$this->conn = new PDO("mysql:host=".$this->host.";dbname=pfdb1", $this->username, $this->password);
                //$this->conn = new PDO("mysql:host=".$this->host.";dbname=db_personalize", $this->username, $this->password);
				$this->conn = new PDO("mysql:host=$this->host;dbname=$this->db_name", $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                echo 'connection error' . $e->getMessage();
				
            }
            return $this->conn;
        }
    }
?>