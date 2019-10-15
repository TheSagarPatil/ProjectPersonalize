<?php
    include_once 'db.php';
	include_once 'corpNavbar.php';
    include_once 'product_variant.php';
	include_once 'product.php';
    //instanciate db and connect
    $database = new Database();
    $db = $database->nconnect();
	include_once 'commonfe.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>All Product Variants</title>
  </head>
  <body>
  <div class="container">
	<div class="row">
		<div class="col-12 col-md-7">
			<h1>All Product Variants</h1>
		</div>
		<div class="col-12 col-md-5">
			<form name="search" action="product_variants.php" method="post">
			<div class="input-group mb-3">
			  <input type="text" name="searchname" list="searchnameList" class="form-control" placeholder="Search by Name" aria-label="Product Variant name" aria-describedby="btnSearch">
			  <div class="input-group-append">
				<input type="submit" class="btn btn-outline-secondary" value="Search" id="btnSearch"/>
			  </div>
			
<?php
				$productVariant = new ProductVariant($db);
				$result = $productVariant->getRecordList();
				$num = $result->rowCount();
				if($num > 0){
					echo '<datalist id="searchnameList">';
					while($row = $result->fetch(PDO::FETCH_ASSOC)){
						extract($row);
							
						echo "<option>".$variant_name."</option>";
					}
					echo '</datalist>';
				}
?>			
			</div>
			</form>			
		</div>
	</div>
	
    <?php	
	
	if( isset($_POST["searchname"]) ){
		echo "search_term : " . $_POST["searchname"];
		$productVariant->variant_name = $_POST["searchname"];
		//$productVariant->product_name = $_POST["searchname"];
	}
	$result = $productVariant->getRecordList();
    $num = $result->rowCount();
	if($num > 0){
		echo "<h6> Some records are found </h6>";
		
		?>
	
		<table class="table">
		<thead>
			<tr>
			  <th scope="col">#</th>
			  <th scope="col">product Variant </th>
			  <th scope="col">Base Product </th>
			</tr>
		</thead>
		<tbody>
		<?php
		while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
?>
			<tr>
				<td><a href="product_variants.php?id=<?php echo $id; ?>&product_id=<?php echo $product_id; ?>"><?php echo $id; ?></a>
				</td>
				<td>
				<?php echo $variant_name; ?>
				</td>
				<td>
				<?php echo $name; ?>
				</td>
			</tr>
<?php 
		}
		
		
	}else{
		echo "<tr><td colspan=2> No records found<td></tr>";
	}
	
	
?>
		</tbody>
		</table>
			<!-- 
$('.alert').alert('close/dispose')
$('#myAlert').on('closed.bs.alert/close.bs.alert', function () {
  // do something...
})
			-->
			<div class="alert alert-success alert-dismissible fade show d-none" role="alert">
			
			  <h4 class="alert-heading">Success!</h4>
			  <p>Notice text</p>
			  <hr>
			  <p class="mb-0">Saved successfully</p>
			</div>
			
			
