<?php
    include_once 'db.php';
	include_once 'corpNavbar.php';
    include_once 'order.php';
	include_once 'customer.php';
	include_once 'productStock.php';
	include_once 'product_Variant.php';
	//include_once 'product.php';
    //instanciate db and connect
    $database = new Database();
    $db = $database->nconnect();
	include_once 'commonfe.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Orders</title>
  </head>
  <body>
  <div class="container">
	<div class="row">
		<div class="col-12 col-md-7">
			<h1>Orders</h1>
		</div>
		<div class="col-12 col-md-5">
			<form name="search" action="orders.php" method="post">
			<div class="input-group mb-3">
			  <input type="text" name="searchname" list="searchnameList" class="form-control" placeholder="Search by Name" aria-label="Product Variant name" aria-describedby="btnSearch">
			  <input type="text" name="employeeId" class="form-control" placeholder="Search by Delivery emp" aria-describedby="btnSearch"
				value="<?php if(isset($_SESSION['loginMode']) &&isset($_SESSION['id']) ){
					if( ($_SESSION['loginMode'] == "emp") && ($_SESSION['privilage'] == "DeliveryPerson")){
						echo $_SESSION['id'];
					}
				}?>"
			  >
			  
			  <div class="input-group-append">
				<input type="submit" class="btn btn-outline-secondary" value="Search" id="btnSearch"/>
			  </div>
			
<?php
				$customer = new Customer($db);
				$result = $customer->getRecordList();
				$num = $result->rowCount();
				if($num > 0){
					echo '<datalist id="searchnameList">';
					while($row = $result->fetch(PDO::FETCH_ASSOC)){
						extract($row);							
						echo "<option>".$c."</option>";
					}
					echo '</datalist>';
				}
?>			
			</div>
			</form>			
		</div>
	</div>
	
    <?php	
	$order = new Order($db);
	if( ($_SESSION['loginMode'] == "emp") && ($_SESSION['privilage'] == "DeliveryPerson")){
		//echo $_SESSION['id'];
		$order->employeeId = $_SESSION['id'];
	}
	if( isset($_POST["searchname"]) ){
		echo "search_term : " . $_POST["searchname"];
		$order->name = $_POST["searchname"];
		$order->employeeId = $_POST["employeeId"];
	}
	$result = $order->getRecordList();
    $num = $result->rowCount();
	if($num > 0){
		echo "<h6> Some records are found </h6>";
		
		?>
	
		<table class="table">
		<thead>
			<tr>
			  <th scope="col">#</th>
			  <th scope="col">Product Variant</th>
			  <th scope="col">Customer</th>
			  <th scope="col">Supplier</th>
			</tr>
		</thead>
		<tbody>
		<?php
		while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
?>
			<tr>
				<td>
					<a href="orders.php?id=<?php echo $id; ?>">View Order #<?php echo $id; ?></a>
				</td>
				<td>
					<a href="product_variants.php?id=<?php echo $productVariantId; ?>">#<?php echo $productVariantId." ".$variant_name; ?></a>
				</td>
				<td>
					<a href="customers.php?id=<?php echo $customerId; ?>">#<?php echo $customerId." " .$customerName; ?></a>
				</td>
				<td>
					<a href="suppliers.php?id=<?php echo $supplierId; ?>">Sup#<?php echo $supplierId; ?></a>
				</td>
			</tr>
<?php
		}	
	}else{
		echo "<tr><td colspan=4> No records found<td></tr>";
	}
?>
		</tbody>
		</table>
			<!-- 
$('.alert').alert('close/dispose')
$('#myAlert').on('closed.bs.alert/close.bs.alert', function () {
  // do something...
})
			-->
			<div class="alert alert-success alert-dismissible fade show d-none" role="alert">
			  <h4 class="alert-heading">Success!</h4>
			  <p>Notice text</p>
			  <hr>
			  <p class="mb-0">Saved successfully</p>
			</div>			
