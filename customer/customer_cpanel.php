<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}

//check if the user is logged in yet
include_once "../login/login_check.php";

//reset session to check if the user is editting 
$_SESSION['editForm'] = false;

//session to identify if the user is viewing a form
$_SESSION['viewForm'] = false;

//clear saved session variable from other pages
include "../src/clear_sessions.php";

clear_order();
clear_invoice();
clear_appointments();
?>

<!-- control panel for the worker -->
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <!--title that will show up on the tab-->
  <title>Welcome <?php echo " " . $_SESSION['customer_firstname']; ?></title>
  <meta name="description" content="Customer's Control Panel for Orders and Appointments">
  <meta name="author" content="JAMH Group">
  
  <!--style sheet for the customer control panel-->
  <link rel="stylesheet" type="text/css" href="customer_cpanel_styles.css">
  
  
  <!--JQuery library-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <!--script use to redirect the user to another page-->
  <script src="../src/js/submit_form.js"></script>
  
  <!--script for finding the value of a certain row in the customer table without the refresh of the page-->
  <script src="../database/findRow.js"></script>
  
  <!--script to load a certain section-->
  <script src="../src/js/load_file.js"></script>
  
  <!--script to change tabs-->
  <script src="../src/js/open_tab.js"></script>  
  
  <!--script that will display message for any action user has done-->
  <script src="../src/js/display_notification.js"></script>
  
</head>

<body>

<?php
  
$notification_job = "";
$notification_action = "";
  
//comment for the notification if the user has inserted or editted a file
if ($_SESSION['order_done'] != ""){
  $notification_job = "Order";
    
} else if ($_SESSION['invoice_done'] != ""){
  $notification_job = "Invoice";
    
} else if ($_SESSION['appointment_done'] != ""){
  $notification_job = "Appointment";
    
}
  
  
  
if ($_SESSION['order_done'] == "insert" || $_SESSION['invoice_done'] == "insert" || $_SESSION['appointment_done'] == "insert"){
  
  $notification_action = "Inserted";
    
} else if ($_SESSION['order_done'] == "edit" || $_SESSION['invoice_done'] == "edit" || $_SESSION['appointment_done'] == "edit"){
  
  $notification_action = "Editted";
}

//include the navigation bar
include '../navigation_bar/navigation_bar.php';
?>

<div class="notification_box">
  <span class="email_notification">
    <i class='fas fa-check-circle sent_icon'></i>
    <?php echo "Your " . $notification_job . " has been Successfully " . $notification_action; ?>
  </span>
</div>


<?php
//display any notifications if the user has editted or inserted data
if ($_SESSION['order_done'] != "" || $_SESSION['invoice_done'] != "" || $_SESSION['appointment_done'] != ""){
?>

<script>
show_notification("notification_box");
</script>

<?php
  $_SESSION['order_done'] = "";
  $_SESSION['invoice_done'] = "";
  $_SESSION['appointment_done'] = "";
}
?>

<div class="customer_cpanel_window">
  <div class="background_customer_cpanel">
    <h1 class="section_heading">Hi, <b><?php echo htmlspecialchars($_SESSION["customer_firstname"] . " " . $_SESSION["customer_lastname"]); ?></b>. Welcome to our site.</h1>
    
    <div class="create_link">
      <a class="create" href="appointments/appointment.php">Book an appointment</a>
      <div class="create_underline"></div>
    </div>
    
    <div class="customer_cpanel_links">
      <a href="#"  class="a_option_link closed_tab" id="appointments" onclick='loadFile("customer_appointments.php"); openTab("appointments", "a_option_link");'>Appointments</a>
      <a href="#"  class="a_option_link closed_tab" id="corders" onclick='loadFile("customer_corders.php"); openTab("corders", "a_option_link")'>Completed Orders</a>
      <a href="#"  class="a_option_link closed_tab" id="invoices" onclick='loadFile("customer_invoices.php"); openTab("invoices", "a_option_link")'>Invoices</a>     
    </div>
  </div>
  
  <?php
  //opens the tab of the current section the user is on
  if ($_SESSION['customer_section'] == "invoices"){
  ?>

  <script>openTab("<?php echo 'invoices';?>", "a_option_link");</script>

  <?php
  } else if ($_SESSION['customer_section'] == "corders"){
  ?>

  <script>openTab("<?php echo 'corders';?>", "a_option_link");</script>

  <?php
  } else {
  ?>

  <script>openTab("<?php echo 'appointments';?>", "a_option_link");</script>

  <?php
  }
  ?>
  
  <div class="content_window">
    <div class="vertical_align_content">
      <div class="horizontal_align_content">
      
      <?php
      //default loading of the file when user comes on to the page
      if ($_SESSION['customer_section'] == "invoices"){
      ?>
      
      <script>loadFile("customer_invoices.php");</script>
      
      <?php
      } else if ($_SESSION['customer_section'] == "corders"){
      ?>
      
      <script>loadFile("customer_corders.php");</script>
            
      <?php
      } else {
      ?>
      
      <script>loadFile("customer_appointments.php");</script>
      
      <?php
      }
      ?>
      
      
      </div>
    </div>
  </div>

</div>

<?php
//include the footer
include '../footer/footer.php';
?>


</body>
</html>
