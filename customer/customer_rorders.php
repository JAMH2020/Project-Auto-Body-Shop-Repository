<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}
?>

<!--stylesheet for the pending appointments table-->
<link rel="stylesheet" type="text/css" href="../database/select/css/cselect_rappointments.css">

<h2 class='invoice_title'>MY REJECTED APPOINTMENTS</h2>

<div id="editCheck"></div>

<?php
//include file for selecting orders
include '../database/select/cselect_appointments.php';

rejected_appointments($conn);
?>
