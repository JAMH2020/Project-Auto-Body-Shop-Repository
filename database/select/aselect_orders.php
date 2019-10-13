<?php
/*********************************************
** shows all the orders that are available  **
**********************************************/


//include file to connect to the database
include_once '../../database/connectdb.php';

//include file to check errors in sql statements
include_once '../../database/error_check.php';


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
      echo "<th></th>";
      echo "<th></th>";
      
    echo "</tr>";
  
  while($stmt_aorder->fetch()){
    echo "<tr>";
      echo "<td> <input type='checkbox' name='order_idArr[]' value=" . $order_idRow .">" . $order_idRow . "</td>";
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
?>

           <td>
             <a href='#' onclick='findCAccountRow("<?php echo $order_idRow?>", "../../database/select/find_row/find_row_orders.php", "../../worker_cpanel/invoices/invoice.php"); return false;'>Create Invoice</a>
           </td>
           
           <td>
             <a href='#' onclick='editPage("../../database/select/find_row/find_row_orders.php", "../../database/select/find_row/find_row_orders.php", 1); findCAccountRow("<?php echo $order_idRow?>", "../../database/select/find_row/find_row_orders.php", "../../worker_cpanel/orders/intake_repair_form.php"); return false;'>Edit</a>
           </td>


<?php     
    echo "</tr>";
  }
  
  echo "</table>";
  
//if there are no orders
} else {
  echo "<h3 class='conclusion'>" . "There are no orders available" . "</h3>";
  exit();
}





//close the statment
$stmt_aorder->close();
?>
