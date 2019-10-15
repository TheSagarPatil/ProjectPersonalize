<?php
    include_once 'db.php';
	include_once 'corpNavbar.php';
    include_once 'employee.php';
	//include_once 'product.php';
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

    <title>Employees</title>
  </head>
  <body>
  <div class="container">
	<div class="row">
		<div class="col-12 col-md-7">
			<h1>Employees</h1>
		</div>
		<div class="col-12 col-md-5">
			<form name="search" action="employees.php" method="post">
			<div class="input-group mb-3">
			  <input type="text" name="searchname" list="searchnameList" class="form-control" placeholder="Search by Name" aria-label="Product Variant name" aria-describedby="btnSearch">
			  <div class="input-group-append">
				<input type="submit" class="btn btn-outline-secondary" value="Search" id="btnSearch"/>
			  </div>
			
<?php
				$employee = new Employee($db);
				$result = $employee->getRecordList();
				$num = $result->rowCount();
				if($num > 0){
					echo '<datalist id="searchnameList">';
					while($row = $result->fetch(PDO::FETCH_ASSOC)){
						extract($row);
							
						echo "<option>".$name."</option>";
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
		$employee->name = $_POST["searchname"];
		//$productVariant->product_name = $_POST["searchname"];
	}
	$result = $employee->getRecordList();
    $num = $result->rowCount();
	if($num > 0){
		echo "<h6> Some records are found </h6>";
		
		?>
	
		<table class="table">
		<thead>
			<tr>
			  <th scope="col">#</th>
			  <th scope="col">Name </th>
			  <th scope="col">Email</th>
			  <th scope="col">Privilage</th>
			</tr>
		</thead>
		<tbody>
		<?php
		while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
?>
			<tr>
				<td><a href="employees.php?id=<?php echo $id; ?>"><?php echo $id; ?></a>
				</td>
				<td>
				<?php echo $name; ?>
				</td>
				<td>
				<?php echo $email; ?>
				</td>
				<td>
				<?php echo $privilage; ?>
				</td>
			</tr>
<?php 
		}
		
		
	}else{
		echo "<tr><td colspan=4> No records found<td></tr>";
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
			if($_GET["msg"]=="success"){
				
?>
			<div class="alert alert-success alert-dismissible fade show " role="alert">
			
			  <h4 class="alert-heading">Success!</h4>
			  <hr>
			  <p class="mb-0">Saved successfully</p>
			</div>
			
			
<?php
			}
		}
	if( isset($_GET["id"])){
		$employee->id =!empty($_GET["id"])?$_GET["id"]:""; 
		//$productVariant->product_id =!empty($_GET["product_id"])?$_GET["product_id"]:""; 
		$employee->name="";
		$result = $employee->getRecordList();
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
			<form name="f1" action="employee_SUD.php" method="post" enctype="multipart/form-data">
			<div class="row">
				<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="row">
						<div class="col-12 col-md-4 ">
							<label class="dyn-text" for="id">ID</label>
						</div>
						<div class="col-12 col-md-8">
							<input type="hidden" name="id" class="form-control" value="<?php echo $id; ?>" id="id" aria-describedby="idHelp">
							<input type="text" class="form-control" value="<?php echo $id; ?>" disabled placeholder="Employee ID">
							<small id="idHelp" class="form-text text-muted">This is Employee ID. [Not Editable field]</small>
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
							<input type="text" name="name" class="form-control" value="<?php echo $name; ?>" id="name" aria-describedby="nameHelp" placeholder="Employee Name">
							<small id="nameHelp" class="form-text text-muted">Employee name goes here.</small>
						</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="row">
						<div class="col-12 col-md-4 ">
							<label class="dyn-text" for="name">Privilages </label>
							</div>
						<div class="col-12 col-md-8">
						<select name="privilage" class="form-control">
<?php 
				
				$wcr=array('Admin','Manager/Analyst','DeliveryPerson');
				foreach($wcr as $key => $value):
						
					if($value == $privilage){
						echo '<option value="'.$value.'" key="'.$key.'" selected>'.$value.'</option>';
					}else{
						echo '<option value="'.$value.'" key="'.$key.'">'.$value.'</option>';
					}
				endforeach;
?>

							</select >
							<small id="privilageHelp" class="form-text text-muted">Employee privilage goes here.</small>
						</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="row">
						<div class="col-12 col-md-4 ">
							<label class="dyn-text" for="email">Employee Email</label>
							</div>
						<div class="col-12 col-md-8">
							<input type="text" name="email" class="form-control" value="<?php echo $email; ?>" id="email" aria-describedby="emailHelp" placeholder="email">
							<small id="emailHelp" class="form-text text-muted">email goes here.</small>
						</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="row">
						<div class="col-12 col-md-4 ">
							<label class="dyn-text" for="password">Employee password</label>
							</div>
						<div class="col-12 col-md-8">
							<input type="password" name="password" class="form-control" value="<?php echo $pswd; ?>" id="password" aria-describedby="passwordHelp" placeholder="password">
							<small id="passwordHelp" class="form-text text-muted">password goes here.</small>
						</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="row">
							<div class="col-12 col-md-4 ">
								<label class="dyn-text" for="photo">Photo</label>
								</div>
							<div class="col-12 col-md-8">
								<input type="file" name="photo" class="form-control" value="" id="photo" aria-describedby="PhotoHelp" placeholder="Photo">
								<small id="PhotoHelp" class="form-text text-muted">Photo goes here.</small>
								<img height=200px width=200px  src="data:image/jpeg;base64,<?php echo base64_encode($photo); ?>  ">
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
		$("[name='name'], [name='privilage'], [name='email'], [name='password'], [name='photo']").val("");
	});
	$('[name="Save"]').on("click", function(){
		if ( 
			$.trim($('[name="name"]').val())=="" ||
			$.trim($('[name="privilage"]').val()) =="" ||
			$.trim($('[name="email"]').val()) == "" ||
			$.trim($('[name="password"]').val()) == "" 
			 ){
			alert("At least 1 field is empty. Please fill it.");
			return false;
		}
		if($.trim($('[name="photo"]').val()) == "" && $('img').prop("src") == ""){
			alert("Image field can not be empty.");
		}
		if($.trim($('[name="photo"]').val()) != ""){
			var ext = $('[name="photo"]').val().split('.').pop().toLowerCase();
			if($.inArray(ext, ['gif', 'jpeg', 'png', 'jpg']) == -1) {
				alert("Invalid file");
				$('[name="photo"]').val('');
				return false;
			
			}
		}
	});
	</script>
  </body>
</html>