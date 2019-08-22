<?php
    include_once 'db.php';
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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>All Products</title>
  </head>
  <body>
  <div class="container">
	<div class="row">
		<div class="col-12 col-md-7">
			<h1>All Products</h1>
		</div>
		<div class="col-12 col-md-5">
			<form name="search" action="products.php" method="post">
			<div class="input-group mb-3">
			  <input type="text" name="searchname" class="form-control" placeholder="Search by Name" aria-label="Product name" aria-describedby="btnSearch">
			  <div class="input-group-append">
				<input type="submit" class="btn btn-outline-secondary" id="btnSearch"/>
			  </div>
			</div>
			</form>			
		</div>
	</div>
    <?php	
	$product = new Product($db);
	if( isset($_POST["searchname"]) ){
		echo "search_term : " . $_POST["searchname"];
		$product->name = $_POST["searchname"];
	}
	$result = $product->getProductList();
    $num = $result->rowCount();
	if($num > 0){
		echo "<h6> Some records are found </h6>";
		?>
		<table class="table">
		<thead>
			<tr>
			  <th scope="col">#</th>
			  <th scope="col">Name </th>
			</tr>
		</thead>
		<tbody>
		<?php
		while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
?>
			<tr>
				<td><a href="products.php?id=<?php echo $id; ?>"><?php echo $id; ?></a>
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
	
	if( isset($_GET["id"]) ){
		$product->id =!empty($_GET["id"])?$_GET["id"]:""; 
		$result = $product->getProductList();
		$num = $result->rowCount();
		if($num > 0){
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
			  <p class="mb-0">Additional text</p>
			</div>
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
			  <h4 class="alert-heading">Warning!</h4> 
			  <p>You are in update mode. You should check in on some of those fields below. </p>
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
<?php
			echo "<h4> Information </h4>";
			while($row = $result->fetch(PDO::FETCH_ASSOC)){
				extract($row);
?>
			
			<form name="f1" action="product_SUD.php" method="post">
			<div class="row">
			<div class="col-12 col-">
				<div class="form-group">
					<div class="row">
					<div class="col-12 col-md-4 ">
						<label class="dyn-text" for="id">ID</label>
					</div>
					<div class="col-12 col-md-8">
						<input type="text" name="id" class="form-control" value="<?php echo $id; ?>" id="exampleInputEmail1" aria-describedby="idHelp" placeholder="Product ID">
						<small id="idHelp" class="form-text text-muted">Product ID goes here.</small>
					</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
					<div class="col-12 col-md-4 ">
						<label class="dyn-text" for="name">Name</label>
						</div>
					<div class="col-12 col-md-8">
						<input type="text" name="name" class="form-control" value="<?php echo $name; ?>" id="exampleInputEmail1" aria-describedby="nameHelp" placeholder="Product Name">
						<small id="nameHelp" class="form-text text-muted">Product Name goes here.</small>
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
				<input type="submit" class="btn btn-dark" name="Delete" value="Delete Record"/>
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