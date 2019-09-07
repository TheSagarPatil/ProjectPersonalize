<?php
include_once 'db.php';
include_once 'product.php';
$database = new Database();
$db = $database->nconnect();
$id = "";
$name = "";
$query = "";
$productVariant = new ProductVariant($db);
if(isset($_POST["Save"])){
	$productVariant->id = isset($_POST["id"])?$_POST["id"]:"";
	$productVariant->variant_name = isset($_POST["variant_name"])?$_POST["variant_name"]:"";
	$productVariant->product_id = isset($_POST["product_id"])?$_POST["product_id"]:"";
	$productVariant->variant_description = isset($_POST["variant_description"])?$_POST["variant_description"]:"";
	$query = "";
	if($productVariant->id==""){
		echo "saving";
		$msg = $productVariant->saveRecord();
	}else{
		echo "updating";
		$msg = $productVariant->updateRecord();
	}
}
if(isset($_POST["Delete"])){
	$productVariant->id = isset($_POST["id"])?$_POST["id"]:"";
	$productVariant->deleteRecord();
	echo "deleting";
}
echo $query;
echo "<br/>".$id . " " . $name;
?>