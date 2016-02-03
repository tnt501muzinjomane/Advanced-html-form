<?php
    //Start session
	session_start();
	
	//mysql_connect('localhost','root','root');
	//mysql_select_db('sta_development');
	
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
	
	$qry = "select * from establishments";
	$result = mysql_query($qry);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>STA Survey Form</title>

<meta name="description" content="Welcome to Swaziland Tourism Authority Survey. STA survey system for capturing data of visitors in any of the establishment in the kingdom of Swaziland."/>
<meta name="goolebot" content="STA, STA survey system, Real Image, Tourism in Swaziland"/>

<link rel="shortcut icon" href="images/sta.ico"/>

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  

  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  
  
<script>

$(document).ready(function () {
    toggleFields1(); //call this first so we start out with the correct visibility depending on the selected form values
    //this will call our toggleFields function every time the selection value of our underAge field changes
    $("#as").change(function () {
        toggleFields1();
    });

});
//this toggles the visibility of our parent permission fields depending on the current selected value of the underAge field
function toggleFields1() {
    if ($("#as").val() == "")
        
		$("#j").hide();
    else
        $("#j").show();
}
</script>

<script>

$(document).ready(function () {
    toggleFields(); //call this first so we start out with the correct visibility depending on the selected form values
    //this will call our toggleFields function every time the selection value of our underAge field changes
    $("#national").change(function () {
        toggleFields();
    });

});
//this toggles the visibility of our parent permission fields depending on the current selected value of the underAge field
function toggleFields() {
    if ($("#as").val() = "")
        
		$("#j").hide();
    else
        $("#j").show();
}


function toggleFields() {
    if ($("#national").val() == "Nonswazi")
        $("#i").show() && $("#o").hide();
    else if ($("#national").val() == "Swazi")
        $("#o").show()&& $("#i").hide();
		
		else if ($("#national").val() == "")
		$("#o").hide()&& $("#i").hide();
}

</script>

<script>
  $(function() {
    $( "#arrival" ).datepicker({ dateFormat: 'yy-mm-dd'});
	$( "#arrival" ).datepicker("setDate", new Date());
  });
  </script>


</head>

<body >

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
    <ul class="pull-right" style="padding-top:10px;">
    <!-- Button trigger modal -->
 <?php 
if($_SESSION['ESTAB'] == ''){
 echo "<button type='button' class='btn btn-success'  data-toggle='modal' data-target='#myModal'>
<i class='fa fa-cog'> Login here</i>
</button>";
}
?>
<?php 
if($_SESSION['ESTAB'] != ''){
echo "<a href='logout.php' class='btn btn-danger'><i class='fa fa-power-off'> Logout</i></a>";
}
?>
    </ul>
    </div>
  </div>
</nav>

<div class="row">
    <div class="page-header">
        <center>
            <img src='images/sta-logo.jpg' height="150"/>
            <h4>Welcome To</h4>
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

<div id="j">
<div class="col-lg-8" style="margin-left:15%;">
<div class="well">

<form method="POST" class="form-horizontal" action="finish.php">
<div class="form-group">
<label for="inputName" class="control-label col-xs-2">
   </label>
    
    <div class="col-xs-10">
        <input type="hidden" name="name" id="name" class="form-control" />
        <input type="hidden" name="as" id="as"  value="<?php echo $_SESSION['ESTAB']; ?>" />
    </div>
    </div>
<div class="form-group">
<label for="inputName" class="control-label col-xs-2">
    </label>
    <div class="col-xs-10">
        <input type="hidden" name="surname" id="surname" class="form-control" />
    </div>
    </div>
<div class="form-group">
<label for="inputName" class="control-label col-xs-2">
    Date of arrival:</label>
    <div class="col-xs-10">
        <input type="date" name="arrival" id="arrival" class="form-control" value="<?php echo $_SESSION['DATE_OF_ARRIVAL']; ?>" required="required" />
    </div>
    </div>
<div class="form-group">
<label for="inputName" class="control-label col-xs-2">


    Reason for visit:
    </label>
    <div class="col-xs-10">
        <select id="reason" name="reason" class="form-control" required="required">
            <option value="">Please select</option>
            <option value="Recreation/leisure">Recreation/leisure</option>
            <option value="Educational">Educational</option>
            <option value="Research">Research</option>
            <option value="Other">Other</option>
            
        </select>
   </div>
   </div>
    
