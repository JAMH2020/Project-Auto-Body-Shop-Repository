<!--script to create bullet points of error messages if there is a missing field
 or an error with the user's input-->
  <script src="js/errorlist.js"></script>

<?php

//ALL CUSTOMER RELATED INFORMATION
//customer work order number
$work_order_number = $_SESSION['work_order_number'] = "";

//customer full name
$customer_full_name = $_SESSION['customer_full_name'] = "";

//customer phone number
$customer_phone_number = $_SESSION['customer_phone_number'] = "";

//customer address 
$customer_address = $_SESSION['customer_address'] = "";

//customer email
$customer_email = $_SESSION['customer_email'] = "";

//customer invoice number
$invoice_number = $_SESSION['invoice_number'] = "";

//ALL CAR RELATED INFORMATION
//car model year
$car_model_year = $_SESSION['car_model_year'] = "";

//car year make
$car_make = $_SESSION['car_make'] = "";

//car model
$car_model = $_SESSION['car_model'] = "";

//car VIN number
$VIN = $_SESSION['VIN'] = "";

//car license plate
$car_license_plate = $_SESSION['car_license_plate'] = "";

//intake odometer reading
$intake_odometer_reading = $_SESSION['intake_odometer_reading'] = "";

//odometer reading on return
$return_odometer_reading = $_SESSION['return_odometer_reading'] = "";

//AUTHORIZATION STUFF
//date of return vehicle
$return_date = $_SESSION['return_date'] = "";

//parts removed returned or not
$removed_part_returned = $_SESSION['removed_part_returned'] = "";

//COSTS
//costs of parts
$parts_costs = $_SESSION['parts_costs'] = "";

//cost of labour
$labour_costs = $_SESSION['labour_costs'] = "";

//shop supplies cost
$supplies_cost = $_SESSION['supplies_costs'] = "";

//recycling and/or disposal fees
$redi_fees = $_SESSION['redi_fees'] = "";

//estimated costs of everything dones
$estimated_costs = $_SESSION['estimated_costs'] = "";

//Total cost of EVERYTHING
$total_cost = $_SESSION ['total_cost'] = "";

//FINAL
//Teachers name
$teachers_name = $_SESSION['teachers_name'] = "";

//siganture of owner
$owner_signature = $_SESSION['owner_signature'] = "";

//title of error section if a missing field occurs
$error_title = "";

//include file that will fix the user inputs that are entered
include "../database/fixinput.php";

 //show the error title if any fields are missing after signing up
  if (empty($_POST['work_order_number']) or empty($_POST['customer_full_name']) or empty($_POST['customer_phone_number']) or empty($_POST['customer_address'] or empty($_POST['customer_email'] or empty($_POST['invoice_number'] or empty($_POST['car_model_year'] or empty($_POST['car_make'] or empty($_POST['car_model'] or empty($_POST['VIN'] or empty($_POST['car_license_plate'] or empty($_POST['intake_odometer_reading'] or empty($_POST['return_odometer_reading'] or empty($_POST['return_date'] or empty($_POST['removed_part_returned'] or empty($_POST['parts_costs'] or empty($_POST['labour_costs'] or empty($_POST['supplies_costs'] or empty($_POST['redi_fees'] or empty($_POST['estimated_costs'] or empty($_POST['total_cost'] or empty($_POST['teachers_name'] or empty($_POST['owner_signature'])){
    $error_title = "Error";
  }

<?php
  }
?>

</ul>

<h1>Sign Up</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete = "off">

<span>First Name:</span>
<input type="text" name="customer_firstname" placeholder="First Name" value="<?php echo $_SESSION['customer_firstname'];?>">

<span>Last Name:</span>
<input type="text" name="customer_lastname" placeholder="Last Name" value="<?php echo $_SESSION['customer_lastname'];?>"> <br>

<span>Password:</span>
<input type="password" name="customer_password" placeholder="Password" id="password" value="<?php echo $_SESSION['customer_password'];?>"> <br>


<input type="checkbox" onclick="showPassword()">
<span>Show Password</span> <br>


<span>Email:</span>
<input type="text" name="customer_email" placeholder="Email" value="<?php echo $_SESSION['customer_email'];?>"> <br>

<input type="submit" name="sign_up" value="Sign Up"> <br>

</form>

<?php
} else {
  echo "done";
  //insert the user sign up data into the accounts table in the database
  include "insert_invoice.php";
}
?>












?>
