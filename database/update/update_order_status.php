<?php
/*************************************************
** Update status of the orders to the database  **
**************************************************/


//connect to the database
include '../../database/connectdb.php';

//include file to check for errors in sql statements
include_once '../../database/error_check.php';


$stmt_u_orders = $conn->prepare("UPDATE Orders SET Status = ? WHERE Order_No = ?");
$stmt_u_orders->bind_param("si", $status, $order_no);


//status
$status = "recorded";

//order no
$order_no = $_SESSION['order_no'];

//execute the statement
$stmt_u_orders->execute();

//close the statement
$stmt_u_orders->close();
?>
