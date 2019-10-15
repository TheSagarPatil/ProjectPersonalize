<?php 
/*
$db = mysqli_connect("localhost","root","","db_personalize"); //keep your db name
$sql = "SELECT `variant_image` FROM `tbl_product_variant` WHERE id = 5";
$sth = $db->query($sql);
$result=mysqli_fetch_array($sth);
echo '<img src="data:image/jpeg;base64,'.base64_encode( $result['variant_image'] ).'"/>';
*/
if(isset($_POST["submitBtn"])){
	echo "image ";
	$db = mysqli_connect("localhost","root","","db_personalize"); //keep your db name
	$image = file_get_contents($_FILES['fileToUpload']["tmp_name"]);
	echo "<img src='data:image/jpg;base64,".base64_encode($image)."' />";
	//you keep your column name setting for insertion. I keep image type Blob.
	$query = "INSERT INTO expt (image) VALUES('$image')";  
	$qry = mysqli_query($db, $query);
	echo('insert success');
	$sql = "SELECT `image` FROM `expt` WHERE 1";
	$sth = $db->query($sql);
	$result=mysqli_fetch_array($sth);
	echo '<img src="data:image/jpeg;base64,'.base64_encode( $result['image'] ).'"/>';
}
?>
<form name="f1" method="post" enctype="multipart/form-data">
<input type="file" value="" name="fileToUpload" />
<input type="submit" name="submitBtn" />
</form>