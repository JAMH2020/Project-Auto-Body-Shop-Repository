<?php
//include file to connect to the database
include_once '../../database/connectdb.php';

//include file to check errors in sql statements
include_once '../../database/error_check.php';



function delete_ordersRow($value){

  //-----prepare and bind sql statement-------//
  //delete orders from order table
  $stmt_a_orders = $GLOBALS['conn']->prepare("DELETE FROM Orders WHERE Order_Id = ?");
  $stmt_a_orders->bind_param("i", $order_idDelete);
  
  
  //get the order number to delete
  $stmt_get_ordnum = $GLOBALS['conn']->prepare("SELECT Order_No FROM Orders WHERE Order_Id = ?");
  //prepare and bind sql statement
  $stmt_get_ordnum->bind_param("i", $order_idDelete);
  
  //delete estimate cost of the order form the estimate cost table
  $stmt_a_estimate = $GLOBALS['conn']->prepare("DELETE FROM Estimate_Cost WHERE Order_No = ?");
  $stmt_a_estimate->bind_param("i", $order_noDelete);


  
  //order id value
  $order_idDelete = $value;
  
  
  
  //execute the statement to find the order number
  $stmt_get_ordnum->execute();

  //store the result
  $stmt_get_ordnum->store_result();

  //bind the results
  $stmt_get_ordnum->bind_result($order_noRow);
  
  
  //get the value of the order number
  if ($stmt_get_ordnum->num_rows > 0){

    while($stmt_get_ordnum->fetch()){
      $order_noDelete = $order_noRow;
    }
  }



  //execute the statement to delete the order
  $stmt_a_orders->execute();
  
  //execute the statement to delete the estimate cost
  $stmt_a_estimate->execute();

  //close the statements
  $stmt_a_orders->close();
  $stmt_a_estimate->close();
}
