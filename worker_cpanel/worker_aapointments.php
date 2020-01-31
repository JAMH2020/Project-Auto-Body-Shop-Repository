<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}

$_SESSION['worker_section'] = "appointments";
$_SESSION['worker_appointments'] = "aappointments";

//session to identify if the user is editting a form
$_SESSION['editForm'] = false;
?>


<h2 class='order_title'>MY ACCEPTED APPOINTMENTS</h2>

<div id="editCheck"></div>
<div id="orderCheck"></div>

<?php
//include file for selecting orders
include '../database/select/select_appointments.php';

accepted_appointments($conn);
?>
