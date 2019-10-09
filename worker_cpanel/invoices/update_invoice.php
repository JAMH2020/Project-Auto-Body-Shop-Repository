<?php
/**********************************************
** Updates invoice.php  **
***********************************************/

//connect to the database
include_once '../../../database/connectdb.php';

//include file to check for errors in sql statements
include_once '../../../database/error_check.php';


//update invoice table
$stmt_u_cprofiles = $conn->prepare("UPDATE Invoice SET Order_No = ?, Invoice_No = ?, Worker_Id = ?, Invoice_Date = ?, Odometer_Return = ?, Description = ?, Authorization_Date = ?, Completion_Date = ?");
$stmt_u_cprofiles->bind_param("isisisss", $order_no, $invoice_no, $worker_id, $invoice_date, $odometer_return, $done_description, $work_date, $completion_date);

//update cost table
$stmt_u_accounts = $conn->prepare("UPDATE Total_cost SET Invoice_No = ?, Parts_Price_Unit = ?, Labour_Price_Unit = ?, Supplies_Price_Unit = ?, Disposal_Price_Unit = ?, Parts_Total = ?, Labour_Total = ?, Supplies_Total = ?, Disposal_Total = ?, Estimate_Total = ?, Total = ?");
$stmt_u_accounts->bind_param("siiiiiiiiii", $invoice_no, $parts_per_unit, $labour_per_unit, $supplies_per_unit, $disposal_per_unit, $parts_total, $labour_total, $supplies_total, $disposal_total, $estimate_total, $total_cost);


//--------Data to insert into invoice table----//

//order number
$order_no = $_POST['order_no'];

//invoice number
$invoice_no = $_POST['invoice_no'];

//worker id
$worker_id = 1;

//invoice date
$invoice_date = $_POST['invoice_date'];

//odometer reading on the return of the vehicle
$odometer_return = $_POST['odometer_return'];

//description of work done
$done_description = $_POST['done_description'];

//date that work was authorized
$work_date = $_POST['work_date'];

//date the work is completed
$completion_date = $_POST['completion_date'];


//-----------Data to insert into the total cost table---------//

//parts per unit
$parts_per_unit = $_POST['parts_per_unit'];

//labour per unit
$labour_per_unit = $_POST['labour_per_unit'];

//supplies per unit
$supplies_per_unit = $_POST['supplies_per_unit'];

//disposal and recycing per ubnit
$disposal_per_unit = $_POST['disposal_per_unit'];

//total of parts
$parts_total = $_POST['parts_total'];

//total for labour work
$labour_total = $_POST['labour_total'];

//total of supplies used
$supplies_total = $_POST['supplies_total'];

//total of of recycling/disposal fee
$disposal_total = $_POST['disposal_total'];

//estimate of total
$estimate_total = $_POST['estimate_total'];

//total of parts
$total_cost = $_POST['total_cost'];


//execute the insertion for the prepared sql statement
$stmt_u_cprofiles->execute();
$stmt_u_accounts->execute();

//close statements
$stmt_u_cprofiles->close();
$stmt_u_accounts->close();
?>
