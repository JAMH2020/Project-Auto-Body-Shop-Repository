<?php
/*********************************************
** shows all the orders that are available  **
**********************************************/


//include file to connect to the database
include_once '../../database/connectdb.php';

//include file to check errors in sql statements
include_once '../../database/error_check.php';


//prepare and bind sql statement
$stmt_aorder = $conn->prepare("SELECT Orders.Order_Id, Orders.Order_No, Orders.Date, Orders.Worker_Id, Worker_Accounts.First_Name, Worker_Accounts.Last_Name, Order_Profile.First_Name, Order_Profile.Last_Name, Customer_Profile.Profile_Id, Orders.Description, Orders.Work_Date, Orders.Odometer_Intake, Orders.School_Name, Orders.School_Address, Orders.Status
                               FROM Orders
                               LEFT JOIN Worker_Accounts
                                 ON Orders.Worker_Id = Worker_Accounts.Worker_Id
                               LEFT JOIN Order_Profile
                                 ON Orders.Order_No = Order_Profile.Order_No
                               LEFT JOIN Customer_Profile
                                 ON Order_Profile.Email = Customer_Profile.Email
                               ORDER BY Orders.Order_Id
                               ");

//execute the statement
$stmt_aorder->execute();

//store the result
$stmt_aorder->store_result();

//bind the results
$stmt_aorder->bind_result($order_idRow, $order_noRow, $dateRow, $worker_idRow, $worker_firstnameRow, $worker_lastnameRow, $customer_firstnameRow, $customer_lastnameRow, $customer_idRow, $plan_descriptionRow, $plan_dateRow, $odometer_intakeRow, $school_nameRow, $school_addressRow, $statusRow);


//print out the orders that are available
if ($stmt_aorder->num_rows > 0){

//prints out a table
  echo "<table class='table'>";
    echo "<tr>";
      
      echo "<th>Order Id</th>";
      echo "<th>Order Number</th>";
      echo "<th>Date</th>";
      echo "<th>Worker</th>";
      echo "<th>Customer</th>";
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
      echo "<td>" . $worker_firstnameRow . " " . $worker_lastnameRow . " #" . $worker_idRow . "</td>";
      echo "<td>" . $customer_firstnameRow . " " . $customer_lastnameRow . " #" . $customer_idRow . "</td>";
      echo "<td>" . $plan_descriptionRow . "</td>";
      echo "<td>" . $plan_dateRow . "</td>";
      echo "<td>" . $odometer_intakeRow . "</td>";
      echo "<td>" . $school_nameRow . "</td>";
      echo "<td>" . $school_addressRow . "</td>";
      echo "<td>" . $statusRow . "</td>";
      
      
      //allow user to create invoice if the status is complete
      if ($statusRow == "complete"){
?>

           <td>
             <a href='#' onclick='findCAccountRow("<?php echo $order_idRow?>", "../../database/select/find_row/find_row_orders.php", "../../worker_cpanel/invoices/invoice.php"); return false;'>Create Invoice</a>
           </td>
          
<?php
      } else {
         echo "<td></td>";
      }
      
      //allow user to edit the order only if its status is not "recorded"
      if ($statusRow != "recorded"){
?>
           
           <td>
             <a href='#' onclick='editPage("../../database/select/find_row/find_row_orders.php", "../../database/select/find_row/find_row_orders.php", 1); findCAccountRow("<?php echo $order_idRow?>", "../../database/select/find_row/find_row_orders.php", "../../worker_cpanel/orders/intake_repair_form.php"); return false;'>Edit</a>
           </td>

<?php
      } else {
?>

           <td>
             <a href='#' onclick='viewPage("../../database/select/find_row/find_row_orders.php", 1); findCAccountRow("<?php echo $order_idRow?>", "../../database/select/find_row/find_row_orders.php", "../../worker_cpanel/orders/intake_repair_form.php"); return false;'>View</a>
           </td>

<?php
      }
      
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
