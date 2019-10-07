<?php
/*********************************************************************
** find values of a specific order_id to be used to make an invoice **
**********************************************************************/

//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}

//include file to connect to the database
include_once '../../connectdb.php';

//include file to check errors in sql statements
include_once '../../error_check.php';


//prepare and bind sql statement
//get the row from the orders table
$stmt_find_orders = $conn->prepare("SELECT * FROM Orders WHERE Order_Id = ?");
$stmt_find_orders->bind_param("i",$order_find_id);

//get the row from the customer accounts table
$stmt_find_caccounts = $conn->prepare("SELECT * FROM Customer_Accounts WHERE Customer_Id = ?");
$stmt_find_caccounts->bind_param("i",$customer_find_id);

//get the row from the customer profile table
$stmt_find_profiles = $conn->prepare("SELECT * FROM Customer_Profile WHERE Email = ?");
$stmt_find_profiles->bind_param("i",$profile_find_email);

//get the row from the estimate cost table
$stmt_find_estimate = $conn->prepare("SELECT Total_Cost, Removal_Choice FROM Estimate_Cost WHERE Order_No = ?");
$stmt_find_estimate->bind_param("i",$estimate_find_id);



//get the order id using AJAX
$order_find_id = $_POST['rowId'];

//execute the statement
$stmt_find_orders->execute();

//store the result
$stmt_find_orders->store_result();

//bind the results
$stmt_find_orders->bind_result($order_idRow, $order_noRow, $order_dateRow, $worker_idRow, $customer_idRow, $plan_descriptionRow, $work_dateRow, $odometer_intakeRow, $school_nameRow, $school_addressRow, $statusRow);




//store the values of the row into sessions
if ($stmt_find_orders->num_rows > 0){

  while($stmt_find_orders->fetch()){
    //store the values into sessions
    
    //--------Orders Table----------//
    //order id
    $_SESSION['order_id'] = $order_idRow;
 
    //order number
    $_SESSION['order_no'] = $order_noRow;
    
    //date the order was made
    $_SESSION['order_date'] = $order_dateRow;
    
    //worker id
    $_SESSION['worker_id'] = $worker_idRow;
    
    //customer's id
    $_SESSION['customer_id'] = $customer_idRow;
    
    //description of the work that is being don
    $_SESSION['plan_description'] = $plan_descriptionRow;
    
    //date the job was done
    $_SESSION['work_date'] = $work_dateRow;
    
    //odometer intake
    $_SESSION['odometer_intake'] = $odometer_intakeRow;
    
    //school name
    $_SESSION['school_name'] = $school_nameRow;
    
    //school address
    $_SESSION['school_address'] = $school_addressRow;
    
    //status of the order
    $_SESSION['status'] = $statusRow;
    

   }
} else {
  echo "<p>nothing</p>";
}




//get the customer id from sessions
$customer_find_id = $_SESSION['customer_id'];


//execute the statement for getting values from customer account
$stmt_find_caccounts->execute();

//store the result
$stmt_find_caccounts->store_result();

//bind the results
$stmt_find_caccounts->bind_result($customer_idRow, $customer_firstnameRow, $customer_lastnameRow, $customer_passwordRow, $customer_emailRow);

//store the values of the row into sessions
if ($stmt_find_caccounts->num_rows > 0){

  while($stmt_find_caccounts->fetch()){
    //store the values into sessions
    //-----customer accounts table-----//
    
     //customer firstname
    $_SESSION['customer_firstname'] = $customer_firstnameRow;
    
     //customer lastname
    $_SESSION['customer_lastname'] = $customer_lastnameRow;
    
     //customer's password
    $_SESSION['customer_password'] = $customer_passwordRow;
    
     //customer's email
    $_SESSION['customer_email'] = $customer_emailRow;
    }
 }




//get the email to link the customer profile table using sessions
$profile_find_email = $_SESSION['customer_email'];


//execute the statement for getting values from customer account
$stmt_find_profiles->execute();

//store the result
$stmt_find_profiles->store_result();

