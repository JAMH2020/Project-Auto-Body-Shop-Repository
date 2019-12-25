<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}
?>

<!--the admin control panel section where they can check the worker accounts in the system-->
<html>
<head>
  <!--JQuery library-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <!--script use to redirect the user to another page-->
  <script src="../../src/js/submit_form.js"></script>
  
  <!--script for finding the value of a certain row in the customer table without the refresh of the page-->
  <script src="../../database/findRow.js"></script>
</head>
<body>
  <?php
  //include the navigation bar
  include "../../navigation_bar/navigation_bar.php";
  ?>
  
  <a href="../../create_account/worker_signup.php">Create Worker Account</a>
  
  <?php
  //include the file that will print out all the orders
  include "../../database/select/aselect_waccounts.php";
  list_waccounts();
  ?>

  
  <a href="../admin_cpanel.php">Back</a>
  
  <div id="rowText"></div>
  
</body>
</html>
