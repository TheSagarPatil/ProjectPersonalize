<?php
class ProductStock{
    private $conn;
    private $table_name = "tbl_product_stock";
	public $productVariantId;
	public $supplierId;
	public $supplierName;
	public $stockQty;
	public $searchName;
	public function __construct($db){
        $this->conn = $db;
    }
	/*SELECT stk.`productVariantId`,stk.`supplierId`,sup.`name`, stk.`stockQty`,pv.`variant_name`, pv.`variant_image` FROM `tbl_product_stock` as stk inner join `tbl_product_variant` as pv on pv.`id` = stk.`productVariantId` inner join `tbl_supplier` as sup on stk.`supplierId` = sup.`id` WHERE 1*/
    public function getRecordList(){
		$ByVariantid =!empty($this->productVariantId)?"and `productVariantId`=:productVariantId":"";
		$Byname =!empty($this->searchName)?" where `sup`.`name` like '%".$this->searchName."%' OR  `pv`.`variant_name` like '%".$this->searchName."%'":"";
		$BySupplierId =(!empty($this->supplierId))?"where `stk`.`supplierId` = :supplierId ":"";
		
		$query = "SELECT `stk`.`productVariantId`, 
					`stk`.`supplierId`, 
					`sup`.`name` as `supplierName`,
					`stk`.`stockQty`, 
					`pv`.`variant_name` , 
					`pv`.`variant_image` 
				FROM `tbl_product_stock` as `stk` 
					inner join `tbl_product_variant` as `pv` 
					on `pv`.`id` = `stk`.`productVariantId` 
					inner join `tbl_supplier` as `sup` 
					on `stk`.`supplierId` = `sup`.`id`
				{$BySupplierId} {$ByVariantid} {$Byname} ";
		//echo $query;		
        $stmt = $this->conn->prepare($query);
		//echo $query;
		if(!empty($this->productVariantId)){
			$this->id=htmlspecialchars(strip_tags($this->productVariantId));
			$stmt->bindParam(':productVariantId', $this->productVariantId);
		}
		if(!empty($this->supplierId)){
			$this->id=htmlspecialchars(strip_tags($this->supplierId));
			$stmt->bindParam(':supplierId', $this->supplierId);
		}
		//echo $query;
        $stmt->execute();
        return $stmt;
	}
	public function saveRecord(){
		$query = "INSERT INTO `tbl_product_stock`(`productVariantId`,`supplierId`,`stockQty`) VALUES (:productVariantId, :supplierId, :stockQty)";
		$stmt = $this->conn->prepare($query);
		$this->productVariantId=htmlspecialchars(strip_tags($this->productVariantId));
		$this->supplierId=htmlspecialchars(strip_tags($this->supplierId));
		$this->stockQty=htmlspecialchars(strip_tags($this->stockQty));
		$stmt->bindParam(':productVariantId', $this->productVariantId);
		$stmt->bindParam(':supplierId', $this->supplierId);
		$stmt->bindParam(':stockQty', $this->stockQty);
		if($stmt->execute()){
			$msg="success";
		}else{
			$msg="fail";
		}
		return $msg;
	}
	public function updateRecord(){
		$query = "UPDATE `tbl_product_stock` SET `stockQty`=:stockQty WHERE `productVariantId`=:productVariantId and `supplierId`=:supplierId";
		$stmt = $this->conn->prepare($query);
		$this->productVariantId=htmlspecialchars(strip_tags($this->productVariantId));
		$this->supplierId=htmlspecialchars(strip_tags($this->supplierId));
		$this->stockQty=htmlspecialchars(strip_tags($this->stockQty));
		$stmt->bindParam(':productVariantId', $this->productVariantId);
		$stmt->bindParam(':supplierId', $this->supplierId);
		$stmt->bindParam(':stockQty', $this->stockQty);
		if($stmt->execute()){
			$msg="success";
		}else{
			$msg="fail";
		}
		return $msg;
	}
}	
?>