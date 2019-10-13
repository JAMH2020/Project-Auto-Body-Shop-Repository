<?php
/**************************************************************
** Insert user data from the invoice form into the database  **
***************************************************************/

//connect to the database
include_once '../../database/connectdb.php';

//include file to check for errors in sql statements
include_once '../../database/error_check.php';



//prepare sql statement to bind
//statement to insert into the invoice table
$stmt_invoice = $conn->prepare("INSERT INTO Invoice (Order_No, Invoice_No, Worker_Id, Invoice_Date, Odometer_Return, Description, Authorization_Date, Completion_Date) VALUES (?,?,?,?,?,?,?,?)");
$stmt_invoice->bind_param("isisisss", $order_no, $invoice_no, $worker_id, $invoice_date, $odometer_return, $done_description, $work_date, $completion_date);
  
  
//statement to insert into the total cost table
$stmt_total_cost = $conn->prepare("INSERT INTO Total_Cost (Invoice_No, Parts_Price_Unit, Labour_Price_Unit, Supplies_Price_Unit, Disposal_Price_Unit, Parts_Total, Labour_Total, Supplies_Total, Disposal_Total, Estimate_Total, Total) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
$stmt_total_cost->bind_param("sdddddddddd", $invoice_no, $parts_per_unit, $labour_per_unit, $supplies_per_unit, $disposal_per_unit, $parts_total, $labour_total, $supplies_total, $disposal_total, $estimate_total, $total_cost);


  
//--------Data to insert into invoice table----//
//order number
$order_no = $_SESSION['order_no'];

//invoice number
$invoice_no = $_SESSION['invoice_no'];

//worker id
$worker_id = 1;

//invoice date
$invoice_date = $_SESSION['invoice_date'];

//odometer reading on the return of the vehicle
$odometer_return = $_SESSION['odometer_return'];

//description of work done
$done_description = $_SESSION['done_description'];

//date that work was authorized
$work_date = $_SESSION['work_date'];

//date the work is completed
$completion_date = $_SESSION['completion_date'];


//-----------Data to insert into the total cost table---------//
//parts per unit
$parts_per_unit = $_SESSION['parts_per_unit'];

//labour per unit
$labour_per_unit = $_SESSION['labour_per_unit'];

//supplies per unit
$supplies_per_unit = $_SESSION['supplies_per_unit'];

//disposal and recycing per ubnit
$disposal_per_unit = $_SESSION['disposal_per_unit'];

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
$total_cost = $_SESSION['total_cost'];





//insert the data for the invoice table
insertData($stmt_invoice);


//insert the data for the total cost table
insertData($stmt_total_cost);


$stmt_invoice->close();
$stmt_total_cost->close();
?>
