<?php
    include_once 'db.php';
	include_once 'corpNavbar.php';
	include_once 'supplier.php';
	include_once 'product_variant.php';
    include_once 'productStock.php';
    //instanciate db and connect
    $database = new Database();
    $db = $database->nconnect();
	include_once 'commonfe.php';
	
	class Top5Suppliers{
		public $id;
		public $name;
		public $count;
		public $sum;
		public function __construct($db){
			$this->conn = $db;
		}
		public function getTop5Suppliers(){
			$query = "SELECT 
						count(`p`.`id`) as `ProductIdCount` , 
						sum(`pv`.`mrp`) as `revenue` ,
						`o`.`supplierId` as `supplierId`,
						`sup`.`name` as `supplierName`
						
					FROM `tbl_order` as `o` 
					left join `tbl_product_variant` 
					as `pv` on `o`.`productVariantId` = `pv`.`id` 
					left join `tbl_product` as `p` 
					on `pv`.`product_Id` = `p`.`id`
					left join `tbl_supplier` as `sup` 
					on `o`.`supplierId` = `sup`.`id`

					group by `o`.`supplierId`";
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			return $stmt;
		}
	}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Top 5 Performing Suppliers</title>
  </head>
  <body>
  <div class="container">
	<div class="row">
		<div class="col-12">
			<h1>Top 5 Performing Suppliers</h1>
		</div>
	</div>
    <?php	
	$top5Suppliers = new Top5Suppliers($db);	
	$result = $top5Suppliers->getTop5Suppliers();
    $num = $result->rowCount();
	if($num > 0){
		echo "<h6> Some records are found </h6>";
		?>
		<table class="table">
		<thead>
			<tr>
			  <th scope="col">Supplier#</th>
			  <th scope="col">Supplier Name </th>
			  <th scope="col">Units Sold</th>
			  <th scope="col">Revenue </th>
			</tr>
		</thead>
		<tbody>
		<?php
		while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
?>
			<tr>
				<td>
					<a href="suppliers.php?id=<?php echo $supplierId; ?>">
					<?php echo $supplierId; ?></td>
					</a>
				<td><?php echo $supplierName; ?></td>
				<td><?php echo $ProductIdCount; ?></td>
				<td>&#8377; <?php echo $revenue; ?></td>
				
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
<?php
	if(isset($_GET["msg"])){
		if($_GET["msg"] == "success"){
?>			
			<div class="alert alert-success alert-dismissible fade show " role="alert">
			  <h4 class="alert-heading">Success!</h4>
			  <p>Notice text</p>
			  <hr>
			  <p class="mb-0">Additional text</p>
			</div>
<?php
		}
	}
?>
			
<?php
	if( isset($_GET["supplierId"]) && isset($_GET["productVariantId"])){
		$productStock->supplierId = $_GET["supplierId"];
		$productStock->productVariantId = $_GET["productVariantId"];
		$result = $productStock->getRecordList();
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
			<form name="f1" action="productStock_SUD.php" method="post">
			<div class="row">
				<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="row">
						<div class="col-12 col-md-4 ">
							<label class="dyn-text" for="id">ID</label>
						</div>
						<div class="col-12 col-md-8">
							<input type="text" name="productVariantId" class="form-control d-none" value="<?php echo $productVariantId; ?>" id="productVariantId" aria-describedby="productVariantIdHelp" placeholder="product Variant Id"/>
							<input type="text" name="variant_name" disabled class="form-control d-none" value="<?php echo $variant_name; ?>" id="variant_name" aria-describedby="variant_nameHelp" placeholder="variant name"/>
							<select name="supplierId" class="form-control">
<?php 
								$productVariant = new ProductVariant($db);
								//$product->id =!empty($_GET["product_id"])?$_GET["product_id"]:""; 
								
								$result = $productVariant->getRecordList();
								$num = $result->rowCount();
								if($num > 0){
									while($row = $result->fetch(PDO::FETCH_ASSOC)){
										extract($row);
?>
								<option value="<?php echo $id ?>"
									<?php
										$selectflg;
										$selectflg = ($id == $productVariantId)? "selected":"";
										echo $selectflg;
									?>
								><?php echo "#".$id." ".$name ?></option>
<?php
									}
								}
?>
							</select >
							<small id="productVariantIdHelp" class="form-text text-muted">product Variant goes here.</small>
						</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="row">
						<div class="col-12 col-md-4 ">
							<label class="dyn-text" for="name">Name</label>
							</div>
						<div class="col-12 col-md-8">
							<input type="text" name="supplierIdB" class="form-control d-none" value="<?php echo $supplierId; ?>" id="supplierId" aria-describedby="supplierIdHelp" placeholder="supplier Id"/>
							<input type="text" name="supplierName" disabled class="form-control d-none" value="<?php echo $supplierName; ?>" id="supplierName" aria-describedby="supplierNameHelp" placeholder="supplier Name"/>
							<select name="supplierId" class="form-control">
<?php 
								$supplier = new Supplier($db);
								//$product->id =!empty($_GET["product_id"])?$_GET["product_id"]:""; 
								
								$result = $supplier->getRecordList();
								$num = $result->rowCount();
								if($num > 0){
									while($row = $result->fetch(PDO::FETCH_ASSOC)){
										extract($row);
?>
								<option value="<?php echo $id ?>"
									<?php
										$selectflg;
										$selectflg = ($id == $supplierId)? "selected":"";
										echo $selectflg;
									?>
								><?php echo "#".$id." ".$name ?></option>
<?php
									}
								}
?>
							</select >
							<small id="nameHelp" class="form-text text-muted">Supplier Name goes here.</small>
						</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="row">
							<div class="col-12 col-md-4 ">
								<label class="dyn-text" for="name">Name</label>
							</div>
							<div class="col-12 col-md-8">
								<input type="number" name="stockQty" class="form-control" value="<?php echo $stockQty; ?>" id="stockQty" aria-describedby="stockQtyHelp" placeholder="stockQty"/>
								<small id="stockQtyHelp" class="form-text text-muted">stockQty goes here.</small>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="btn-group special" role="group">
				<input type="reset" class="btn btn-dark" name="Reset" value="Reset Values"/>
				<input type="submit" class="btn btn-dark" name="Save" value="Save Record"/>
				</div>
			</div>
			</form>
<?php 
			}
		}else{
			echo "<br/> Bad ID";
		}
	}	
?>
	</div>
	<script>
	$("[name='new']").click(function(){
		$("[name='id']").val("").attr("disabled","true");
		$("[name='name']").val("")
	})
	</script>
  </body>
</html>