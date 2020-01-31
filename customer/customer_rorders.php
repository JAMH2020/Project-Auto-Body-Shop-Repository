<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}

//remember which tab section the user was on
$_SESSION['customer_section'] = "appointments";
$_SESSION['customer_appointments'] = "rorders";
?>

<!--stylesheet for the pending appointments table-->
<link rel="stylesheet" type="text/css" href="../database/select/css/cselect_rappointments.css">

<h2 class='section_title'>MY REJECTED APPOINTMENTS</h2>

<div id="editCheck"></div>

<?php
//include file for selecting orders
include '../database/select/cselect_appointments.php';

rejected_appointments($conn);
?>
