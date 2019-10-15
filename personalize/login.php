<?php include_once 'navbar.php'; ?> 
	
	<?php
	//session_start();
	while(isset($_SESSION['login_user_name']))
	{
		echo '<script>alert("You are Already Login !")</script>';
		echo '<script>window.location="index.php"</script>';
		exit();
	}
	?>
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
		<form name="myform" id="myform" method="post" class="form-group" action="login.php">
		<h3 style="text-align:center;font-weight:bold; font-size:45px;">Login Here</h3>
			<div class="jumbotron col-offset-sm-2 offset-lg-4  col-12 col-sm-8 col-md-6 col-lg-4">
			<div class="row centered">
				<div class="col-12">
					<label for="inputname" class="centered"><b>User Name</b><span>*</span></label>
					<input type="text" class="form-control" placeholder="Enter User Name" id="username" name="login_user_name">
			
				</div>
			</div>
				<div class="row centered">
				<div class="col-12">
					<label for="inputname" class="centered"><b>Password</b><span>*</span></label>
					<input type="Password" class="form-control" placeholder="Enter Password" id="password" name="login_password">
			
					</div>
				</div>
				
				<div class="col-md-12" style="text-align:center; margin-top:25px">
					<input type="submit" class="btn btn-primary" name="login" value="submit" id="submit"/><br>
					<a href="register.php">Don't Have an Account ?</a>
					<a href="forgate_pass.php">  / Forgate Password</a>
				</div>
			
			</div>
			</form>
	</div>
	<?php 
	
	if(isset($_POST['login']))
	{
		
		$db= mysqli_connect("localhost","root","","db_personalize");
		
		$login_user_name=$_POST['login_user_name'];
		$login_password=$_POST['login_password'];
			
	$query = "SELECT `id`,`user_name`,`password` FROM `tbl_customer` WHERE user_name='$login_user_name' limit 1";
			$run=mysqli_query($db,$query);
	
			$row=mysqli_fetch_array($run);
	
			if($row["user_name"]==$login_user_name && $row['password']==$login_password)
			{
				$_SESSION["login_user_name"]=$_POST['login_user_name'];
				$_SESSION["login_user_id"]=$row["id"];
				echo '<script>alert("Login Succsesfully !")</script>';
				echo '<script>window.location="index.php"</script>';
			}
			else
			{
			echo '<script>alert("Username and Password Are not match ! ")</script>';
			//echo '<script>window.location="login.php"</script>';	
			
			}
	}
	?>

</body>
<?php include_once 'footer.php'; ?>

<script>
$(document).ready(function() {

  $('#myform').submit(function(e) {
    var username = $('#username').val();
    var password = $('#password').val();
   
    $(".error").remove();

    if (username.length < 2 ) {
      $('#username').after('<span class="error">This field is required</span>');
	  return false;
    }
    if (password.length < 5) {
      $('#password').after('<span class="error">This field is required</span>');
	  return false;
    }
    
  });

});
</script>
  
</html> 










