<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}

//remember which tab section the user was on
$_SESSION['customer_section'] = "corders";
?>

<!--stylesheet for the pending appointments table-->
<link rel="stylesheet" type="text/css" href="../database/select/css/cselect_corders.css">

<h2 class='section_title'>MY COMPLETED ORDERS</h2>

<div id="editCheck"></div>
<div id="viewCheck"></div>

<?php
//include file for selecting orders
include '../database/select/cselect_appointments.php';

completed_orders($conn);
?>
