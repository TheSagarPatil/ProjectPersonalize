<?php
class ProductVariant{
    private $conn;
    private $table_name = "tbl_product_variant";
	public $id;
	public $product_id;
	public $variant_name;
	public $query = "";
	public $product_name;
	public $variant_description;
	public $variant_image;
	public function __construct($db){
        $this->conn = $db;
    }
    public function getRecordList(){
		$Byid =!empty($this->id)?"where `tbl_product_variant`.`id`= :Id":"";
		//$Byname =!empty($this->product_name)?"where `tbl_product`.`name`= :pname":"";
		$ByProductid =!empty($this->product_id)?" AND `tbl_product_variant`.`product_id`= :product_id":"";
		$Byname =!empty($this->variant_name)?"where `tbl_product_variant`.`variant_name` like '%".$this->variant_name."%' ":"";
		$query = "SELECT `tbl_product_variant`.`id`, 
					`tbl_product`.`name`, `tbl_product_variant`.`product_id`, 
					`tbl_product_variant`.`variant_name`,
					`tbl_product_variant`.`variant_description`,
					`tbl_product_variant`.`variant_image`,
					`tbl_product_variant`.`mrp`
				FROM `tbl_product_variant` left join `tbl_product` 
				on `tbl_product`.`id` = `tbl_product_variant`.`product_id` 
				{$Byid} {$ByProductid} {$Byname}";
		$stmt = $this->conn->prepare($query);
        $this->id=htmlspecialchars(strip_tags($this->id));
		$this->product_id=htmlspecialchars(strip_tags($this->product_id));
		if(isset($this->id)){
			$stmt->bindParam(':Id', $this->id);
		}
		if(isset($this->product_id)){
			$stmt->bindParam(':product_id', $this->product_id);
		}
		if(!empty($this->product_name)){
			$stmt->bindParam(':pname', $this->product_name);
		}
		//echo $query;
        $stmt->execute();
        return $stmt;
	}
	public function getRecordListByProductIdAndSupplier(){
		$Byid =!empty($this->id)?"where `id`=:Id":"";
		$query = "SELECT 
					`tbl_product_variant`.`id`, 
					`tbl_product`.`name`, 
					`tbl_product_variant`.`product_id`, 
					`tbl_product_variant`.`variant_name`, 
					`tbl_product_variant`.`variant_description`, 
					`tbl_product_variant`.`variant_image`,
					`tbl_product_variant`.`mrp`
				FROM `tbl_product_variant` 
					right join `tbl_product` 
					on `tbl_product`.`id` = `tbl_product_variant`.`product_id` 
					left join `tbl_product_stock` 
					on `tbl_product_stock`.`productVariantId` = `tbl_product_variant`.`id` 
				where 
					`tbl_product_variant`.`product_id` = (select `tbl_product_variant`.`product_id` 
							from `tbl_product_variant` 
							where `tbl_product_variant`.`id` = :Id)
					and `tbl_product_stock`.`stockQty`>0";		
        $stmt = $this->conn->prepare($query);
        $this->id=htmlspecialchars(strip_tags($this->id));
		if(isset($this->id)){
			$stmt->bindParam(':Id', $this->id);
		}
        $stmt->execute();
        return $stmt;
		//echo $query;
        $stmt->execute();
        return $stmt;
	}
	public function saveRecord(){
		$query = "INSERT INTO `tbl_product_variant`(`variant_name`,`product_id`,`variant_description`,`mrp`) 
					VALUES (:variant_name, :product_id, :variant_description, :mrp)";
		if($this->variant_image != ""){	
			echo "inserting image";
			$query = "INSERT INTO `tbl_product_variant`(`variant_name`,`product_id`,`variant_description`,`variant_image`,`mrp`) 
					VALUES (:variant_name, :product_id, :variant_description, :variant_image, :mrp)";
			
		}
		$stmt = $this->conn->prepare($query);
		if($this->variant_image != ""){	
			$stmt->bindParam(':variant_image', $this->variant_image);	
		}
		$this->variant_name=htmlspecialchars(strip_tags($this->variant_name));
		$stmt->bindParam(':variant_name', $this->variant_name);
		$stmt->bindParam(':product_id', $this->product_id);
		$stmt->bindParam(':variant_description', $this->variant_description);
		$stmt->bindParam(':mrp', $this->mrp);
		if($stmt->execute()){
			$msg="success";
		}else{
			$msg="fail";
		}
		return $msg;
		$this->variant_name="";
	}
	public function updateRecord(){
		$query = "UPDATE `tbl_product_variant` 
					SET `tbl_product_variant`.`variant_name`= :variant_name ,
					`tbl_product_variant`.`product_id`= :product_id ,
					`tbl_product_variant`.`variant_description`= :variant_description ,
					
					`tbl_product_variant`.`mrp` = :mrp
					WHERE `tbl_product_variant`.`id`= :id ;";
		
		$this->id=htmlspecialchars(strip_tags($this->id));
		$this->variant_name=htmlspecialchars(strip_tags($this->variant_name));
		$this->product_id=htmlspecialchars(strip_tags($this->product_id));
		$this->variant_description=htmlspecialchars(strip_tags($this->variant_description));
		$this->id= number_format($this->id);
		if($this->variant_image != ""){
			$query = "UPDATE `tbl_product_variant` 
					SET `tbl_product_variant`.`variant_name`= :variant_name ,
					`tbl_product_variant`.`product_id`= :product_id ,
					`tbl_product_variant`.`variant_description`= :variant_description ,
					`tbl_product_variant`.`variant_image`= :variant_image ,
					`tbl_product_variant`.`mrp` = :mrp
					WHERE `tbl_product_variant`.`id`= :id ;";
					
		}
		$stmt = $this->conn->prepare($query);
		if($this->variant_image != ""){	
			$stmt->bindParam(':variant_image', $this->variant_image);
		}
		$stmt->bindParam(':variant_name', $this->variant_name);
		$stmt->bindParam(':product_id', $this->product_id);
		$stmt->bindParam(':variant_description', $this->variant_description);
		$stmt->bindParam(':id', $this->id);
		
		$stmt->bindParam(':mrp', $this->mrp);
		//echo "binding <br>". $query;
		//echo empty("");
		if($stmt->execute()){
			$msg="success";
		}else{
			$msg="fail";
		}
		return $msg;
	}
	public function deleteRecord(){
		$query = "DELETE FROM `tbl_product_variant` WHERE `id`=:id";
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