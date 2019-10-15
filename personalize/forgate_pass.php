<?php include_once 'navbar.php'; ?> 
<br>
<br>
<html>
<head>
	<title>Regitration</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width , initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<style>
span{
	color:red;
	font-size:20px;	
	}
	
.centered{
	display:flex;
	akign-items:center;
	justify-content:center;
	}
</style>
<body>
	<div class="container">
		<form name="myform" method="post" class="form-group" action="fetch_login.php">
		<h3 style="text-align:center;font-weight:bold; font-size:45px;">Reset Password here</h3>
			<div class="jumbotron">
			<div class="row centered">
				<div class="col-xs-6 col-md-4">
					<label for="inputname" class="centered"><b>User Name</b><span>*</span></label>
					<input type="text" class="form-control" placeholder="Enter User Name" name="new_user_name">
				</div>
			</div>
				<div class="row centered">
				<div class="col-xs-6 col-md-4">
					<label for="inputname" class="centered"><b>Email</b><span>*</span></label>
					<input type="text" class="form-control" placeholder="Enter Email" name="newemail">
				</div>
				</div>
				
				<div class="row centered">
				<div class="col-xs-6 col-md-4">
					<label for="inputname" class="centered"><b>Enter new Password</b><span>*</span></label>
					<input type="text" class="form-control" placeholder="Enter new Password" name="newpass">
				</div>
				</div>
				
				
				<div class="col-md-12" style="text-align:center; margin-top:25px">
					<button type="submit" class="btn btn-primary" name="resetpass">Reset Password</button><br>
				</div>
			
			</div>
	</div>
</body>
<?php include_once 'footer.php'; ?>
</html> 
<?php 
	


?>