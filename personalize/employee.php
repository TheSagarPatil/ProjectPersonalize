<?php
class Employee{
    private $conn;
    private $table_name = "tbl_employee";
	public $id;
	public $name;
	public $email;
	public $pswd;
	public $privilage;
	public $photo;
	public $mode;
	
	/*
	SELECT `id`, `name`, `email`, `pswd`, `privilage` FROM `tbl_employee` WHERE 1
	SELECT `id`, `name`, `email`, `pswd`, `privilage` FROM `tbl_employee` WHERE `id`=1
	SELECT `id`, `name`, `email`, `pswd`, `privilage` FROM `tbl_employee` WHERE `name` like '%p%'
	INSERT INTO `tbl_employee`(`name`) VALUES ("sagar")
	UPDATE `tbl_employee` SET `name`="sagar" WHERE `id`=1
	DELETE FROM `tbl_employee` WHERE `id`=1
	*/
	public function __construct($db){
        $this->conn = $db;
    }
    public function getRecordList(){
		$Byid =!empty($this->id)?"where `id`=:Id":"";
		$Byname =!empty($this->name)?"where `name` like '%".$this->name."%' ":"";
		$query = "SELECT `id`, `name`, `email`, `pswd`, `privilage` ,`photo`
				FROM `tbl_employee` 
				{$Byid} {$Byname}";		
        $stmt = $this->conn->prepare($query);
        $this->id=htmlspecialchars(strip_tags($this->id));
		if(isset($this->id))
			$stmt->bindParam(':Id', $this->id);
        $stmt->execute();
        return $stmt;
	}
	
	public function saveRecord(){
		$query = "INSERT INTO `tbl_employee`(`name`, `email`, `pswd`, `privilage`,`photo`) VALUES (:name, :email, :pswd, :privilage, :photo)";
		$stmt = $this->conn->prepare($query);
		$this->name=htmlspecialchars(strip_tags($this->name));
		$this->email=htmlspecialchars(strip_tags($this->email));
		$this->pswd=htmlspecialchars(strip_tags($this->pswd));
		$this->privilage=htmlspecialchars(strip_tags($this->privilage));
		$stmt->bindParam(':name', $this->name);
		$stmt->bindParam(':email', $this->email);
		$stmt->bindParam(':pswd', $this->pswd);
		$stmt->bindParam(':privilage', $this->privilage);
		$stmt->bindParam(':photo', $this->photo);
		if($stmt->execute()){
			$msg="success";
		}else{
			$msg="fail";
		}
		return $msg;
	}
	public function updateRecord(){
		$query = "UPDATE `tbl_employee` SET `name`=:name, `email`=:email, `pswd`=:pswd, `privilage`=:privilage WHERE `id`=:id";
		if($this->photo != ""){
			$query = "UPDATE `tbl_employee` SET `name`=:name, `email`=:email, `pswd`=:pswd, `privilage`=:privilage, `photo`=:photo   WHERE `id`=:id";
		}
		$stmt = $this->conn->prepare($query);
		$this->id=htmlspecialchars(strip_tags($this->id));
		$this->name=htmlspecialchars(strip_tags($this->name));
		$this->email=htmlspecialchars(strip_tags($this->email));
		$this->pswd=htmlspecialchars(strip_tags($this->pswd));
		$this->privilage=htmlspecialchars(strip_tags($this->privilage));
		$stmt->bindParam(':id', $this->id);
		$stmt->bindParam(':name', $this->name);
		$stmt->bindParam(':email', $this->email);
		$stmt->bindParam(':pswd', $this->pswd);
		$stmt->bindParam(':privilage', $this->privilage);
		if($this->photo != ""){
			$stmt->bindParam(':photo', $this->photo);
		}
		if($stmt->execute()){
			$msg="success";
		}else{
			$msg="fail";
		}
		return $msg;
	}
	public function deleteRecord(){
		$query = "DELETE FROM `tbl_employee` WHERE `id`=:id";
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
	public function login(){
		$query = "SELECT `id`, `name`, `email`, `pswd`, `privilage` ,`photo`
				FROM `tbl_employee` 
				where `email`= :email 
				and `pswd`=:pswd";
        $stmt = $this->conn->prepare($query);
        $this->email=htmlspecialchars(strip_tags($this->email));
		$stmt->bindParam(':email', $this->email);
		$this->pswd=htmlspecialchars(strip_tags($this->pswd));
		$stmt->bindParam(':pswd', $this->pswd);
        $stmt->execute();
        return $stmt;
	}
	public function getDeliveryEmployeeList(){
		$query = "SELECT `id`, `name`, `email`, `pswd`, `privilage` ,`photo`
		FROM `tbl_employee` 
		where `privilage` = 'DeliveryPerson' ";		
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}
}	
?>