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
$stmt_u_cprofiles = $conn->prepare("UPDATE Customer_Profile SET Phone_No = ?, Address = ?, Email = ?, Car_Year = ?,Car_Make = ?, Car_Model = ?, Vin_No = ?, License_Plate = ? WHERE Profile_Id = ?");
$stmt_u_cprofiles->bind_param("sssissssi", $customer_phone, $customer_address, $customer_email, $car_year,$car_make, $car_model, $vin_no, $license_plate, $profile_id);

//update changes that could affect the customer profile table
$stmt_u_accounts = $conn->prepare("UPDATE Customer_Accounts SET Email = ? WHERE Email = ?");
$stmt_u_accounts->bind_param("ss", $customer_cemail, $customer_cemail_prev);
  

//------customer profile account table-------//
//customer's phone number
$customer_phone = $_POST['customer_phone'];

//customer's address
$customer_address = $_POST['customer_address'];

//customer's email
$customer_email = $_POST['customer_email'];

//car year
$car_year = $_POST['car_year'];

//car make
$car_make = $_POST['car_make'];

//car model
$car_model = $_POST['car_model'];

//vin number
$vin_no = $_POST['vin_no'];

//license plate
$license_plate = $_POST['license_plate'];




//profile id
$profile_id = $_SESSION['profile_id'];





//---------customer accounts table------//
//customer's email
$customer_cemail = $_POST['customer_email'];

//customer's previous email before change
$customer_cemail_prev = $_SESSION['prev_customer_email'];




//execute the insertion for the prepared sql statement
$stmt_u_cprofiles->execute();
$stmt_u_accounts->execute();



//close statements
$stmt_u_cprofiles->close();
$stmt_u_accounts->close();
?>

