<?php
session_start();
isset($_SESSION["name"])?$_SESSION["name"] = "":"";
isset($_SESSION["id"])?$_SESSION["id"] = "":"";
isset($_SESSION["loginMode"])?$_SESSION["loginMode"] = "":"";
isset($_SESSION["privilage"])?$_SESSION["privilage"] = "":"";
echo $_SESSION["name"];
session_destroy();
header("Location: employeeLogin.php");
?>