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
	$customer->Address = isset($_POST["Address"])?$_POST["Address"]:"";
	$customer->email = isset($_POST["email"])?$_POST["email"]:"";
	$customer->password = isset($_POST["password"])?$_POST["password"]:"";
	$customer->pin_code = isset($_POST["pin_code"])?$_POST["pin_code"]:"";
	
	$customer->city = isset($_POST["city"])?$_POST["city"]:"";
	
	$customer->state= isset($_POST["state"])?$_POST["state"]:"";
	
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