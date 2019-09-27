<?php
//start the session to remember the session variables
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  
  <!--script that will redirect the user to another page-->
  <script src="../src/js/submit_form.js"></script>
  </head>
<body>
  </body>
</html>

<?php
//include file for initiating sessions if they have not beeen created yet
include_once "../database/initiate_session.php";

//work order number
$work_order_number = "";
save_session('work_order_number');

//customer full name
$customer_full_name = "";
save_session('customer_full_name');

//customer phone number
$customer_phone_number = "";
save_session('customer_phone_number');

//customer address
$customer_address = "";
save_session('customer_address');

//customer email
$customer_email = "";
save_session('customer_email');

//customer invoice number
$customer_invoice_number = "";
save_session('customer_invoice_number');

//car model year
$car_model_year = "";
save_session('car_model_year');

//car year make
$car_year_make = "";
save_session('car_year_make');

//car model
$car_model =  "";
save_session('car_model');

//car VIN number
$VIN = "";
save_session('VIN');

//car license plate
$car_license_plate = "";
save_session('car_license_plate');

//intake odometer reading
$intake_odometer_reading =  "";
save_session('intake_odometer_reading');

//outtake odometer reading
$return_odometer_reading =  "";
save_session('return_odometer_reading');
  
//vehicle return date
$return_date =  "";
save_session('return_date');
  
//parts removed or not
$removed_part_returned =  "";
save_session('removed_part_returned');
  
//cost of parts
$parts_costs =  "";
save_session('parts_costs');
  
//cost of labour
$labour_costs =  "";
save_session('labour_costs');
  
//shops supplies cost
$supplies_cost =  "";
save_session('supplies_costs');
  
//recycling and or disposal fees
$redi_fees =  "";
save_session('redi_fees');
  
//estimated total costs
$estimated_costs =  "";
save_session('estimated_costs');
  
//Total cost of EVERYTHING
$total_cost =  "";
save_session('total_cost');
  
//Teachers name
$teachers_name =  "";
save_session('teachers_name');


  //errors for any missing fields in the repair intake form
$work_order_numberERR = $customer_full_nameERR = $customer_phone_numberERR = $customer_addressERR = $customer_emailERR = 
$invoice_numberERR  = $car_model_yearERR = $car_makeERR = $car_modelERR = $VINERR = $car_license_plateERR = 
$intake_odometer_readingERR = $return_odometer_readingERR = $return_dateERR = $removed_part_returnedERR = $parts_costsERR = $labour_costsERR
= $supplies_costERR = $redi_feesERR = $estimated_costsERR = $total_costERR = $teachers_nameERR = "";

  //include file that will fix the user inputs that are entered
include_once "../database/fixinput.php";

  //returns an error message if a field is missing
if ($_SERVER['REQUEST_METHOD'] == "POST"){
  
  //customer work order number
  createErrMsg("submit_intake", "order number", "work_order_number", "work_order_numberERR");
 
  //customer full name
  createErrMsg("submit_intake", "customer name", "customer_full_name", "customer_full_nameERR");
 
  //customer phone number
  createErrMsg("submit_intake", "customer phone ", "customer_phone_number", "customer_phone_numberERR");
 
  //customer address
  createErrMsg("submit_intake", "customer address", "customer_address", "customer_addressERR");
  
  //customer invoice number
  createErrMsg("submit_intake", "invoice number", "invoice_number", "invoice_numberERR");
  
  //car model year
  createErrMsg("submit_intake", "car model year", "car_model_year", "car_model_yearERR");
 
  //car year make
  createErrMsg("submit_intake", "car year make ", "car_make", "car_makeERR");
 
  //car model
  createErrMsg("submit_intake", "car model", "car_model", "car_modelERR");
 
  //car VIN number
  createErrMsg("submit_intake", "odometer reading", "VIN", "VINERR");
  
   //car license plate
  createErrMsg("submit_intake", "license plate", "car_license_plate", "car_license_plateERR");
  
  //intake odometer reading
  createErrMsg("submit_intake", "intake odometer", "intake_odometer_reading", "intake_odometer_readingERR");
  
  //odometer reading when returned
  createErrMsg("submit_intake", "return reading", "return_odometer_reading ", "return_odometer_reading ERR");
  
  //date when vehicle was returned
  createErrMsg("submit_intake", "date of return", "$return_date", "$return_dateERR");
  
  //returned parts returned or not
  createErrMsg("submit_intake", "removed parts returned or not", "$removed_part_returned", "$removed_part_returnedERR");
  
  //cost of parts
  createErrMsg("submit_intake", "cost of parts", "parts_costs", "parts_costsERR");
  
  //cost of labour
  createErrMsg("submit_intake", "cost of labout", "labour_costs", "labour_costsERR");
  
  //cost of supplies
  createErrMsg("submit_intake", "supplies cost", "supplies_cost", "supplies_costERR");
  
  //items recycled or disposed of fees
  createErrMsg("submit_intake", "fees of disposal or recycling", "redi_fees", "redi_feesERR");
  
  //total estimated cost
  createErrMsg("submit_intake", "estimated costs", "estimated_costs", "estimated_costsERR");
  
  //total cost of repair
  createErrMsg("submit_intake", "repair cost", "total_cost", "total_costERR");
  
  //name of supervising teachers
  createErrMsg("submit_intake", "teachers name", "teachers_name", "teachers_nameERR");
  
}

  //check if there are any missing or incorrect fields
