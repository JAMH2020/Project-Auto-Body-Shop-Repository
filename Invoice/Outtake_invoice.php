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
  
//intake odometer reading
$intake_odometer_reading =  "";
save_session('intake_odometer_reading');
  
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

<h1>Automotive Intake Repair Form</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete = "off">

<p>School Information</p>
<span>Work Order #:</span>
<input type="text" name="order_no" placeholder="Work Order No." value="<?php echo $_SESSION['order_no'];?>"> <br>
<span><?php echo $order_noERR;?></span> <br>

<span>School Name:</span>
<input type="text" name="school_name" placeholder="School Name" value="<?php echo $_SESSION['school_name'];?>">

<span>School Address:</span>
<input type="text" name="school_address" placeholder="School Address" value="<?php echo $_SESSION['school_address'];?>"> <br>

<span><?php echo $school_nameERR;?></span>
<span><?php echo $school_addressERR;?></span> <br>



<p>Automobile To Be Repaired</p>
<span>Year:</span>
<input type="text" name="car_year" placeholder="Year" value="<?php echo $_SESSION['car_year'];?>"> 

<span>VIN #:</span>
<input type="text" name="vin_no" placeholder="VIN No." value="<?php echo $_SESSION['vin_no'];?>"><br>

<span><?php echo $car_yearERR;?></span>
<span><?php echo $vin_noERR;?></span> <br>

<span>Make:</span>
<input type="text" name="car_make" placeholder="Make" value="<?php echo $_SESSION['car_make'];?>">

<span>License Plate:</span>
<input type="text" name="license_plate" placeholder="License Plate" value="<?php echo $_SESSION['license_plate'];?>"><br>

<span><?php echo $car_makeERR;?></span>
<span><?php echo $license_plateERR;?></span> <br>

<span>Model:</span>
<input type="text" name="car_model" placeholder="Model" value="<?php echo $_SESSION['car_model'];?>">

<span>Odometer:</span>
<input type="text" name="odometer_intake" placeholder="Odometer" value="<?php echo $_SESSION['odometer_intake'];?>"><br>

<span><?php echo $car_modelERR;?></span>
<span><?php echo $odometer_intakeERR;?></span> <br>

<p>Description</p>
<span><?php echo $plan_descriptionERR;?></span> <br>
<textarea name="plan_description" placeholder="Description..." rows="10" columns="50" value="<?php echo $_SESSION['plan_description'];?>"></textarea><br>

<span>Date on which the work shall be completed:</span>
<input type="date" name="plan_date" placeholder="Date" value="<?php echo $_SESSION['plan_date'];?>"> <br>
<span><?php echo $plan_dateERR;?></span> <br>




<p>Estimate Costs</p>
<table>
  <tr>
    <th>Total Estimated Cost</th>
    <th>Price Per Unit</th>
    <th>Line Total</th>
  </tr>

  <tr>
    <td>Parts:</td>
    <td> 
      <input type="text" name="estimate_parts_per_unit" placeholder="$-Parts/Unit" value="<?php echo $_SESSION['estimate_parts_per_unit'];?>"> <br> 
      <span><?php echo $estimate_parts_per_unitERR;?></span>
    </td>

    <td> 
      <input type="text" name="estimate_parts_total" placeholder="$-Parts Total" value="<?php echo $_SESSION['estimate_parts_total'];?>"> <br>
      <span><?php echo $estimate_parts_totalERR;?></span>
    </td>
  </tr>

  <tr>
    <td>Labour:</td>
    <td> 
      <input type="text" name="estimate_labour_per_unit" placeholder="$-Labour/Unit" value="<?php echo $_SESSION['estimate_labour_per_unit'];?>"> <br>
      <span><?php echo $estimate_labour_per_unitERR;?></span>
    </td>

    <td> 
      <input type="text" name="estimate_labour_total" placeholder="$-Labour Total" value="<?php echo $_SESSION['estimate_labour_total'];?>"> <br>
      <span><?php echo $estimate_labour_totalERR;?></span>
    </td>
  </tr>

  <tr>
    <td>Shop Supplies:</td>
    <td> 
      <input type="text" name="estimate_supplies_per_unit" placeholder="$-Supplies/Unit" value="<?php echo $_SESSION['estimate_supplies_per_unit'];?>"> <br>
      <span><?php echo $estimate_supplies_per_unitERR;?></span>
    </td>

    <td>
      <input type="text" name="estimate_supplies_total" placeholder="$-Supplies Total" value="<?php echo $_SESSION['estimate_supplies_total'];?>"> <br>
      <span><?php echo $estimate_supplies_totalERR;?></span>
    </td>
  </tr>

  <tr>
    <td>Recycling/Disposal Fee:</td>
    <td> 
      <input type="text" name="estimate_disposal_per_unit" placeholder="$-Recycling and Disposal/Unit" value="<?php echo $_SESSION['estimate_disposal_per_unit'];?>"> <br>
      <span><?php echo $estimate_disposal_per_unitERR;?></span>
    </td>

    <td> 
      <input type="text" name="estimate_disposal_total" placeholder="$-Recycling and Disposal Total" value="<?php echo $_SESSION['estimate_disposal_total'];?>"> <br>
      <span><?php echo $estimate_disposal_totalERR;?></span>
    </td>
  </tr>

  <tr>
    <td>Total Estimated Cost:</td>
    <td>  </td>
    <td> 
      <input type="text" name="estimate_total_cost" placeholder="$-Estimate Total" value="<?php echo $_SESSION['estimate_total_cost'];?>"> <br>
      <span><?php echo $estimate_total_costERR;?></span>
    </td>
  </tr>
</table> <br>


<span>Date of Estimate:</span>
<input type="date" name="estimate_date" placeholder="Date of Estimate" value="<?php echo $_SESSION['estimate_date'];?>"> <br>
<span><?php echo $estimate_dateERR;?></span><br>

<span>This estimate expires on:</span>
<input type="date" name="estimate_expiry_date" placeholder="Expiry Date" value="<?php echo $_SESSION['estimate_expiry_date'];?>"> <br>
<span><?php echo $estimate_expiry_dateERR;?></span> <br>

<span>Any parts removed in the course of work on repairs to the automobile shall be (select one)</span>
<select name="removal_choice" value="<?php echo $_SESSION['removal_choice'];?>">
  <option value="A">(A) return to the undersigned</option>
  <option value="B">(B) disposed of by the School</option>
</select>
<span><?php echo $removal_choiceERR;?></span>

<input type="text" name="removal_fillin" value="<?php echo $_SESSION['removal_fillin'];?>"><br>
<span><?php echo $removal_fillinERR;?></span> <br>

<input type="submit" name="submit_intake" value="Submit">

</form>

<a href="worker_cpanel.php">Back</a>

<?php
} else {
?>

<?php
}
?>

</body>
</html>
