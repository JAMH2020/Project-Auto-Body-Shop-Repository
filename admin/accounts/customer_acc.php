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
</head>
<body>
  <?php
  //include the navigation bar
  include "../../navigation_bar/navigation_bar.php";
  ?>
  
  
  
  <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete = "off">

    <?php
     //include the file that will print out all the orders
     include "../../database/select/aselect_caccounts.php";
    ?>
    
    <input type="submit" name="modify_waccounts" value="Change Account">
  </form>
  
  <a href="../admin_cpanel.php">Back</a>
  
</body>
</html>
