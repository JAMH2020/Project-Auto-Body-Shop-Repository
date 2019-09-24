<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}
?>

<!--the admin control panel section where they can check the orders in the system-->
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
     include "../../database/select/aselect_orders.php";
    ?>

    <input type="submit" name="delete_order" value="Delete Order">
    <input type="submit" name="modify_order" value="Change Order">
  </form>
</body>
</html>
