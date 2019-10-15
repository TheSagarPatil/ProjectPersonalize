<?php 
		/*if($_GET["UserName"]==null)
		{
			echo '<script>alert("Plase Login First ! ")</script>';
			echo '<script>windo.location="login.php"</script>';
		}*/
		
		$up_user_name=$_GET["UserName"];
		
		$conn=mysqli_connect("localhost","root","","db_personalize");
		
		$up_fname=$_POST['up_fname'];
		$up_lastname=$_POST['up_lastname'];
		$up_email=$_POST['up_email'];
		//$up_gender=$_POST['up_gender'];
		$up_contact_no=$_POST['up_contact_no'];
		//$up_user_name=$_POST['up_user_name'];
		$up_Address=$_POST['up_Address'];
		$up_city=$_POST['up_city'];
		$up_state=$_POST['up_state'];
		$up_pin_code=$_POST['up_pin_code'];
		
		//echo $up_fname ;
		//echo $up_user_name;
		
		$query="UPDATE `tbl_customer` SET `first_name`='$up_fname',`last_name`='$up_lastname',`email`='$up_email',`contact_no`='$up_contact_no',`Address`='$up_Address',`city`='$up_city',`state`='$up_state',`pin_code`='$up_pin_code' WHERE user_name='$up_user_name'";
		
		$sql=mysqli_query($conn,$query);
		
		if($sql==ture)
		{
			echo '<script>alert("Data updated sucssesfully !")</script>';
			echo '<script>window.location="index.php"</script>';
		}
		else
		{
			echo '<script>alert("Error While updating sucssesfully !")</script>';
			echo '<script>window.location="index.php"</script>';
		}
	
?>