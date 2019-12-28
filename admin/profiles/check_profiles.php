<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}
?>


  <!--the admin control panel section where they can check the customer profiles in the system-->
  
  <!--stylesheet for the profiles table-->
  <link rel="stylesheet" type="text/css" href="../../database/select/css/aselect_cprofiles.css">

  <?php
  //include the file that will print out all the orders
  include "../../database/select/aselect_cprofiles.php";
  ?>
  
  <div id="rowText"></div>
  
