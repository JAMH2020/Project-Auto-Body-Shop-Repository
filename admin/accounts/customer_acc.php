<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}

//session to tell which section the admin is on
$_SESSION['admin_section'] = "caccounts";

//include file to remember session that admin is editting a customer account
  include "admin_create_customer.php";
?>

  <!--the admin control panel section where they can check the customer accounts in the system-->
  <!--stylesheet for the accounts table-->
  <link rel="stylesheet" type="text/css" href="../../database/select/css/aselect_caccounts.css">
  
  <h2 class="section_title">CUSTOMER ACCOUNTS</h2>
  
  <div class="create_link">
    <a href="#" class="create" onclick='adminCaccount("/admin/accounts/admin_create_customer.php",1); return false;'>Create Account</a>
    <div class="create_underline"></div>
  </div>
  
  
  <?php  
  //include the file that will print out all the orders
  include "../../database/select/aselect_caccounts.php";
  list_caccounts();
  ?>
 
  <div id="rowText"></div>
  <div id="adminCustomer"></div>
  
