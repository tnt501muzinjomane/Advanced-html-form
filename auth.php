<?php
	//Start session
	session_start();
	
	//Check whether the session variable 
	if(!isset($_SESSION['ESTAB']) || (trim($_SESSION['ESTAB']) == '')) {
		echo '<script type="text/javascript">alert("You need to SETUP ESTABLISHMENT FIRST! Please seek for assistance from the staff and try again."); location.href="index.php";</script>';
		//header("location: index.php");
		exit();
	}
?>