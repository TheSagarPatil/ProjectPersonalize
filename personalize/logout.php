<?php 

	session_start();
	
	session_destroy();
	echo '<script>alert("Logout Succsesfully !")</script>';
	header('location:login.php');
?>