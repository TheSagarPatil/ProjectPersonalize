<?php 
include_once 'navbar.php';

		  while(!isset($_SESSION['login_user_name']))
			{
				echo '<script>alert("You Must Login first !")</script>';
				echo '<script>window.location="index.php"</script>';
				exit();
			}

?>
<html>
<head>
<title>User Profile</title>
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
<br>
<br>
<h1 align="center" class="text-info">Profile Details</h1>
<br>
<form method="post" action="update_profile.php?UserName=<?php echo $_SESSION['login_user_name'];?>">
		<div class="container">
			<div class="table-responsive">
				<table class="table table-bordered">
					<tr align="center">
						<th width="50%" class="text-info">First Name</th>
						<th width="50%" class="text-info">Last Name</th>
					</tr>
					<tr align="center">
						<th><h5> <?php echo $row["first_name"]; ?></h5></th>
						<th><h5> <?php echo $row["last_name"]; ?></h5></th>
					</tr>
					<tr align="center">
						<th width="50%" class="text-info">Email</th>
						<th width="50%" class="text-info">Gender</th>
					</tr>
					<tr align="center">
						<th><h5> <?php echo $row["email"]; ?></h5></th>
						<th><h5> <?php echo $row["gender"]; ?></h5></th>
					</tr>
					<tr align="center">
						<th width="50%" class="text-info">Contact No</th>
						<th width="50%" class="text-info">User Name</th>
					</tr>
					<tr align="center">
						<th><h5> <?php echo $row["contact_no"]; ?></h5></th>
						<th><h5> <?php echo $row["user_name"]; ?></h5></th>
					</tr>
					<tr align="center">
						<th width="50%" class="text-info">Address</th>
						<th width="50%" class="text-info">City</th>
					</tr>
					<tr align="center">
						<th><h5> <?php echo $row["Address"]; ?></h5></th>
						<th><h5> <?php echo $row["city"]; ?></h5></th>
					</tr>
					<tr align="center">
						<th width="50%" class="text-info">State</th>
						<th width="50%" class="text-info">Zip Code</th>
					</tr>
					<tr align="center">
						<th><h5> <?php echo $row["state"]; ?></h5></th>
						<th><h5> <?php echo $row["pin_code"]; ?></h5></th>
					</tr>
					<tr align="center">
						<th colspan="2"><input type="submit" name="update" style="margin-top:5px;" class="btn btn-warning" value="Update Profile" /></th>
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
<?php include_once 'footer.php'; ?>
</html>