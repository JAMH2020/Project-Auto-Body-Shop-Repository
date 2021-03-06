<?php
/******************************************
** shows all the invoices that are done  **
*******************************************/


//include file to connect to the database
include_once '../database/connectdb.php';

//include file to check errors in sql statements
include_once '../database/error_check.php';


//prepare and bind sql statement
$stmt_invoice = $conn->prepare("SELECT * FROM Invoice WHERE Worker_Id = ?
                                 ORDER BY Invoice_No DESC");
$stmt_invoice->bind_param("i", $worker_id);


//worker id from the sessions in the login
$worker_id = $_SESSION['worker_id'];

//execute the statement
$stmt_invoice->execute();

//store the result
$stmt_invoice->store_result();

//bind the results
$stmt_invoice->bind_result($invoice_idRow, $order_noRow, $worker_idRow, $invoice_noRow, $invoice_dateRow, $odometer_returnRow, $descriptionRow, $authorization_dateRow, $completion_dateRow);


//print out the orders that are available
if ($stmt_invoice->num_rows > 0){

//prints out a table
  echo "<table class='table'>";
    echo "<tr>";
      
      echo "<th>Invoice Number</th>";
      echo "<th>Order Number</th>";
      echo "<th>Invoice Date</th>";
      echo "<th>Odometer Return Value</th>";
      echo "<th>Description of Work Done</th>";
      echo "<th>Date of Completion of Work</th>";
      echo "<th>Date Vehicle is Returned</th>";
      echo "<th></th>";

    echo "</tr>";
  
  while($stmt_invoice->fetch()){
    echo "<tr>";
      echo "<td>" . $invoice_noRow . "</td>";
      echo "<td>" . $order_noRow . "</td>";
      echo "<td>" . $invoice_dateRow . "</td>";
      echo "<td>" . $odometer_returnRow . "</td>";
      echo "<td>" . $descriptionRow . "</td>";
      echo "<td>" . $authorization_dateRow . "</td>";
      echo "<td>" . $completion_dateRow . "</td>";
?>

            <td>
              <a href='#' onclick='editPage("../database/select/find_row/find_row_invoices.php", "../database/select/find_row/find_row_invoices.php", 1); findCAccountRow("<?php echo $invoice_idRow; ?>", "../database/select/find_row/find_row_invoices.php", "../worker_cpanel/invoices/invoice.php"); return false;'>Edit</a>
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
$stmt_invoice->close();
?>
