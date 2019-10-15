<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="corphome.php">Personalize</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
<?php 
session_start();
if(isset($_SESSION["loginMode"])){
	if($_SESSION["loginMode"] != ""){
?>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
		
      <li class="nav-item active">
        <a class="nav-link" href="corphome.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          You
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="corpLogout.php">logout</a>
        </div>
      </li>
	  
    </ul>
  </div>
<?php
	}
}
?>
</nav>
<?php 
if(isset($_SESSION["loginMode"])){
	if($_SESSION["loginMode"] == "emp" || $_SESSION["loginMode"] == "sup"){
?>
		<nav aria-label="breadcrumb" class="">
		  <ol class="breadcrumb p-0">
			<div class="menuContainer" style="width:max-content">
<?php
		if($_SESSION["loginMode"] == "emp" || $_SESSION["loginMode"] == "sup"){
			if(isset($_SESSION["privilage"])){
				
?>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="crmDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				  CRM
				</a>
				<div class="dropdown-menu " aria-labelledby="navbarDropdown">
<?php
				if($_SESSION["privilage"] == "Admin" || $_SESSION["privilage"] == "Manager/Analyst"){
?>
				  <a class="dropdown-item" href="customers.php">Manage Customers</a>
				  <div class="dropdown-divider"></div>
<?php
				}
				if($_SESSION["privilage"] == "Admin" || $_SESSION["privilage"] == "Manager/Analyst" || $_SESSION["privilage"] == "DeliveryPerson"){
?>
				  <a class="dropdown-item" href="orders.php">Manage Customers' Orders</a>
				  
<?php
				}
?>
				</div>
			</li>
<?php	
				
			}
?>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="inventoryDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				  Inventory
				</a>

				<div class="dropdown-menu " aria-labelledby="inventoryDropdown">
<?php
			if(isset($_SESSION["privilage"])){
				if($_SESSION["privilage"] == "Admin" || $_SESSION["privilage"] == "Manager/Analyst"){
?>
				  <a class="dropdown-item" href="products.php">Manage Base Products</a>
				  <a class="dropdown-item" href="product_variants.php">Manage Product Variants</a>
				  <div class="dropdown-divider"></div>
<?php
				}
			}
?>
<?php
			if($_SESSION["loginMode"] == "sup"){
?>
				  <a class="dropdown-item" href="productStockView.php?supId=<?php echo $_SESSION["id"]?>">Manage Product Stocks </a>
<?php
			}
			if($_SESSION["loginMode"] == "emp"){
?>
				  <a class="dropdown-item" href="productStockView.php">Manage Product Stocks [wip]</a>
<?php 		}
?>
				</div>
			</li>
<?php
			if(isset($_SESSION["privilage"])){
				if($_SESSION["privilage"] == "Admin" || $_SESSION["privilage"] == "Manager/Analyst"){
?>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="inventoryDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				  Employees
				</a>
				<div class="dropdown-menu" aria-labelledby="inventoryDropdown">
				  <a class="dropdown-item" href="Employees.php">Employees</a>
				  <a class="dropdown-item" href="employeeJobAsg.php">Employee Delivery Asg [wip]</a>
				</div>
			</li>			
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="inventoryDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				  Supply
				</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="inventoryDropdown">
				  <a class="dropdown-item" href="suppliers.php">Manage Suppliers</a>
				</div>
			</li>
<?php	
				}
			}
		}
		if(isset($_SESSION["privilage"])){
			if($_SESSION["privilage"] == "Admin" || $_SESSION["privilage"] == "Manager/Analyst"){
?>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="inventoryDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				  Reports
				</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="inventoryDropdown">
				  <a class="dropdown-item" href="report_top5grossing.php">Top 5 Products [wip]</a>
				  <a class="dropdown-item" href="report_top5Suppliers.php">Top 5 Suppliers [wip]</a>
				</div>
			</li>
<?php 	
			}
		}if ($_SESSION["loginMode"] == "sup"){
			
?>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="inventoryDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				  Reports
				</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="inventoryDropdown">
								
					<a class="dropdown-item" href="report_Suptop5grossing.php">My Top 5 Products [wip] </a>
				</div>
			</li>
<?php
		}
?>
					

			</div>
		  </ol>
		</nav>
<?php

	}
}else{
	if($_SERVER['PHP_SELF'] != "/personalize/employeeLogin.php"){
		header("Location: employeeLogin.php");
	}
}
?>
<style>
.breadcrumb{
	/*overflow-x:auto;*/
}
.breadcrumb .menuContainer{
	height:40px; 
	min-width:100%;
	width:max-content;
}
.breadcrumb .dropdown{
	display: inline-block;
}
</style>