<?php
include_once 'navbar.php';
include_once 'db.php';
include_once 'product_variant.php';
$database = new Database();
$db = $database->nconnect();
$productVariant = new ProductVariant($db);
include_once 'commonfe.php';
?>
<body>
  <div class="container">
	<div class="row">
	  <div class="col-12 col-md-7  ">
	  <h1>View/customise Chosen Product</h1>
	  </div>
	</div>
<?php
if (isset($_GET["productId"])){
	$productVariant->product_id = $_GET["productId"];
?>
  <form>
 <div class="customcard">
  <div class="container">
  <div class="row">
  <div class="col-lg-12">
  <div class="card-deck">

 <?php
			
				$connect = mysqli_connect("localhost", "root","","db_personalize");
				$query = "SELECT * FROM tbl_product_variant where product_id= ".$_GET['productId']." AND id=".$_GET['variantId']." ORDER BY id ASC";
				$result = mysqli_query($connect, $query);
				if(mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_array($result))
					{
				?>
			
			<div class="col-12 col-sm-12 col-md-4 col-lg-3 col-xl-3">
			<div class="card" style="max-width: 18rem;">
			<img class="card-img-top" src="<?php echo "data:image/jpeg;base64,".base64_encode($row['variant_image']); ?>" alt="Card image cap">
			<div class="card-body">
			<h5 class="text-info"><?php echo $row["variant_name"]; ?>
			<h4 class="text-danger">Rs.<?php echo $row["MRP"]; ?></h4>
			<!--<h6 class="card-subtitle mb-2 text-muted"><?php echo $name;?></h6>-->
			<input name="variant_id" type="hidden" value="<?php echo $row["id"]; ?>"/>
			<!--<input name="product_name" type="hidden" value="<?php echo $product_id;?>"/>
			<p class="card-text"><?php echo $row["variant_description"];?></p>-->

			<input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add To Cart" />
			
		  </div>
		</div>
		</div>
			<div class="col-12 col-sm-12 col-md-8 col-lg-9 col-xl-9">
				<?php echo $row["variant_description"]; ?>
				
				<!--
				
				select * from productVariant where productId = $_GET["id"];
				
				<input type="radio" name="variantArray" value="row['variantId']" id="">
				<input type="text" disabled vaue="row['variantPrice']"/>
				
				
				//optional
				
				select * from stockQty where productVariantId = $_GET['id'] and stockQty > 0;
				<select>
					while (num>0){
						echo '<option value="row['supplierId']">'
					}
				-->
				
			</div>
		<br>
		<br>
			
			<?php
					}
				}
			}
			?>
			
			<div style="clear:both"></div>
   </div>
  </div>
  </div>
  </div>
  </div>
  </form>
  </div>
</body>
<?php
include_once 'footer.php';
?>