<?php
/*********************************************
** shows all the orders that are available  **
**********************************************/
//include file to connect to the database
include '../../database/connectdb.php';
//include file to check errors in sql statements
include '../../database/error_check.php';
//prepare and bind sql statement
$stmt_aorder = $conn->prepare("SELECT * FROM Orders");
//execute the statement
$stmt_aorder->execute();
//store the result
$stmt_aorder->store_result();
//bind the results
$stmt_aorder->bind_result($order_idRow, $order_noRow, $dateRow, $worker_idRow, $customer_idRow, $plan_descriptionRow, $plan_dateRow, $odometer_intakeRow, $school_nameRow, $school_addressRow, $statusRow);
//print out the orders that are available
if ($stmt_aorder->num_rows > 0){
//prints out a table
  echo "<table class='table'>";
    echo "<tr>";
      
      echo "<th>Order Id</th>";
      echo "<th>Order Number</th>";
      echo "<th>Date</th>";
      echo "<th>Worker Id</th>";
      echo "<th>Customer Id</th>";
      echo "<th>Description of Work</th>";
      echo "<th>Date Work is Done</th>";
      echo "<th>Odometer Reading at Intake</th>";
      echo "<th>School Name</th>";
      echo "<th>School Address</th>";
      echo "<th>Status</th>";
      
    echo "</tr>";
  
  while($stmt_aorder->fetch()){
    echo "<tr>";
      echo "<td> <input type='radio' name='order_id' value=" . $order_idRow .">" . $order_idRow . "</td>";
      echo "<td>" . $order_noRow . "</td>";
      echo "<td>" . $dateRow . "</td>";
      echo "<td>" . $worker_idRow . "</td>";
      echo "<td>" . $customer_idRow . "</td>";
      echo "<td>" . $plan_descriptionRow . "</td>";
      echo "<td>" . $plan_dateRow . "</td>";
      echo "<td>" . $odometer_intakeRow . "</td>";
      echo "<td>" . $school_nameRow . "</td>";
      echo "<td>" . $school_addressRow . "</td>";
      echo "<td>" . $statusRow . "</td>";
     
    echo "</tr>";
  }
  
  echo "</table>";
  
//if there are no orders
} else {
  echo "<h3 class='conclusion'>" . "There Are No Orders Available" . "</h3>";
  exit();
}
//close the statment
$stmt_aorder->close();
?>
