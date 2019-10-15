<?php
include_once 'db.php';
include_once 'customer.php';
$database = new Database();
$db = $database->nconnect();
$id = "";
$name = "";
$query = "";
$customer = new Customer($db);
if(isset($_POST["Save"])){
	$customer->id = isset($_POST["id"])?$_POST["id"]:"";
	$customer->name = isset($_POST["name"])?$_POST["name"]:"";
	$customer->addressLine1 = isset($_POST["addressLine1"])?$_POST["addressLine1"]:"";
	$customer->email = isset($_POST["email"])?$_POST["email"]:"";
	$customer->pswd = isset($_POST["password"])?$_POST["password"]:"";
	$customer->pincode = isset($_POST["pincode"])?$_POST["pincode"]:"";
	
	if($customer->id==""){
		echo "saving var";
		$msg = $customer->saveRecord();
		header("Location: customers.php?msg=".$msg);
	}else{
		echo "<br>updating var";
		$msg = $customer->updateRecord();
		header("Location: customers.php?msg=".$msg);
	}
}
if(isset($_POST["Delete"])){
	$customer->id = isset($_POST["id"])?$_POST["id"]:"";
	echo "deleting";
	$msg = $customer->deleteRecord();
	header("Location: customers.php?msg=".$msg);
	
}
echo $query;
echo "<br/>".$id . " " . $name;
?>