<?php
    include_once 'db.php';
    include_once 'supplier.php';
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

    <title>Suppliers</title>
  </head>
  <body>
  <div class="container">
	<div class="row">
		<div class="col-12 col-md-7">
			<h1>Register as a Supplier</h1>
		</div>
	</div>
	
    
			<!-- 
$('.alert').alert('close/dispose')
$('#myAlert').on('closed.bs.alert/close.bs.alert', function () {
  // do something...
})
			-->
<?php 
			if(isset($_GET['msg'])){
				if($_GET['msg']=="success"){
					?>
			<div class="alert alert-success alert-dismissible fade show" role="alert">
			  <h4 class="alert-heading">Success!</h4> 
			  <p>Your information was successfully saved.</p>
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
<?php
				}
			}else{
?>
			

			<div class="alert alert-warning alert-dismissible fade show" role="alert">
			  <h4 class="alert-heading">Warning!</h4> 
			  <p>You are registering your information. Please make sure you're providing correct information. Information provided once can onoly be corrected by authorised employee only.</p>
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			
<?php
			}
?>
			<form name="f1" action="supplier_SUD.php" method="post" enctype="multipart/form-data">
			<div class="row">
				<div class="col-12 col-md-6 d-none">
					<div class="form-group">
						<div class="row">
						<div class="col-12 col-md-4 ">
							<label class="dyn-text" for="id">ID</label>
						</div>
						<div class="col-12 col-md-8">
							<input type="hidden" name="id" class="form-control" value="" id="id" aria-describedby="idHelp">
							<input type="text" name="id_disp" class="form-control" value="" disabled placeholder="Supplier ID">
							<small id="idHelp" class="form-text text-muted">This is Supplier ID. [Not Editable field]</small>
						</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="row">
						<div class="col-12 col-md-4 ">
							<label class="dyn-text" for="name">Name</label>
							</div>
						<div class="col-12 col-md-8">
							<input type="text" name="name" class="form-control" value="" id="name" aria-describedby="nameHelp" placeholder="Supplier Name">
							<small id="nameHelp" class="form-text text-muted">Supplier name goes here.</small>
						</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="row">
						<div class="col-12 col-md-4 ">
							<label class="dyn-text" for="email">Supplier Email</label>
							</div>
						<div class="col-12 col-md-8">
							<input type="text" name="email" class="form-control" value="" id="email" aria-describedby="emailHelp" placeholder="email">
							<small id="emailHelp" class="form-text text-muted">email goes here.</small>
						</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="row">
						<div class="col-12 col-md-4 ">
							<label class="dyn-text" for="pswd">password</label>
							</div>
						<div class="col-12 col-md-8">
							<input type="password" name="pswd" class="form-control" value="" id="pswd" aria-describedby="pswdHelp" placeholder="password">
							<small id="pswdHelp" class="form-text text-muted">Password goes here.</small>
						</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="row">
						<div class="col-12 col-md-4 ">
							<label class="dyn-text" for="addressLine1">Address</label>
							</div>
						<div class="col-12 col-md-8">
							<input type="text" name="addressLine1" class="form-control" value="" id="addressLine1" aria-describedby="addressLine1Help" placeholder="addressLine1">
							<small id="addressLine1Help" class="form-text text-muted">Address goes here.</small>
						</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="row">
							<div class="col-12 col-md-4 ">
								<label class="dyn-text" for="pincode">pincode</label>
								</div>
							<div class="col-12 col-md-8">
								<input type="text" name="pincode" class="form-control" value="" id="pincode" aria-describedby="pincodeHelp" placeholder="pincode">
								<small id="pincodeHelp" class="form-text text-muted">pincode goes here.</small>
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
			<input type="hidden" name="referPage" value="supplierRegister" class="d-none"/>
			</form>
	</div>
	<script>
	$("[name='new']").click(function(){
		$("[name='id'], [name='id_disp']").val("").attr("disabled","true");
		$("[name='name'], [name='addressLine1'], [name='email'], [name='password'], [name='pincode']").val("");
	});
	$('[name="Save"]').on("click", function(){
		if (
			$.trim($('[name="name"]').val())=="" ||
			$.trim($('[name="addressLine1"]').val()) =="" ||
			$.trim($('[name="email"]').val()) == "" ||
			$.trim($('[name="pswd"]').val()) == "" ||
			$.trim($('[name="pincode"]').val()) == "" ){
			alert("At least 1 field is empty. Please fill it.");
			return false;
		}
	});
	</script>
  </body>
</html>