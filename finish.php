<?php
//Start session
session_start();


    //Include database connection details
	require_once('config.php');
	
	require_once('auth.php');
	
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
	
	
	$qry = "select * from packages where establishment_id = '".$_SESSION['ESTABLISHMENT']."'";
	$result = mysql_query($qry);
	
	//Sanitize the POST values 
	
	$name = $_POST['name'];
	$surname = $_POST['surname'];
	$arrival = $_POST['arrival'];
	$reason = $_POST['reason'];
	$national = $_POST['national'];
	$country = $_POST['country'];
	$dis = $_POST['dis'];
	
	
	session_regenerate_id();
			
			$_SESSION['NAME'] = $name;
			$_SESSION['SURNAME'] = $surname;
			$_SESSION['DATE_OF_ARRIVAL'] = $arrival;
			$_SESSION['REASON'] = $reason;
			$_SESSION['NATIONAL'] = $national;
			$_SESSION['COUNTRY'] = $country;
			$_SESSION['DIS'] = $dis;
			
	session_write_close();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>STA Survey Form</title>

<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="jquery.min.js"></script>


<link rel="shortcut icon" href="images/sta.ico"/>


<script>

$(document).ready(function () {
    toggleFields(); //call this first so we start out with the correct visibility depending on the selected form values
    //this will call our toggleFields function every time the selection value of our underAge field changes
    $("#travel").change(function () {
        toggleFields();
    });

});
//this toggles the visibility of our parent permission fields depending on the current selected value of the underAge field
function toggleFields() {
    if ($("#travel").val() == "individual")
        $("#u").show() && $("#z").hide();
    else if ($("#travel").val() == "group")
        $("#z").show()&& $("#u").hide();
}

</script>


<script type="text/javascript"><!--
function updatesum() {


document.g.num_people.value = (document.g.africa.value -0) + (document.g.america.value -0) + (document.g.asia.value -0) + (document.g.europe.value -0);

	
document.g.cont.value = (document.g.africa.value -0) + (document.g.america.value -0) + (document.g.asia.value -0) + (document.g.europe.value -0);

document.g.adu.value = (document.g.num_adult.value -0) + (document.g.num_child.value -0);

document.g.gender8.value = (document.g.num_male.value -0) + (document.g.num_female.value -0);

document.g.age2.value = (document.g.below18.value -0) + (document.g.a18_24.value -0) + (document.g.a25_34.value -0) + (document.g.a35_44.value -0) + (document.g.a45_54.value -0) + (document.g.a55_64.value -0) + (document.g.a64.value -0);

if (document.g.num_people.value != document.g.cont.value != document.g.adu.value != document.g.gender8.value != document.g.age2.value ){
	alert("Make sure that CONTINENT values sum up to Number of people value & Adult + Children values sum up to Number of people value & Male + Female values sum up to Number of people value & Age Group values sum up to Number of people value. Currently the 4 do not match. ");
}

}
//--></script>

<?php
  if($_SESSION['NATIONAL'] == Swazi){
?>
<script type='text/javascript'>
$(document).ready(function(e) {
   $('#con').val('africa'); 
});
</script>

<?php
  }
?>

