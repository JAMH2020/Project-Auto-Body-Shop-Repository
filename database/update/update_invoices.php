<?php
/**********************************************
** Updates invoice.php                       **
***********************************************/

//connect to the database
include '../../database/connectdb.php';

//include file to check for errors in sql statements
include_once '../../database/error_check.php';


//prepare SQL statement to bind
//update invoices table
$stmt_u_invoices = $conn->prepare("UPDATE Invoice SET Order_No = ?, Worker_Id = ?, Invoice_No = ?, Invoice_Date = ?, Odometer_Return = ?, Description = ?, Authorization_Date = ?, Completion_Date = ? WHERE Invoice_Id = ?");
$stmt_u_invoices->bind_param("iississsi", $order_no, $worker_id, $invoice_no, $invoice_date, $odometer_return, $description, $authorization_date, $completion_date, $invoice_id);

//update total cost table
$stmt_u_tcost = $conn->prepare("UPDATE Total_Cost SET Invoice_No = ?, Parts_Price_Unit = ?, Labour_Price_Unit = ?, Supplies_Price_Unit = ?, Disposal_Price_Unit = ?, Parts_Total = ?, Labour_Total = ?, Supplies_Total = ?, Disposal_Total = ?, Estimate_Total = ?, Total = ? WHERE Invoice_No = ?");
$stmt_u_tcost->bind_param("sdddddddddds", $invoice_no, $parts_price_unit, $labour_price_unit, $supplies_price_unit, $disposal_price_unit, $parts_total, $labour_total, $supplies_total, $disposal_total, $estimate_total, $total, $prev_invoice_no);



//--------Data to insert into invoice table----//

//order number
$order_no = $_SESSION['order_no'];



//if the user is the admin
if ($_SESSION['admin_loggedin']){
  //get the new worker id
  include_once "../../database/select/aselect_waccounts.php";
  $worker_id = get_waccounts_id($conn);

// if the user is the worker
} else {

  //worker id
  $worker_id = $_SESSION['worker_id'];
}


//invoice number
$invoice_no = $_SESSION['invoice_no'];

//invoice date
$invoice_date = $_SESSION['invoice_date'];

//odometer reading on the return of the vehicle
$odometer_return = $_SESSION['odometer_return'];

//description of work done
$description = $_SESSION['done_description'];

//authorization date
$authorization_date = $_SESSION['completion_date'];

//completion date
$completion_date = $_SESSION['return_date'];

//invoice_id
$invoice_id = $_SESSION['invoice_id'];


//-----------Data to insert into the total cost table---------//

//parts per unit
$parts_price_unit = $_SESSION['parts_per_unit'];

//labour per unit
$labour_price_unit = $_SESSION['labour_per_unit'];

//supplies per unit
$supplies_price_unit = $_SESSION['supplies_per_unit'];

//disposal and recycing per ubnit
$disposal_price_unit = $_SESSION['disposal_per_unit'];

//total of parts
$parts_total = $_SESSION['parts_total'];

//total for labour work
$labour_total = $_SESSION['labour_total'];

//total of supplies used
$supplies_total = $_SESSION['supplies_total'];

//total of of recycling/disposal fee
$disposal_total = $_SESSION['disposal_total'];

//estimate of total
$estimate_total = $_SESSION['estimate_total'];

//total of parts
$total = $_SESSION['total_cost'];



//previous invoice number
$prev_invoice_no = $_SESSION['prev_invoice_no'];





//execute the insertion for the prepared sql statement
$stmt_u_invoices->execute();
$stmt_u_tcost->execute();

//close statements
$stmt_u_invoices->close();
$stmt_u_tcost->close();



//set all session variables for invoice to blank
include "../../src/clear_sessions.php";

clear_invoice();
?>

