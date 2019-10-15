<?php 
	$db= mysqli_connect("localhost","root","","db_personalize");
	
	$new_user_name=$_POST['new_user_name'];
	$newemail=$_POST['newemail'];
	$newpass=$_POST['newpass'];
	
	$query="UPDATE `tbl_customer` SET `password`='$newpass' WHERE `user_name`='$new_user_name'and `email`='$newemail'";
	
	$run=mysqli_query($db,$query);
	
	if($run==true)
	{
		//$msg="Password rest Succsefully !";
		echo '<script type="text/javascript">';
		echo 'alert("Password rest Succsefully !")';
		echo '</script>';
		
	}
	else
	{
		echo "Worng User Name or Email";
	}
	header("location:login.php");
?>