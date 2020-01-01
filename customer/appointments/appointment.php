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



//description of the work that is going to be done and date work is going to be performed
$plan_description = "";
save_session("plan_description");




if ($_SESSION['admin_loggedin']){

  //worker email
  $worker_email = "";
  save_session("worker_email");
  
  //plan date
  $plan_date = "";
  save_session("plan_date");
  
  $plan_dateERR = "";
  
  $worker_emailERR = "";
  
  //status of the order
  $order_status = "";
  save_session("status");
  
  $statusERR = "";
}




//errors for any missing fields in the repair intake form
$school_nameERR = $school_addressERR = $car_yearERR = $car_makeERR = $car_modelERR = $plan_descriptionERR = "";



//include file that will fix the user inputs that are entered
include_once "../../database/fixinput.php";


//returns an error message if a field is missing

if ($_SERVER['REQUEST_METHOD'] == "POST"){

  //school name
  createErrMsg("submit_appointment", "school name", "school_name", "school_nameERR");

  //school address
  createErrMsg("submit_appointment", "school address", "school_address", "school_addressERR");

  //car year
  createErrMsg("submit_appointment", "car year", "car_year", "car_yearERR");

  //car make
  createErrMsg("submit_appointment", "car make", "car_make", "car_makeERR");

  //car model
  createErrMsg("submit_appointment", "car model", "car_model", "car_modelERR");

  //description of work that is going to be done
  createErrMsg("submit_appointment", "description", "plan_description", "plan_descriptionERR");

  
  //if user is editting the orders
  if ($_SESSION['editForm']){
    
  }
  
  
  //if the user is the admin
  if ($_SESSION['admin_loggedin']){
    //worker account
    createErrMsg("submit_appointment", "worker email", "worker_email", "worker_emailERR");
    
    //date that work is going to be done
    createErrMsg("submit_appointment", "date", "plan_date", "plan_dateERR");
    
    //status of the work
    createErrMsg("submit_appointment", "order status", "status", "statusERR");
  }
}

//check if there are any missing or incorrect fields
$error_intake_input;

if ($school_nameERR != "" or $school_addressERR != "" or $car_yearERR != "" or $car_makeERR != "" or $car_modelERR != "" or $plan_descriptionERR != ""){
 
 $error_appointment_input = true;
 
} else {
  $error_appointment_input = false;
}



//for editting orders
if ($_SESSION['editForm']){
  if ($statusERR){
    $error_appointment_input = true;   
  }
}


//for the admin as user
if ($_SESSION['admin_loggedin']){
  if ($worker_emailERR or $plan_dateERR or $statusERR){
    $error_appointment_input = true;
  } 
}



//reformat all the dates into the correct format
//authorization of work date
if (!empty($_SESSION['plan_date'])){
  $plan_date_format = reformat_date($_SESSION['plan_date']);
}




//ask the user to input the required fields if the user has not pressed the submit button yet
if ($error_appointment_input  or !isset($_POST['submit_appointment'])){

  //include the navigation bar
  include "../../navigation_bar/navigation_bar.php";
?>

<h1>Book an Appointment</h1>

<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete = "off">

  <span>Car Year</span>
  <input type="text" name="car_year" placeholder="Year" value="<?php echo $_SESSION['car_year'];?>">
  <span><?php echo $car_yearERR;?></span> <br>
  
  <span>Car Make</span>
  <input type="text" name="car_make" placeholder="Make" value="<?php echo $_SESSION['car_make'];?>">
  <span><?php echo $car_makeERR;?></span> <br>
  
  <span>Car Model</span>
  <input type="text" name="car_model" placeholder="Model" value="<?php echo $_SESSION['car_model'];?>">
  <span><?php echo $car_modelERR;?></span> <br>
  
  <span>School Name</span>
  <input type="text" name="school_name" placeholder="School" value="<?php echo $_SESSION['school_name'];?>">
  <span><?php echo $school_nameERR;?></span> <br>
  
  <span>Car Address</span>
  <input type="text" name="school_address" placeholder="Address" value="<?php echo $_SESSION['school_address'];?>">
  <span><?php echo $school_addressERR;?></span> <br>
  
  <span>Reason for the appointment</span> <br>
  <span><?php echo $plan_descriptionERR;?></span> <br>
  <textarea name="plan_description" placeholder="Description..." rows="10" columns="50"><?php echo $_SESSION['plan_description'];?></textarea><br>
  
  <input class="button"type="submit" name="submit_appointment" value="Submit"><br>
</form>

  <?php
  //if the customer is loggedin
  if ($_SESSION['customer_loggedin']){
  
    //if the customer is editting the order
    if ($_SESSION['editForm']){
      $_SESSION['customer_section'] = "porders";
    } else {
      $_SESSION['customer_section'] = "ogorders";
    }
  ?>

    <a href="../customer_cpanel.php">Back</a>


<?php
  }
  
  //include the footer
  include '../../footer/footer.php';
  
} else {

  if ($_SESSION['editForm']){
    include "../../database/update/update_appointments.php";
    
   
  //if user is inserting data
  } else {
    include "../../database/insert/insert_appointments.php";

  }
  
  
  if ($_SESSION['customer_loggedin']){
     if ($_SESSION['editForm']){
       $_SESSION['customer_section'] = "porders";
      } else {
        $_SESSION['customer_section'] = "ogorders";
      }

?>

<script>redirect_page("../customer_cpanel.php")</script>

<?php
    }
  }
?>
</body>
</html>
