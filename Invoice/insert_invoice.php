<?php
/*************************************************************
** Insert user data from the signup page into the database  **
**************************************************************/
//connect to the database
include '../database/connectdb.php';
//include file to check for errors in sql statements
include '../database/error_check.php';
//prepare sql statement to bind
$stmt_signup = $conn->prepare("INSERT INTO Customer_Accounts (First_Name, Last_Name, Password, Email) VALUES (?, ?, ?, ?)");
$stmt_signup->bind_param("ssss", $customer_firstname, $customer_lastname, $customer_password, $customer_email);
  
//customer's firstname
$customer_firstname = $_POST['customer_firstname'];
//customer's lastname
$customer_lastname = $_POST['customer_lastname'];
//customer's password
$customer_password = $_POST['customer_password'];
//customer's email
$customer_email = $_POST['customer_email'];
//execute the insertion for the prepared sql statement
insertData($stmt_signup);
$stmt_signup->close();
?>
