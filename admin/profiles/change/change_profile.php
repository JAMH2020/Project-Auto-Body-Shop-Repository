<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}

//check if the user is logged in yet
include_once "../../../login/login_check.php";
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <!--title that will show up on the tab-->
  <title>Edit a Customer Profile</title>
  <meta name="description" content="Edit the Information of a Customer Profile">
  <meta name="author" content="JAMH Group">

  <!--script that will redirect the user to another page-->
  <script src="../../../src/js/submit_form.js"></script>
  
  <!--script that will ask for user confirmation before submitting form-->
  <script src="../../../src/js/form_confirmation.js"></script>
  
  <!--stylesheet for the page-->
  <link href="change_profiles_styles.css" rel="stylesheet" type="text/css" />

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

//car year
$car_year = "";

//car make
$car_make = "";

//car model
$car_model = "";

//vin numbe
$vin_no = "";

//license plate
$license_plate = "";


//variables for any missing fields in the sign up page
$customer_phoneERR = $customer_addressERR = $customer_emailERR = $car_yearERR = $car_makeERR = $car_modelERR = $car_modelERR = $vin_noERR = $license_plateERR = "";
  
  
  
//returns an error message if a field is missing or there is an incorrect input
if ($_SERVER['REQUEST_METHOD'] == "POST"){
 
  //phone number
  createErrMsg("change_profile", "phone number", "customer_phone", "customer_phoneERR");
  
  //address
  createErrMsg("change_profile", "address", "customer_address", "customer_addressERR");

  //email
  createErrMsg("change_profile", "email", "customer_email", "customer_emailERR");
  $customer_email_exist = customer_exist($_SESSION['customer_email'], $_SESSION['prev_customer_email']);
  
  //if the email already exists other than the previous email, than throw an error
  if ($customer_email_exist){
    $customer_emailERR = "an account with this email already exists";
  }
  
  //car year
  createErrMsg("change_profile", "car year", "car_year", "car_yearERR");
  year_limit($_SESSION['car_year'], 1900, date("Y"), "car year", "car_yearERR");

  //car make
  createErrMsg("change_profile", "car make", "car_make", "car_makeERR");
  
  //car model
  createErrMsg("change_profile", "car model", "car_model", "car_modelERR");
  
  //vin number
  createErrMsg("change_profile", "VIN number", "vin_no", "vin_noERR");
  limit_length($_SESSION['vin_no'], 17, 1, "VIN number" ,"vin_noERR");
  
  //license plate
  createErrMsg("change_profile", "license plate", "license_plate", "license_plateERR");
  limit_length($_SESSION['license_plate'], 12, 0, "license plate" ,"license_plateERR");
  
 
 
  //show the error title if any fields are missing after signing up
  if ($customer_phoneERR != "" || $customer_addressERR != "" || $customer_emailERR != "" || $car_yearERR != "" || $car_makeERR != "" || $car_modelERR != "" || $vin_noERR != "" || $license_plateERR != ""){
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

    <div class="background">
      <div class="background_cover">
        <div class="box">

          <span class="Change_Customer_Profile">Change Customer Profile</span>

  
          <form name="profileForm" onsubmit="return confirmForm('profileForm', 'change_profile', 'profile')" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete = "off">

            <div class="form_group">
              <span>Name:</span>
              <span><?php echo $_SESSION['customer_firstname'] . " " . $_SESSION['customer_lastname']?></span> <br>
            </div>

            <div class="form_group">
              <span>Phone:</span>
              <input type="tel" class="form_control" name="customer_phone" placeholder="Phone No." value="<?php echo $_SESSION['customer_phone'];?>" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required> <br>
              <span>format: 123-456-7890</span> <br>
              <span class="profile_error"><?php echo $customer_phoneERR;?></span> <br>
            </div>

            <div class="form_group">
              <span>Address:</span>
              <input type="text" class="form_control"  name="customer_address" placeholder="Address" value="<?php echo $_SESSION['customer_address'];?>"> <br>
              <span class="profile_error"><?php echo $customer_addressERR;?></span> <br>
            </div>


            <div class="form_group">
              <span>Email:</span>
              <input type="email" class="form_control"  name="customer_email" placeholder="Email" value="<?php echo $_SESSION['customer_email'];?>"> <br>
              <span class="profile_error"><?php echo $customer_emailERR;?></span> <br>
            </div>


            <div class="form_group">
              <span>Car Year:</span>
              <input type="text" class="form_control" name="car_year" placeholder="Car Year" value="<?php echo $_SESSION['car_year'];?>"> <br>
              <span class="profile_error"><?php echo $car_yearERR;?></span> <br>
            </div>

            <div class="form_group">
              <span>Car Make:</span>
              <input type="text" class="form_control" name="car_make" placeholder="Car Make" value="<?php echo $_SESSION['car_make'];?>"> <br>
              <span class="profile_error"><?php echo $car_makeERR;?></span> <br>
            </div>


            <div class="form_group">
              <span>Car Model:</span>
              <input type="text" class="form_control" name="car_model" placeholder="Car Model" value="<?php echo $_SESSION['car_model'];?>"> <br>
              <span class="profile_error"><?php echo $car_modelERR;?></span> <br>
            </div>


            <div class="form_group">
              <span>Vin Number:</span>
              <input type="text" class="form_control" name="vin_no" placeholder="Vin No." value="<?php echo $_SESSION['vin_no'];?>"> <br>
              <span class="profile_error"><?php echo $vin_noERR;?></span> <br>
            </div>

            <div class="form_group">
              <span>License Plate:</span>
              <input type="text" class="form_control" name="license_plate" placeholder="License Plate" value="<?php echo $_SESSION['license_plate'];?>"> <br>
              <span class="profile_error"><?php echo $license_plateERR;?></span> <br>
            </div>

  
              <input class="change" type="submit" name="change_profile" value="Change"> 

          </form>

          <div class="back_align">
          
            <?php
              $_SESSION['admin_section'] = "profiles";
            ?>
            
            <a href="../../admin_cpanel.php" class="back">Back</a>
          </div>

        </div>
      </div>
    </div>


<?php
//include the footer
include '../../../footer/footer.php';

} else {

 //change the profile data in the customer accounts table in the database
 include "../../../database/update/update_cprofiles.php";
 
 
 //redirect to the customer profile section of the admin control panel
 $_SESSION['admin_section'] = "profiles";
 
 //notification that the profiles have been editted
 $_SESSION['profile_done'] = "edit";
?>

<script>redirect_page("../../admin_cpanel.php");</script>

<?php
}
?>

</body>
</html>
