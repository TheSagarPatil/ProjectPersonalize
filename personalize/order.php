<?php
class Order{
    private $conn;
    private $table_name = "tbl_supplier";
	public $id;
	public $productVariantId;
	public $qty;
	public $customerId;
	public $supplierId;
	public $isCancelled;
	
	public $name;
		
	/*
	id
productVariantId
qty
customerId
supplierId
isCancelled 

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
		
		
		//$Byname =!empty($this->name)?"where `c`.`first_name` like '%".$this->name."%' ":"";
		$Byid =!empty($this->id)?"and `o`.`id`=:Id":"";
		$ByEmpId =!empty($this->employeeId)?" AND `o`.`employeeId` = ". $this->employeeId:"";
		$query = "SELECT `o`.`id`, 
					`o`.`productVariantId`,
					`pv`.`variant_name`, 
					`pv`.`variant_image`, 
					`pv`.`mrp`, 
					`pv`.`product_id`, 
					`o`.`qty`, 
					`o`.`customerId`, 
					`o`.`supplierId`,
                    `sup`.`name` as `supplierName`,
					`o`.`isCancelled`, 
					`o`.`orderDate`,
					`o`.`employeeId`,
					`e`.`name` as `employeeName`,
					`c`.`first_name` as `customerName` ,
					`c`.`Address` as `customerAddressLine1` 
					FROM `tbl_order` as `o` 
					left join `tbl_customer` as `c` 
					ON `c`.`id` = `o`.`customerId`
					left join `tbl_product_variant` as `pv`
					on `pv`.`id` = `o`.`productVariantId`
					left join `tbl_employee` as e 
					on `e`.`id` = `o`.`employeeId`
					left join `tbl_supplier` as `sup`
					on `sup`.`id` = `o`.`supplierId`
					where `c`.`first_name` like '%".$this->name."%'
				{$Byid} {$ByEmpId}";
        $stmt = $this->conn->prepare($query);
		//echo $query;
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
		$query = "UPDATE `tbl_order` 
			SET 
			`productVariantId`=:productVariantId, `isCancelled`=:isCancelled
			WHERE `id`=:id";
		$stmt = $this->conn->prepare($query);
		$this->productVariantId=htmlspecialchars(strip_tags($this->productVariantId));
		$this->id=htmlspecialchars(strip_tags($this->id));
		$this->isCancelled=htmlspecialchars(strip_tags($this->isCancelled));
		$stmt->bindParam(':productVariantId', $this->productVariantId);
		$stmt->bindParam(':isCancelled', $this->isCancelled);
		$stmt->bindParam(':id', $this->id);
		if($stmt->execute()){
			$msg="success";
		}else{
			$msg="fail";
		}
		return $msg;
	}
	public function deleteRecord(){
		$query = "DELETE FROM `tbl_order` WHERE `id`=:id";
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
	public function getlastWeekOrderCount(){
		$query = "select count(`o`.`id`) as `orderNum`
				from `tbl_order` as `o`
				where `o`.`orderDate` between date_sub(now() , INTERVAL 1 week) and now()";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}
	public function getPendingOrderList(){
		$query = "SELECT `o`.`id` 
					FROM `tbl_order` as `o` 
					where `o`.`employeeId` IS NULL";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
	}
	public function setEmployeeForDelivery(){
		$query = "update tbl_order set employeeId = :employeeId where id=:orderId";
		
		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":employeeId", $this->employeeId);
		$stmt->bindParam(":orderId", $this->orderId);
		$stmt->execute();
	}
}	
?>