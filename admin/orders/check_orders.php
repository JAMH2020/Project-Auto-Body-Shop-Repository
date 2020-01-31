<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}
?>

<!--script use to redirect the user to another page-->
<script src="../../src/js/submit_form.js"></script>

<?php

//include file to delete the orders
include "../../database/delete/delete_orders.php";

//session to identify if the user is editting a form
$_SESSION['editForm'] = false;

//session to tell which tab they are currently on
$_SESSION['admin_section'] = "orders";
?>
  
<!--the admin control panel section where they can check the orders in the system-->  
  <?php 
  //delete all post checked rows 
  if ($_SERVER['REQUEST_METHOD'] == "POST"){
    
    //if none of the rows are checked
    if (empty($_POST['order_idArr'])){
      $_SESSION['error_notification'] = "Please Select An Order to Delete";
    } else {
    
      //delete each selected row
      foreach($_POST['order_idArr'] as $key => $value){
        delete_ordersRow($value);
      }
      
      $_SESSION['order_done'] = "delete";
    }
  }
  
  
  
  //session to identify if the user is editting a form
  $_SESSION['editForm'] = false;
  
  
  //if the delete button is not pressed yet
  if (!isset($_POST['delete_order'])){
  ?>
  
  
  <!--stylesheet for the orders table-->
  <link rel="stylesheet" type="text/css" href="../database/select/css/aselect_orders.css">
  
  <h2 class="section_title">ORDERS</h2>
  
  <div class="create_link">
    <a href="../worker_cpanel/orders/intake_repair_form.php" class='create'>Create Order</a>
    <div class="create_underline"></div>
  </div>
  
  <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete = "off">

    <?php
     //include the file that will print out all the orders
     include "../../database/select/aselect_orders.php";
    ?>
    <div class="delete_align">
      <input type="submit" class="delete" name="delete_order" value="Delete Order">
    </div>
  </form>
  <div id="rowText"></div>
  
  <?php
  //redirect to the admin control panel
  } else {
  
    $_SESSION['admin_section'] = "orders";
  ?>

  <script>redirect_page('../admin_cpanel.php'); </script>

  <?php
  } 
  ?>
  
