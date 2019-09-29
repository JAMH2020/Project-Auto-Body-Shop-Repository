<?php
/**********************************************
** Update customer accounts to the database  **
***********************************************/


//connect to the database
include_once '../../../database/connectdb.php';

//include file to check for errors in sql statements
include_once '../../../database/error_check.php';

//prepare sql statement to bind
//update customer account table
$stmt_u_caccounts = $conn->prepare("UPDATE Customer_Accounts SET First_name = ?, Last_name = ?, Password = ?, Email = ? WHERE Customer_Id = ?");
$stmt_u_caccounts->bind_param("ssssi", $customer_firstname, $customer_lastname, $customer_password, $customer_email, $customer_id);

//update changes that could affect the customer profile table
$stmt_u_profiles = $conn->prepare("UPDATE Customer_Profile SET Email = ? WHERE Email = ?");
$stmt_u_profiles->bind_param("ss", $customer_pemail, $customer_pemail_prev);
  

//------customer account table-------//
//customer's firstname
$customer_firstname = $_POST['customer_firstname'];

//customer's lastname
$customer_lastname = $_POST['customer_lastname'];

//customer's password
$customer_password = $_POST['customer_password'];

//customer's email
$customer_email = $_POST['customer_email'];

//customer's id
$customer_id = $_SESSION['customer_id'];





//---------customer profile table------//
//customer's email
$customer_pemail = $_POST['customer_email'];

//customer's previous email before change
$customer_pemail_prev = $_SESSION['prev_customer_email'];




//execute the insertion for the prepared sql statement
$stmt_u_caccounts->execute();
$stmt_u_profiles->execute();



//close statements
$stmt_u_caccounts->close();
$stmt_u_profiles->close();
?>
