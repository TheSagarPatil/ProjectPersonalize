<?php
include_once 'db.php';
include_once 'product_variant.php';
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
	if($productVariant->id==""){
		echo "saving var";
		
		$msg = $productVariant->saveRecord();
	}else{
		echo "<br>updating var";
		//echo "ID ".$_POST["id"]."<br>name ".$_POST["variant_name"]."<br>pid ".$_POST["product_id"]."<br>vdesc ".$_POST["variant_description"];
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