<?php
// African countries
 if(($_SESSION['COUNTRY'] == 'South Africa') || ($_SESSION['COUNTRY'] == 'Lesotho') || ($_SESSION['COUNTRY'] == 'Zimbabwe') || ($_SESSION['COUNTRY'] == 'Botswana') || ($_SESSION['COUNTRY'] == 'Zambia') || ($_SESSION['COUNTRY'] == 'Namibia') || ($_SESSION['COUNTRY'] == 'Mozambique') || ($_SESSION['COUNTRY'] == 'Angola') || ($_SESSION['COUNTRY'] == 'Madagascar') || ($_SESSION['COUNTRY'] == 'Malawi') || ($_SESSION['COUNTRY'] == 'Mauritius') || ($_SESSION['COUNTRY'] == 'Seychelles') || ($_SESSION['COUNTRY'] == 'Nigeria') || ($_SESSION['COUNTRY'] == 'Ethopia') || ($_SESSION['COUNTRY'] == 'Egypt') || ($_SESSION['COUNTRY'] == 'Kenya') || ($_SESSION['COUNTRY'] == 'Algeria') || ($_SESSION['COUNTRY'] == 'Sudan') || ($_SESSION['COUNTRY'] == 'Uganda') || ($_SESSION['COUNTRY'] == 'Morocco') || ($_SESSION['COUNTRY'] == 'Tanzania') || ($_SESSION['COUNTRY'] == 'Ghana') || ($_SESSION['COUNTRY'] == 'Ivory Coast') || ($_SESSION['COUNTRY'] == 'Cameroon') || ($_SESSION['COUNTRY'] == 'Niger') || ($_SESSION['COUNTRY'] == 'Burkina Faso') || ($_SESSION['COUNTRY'] == 'Mali') || ($_SESSION['COUNTRY'] == 'Malawi') || ($_SESSION['COUNTRY'] == 'Senegal') || ($_SESSION['COUNTRY'] == 'Chad') || ($_SESSION['COUNTRY'] == 'Tunisia') || ($_SESSION['COUNTRY'] == 'Rwanda') || ($_SESSION['COUNTRY'] == 'Somalia') || ($_SESSION['COUNTRY'] == 'Benin') || ($_SESSION['COUNTRY'] == 'Burundi') || ($_SESSION['COUNTRY'] == 'Togo') || ($_SESSION['COUNTRY'] == 'Libya') || ($_SESSION['COUNTRY'] == 'Liberia') || ($_SESSION['COUNTRY'] == 'Gambia') || ($_SESSION['COUNTRY'] == 'Equatorial Guinea') || ($_SESSION['COUNTRY'] == 'Gabon')){
?>
<script type='text/javascript'>
$(document).ready(function(e) {
   $('#con').val('africa'); 
});
</script>

<?php
  }
?>

<?php
// European countries
if(($_SESSION['COUNTRY'] == 'Germany') || ($_SESSION['COUNTRY'] == 'France') || ($_SESSION['COUNTRY'] == 'Austria') || ($_SESSION['COUNTRY'] == 'Albania') || ($_SESSION['COUNTRY'] == 'Belgium') || ($_SESSION['COUNTRY'] == 'Denmark') || ($_SESSION['COUNTRY'] == 'Finland') || ($_SESSION['COUNTRY'] == 'Greece') || ($_SESSION['COUNTRY'] == 'Hungary') || ($_SESSION['COUNTRY'] == 'Italy') || ($_SESSION['COUNTRY'] == 'Latvia') || ($_SESSION['COUNTRY'] == 'Luxembourg') || ($_SESSION['COUNTRY'] == 'Monaco') || ($_SESSION['COUNTRY'] == 'Netherlands') || ($_SESSION['COUNTRY'] == 'Norway') || ($_SESSION['COUNTRY'] == 'Poland') || ($_SESSION['COUNTRY'] == 'Portugal') || ($_SESSION['COUNTRY'] == 'Serbia') || ($_SESSION['COUNTRY'] == 'Spain') || ($_SESSION['COUNTRY'] == 'Switzerland') || ($_SESSION['COUNTRY'] == 'Turkey') || ($_SESSION['COUNTRY'] == 'United Kingdom')){
?>
<script type='text/javascript'>
$(document).ready(function(e) {
   $('#con').val('europe'); 
});
</script>

<?php
  }
?>

