<?php
class Product{
    private $conn;
    private $table_name = "tbl_supplier";
	public $id;
	public $name;
	public $email;
	public $pswd;
	public $addressLine1;
	public $pincode;
	/*
	SELECT `id`, `productVariantId`, `qty`, `customerId`, `supplierId`, `isCancelled` FROM `tbl_order` WHERE 1
	Select `o`.`id`, `o`.`productVariantId`, `o`.`qty`, `o`.`customerId`, `o`.`supplierId`, `o`.`isCancelled`, `c`.`name` as `customerName` from `tbl_order` as `o` left join `tbl_customer` as `c` on `c`.`id` = `o`.`customerId`
	SELECT `id`, `productVariantId`, `qty`, `customerId`, `supplierId`, `isCancelled` FROM `tbl_order` WHERE `id`=1
	SELECT `id`, `productVariantId`, `qty`, `customerId`, `supplierId`, `isCancelled` FROM `tbl_order` WHERE `name` like '%p%'
	INSERT INTO `tbl_order`(`isCancelled`) VALUES (1)
	UPDATE `tbl_order` SET `isCancelled`=1" WHERE `id`=1
	DELETE FROM `tbl_order` WHERE `id`=1
	*/
	public function __construct($db){
        $this->conn = $db;
    }
    public function getRecordList(){
		$Byid =!empty($this->id)?"where `id`=:Id":"";
		$Byname =!empty($this->name)?"where `c`.`name` like '%".$this->name."%' ":"";
		$query = "SELECT `o`.`id`, `o`.`productVariantId`, `o`.`qty`, `o`.`customerId`, `o`.`supplierId`, `o`.`isCancelled`, `c`.`name` as `customerName` 
					FROM `tbl_order` as `o` 
					left join `tbl_customer` as `c` 
					ON `c`.`id` = `o`.`customerId`
				{$Byid} {$Byname}";		
        $stmt = $this->conn->prepare($query);
        $this->id=htmlspecialchars(strip_tags($this->id));
		if(isset($this->id))
			$stmt->bindParam(':Id', $this->id);
        $stmt->execute();
        return $stmt;
	}
	public function saveRecord(){
		$query = "INSERT INTO `tbl_supplier`(`productVariantId`, `qty`, `customerId`, `supplierId`,) 
			VALUES (:productVariantId, :qty, :customerId, :supplierId)";
		$stmt = $this->conn->prepare($query);
		$this->productVariantId=htmlspecialchars(strip_tags($this->productVariantId));
		$this->qty=htmlspecialchars(strip_tags($this->qty));
		$this->customerId=htmlspecialchars(strip_tags($this->customerId));
		$this->supplierId=htmlspecialchars(strip_tags($this->supplierId));
		$stmt->bindParam(':productVariantId', $this->productVariantId);
		$stmt->bindParam(':qty', $this->qty);
		$stmt->bindParam(':customerId', $this->customerId);
		$stmt->bindParam(':supplierId', $this->supplierId);
		if($stmt->execute()){
			$msg="success";
		}else{
			$msg="fail";
		}
		return $msg;
	}
	public function updateRecord(){
		$query = "UPDATE `tbl_supplier` 
			SET `name`=:name, `email`=:email, `pswd`=:pswd, `addressLine1`=:addressLine1, `pincode`=:pincode 
			`productVariantId`=:productVariantId, `qty`=:qty, `customerId`=:customerId, `supplierId`=:supplierId, `isCancelled`=:isCancelled
			WHERE `id`=:id";
		$stmt = $this->conn->prepare($query);
		$this->productVariantId=htmlspecialchars(strip_tags($this->productVariantId));
		$this->qty=htmlspecialchars(strip_tags($this->qty));
		$this->customerId=htmlspecialchars(strip_tags($this->customerId));
		$this->supplierId=htmlspecialchars(strip_tags($this->supplierId));
		$this->isCancelled=htmlspecialchars(strip_tags($this->isCancelled));
		$stmt->bindParam(':productVariantId', $this->productVariantId);
		$stmt->bindParam(':qty', $this->qty);
		$stmt->bindParam(':customerId', $this->customerId);
		$stmt->bindParam(':supplierId', $this->supplierId);
		$stmt->bindParam(':isCancelled', $this->isCancelled);
		if($stmt->execute()){
			$msg="success";
		}else{
			$msg="fail";
		}
		return $msg;
	}
	public function deleteRecord(){
		$query = "DELETE FROM `tbl_supplier` WHERE `id`=:id";
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