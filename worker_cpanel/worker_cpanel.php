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
  
  
</head>

<body>

<?php
//include the navigation bar
include "../navigation_bar/navigation_bar.php";


//opens the tab of the current section the user is on
if ($_SESSION['worker_section'] == "invoices"){
?>

<script>openTab("invoices");</script>

<?php
//opens the tab of the current section the user is on
} else if ($_SESSION['worker_section'] == "aappointments"){
?>

<script>openTab("aappointments");</script>

<?php
//opens the tab of the current section the user is on
} else if ($_SESSION['worker_section'] == "mappointments"){
?>

<script>openTab("mappointments");</script>


<?php
} else {
?>

<script>openTab("orders");</script>

<?php
}
?>

<div class="admin_cpanel_window">
  <div class="background_worker_cpanel">

    <div class="worker_cpanel_links">

      <a href="#"  class="a_option_link closed_tab" id="orders" onclick='loadFile("worker_orders.php"); openTab("orders");'>Orders</a>
      <a href="#"  class="a_option_link closed_tab" id="invoices" onclick='loadFile("worker_invoices.php"); openTab("invoices")'>Invoices</a>
      <a href="#"  class="a_option_link closed_tab" id="aappointments" onclick='loadFile("worker_aappointments.php"); openTab("aappointments")'>Accepted Appointments</a>
      <a href="#"  class="a_option_link closed_tab" id="mappointments" onclick='loadFile("worker_mappointments.php"); openTab("mappointments")'>Met Appointments</a>
      
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
      } else if ($_SESSION['worker_section'] == "aappointments"){
      ?>

        <script> loadFile('worker_aappointments.php'); </script>
      
       <?php
      //sessions to choose which section to load at default run of page
      } else if ($_SESSION['worker_section'] == "mappointments"){
      ?>

        <script> loadFile('worker_mappointments.php'); </script>
        
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
