<?php
	//Start session
	session_start();
	
	//Unset the variables stored in session
	unset($_SESSION['ESTAB']);
	
	session_destroy();
	echo '<script type="text/javascript">alert("System locked successfully!"); location.href="index.php";</script>';
?>