//bind the results
$stmt_find_profiles->bind_result($profile_idRow, $customer_phoneRow, $customer_addressRow, $customer_emailRow, $car_makeRow, $car_modelRow, $vin_noRow, $license_plateRow);

//store the values of the row into sessions
if ($stmt_find_profiles->num_rows > 0){

  while($stmt_find_profiles->fetch()){
    //store the values into sessions
    //-----customer profiles table-----//
    
     //profile id
    $_SESSION['profile_id'] = $profile_idRow;
    
     //customer's phone number
    $_SESSION['customer_phone'] = $customer_phoneRow;
    
     //customer's address
    $_SESSION['customer_address'] = $customer_addressRow;
    
     //car make
    $_SESSION['car_make'] = $car_makeRow;
    
    //car model
    $_SESSION['car_model'] = $car_modelRow;
    
    //vin number
    $_SESSION['vin_no'] = $vin_noRow;
    
    //license plate number
    $_SESSION['license_plate'] = $license_plateRow;
    }
 }




//get the corresponding order number from sessions
$estimate_find_id = $_SESSION['order_no'];


//execute the statement for getting values from the estimate cost table
$stmt_find_estimate->execute();

//store the result
$stmt_find_estimate->store_result();

//bind the results
$stmt_find_estimate->bind_result($estimate_totalRow, $removal_choiceRow);

//store the values of the row into sessions
if ($stmt_find_estimate->num_rows > 0){

  while($stmt_find_estimate->fetch()){
    //store the values into sessions
    //-----estimate cost table-----//
    
     //estimate total
    $_SESSION['estimate_total'] = $estimate_totalRow;
    
     //removal choice selected
    $_SESSION['removal_choice'] = $removal_choiceRow;
    
    }
 }




echo "<p>o_id:" .  $_SESSION['order_id'] . "</p>";
echo "<p>o_no.:" .  $_SESSION['order_no'] . "</p>";
echo "<p>o_date:" .  $_SESSION['order_date'] . "</p>";
echo "<p>o_workid:" .  $_SESSION['worker_id'] . "</p>";
echo "<p>o_customerid:" .  $_SESSION['customer_id'] . "</p>";
echo "<p>o_plandescription:" .  $_SESSION['plan_description'] . "</p>";
echo "<p>o_workdate:" .  $_SESSION['work_date'] . "</p>";
echo "<p>o_odometerIn:" .  $_SESSION['odometer_intake'] . "</p>";
echo "<p>o_school_name:" .  $_SESSION['school_name'] . "</p>";
echo "<p>o_school_add:" .  $_SESSION['school_address'] . "</p>";
echo "<p>o_status:" .  $_SESSION['status'] . "</p><br><br>";


echo "<p>c_firstname:" .  $_SESSION['customer_firstname'] . "</p>";
echo "<p>c_lastname:" .  $_SESSION['customer_lastname'] . "</p>";
echo "<p>c_email:" .  $_SESSION['customer_email'] . "</p>";
echo "<p>c_password:" .  $_SESSION['customer_password'] . "</p><br><br>";


echo "<p>p_id:" .  $_SESSION['profile_id'] . "</p>";
echo "<p>p_phone:" .  $_SESSION['customer_phone'] . "</p>";
echo "<p>p_addres:" .  $_SESSION['customer_address'] . "</p>";
echo "<p>p_make:" .  $_SESSION['car_make'] . "</p>";
echo "<p>p_model:" .  $_SESSION['car_model'] . "</p>";
echo "<p>p_vin:" .  $_SESSION['vin_no'] . "</p>";
echo "<p>p_license:" .  $_SESSION['license_plate'] . "</p> <br><br>";


echo "<p>e_total:" .  $_SESSION['estimate_total'] . "</p>";
echo "<p>e_choice:" .  $_SESSION['removal_choice'] . "</p>";


//close the statement
$stmt_find_orders->close();
$stmt_find_caccounts->close();
$stmt_find_profiles->close();
?>