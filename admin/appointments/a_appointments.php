<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}


$_SESSION['admin_section'] = "aappointments";


//session to identify if the user is editting a form
$_SESSION['editForm'] = false;
?>


  <!--the admin control panel section where they can check the customer profiles in the system-->
  <!--stylesheet for the invoices table-->
  <link rel="stylesheet" type="text/css" href="../../database/select/css/cselect_ogappointments.css">
  


  <?php
  //include the file that will print out all the orders
  include "../../database/select/aselect_appointments.php";
  
  accepted_appointment($conn)
  ?>
 
  <div id="rowText"></div>
  <div id="orderCheck"></div>
