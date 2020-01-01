<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}

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
  
