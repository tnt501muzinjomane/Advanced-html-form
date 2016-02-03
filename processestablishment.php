<?php
//Start session
	session_start();
	
	
	//Include database connection details
	require_once('config.php');
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	//Connect to mysql server
	$link = mysql_connect($mysql_host, $mysql_user, $mysql_password);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db($mysql_database);
	if(!$db) {
		die("Unable to select database");
	}
	
		$secret = "access2015!";
		
		//$establishment = $_POST['e'];
	    $passcode = $_POST['secret'];
		
		
		
		//Create query
	$qry="SELECT * FROM users WHERE unique_code='$passcode'";
	$result=mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		if(mysql_num_rows($result) == 1) {
			//Login Successful
			session_regenerate_id();
			$member = mysql_fetch_assoc($result);
			$id = $member['establishment_id'];
			
			
			
			
			$qry5 = "SELECT * FROM establishments where id = $id order by id DESC limit 1 ";
			$rs = @mysql_query($qry5);
			$row = mysql_fetch_array ($rs,MYSQL_ASSOC);
	
			$r = $row['name'];
			
					
	        $_SESSION['ESTABLISHMENT'] = $id;
			$_SESSION['ESTAB'] = $r;
			session_write_close();	
		
			
			echo '<script type="text/javascript">alert("Establishment selected successfully. "); location.href="index.php";</script>';
			
			exit();
		}else {
			//Login failed
			//header("location: login.php");
			echo '<script type="text/javascript">alert("Wrong secret code. Try again or contact the system administrator!"); location.href="index.php";</script>';
			
			exit();
		}
		
		
	}
		
		
	
		
		
		
			
			
		
		
		
		
		
?>