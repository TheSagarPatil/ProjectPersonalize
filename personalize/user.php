<?php
class Product{
    private $conn;
    private $table_name = "tbl_user";
	public $id;
	public $name;
	public $email;
	public $pswd;
	public $addressLine1;
	public $pincode;
	/*
	SELECT `id`, `name`, `email`, `pswd`, `addressLine1`, `pincode` FROM `tbl_user` WHERE 1
	SELECT `id`, `name`, `email`, `pswd`, `addressLine1`, `pincode` FROM `tbl_user` WHERE `id`=1
	SELECT `id`, `name`, `email`, `pswd`, `addressLine1`, `pincode` FROM `tbl_user` WHERE `name` like '%p%'
	INSERT INTO `tbl_user`(`name`) VALUES ("sagar")
	UPDATE `tbl_user` SET `name`="sagar" WHERE `id`=1
	DELETE FROM `tbl_user` WHERE `id`=1
	*/
	public function __construct($db){
        $this->conn = $db;
    }
    public function getRecordList(){
		$Byid =!empty($this->id)?"where `id`=:Id":"";
		$Byname =!empty($this->name)?"where `name` like '%".$this->name."%' ":"";
		$query = "SELECT `id`, `name`, `email`, `pswd`, `addressLine1`, `pincode`
				FROM `tbl_user` 
				{$Byid} {$Byname}";		
        $stmt = $this->conn->prepare($query);
        $this->id=htmlspecialchars(strip_tags($this->id));
		if(isset($this->id))
			$stmt->bindParam(':Id', $this->id);
        $stmt->execute();
        return $stmt;
	}
	public function saveRecord(){
		$query = "INSERT INTO `tbl_user`(`name`, `email`, `pswd`, `addressLine1`, `pincode`) VALUES (:name, :email, :pswd, :addressLine1, :pincode)";
		$stmt = $this->conn->prepare($query);
		$this->name=htmlspecialchars(strip_tags($this->name));
		$this->email=htmlspecialchars(strip_tags($this->email));
		$this->pswd=htmlspecialchars(strip_tags($this->pswd));
		$this->addressLine1=htmlspecialchars(strip_tags($this->addressLine1));
		$this->pincode=htmlspecialchars(strip_tags($this->pincode));
		$stmt->bindParam(':name', $this->name);
		$stmt->bindParam(':email', $this->email);
		$stmt->bindParam(':pswd', $this->pswd);
		$stmt->bindParam(':addressLine1', $this->addressLine1);
		$stmt->bindParam(':pincode', $this->pincode);
		if($stmt->execute()){
			$msg="success";
		}else{
			$msg="fail";
		}
		return $msg;
	}
	public function updateRecord(){
		$query = "UPDATE `tbl_user` SET `name`=:name, `email`=:email, `pswd`=:pswd, `addressLine1`=:addressLine1, `pincode`=:pincode WHERE `id`=:id";
		$stmt = $this->conn->prepare($query);
		$this->id=htmlspecialchars(strip_tags($this->id));
		$this->name=htmlspecialchars(strip_tags($this->name));
		$this->email=htmlspecialchars(strip_tags($this->email));
		$this->pswd=htmlspecialchars(strip_tags($this->pswd));
		$this->addressLine1=htmlspecialchars(strip_tags($this->addressLine1));
		$this->pincode=htmlspecialchars(strip_tags($this->pincode));
		$stmt->bindParam(':id', $this->id);
		$stmt->bindParam(':name', $this->name);
		$stmt->bindParam(':email', $this->email);
		$stmt->bindParam(':pswd', $this->pswd);
		$stmt->bindParam(':addressLine1', $this->addressLine1);
		$stmt->bindParam(':pincode', $this->pincode);
		if($stmt->execute()){
			$msg="success";
		}else{
			$msg="fail";
		}
		return $msg;
	}
	public function deleteRecord(){
		$query = "DELETE FROM `tbl_user` WHERE `id`=:id";
		$stmt = $this->conn->prepare($query);
		$this->id=htmlspecialchars(strip_tags($this->id));
		$stmt->bindParam(':id', $this->id);
		if($stmt->execute()){
			$msg="success";
		}else{
			$msg="fail";
		}
		return $msg;
	}
}	
?>