<?php
// American countries
if(($_SESSION['COUNTRY'] == 'United States') || ($_SESSION['COUNTRY'] == 'Brazil') || ($_SESSION['COUNTRY'] == 'Mexico') || ($_SESSION['COUNTRY'] == 'Colombia') || ($_SESSION['COUNTRY'] == 'Argentina') || ($_SESSION['COUNTRY'] == 'Canada') || ($_SESSION['COUNTRY'] == 'Peru') || ($_SESSION['COUNTRY'] == 'Venezuela') || ($_SESSION['COUNTRY'] == 'Chile') || ($_SESSION['COUNTRY'] == 'Ecuador') || ($_SESSION['COUNTRY'] == 'Cuba') || ($_SESSION['COUNTRY'] == 'Haiti') || ($_SESSION['COUNTRY'] == 'Bolivia') || ($_SESSION['COUNTRY'] == 'Paraguay') || ($_SESSION['COUNTRY'] == 'Uruguay') || ($_SESSION['COUNTRY'] == 'Jamaica') || ($_SESSION['COUNTRY'] == 'Brazil') || ($_SESSION['COUNTRY'] == 'Guyana')){
?>
<script type='text/javascript'>
$(document).ready(function(e) {
   $('#con').val('america'); 
});
</script>

<?php
  }
?>


<?php
// Asian countries
if(($_SESSION['COUNTRY'] == 'Afghanistan') || ($_SESSION['COUNTRY'] == 'Bangladesh') || ($_SESSION['COUNTRY'] == 'China') || ($_SESSION['COUNTRY'] == 'Taiwan') || ($_SESSION['COUNTRY'] == 'India') || ($_SESSION['COUNTRY'] == 'Indonecia') || ($_SESSION['COUNTRY'] == 'Iran') || ($_SESSION['COUNTRY'] == 'Iraq') || ($_SESSION['COUNTRY'] == 'Israel') || ($_SESSION['COUNTRY'] == 'Japan') || ($_SESSION['COUNTRY'] == 'Jordan') || ($_SESSION['COUNTRY'] == 'North Korea') || ($_SESSION['COUNTRY'] == 'South Korea') || ($_SESSION['COUNTRY'] == 'Kuwait') || ($_SESSION['COUNTRY'] == 'Lebanon') || ($_SESSION['COUNTRY'] == 'Malaysia') || ($_SESSION['COUNTRY'] == 'Oman') || ($_SESSION['COUNTRY'] == 'Pakistan') || ($_SESSION['COUNTRY'] == 'Philippines') || ($_SESSION['COUNTRY'] == 'Qatar') || ($_SESSION['COUNTRY'] == 'Saudi Arabia') || ($_SESSION['COUNTRY'] == 'Singapore') || ($_SESSION['COUNTRY'] == 'Syria') || ($_SESSION['COUNTRY'] == 'Thailand') || ($_SESSION['COUNTRY'] == 'United Arab Emirates') || ($_SESSION['COUNTRY'] == 'Vietnam') || ($_SESSION['COUNTRY'] == 'Yeman')){
?>
<script type='text/javascript'>
$(document).ready(function(e) {
   $('#con').val('asia'); 
});
</script>

<?php
  }
?>


<script src="https://code.jquery.com/jquery-1.5.js"></script>

<script type="text/javascript">
$(window).load(function(){
$("#num_child").keyup(function(){
    $("[name=below18]").val(this.value);
});
});
</script>




</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top" style="background-color:transparent; border:0;">
  <div class="container-fluid">
  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
    <div class="navbar-header">
    </div>
    <div class="navbar-collapse collapse navbar-responsive-collapse">
    
    </ul>
    </div>
  </div>
</nav>

<div class="row">
    <div class="page-header">
        <center>
            <img src='images/sta-logo.jpg' height="150"/>
            
            <h3 id='formTitle'>STA Day Visitor Survey Form</h3>
            <h4 style="color:#78B4F2;"><?php
				echo $_SESSION['ESTAB'];
				
				
				?>
                </h4>
            <div class='row' id='submission_notifier'>
                
            </div>
        </center>
    </div>
</div>

<div class="col-lg-8" style="margin-left:15%;">
<div class="well">

<form method="POST" class="form-horizontal" name="g" id="g" action="processjob.php">

<div class="form-group">
<label for="inputName" class="control-label col-xs-2">
    Travelling as:
    </label>
    <div class="col-xs-10">
        <select id="travel" name="travel" class="form-control">
            
            <option value="individual">Individual</option>
            <option value="group">Group</option>
            
            
        </select>
   </div>
   </div>
   
<div id="u"> 