<?php
	if( isset($_GET["id"]) && isset($_GET["product_id"]) ){
		$productVariant->id =!empty($_GET["id"])?$_GET["id"]:""; 
		$productVariant->product_id =!empty($_GET["product_id"])?$_GET["product_id"]:""; 
		$productVariant->product_name="";
		$result = $productVariant->getRecordList();
		$num = $result->rowCount();
		if($num > 0){
			echo "<h4> Information </h4>";
			while($row = $result->fetch(PDO::FETCH_ASSOC)){
				extract($row);
?>
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
			  <h4 class="alert-heading">Warning!</h4> 
			  <p>You are in update mode. You should check in on some of those fields below. </p>
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<form name="f1" action="product_variant_SUD.php" method="post" enctype="multipart/form-data">
			<div class="row">
				<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="row">
						<div class="col-12 col-md-4 ">
							<label class="dyn-text" for="id">ID</label>
						</div>
						<div class="col-12 col-md-8">
							<input type="text" name="id" class="form-control" value="<?php echo $id; ?>" id="exampleInputEmail1" aria-describedby="idHelp" placeholder="Product ID">
							<small id="idHelp" class="form-text text-muted">Product Variant ID goes here.</small>
						</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="row">
						<div class="col-12 col-md-4 ">
							<label class="dyn-text" for="variant_name">Name</label>
							</div>
						<div class="col-12 col-md-8">
							<input type="text" name="variant_name" class="form-control" value="<?php echo $variant_name; ?>" id="variant_name" aria-describedby="nameHelp" placeholder="Product Variant Name">
							<small id="nameHelp" class="form-text text-muted">Product Variant name goes here.</small>
						</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="row">
						<div class="col-12 col-md-4 ">
							<label class="dyn-text" for="name">Base Product </label>
							</div>
						<div class="col-12 col-md-8">
						<select name="product_id" class="form-control">
<?php 
				if( isset($_GET["id"]) && isset($_GET["product_id"]) ){
					$product = new Product($db);
					//$product->id =!empty($_GET["product_id"])?$_GET["product_id"]:""; 
					
					$result = $product->getRecordList();
					$num = $result->rowCount();
					if($num > 0){
						while($row = $result->fetch(PDO::FETCH_ASSOC)){
							extract($row);
?>
						<option value="<?php echo $id ?>"
							<?php
							$selectflg;
							$selectflg = ($id == $_GET["product_id"])? "selected":"";
							echo $selectflg;
							?>
						><?php echo $name ?></option>
<?php
						
						}
					}
				}
?>
							</select >
							<small id="nameHelp" class="form-text text-muted">Base product name goes here.</small>
						</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="row">
						<div class="col-12 col-md-4 ">
							<label class="dyn-text" for="variant_description">Variant Description</label>
							</div>
						<div class="col-12 col-md-8">
							<input type="text" name="variant_description" class="form-control" value="<?php echo $variant_description; ?>" id="variant_description" aria-describedby="nameHelp" placeholder="Variant description">
							<small id="variant_descriptionHelp" class="form-text text-muted">Product Variant name goes here.</small>
						</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="row">
							<div class="col-12 col-md-4 ">
								<label class="dyn-text" for="variant_image">Variant Image</label>
								</div>
							<div class="col-12 col-md-8">
								<input type="file" name="variant_image" class="form-control" value="
									<?php 
									if(!empty($variant_image)){
										echo "data:image/jpeg;base64,".base64_encode($variant_image);
									}else{
										echo ""; 
									}
									?>" id="variant_image" aria-describedby="variant_imageHelp" placeholder="Variant Image">
								<small id="variant_imageHelp" class="form-text text-muted">Product Variant Image goes here.</small>
								<img height=200px width=200px  src="<?php echo "data:image/jpeg;base64,".base64_encode($variant_image); ?>  ">
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="row">
						<div class="col-12 col-md-4 ">
							<label class="dyn-text" for="mrp">MRP</label>
							</div>
						<div class="col-12 col-md-8">
							<input type="text" name="mrp" class="form-control" value="<?php echo $mrp; ?>" id="mrp" aria-describedby="nameHelp" placeholder="mrp">
							<small id="mrpHelp" class="form-text text-muted">Product Variant mrp goes here.</small>
						</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="btn-group special" role="group">
				<input type="button" class="btn btn-dark" name="new" value="New Record"/>
				<input type="button" class="btn btn-dark" name="Reset" value="Reset Values"/>
				<input type="submit" class="btn btn-dark" name="Save" value="Save Record"/>
				</div>
			</div>
			</form>
<?php 
			}//end while variant
		}//end num 0 variant 	
	}else{
		//echo "<br/> ID is not defined to show dedicated information view";
	}
?>
	</div>
	<script>
	$("[name='new']").click(function(){
		$("[name='id']").val("").attr("disabled","true");
		$("[name='name']").val("")
	});
	$('[name="Save"]').on("click", function(){
		if (
			$.trim($('[name="variant_name"]').val())=="" ||
			$.trim($('[name="variant_description"]').val()) =="" ||
			$.trim($('[name="product_id"]').val()) == "") {
			alert("At least 1 field is empty. Please fill it.");
			return false;
		}else{
			if($.trim($('[name="variant_image"]').val()) != ""){
				var ext = $('[name="variant_image"]').val().split('.').pop().toLowerCase();
				if($.inArray(ext, ['gif', 'jpeg', 'png', 'jpg']) == -1) {
					alert("Invalid file");
					$('[name="variant_image"]').val('');
					return false;
				}
			}
		}
	});
	</script>
  </body>
</html>