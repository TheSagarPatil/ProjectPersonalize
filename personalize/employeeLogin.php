<?php
    include_once 'db.php';
    include_once 'employee.php';
	include_once 'corpNavbar.php';
    //instanciate db and connect
    $database = new Database();
    $db = $database->nconnect();
	include_once 'commonfe.php';
	if(isset($_SESSION["loginMode"])){
		if($_SESSION["loginMode"] !="" ){
			echo $_SESSION["loginMode"];
			//header("location: corpHome.php");
			exit();
		}
	}
?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Corporate Login</title>
  </head>
  <body>
  <div class="container">
	<div class="row">
		<div class="pb-2 mt-4 mb-4 col-12  border-bottom">
			<h1>Corporate Login</h1>
		</div>			
			
	</div>
	<div class="row">
			<div class="offset-sm-1 offset-md-3 offset-lg-3 col-12 col-sm-10 col-md-6 col-lg-6 jumbotron">
			<form name="f1" action="employee_SUD.php" method="post" enctype="multipart/form-data">
			<div class="row">
				<div class="col-12">
					<div class="form-group">
						<div class="row">
						<div class="col-12 col-md-4 ">
							<label class="dyn-text" for="email">Email</label>
							</div>
						<div class="col-12 col-md-8">
							<input type="text" name="email" class="form-control" value="" id="email" aria-describedby="emailHelp" placeholder="email">
							<small id="emailHelp" class="form-text text-muted">email goes here.</small>
						</div>
						</div>
					</div>
				</div>
				<div class="col-12">
					<div class="form-group">
						<div class="row">
						<div class="col-12 col-md-4 ">
							<label class="dyn-text" for="password">password</label>
							</div>
						<div class="col-12 col-md-8">
							<input type="password" name="password" class="form-control" value="" id="password" aria-describedby="passwordHelp" placeholder="password">
							<small id="passwordHelp" class="form-text text-muted">password goes here.</small>
						</div>
						</div>
					</div>
				</div>
				<div class="col-12">
					<div class="form-group">
						<div class="row">
							<div class="col-12 col-md-6 ">
								<div class="form-check">
								  <label class="form-check-label">
									<input type="radio" checked value="emp" class="form-check-input" name="loginType">Corporate Employee Login
								  </label>
								</div>
							</div>
							<div class="col-12 col-md-6 ">
								<div class="form-check">
								  <label class="form-check-label">
									<input type="radio" value="sup" class="form-check-input" name="loginType">Supplier Login
								  </label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="btn-group special" role="group">
					<input type="submit" class="btn btn-dark" name="Login" value="LOGIN"/>
					<input type="reset" class="btn btn-dark" name="Reset" value="RESET"/>
					</div>
				</div>
			</div>
			</form>
			</div>
		</div>
<?php



?>
	</div>
	<script>
	$('[name="login"]').on("click", function(){
		if (
			$.trim($('[name="email"]').val())=="" ||
			$.trim($('[name="password"]').val()) ==""){
			alert("At least 1 field is empty. Please fill it.");
			return false;
		}
	});
	</script>
  </body>
</html>