<div class="form-group">
<label for="inputName" class="control-label col-xs-2"> 
    Continent:</label>
    <div class="col-xs-10">
        <select id="con" name="con" class="form-control">
            <option value="">Select continent</option>
            <option value="africa">Africa</option>
            <option value="america">America</option>
            <option value="asia">Asia</option>
            <option value="europe">Europe</option>
           
        </select>
   </div>
   </div>
   
<div class="form-group">

   
   <label for="inputName" class="control-label col-xs-2"> 
    Age:</label>
    <div class="col-xs-10">
        <select id="age" name="age" class="form-control">
            <option value="">Select your age group</option>
            <option value="Less_18">Less_18 yrs</option>
            <option value="a18_24">18-24 yrs</option>
            <option value="a25_34">25-34 yrs</option>
            <option value="a35_44">35-44 yrs</option>
            <option value="a45_54">45-54 yrs</option>
            <option value="a55_64">55-64 yrs</option>
            <option value="a65">65+yrs</option>
           
        </select>
   </div>
   
   
   </div>
   
<div class="form-group">
<label for="inputName" class="control-label col-xs-2"> 
    Your gender:</label>
    <div class="col-xs-10">
      <label><input type="radio" name="gender" id="gender" value="Male"  />Male</label>  
      <label><input type="radio" name="gender" id="gender" value="Female"  />Female</label>  
   </div>
   </div>
</div>   
   
   
<div id="z"> 

   <div class="form-group">
<label for="inputName" class="control-label col-xs-2"> 
    Your gender1:</label>
    <div class="col-xs-10">
      <label><input type="radio" name="gender1" id="gender1" value="Male"  />Male</label>  
      <label><input type="radio" name="gender1" id="gender1" value="Female"  />Female</label>  
   </div>
   </div>  
   
   <div class="form-group">
<label for="inputName" class="control-label col-xs-2"> 
    Travelling partnership:</label>
    <div class="col-xs-10">
        <select id="partner" name="partner" class="form-control">
            <option value="">Select partnership</option>
            <option value="With spouse/partner">With spouse/partner</option>
            <option value="With colleagues">With colleagues</option>
            <option value="With friends & relatives">With friends & relatives</option>
            <option value="With family">With family</option>
            <option value="With children">With children</option>
            <option value="Packaged tour">Packaged tour</option>
            <option value="School tour">School tour</option>
            <option value="Other">Other</option>
        </select>
   </div>
   </div>
   
   <div class="form-group">
<label for="inputName" class="control-label col-xs-2">
    Number of people:</label>
    
    <div class="col-xs-10">
        <input type="number" name="num_people" class="form-control" onChange="updatesum()" disabled="disabled" />
    </div>
    </div>
    
    
    
    <div class="form-group">
<label for="inputName" class="control-label col-xs-2"> 
    </label>
    <div class="col-xs-10">
       
       
        
       <input type="hidden" name="cont" id="cont" style="width:40%;" onChange="updatesum()" />
       <input type="hidden" name="adu" id="adu" style="width:40%;" onChange="updatesum()" />
       <input type="hidden" name="gender8" id="gender8" style="width:40%;" onChange="updatesum()" />
       <input type="hidden" name="age2" id="age2" style="width:40%;" onChange="updatesum()" />
        
   </div>
   </div>
    
    
    
 
 
 <div class="form-group">
