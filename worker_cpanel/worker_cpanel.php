<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}

//check if the user is logged in yet
include_once "../login/login_check.php";

//clear saved session variable from other pages
include "../src/clear_sessions.php";

clear_order();
clear_invoice();
clear_appointments();

//session to identify if the user is editting a form
$_SESSION['editForm'] = false;

//session to identify if the user is viewing a form
$_SESSION['viewForm'] = false;
?>

<!-- control panel for the worker -->
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <!--title that will show up on the tab-->
  <title>Welcome <?php echo " " . $_SESSION['worker_firstname']?></title>
  <meta name="description" content="Worker's Control Panel for Orders and Appointments">
  <meta name="author" content="JAMH Group">

  <!--style sheet for the worker control panel-->
  <link rel="stylesheet" type="text/css" href="css/worker_cpanel_styles.css">
  
  <!--style sheet for the worker orders page-->
  <link rel="stylesheet" type="text/css" href="css/worker_orders_styles.css">
  
  <!--style sheet for the orders table of the worker control panel-->
  <link rel="stylesheet" type="text/css" href="../database/select/css/select_orders.css">
  
  <!--style sheet for the invoices table of the worker control panel-->
  <link rel="stylesheet" type="text/css" href="../database/select/css/select_invoices.css">


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
//include the navigation bar
include "../navigation_bar/navigation_bar.php";


//opens the tab of the current section the user is on
if ($_SESSION['worker_section'] == "invoices"){
?>

<script>openTab("invoices", "a_option_link");</script>

<?php
//opens the tab of the current section the user is on
} else if ($_SESSION['worker_section'] == "appointments"){
?>

<script>openTab("appointments", "a_option_link");</script>

<?php
} else {
?>

<script>openTab("orders", "a_option_link");</script>

<?php
}



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

<div class="admin_cpanel_window">
  <div class="background_worker_cpanel">

    <div class="worker_cpanel_links">

      <a href="#"  class="a_option_link closed_tab" id="orders" onclick='loadFile("worker_orders.php"); openTab("orders", "a_option_link");'>Orders</a>
      <a href="#"  class="a_option_link closed_tab" id="invoices" onclick='loadFile("worker_invoices.php"); openTab("invoices", "a_option_link")'>Invoices</a>
      <a href="#"  class="a_option_link closed_tab" id="appointments" onclick='loadFile("worker_appointments.php"); openTab("appointments", "a_option_link")'>Appointments</a>
      
    </div>
  </div>

  <div class="content_window">
    <div class="vertical_align_content">
      <div class="horizontal_align_content">

      <?php
      //sessions to choose which section to load at default run of page
      if ($_SESSION['worker_section'] == "invoices"){
      ?>

        <script> loadFile('worker_invoices.php'); </script>
      
      <?php
      //sessions to choose which section to load at default run of page
      } else if ($_SESSION['worker_section'] == "appointments"){
      ?>

        <script> loadFile('worker_appointments.php'); </script>
        
      <?php
      } else {
      ?>

        <script> loadFile('worker_orders.php'); </script>

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
