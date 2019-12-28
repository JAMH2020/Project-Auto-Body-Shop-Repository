<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}

//clear saved session variable from other pages
include "../src/clear_sessions.php";

clear_order();
clear_invoice();

//session to identify if the user is editting a form
$_SESSION['editForm'] = false;
?>

<!-- control panel for the worker -->
<!DOCTYPE html>
<html>
<head>
  <!--style sheet for the worker control panel-->
  <link rel="stylesheet" type="text/css" href="worker_cpanel_styles.css">
  
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
  
</head>

<body>

<?php
//include the navigation bar
include "../navigation_bar/navigation_bar.php";
?>


<a href="#"  onclick='loadFile("worker_orders.php")'>Orders</a>
<a href="#"  onclick='loadFile("worker_invoices.php")'>Invoices</a>

<div class="content_window">

<?php
//sessions to choose which section to load at default run of page
if ($_SESSION['worker_section'] == "invoices"){
?>

<script> loadFile('worker_invoices.php'); </script>

<?php
} else {
?>

<script> loadFile('worker_orders.php'); </script>

<?php
}
?>

</div>



<?php
//include the footer
include '../footer/footer.php';
?>


</body>
</html>
