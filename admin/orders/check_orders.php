<?php
//include file to delete the orders
include "../../database/delete/delete_orders.php";

//session to identify if the user is editting a form
$_SESSION['editForm'] = false;
?>
  
<!--the admin control panel section where they can check the orders in the system-->  
  <?php 
  //delete all post checked rows 
  if ($_SERVER['REQUEST_METHOD'] == "POST"){
    
    //if none of the rows are checked
    if (empty($_POST['order_idArr'])){
      echo "<h3>Please select an order</h3>";
    } else {
    
      //delete each selected row
      foreach($_POST['order_idArr'] as $key => $value){
        delete_ordersRow($value);
      }
    }
  }
  
  
  
  //session to identify if the user is editting a form
  $_SESSION['editForm'] = false;
  
  ?>
  
  
  <!--stylesheet for the orders table-->
  <link rel="stylesheet" type="text/css" href="../database/select/css/aselect_orders.css">

  <a href="../worker_cpanel/orders/intake_repair_form.php" class='order'>Create Order</a>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete = "off">

    <?php
     //include the file that will print out all the orders
     include "../../database/select/aselect_orders.php";
    ?>

    <input type="submit" name="delete_order" value="Delete Order">
  </form>
  <div id="rowText"></div>
  <div id="editCheck"></div>
