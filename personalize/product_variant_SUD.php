<?php
include_once 'db.php';
include_once 'product_variant.php';
$database = new Database();
$db = $database->nconnect();
$id = "";
$name = "";
$query = "";
$productVariant = new ProductVariant($db);
if(isset($_POST["Save"])){
	$productVariant->id = isset($_POST["id"])?$_POST["id"]:"";
	$productVariant->variant_name = isset($_POST["variant_name"])?$_POST["variant_name"]:"";
	$productVariant->product_id = isset($_POST["product_id"])?$_POST["product_id"]:"";
	$productVariant->variant_description = isset($_POST["variant_description"])?$_POST["variant_description"]:"";
	$productVariant->mrp = isset($_POST["mrp"])?$_POST["mrp"]:"";
	//echo  empty($productVariant->variant_image);
	$productVariant->variant_image = empty($_FILES['variant_image']["tmp_name"])?"":file_get_contents($_FILES['variant_image']["tmp_name"]);
	
	//echo $productVariant->variant_image;
	/*$check = getimagesize($_FILES["variant_image"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
	*/
	if($productVariant->id==""){
		echo "saving var";
		$msg = $productVariant->saveRecord();
		header("Location: product_variants.php?msg=".$msg);
	}else{
		echo "<br>updating var";
		$msg = $productVariant->updateRecord();
		header("Location: product_variants.php?msg=".$msg);
	}
}
if(isset($_POST["Delete"])){
	$productVariant->id = isset($_POST["id"])?$_POST["id"]:"";
	echo "deleting";
	$msg = $productVariant->deleteRecord();
	header("Location: product_variants.php?msg=".$msg);
	
}

//echo $query;
echo "<br/>".$id . " " . $name;
?>