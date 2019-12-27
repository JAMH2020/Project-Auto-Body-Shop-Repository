<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}
?>


<!--the admin control panel section where they can check the customer profiles in the system-->
<html>
<head>

   <!--JQuery library-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  
  <!--script use to redirect the user to another page-->
  <script src="../../src/js/submit_form.js"></script>
  
  <!--script for finding the value of a certain row in the customer table without the refresh of the page-->
  <script src="../../database/findRow.js"></script>
  
  <!--stylesheet for the profiles table-->
  <link rel="stylesheet" type="text/css" href="../../database/select/css/aselect_cprofiles.css">
</head>
<body>

  <?php
  //include the navigation bar
  include "../../navigation_bar/navigation_bar.php";
  
  //include the file that will print out all the orders
  include "../../database/select/aselect_cprofiles.php";
  ?>
  
  <a href="../admin_cpanel.php">Back</a>
  
  <div id="rowText"></div>
  
  <?php
    //include the footer
    include '../../footer/footer.php';
  ?>
  
</body>
</html>
