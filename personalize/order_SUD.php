<?php
include_once 'db.php';
include_once 'order.php';
$database = new Database();
$db = $database->nconnect();
$id = "";
$name = "";
$query = "";
$order = new Order($db);
if(isset($_POST["Save"])){
	$order->id = isset($_POST["id"])?$_POST["id"]:"";
	$order->isCancelled = isset($_POST["isCancelled"])?$_POST["isCancelled"]:"";
	$order->productVariantId = isset($_POST["variantId"])?$_POST["variantId"]:"";
	
	if($order->id==""){
		echo "saving var";
		$msg = $order->saveRecord();
		header("Location: orders.php?msg=".$msg);
	}else{
		echo "<br>updating var";
		$msg = $order->updateRecord();
		header("Location: orders.php?msg=".$msg);
	}
}
if(isset($_POST["Delete"])){
	$order->id = isset($_POST["id"])?$_POST["id"]:"";
	echo "deleting";
	$msg = $order->deleteRecord();
	header("Location: orders.php?msg=".$msg);
	
}
echo $query;
echo "<br/>".$id . " " . $name;
?>