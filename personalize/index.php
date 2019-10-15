<?php include_once 'navbar.php'; 
	  include_once 'commonfe.php';
?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
	<link href="css/style.css" type="text/css" rel="stylesheet">
	<link href="fontawesome-free-5.11.2-web/css/all.css" type="text/css" rel="stylesheet">

    <title>Personalized Product</title>
  </head>
  <body>
  <div class="slider">
  <div class="bd-example">
  <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
	  
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="images/banner1.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>Home-Made Cakes</h5>
          
        </div>
      </div>
      <div class="carousel-item">
        <img src="images/Jwellery1.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>Jwellery</h5>
          
        </div>
      </div>
      
	  <div class="carousel-item">
        <img src="images/Jwellery.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>Jwellery</h5>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
  </div>
  
     <center><h3>Here Some <span style="color:blue">Trendings Products Information.</span> </h3></center>

<br>

 <div class="customcard">
  <div class="container">
  <div class="row">
  <div class="col-lg-12">
  <div class="card-deck">
<?php
$searchterm="";
if(isset($_GET['searchTerm'])){
	$searchterm=$_GET['searchTerm'];
}
			
				$connect = mysqli_connect("localhost", "root","","db_personalize");
				//$query = "SELECT * FROM tbl_product_variant ORDER BY id ASC";
				$query = "SELECT 
					`tbl_product_variant`.`id`, 
					`tbl_product`.`name`, 
					`tbl_product_variant`.`product_id`, 
					`tbl_product_variant`.`variant_name`, 
					`tbl_product_variant`.`variant_description`, 
					`tbl_product_variant`.`variant_image`,
					`tbl_product_variant`.`mrp`,
					`tbl_product_stock`.`supplierId`
				FROM `tbl_product_variant` 
					right join `tbl_product` 
					on `tbl_product`.`id` = `tbl_product_variant`.`product_id` 
					left join `tbl_product_stock` 
					on `tbl_product_stock`.`productVariantId` = `tbl_product_variant`.`id` 
				where 
					`tbl_product_stock`.`stockQty`>0 AND
				`tbl_product_variant`.`variant_name` like '%".$searchterm."%'";
				//echo $query;
				$result = mysqli_query($connect, $query);
				if(mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_array($result))
					{
				?>

			
			<div class="col-12 col-sm-12 col-md-4 col-lg-3 col-xl-3 mb-4">
			<form method="post" >
			<div class="card" style="">
			<img class="card-img-top"  src="<?php echo "data:image/jpeg;base64,".base64_encode($row['variant_image']); ?>" alt="Card image cap" >
			<div class="card-body">
			<h5 class="text-info"><?php echo $row["variant_name"]; ?>
			<h4 class="text-danger">Rs.<?php echo $row["mrp"]; ?></h4>
			
			<input name="supplier_id" type="hidden" value="<?php echo $row["supplierId"]; ?>"/>
			<input name="variant_id" type="hidden" value="<?php echo $row["id"]; ?>"/>
			<a href="view_product.php?productId=<?php echo $row["product_id"];?>&variantId=<?php echo $row['id']?>" class="card-link btn btn-warning">View Product</a>
			<?php 
			
				if(isset($_SESSION['login_user_name']))
				{
			?>
				<input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />
			<?php 
				}
				else
				{
			?>	
					<input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Order Now" />
			<?php
				}
			?>
		  </div>
		</div>
		  </form>
		</div>
			
			
		

  
  <?php
					}
				}
			?>
			</div>
  </div>
  </div>
  </div>
  </div>
  <?php 
		if(isset($_POST['add_to_cart']))
				{
					if($_SESSION['login_user_name']==null)
					{
						echo '<script>alert("To buy this product please Register First !")</script>';
						echo '<script>window.location="register.php"</script>';
					}
					else
					{
						$variant_id=$_POST['variant_id'];
						
						$query = "insert into `tbl_usercart`(`customerId`,`productVariantId`,`supplierId`) values(".$_SESSION["login_user_id"].",".$_POST['variant_id'].",".$_POST['supplier_id'].");";
						
						//echo '<script>alert("'.$query.'")</script>';
						$run = mysqli_query($connect, $query);
						if($run == TRUE){
						echo '<script>alert("Item Aadded in Cart !")</script>';
						}
					}
				}
		
				
  
  
  
  
  
  include_once 'footer.php' ?>
  </body>
 </html>