<?php
	if( isset($_GET["id"])){
		$order->id =!empty($_GET["id"])?$_GET["id"]:""; 
		//$productVariant->product_id =!empty($_GET["product_id"])?$_GET["product_id"]:""; 
		$order->name="";
		$result = $order->getRecordList();
		$num = $result->rowCount();
		if($num > 0){
			echo "<h4> Information </h4>";
			while($row = $result->fetch(PDO::FETCH_ASSOC)){
				extract($row);
?>
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
			  <h4 class="alert-heading">Warning!</h4> 
			  <p>You are in update mode. You should check in on some of those fields below. </p>
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<form name="f1" action="order_SUD.php" method="post" enctype="multipart/form-data">
			<div class="row">
				<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="row">
						<div class="col-12 col-md-4 ">
							<label class="dyn-text" for="id">ID</label>
						</div>
						<div class="col-12 col-md-8">
							<input type="hidden" name="id" class="form-control" value="<?php echo $id; ?>" id="id" aria-describedby="idHelp">
							<input type="text" class="form-control" value="<?php echo $id; ?>" disabled placeholder="Order ID">
							<small id="idHelp" class="form-text text-muted">This is Order ID. [Not Editable field]</small>
						</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6 ">
					<div class="form-group">
						<div class="row">
						<div class="col-12 col-md-4 ">
							<label class="dyn-text" for="supplierId">Order Date</label>
							</div>
						<div class="col-12 col-md-8">
							<input type="text" disabled name="orderDate" class="form-control" value="<?php echo $orderDate; ?>" id="orderDate" aria-describedby="orderDateHelp" placeholder="order Date">
						</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="row">
						<div class="col-12 col-md-4 ">
							<label class="dyn-text" for="supplierId">Delivery person</label>
							</div>
						<div class="col-12 col-md-8">
							<input type="text" disabled name="employeeName" class="form-control" value="<?php echo $employeeId." " .$employeeName; ?>" id="customerName" aria-describedby="employeeNameHelp" placeholder="employee Name">
							<a href="employees.php?id=<?php echo $employeeId; ?>"><small id="employeeNameHelp" class="form-text text-muted">View this customer.</small></a>
						</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="row">
						<div class="col-12 col-md-4 ">
							<label class="dyn-text" for="supplierId">Supplier Id</label>
							</div>
						<div class="col-12 col-md-8">
							<input  type="text" name="supplierIdB" class="form-control d-none" value="<?php $stk_supplierId= $supplierId; echo $supplierId; ?>" id="supplierId" aria-describedby="supplierIdHelp" placeholder="supplier Id">
							<select class="form-control" name="supplierId" disabled>
<?php 
								$stock = new ProductStock($db);
								//$product->id =!empty($_GET["product_id"])?$_GET["product_id"]:""; 
								$stock->productVariantId = $productVariantId;
								$result = $stock->getRecordList();
								$num = $result->rowCount();
								
								if($num > 0){
									while($row = $result->fetch(PDO::FETCH_ASSOC)){
										extract($row);
?>
								<option value="<?php echo $supplierId ?>"
									<?php
										$selectflg;
										$selectflg = ($supplierId == $stk_supplierId)? "selected":"";
										echo $selectflg;
									?>
								><?php echo "#".$stk_supplierId." ".$supplierName ?></option>
<?php
									}
								}
?>								
							</select>
							<small id="supplierIdHelp" class="form-text text-muted">supplierId goes here.</small>
							
						</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6 ">
					<div class="form-group">
						<div class="row">
						<div class="col-12 col-md-4 ">
							<label class="dyn-text" for="supplierId">Customer</label>
							</div>
						<div class="col-12 col-md-8">
							<input type="hidden" name="customerId" class="form-control" value="<?php echo $customerId; ?>" id="customerId" placeholder="customer Id">
							<input type="text" disabled name="customerName" class="form-control" value="<?php echo $customerName; ?>" id="customerName" aria-describedby="customerNameHelp" placeholder="customer Name">
							<a href="customers.php?id=<?php echo $customerId; ?>"><small id="customerNameHelp" class="form-text text-muted">View this customer.</small></a>
						</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6 d-none">
					<div class="form-group">
						<div class="row">
						<div class="col-12 col-md-4 ">
							<label class="dyn-text" for="name">Customer Name</label>
							</div>
						<div class="col-12 col-md-8">
						<select name="customerId" class="form-control">
<?php 
					$customer = new Customer($db);
					//$product->id =!empty($_GET["product_id"])?$_GET["product_id"]:""; 
					
					$result = $customer->getRecordList();
					$num = $result->rowCount();
					if($num > 0){
						while($row = $result->fetch(PDO::FETCH_ASSOC)){
							extract($row);
?>
						<option value="<?php echo $id ?>"
							<?php
								$selectflg;
								$selectflg = ($id == $customerId)? "selected":"";
								echo $selectflg;
							?>
						><?php echo "#".$id." ".$name ?></option>
<?php
						}
					}
?>
							</select >
							<a href="customers.php?id=<?php echo $customerId; ?>"><small id="customerIdHelp" class="form-text text-muted">View this customer.</small></a>
						</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="row">
						<div class="col-12 col-md-4 ">
							<label class="dyn-text" for="email">isCancelled</label>
						</div>
						<div class="col-12 col-md-8">
							<select name="isCancelled" class="form-control">
<?php						
							if($isCancelled == 0){
								echo "<option value='0' selected>No</option><option value='1' >Yes</option>";
							}else{
								echo "<option value='0'>No</option><option value='1' selected>Yes</option>";
							}
?>
							</select >
							<small id="isCancelledHelp" class="form-text text-muted">Cancellation of product delivery.</small>
						</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="row">
							<div class="col-12 col-md-4 ">
								<label class="dyn-text" for="photo">product Variant Id</label>
								</div>
							<div class="col-12 col-md-8">
								<input type="text" name="photo" disabled class="form-control" value="<?php echo $variant_name; ?>" id="photo" aria-describedby="PhotoHelp" placeholder="variant image">
								<select name="variantId" class="form-control">
<?php 
					
					$productVariant = new ProductVariant($db);
					$productVariant->id = $productVariantId;
					$result = $productVariant->getRecordListByProductIdAndSupplier();
					$num = $result->rowCount();
					if($num > 0){
						
						while($row = $result->fetch(PDO::FETCH_ASSOC)){
							extract($row);
							//echo $name;
?>
						<option value="<?php echo $id ?>"
							<?php
								$selectflg;
								$selectflg = ($id == $productVariantId)? "selected":"";
								echo $selectflg;
							?>
						><?php echo "#".$id." ".$variant_name ?></option>
<?php
						}
					}else{
						echo "<option value=".$productVariantId.">".$productVariantId." ".$variant_name."</option>";
					}
?>
								</select>
								<small id="PhotoHelp" class="form-text text-muted">variant image.</small>
								<img height=200px width=200px  src="data:image/jpeg;base64,<?php echo base64_encode($variant_image); ?>  ">
							</div>
						</div>
					</div>
				</div>
			
				<div class="col-12 col-md-6 ">
					<div class="form-group">
						<div class="row">
							<div class="col-12 col-md-4 ">
								<label class="dyn-text" for="customerAddressLine1">Customer Address</label>
								</div>
							<div class="col-12 col-md-8">
								<input type="text" disabled name="customerAddressLine1" class="form-control" value="<?php echo $customerAddressLine1; ?>" id="customerAddressLine1" aria-describedby="customerAddressLine1Help" placeholder="customer Name">						
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6 ">
					<div class="form-group">
						<div class="row">
							<div class="col-12 col-md-4 ">
								<label class="dyn-text" for="mrp">Price</label>
								</div>
							<div class="col-12 col-md-8">
								<input type="text" disabled name="mrp" class="form-control" value="<?php echo $mrp; ?>" id="mrp" aria-describedby="mrpHelp" placeholder="Product Price">						
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="btn-group special" role="group">
				
				<input type="reset" class="btn btn-dark" name="Reset" value="Reset Values"/>
				<input type="submit" class="btn btn-dark" name="Save" value="Save Record"/>
				<input type="submit" class="btn btn-dark d-none" name="Delete" value="Delete Record"/>
				</div>
			</div>
			</form>
<?php 
			}//end while variant
		}//end num 0 variant 	
	}else{
		//echo "<br/> ID is not defined to show dedicated information view";
	}
?>
	</div>
	<script>
	$("[name='new']").click(function(){
		$("[name='id']").val("").attr("disabled","true");
		$("[name='name'], [name='privilage'], [name='email'], [name='password'], [name='photo']").val("");
	});
	$('[name="Save"]').on("click", function(){
		if (
			$.trim($('[name="isCancelled"]').val())=="" ||
			$.trim($('[name="variantId"]').val()) =="" 
			){
			alert("At least 1 field is empty. Please fill it.");
			return false;
		}
	});
	</script>
  </body>
</html>