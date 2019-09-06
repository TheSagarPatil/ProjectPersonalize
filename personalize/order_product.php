<?php
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
	  <div class="col-12 col-md-7">
	  <h1>Choose a Product</h1>
	  </div>
	</div>
<?php
if (isset($_GET["productId"]) && isset($_GET["variantId"])){
	$productVariant->product_id = $_GET["productId"];
	$productVariant->id = $_GET["variantId"];
	
	//echo $productVariant->product_id;
	//echo $productVariant->id;
	
	//echo $productVariant->id;
	$result = $productVariant->getVariantList();
	echo $productVariant->query;
	$num = $result->rowCount();
	if($num > 0){
		while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
?>
<div class="card" style="max-width: 45rem;">
  <img class="card-img-top" src="..." alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title"><?php echo $name;?> : <?php echo $variant_name;?></h5>
	<input name="variant_id" type="hidden" value="<?php echo $id;?>"/>
	<input name="product_name" type="hidden" value="<?php echo $product_id;?>"/>
    <p class="card-text"><?php echo $variant_description;?></p>
    <a href="#" class="btn btn-primary">Order</a>
  </div>
</div>
<?php			
		}
	}
}
?>	
  </div>
</body>
<?php
?>