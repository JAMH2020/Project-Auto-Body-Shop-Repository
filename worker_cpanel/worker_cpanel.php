<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}

//clear saved session variable from other pages
include "../../src/clear_sessions.php";

//session to identify if the user is editting a form
$_SESSION['editForm'] = false;
?>

<!-- control panel for the worker -->
<!DOCTYPE html>
<html>
<head>
  <!--style sheet for the worker control panel-->
  <link rel="stylesheet" type="text/css" href="worker_cpanel_styles.css">
  
  <!--style sheet for table of the worker control panel-->
  <link rel="stylesheet" type="text/css" href="../database/select/css/select_orders.css">


  <!--JQuery library-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <!--script use to redirect the user to another page-->
  <script src="../src/js/submit_form.js"></script>
  
  <!--script for finding the value of a certain row in the customer table without the refresh of the page-->
  <script src="../database/findRow.js"></script>
  
</head>

<body>

<?php
//include the navigation bar
include "../navigation_bar/navigation_bar.php";
?>



<h2 class='order_title'>MY ORDERS</h2>

<a href="orders/intake_repair_form.php" class='order'>Create Order</a>
<div class="create_order_underline"></div>
<div id="editCheck"></div>

<?php
//include file for selecting orders
include '../database/select/select_orders.php';



//include the footer
include '../footer/footer.php';
?>


</body>
</html>
