<?php

	$conn=mysqli_connect("localhost","root","","db_personalize");
	
	$firstname=$_POST['fname'];
	$lastname=$_POST['lname'];
	$email=$_POST['email'];
	$gender=$_POST['gender'];
	$contactno=$_POST['mobileno'];
	$username=$_POST['username'];
	$password=$_POST['pass'];
	$address=$_POST['address'];
	$city=$_POST['city'];
	$select_State=$_POST['select_State'];
	$zip_code=$_POST['zip_code'];
	
	
	$query="INSERT INTO `tbl_customer`(`first_name`, `last_name`, `email`, `gender`, `contact_no`, `user_name`, `password`, `Address`, `city`, `state`, `pin_code`) VALUES ('$firstname','$lastname','$email','$gender','$contactno','$username','$password','$address','$city','$select_State','$zip_code')";
	
	$run=mysqli_query($conn,$query);
	
	if($run==true)
	{
		echo '<script>alert("User Registred Successfully ! ")</script>';
		echo '<script>window.location="login.php"</script>';
	}
	else
	{
		
		echo '<script>alert("Username is already used ! try other Username. ")</script>';
		echo '<script>window.location="register.php"</script>';
	}


?>