<?php
/******************************************
** shows all the invoices that are done  **
*******************************************/


//include file to connect to the database
include_once '../../database/connectdb.php';

//include file to check errors in sql statements
include_once '../../database/error_check.php';


//prepare and bind sql statement
$stmt_ainvoice = $conn->prepare("SELECT Invoice.Invoice_Id, Invoice.Order_No, Invoice.Worker_Id, Worker_Accounts.First_Name, Worker_Accounts.Last_Name, Invoice.Invoice_No, Invoice.Invoice_Date, Invoice.Odometer_Return, Invoice.Description, Invoice.Authorization_Date, Invoice.Completion_Date 
                                 FROM Invoice
                                 LEFT JOIN Worker_Accounts
                                   ON Invoice.Worker_Id = Worker_Accounts.Worker_Id
                                 ORDER BY Invoice.Invoice_Id");

//execute the statement
$stmt_ainvoice->execute();

//store the result
$stmt_ainvoice->store_result();

//bind the results
$stmt_ainvoice->bind_result($invoice_idRow, $order_noRow, $worker_idRow, $worker_firstnameRow, $worker_lastnameRow, $invoice_noRow, $invoice_dateRow, $odometer_returnRow, $descriptionRow, $authorization_dateRow, $completion_dateRow);


//print out the orders that are available
if ($stmt_ainvoice->num_rows > 0){

//prints out a table
  echo "<table class='table'>";
    echo "<tr>";
      
      echo "<th>Invoice Id</th>";
      echo "<th>Invoice Number</th>";
      echo "<th>Order Number</th>";
      echo "<th>Worker</th>";
      echo "<th>Invoice Date</th>";
      echo "<th>Odometer Return Value</th>";
      echo "<th>Description of Work Done</th>";
      echo "<th>Date of Completion of Work</th>";
      echo "<th>Date Vehicle is Returned</th>";
      echo "<th></th>";

    echo "</tr>";
  
  while($stmt_ainvoice->fetch()){
    echo "<tr>";
      echo "<td>" . $invoice_idRow . "</td>";
      echo "<td>" . $invoice_noRow . "</td>";
      echo "<td>" . $order_noRow . "</td>";
      echo "<td>" . $worker_firstnameRow . " " . $worker_lastnameRow . " #" . $worker_idRow . "</td>";
      echo "<td>" . $invoice_dateRow . "</td>";
      echo "<td>" . $odometer_returnRow . "</td>";
      echo "<td>" . $descriptionRow . "</td>";
      echo "<td>" . $authorization_dateRow . "</td>";
      echo "<td>" . $completion_dateRow . "</td>";
?>

            <td>
              <a href='#' onclick='editPage("../../database/select/find_row/find_row_invoices.php", "../../database/select/find_row/find_row_invoices.php", 1); findCAccountRow("<?php echo $invoice_idRow; ?>", "../../database/select/find_row/find_row_invoices.php", "../../worker_cpanel/invoices/invoice.php"); return false;'>Edit</a>
            </td>

<?php
     
    echo "</tr>";
  }
  
  echo "</table>";
  
//if there are no orders
} else {
  echo "<h3 class='conclusion'>". "There are no invoices available" . "</h3>";
  exit();
}





//close the statment
$stmt_ainvoice->close();
?>
