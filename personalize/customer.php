<?php
class Customer{
    private $conn;
    private $table_name = "tbl_customer";
	public $first_name;
	public $last_name;
	public $email;
	
	public $gender;
	public $contact_no;
	public $user_name;
	public $password;
	public $Address;
	public $city;
	public $state;
	public $pin_code;
	/*
	SELECT `id`, `name`, `email`, `pswd`, `addressLine1`, `pincode` FROM `tbl_customer` WHERE 1
	SELECT `id`, `name`, `email`, `pswd`, `addressLine1`, `pincode` FROM `tbl_customer` WHERE `id`=1
	SELECT `id`, `name`, `email`, `pswd`, `addressLine1`, `pincode` FROM `tbl_customer` WHERE `name` like '%p%'
	INSERT INTO `tbl_customer`(`name`) VALUES ("sagar")
	UPDATE `tbl_customer` SET `name`="sagar" WHERE `id`=1
	DELETE FROM `tbl_customer` WHERE `id`=1
	*/
	public function __construct($db){
        $this->conn = $db;
    }
    public function getRecordList(){
		$Byid =!empty($this->id)?"where `id`=:Id":"";
		$Byname =!empty($this->name)?"where `first_name` like '%".$this->name."%' ":"";
		$query = "SELECT `id`,`first_name`,
					`last_name`,
					`email`,
					`gender`,
					`contact_no`,
					`user_name`,
					`password`,
					`Address`,
					`city`,
					`state`,
					`pin_code`
				FROM `tbl_customer` 
				{$Byid} {$Byname}";		
        $stmt = $this->conn->prepare($query);
		if(isset($this->id)){
			$this->id=htmlspecialchars(strip_tags($this->id));
			$stmt->bindParam(':Id', $this->id);
		}
        $stmt->execute();
        return $stmt;
	}
	public function saveRecord(){
		$query = "INSERT INTO `tbl_customer`(`first_name`,
					`last_name`,
					`email`,
					`gender`,
					`contact_no`,
					`user_name`,
					`password`,
					`Address`,
					`city`,
					`state`,
					`pin_code`
					) VALUES (:first_name,
					:last_name,
					:email,
					:gender,
					:contact_no,
					:user_name,
					:password,
					:Address,
					:city,
					:state,
					:pin_code)";
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
		$query = "UPDATE `tbl_customer` SET `email`=:email, `password`=:password, `Address`=:Address, `pin_code`=:pin_code ,`city`=:city, `state`=:state
		WHERE `id`=:id";
		$stmt = $this->conn->prepare($query);
		$this->id=htmlspecialchars(strip_tags($this->id));
		$this->email=htmlspecialchars(strip_tags($this->email));
		$this->password=htmlspecialchars(strip_tags($this->password));
		$this->Address=htmlspecialchars(strip_tags($this->Address));
		$this->pin_code=htmlspecialchars(strip_tags($this->pin_code));
		$this->city=htmlspecialchars(strip_tags($this->city));
		$this->state=htmlspecialchars(strip_tags($this->state));
		$stmt->bindParam(':id', $this->id);
		$stmt->bindParam(':email', $this->email);
		$stmt->bindParam(':password', $this->password);
		$stmt->bindParam(':Address', $this->Address);
		$stmt->bindParam(':pin_code', $this->pin_code);
		$stmt->bindParam(':state', $this->state);
		$stmt->bindParam(':city', $this->city);
		
		if($stmt->execute()){
			$msg="success";
		}else{
			$msg="fail";
		}
		return $msg;
	}
	public function deleteRecord(){
		$query = "DELETE FROM `tbl_customer` WHERE `id`=:id";
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
	public function getCustomerCountLastWeek(){
		$query = "select count(Id) as `customerCount` from tbl_customer";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}
}	
?>