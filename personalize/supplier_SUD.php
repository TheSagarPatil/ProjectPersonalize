<?php
include_once 'db.php';
include_once 'supplier.php';
$database = new Database();
$db = $database->nconnect();
$id = "";
$name = "";
$query = "";
$supplier = new Supplier($db);
if(isset($_POST["Save"])){
	$supplier->id = isset($_POST["id"])?$_POST["id"]:"";
	$supplier->name = isset($_POST["name"])?$_POST["name"]:"";
	$supplier->email = isset($_POST["email"])?$_POST["email"]:"";
	$supplier->pswd = isset($_POST["pswd"])?$_POST["pswd"]:"";
	$supplier->addressLine1 = isset($_POST["addressLine1"])?$_POST["addressLine1"]:"";
	$supplier->pincode = isset($_POST["pincode"])?$_POST["pincode"]:"";
	
	$query = "";
	if($supplier->id==""){
		echo "saving supplier";
		$msg = $supplier->saveRecord();
		if(isset($_POST['referPage'])){
			header("Location: supplierRegister.php?msg=".$msg);
		}else{
			header("Location: suppliers.php?msg=".$msg);
		}
	}else{
		echo "updating supplier";
		$msg = $supplier->updateRecord();
		header("Location: suppliers.php?msg=".$msg);
	}
}
if(isset($_POST["Delete"])){
	$supplier->id = isset($_POST["id"])?$_POST["id"]:"";
	$supplier->deleteRecord();
	echo "deleting";
	header("Location: suppliers.php?msg=".$msg);
}
echo $query;
echo "<br/>".$id . " " . $name;
?>