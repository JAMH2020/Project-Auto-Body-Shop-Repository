<?php
/********************************************************
** shows all the orders of the worker who is logged on **
*********************************************************/

//include file to connect to the database
include_once '../database/connectdb.php';



//include file to check errors in sql statements
include_once '../database/error_check.php';



//prepare and bind sql statement
//inner join the customer accounts table into the orders table in order to get the customer's name using the customer id as the key
$stmt_orders1 = $conn->prepare("SELECT Orders.Order_Id, Orders.Order_No, Orders.Date, Customer_Accounts.First_Name, Customer_Accounts.Last_Name, Orders.Description, Orders.Work_Date, Orders.Odometer_Intake, Orders.School_Name, Orders.School_Address, Orders.Status
                                FROM Orders
                                INNER JOIN Customer_Accounts ON Orders.Customer_Id=Customer_Accounts.Customer_Id
                                WHERE Orders.Worker_Id = ?");

$stmt_orders1->bind_param("i", $worker_id);

//worker id from the sessions in the login
$worker_id = 1;

//execute the prepared statement
$stmt_orders1->execute();

//store the selected result
$stmt_orders1->store_result();

//bind the selected results
$stmt_orders1->bind_result($order_idRow, $order_noRow, $dateRow, $customer_firstnameRow, $customer_lastnameRow, $plan_descriptionRow, $plan_dateRow, $odometer_intakeRow, $school_nameRow, $school_addressRow, $statusRow);





//prints out the orders if there are any
if ($stmt_orders1->num_rows > 0){

  //print table out
  echo "<table class='table'>";

    echo "<tr>";
    
      echo "<th>Order Number</th>";
      echo "<th>Date</th>";
      echo "<th>Customer Name</th>";
      echo "<th>Description of Work</th>";
      echo "<th>Date Work is Done</th>";
      echo "<th>Odometer Reading at Intake</th>";
      echo "<th>School Name</th>";
      echo "<th>School Address</th>";
      echo "<th>Status</th>";
      echo "<th></th>";
      
    echo "</tr>";

  //print out the details of each order
  while ($stmt_orders1->fetch()){
   echo "<tr>";
     echo "<td>" . $order_noRow . "</td>";
     echo "<td>" . $dateRow . "</td>";
     echo "<td>" . $customer_firstnameRow . " " . $customer_lastnameRow . "</td>";
     echo "<td>" . $plan_descriptionRow . "</td>";
     echo "<td>" . $plan_dateRow . "</td>";
     echo "<td>" . $odometer_intakeRow . "</td>";
     echo "<td>" . $school_nameRow . "</td>";
     echo "<td>" . $school_addressRow . "</td>";
     echo "<td>" . $statusRow . "</td>";
?>
           <td>
             <a href='#' onclick='findCAccountRow("<?php echo $order_idRow?>", "../database/select/find_row/find_row_orders.php", "invoices/invoice.php"); return false;'>Create Invoice</a>
           </td>

<?php
   echo "</tr>";
  }
  
  echo "</table>";
  echo "<div id='rowText'></div>";

//if there are no orders for the specific id
} else {
  echo "<h3 class='conclusion'>" . "There Are No Orders Available" . "</h3>";
  exit();
}

//close the statement
$stmt_orders1->close();

?>
