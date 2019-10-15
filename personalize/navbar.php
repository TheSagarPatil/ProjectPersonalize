<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="sweetalert2-8.18.3/package/dist/sweetalert2.css">
	<link href="css/style.css" type="text/css" rel="stylesheet">
	<link href="fontawesome-free-5.11.2-web/css/all.css" type="text/css" rel="stylesheet">

<!--<script src="https://kit.fontawesome.com/dffd1d42d9.js" crossorigin="anonymous"></script>	-->

    <title>Personalized Product</title>
  </head>
  <body>
  <div class="header">
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
  <a class="navbar-brand" href="#">Personalized Product</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home</a>
      </li>
	  <li class="nav-item active">
        <a class="nav-link" href="login.php">Login<span class="sr-only">(current)</span></a>
      </li>
	  
	  <li class="nav-item active">
        <a class="nav-link" href="register.php">Register<span class="sr-only">(current)</span></a>
      </li>
	 
	  
	  <?php 
		session_start();
			if(isset($_SESSION['login_user_name']))
			{
				?>	
				<li class="nav-item active">
					<a class="nav-link" href="my_profile.php?UserName=<?php echo $_SESSION['login_user_name'];?>"><i class="fas fa-user-tie"></i> Profile<span class="sr-only">(current)</span></a>
				</li>
				
				<li class="nav-item active">
					<a class="nav-link" href="logout.php" >Logout<span class="sr-only">(current)</span></a>
				</li>
				
				 <li class="nav-item active">
				<a class="nav-link" href="Cart.php?UserName=<?php echo $_SESSION['login_user_name'];?>"><i class="fas fa-shopping-cart fa-1x"></i> My Cart <span class="sr-only">(current)</span></a>
      </li>
			<?php
			}
			?>
     
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchTerm">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
  </div>
</nav>
  </div>
  <script src="sweetalert2-8.18.3/package/dist/sweetalert2.all.min"></script>
  </body>
  </html>