<label for="inputName" class="control-label col-xs-2"> 
    </label>
    <div class="col-xs-10">
       
        <table class="table-striped" style=" background-color:#FFF" >
        <th>Continent</th>
        <th>Number</th>
        <th>Countries</th>
        
        <tr>
        <td>Africa</td><td ><input type="number" name="africa" id="africa" style="width:40%;" onChange="updatesum()" /></td><td width="70%">        <label class="checkbox-inline">
        <input type="checkbox" name="countries[]" value="South Africa" />South Africa
        </label>
        
        <label class="checkbox-inline">
        <input type="checkbox" name="countries[]" value="Mozambique" />Mozambique
        </label>
        
        <label class="checkbox-inline">
        <input type="checkbox" name='countries[]' value="Lesotho" />Lesotho
        </label>
        
        <label class="checkbox-inline">
        <input type="checkbox" name="countries[]" value="Botswana" />Botswana
        </label>
        
        <label class="checkbox-inline">
        <input type="checkbox" name="countries[]" value="Swaziland" />Swaziland
        </label>
        
        <label class="checkbox-inline">
        <input type="checkbox" name="countries[]" value="Other Africa" />Other Africa
        </label>
        
        </td>
        </tr>
        <tr>
        <td>America</td><td><input type="number" name="america" id="america" style="width:40%;" onChange="updatesum()" /></td>
        <td>        <label class="checkbox-inline">
        <input type="checkbox" name="countries[]" value="Colombia" />Colombia
        </label>
        
        <label class="checkbox-inline">
        <input type="checkbox" name="countries[]" value="United States" />United States
        </label>
        <label class="checkbox-inline">
        <input type="checkbox" name="countries[]" value="Brazil" />Brazil
        </label>
        <label class="checkbox-inline">
        <input type="checkbox" name="countries[]" value="Mexico" />Mexico
        </label>
        <label class="checkbox-inline">
        <input type="checkbox" name="countries[]" value="Canada" />Canada
        </label>
       
        <label class="checkbox-inline">
        <input type="checkbox" name="countries[]" value="Angentina" />Angentina
        </label>
        <label class="checkbox-inline">
        <input type="checkbox" name="countries[]" value="Other America" />Other America
        </label>
        
        </td>
        </tr>
        <tr>
        <td>Asia</td><td><input type="number" name="asia" id="asia" style="width:40%;" onChange="updatesum()" /></td><td>        <label class="checkbox-inline">
        <input type="checkbox" name="countries[]" value="China" />China
        </label>
        
        <label class="checkbox-inline">
        <input type="checkbox" name="countries[]" value="Malaysia" />Malaysia
        </label>
        <label class="checkbox-inline">
        <input type="checkbox" name="countries[]" value="India" />India
        </label>
        <label class="checkbox-inline">
        <input type="checkbox" name="countries[]" value="Japan" />Japan
        </label>
        <label class="checkbox-inline">
        <input type="checkbox" name="countries[]" value="Singapore" />Singapore
        </label>
        
        <label class="checkbox-inline">
        <input type="checkbox" name="countries[]" value="Australia" />Australia
        </label>
        <label class="checkbox-inline">
        <input type="checkbox" name="countries[]" value="Other Asia" />Other Asia
        </label>
        
        </td>
        </tr>
        <tr>
        <td>Europe</td><td><input type="number" name="europe" id="europe" style="width:40%;" onChange="updatesum()" /></td>
        <td>        <label class="checkbox-inline">
        <input type="checkbox" name="countries[]" value="Germany" />Germany
        </label>
        
        <label class="checkbox-inline">
        <input type="checkbox" name="countries[]" value="England" />England
        </label>
        <label class="checkbox-inline">
        <input type="checkbox" name="countries[]" value="Switzerland" />Switzerland
        </label>
        <label class="checkbox-inline">
        <input type="checkbox" name="countries[]" value="Russia" />Russia
        </label>
        <label class="checkbox-inline">
        <input type="checkbox" name="countries[]" value="Finland" />Finland
        </label>
        <label class="checkbox-inline">
        <input type="checkbox" name="countries[]" value="France" />France
        </label>
        
        <label class="checkbox-inline">
        <input type="checkbox" name="countries[]" value="Other Europe" />Other Europe
        </label>
        
        </td>
        </tr>
        
        </table>
        
        
        
   </div>
   </div>
   
    <div class="form-group">
