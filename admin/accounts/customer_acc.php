<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}
?>

  <!--the admin control panel section where they can check the customer accounts in the system-->
  <!--stylesheet for the accounts table-->
  <link rel="stylesheet" type="text/css" href="../../database/select/css/aselect_caccounts.css">
  
  
  
  <?php
  //session to admin is creating site
  $_SESSION['admin_create_caccount'] = 1;
  ?>
  
  <a href="../../create_account/signup.php">Create Customer Account</a>
  
  
  <?php
  //include the file that will print out all the orders
  include "../../database/select/aselect_caccounts.php";
  list_caccounts();
  ?>
 
  <div id="rowText"></div>
  

