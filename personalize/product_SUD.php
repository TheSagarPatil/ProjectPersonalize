<?php
include_once 'db.php';
include_once 'product.php';
$database = new Database();
$db = $database->nconnect();
$id = "";
$name = "";
$query = "";
$product = new Product($db);
if(isset($_POST["Save"])){
	$product->id = isset($_POST["id"])?$_POST["id"]:"";
	$product->name = isset($_POST["name"])?$_POST["name"]:"";
	$query = "";
	if($product->id==""){
		echo "saving";
		$msg = $product->saveProduct();
	}else{
		echo "updating";
		$msg = $product->updateProduct();
	}
}
if(isset($_POST["Delete"])){
	$product->id = isset($_POST["id"])?$_POST["id"]:"";
	$product->deleteProduct();
	echo "deleting";
}
echo $query;
echo "<br/>".$id . " " . $name;
?>