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
  <script src="../src/js/submit_form.js"></script>
</head>
<body>

<?php


//include file for initiating sessions if they have not beeen created yet
include_once "../database/initiate_session.php";


//order number
$order_no = "";
save_session("order_no");


//school name and address
$school_name = $school_address = "";
save_session("school_name");
save_session("school_address");

//client's car repair information
//year of car
$car_year = "";
save_session("car_year");

//brand of the vehicle and the model
$car_make = $car_model = "";
save_session("car_make");
save_session("car_model");

//client's VIN number and license plate number
$vin_no = $license_plate = "";
save_session("vin_no");
save_session("license_plate");

//odometer reading at intake
$odometer_intake = "";
save_session("odometer_intake");

//description of the work that is going to be done and date work is going to be performed
$plan_description = $plan_date = "";
save_session("plan_description");
save_session("plan_date");




//Estimate costings of repair
//price of parts per unit and its total
$estimate_parts_per_unit = $estimate_parts_total = "";
save_session("estimate_parts_per_unit");
save_session("estimate_parts_total");

//price of labour per unit and its total
$estimate_labour_per_unit = $estimate_labour_total =  "";
save_session("estimate_labour_per_unit");
save_session("estimate_labour_total");

//price of shop supplies per unit and its total
$estimate_supplies_per_unit = $estimate_supplies_total = "";
save_session("estimate_supplies_per_unit");
save_session("estimate_supplies_total");

//price of recycling/disposal fee per unit and its total
$estimate_disposal_per_unit = $estimate_disposal_total = "";
save_session("estimate_disposal_per_unit");
save_session("estimate_disposal_total");

//total cost
$estimtate_total_cost = "";
save_session("estimate_total_cost");

//date the estimate costings were declared and its expiry date
$estimate_date = $estimate_expiry_date =  "";
save_session("estimate_date");
save_session("estimate_expiry_date");

//removal choice of parts during the work process (A: returned to undersigned ______ or B: disposed of bye the school ______)
$removal_choice = $removal_fillin = "";
save_session("removal_choice");
save_session("removal_fillin");




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

<script>redirect_page("waiver.php");</script>

<?php
}
?>

</body>
</html>
