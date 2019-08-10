<?php
class Product{
    private $conn;
    private $table_name = "tbl_product";
	public $id;
	public $name;
	/*
	SELECT `id`, `name` FROM `tbl_products` 
	SELECT `id`, `name` FROM `tbl_products` where `id`=1
	SELECT `id`, `name` FROM `tbl_products` where `name` like '%p%'
	INSERT INTO `tbl_products`(`name`) VALUES ("product 1")
	UPDATE `tbl_products` SET `name`="prod 1" WHERE `id`=1
	DELETE FROM `tbl_products` WHERE `id`=1
	*/
	public function __construct($db){
        $this->conn = $db;
    }
    public function getProductList(){
		$Byid =!empty($this->id)?"where `id`=:Id":"";
		$Byname =!empty($this->name)?"where `name` like '%".$this->name."%' ":"";
		$query = "SELECT 
					`id`, 
					`name` 
				FROM `tbl_products` 
				 {$Byid} {$Byname}";		
        $stmt = $this->conn->prepare($query);
        $this->id=htmlspecialchars(strip_tags($this->id));
		if(isset($this->id))
			$stmt->bindParam(':Id', $this->id);
        $stmt->execute();
        return $stmt;
	}
}	
?>