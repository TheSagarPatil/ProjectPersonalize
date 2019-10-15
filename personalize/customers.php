<?php
    include_once 'db.php';
	include_once 'corpNavbar.php';
    include_once 'customer.php';
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

    <title>Customers</title>
  </head>
  <body>
  <div class="container">
	<div class="row">
		<div class="col-12 col-md-7">
			<h1>Customers</h1>
		</div>
		<div class="col-12 col-md-5">
			<form name="search" action="customers.php" method="post">
			<div class="input-group mb-3">
			  <input type="text" name="searchname" list="searchnameList" class="form-control" placeholder="Search by Name" aria-label="Product Variant name" aria-describedby="btnSearch">
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
							
						echo "<option>".$name."</option>";
					}
					echo '</datalist>';
				}
?>			
			</div>
			</form>			
		</div>
	</div>
	
    <?php	
	
	if( isset($_POST["searchname"]) ){
		echo "search_term : " . $_POST["searchname"];
		$customer->name = $_POST["searchname"];
		//$productVariant->product_name = $_POST["searchname"];
	}
	$result = $customer->getRecordList();
    $num = $result->rowCount();
	if($num > 0){
		echo "<h6> Some records are found </h6>";
		
		?>
	
		<table class="table">
		<thead>
			<tr>
			  <th scope="col">#</th>
			  <th scope="col">Name </th>
			  <th scope="col">Email</th>
			  <th scope="col">Pincode</th>
			</tr>
		</thead>
		<tbody>
		<?php
		while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
?>
			<tr>
				<td><a href="customers.php?id=<?php echo $id; ?>"><?php echo $id; ?></a>
				</td>
				<td>
				<?php echo $first_name . " " . $last_name; ?>
				</td>
				<td>
				<?php echo $email; ?>
				</td>
				<td>
				<?php echo $pin_code; ?>
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
		$customer->id =!empty($_GET["id"])?$_GET["id"]:""; 
		//$productVariant->product_id =!empty($_GET["product_id"])?$_GET["product_id"]:""; 
		$customer->name="";
		$result = $customer->getRecordList();
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
			<form name="f1" action="customer_SUD.php" method="post" enctype="multipart/form-data">
			<div class="row">
				<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="row">
						<div class="col-12 col-md-4 ">
							<label class="dyn-text" for="id">ID</label>
						</div>
						<div class="col-12 col-md-8">
							<input type="hidden" name="id" class="form-control" value="<?php echo $id; ?>" id="id" aria-describedby="idHelp">
							<input type="text" class="form-control" value="<?php echo $id; ?>" disabled placeholder="Employee ID">
							<small id="idHelp" class="form-text text-muted">This is Employee ID. [Not Editable field]</small>
						</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="row">
						<div class="col-12 col-md-4 ">
							<label class="dyn-text" for="variant_name">Name</label>
							</div>
						<div class="col-12 col-md-8">
							<input type="text" name="name" class="form-control" value="<?php echo $first_name. " " .$last_name; ?>" id="name" aria-describedby="nameHelp" placeholder="Customer Name">
							<small id="nameHelp" class="form-text text-muted">Customer name goes here.</small>
						</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="row">
						<div class="col-12 col-md-4 ">
							<label class="dyn-text" for="email">Email</label>
							</div>
						<div class="col-12 col-md-8">
							<input type="text" name="email" class="form-control" value="<?php echo $email; ?>" id="email" aria-describedby="emailHelp" placeholder="email">
							<small id="emailHelp" class="form-text text-muted">email goes here.</small>
						</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="row">
						<div class="col-12 col-md-4 ">
							<label class="dyn-text" for="password">Password</label>
							</div>
						<div class="col-12 col-md-8">
							<input type="password" name="password" class="form-control" value="<?php echo $password; ?>" id="password" aria-describedby="passwordHelp" placeholder="password">
							<small id="passwordHelp" class="form-text text-muted">password goes here.</small>
						</div>
						</div>
					</div>
				</div><div class="col-12 col-md-6">
					<div class="form-group">
						<div class="row">
						<div class="col-12 col-md-4 ">
							<label class="dyn-text" for="variant_name">Address Line 1</label>
							</div>
						<div class="col-12 col-md-8">
							<input type="text" name="Address" class="form-control" value="<?php echo $Address; ?>" id="name" aria-describedby="addressLine1Help" placeholder="Address Line1">
							<small id="addressLine1Help" class="form-text text-muted">addressLine1 goes here.</small>
						</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="row">
						<div class="col-12 col-md-4 ">
							<label class="dyn-text" for="variant_name">City</label>
							</div>
						<div class="col-12 col-md-8">
							<input type="text" name="city" class="form-control" value="<?php echo $city; ?>" id="name" aria-describedby="pincodeHelp" placeholder="City">
							<small id="pincodeHelp" class="form-text text-muted">City goes here.</small>
						</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="row">
						<div class="col-12 col-md-4 ">
							<label class="dyn-text" for="name">State </label>
							</div>
						<div class="col-12 col-md-8">
						<select name="state" class="form-control">
<?php 
				
				$wcr=array('Maharashtra','Gujarat','Bengal');
				foreach($wcr as $key => $value):
						
					if($value == $state){
						echo '<option value="'.$value.'" key="'.$key.'" selected>'.$value.'</option>';
					}else{
						echo '<option value="'.$value.'" key="'.$key.'">'.$value.'</option>';
					}
				endforeach;
?>

							</select >
							<small id="stateHelp" class="form-text text-muted">State goes here.</small>
						</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="row">
						<div class="col-12 col-md-4 ">
							<label class="dyn-text" for="pin_code">pincode</label>
							</div>
						<div class="col-12 col-md-8">
							<input type="text" name="pin_code" class="form-control" value="<?php echo $pin_code; ?>" id="name" aria-describedby="pin_codeHelp" placeholder="Pincode">
							<small id="pin_codeHelp" class="form-text text-muted">pincode goes here.</small>
						</div>
						</div>
					</div>
				</div>
				
				
			</div>
			<div class="row">
				<div class="btn-group special" role="group">
				<input type="button" class="btn btn-dark" name="Reset" value="Reset Values"/>
				<input type="submit" class="btn btn-dark" name="Save" value="Save Record"/>
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
		$("[name='city'], [name='state'], [name='Address'], [name='pin_code'], [name='email'], [name='password']").val("");
	});
	$('[name="Save"]').on("click", function(){
		if (
			$.trim($('[name="city"]').val())=="" ||
			$.trim($('[name="state"]').val()) =="" ||
			$.trim($('[name="Address"]').val()) =="" ||
			$.trim($('[name="pin_code"]').val()) =="" ||
			$.trim($('[name="email"]').val()) == "" ||
			$.trim($('[name="password"]').val()) == "" {
			alert("At least 1 field is empty. Please fill it.");
			return false;
		}
	});
	</script>
  </body>
</html>