<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}
?>

<!--the admin control panel section where they can check the customer accounts in the system-->
<html>
<head>
  
  <!--script use to redirect the user to another page-->
  <script src="../../src/js/submit_form.js"></script>
  
  <!--script for finding the value of a certain row in the customer table without the refresh of the page-->
  <script src="../../database/findRow.js"></script>
  
  <!--stylesheet for the accounts table-->
  <link rel="stylesheet" type="text/css" href="../../database/select/css/aselect_caccounts.css">
</head>
<body>
  <?php
  //include the navigation bar
  include_once "../../navigation_bar/navigation_bar.php";
  
  //session to admin is creating site
  $_SESSION['admin_create_caccount'] = 1;
  ?>
  
  <a href="../../create_account/signup.php">Create Customer Account</a>
  
  
  <?php
  //include the file that will print out all the orders
  include "../../database/select/aselect_caccounts.php";
  list_caccounts();
  ?>
  
  <a href="../admin_cpanel.php">Back</a>
  
  <div id="rowText"></div>
  
  <?php
    //include the footer
    include '../../footer/footer.php';
   ?>
  
</body>
</html>

