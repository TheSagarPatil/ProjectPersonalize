<?php
include_once 'order.php';
include_once 'employee.php';
include_once 'db.php';
class OrderEmployee{
	public $orderId;
	public $employeeId;
	function __construct($orderId, $employeeId){
		$this->orderId = $orderId;
		$this->employeeId= $employeeId;
	}
}

class emp{
	public $empId;
	function __construct($empId){
		$this->empId = $empId;
	}
}
$database = new Database();
$db = $database->nconnect();

$employee = new Employee($db);
$result = $employee->getDeliveryEmployeeList();
$num = $result->rowCount();
$e = array();
echo $num ."Employees found";
if($num > 0){
	while($row = $result->fetch(PDO::FETCH_ASSOC)){
		extract($row);
		array_push($e, new emp($id));
	}
}
for($i = 0; $i<count($e); $i++ ){
	echo "<br/>".$e[$i]->empId ."\n";
}

$order = new Order($db);
$result = $order->getPendingOrderList();
$num = $result->rowCount();

$o = array();
echo "\n".$num ."Pending orders found";
if($num >0){
	while($row = $result->fetch(PDO::FETCH_ASSOC)){
		extract($row);
		array_push($o, new OrderEmployee($id, NULL));
	}
}
for($i = 0; $i<count($o); $i++ ){
	echo "<br/>".$o[$i]->orderId ." ".$o[$i]->employeeId . "\n";
}
if($num > 0){
	$i=0;$j=0;
	for($i = 0; $i<count($o); $i++ ){
		if($j==count($e) && $i != count($o)){
			$j=0;
		}
		$o[$i]->employeeId = $e[$j]->empId;
		$j++;
	}
	for($i = 0; $i<count($o); $i++ ){
		echo "<br/>".$o[$i]->employeeId . " " . $o[$i]->orderId ."\n";
		$order = new Order($db);
		$order->orderId = $o[$i]->orderId;
		$order->employeeId = $o[$i]->employeeId;
		$order->setEmployeeForDelivery();
	}
}	

?>