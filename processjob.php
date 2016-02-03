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
	
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
	//Sanitize the POST values 
  
    $travel = $_POST['travel'];
	$gender = $_POST['gender'];
	$gender1 = $_POST['gender1'];
	$age = $_POST['age'];
	$con = $_POST['con'];
	$partner = $_POST['partner'];
	$num_people = $_POST['num_people'];
	$africa = $_POST['africa'];
	$asia = $_POST['asia'];
	$america = $_POST['america'];
	$europe = $_POST['europe'];
	$from = $_POST['from'];
	$num_adult = $_POST['num_adult'];
	$num_child = $_POST['num_child'];
	$num_male = $_POST['num_male'];
	$num_female = $_POST['num_female'];
	$transport = $_POST['transport'];
	$a = $_POST['below18'];
	$b = $_POST['a18_24'];
	$c = $_POST['a25_34'];
	$d = $_POST['a35_44'];
	$e = $_POST['a45_54'];
	$f = $_POST['a55_64'];
	$g = $_POST['a64'];
	$packages= $_POST['packages'];
	$num= $_POST['numv'];
	$countries= $_POST['countries'];
	
	
	$qry5 = "SELECT * FROM users where establishment_id = '".$_SESSION['ESTABLISHMENT']."' order by id DESC limit 1 ";
	$rs = @mysql_query($qry5);
	$row = mysql_fetch_array ($rs,MYSQL_ASSOC);
	
	$u = $row['id'];
	
	//Create INSERT query for individual visitor
	if($travel == individual){
$qry = "INSERT INTO visitor_infos(name, surname, date_of_arrival, reason_for_vist, mode_of_transport, gender, male, female, travel,  partner, citizenship, country, user_id, Below_18, age18_24, age25_34, age35_44, age45_54, age55_64, age65) 
VALUES('".$_SESSION['NAME']."','".$_SESSION['SURNAME']."','".$_SESSION['DATE_OF_ARRIVAL']."','".$_SESSION['REASON']."','$transport','$gender','','','$travel','$partner','".$_SESSION['NATIONAL']."','".$_SESSION['COUNTRY']."',$u, '', '', '', '', '', '', '')";
	}
	
	//Create INSERT query for group visitors

	else if($travel == group){
		
		$qry = "INSERT INTO visitor_infos(name, surname, date_of_arrival, reason_for_vist, mode_of_transport, gender, male, female, travel,  partner,citizenship, country, user_id, Below_18, age18_24, age25_34, age35_44, age45_54, age55_64, age65) 
VALUES('".$_SESSION['NAME']."','".$_SESSION['SURNAME']."','".$_SESSION['DATE_OF_ARRIVAL']."','".$_SESSION['REASON']."','$transport','$gender1','$num_male','$num_female','$travel','$partner','".$_SESSION['NATIONAL']."','".$_SESSION['COUNTRY']."',$u, '$a', '$b', '$c', '$d', '$e', '$f', '$g')";
	}
	
	$result = @mysql_query($qry);
	
	// Get id for the data inserted above to be used later on
	
	$qry3="SELECT * FROM visitor_infos order by id DESC limit 1 ";
	$result3=mysql_query($qry3);
	
	$row = mysql_fetch_array ($result3,MYSQL_ASSOC);
	
	$id = $row['id'];
	
	// Insert to non swazi individual
	if(($_SESSION['NATIONAL'] == Nonswazi) && ($travel == individual)){
		 $qry = "INSERT INTO international_visitor_infors(africa, asia, america, europe, visitor_info_id) values ('','','','', $id)";
		 
		 $result = @mysql_query($qry);
		 
		$qry3="SELECT * FROM international_visitor_infors order by id DESC limit 1 ";
		$result3=mysql_query($qry3);
		
		$row = mysql_fetch_array ($result3,MYSQL_ASSOC);
		
		$i = $row['id'];
		
		// Update non Swazi individual
		if(($travel == individual) && ($con == africa)){
		$qry6 = "update international_visitor_infors set africa = '1' where id = $i ";
		$result6=mysql_query($qry6);
	    }
		
		if(($travel == individual) && ($con == america)){
		$qry6 = "update international_visitor_infors set america = '1' where id = $i ";
		$result6=mysql_query($qry6);
	    }
		
		if(($travel == individual) && ($con == asia)){
		$qry6 = "update international_visitor_infors set asia = '1' where id = $i ";
		$result6=mysql_query($qry6);
	    }
		
		if(($travel == individual) && ($con == europe)){
		$qry6 = "update international_visitor_infors set europe = '1' where id = $i ";
		$result6=mysql_query($qry6);
	    }	
	}
	
	// Update country Swaziland
	
	if($_SESSION['NATIONAL'] == Swazi){
		$qry6 = "update visitor_infos set country = 'Swaziland' where id = $id ";
		$result6=mysql_query($qry6);
	    }	
		
	// Update individual partnership 
	
	if($travel == individual){
		$qry6 = "update visitor_infos set partner = 'Alone' where id = $id ";
		$result6=mysql_query($qry6);
	    }
	
	// Insert into non swazi group
	
	if(($_SESSION['NATIONAL'] == Nonswazi) && ($travel == group)){
		 $qry = "INSERT INTO international_visitor_infors(africa, asia, america, europe, visitor_info_id) values ('$africa','$asia','$america','$europe', $id)";
		 
		 $result = @mysql_query($qry);
	}
	
	// Updates on gender individual
	if(($travel == individual) && ($gender == Male)){
		$qry6 = "update visitor_infos set male = '1' where id = $id ";
		$result6=mysql_query($qry6);
	    }
			
	if(($travel == individual) && ($gender == Female)){
		$qry6 = "update visitor_infos set female = '1' where id = $id ";
		$result6=mysql_query($qry6);
	    }
	
	// Insert into swazi
	if($_SESSION['NATIONAL'] == Swazi){
		 $qry = "INSERT INTO swazi_visitor_infos(place_of_residence, visitor_infor_id) values ('".$_SESSION['DIS']."',$id)";
		 
		 $result = @mysql_query($qry);
	
	}
	
	//Update individual age
	
	if(($travel == individual) && ($age == Less_18)){
	$qry6 = "update visitor_infos set Below_18 = '1' where id = $id ";
	$result6=mysql_query($qry6);
	}
	
	if(($travel == individual) && ($age == a18_24)){
	$qry6 = "update visitor_infos set age18_24 = '1' where id = $id ";
	$result6=mysql_query($qry6);
	}
	
	if(($travel == individual) && ($age == a25_34)){
	$qry6 = "update visitor_infos set age25_34 = '1' where id = $id ";
	$result6=mysql_query($qry6);
	}
	
	if(($travel == individual) && ($age == a35_44)){
	$qry6 = "update visitor_infos set age35_44 = '1' where id = $id ";
	$result6=mysql_query($qry6);
	}
	
	if(($travel == individual) && ($age == a45_54)){
	$qry6 = "update visitor_infos set age45_54 = '1' where id = $id ";
	$result6=mysql_query($qry6);
	}
	
	if(($travel == individual) && ($age == a55_64)){
	$qry6 = "update visitor_infos set age55_64 = '1' where id = $id ";
	$result6=mysql_query($qry6);
	}
	
	if(($travel == individual) && ($age == a65)){
	$qry6 = "update visitor_infos set age65 = '1' where id = $id ";
	$result6=mysql_query($qry6);
	}
	
	// Insert packages
	$N = count($packages);
        for($i=0; $i < $N; )
        {
            $var1=$packages[$i];
            $q = "INSERT INTO visitor_packages (visitor_infor_id, package_id) VALUES ($id, '$var1')";
			$r=mysql_query($q);
           $i++;
        }
		
		// Insert number of people per package
	$N = count($num);
       
        for($i=0; $i < $N; )
        {
            $var1=$num[$i];
			//$pacakagev
			//$var2=$num[$i];
            
            $q2 = "INSERT INTO num_visitors (visitor_infor_id, numv) VALUES ($id, '$var1')";
            
			$r=mysql_query($q2);
           $i++;
        }
		
		    //remove all zeros in this table
			$q3 = "delete from num_visitors where numv = 0";
			$r3=mysql_query($q3);	
		
		// Insert countries
		if($travel == group){
			$Z = count($countries); 
				for($i=0; $i < $Z; $i++)
				{
					$var1=$countries[$i];
					$q1 = "INSERT INTO countries (visitor_id, name) VALUES ($id, '$var1')";
					$r1=mysql_query($q1);
				   
				}
		}
		
		// Insert swazi individual to countries
		if(($travel == individual) && ($_SESSION['NATIONAL'] == Swazi)){
			
			$q1 = "INSERT INTO countries (visitor_id, name) ".
							 "VALUES ($id, 'Swaziland')";
					
					$r1=mysql_query($q1);
		}
		
		// Insert non swazi individual to countries
		if(($travel == individual) && ($_SESSION['NATIONAL'] == Nonswazi)){
			
			$q1 = "INSERT INTO countries (visitor_id, name) ".
							 "VALUES ($id, '".$_SESSION['COUNTRY']."')";
					
					$r1=mysql_query($q1);
		}
	
	//Check whether the query was successful or not
	if($result) {
		unset($_SESSION['NAME']);
		unset($_SESSION['SURNAME']);
		unset($_SESSION['DATE_OF_ARRIVAL']);
		unset($_SESSION['REASON']);
		unset($_SESSION['NATIONAL']);
		unset($_SESSION['COUNTRY']);
		unset($_SESSION['DIS']);
		
		echo '<script type="text/javascript">alert("Thank you for making our survey successfully. ."); location.href="index.php";</script>';
		exit();
	}else {
		die("Sorry! The system failed to process !");
	}

?>