<div class="form-group">
<label for="inputName" class="control-label col-xs-2"> 
    Citizenship:</label>
    <div class="col-xs-10">
        <select id="national" name="national" class="form-control" required="required">
            <option value="">Please select</option>
            <option value="Swazi">Swazi</option>
            <option value="Nonswazi">Non-Swazi</option>
        </select>
   </div>
   </div>
   
   <div class="form-group" id="o" >
<label for="inputName" class="control-label col-xs-2"> 
    Distance travelled:</label>
    <div class="col-xs-10">
        <select id="dis" name="dis" class="form-control" >
            <option value="">Please select</option>
            <option value="10">Less than 10km</option>
            <option value="30">10-30km</option>
            <option value="50">30-50km</option>
            <option value="70">50-70km</option>
            <option value="90">70-90km</option>
            <option value="120">above 90km</option>
        </select>
   </div>
   </div>
   
   
<div class="form-group" id="i">
<label for="inputName" class="control-label col-xs-2"> 
    Country:</label>
    <div class="col-xs-10">
        <select name="country" id="country" >
    <option value="" label="Select your country" selected="selected">Select your country </option>
    <option value="Afghanistan" label="Afghanistan">Afghanistan</option>
    <option value="Albania" label="Albania">Albania</option>
    <option value="Algeria" label="Algeria">Algeria</option>
    <option value="American Samoa" label="American Samoa">American Samoa</option>
    <option value="Andorra" label="Andorra">Andorra</option>
    <option value="Angola" label="Angola">Angola</option>
    <option value="Anguilla" label="Anguilla">Anguilla</option>
    <option value="Antarctica" label="Antarctica">Antarctica</option>
    <option value="Antigua and Barbuda" label="Antigua and Barbuda">Antigua and Barbuda</option>
    <option value="Argentina" label="Argentina">Argentina</option>
    <option value="Armenia" label="Armenia">Armenia</option>
    <option value="Aruba" label="Aruba">Aruba</option>
    <option value="Australia" label="Australia">Australia</option>
    <option value="Austria" label="Austria">Austria</option>
    <option value="Azerbaijan" label="Azerbaijan">Azerbaijan</option>
    <option value="Bahamas" label="Bahamas">Bahamas</option>
    <option value="Bahrain" label="Bahrain">Bahrain</option>
    <option value="Bangladesh" label="Bangladesh">Bangladesh</option>
    <option value="Barbados" label="Barbados">Barbados</option>
    <option value="Belarus" label="Belarus">Belarus</option>
    <option value="Belgium" label="Belgium">Belgium</option>
    <option value="Belize" label="Belize">Belize</option>
    <option value="Benin" label="Benin">Benin</option>
    <option value="Bermuda" label="Bermuda">Bermuda</option>
    <option value="Bhutan" label="Bhutan">Bhutan</option>
    <option value="Bolivia" label="Bolivia">Bolivia</option>
    <option value="Bosnia and Herzegovina" label="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
    <option value="Botswana" label="Botswana">Botswana</option>
    <option value="Bouvet Island" label="Bouvet Island">Bouvet Island</option>
    <option value="Brazil" label="Brazil">Brazil</option>
   
    <option value="Brunei" label="Brunei">Brunei</option>
    <option value="Bulgaria" label="Bulgaria">Bulgaria</option>
    <option value="Burkina Faso" label="Burkina Faso">Burkina Faso</option>
    <option value="Burundi" label="Burundi">Burundi</option>
    <option value="Cambodia" label="Cambodia">Cambodia</option>
    <option value="Cameroon" label="Cameroon">Cameroon</option>
    <option value="Canada" label="Canada">Canada</option>
    <option value="Canton and Enderbury Islands" label="Canton and Enderbury Islands">Canton and Enderbury Islands</option>
    <option value="Cape Verde" label="Cape Verde">Cape Verde</option>
    <option value="Cayman Islands" label="Cayman Islands">Cayman Islands</option>
    <option value="Central African Republic" label="Central African Republic">Central African Republic</option>
    <option value="Chad" label="Chad">Chad</option>
    <option value="Chile" label="Chile">Chile</option>
    <option value="China" label="China">China</option>
    <option value="Christmas Island" label="Christmas Island">Christmas Island</option>
    <option value="Cocos [Keeling] Islands" label="Cocos [Keeling] Islands">Cocos [Keeling] Islands</option>
    <option value="Colombia" label="Colombia">Colombia</option>
    <option value="Comoros" label="Comoros">Comoros</option>
    <option value="Congo - Brazzaville" label="Congo - Brazzaville">Congo - Brazzaville</option>
    <option value="Congo - Kinshasa" label="Congo - Kinshasa">Congo - Kinshasa</option>
    <option value="Cook Islands" label="Cook Islands">Cook Islands</option>
    <option value="Costa Rica" label="Costa Rica">Costa Rica</option>
    <option value="Croatia" label="Croatia">Croatia</option>
    <option value="Cuba" label="Cuba">Cuba</option>
    <option value="Cyprus" label="Cyprus">Cyprus</option>
    <option value="Czech Republic" label="Czech Republic">Czech Republic</option>
    <option value="Côte d’Ivoire" label="Côte d’Ivoire">Côte d’Ivoire</option>
    <option value="Denmark" label="Denmark">Denmark</option>
    <option value="Djibouti" label="Djibouti">Djibouti</option>
    <option value="Dominica" label="Dominica">Dominica</option>
    <option value="Dominican Republic" label="Dominican Republic">Dominican Republic</option>
    <option value="Dronning Maud Land" label="Dronning Maud Land">Dronning Maud Land</option>
    
    <option value="Ecuador" label="Ecuador">Ecuador</option>
    <option value="Egypt" label="Egypt">Egypt</option>
    <option value="El Salvador" label="El Salvador">El Salvador</option>
    <option value="Equatorial Guinea" label="Equatorial Guinea">Equatorial Guinea</option>
    <option value="Eritrea" label="Eritrea">Eritrea</option>
    <option value="Estonia" label="Estonia">Estonia</option>
    <option value="Ethiopia" label="Ethiopia">Ethiopia</option>
    <option value="Falkland Islands" label="Falkland Islands">Falkland Islands</option>
    <option value="Faroe Islands" label="Faroe Islands">Faroe Islands</option>
    <option value="Fiji" label="Fiji">Fiji</option>
    <option value="Finland" label="Finland">Finland</option>
    <option value="France" label="France">France</option>
    <option value="French Guiana" label="French Guiana">French Guiana</option>
    <option value="French Polynesia" label="French Polynesia">French Polynesia</option>
    <option value="French Southern Territories" label="French Southern Territories">French Southern Territories</option>
    <option value="French Southern and Antarctic Territories" label="French Southern and Antarctic Territories">French Southern and Antarctic Territories</option>
    <option value="Gabon" label="Gabon">Gabon</option>
    <option value="Gambia" label="Gambia">Gambia</option>
    <option value="Georgia" label="Georgia">Georgia</option>
    <option value="Germany" label="Germany">Germany</option>
    <option value="Ghana" label="Ghana">Ghana</option>
    <option value="Gibraltar" label="Gibraltar">Gibraltar</option>
    <option value="Greece" label="Greece">Greece</option>
    <option value="Greenland" label="Greenland">Greenland</option>
    <option value="Grenada" label="Grenada">Grenada</option>
    <option value="Guadeloupe" label="Guadeloupe">Guadeloupe</option>
    <option value="Guam" label="Guam">Guam</option>
    <option value="Guatemala" label="Guatemala">Guatemala</option>
    <option value="Guernsey" label="Guernsey">Guernsey</option>
    <option value="Guinea" label="Guinea">Guinea</option>
    <option value="Guinea-Bissau" label="Guinea-Bissau">Guinea-Bissau</option>
    <option value="Guyana" label="Guyana">Guyana</option>
    <option value="Haiti" label="Haiti">Haiti</option>
    <option value="Heard Island and McDonald Islands" label="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
    <option value="Honduras" label="Honduras">Honduras</option>
    <option value="Hong Kong SAR China" label="Hong Kong SAR China">Hong Kong SAR China</option>
    <option value="Hungary" label="Hungary">Hungary</option>
    <option value="Iceland" label="Iceland">Iceland</option>
    <option value="India" label="India">India</option>
    <option value="Indonesia" label="Indonesia">Indonesia</option>
    <option value="Iran" label="Iran">Iran</option>
    <option value="Iraq" label="Iraq">Iraq</option>
    <option value="Ireland" label="Ireland">Ireland</option>
    <option value="Isle of Man" label="Isle of Man">Isle of Man</option>
    <option value="Israel" label="Israel">Israel</option>
    <option value="Italy" label="Italy">Italy</option>
    <option value="Ivory Coast" label="Ivory Coast">Ivory Coast</option>
    <option value="Jamaica" label="Jamaica">Jamaica</option>
    <option value="Japan" label="Japan">Japan</option>
    <option value="Jersey" label="Jersey">Jersey</option>
    <option value="Johnston Island" label="Johnston Island">Johnston Island</option>
    <option value="Jordan" label="Jordan">Jordan</option>
    <option value="Kazakhstan" label="Kazakhstan">Kazakhstan</option>
    <option value="Kenya" label="Kenya">Kenya</option>
    <option value="Kiribati" label="Kiribati">Kiribati</option>
    <option value="Kuwait" label="Kuwait">Kuwait</option>
    <option value="Kyrgyzstan" label="Kyrgyzstan">Kyrgyzstan</option>
    <option value="Laos" label="Laos">Laos</option>
    <option value="Latvia" label="Latvia">Latvia</option>
    <option value="Lebanon" label="Lebanon">Lebanon</option>
    <option value="Lesotho" label="Lesotho">Lesotho</option>
    <option value="Liberia" label="Liberia">Liberia</option>
    <option value="Libya" label="Libya">Libya</option>
    <option value="Liechtenstein" label="Liechtenstein">Liechtenstein</option>
    <option value="Lithuania" label="Lithuania">Lithuania</option>
    <option value="Luxembourg" label="Luxembourg">Luxembourg</option>
    <option value="Macau SAR China" label="Macau SAR China">Macau SAR China</option>
    <option value="Macedonia" label="Macedonia">Macedonia</option>
    <option value="Madagascar" label="Madagascar">Madagascar</option>
    <option value="Malawi" label="Malawi">Malawi</option>
    <option value="Malaysia" label="Malaysia">Malaysia</option>
    <option value="Maldives" label="Maldives">Maldives</option>
    <option value="Mali" label="Mali">Mali</option>
    <option value="Malta" label="Malta">Malta</option>
    <option value="Marshall Islands" label="Marshall Islands">Marshall Islands</option>
    <option value="Martinique" label="Martinique">Martinique</option>
    <option value="Mauritania" label="Mauritania">Mauritania</option>
    <option value="Mauritius" label="Mauritius">Mauritius</option>
    <option value="Mayotte" label="Mayotte">Mayotte</option>
    <option value="Metropolitan France" label="Metropolitan France">Metropolitan France</option>
    <option value="Mexico" label="Mexico">Mexico</option>
    <option value="Micronesia" label="Micronesia">Micronesia</option>
    <option value="Midway Islands" label="Midway Islands">Midway Islands</option>
    <option value="Moldova" label="Moldova">Moldova</option>
    <option value="Monaco" label="Monaco">Monaco</option>
    <option value="Mongolia" label="Mongolia">Mongolia</option>
    <option value="Montenegro" label="Montenegro">Montenegro</option>
    <option value="Montserrat" label="Montserrat">Montserrat</option>
    <option value="Morocco" label="Morocco">Morocco</option>
    <option value="Mozambique" label="Mozambique">Mozambique</option>
    <option value="Myanmar [Burma]" label="Myanmar [Burma]">Myanmar [Burma]</option>
    <option value="Namibia" label="Namibia">Namibia</option>
    <option value="Nauru" label="Nauru">Nauru</option>
    <option value="Nepal" label="Nepal">Nepal</option>
    <option value="Netherlands" label="Netherlands">Netherlands</option>
    <option value="Netherlands Antilles" label="Netherlands Antilles">Netherlands Antilles</option>
    <option value="Neutral Zone" label="Neutral Zone">Neutral Zone</option>
    <option value="New Caledonia" label="New Caledonia">New Caledonia</option>
    <option value="New Zealand" label="New Zealand">New Zealand</option>
    <option value="Nicaragua" label="Nicaragua">Nicaragua</option>
    <option value="Niger" label="Niger">Niger</option>
    <option value="Nigeria" label="Nigeria">Nigeria</option>
    <option value="Niue" label="Niue">Niue</option>
    <option value="Norfolk Island" label="Norfolk Island">Norfolk Island</option>
    <option value="North Korea" label="North Korea">North Korea</option>
    <option value="North Vietnam" label="North Vietnam">North Vietnam</option>
    <option value="Northern Mariana Islands" label="Northern Mariana Islands">Northern Mariana Islands</option>
    <option value="Norway" label="Norway">Norway</option>
    <option value="OM" label="Oman">Oman</option>
    <option value="Pacific Islands Trust Territory" label="Pacific Islands Trust Territory">Pacific Islands Trust Territory</option>
    <option value="Pakistan" label="Pakistan">Pakistan</option>
    <option value="Palau" label="Palau">Palau</option>
    <option value="Palestinian Territories" label="Palestinian Territories">Palestinian Territories</option>
    <option value="Panama" label="Panama">Panama</option>
    <option value="Panama Canal Zone" label="Panama Canal Zone">Panama Canal Zone</option>
    <option value="Papua New Guinea" label="Papua New Guinea">Papua New Guinea</option>
    <option value="Paraguay" label="Paraguay">Paraguay</option>
    <option value="People" label="People"s Democratic Republic of Yemen">People"s Democratic Republic of Yemen</option>
    <option value="Peru" label="Peru">Peru</option>
    <option value="Philippines" label="Philippines">Philippines</option>
    <option value="Pitcairn Islands" label="Pitcairn Islands">Pitcairn Islands</option>
    <option value="Poland" label="Poland">Poland</option>
    <option value="Portugal" label="Portugal">Portugal</option>
    <option value="Puerto Rico" label="Puerto Rico">Puerto Rico</option>
    <option value="Qatar" label="Qatar">Qatar</option>
    <option value="Romania" label="Romania">Romania</option>
    <option value="Russia" label="Russia">Russia</option>
    <option value="Rwanda" label="Rwanda">Rwanda</option>
    <option value="Réunion" label="Réunion">Réunion</option>
    <option value="Saint Barthélemy" label="Saint Barthélemy">Saint Barthélemy</option>
    <option value="Saint Helena" label="Saint Helena">Saint Helena</option>
    <option value="Saint Kitts and Nevis" label="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
    <option value="Saint Lucia" label="Saint Lucia">Saint Lucia</option>
    <option value="Saint Martin" label="Saint Martin">Saint Martin</option>
    <option value="Saint Pierre and Miquelon" label="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
    <option value="Saint Vincent and the Grenadines" label="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
    <option value="Samoa" label="Samoa">Samoa</option>
    <option value="San Marino" label="San Marino">San Marino</option>
    <option value="Saudi Arabia" label="Saudi Arabia">Saudi Arabia</option>
    <option value="Senegal" label="Senegal">Senegal</option>
    <option value="Serbia" label="Serbia">Serbia</option>
    <option value="Serbia and Montenegro" label="Serbia and Montenegro">Serbia and Montenegro</option>
    <option value="Seychelles" label="Seychelles">Seychelles</option>
    <option value="Sierra Leone" label="Sierra Leone">Sierra Leone</option>
    <option value="Singapore" label="Singapore">Singapore</option>
    <option value="Slovakia" label="Slovakia">Slovakia</option>
    <option value="Slovenia" label="Slovenia">Slovenia</option>
    <option value="Solomon Islands" label="Solomon Islands">Solomon Islands</option>
    <option value="Somalia" label="Somalia">Somalia</option>
    <option value="South Africa" label="South Africa">South Africa</option>
    <option value="South Georgia and the South Sandwich Islands" label="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
    <option value="South Korea" label="South Korea">South Korea</option>
    <option value="Spain" label="Spain">Spain</option>
    <option value="Sri Lanka" label="Sri Lanka">Sri Lanka</option>
    <option value="Sudan" label="Sudan">Sudan</option>
    <option value="Suriname" label="Suriname">Suriname</option>
    <option value="Svalbard and Jan Mayen" label="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
    
    <option value="Sweden" label="Sweden">Sweden</option>
    <option value="Switzerland" label="Switzerland">Switzerland</option>
    <option value="Syria" label="Syria">Syria</option>
    <option value="ST" label="São Tomé and Príncipe">São Tomé and Príncipe</option>
    <option value="Taiwan" label="Taiwan">Taiwan</option>
    <option value="Tajikistan" label="Tajikistan">Tajikistan</option>
    <option value="Tanzania" label="Tanzania">Tanzania</option>
    <option value="Thailand" label="Thailand">Thailand</option>
    <option value="Timor-Leste" label="Timor-Leste">Timor-Leste</option>
    <option value="Togo" label="Togo">Togo</option>
    <option value="Tokelau" label="Tokelau">Tokelau</option>
    <option value="Tonga" label="Tonga">Tonga</option>
    <option value="Trinidad and Tobago" label="Trinidad and Tobago">Trinidad and Tobago</option>
    <option value="Tunisia" label="Tunisia">Tunisia</option>
    <option value="Turkey" label="Turkey">Turkey</option>
    <option value="Turkmenistan" label="Turkmenistan">Turkmenistan</option>
    <option value="Turks and Caicos Islands" label="Turks and Caicos Islands">Turks and Caicos Islands</option>
    <option value="Tuvalu" label="Tuvalu">Tuvalu</option>
   
    <option value="United States" label="United States">United States</option>
    <option value="Uganda" label="Uganda">Uganda</option>
    <option value="Ukraine" label="Ukraine">Ukraine</option>
    <option value="Union of Soviet Socialist Republics" label="Union of Soviet Socialist Republics">Union of Soviet Socialist Republics</option>
    <option value="United Arab Emirates" label="United Arab Emirates">United Arab Emirates</option>
    <option value="United Kingdom" label="United Kingdom">United Kingdom</option>
    <option value="United States" label="United States">United States</option>
    <option value="Unknown or Invalid Region" label="Unknown or Invalid Region">Unknown or Invalid Region</option>
    <option value="Uruguay" label="Uruguay">Uruguay</option>
    <option value="Uzbekistan" label="Uzbekistan">Uzbekistan</option>
    <option value="Vanuatu" label="Vanuatu">Vanuatu</option>
    <option value="Vatican City" label="Vatican City">Vatican City</option>
    <option value="Venezuela" label="Venezuela">Venezuela</option>
    <option value="Vietnam" label="Vietnam">Vietnam</option>
    <option value="Wake Island" label="Wake Island">Wake Island</option>
    <option value="Wallis and Futuna" label="Wallis and Futuna">Wallis and Futuna</option>
    <option value="Western Sahara" label="Western Sahara">Western Sahara</option>
    <option value="Yemen" label="Yemen">Yemen</option>
    <option value="Zambia" label="Zambia">Zambia</option>
    <option value="Zimbabwe" label="Zimbabwe">Zimbabwe</option>
    <option value="Åland Islands" label="Åland Islands">Åland Islands</option>
</select>
    </div>
    
    </div>
    <div class="form-group">
<label for="inputName" class="control-label col-xs-2"> 
    </label>
    <div class="col-xs-10">
    <button type="submit" class="btn btn-primary">Continue</button>
    </div>
    </div>
        
   
</form>

<h5 style="text-align:left;">1 of 2 sections</h5>
</div>
</div>


</div>







<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#78B4F2; color:#FFF;">
       
        <h4 class="modal-title" id="myModalLabel">Establishment Login</h4>
      </div>
      <div class="modal-body">
      
      <form method="POST" class="form-horizontal" action="processestablishment.php">
        <input type="password" name="secret" id="secret" style="width:40%;" placeholder="Enter secret code" required="required" /><br /><br />
        
        
        
        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Login</button>
        </form>
        
      </div>
    </div>
  </div>
</div>

</body>
</html>