$error_intake_input;
if ($work_order_numberERR != "" or $customer_full_nameERR != "" or $customer_phone_numberERR != "" or $customer_addressERR != "" or $customer_emailERR != "" or $invoice_numberERR != "" or $car_model_yearERR != "" or $car_makeERR != "" or $car_modelERR != "" or $VINERR != "" or $car_license_plateERR != "" or $intake_odometer_readingERR != "" or $return_odometer_readingERR != "" or $return_dateERR != "" or $removed_part_returnedERR != "" or $parts_costsERR  != "" or $labour_costsERR != "" or $supplies_costERR != "" or $redi_feesERR != "" or $estimated_costsERR != "" or  $total_costERR != ""){
  $error_intake_input = true;
} else {
  $error_intake_input = false;
}

  //ask the user to input the required fields if the user has not pressed the submit button yet
if ($error_intake_input  or !isset($_POST['submit_intake'])){
  //include the navigation bar
  include "../navigation_bar/navigation_bar.php";
?>

<!-- Form that repairer/worker will fill in when the client brings in their vehicle -->
<html>
<h1>Automotive Final invoice</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete = "off">

<p>Customer information</p>
<span>Work Order #:</span>
<input type="text" name="work_order_number" placeholder="Work Order No." value="<?php echo $_SESSION['order_no'];?>"> <br>
<span><?php echo $work_order_numberERR;?></span> <br>

<span>Name of customer:</span>
<input type="text" name="customer_full_name" placeholder="Customer Name" value="<?php echo $_SESSION['customer_full_name'];?>">

<span>Customer Phone Number:</span>
<input type="text" name="customer_phone_number" placeholder="Phone number" value="<?php echo $_SESSION['customer_phone_number'];?>"> <br>

<span>Customer Address:</span>
<input type="text" name="customer_address" placeholder="Customer Address" value="<?php echo $_SESSION['customer_address'];?>"> 

<span>Email of customer :</span>
<input type="text" name="customer_email" placeholder="Email of customer." value="<?php echo $_SESSION['customer_email'];?>"><br>

<span>Number of invoice:</span>
<input type="text" name="customer_invoice_number" placeholder="Invoice number" value="<?php echo $_SESSION['customer_invoice_number'];?>">

<p>Automobile repaired</p>
<span>Car year:</span>
<input type="text" name="car_model_year" placeholder="car year model" value="<?php echo $_SESSION['car_model_year'];?>"><br>

<span>Car make:</span>
<input type="text" name="car_year_make" placeholder="Model" value="<?php echo $_SESSION['car_year_make'];?>">
  
<span>Car model:</span>
<input type="text" name="car_model" placeholder="Model" value="<?php echo $_SESSION['car_model'];?>">

<span>VIN number:</span>
<input type="text" name="VIN" placeholder="VIN" value="<?php echo $_SESSION['VIN'];?>"><br>
  
<span>Car license plate number:</span>
<input type="text" name="car_license_plate" placeholder="License plate" value="<?php echo $_SESSION['car_license_plate'];?>"><br>

<span>Odometer reading on intake:</span>
<input type="text" name="intake_odometer_reading" placeholder="" value="<?php echo $_SESSION['intake_odometer_reading'];?>"><br>
  
<span>Odometer reading on return:</span>
<input type="text" name="return_odometer_reading" placeholder="" value="<?php echo $_SESSION['return_odometer_reading'];?>"><br>

<span>Date vehicle was returned:</span>
<input type="date" name="return_date" placeholder="Date of return" value="<?php echo $_SESSION['return_date'];?>"> <br>
<span><?php echo $return_dateERR;?></span> <br>

<span>Were removed parts returned or not:</span>
<input type="text" name=" removed_part_returned" placeholder="Returned or not" value="<?php echo $_SESSION[' removed_part_returned'];?>"><br>

<p>Fees</p>  
<span>Cost of parts:</span>
<input type="text" name="parts_costs" placeholder="cost of parts" value="<?php echo $_SESSION['parts_costs'];?>"><br>

<span>Cost of labour:</span>
<input type="text" name="labour_costs" placeholder="labour costs" value="<?php echo $_SESSION['labour_costs'];?>">
  
<span>Cost of supplies needed for auto repair:</span>
<input type="text" name="supplies_costs" placeholder="cost of supplies" value="<?php echo $_SESSION['supplies_costs'];?>">

<span>Cost of redisposal and/or recycling items:</span>
<input type="text" name="redi_fees" placeholder="" value="<?php echo $_SESSION['redi_fees'];?>"><br>
  
<span>Estimated total costs:</span>
<input type="text" name="estimated_costs" placeholder="estimated costs" value="<?php echo $_SESSION['estimated_costs'];?>"><br>

<span>Calculated total cost of EVERYTHING:</span>
<input type="text" name="total_cost" placeholder="total costs" value="<?php echo $_SESSION['total_cost'];?>"><br>
  
<span>Name of supervising teacher:</span>
<input type="text" name="teachers_name" placeholder="" value="<?php echo $_SESSION['teachers_name'];?>"><br>  

</form>
</html>

<?php
} else {
  echo "done";
  //insert the user sign up data into the accounts table in the database
  include "insert_invoice.php";
}
?>

?>

<?php
}
?>

</body>
</html>
