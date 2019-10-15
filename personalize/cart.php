<?php include_once 'navbar.php' ?>
<html>
<head>
<title>My Cart</title>
</head>
<br>
<body>

<form method="post" >
 <div class="customcard">
  <div class="container">
  <div class="row">
  <div class="col-lg-12">
  <div class="card-deck">

 <?php
			
				$connect = mysqli_connect("localhost", "root","","db_personalize");
				$query = "SELECT `pv`.`id` as `variant_id`,
		`pv`.`variant_name`,
        `pv`.`mrp`,
        `uc`.`productVariantId`,
		`pv`.`variant_image`,
		`uc`.`supplierId`
FROM `tbl_usercart` as `uc`
inner join `tbl_product_variant` as `pv`
on `pv`.`id` = `uc`.`productVariantId`
where `customerId` = ".$_SESSION["login_user_id"]." ORDER BY id ASC";
				$result = mysqli_query($connect, $query);
				if(mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_array($result))
					{
				?>
			
			<div class="col-12 col-sm-12 col-md-4 col-lg-3 col-xl-3 mb-4">
			
			<div class="card" style="max-width: 18rem;">
			<img class="card-img-top" src="<?php echo "data:image/jpeg;base64,".base64_encode($row['variant_image']); ?>" alt="Card image cap">
			<div class="card-body">
			<h5 class="text-info"><?php echo $row["variant_name"]; ?>
			<h4 class="text-danger">Rs.<?php echo $row["mrp"]; ?></h4>
			<!--<h6 class="card-subtitle mb-2 text-muted"><?php echo $name;?></h6>-->
			<input name="variant_id" type="hidden" value="<?php echo $row["variant_id"]; ?>"/>
			<input name="supplier_id" type="hidden" value="<?php echo $row["supplierId"]; ?>"/>
			
			<input type="submit" name="order_now" style="margin-top:5px;" class="btn btn-success" value="Order Now" />
			<input type="submit" name="remove" style="margin-top:5px;" class="btn btn-warning" value="Remove" />
	
		  </div>
		</div>
		</div>
		<br>
		<br>
			
			<?php
					}
				}else{
					echo "<h3>Cart is empty</h3>";
				}
				if(isset($_POST['remove']))
				{
					$query="DELETE FROM `tbl_usercart` WHERE customerId=".$_SESSION["login_user_id"]." and productVariantId=".$_POST["variant_id"]."";
					
					$run=mysqli_query($connect,$query);
					if($run==true)
					{
						echo '<script>alert("Item Remove form Cart !")</script>';
						echo '<script>window.location="cart.php"</script>';
					}
				}
				
				if(isset($_POST["order_now"]))
				{
					$query = "insert into tbl_order(customerId, productVariantId, supplierId)
					values(".$_SESSION['login_user_id'].", ".$_POST['variant_id'].",".$_POST["supplier_id"].");";
					$run = mysqli_query($connect, $query);
					echo $query;
					if($run == TRUE){
						$query="DELETE FROM `tbl_usercart` WHERE customerId=".$_SESSION["login_user_id"]." and productVariantId=".$_POST["variant_id"]."";
						
						$run=mysqli_query($connect,$query);
						if($run==true)
						{
							$query = "select max(id) as `orderId` from tbl_order";
							$run = mysqli_query($connect, $query);
							$orderID = 0;
							if($run == TRUE){
								if(mysqli_num_rows($run)>0){
									while($row = mysqli_fetch_array($run)){
										$orderId = $row["orderId"];
									}
								}
								
								echo '<script>alert("Item purchased !")</script>';
								echo '<script>debugger; window.location="receipt.php?orderId='.$orderId.'"</script>';								
							}
						}
					}
				}	
			?>
			
			<div style="clear:both"></div>
   </div>
  </div>
  </div>
  </div>
  </div>
  </form>

</body>

<?php include_once 'footer.php' ?>