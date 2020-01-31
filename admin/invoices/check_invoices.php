<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}


$_SESSION['admin_section'] = "invoices";


//session to identify if the user is editting a form
$_SESSION['editForm'] = false;
?>


  <!--the admin control panel section where they can check the customer profiles in the system-->
  <!--stylesheet for the invoices table-->
  <link rel="stylesheet" type="text/css" href="../../database/select/css/aselect_invoices.css">
  
  <h2 class="section_title">INVOICES</h2>

  <?php
  //include the file that will print out all the orders
  include "../../database/select/aselect_invoices.php";
  ?>
 
  <div id="rowText"></div>
