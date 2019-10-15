<?php

	include_once 'commonfe.php';
	include_once 'corpNavbar.php';
	include_once 'db.php';
	include_once 'order.php';
	include_once 'customer.php';
	
?>
<div class="container">
	<div class="row">
		<div class="pb-2 mt-4 mb-4 col-12  border-bottom">
			<h1>Corporate Home</h1>
		</div>			
		
	</div>
	<div class="row">
<?php
		if(isset($_GET["msg"])){
			if($_GET["msg"]=="success"){
?>
		<div class="col-12">
			<div class="alert alert-success alert-dismissible fade show " role="alert">
			
			  <h4 class="alert-heading">Success!</h4>
			  <hr>
			  <p class="mb-0">Logged in successfully</p>
			</div>
		</div>			
<?php
			}
		}
		if(isset($_SESSION["name"])){
			//echo $_SESSION["name"];
		}
?>
	</div>
	<div class="row">
<?php 
	if($_SESSION["loginMode"] == "emp"){
?>
		<div class="col-12 col-sm-6 col-md-4 col-lg-4">
			<div class="card ">
			  <div class="card-header">New Orders <small class="text-right">[This Week]</small></div>
			  <div class="card-body">
<?php 
				$database = new Database();
				$db = $database->nconnect();
				$order = new Order($db);
				$result = $order->getlastWeekOrderCount();
				$num = $result->rowCount();
				if($num > 0){
					while($row = $result->fetch(PDO::FETCH_ASSOC)){
						extract($row);
						echo "<h1 class='display-1 text-center'>".$orderNum."</h1>";
					}
				}
?>
			  
			  </div>
			  <div class="card-footer"><a href="orders.php">View Orders</a></div>
			</div>
		</div>
		
		<div class="col-12 col-sm-6 col-md-4 col-lg-4">
			<div class="card ">
			  <div class="card-header">New Customers <small class="text-right">[This Week]</small></div>
			  <div class="card-body">
<?php 
				$customer = new Customer($db);
				$result = $customer->getCustomerCountLastWeek();
				$num = $result->rowCount();
				if($num > 0){
					while($row = $result->fetch(PDO::FETCH_ASSOC)){
						extract($row);
						echo "<h1 class='display-1 text-center'>".$customerCount."</h1>";
					}
				}
?>
			  </div>
			  <div class="card-footer"><a href="customers.php">View Customers</a></div>
			</div>
		</div>
		
		<div class="col-12 col-sm-6 col-md-4 col-lg-4">
			<div class="card ">
			  <div class="card-header">Top 5 Grossing <small class="text-right">[This Week]</small></div>
			  <div class="card-body"><h1 class="display-1 text-center">&nbsp;</h1></div>
			  <div class="card-footer"><a href="report_top5grossing.php">View Report</a></div>
			</div>
		</div>
<?php
	}
?>
<?php 
	if($_SESSION["loginMode"] == "sup"){
?>
		<div class="col-12 col-sm-6 col-md-4 col-lg-4">
			<div class="card ">
			  <div class="card-header">My Top 5 Grossing <small class="text-right">[This Week]</small></div>
			  <div class="card-body"><h1 class="display-2 text-center">&nbsp;</h1></div>
			  <div class="card-footer"><a href="report_top3products.php">View Report</a></div>
			</div>
		</div>
<?php
	}
?>
	</div>
</div>
<style>
.card-header,
.card-body,
.card-footer{
	border:0;
	background-color:#fff;
}
</style>