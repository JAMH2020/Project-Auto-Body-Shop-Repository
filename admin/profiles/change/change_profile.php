<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}
?>

<!DOCTYPE html>
<html>
<head>
  <!--script that will redirect the user to another page-->
  <script src="../../../src/js/submit_form.js"></script>

</head>
<body>

<?php
//include file that will fix the user inputs that are entered
include "../../../database/fixinput.php";



//check if there are any errors
$error_profile_input = false;



//customer's phone number
$customer_phone = "";

//customer's address
$customer_address = "";

//email address
$customer_email = "";

//car make
$car_make = "";

//car model
$car_model = "";

//vin numbe
$vin_no = "";

//license plate
$license_plate = "";


//variables for any missing fields in the sign up page
$customer_phoneERR = $customer_addressERR = $customer_emailERR = $car_makeERR = $car_modelERR = $car_modelERR = $vin_noERR = $license_plateERR = "";
  
  
  
//returns an error message if a field is missing or there is an incorrect input
if ($_SERVER['REQUEST_METHOD'] == "POST"){
 
  //phone number
  createErrMsg("change_profile", "phone number", "customer_phone", "customer_phoneERR");
  
  //address
  createErrMsg("change_profile", "address", "customer_address", "customer_addressERR");

  //email
  createErrMsg("change_profile", "email", "email", "customer_emailERR");

  //car make
  createErrMsg("change_profile", "car make", "car_make", "car_makeERR");
  
  //car model
  createErrMsg("change_profile", "car model", "car_model", "car_modelERR");
  
  //vin number
  createErrMsg("change_profile", "VIN number", "vin_no", "vin_noERR");
  
  //license plate
  createErrMsg("change_profile", "license plate", "license_plate", "license_plateERR");
 
 
  //show the error title if any fields are missing after signing up
  if (empty($_POST['customer_phone']) or empty($_POST['customer_address']) or empty($_POST['customer_email']) or empty($_POST['car_make']) or empty($_POST['car_model']) or empty($_POST['vin_no']) or empty($_POST['license_plate'])){
    $error_profile_input = true;
      
  } else {
    $error_profile_input = false;
  }
} else {
    //remember the email before submitting the form
    $_SESSION['prev_customer_email'] = $_SESSION['customer_email'];
}
  
  



//ask the user to input the required fields if there are missing or incorrect fields or they have not submitted the form yet
if ($error_profile_input or !isset($_POST['change_profile'])){


  //include the navigation bar
  include "../../../navigation_bar/navigation_bar.php";
?>

<h1>Change Customer Profile</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete = "off">

<span>Name:</span>
<span><?php echo $_SESSION['customer_firstname'] . " " . $_SESSION['customer_lastname']?></span> <br>

<span>Phone:</span>
<input type="text" name="customer_phone" placeholder="Phone No." value="<?php echo $_SESSION['customer_phone'];?>"> <br>
<span><?php echo $customer_phoneERR;?></span> <br>

<span>Address:</span>
<input type="text" name="customer_address" placeholder="Address" value="<?php echo $_SESSION['customer_address'];?>"> <br>
<span><?php echo $customer_addressERR;?></span> <br>

<span>Email:</span>
<input type="text" name="customer_email" placeholder="Email" value="<?php echo $_SESSION['customer_email'];?>"> <br>
<span><?php echo $customer_emailERR;?></span> <br>

<span>Car Make:</span>
<input type="text" name="car_make" placeholder="Car Make" value="<?php echo $_SESSION['car_make'];?>"> <br>
<span><?php echo $car_makeERR;?></span> <br>

<span>Car Model:</span>
<input type="text" name="car_model" placeholder="Car Model" value="<?php echo $_SESSION['car_model'];?>"> <br>
<span><?php echo $car_modelERR;?></span> <br>

<span>Vin Number:</span>
<input type="text" name="vin_no" placeholder="Vin No." value="<?php echo $_SESSION['vin_no'];?>"> <br>
<span><?php echo $vin_noERR;?></span> <br>

<span>License Plate:</span>
<input type="text" name="license_plate" placeholder="License Plate" value="<?php echo $_SESSION['license_plate'];?>"> <br>
<span><?php echo $license_plateERR;?></span> <br>



<input type="submit" name="change_profile" value="Change"> <br>


</form>

<a href="../check_profiles.php">Back</a>

<?php
} else {

 //change the profile data in the customer accounts table in the database
 include "../../../database/update/update_cprofiles.php";
?>

<script>redirect_page("../check_profiles.php");</script>

<?php
}
?>

</body>
</html>
