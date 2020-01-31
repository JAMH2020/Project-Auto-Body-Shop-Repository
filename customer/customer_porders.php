<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}

//remember which tab section the user was on
$_SESSION['customer_section'] = "appointments";
$_SESSION['customer_appointments'] = "porders";
?>

<!--stylesheet for the pending appointments table-->
<link rel="stylesheet" type="text/css" href="../database/select/css/cselect_pappointments.css">

<h2 class='section_title'>MY PENDING APPOINTMENTS</h2>

<div id="rowText"></div>
<div id="editCheck"></div>

<?php
//include file for selecting orders
include '../database/select/cselect_appointments.php';

planned_appointments($conn);
?>
