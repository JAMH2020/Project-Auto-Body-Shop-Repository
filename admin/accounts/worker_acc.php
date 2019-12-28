<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}
?>

  <!--the admin control panel section where they can check the worker accounts in the system-->
  <!--stylesheet for the worker accounts table-->
  <link rel="stylesheet" type="text/css" href="../../database/select/css/aselect_waccounts.css">

  <a href="../../create_account/worker_signup.php">Create Worker Account</a>
  
  <?php
  //include the file that will print out all the orders
  include "../../database/select/aselect_waccounts.php";
  list_waccounts();
  ?>

  <div id="rowText"></div>
