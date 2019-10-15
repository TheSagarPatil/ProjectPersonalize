<?php include_once 'navbar.php'; 

?> 
<br>
<br>
<html>
<head>
	<title>Regitration</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width , initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<style>
span{
	color:red;
	font-size:20px;
	
}
</style>
<body>
	<div class="container">
		<form name="myform" method="post" class="form-group" action="insert_data.php" >
		<h2 style="text-align:center;font-weight:bold; font-size:45px;">Join With Us</h2>
			<div class="row jumbotron">
				<div class="col-md-6">
					<label for="inputname">First Name<span>*</span></label>
					<input type="text" class="form-control" placeholder="First Name" name="fname" required>
				</div>
				
				<div class="col-md-6">
					<label for="inputname">Last Name<span>*</span></label>
					<input type="text" class="form-control" placeholder="Last Name" name="lname" required>
				</div>
				
				<div class="col-md-6">
					<label for="email">Email<span>*</span></label>
					<input type="email" class="form-control" placeholder="Email" name="email" required>
				</div>
				
				<div class="col-xs-12 col-md-6">
					<div class="form-group">
						<label for="gender">Gender<span style="color:red;">*</span></label>
							<div class="input-group">	
							<select class="form-control" name="gender" required>							
								<option value="Male" >Male</option>
								<option value="FeMale" >Female</option>
								<option value="Other" >Other</option>
							</select>
							</div>
					</div> 
				</div>
				
				<!--<div class="col-md-6">
					<div class="form-group">
					<div class="col-xs-12">
					<label for="">Gender<span>*</span></label>
					</div>
					<div class="form-check form-check-inline">
								<input type="radio" class="form-check-input" id="m"name="radio1" value="Male"/>
								<label class="form-check-label" for="m">Male</label>
						</div>
						<div class="form-check form-check-inline">
								<input type="radio" class="form-check-input" id="f" name="radio1" value="Female"/>
								<label class="form-check-label" for="f">Female</label>
						</div>
					</div>
				</div>-->	
				<div class="col-md-6">
					<label for="Contact">Contact No<span>*</span></label>
					<input type="number" class="form-control" placeholder="Mobile No" name="mobileno" required>
				</div>
				
				<div class="col-md-6">
					<label for="Password">User Name<span>*</span></label>
					<input type="text" class="form-control" placeholder="User Name For Login" name="username" required>
				</div>
				
				<div class="col-md-6">
					<label for="Password">Password<span>*</span></label>
					<input type="password" class="form-control" placeholder="Password" name="pass" required>
				</div>
				
				<div class="col-md-6">
					<label for="Address">Address<span>*</span></label>
				<textarea name="address" class="form-control" id="uname" maxlength="35" name="address" name="address" required ></textarea>
				</div>
				
				<div class="col-md-6">
					<label for="City">City<span>*</span></label>
					<input type="text" class="form-control" placeholder="City" name="city" required>
				</div>
				
				<div class="col-xs-12 col-md-4">
					<div class="form-group">
						<label for="signInAs">State<span style="color:red;">*</span></label>
							<div class="input-group">	
							<select name="select_State" class="form-control" id="signInAs" required>
							<option value="Maharashtra" selected>Maharashtra</option>
							<option value="Madhya_Pradesh">Madhya Pradesh</option>
							<option value="Rajasthan">Rajasthan</option>
							<option value="Uttar_Pradesh">Uttar Pradesh</option>
							<option value="Jammu_and_Kashmir">Jammu and Kashmir</option>
							<option value="Gujarat">Gujarat</option>
							<option value="Andhra_Pradesh">Andhra Pradesh</option>
							<option value="Chhattisgarh">Chhattisgarh</option>
							<option value="Tamil_Nadu">Tamil Nadu </option>
							<option value="Telangana">Telangana</option>
							<option value="Bihar">Bihar</option>
							<option value="West_Bengal">West Bengal</option>
							<option value="Arunachal_Pradesh">Arunachal Pradesh</option>
							</select>
						</div>
					</div>
				</div>
				
				<div class="col-md-2">
					<label for="Addres">Zip Code<span>*</span></label>
					<input type="text" class="form-control" placeholder="Zip Code" name="zip_code" required>
				</div>
				
				<div class="col-md-12" style="text-align:center; margin-top:25px">
					<button type="submit" class="btn btn-primary">Submit</button><br>
					<a href="login.php">Already an Account ?</a>
				</div>
						
				
				
			</div>
		</form>
	</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
<?php include_once 'footer.php'; ?>
</html> 
