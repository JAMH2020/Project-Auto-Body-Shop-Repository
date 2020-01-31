<?php
/*************************************************************
** Insert user data from the signup page into the database  **
**************************************************************/


//connect to the database
include '../database/connectdb.php';

//include file to check for errors in sql statements
include_once '../database/error_check.php';

//prepare sql statement to bind
$stmt_wsignup = $conn->prepare("INSERT INTO Worker_Accounts (First_Name, Last_Name, Password, Email) VALUES (?, ?, ?, ?)");
$stmt_wsignup->bind_param("ssss", $worker_firstname, $worker_lastname, $worker_password, $worker_email);
  

//worker's firstname
$worker_firstname = $_POST['worker_firstname'];

//worker's lastname
$worker_lastname = $_POST['worker_lastname'];

//customer's password
$worker_password = $_POST['worker_password'];

//worker's email
$worker_email = $_POST['worker_email'];


//execute the insertion for the prepared sql statement
insertData($stmt_wsignup);

$stmt_wsignup->close();


?>
