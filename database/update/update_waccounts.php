<?php
/**********************************************
** Update worker accounts to the database    **
***********************************************/


//connect to the database
include '../../../database/connectdb.php';

//include file to check for errors in sql statements
include_once '../../../database/error_check.php';

//prepare sql statement to bind
//update customer account table
$stmt_u_waccounts = $conn->prepare("UPDATE Worker_Accounts SET First_name = ?, Last_name = ?, Password = ?, Email = ? WHERE Worker_Id = ?");
$stmt_u_waccounts->bind_param("ssssi", $worker_firstname, $worker_lastname, $worker_password, $worker_email, $worker_id);
  

//------customer account table-------//
//customer's firstname
$worker_firstname = $_POST['worker_firstname'];

//customer's lastname
$worker_lastname = $_POST['worker_lastname'];

//customer's password
$worker_password = $_POST['worker_password'];

//customer's email
$worker_email = $_POST['worker_email'];

//customer's id
$worker_id = $_SESSION['worker_id'];




//execute the insertion for the prepared sql statement
$stmt_u_waccounts->execute();



//close statements
$stmt_u_waccounts->close();
?>
