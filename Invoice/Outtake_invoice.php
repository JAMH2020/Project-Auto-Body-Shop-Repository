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
$order_noERR = $school_nameERR = $school_addressERR = $car_yearERR = $car_makeERR = $car_modelERR = $vin_noERR = $license_plateERR
= $odometer_intakeERR = $plan_descriptionERR = $plan_dateERR = $estimate_parts_per_unitERR = $estimate_parts_totalERR =
$estimate_labour_per_unitERR = $estimate_labour_totalERR = $estimate_supplies_per_unitERR = $estimate_supplies_totalERR = 
$estimate_disposal_per_unitERR = $estimate_disposal_totalERR = $estimate_total_costERR = $estimate_dateERR = $estimate_expiry_dateERR
= $removal_choiceERR = $removal_fillinERR = "";

  //include file that will fix the user inputs that are entered
include_once "../database/fixinput.php";

  //returns an error message if a field is missing
if ($_SERVER['REQUEST_METHOD'] == "POST"){
  
  //order number
  createErrMsg("submit_intake", "order number", "order_no", "order_noERR");
 
  //school name
  createErrMsg("submit_intake", "school name", "school_name", "school_nameERR");
 
  //school address
  createErrMsg("submit_intake", "school address", "school_address", "school_addressERR");
 
  //car year
  createErrMsg("submit_intake", "car year", "car_year", "car_yearERR");
  
  //car make
  createErrMsg("submit_intake", "car make", "car_make", "car_makeERR");
  
  //car model
  createErrMsg("submit_intake", "car model", "car_model", "car_modelERR");
 
  //VIN number
  createErrMsg("submit_intake", "VIN number", "vin_no", "vin_noERR");
 
  //license plate number
  createErrMsg("submit_intake", "license plate", "license_plate", "license_plateERR");
 
  //odometer reading at intake
  createErrMsg("submit_intake", "odometer reading", "odometer_intake", "odometer_intakeERR");
  
  //description of work that is going to be done
  createErrMsg("submit_intake", "description", "plan_description", "plan_descriptionERR");
 
  //date that work is going to be done
  createErrMsg("submit_intake", "date", "plan_date", "plan_dateERR");
 
  //estimate of the cost of parts per unit
  createErrMsg("submit_intake", "estimate", "estimate_parts_per_unit", "estimate_parts_per_unitERR");
 
  //estimate of the total cost of parts
  createErrMsg("submit_intake", "total estimate", "estimate_parts_total", "estiamte_parts_totalERR");
 
  //estimate of the labour cost per unit
  createErrMsg("submit_intake", "estimate", "estimate_labour_per_unit", "estimate_labour_per_unitERR");
  
  //estimate of the total labour cost
  createErrMsg("submit_intake", "total estimate", "estimate_labour_total", "estimate_labour_totalERR");
  
  //estimate of the cost of shop supplies used per unit
  createErrMsg("submit_intake", "estimate", "estimate_supplies_per_unit", "estimate_supplies_per_unitERR");
  
  //estimate of the total cost of supplies
  createErrMsg("submit_intake", "total estimate", "estimate_supplies_total", "estimate_supplies_totalERR");
  
  //estimate of the recycling/disposal fee per unit
  createErrMsg("submit_intake", "estimate", "estimate_disposal_per_unit", "estimate_disposal_per_unitERR");
  
  //estimate of the total recycling/disposal fee
  createErrMsg("submit_intake", "total estimate", "estimate_disposal_total", "estimate_disposal_totalERR");
 
  //estimate of the total cost
  createErrMsg("submit_intake", "total estimate", "estimate_total_cost", "estimate_total_costERR");
 
  //date the estimate of costings were made
  createErrMsg("submit_intake", "date", "estimate_date", "estimate_dateERR");
  
  //date the date of the estimate of the costings will expire
  createErrMsg("submit_intake", "date", "estimate_expiry_date", "estimate_expiry_dateERR");
 
  //choice of removal
  createErrMsg("submit_intake", "removal choice", "removal_choice", "removal_choiceERR");
 
  //fill in for the removal choice
  createErrMsg("submit_intake", "blank", "removal_fillin", "removal_fillinERR");
}

  //check if there are any missing or incorrect fields
$error_intake_input;
if ($order_noERR != "" or $school_nameERR != "" or $school_addressERR != "" or $car_yearERR != "" or $car_makeERR != "" or $car_modelERR != "" or $vin_noERR != "" or $license_plateERR != "" or $odometer_intakeERR != "" or $plan_descriptionERR != "" or $plan_dateERR != "" or $estimate_parts_per_unitERR != "" or $estimate_parts_totalERR != "" or $estimate_labour_per_unitERR != "" or $estimate_labour_totalERR != "" or $estimate_supplies_per_unitERR  != "" or $estimate_supplies_totalERR != "" or $estimate_disposal_per_unitERR != "" or $estimate_disposal_totalERR != "" or $estimate_total_costERR != "" or $estimate_dateERR != "" or $estimate_expiry_dateERR != "" or $removal_choiceERR != "" or $removal_fillinERR != ""){
  $error_intake_input = true;
} else {
  $error_intake_input = false;
}

  //ask the user to input the required fields if the user has not pressed the submit button yet
if ($error_intake_input  or !isset($_POST['submit_intake'])){
  //include the navigation bar
  include "../navigation_bar/navigation_bar.php";
?>

//Form that the worker will fill out

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
