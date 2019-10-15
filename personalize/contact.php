<?php include_once 'navbar.php'?>
<html>
<head>
<meta charset="utf-8">
<title> Contact Form </title>
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
<main>
	<body>
	<div class="container">
		<form name="contact-form" id="myform" action="contact.php" method="post" class="form-group" >
		<h4 style="text-align:center; color:gray;font-size:45px;">Contact Us </h4>
			<div class="jumbotron">
			<div class="row centered">
				<div class="col-xs-6 col-md-4">
					<label for="inputname" class="centered">Full Name</label>
					<input type="text" class="form-control" placeholder="Full Name" name="name" required>
			
				</div>
			</div>
				<div class="row centered">
				<div class="col-xs-6 col-md-4">
					<label for="inputname" class="centered">Your Email</label>
					<input type="text" class="form-control" placeholder="Enter Email" name="mail" required>			
				</div>
			</div>
				<div class="row centered">
				<div class="col-xs-6 col-md-4">
					<label for="inputname" class="centered">Subject</label>
					<input type="text" class="form-control" placeholder="Enter Subject" name="Subject" required>
					</div>
				</div>
				<div class="row centered">
				<div class="col-xs-6 col-md-4">
					<label for="inputname" class="centered">Message</label>
					<textarea name="Message" class="form-control" placeholder="Message" required></textarea >
					</div>
				</div>
				
				<div class="col-md-12" style="text-align:center; margin-top:25px">
					<button type="submit" class="btn btn-primary" name="submit" value="submit" id="submit">Send Email</button><br>
					
				</div>
			
			</div>
	</div>
</main>
<?php
 if (isset($_POST['submit'])){
	$conn=mysqli_connect("localhost","root","","db_personalize");
	$query ="insert into feedback_form values('".$_POST["name"]."','".$_POST["mail"]."','".$_POST["Subject"]."','".$_POST["Message"]."')";
	$result = mysqli_query($conn, $query);
	if($result == TRUE){
		echo "<script>alert('success')</script>";
	}else{
		echo "<script>alert('fail'".$query.")</script>";
	}
	echo $query;
}
?>
</body>
</html>
<?php include_once 'footer.php'?>