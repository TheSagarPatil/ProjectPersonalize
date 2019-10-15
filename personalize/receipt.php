<?php include_once 'navbar.php'; 
	  include_once 'commonfe.php';
	  while(!isset($_SESSION['login_user_name']))
	{
		echo '<script>alert("You Must Login first !")</script>';
		echo '<script>window.location="index.php"</script>';
		exit();
	}
?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	</head>
	<br>
	<br>
	<body>
	<form>
<?php
	$db=mysqli_connect("localhost","root","","db_personalize");
		
	$query="SELECT `o`.`id`, 
					`o`.`productVariantId`,
					`pv`.`variant_name`, 
					`pv`.`variant_image`, 
					`pv`.`mrp`, 
					`pv`.`product_id`, 
					`o`.`qty`, 
					`o`.`customerId`, 
					`o`.`supplierId`,
                    `sup`.`name` as `supplierName`,
					`o`.`isCancelled`, 
					`o`.`orderDate`,
					`o`.`employeeId`,
					`e`.`name` as `employeeName`,
					concat(`c`.`first_name` ,' ', `c`.`last_name`) as `customerName` ,
					`c`.`contact_no`,
					`c`.`city`,
					`c`.`pin_code`,
					`c`.`state`,
					`c`.`Address` as `customer_Address` 
					FROM `tbl_order` as `o` 
					left join `tbl_customer` as `c` 
					ON `c`.`id` = `o`.`customerId`
					left join `tbl_product_variant` as `pv`
					on `pv`.`id` = `o`.`productVariantId`
					left join `tbl_employee` as e 
					on `e`.`id` = `o`.`employeeId`
					left join `tbl_supplier` as `sup`
					on `sup`.`id` = `o`.`supplierId`
					where `o`.`id` =".$_GET["orderId"];
				$run=mysqli_query($db,$query);
				if(mysqli_num_rows($run) > 0)
				{
					while($row = mysqli_fetch_array($run))
					{
						if($run==true)
						{
							?>
							<h2 align="center">Order Reciept</h2>
							<br>
			<div class="container">
			<div class="table-responsive">
				<table class="table table-bordered">
					<tr align="center">
						<th width="50%" class="text-info">variant name</th>
						<th width="50%" class="text-info">MRP</th>
					</tr>
					<tr align="center">
						<th><h5> <?php echo $row["variant_name"]; ?></h5></th>
						<th><h5> <?php echo $row["mrp"]; ?></h5></th>
					</tr>
					<tr align="center">
						<th width="50%" class="text-info">Quantity</th>
						<th width="50%" class="text-info">Order_Date </th>
					</tr>
					<tr align="center">
						<th><h5> <?php echo $row["qty"]; ?></h5></th>
						<th><h5> <?php echo $row["orderDate"]; ?></h5></th>
					</tr>
					<tr align="center">
						<th width="50%" class="text-info">Customer Name</th>
						<th width="50%" class="text-info">Customer Address</th>
					</tr>
					<tr align="center">
						<th><h5> <?php echo $row["customerName"]; ?></h5></th>
						<th><h5> <?php echo $row["customer_Address"]; ?></h5></th>
					</tr>
					<tr align="center">
						<th width="50%" class="text-info">Contact No</th>
						<th width="50%" class="text-info">City</th>
					</tr>
					<tr align="center">
						<th><h5> <?php echo $row["contact_no"]; ?></h5></th>
						<th><h5> <?php echo $row["city"]; ?></h5></th>
					</tr>
					<tr align="center">
						<th width="50%" class="text-info">State</th>
						<th width="50%" class="text-info">Zip Code</th>
					</tr>
					<tr align="center">
						<th><h5> <?php echo $row["state"]; ?></h5></th>
						<th><h5> <?php echo $row["pin_code"]; ?></h5></th>
					</tr>
					<tr align="center">
						<th colspan="2"><input type="submit" name="update" style="margin-top:5px;" class="btn btn-warning" value="Print" onclick="window.print();return false;" /></th>
					</tr>
				</table>
			</div>
		</div><?php 
						}
					}
				}
?>
</form>
</body>
</html>