<label for="inputName" class="control-label col-xs-2">
   </label>
    
    <div class="col-xs-10">
       
        <table>
        <tr>
        <td>Number of adult:</td><td><input type="number" name="num_adult" id="num_adult" style="width:40%;" onChange="updatesum()" /></td><td>Number of children:</td><td><input type="number" name="num_child" id="num_child" style="width:40%;" onChange="updatesum()"  /></td>
        </tr>
        <tr>
        <td>Number of male:</td><td><input type="number" name="num_male" id="num_male" style="width:40%;" onChange="updatesum()" /></td><td>Number of female:</td><td><input type="number" name="num_female" id="num_female" style="width:40%;" onChange="updatesum()"  /></td>
        </tr>
        </table>
        
    </div>
    </div>
    
    <div class="form-group"> 
  <label for="inputName" class="control-label col-xs-2">
    Age group:</label>
    
    <div class="col-xs-10">
        <table style="padding:4px;">
        <th>Age</th>
        <th></th>
        <th>Number</th>
        <tr>
        <td>Below 18</td><td><input type="hidden" name="age1" id="age1" class="form-control" value="Below 18" /></td><td><input type="number" name="below18"  placeholder="total" onChange="changeVal()"  /></td>
        </tr>
        <tr>
        <td>18-24</td><td><input type="hidden" name="player_name" class="form-control" value="18-24" /></td><td><input type="number" name="a18_24" placeholder="total" onChange="updatesum()"  /></td>
        </tr>
        <tr>
        <td>25-34</td><td><input type="hidden" name="player_name" class="form-control" value="25-34" /></td><td><input type="number" name="a25_34" placeholder="total" onChange="updatesum()"  /></td>
        </tr>
        <tr>
        <td>35-44</td><td><input type="hidden" name="player_name" class="form-control" value="35-44" /></td><td><input type="number" name="a35_44" placeholder="total" onChange="updatesum()"  /></td>
        </tr>
        <tr>
        <td>45-54</td><td><input type="hidden" name="player_name" class="form-control" value="45-54" /></td><td><input type="number" name="a45_54" placeholder="total" onChange="updatesum()"  /></td>
        </tr>
        <tr>
        <td>55-64</td><td><input type="hidden" name="player_name" class="form-control" value="55-64" /></td><td><input type="number" name="a55_64" placeholder="total" onChange="updatesum()" /></td>
        </tr>
        <tr>
        <td>65+</td><td><input type="hidden" name="player_name" class="form-control" value="65+yrs" /></td><td><input type="number" name="a64" placeholder="total" onChange="updatesum()"  /></td>
        </tr>
        </table>
    </div>
    </div>
   </div>
   
   
   <div class="form-group">
<label for="inputName" class="control-label col-xs-2"> 
    Mode of transport:</label>
    <div class="col-xs-10">
        <select id="transport" name="transport" class="form-control" required="required">
             <option value="">Select mode of transport</option>
            <option value="Personal car">Personal car</option>
            <option value="Rental car">Rental car</option>
            <option value="Tour bus">Tour bus</option>
            <option value="School bus">School bus</option>
            <option value="Motor bike">Motor bike</option>
            <option value="Other">Other</option>
        </select>
   </div>
   </div>
   
    <div class="form-group">
<label for="inputName" class="control-label col-xs-2"> 
    Select packages:</label>
    <div class="col-xs-10">
        
        
        
        <?php
		
		
		while ($es = mysql_fetch_array ($result)) {
			//Successful
			
		echo "
		
		<table > 
			  
			  <tr ><td width='60%' ><input type='checkbox' name='packages[]' value='{$es['id']}' />{$es['name']}</td><td><input type='number' name='numv[]' value='' placeholder='total'/></td></tr>
			  </tr>
			   
			</table>
			
			";
			
          }
		  
		  if($result) {
		if(mysql_num_rows($result) < 1) {
			
			echo "<fieldset  style='font-size:14px;font-family:Trebuchet MS;background-color:#FAFAFA;color:#f00;'>	
			<p>There are no packages in the selected establishment.</p>
			</fieldset>";
		     }
		  }
		
		?>
        
        
   </div>
   </div>
   
   
   
    <div class="form-group">
<label for="inputName" class="control-label col-xs-2"> 
    </label>
    <div class="col-xs-10">
    <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </div>
</form>
<h5 style="text-align:left;">2 of 2 sections</h5>

</div>
</div>
</body>
</html>