<?php 
include_once 'navbar.php';
	
		if($_GET["UserName"]==null)
		{
			echo '<script>alert("Plase Login First ! ")</script>';
			echo '<script>window.location="login.php"</script>';
		}
	
?>
<html>
<head>
<title> Update User Profile</title>
<br>
</head>
<body>
<?php 
	
	if(isset($_GET["UserName"]))
	{
		
		$username=$_GET["UserName"];
		$connect = mysqli_connect("localhost", "root","","db_personalize");
				$query = "SELECT * FROM tbl_customer where user_name= '$username'";
				$result = mysqli_query($connect, $query);
				if(mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_array($result))
					{
?>
<h1 align="center" class="text-info"><i class="fas fa-user-edit"></i> Update Profile Details</h1>
<br>
<form method="post"action="update_data.php?UserName=<?php echo $_SESSION['login_user_name'];?>">

<div class="container">
			<div class="table-responsive">
				<table class="table table-bordered">
					<tr align="center">
						<th width="50%" class="text-info">First Name</th>
						<th width="50%" class="text-info">Last Name</th>
					</tr>
					<tr align="center">
					<th><input type="text" class="form-control" placeholder="First Name" name="up_fname" 
							value="<?php echo $row["first_name"]; ?>"></th>
					<th><input type="text" class="form-control" placeholder="First Name" name="up_lastname" 
							value="<?php echo $row["last_name"]; ?>" ></th>
					</tr>
					<tr align="center">
						<th width="50%" class="text-info">Email</th>
						<th width="50%" class="text-info">Gender</th>
					</tr>
					<tr align="center">
					<th><input type="text" class="form-control" placeholder="Email" name="up_email" 
							value="<?php echo $row["email"]; ?>"></th>
					<th><input type="text" class="form-control" placeholder="Gender" name="up_gender" 
							value="<?php echo $row["gender"]; ?>" DISABLED></th>
					</tr>
					<tr align="center">
						<th width="50%" class="text-info">Contact No</th>
						<th width="50%" class="text-info">User Name</th>
					</tr>
					<tr align="center">
					<th><input type="text" class="form-control" placeholder="Contact No" name="up_contact_no" 
							value="<?php echo $row["contact_no"]; ?>"></th>
					<th><input type="text" class="form-control" placeholder="User Name" name="up_user_name" 
							value="<?php echo $row["user_name"];?>" DISABLED></th>
					</tr>
					<tr align="center">
						<th width="50%" class="text-info">Address</th>
						<th width="50%" class="text-info">City</th>
					</tr>
					<tr align="center">
					<th><input type="text" class="form-control" placeholder="Address" name="up_Address" 
							value="<?php echo $row["Address"]; ?>"></th>
					<th><input type="text" class="form-control" placeholder="City" name="up_city" 
							value="<?php echo $row["city"]; ?>" ></th>
					</tr>
					<tr align="center">
						<th width="50%" class="text-info">State</th>
						<th width="50%" class="text-info">Zip Code</th>
					</tr>
					<tr align="center">
					<th><input type="text" class="form-control" placeholder="State" name="up_state" 
							value="<?php echo $row["state"]; ?>"></th>
					<th><input type="text" class="form-control" placeholder="Zip Code" name="up_pin_code" 
							value="<?php  echo $row["pin_code"]; ?>" ></th>
					</tr>
					<tr align="center">
						<th colspan="2"><input type="submit" name="update" style="margin-top:5px;" class="btn btn-warning" value="Save Details" /></th>
					</tr>
				</table>
			</div>
		</div>
</form>
<?php 
					}
				}
	}
	?>
</body>
<?php 
include_once 'footer.php';

?>
</html>