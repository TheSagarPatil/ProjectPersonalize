<?php
class ProductVariant{
    private $conn;
    private $table_name = "tbl_product_variant";
	public $id;
	public $product_id;
	public $variant_name;
	public $query = "";
	public $product_name;
	public function __construct($db){
        $this->conn = $db;
    }
    public function getRecordList(){
		$Byid =!empty($this->id)?"where `tbl_product_variant`.`id`= :Id":"";
		$ByProductid =!empty($this->product_id)?" AND `tbl_product_variant`.`product_id`= :product_id":"";
		$Byname =!empty($this->variant_name)?"where `tbl_product_variant`.`variant_name` like '%".$this->variant_name."%' ":"";
		$query = "SELECT 
				`tbl_product_variant`.`id`, 
				`tbl_product`.`name`, 
				`tbl_product_variant`.`product_id`, 
				`tbl_product_variant`.`variant_name`,
				`tbl_product_variant`.`variant_description`
			FROM `tbl_product_variant` 
			left join `tbl_product` 
			on `tbl_product`.`id` = `tbl_product_variant`.`product_id`
				 {$Byid} {$ByProductid} {$Byname}";		
		//echo $query;
        
		$stmt = $this->conn->prepare($query);
        $this->id=htmlspecialchars(strip_tags($this->id));
		$this->product_id=htmlspecialchars(strip_tags($this->product_id));
		if(isset($this->id)){
			$stmt->bindParam(':Id', $this->id);
		}
		if(isset($this->product_id)){
			$stmt->bindParam(':product_id', $this->product_id);
		}
        $stmt->execute();
        return $stmt;
	}
}
?>