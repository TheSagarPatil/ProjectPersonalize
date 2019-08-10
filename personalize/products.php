<?php
    include_once 'db.php';
    include_once 'product.php';
    //instanciate db and connect
    $database = new Database();
    $db = $database->nconnect();
?>
<form name="search" action="products.php" method="post">
	<input type="text" name="name" placeholder="Search by Name"/>
	<input type="submit"/>
</form>
<?php	
	$product = new Product($db);
	if( isset($_POST["name"]) ){
		echo "search_term : " . $_POST["name"];
		$product->name = $_POST["name"];
	}
	$result = $product->getProductList();
    $num = $result->rowCount();
	if($num > 0){
		echo "<br/> records Found";
		while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
?>
			
			<br/><a href="products.php?id=<?php echo $id; ?>"><?php echo $id; ?></a>
			<?php echo $name; ?>
<?php 
		}
	}else{
		echo "<br/> no records Found";
	}
	
	if( isset($_GET["id"]) ){
		$product->id =!empty($_GET["id"])?$_GET["id"]:""; 
		$result = $product->getProductList();
		$num = $result->rowCount();
		if($num > 0){
			echo "<br/><br/> Information";
			while($row = $result->fetch(PDO::FETCH_ASSOC)){
				extract($row);
?>
			<form name="update" action="products.php">
			<br/><label>ID</label> <input type="text" name="id" value="<?php echo $id; ?>"/> 
			<br/><label>Name</label> <input type="text" name="name" value="<?php echo $name; ?>"/>
			<br/>
			<input type="button" value="new/reset"/>
			<input type="submit" value="submit"/>
			<input type="submit" value="delete"/>
			
			</form>
<?php 
			}
		}else{
			echo "<br/> Bad ID";
		}
	}
	
	
?>