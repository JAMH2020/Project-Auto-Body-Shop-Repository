<?php
//start the session to remember the session variables
session_start();
?>

<!-- Form that repairer/worker will fill in when the client brings in their vehicle -->
<!DOCTYPE html>
<html>
<head>
  <!--style sheet for the intake repair form-->
  <link rel="stylesheet" type="text/css" href="css/intake_repair_form_styles.css">


  <!--script that will redirect the user to another page-->
  <script src="../../src/js/submit_form.js"></script>

</head>
<body>

<?php
//include file for initiating sessions if they have not beeen created yet
include_once "../../database/initiate_session.php";



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
$removal_choice = "";
save_session("removal_choice");


//if user is editting form, have session to change the status of the order
if ($_SESSION['editForm']){

 //status of the order
 $order_status = "";
  save_session("status");
  
  $statusERR = "";
}


//if the user is the admin
if ($_SESSION['admin_loggedin']){

  //worker email
  $worker_email = "";
  save_session("worker_email");
  
  $worker_emailERR = "";
}







//errors for any missing fields in the repair intake form
$order_noERR = $school_nameERR = $school_addressERR = $car_yearERR = $car_makeERR = $car_modelERR = $vin_noERR = $license_plateERR
= $odometer_intakeERR = $plan_descriptionERR = $plan_dateERR = $estimate_parts_per_unitERR = $estimate_parts_totalERR =
$estimate_labour_per_unitERR = $estimate_labour_totalERR = $estimate_supplies_per_unitERR = $estimate_supplies_totalERR =
$estimate_disposal_per_unitERR = $estimate_disposal_totalERR = $estimate_total_costERR = $estimate_dateERR = $estimate_expiry_dateERR
= $removal_choiceERR = "";



//include file that will fix the user inputs that are entered
include_once "../../database/fixinput.php";



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
  createErrMsg("submit_intake", "total estimate", "estimate_parts_total", "estimate_parts_totalERR");

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
  
  //if user is editting the orders
  if ($_SESSION['editForm']){
    //status of the work
    createErrMsg("submit_intake", "order status", "status", "statusERR");
  }
  
  
  //if the user is the admin
  if ($_SESSION['admin_loggedin']){
    //worker account
    createErrMsg("submit_intake", "worker email", "worker_email", "worker_emailERR");
  }
}

//check if there are any missing or incorrect fields
$error_intake_input;

if ($order_noERR != "" or $school_nameERR != "" or $school_addressERR != "" or $car_yearERR != "" or $car_makeERR != "" or $car_modelERR != "" or $vin_noERR != "" or $license_plateERR != "" or $odometer_intakeERR != "" or $plan_descriptionERR != "" or $plan_dateERR != "" or $estimate_parts_per_unitERR != "" or $estimate_parts_totalERR != "" or $estimate_labour_per_unitERR != "" or $estimate_labour_totalERR != "" or $estimate_supplies_per_unitERR  != "" or $estimate_supplies_totalERR != "" or $estimate_disposal_per_unitERR != "" or $estimate_disposal_totalERR != "" or $estimate_total_costERR != "" or $estimate_dateERR != "" or $estimate_expiry_dateERR != "" or $removal_choiceERR != ""){
 
 $error_intake_input = true;
 
} else {
  $error_intake_input = false;
}



//for editting orders
if ($_SESSION['editForm']){
  if ($statusERR){
    $error_intake_input = true;   
  }
}


//for the admin as user
if ($_SESSION['admin_loggedin']){
  if ($worker_emailERR){
    $error_intake_input = true;
  } 
}



//reformat all the dates into the correct format
//authorization of work date
if (!empty($_SESSION['plan_date'])){
  $plan_date_format = reformat_date($_SESSION['plan_date']);
}

//estimate date of costings
if (!empty($_SESSION['estimate_date'])){
  $estimate_date_format = reformat_date($_SESSION['estimate_date']);
}

//expiry of estimate date of costings
if (!empty($_SESSION['estimate_expiry_date'])){
  $estimate_expiry_date_format = reformat_date($_SESSION['estimate_expiry_date']);
}




