<?php
//start the session to remember the session variables
session_start();
?>

<!-- Form that repairer/worker will fill in when the client brings in their vehicle -->
<!DOCTYPE html>
<html>
<head>
  <!--style sheet for the intake repair form-->
  <link rel="stylesheet" type="text/css" href="appointment_styles.css">


  <!--script that will redirect the user to another page-->
  <script src="../../src/js/submit_form.js"></script>
  
  <!--script that will default select a value in select dropdown-->
  <script src="../../src/js/option_selected.js"></script>

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
  year_limit($_SESSION['car_year'], 1900, date("Y"), "car year", "car_yearERR");

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
    
    
    //check if the worker account exist
    if ($worker_emailERR == ""){
      $worker_account_exist = worker_exist($_SESSION['worker_email'], "none");
    
      if (!$worker_account_exist){
        $worker_emailERR = "worker email does not exist";
      }
    }
    
    //date that work is going to be done
    createErrMsg("submit_appointment", "date", "plan_date", "plan_dateERR");
    system_date_limit($_SESSION['plan_date'], "date", "plan_dateERR" ,"today", "none");
    
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

  <?php
  if ($_SESSION['admin_loggedin']){
  ?>

  
  <span class="description_title">Status of the appointment</span>
  <select id="status_dropdown" name="status" value="<?php echo $_SESSION['status'];?>">
    <option value="">Choose a Status</option>
    <option value="pending">pending</option>
    <option value="accepted">accepted</option>
    <option value="rejected">rejected</option>
  </select><br>
  
  
  <?php
  if ($_SESSION['status'] == "rejected"){
  ?>
  <script>
    defaultSelect('status_dropdown', 'rejected');
  </script>
  
  <?php
  } else if ($_SESSION['status'] == "accepted"){
  ?>
  
  <script>
    defaultSelect('status_dropdown', 'accepted');
  </script>
  
  <?php
  } else if ($_SESSION['status'] == "pending"){
  ?>
  
   <script>
    defaultSelect('status_dropdown', 'pending');
  </script>
  
  <?php
  }
  ?>
  
  <span class="error_message"><?php echo $statusERR;?></span> <br>
  
  <span class="description_title">Worker Email</span>
  <input type="email" name="worker_email" placeholder="Email" value="<?php echo $_SESSION['worker_email'];?>"> <br>
  <span class="error_message"><?php echo $worker_emailERR;?></span> <br>
  
  <span class="description_title">Date</span>
  <input type="date" name="plan_date" placeholder="Date" value="<?php echo $plan_date_format;?>"> <br>
  <span class="error_message"><?php echo $plan_dateERR;?></span> <br>
  
  <?php
  }
  ?>

  <span class="description_title">Car Year</span>
  <input type="text" name="car_year" placeholder="Year" value="<?php echo $_SESSION['car_year'];?>"> <br>
  <span class="error_message"><?php echo $car_yearERR;?></span> <br>
  
  <span class="description_title">Car Make</span>
  <input type="text" name="car_make" placeholder="Make" value="<?php echo $_SESSION['car_make'];?>"> <br>
  <span class="error_message"><?php echo $car_makeERR;?></span> <br>
  
  <span class="description_title">Car Model</span>
  <input type="text" name="car_model" placeholder="Model" value="<?php echo $_SESSION['car_model'];?>"> <br>
  <span class="error_message"><?php echo $car_modelERR;?></span> <br>
  
  <span class="description_title">School Name</span>
  <input type="text" name="school_name" placeholder="School" value="<?php echo $_SESSION['school_name'];?>"> <br>
  <span class="error_message"><?php echo $school_nameERR;?></span> <br>
  
  <span class="description_title">School Address</span>
  <input type="text" name="school_address" placeholder="Address" value="<?php echo $_SESSION['school_address'];?>"> <br>
  <span class="error_message"><?php echo $school_addressERR;?></span> <br>
  
  <span class="description_title">Reason for the appointment</span> <br>
  <span class="error_message"><?php echo $plan_descriptionERR;?></span> <br>
  <textarea name="plan_description" class="description_comment" placeholder="Description..." rows="10" columns="50"><?php echo $_SESSION['plan_description'];?></textarea><br>
  
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
  } else if ($_SESSION['admin_loggedin']){
?>

    <a href="../../admin/admin_cpanel.php">Back</a>

<?php
  }
  
  //include the footer
  include '../../footer/footer.php';
  
} else {

  if ($_SESSION['editForm']){
    
    //temporary variables for the status and the customer email
    $temp_appointment_id = $_SESSION['appointment_id'];
    $temp_status = $_SESSION['status'];
    $temp_customer_email = $_SESSION['customer_email'];
    $temp_date = $_SESSION['plan_date'];
    
    include "../../database/update/update_appointments.php";
    
    
    //if the appointment is rejected
    if ($temp_status == "rejected"){
      //send a message to the site to give a notification that someon made an appointment
      include "../../database/sendmail.php";
    
      //subject
      $subject = "Rejected Appointment #" . $temp_appointment_id;
    
      //message
      $email_message = "<strong>Unfortunately, your appointment request has been rejected by our team, Sorry for the inconvenience.</strong> <br> <br>
                        <span>If you have further questions, please reply back to our email.</span>"; 
                        
       send_mail($temp_customer_email, $subject, $email_message);
    
    } else if ($temp_status == "accepted"){
      //send a message to the site to give a notification that someon made an appointment
      include "../../database/sendmail.php";
    
      //subject
      $subject = "Accepted Appointment #" . $temp_appointment_id;
    
      //message
      $email_message = "<strong>Your appointment has been accepted by our team and is scheduled to be on </strong> <strong style='color:red'>" . $temp_date . "</strong><br> <br>
                        <span>If you have further questions, please reply back to our email.</span>"; 

       send_mail($temp_customer_email, $subject, $email_message);
    }
    

  //if user is inserting data
  } else {
    //temporary variables for the message before its session gets erased
    $temp_email = $_SESSION['customer_email'];
    $temp_car_year = $_SESSION['car_year'];
    $temp_car_make = $_SESSION['car_make'];
    $temp_car_model = $_SESSION['car_model'];
    $temp_description = $_SESSION['plan_description'];
  
    include "../../database/insert/insert_appointments.php";
    
    //generate a unique id for the appointment email
    include "../../database/select/find_appointment_id.php";
    
    
    //send a message to the site to give a notification that someon made an appointment
    include "../../database/sendmail.php";
    
    
    //subject
    $subject = "Incoming Appointment #" . $_SESSION['appointment_id'];
    
    //message
    $email_message = "<strong style='font-size:20px'>" . $temp_email . " has made an appointment:</strong> <br> 
                      <div style='padding:10px 20px'>
                        <strong>Car Year:</strong> <span>" . $temp_car_year ."</span>
                      </div><br>
                      
                      <div style='padding:10px 20px'>
                        <strong>Car Make:</strong> <span>" . $temp_car_make ."</span>
                      </div> <br>
                      
                      <div style='padding:10px 20px'>
                        <strong>Car Model:</strong> <span>" . $temp_car_model ."</span>
                      </div> <br>
                      
                      <div style='padding:10px 20px'>
                        <strong>Reason for Appointment:</strong> <br> 
                        <span>" . $temp_description ."</span>
                      </div>";
    
  
    
    send_mail("JAMH@portcreditautobodyshop.tk", $subject, $email_message);

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
    } else if ($_SESSION['admin_loggedin']){
?>

<script>redirect_page("../../admin/admin_cpanel.php")</script>

<?php
  }
}
?>
</body>
</html>
