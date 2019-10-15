<?php
include_once 'db.php';
include_once 'productStock.php';
include_once 'product_variant.php';
$database = new Database();
$db = $database->nconnect();
$id = "";
$name = "";
$query = "";
$productVariant = new ProductVariant($db);
$productStock = new ProductStock($db);
if(isset($_POST["Save"])){
	$productStock->productVariantId = isset($_POST["productVariantId"])?$_POST["productVariantId"]:"";
	$productStock->supplierId= isset($_POST["supplierId"])?$_POST["supplierId"]:"";
	$productStock->stockQty= isset($_POST["stockQty"])?$_POST["stockQty"]:"";
	
	$result = $productStock->getRecordList();
	$num = $result->rowCount();
	echo "num".$num;
	if($num > 0){
		$msg = $productStock->updateRecord();
		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			extract($row);
			echo "<br/>";
			echo $supplierId;
			echo $productVariantId;
			echo $stockQty;
		}

		header("Location: productStockView.php?msg=".$msg);
		
	}else{
		$msg = $productStock->saveRecord();
		header("Location: productStockView.php?msg=".$msg);
	}
}
if(isset($_POST["Delete"])){
	$ProductStock->id = isset($_POST["id"])?$_POST["id"]:"";
	$ProductStock->deleteRecord();
	echo "deleting";
}
echo $query;
echo "<br/>".$id . " " . $name;
?>