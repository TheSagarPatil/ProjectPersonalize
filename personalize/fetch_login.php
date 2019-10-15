<?php 
	session_start();
	$db= mysqli_connect("localhost","root","","db_personalize");
	
		//$_SESSION["login_user_name"]=$_POST['login_user_name'];
		//$_SESSION["login_password"]=$_POST['login_password'];
		//$_SESSION["login_account"]=$_POST['login_account'];
	//echo "Welcome"." ".$_SESSION["login_user_name"];
	
	//For user Login.
	
	if($_SESSION["login_account"]=="User")
	{
	
	$run=mysqli_query($db,"SELECT `user_name`, `password` FROM `tbl_customer` WHERE user_name='$login_user_name'");
	
	$row=mysqli_fetch_array($run);
	
	if($row["user_name"]==$login_user_name && $row['password']==$login_password)
		{
			echo "Login succsesfully ! "." Welcome ".$login_user_name;
	
		}
		else
		{
			echo "Error occur !";
		}
	}
	
	//For Admin login.
	
	if($_SESSION["login_account"]=="Admin")
	{
	$login_user_name=$_POST['login_user_name'];
	$login_password=$_POST['login_password'];
	$login_account=$_POST['login_account'];
	
	$run=mysqli_query($db,"SELECT `username`, `password` FROM `admin_login` WHERE username='$login_user_name'");
	
	$row=mysqli_fetch_array($run);
	
	if($row["username"]==$login_user_name && $row['password']==$login_password)
		{
			echo "Login succsesfully ! "." Welcome ".$login_user_name;
	
		}
		else
		{
			echo "Error occur !";
		}
	}
?>