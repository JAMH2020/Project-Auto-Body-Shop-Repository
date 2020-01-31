<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}

$_SESSION['worker_section'] = "mappointments";


//session to identify if the user is editting a form
$_SESSION['editForm'] = false;
?>


<h2 class='order_title'>MY APPOINTMENTS THAT ARE CONVERTED TO ORDERS</h2>

<div id="editCheck"></div>

<?php
//include file for selecting orders
include '../database/select/select_appointments.php';

met_appointments($conn);
?>
