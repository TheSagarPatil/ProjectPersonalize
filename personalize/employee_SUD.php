<?php
include_once 'db.php';
include_once 'employee.php';
include_once 'supplier.php';
$database = new Database();
$db = $database->nconnect();
$id = "";
$name = "";
$query = "";
$employee = new Employee($db);
if(isset($_POST["Save"])){
	$employee->id = isset($_POST["id"])?$_POST["id"]:"";
	$employee->name = isset($_POST["name"])?$_POST["name"]:"";
	$employee->privilage = isset($_POST["privilage"])?$_POST["privilage"]:"";
	$employee->email = isset($_POST["email"])?$_POST["email"]:"";
	$employee->pswd = isset($_POST["password"])?$_POST["password"]:"";
	$employee->photo = empty($_FILES['photo']["tmp_name"])?"":file_get_contents($_FILES['photo']["tmp_name"]);
	if($employee->id==""){
		echo "saving var";
		$msg = $employee->saveRecord();
		header("Location: employees.php?msg=".$msg);
	}else{
		echo "<br>updating var";
		$msg = $employee->updateRecord();
		header("Location: employees.php?msg=".$msg);
	}
}
if(isset($_POST["Delete"])){
	$employee->id = isset($_POST["id"])?$_POST["id"]:"";
	echo "deleting";
	$msg = $employee->deleteRecord();
	header("Location: employees.php?msg=".$msg);
	
}
if(isset($_POST["loginType"])){
	
	if($_POST["loginType"] == "emp" ){
		//echo "empLogin";
		$employee->email = isset($_POST["email"])?$_POST["email"]:"";
		$employee->pswd = isset($_POST["password"])?$_POST["password"]:"";
		$employee->mode = isset($_POST["loginType"])?$_POST["loginType"]:"";
		$result = $employee->login();
		$num = $result->rowCount();
		if($num == 1){
			while($row = $result->fetch(PDO::FETCH_ASSOC)){
				extract($row);
				//echo "empLogin";
				//echo $name;
				session_start();
				$_SESSION["name"] = $name;
				$_SESSION["privilage"] = $privilage;
				$_SESSION["id"] = $id;
				$_SESSION["loginMode"] = "emp";
			}
			$msg = "success";
		}else{
			$msg = "fail";
		}
	}else{
		$supplier = new Supplier($db);
		$supplier->email = isset($_POST["email"])?$_POST["email"]:"";
		$supplier->pswd = isset($_POST["password"])?$_POST["password"]:"";
		$result = $supplier->login();
		$num = $result->rowCount();
		echo "supLogin".$supplier->email;
		if($num >0){
			while($row = $result->fetch(PDO::FETCH_ASSOC)){
				extract($row);
				session_start();
				$_SESSION["name"] = $name;
				$_SESSION["id"] = $id;
				$_SESSION["loginMode"] = "sup";
			}
			$msg = "success";
		}else{
			$msg = "fail";
		}
		
	}
	if($msg== "success"){
		echo $_SESSION["loginMode"];
		header("Location: corpHome.php");
	}else{
		echo $msg;
		header("Location: employeeLogin.php");
	}
}
echo $query;
echo "<br/>".$id . " " . $name;
?>