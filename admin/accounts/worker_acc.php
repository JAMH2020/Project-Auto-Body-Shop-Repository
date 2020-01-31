<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}

//session to tell which section the admin is on
$_SESSION['admin_section'] = "waccounts";
?>

  <!--the admin control panel section where they can check the worker accounts in the system-->
  <!--stylesheet for the worker accounts table-->
  <link rel="stylesheet" type="text/css" href="../../database/select/css/aselect_waccounts.css">
  
  <h2 class="section_title">WORKER ACCOUNTS</h2>
  
  <div class="create_link">
    <a href="../../create_account/worker_signup.php" class="create">Create Account</a>
    <div class="create_underline"></div>
  </div>
  
  <?php
  //include the file that will print out all the orders
  include "../../database/select/aselect_waccounts.php";
  list_waccounts();
  ?>

  <div id="rowText"></div>