//ask the user to input the required fields if the user has not pressed the submit button yet
if ($error_intake_input  or !isset($_POST['submit_intake'])){

  //include the navigation bar
  include "../../navigation_bar/navigation_bar.php";
?>




<div class ="intake_title">
  <h1 class="title-heading">AUTOMOTIVE INTAKE REPAIR FORM</h1>
</div>



<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete = "off">

<div class="image"></div>



<div class="information">

<?php
//when editting the form
if ($_SESSION['editForm']){
?>
  <span>Status:</span>
  <input type="text" name="status" placeholder="Status" value="<?php echo $_SESSION['status'];?>">
  <span><?php echo $statusERR;?></span> <br> <br>
  
<?php
}
?>
  
  
  <div class="subtitle">
    <p class="subtitle-heading">School Information</p>
  </div>
  

  <span class="information-heading"> Work Order #:</span>

  <input type="number" name="order_no" placeholder="Work Order No." value="<?php echo $_SESSION['order_no'];?>">
  
<?php
//if the user is the admin
if ($_SESSION['admin_loggedin']){
?>
  <span>Teacher Email:</span>
  <input type="text" name="worker_email" placeholder="Email" value="<?php echo $_SESSION['worker_email'];?>">
  
<?php
}
?>

  <br>
  <span><?php echo $order_noERR;?></span>
  
<?php
//if the user is the admin
if ($_SESSION['admin_loggedin']){
?>
  <span><?php echo $worker_emailERR;?></span> 
<?php
}
?>
  
  <br>


 <span>School Name:</span>
  <input type="text" name="school_name" placeholder="School Name" value="<?php echo $_SESSION['school_name'];?>">


  <span>School Address:</span>
  <input type="text" name="school_address" placeholder="School Address" value="<?php echo $_SESSION['school_address'];?>"> <br>
  <span><?php echo $school_nameERR;?></span>
  <span><?php echo $school_addressERR;?></span> <br>

</div>





<div class="subtitle">
  <p class="subtitle-heading">Automobile To Be Repaired</p>
</div>



<div class="information">

  <span class="information-heading">Year:</span>
  <input type="number" max= "4" min = "4" name="car_year" placeholder="Year" value="<?php echo $_SESSION['car_year'];?>">



  <span>VIN #:</span>
  <input type="text" name="vin_no" placeholder="VIN No." min = "17" max = "17" value="<?php echo $_SESSION['vin_no'];?>"><br>
  <span><?php echo $car_yearERR;?></span>
  <span><?php echo $vin_noERR;?></span> <br>


  <span>Make:</span>
  <input type="text" name="car_make" placeholder="Make" value="<?php echo $_SESSION['car_make'];?>">



  <span>License Plate:</span>
  <input type="text" name="license_plate" max = "8" min = "2" placeholder="License Plate" value="<?php echo $_SESSION['license_plate'];?>"> <br>
  <span><?php echo $car_makeERR;?></span>
  <span><?php echo $license_plateERR;?></span> <br>


  <span>Model:</span>
  <input type="text" name="car_model" placeholder="Model" value="<?php echo $_SESSION['car_model'];?>">


  <span>Odometer:</span>
  <input type="number" name="odometer_intake" placeholder="Odometer" value="<?php echo $_SESSION['odometer_intake'];?>"><br>
  <span><?php echo $car_modelERR;?></span>
  <span><?php echo $odometer_intakeERR;?></span> <br>


  <p>Detailed description of work to be performed including anticipated parts (including whether each part is a new part provided by the original equipment manufacturer, a new part not provided by the original equipment manufacturer, a used part or a reconditioned part) shop materials, environmental related, fees, disposal/recycling fees, etc.:
  </p>

  <span><?php echo $plan_descriptionERR;?></span> <br>

  <div class="description">
    <textarea name="plan_description" placeholder="Description..." rows="10" columns="50"> <?php echo $_SESSION['plan_description'];?> </textarea><br>
  </div>


  <span>Date on which the work shall be completed:</span>
  <input type="date" name="plan_date" placeholder="Date" value="<?php echo $plan_date_format;?>"> <br>
  <span><?php echo $plan_dateERR;?></span> <br>

</div>



<div class="subtitle">
  <p class="subtitle-heading">Estimate Costs</p> 
</div>


<table class="table">

  <tr>
    <th>Total Estimated Cost</th>
    <th>Price Per Unit</th>
    <th>Line Total</th>
  </tr>


  <tr>
    <td>Parts:</td>

    <td>
      <input type="number" name="estimate_parts_per_unit" placeholder="$-Parts/Unit" value="<?php echo $_SESSION['estimate_parts_per_unit'];?>"> <br>
      <span><?php echo $estimate_parts_per_unitERR;?></span>
    </td>

    <td>
      <input type="number" name="estimate_parts_total" placeholder="$-Parts Total" value="<?php echo $_SESSION['estimate_parts_total'];?>"> <br>
      <span><?php echo $estimate_parts_totalERR;?></span>
    </td>
  </tr>


  <tr>
    <td>Labour:</td>

    <td>
      <input type="number" name="estimate_labour_per_unit" placeholder="$-Labour/Unit" value="<?php echo $_SESSION['estimate_labour_per_unit'];?>"> <br>
      <span><?php echo $estimate_labour_per_unitERR;?></span>
    </td>

    <td>
      <input type="number" name="estimate_labour_total" placeholder="$-Labour Total" value="<?php echo $_SESSION['estimate_labour_total'];?>"> <br>
      <span><?php echo $estimate_labour_totalERR;?></span>
    </td>
  </tr>


  <tr>
    <td>Shop Supplies:</td>

    <td>
      <input type="number" name="estimate_supplies_per_unit" placeholder="$-Supplies/Unit" value="<?php echo $_SESSION['estimate_supplies_per_unit'];?>"> <br>
      <span><?php echo $estimate_supplies_per_unitERR;?></span>
    </td>

    <td>
      <input type="number" name="estimate_supplies_total" placeholder="$-Supplies Total" value="<?php echo $_SESSION['estimate_supplies_total'];?>"> <br>
      <span><?php echo $estimate_supplies_totalERR;?></span>
    </td>
  </tr>

  <tr>
    <td>Recycling/Disposal Fee:</td>

    <td>
      <input type="number" name="estimate_disposal_per_unit" placeholder="$-Recycling and Disposal/Unit" value="<?php echo $_SESSION['estimate_disposal_per_unit'];?>"> <br>
      <span><?php echo $estimate_disposal_per_unitERR;?></span>
    </td>

    <td>
      <input type="number" name="estimate_disposal_total" placeholder="$-Recycling and Disposal Total" value="<?php echo $_SESSION['estimate_disposal_total'];?>"> <br>
      <span><?php echo $estimate_disposal_totalERR;?></span>
    </td>
  </tr>

  <tr>
    <td>Total Estimated Cost:</td>
    <td></td>
    <td>
      <input type="number" name="estimate_total_cost" placeholder="$-Estimate Total" value="<?php echo $_SESSION['estimate_total_cost'];?>"> <br>
      <span><?php echo $estimate_total_costERR;?></span>
    </td>
    
  </tr>
</table> <br>



<p>The Board agrees that it will not charge the undersigned an amount that exceeds the Total Estimated Cost by more than 10 per cent. </p>


<div class="information">

  <span class="information-heading">Date of Estimate:</span>
  <input type="date" name="estimate_date" placeholder="Date of Estimate" value="<?php echo $estimate_date_format?>"> <br>
  <span><?php echo $estimate_dateERR;?></span><br>


  <span>This estimate expires on:</span>
  <input type="date" name="estimate_expiry_date" placeholder="Expiry Date" value="<?php echo $estimate_expiry_date_format;?>"> <br>
  <span><?php echo $estimate_expiry_dateERR;?></span> <br>

  <span>Any parts removed in the course of work on repairs to the automobile shall be (select one)</span>

  <select name="removal_choice" value="<?php echo $_SESSION['removal_choice'];?>">
    <option value="A">(A) return to the undersigned</option>
    <option value="B">(B) disposed of by the School</option>
  </select>

  <span><?php echo $removal_choiceERR;?></span>

</div>

<input  class="button"type="submit" name="submit_intake" value="Submit"><br>
<?php
//bring the user back to the worker control panel if they are a worker
if($_SESSION['worker_loggedin']){
?>

<a href="../worker_cpanel.php">Back</a>

<?php
// bring the user back to the admin check orders page if they are the admin
} else if ($_SESSION['admin_loggedin']){
?>

<a href="../../admin/orders/check_orders.php">Back</a>

<?php
}


//include the footer
include '../../footer/footer.php';


} else {
?>

  <script>redirect_page("waiver.php");</script>
  
<?php
}
?>

</body>
</html>
