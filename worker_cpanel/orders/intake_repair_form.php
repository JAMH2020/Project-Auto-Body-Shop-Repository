<?php
//start the session to remember the session variables
session_start();

//check if the user is logged in yet
include_once "../../login/login_check.php";
?>

<!-- Form that repairer/worker will fill in when the client brings in their vehicle -->
<!DOCTYPE html>
<html>
<head>
  <!--style sheet for the intake repair form-->
  <link rel="stylesheet" type="text/css" href="css/intake_repair_form_styles.css">


  <!--script that will redirect the user to another page-->
  <script src="../../src/js/submit_form.js"></script>
  
  <!--script that will default select a value in select dropdown-->
  <script src="../../src/js/option_selected.js"></script>
 

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



//returns an error message if a field is missing or if the input field is in an incorrect format

if ($_SERVER['REQUEST_METHOD'] == "POST"){
  
  //if the user is not viewing the form
  if (!$_SESSION['viewForm']){
  
  
      //if the user is not making an order from an appointment
      if (!$_SESSION['oldOrder']){
        //school name
        createErrMsg("submit_intake", "school name", "school_name", "school_nameERR");

        //school address
        createErrMsg("submit_intake", "school address", "school_address", "school_addressERR");
    
        //car year
        createErrMsg("submit_intake", "car year", "car_year", "car_yearERR");
        year_limit($_SESSION['car_year'], 1900, date("Y"), "car year", "car_yearERR");

        //car make
        createErrMsg("submit_intake", "car make", "car_make", "car_makeERR");

        //car model
        createErrMsg("submit_intake", "car model", "car_model", "car_modelERR");
    
        //description of work that is going to be done
        createErrMsg("submit_intake", "description", "plan_description", "plan_descriptionERR");
    
        //date that work is going to be done
        createErrMsg("submit_intake", "date", "plan_date", "plan_dateERR");
    
    
        //if the user is editting the form
        if ($_SESSION['editForm']){
          system_date_limit($_SESSION['plan_date'], "date", "plan_dateERR", $_SESSION['order_date'], "none");
        } else {
          system_date_limit($_SESSION['plan_date'], "date", "plan_dateERR", "today", "none");
        }
    
      }
    }
  

  //if the user is not viewing the form
  if (!$_SESSION['viewForm']){
  
  //VIN number
  createErrMsg("submit_intake", "VIN number", "vin_no", "vin_noERR");
  limit_length($_SESSION['vin_no'], 17, 1, "VIN number" ,"vin_noERR");

  //license plate number
  createErrMsg("submit_intake", "license plate", "license_plate", "license_plateERR");
  limit_length($_SESSION['license_plate'], 12, 0, "license plate" ,"license_plateERR");

  //odometer reading at intake
  createErrMsg("submit_intake", "odometer reading", "odometer_intake", "odometer_intakeERR");
  check_number($_SESSION['odometer_intake'], "odometer reading" ,"odometer_intakeERR");  

  //estimate of the cost of parts per unit
  createErrMsg("submit_intake", "estimate", "estimate_parts_per_unit", "estimate_parts_per_unitERR");
  check_number($_SESSION['estimate_parts_per_unit'], "estimate" ,"estimate_parts_per_unitERR");

  //estimate of the total cost of parts
  createErrMsg("submit_intake", "total estimate", "estimate_parts_total", "estimate_parts_totalERR");
  check_number($_SESSION['estimate_parts_total'], "total estimate" ,"estimate_parts_totalERR");

  //estimate of the labour cost per unit
  createErrMsg("submit_intake", "estimate", "estimate_labour_per_unit", "estimate_labour_per_unitERR");
  check_number($_SESSION['estimate_labour_per_unit'], "estimate" ,"estimate_labour_per_unitERR");

  //estimate of the total labour cost
  createErrMsg("submit_intake", "total estimate", "estimate_labour_total", "estimate_labour_totalERR");
  check_number($_SESSION['estimate_labour_total'], "total estimate" ,"estimate_labour_totalERR");

  //estimate of the cost of shop supplies used per unit
  createErrMsg("submit_intake", "estimate", "estimate_supplies_per_unit", "estimate_supplies_per_unitERR");
  check_number($_SESSION['estimate_supplies_per_unit'], "estimate" ,"estimate_supplies_per_unitERR");

  //estimate of the total cost of supplies
  createErrMsg("submit_intake", "total estimate", "estimate_supplies_total", "estimate_supplies_totalERR");
  check_number($_SESSION['estimate_supplies_total'], "total estimate" ,"estimate_supplies_totalERR");

  //estimate of the recycling/disposal fee per unit
  createErrMsg("submit_intake", "estimate", "estimate_disposal_per_unit", "estimate_disposal_per_unitERR");
  check_number($_SESSION['estimate_disposal_per_unit'], "estimate" ,"estimate_disposal_per_unitERR");

  //estimate of the total recycling/disposal fee
  createErrMsg("submit_intake", "total estimate", "estimate_disposal_total", "estimate_disposal_totalERR");
  check_number($_SESSION['estimate_disposal_total'], "total estimate" ,"estimate_disposal_totalERR");

  //estimate of the total cost
  //createErrMsg("submit_intake", "total estimate", "estimate_total_cost", "estimate_total_costERR");

  //date the estimate of costings were made
  createErrMsg("submit_intake", "date", "estimate_date", "estimate_dateERR");

  //date the date of the estimate of the costings will expire
  createErrMsg("submit_intake", "date", "estimate_expiry_date", "estimate_expiry_dateERR");
  
  //if the user is editting the form
  if ($_SESSION['editForm']){
    system_date_limit($_SESSION['estimate_expiry_date'], "date", "estimate_expiry_dateERR", $_SESSION['order_date'], "none");
  } else {
    system_date_limit($_SESSION['estimate_expiry_date'], "date", "estimate_expiry_dateERR", "today", "none");
  }

  //choice of removal
  createErrMsg("submit_intake", "removal choice", "removal_choice", "removal_choiceERR");
  
  //if user is editting the orders
  if ($_SESSION['editForm']){
    //status of the work
    createErrMsg("submit_intake", "order status", "status", "statusERR");
  }
  
  
  //if the user is the admin
  if ($_SESSION['admin_loggedin']){
    
    //if the user is not making an order from an appointment
    if (!$_SESSION['oldOrder']){
      //worker account
      createErrMsg("submit_intake", "worker email", "worker_email", "worker_emailERR");
    
      //if the worker email is not empty
      if ($worker_emailERR == ""){
        //check if the worker account exists
        $worker_account_exist = worker_exist($_SESSION['worker_email'], "none");
    
        if (!$worker_account_exist){
          $worker_emailERR = "This worker email does not exist";
        }
      }
    }
  }
  
 }
} else {
  //auto-generate the next order number only when the user is inserting data
  if (!$_SESSION['editForm']){
    include_once '../../database/select/find_order_id.php';

    $_SESSION['order_no'] = generate_order_no();
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

<script>
function add_estimate(session, value1, value2, value3, value4){
  $("#estimateTotal").load("../../src/sum_price.php?session=" + session + "&p1=" + value1 + "&p2=" + value2 + "&p3=" + value3 + "&p4=" + value4);
}

</script>


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
  <span class="description_title">Status:</span>
  <select name="status" id="status_dropdown" value="<?php echo $_SESSION['status'];?>">
    <option value="">Choose a Status</option>
    <option value="imcomplete">Imcomplete</option>
    <option value="complete">Complete</option>
  </select> <br>
  <span class="error_message"><?php echo $statusERR;?></span> <br> <br>
  
<?php
  //default select the status based of sessions
  if ($_SESSION['status'] == "imcomplete"){
?>

<script>defaultSelect('status_dropdown', 'imcomplete');</script>

<?php
  } else if ($_SESSION['status'] == "complete"){
?>

<script>defaultSelect('status_dropdown', 'complete');</script>

<?php
  }
}


//if the user is viewing the form
if ($_SESSION['viewForm']){
?>
<span class="description_title">Status:</span>
<span class="description_value"><?php echo $_SESSION['status'];?></span>
<?php
}
?>
  
  <div class="subtitle">
    <p class="subtitle-heading">School Information</p>
  </div>
  

  <span class="information-heading description_title"> Work Order #:</span>

<?php
  //if the user is the admin
  if ($_SESSION['admin_loggedin']){
?>
  <span class="description_title">Teacher Email:</span>
  
<?php
  //if the user is not making an order from an appointment and the user is not viewing the form
  if(!$_SESSION['oldOrder'] && !$_SESSION['viewForm']){
?>

  <input type="text" name="worker_email" placeholder="Email" value="<?php echo $_SESSION['worker_email'];?>">
  
<?php
  } else {
?>

  <span class="description_value"><?php echo $_SESSION['worker_email'];?></span>
  
<?php
  }
}
?>

  <br>
  
<?php
//if the user is the admin and is not viewing the form
if ($_SESSION['admin_loggedin'] && !$_SESSION['viewForm']){
?>
  <span class="error_message"><?php echo $worker_emailERR;?></span> 
<?php
}
?>
  
  <br>


 <span class="description_title">School Name:</span>

<?php
//if the user is not making an order from an appointment or viewing the form
if(!$_SESSION['oldOrder'] && !$_SESSION['viewForm']){
?>
  <input type="text" name="school_name" placeholder="School Name" value="<?php echo $_SESSION['school_name'];?>">
  
<?php
} else {
?>

  <span class="description_value"><?php echo $_SESSION['school_name'];?></span>

<?php
}
?>

  <span class="description_title">School Address:</span>
  
<?php
//if the user is not making an order from an appointment or viewing the form
if(!$_SESSION['oldOrder'] && !$_SESSION['viewForm']){
?>
  <input type="text" name="school_address" placeholder="School Address" value="<?php echo $_SESSION['school_address'];?>"> <br>
  
<?php
} else {
?>

<span class="description_value"><?php echo $_SESSION['school_address'];?></span> <br>

<?php
}
?>

  <span class="error_message"><?php echo $school_nameERR;?></span>
  <span class="error_message"><?php echo $school_addressERR;?></span> <br>

</div>





<div class="subtitle">
  <p class="subtitle-heading">Automobile To Be Repaired</p>
</div>



<div class="information">

  <span class="information-heading description_title">Year:</span>
  
<?php
  //if the user is not making an order from an appointment or viewing the form
  if(!$_SESSION['oldOrder'] && !$_SESSION['viewForm']){
?>

  <input type="text" name="car_year" placeholder="Year" value="<?php echo $_SESSION['car_year'];?>">

<?php
  } else {
?>

  <span class="description_value"><?php echo $_SESSION['car_year'];?></span>

<?php
  }
?>

  <span class="description_title">VIN #:</span>
  
<?php
//if the user is not viewing the form
if (!$_SESSION['viewForm']){
?>
  <input type="text" name="vin_no" placeholder="VIN No." min = "17" max = "17" value="<?php echo $_SESSION['vin_no'];?>"><br>

<?php
} else {
?>

  <span class="description_value"><?php echo $_SESSION['vin_no'];?></span> <br>
  
<?php
}
?>
  <span class="error_message"><?php echo $car_yearERR;?></span>
  <span class="error_message"><?php echo $vin_noERR;?></span> <br>


  <span class="description_title">Make:</span>
  
<?php
  //if the user is not making an order from an appointment
  if(!$_SESSION['oldOrder'] && !$_SESSION['viewForm']){
?>

  <input type="text" name="car_make" placeholder="Make" value="<?php echo $_SESSION['car_make'];?>">

<?php
  } else {
?>

  <span class="description_value"><?php echo $_SESSION['car_make'];?></span>

<?php
}
?>

  <span class="description_title">License Plate:</span>
  
<?php
//if the user is not viewing the form
if (!$_SESSION['viewForm']){
?>
  <input type="text" name="license_plate" max = "8" min = "2" placeholder="License Plate" value="<?php echo $_SESSION['license_plate'];?>"> <br>
  
<?php
} else {
?>

  <span class="description_value"><?php echo $_SESSION['license_plate'];?></span> <br>
  
<?php
}
?>

  <span class="error_message"><?php echo $car_makeERR;?></span>
  <span class="error_message"><?php echo $license_plateERR;?></span> <br>


  <span class="description_title">Model:</span>
  
<?php
  //if the user is not making an order from an appointment
  if(!$_SESSION['oldOrder'] && !$_SESSION['viewForm']){
?>

  <input type="text" name="car_model" placeholder="Model" value="<?php echo $_SESSION['car_model'];?>">
  
<?php
  } else {
?>

  <span class="description_value"><?php echo $_SESSION['car_model'];?></span>

<?php
  }
?>

  <span class="description_title">Odometer:</span>
  
<?php
//if the user is not viewing the form
if (!$_SESSION['viewForm']){
?>
  <input type="text" name="odometer_intake" placeholder="Odometer" value="<?php echo $_SESSION['odometer_intake'];?>"><br>
  
<?php
} else {
?>

  <span class="description_value"><?php echo $_SESSION['odometer_intake'];?></span> <br>
  
<?php
}
?>

  <span class="error_message"><?php echo $car_modelERR;?></span>
  <span class="error_message"><?php echo $odometer_intakeERR;?></span> <br>


  <p>Detailed description of work to be performed including anticipated parts (including whether each part is a new part provided by the original equipment manufacturer, a new part not provided by the original equipment manufacturer, a used part or a reconditioned part) shop materials, environmental related, fees, disposal/recycling fees, etc.:
  </p>

  <span class="error_message"><?php echo $plan_descriptionERR;?></span> <br>

  <div class="description">
  
<?php
  //if the user is not making an order from an appointment or viewing the form
  if(!$_SESSION['oldOrder'] && !$_SESSION['viewForm']){
?>
    <textarea name="plan_description" placeholder="Description..." rows="10" columns="50"><?php echo $_SESSION['plan_description'];?></textarea><br>
    
<?php
  } else {
?>

    <span class="description_value"><?php echo $_SESSION['plan_description'];?></span>
    
<?php
  }
?>
  </div> <br><br>


  <span class="description_title">Date on which the work shall be completed:</span>
  
<?php
  //if the user is not making an order from an appointment
  if(!$_SESSION['oldOrder'] && !$_SESSION['viewForm']){
?>

  <input type="date" name="plan_date" placeholder="Date" value="<?php echo $plan_date_format;?>"> <br>
  
<?php
  } else {
?>

  <span class="description_value"><?php echo $plan_date_format;?></span> <br>
  
<?php
  }
?>
  <span class="error_message"><?php echo $plan_dateERR;?></span> <br>

</div>



<div class="subtitle">
  <p class="subtitle-heading">Estimate Costs</p> 
</div>


<table class="table">

  <tr>
    <th class="description_title">Total Estimated Cost</th>
    <th class="description_title">Price Per Unit</th>
    <th class="description_title">Line Total</th>
  </tr>


  <tr>
    <td class="description_title">Parts:</td>

    <td>
    
<?php
  //if the user is not viewing the form
  if (!$_SESSION['viewForm']){
?>
      <input type="text" name="estimate_parts_per_unit" placeholder="$-Parts/Unit" value="<?php echo $_SESSION['estimate_parts_per_unit'];?>"> <br>

<?php
  } else {
?>
      <span class="description_value"><?php echo $_SESSION['estimate_parts_per_unit'];?></span> <br>
      
<?php
  }
?>
      <span class="error_message"><?php echo $estimate_parts_per_unitERR;?></span>
    </td>

    <td>
    
<?php
  //if the user is not viewing the form
  if (!$_SESSION['viewForm']){
?>
      <input type="text" name="estimate_parts_total" placeholder="$-Parts Total" value="<?php echo $_SESSION['estimate_parts_total'];?>" id="sum1" onkeyup="add_estimate('<?php echo 'estimate_total_cost';?>',$('#sum1').val(), $('#sum2').val(), $('#sum3').val(), $('#sum4').val())"> <br>
      
<?php
  } else {
?>

      <span class="description_value"><?php echo $_SESSION['estimate_parts_total'];?></span> <br>
      
<?php
  }
?>
      <span class="error_message"><?php echo $estimate_parts_totalERR;?></span>
    </td>
  </tr>


  <tr>
    <td class="description_title">Labour:</td>

    <td>
    
<?php
  //if the user is not viewing the form
  if (!$_SESSION['viewForm']){
?>
      <input type="text" name="estimate_labour_per_unit" placeholder="$-Labour/Unit" value="<?php echo $_SESSION['estimate_labour_per_unit'];?>"> <br>
      
<?php
  } else {
?>

      <span class="description_value"><?php echo $_SESSION['estimate_labour_per_unit'];?></span><br>
      
<?php
  }
?>
      <span class="error_message"><?php echo $estimate_labour_per_unitERR;?></span>
    </td>

    <td>
    
<?php
  //if the user is not viewing the form
  if (!$_SESSION['viewForm']){
?>
      <input type="text" name="estimate_labour_total" placeholder="$-Labour Total" value="<?php echo $_SESSION['estimate_labour_total'];?>" id="sum2" onkeyup="add_estimate('<?php echo 'estimate_total_cost';?>',$('#sum1').val(), $('#sum2').val(), $('#sum3').val(), $('#sum4').val())"> <br>
      
<?php
  } else {
?>

      <span class="description_value"><?php echo $_SESSION['estimate_labour_total'];?></span><br>

<?php
  }
?>
      <span class="error_message"><?php echo $estimate_labour_totalERR;?></span>
    </td>
  </tr>


  <tr>
    <td class="description_title">Shop Supplies:</td>

    <td>
    
<?php
  //if the user is not viewing the form
  if (!$_SESSION['viewForm']){
?>
      <input type="text" name="estimate_supplies_per_unit" placeholder="$-Supplies/Unit" value="<?php echo $_SESSION['estimate_supplies_per_unit'];?>"> <br>
      
<?php
  } else {
?>

      <span class="description_value"><?php echo $_SESSION['estimate_supplies_per_unit'];?></span><br>
      
<?php
  }
?>
      <span class="error_message"><?php echo $estimate_supplies_per_unitERR;?></span>
    </td>

    <td>
    
<?php
  //if the user is not viewing the form
  if (!$_SESSION['viewForm']){
?>
      <input type="text" name="estimate_supplies_total" placeholder="$-Supplies Total" value="<?php echo $_SESSION['estimate_supplies_total'];?>" id="sum3" onkeyup="add_estimate('<?php echo 'estimate_total_cost';?>',$('#sum1').val(), $('#sum2').val(), $('#sum3').val(), $('#sum4').val())"> <br>
      
<?php
  } else {
?>

      <span class="description_value"><?php echo $_SESSION['estimate_supplies_total'];?></span><br>
      
<?php
  }
?>
      <span class="error_message"><?php echo $estimate_supplies_totalERR;?></span>
    </td>
  </tr>

  <tr>
    <td class="description_title">Recycling/Disposal Fee:</td>

    <td>
    
<?php
  //if the user is not viewing the form
  if (!$_SESSION['viewForm']){
?>
      <input type="text" name="estimate_disposal_per_unit" placeholder="$-Recycling and Disposal/Unit" value="<?php echo $_SESSION['estimate_disposal_per_unit'];?>"> <br>
      
<?php
  } else {
?>

      <span class="description_value"><?php echo $_SESSION['estimate_disposal_per_unit'];?></span><br>
      
<?php
  }
?>
      <span class="error_message"><?php echo $estimate_disposal_per_unitERR;?></span>
    </td>

    <td>
    
<?php
  //if the user is not viewing the form
  if (!$_SESSION['viewForm']){
?>
      <input type="text" name="estimate_disposal_total" placeholder="$-Recycling and Disposal Total" value="<?php echo $_SESSION['estimate_disposal_total'];?>" id="sum4" onkeyup="add_estimate('<?php echo 'estimate_total_cost';?>',$('#sum1').val(), $('#sum2').val(), $('#sum3').val(), $('#sum4').val())"> <br>
      
<?php
  } else {
?>
      <span class="description_value"><?php echo $_SESSION['estimate_disposal_total'];?></span><br>
      
<?php
  }
?>
      <span class="error_message"><?php echo $estimate_disposal_totalERR;?></span>
    </td>
  </tr>

  <tr>
    <td class="description_title">Total Estimated Cost:</td>
    <td></td>
    <td>
      
      <span class="description_value" id="estimateTotal"><?php echo $_SESSION['estimate_total_cost'];?></span><br>
      <span class="error_message"><?php echo $estimate_total_costERR;?></span>
    </td>
    
  </tr>
</table> <br>



<p>The Board agrees that it will not charge the undersigned an amount that exceeds the Total Estimated Cost by more than 10 per cent. </p>


<div class="information">

  <span class="information-heading description_title">Date of Estimate:</span>
  
<?php
  //if the user is not viewing the form
  if (!$_SESSION['viewForm']){
?>
  <input type="date" name="estimate_date" placeholder="Date of Estimate" value="<?php echo $estimate_date_format?>"> <br>
  
<?php
  } else {
?>

  <span class="description_value"><?php echo $estimate_date_format?></span> <br>
  
<?php
  }
?>
  <span class="error_message"><?php echo $estimate_dateERR;?></span><br>


  <span class="description_title">This estimate expires on:</span>
  
<?php
   //if the user is not viewing the form
  if (!$_SESSION['viewForm']){
?>
  <input type="date" name="estimate_expiry_date" placeholder="Expiry Date" value="<?php echo $estimate_expiry_date_format;?>"> <br>
  
<?php
  } else {
?>

  <span class="description_value"><?php echo $estimate_expiry_date_format;?></span><br>
  
<?php
  }
?>
  <span class="error_message"><?php echo $estimate_expiry_dateERR;?></span> <br>

  <span class="description_title">Any parts removed in the course of work on repairs to the automobile shall be (select one)</span>


<?php
 //if the user is not viewing the form
if (!$_SESSION['viewForm']){
?>
  <select name="removal_choice" id="removal_dropdown" value="<?php echo $_SESSION['removal_choice'];?>">
    <option value="">Choose a Removal Option</option>
    <option value="A">(A) return to the undersigned</option>
    <option value="B">(B) disposed of by the School</option>
  </select> <br>
  
  
  <?php
  if ($_SESSION['removal_choice'] == "B"){
  ?>
  
  <script>
  defaultSelect('removal_dropdown', 'B');
  </script>
  
  <?php
  } else if ($_SESSION['removal_choice'] == "A"){
  ?>
  
  <script>
  defaultSelect('removal_dropdown', 'A');
  </script>
  
  <?php
  }
} else {

  if ($_SESSION['removal_choice'] == "A"){
  ?>
  
  <span class="description_value">(A) return to the undersigned</span> <br>
  
<?php
  } else if ($_SESSION['removal_choice'] == "B"){
?>

  <span class="description_value">(B) disposed of by the School</span> <br>
  
<?php
  }
}
?>

  <span class="error_message"><?php echo $removal_choiceERR;?></span>

</div>


<?php
  //if the user is not viewing the form
  if (!$_SESSION['viewForm']){
?>

<input  class="button"type="submit" name="submit_intake" value="Submit"><br>

<?php
  } else {
?>

<input  class="button"type="submit" name="submit_intake" value="Next"><br>

<?php
}


//bring the user back to the worker control panel if they are a worker
if($_SESSION['worker_loggedin']){
?>

<a href="../worker_cpanel.php">Back</a>

<?php
// bring the user back to the admin check orders page if they are the admin
} else if ($_SESSION['admin_loggedin']){

  $_SESSION['admin_section'] = "order";
?>

<a href="../../admin/admin_cpanel.php">Back</a>

<?php
// bring back the user to the customer complted orders page if they are the customer
} else if ($_SESSION['customer_loggedin']){

  $_SESSION['customer_section'] = "corders";
?>

<a href="../../customer/customer_cpanel.php">Back</a>

<?php
}

//include the footer
include '../../footer/footer.php';


} else {
?>

  <script>redirect_page("waiver.php");</script>
  
<?php
   $conn = new mysqli($servername, $username, $password,$db);
   $check= "SELECT * FROM * WHERE  order_no= '$_POST[order_no]'";
   $rs = mysqli_query($conn,$check);
   $data = mysqli_fetch_array($rs, MYSQLI_NUM);
   if($data[0] > 1) {
    echo "Error, order number already exists<br/>";
   }
   else
   {
     if (mysqli_query($con))
     {
        echo "<br/>";
     }
     else
     {
        echo "Error, order number already exists<br/>";
     }
}
?>

<?php
}
?>

</body>
</html>

