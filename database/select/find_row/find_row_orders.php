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

//get the row from the customer profile table
$stmt_find_profiles = $conn->prepare("SELECT * FROM Order_Profile WHERE Order_No = ?");
$stmt_find_profiles->bind_param("i",$profile_find_order_no);

//get the row from the estimate cost table
$stmt_find_estimate = $conn->prepare("SELECT * FROM Estimate_Cost WHERE Order_No = ?");
$stmt_find_estimate->bind_param("i",$estimate_find_id);

//get the row from worker accounts table
$stmt_find_waccounts = $conn->prepare("SELECT * FROM Worker_Accounts WHERE Worker_Id = ?");
$stmt_find_waccounts->bind_param("i",$worker_find_id);


//get the order id using AJAX
$order_find_id = $_POST['rowId'];

//execute the statement
$stmt_find_orders->execute();

//store the result
$stmt_find_orders->store_result();

//bind the results
$stmt_find_orders->bind_result($order_idRow, $order_noRow, $order_dateRow, $worker_idRow, $plan_descriptionRow, $work_dateRow, $odometer_intakeRow, $school_nameRow, $school_addressRow, $statusRow);




//store the values of the row into sessions
if ($stmt_find_orders->num_rows > 0){

  while($stmt_find_orders->fetch()){
    //store the values into sessions
    
    //--------Orders Table----------//
    //order id
    $_SESSION['order_id'] = $order_idRow;
 
    //order number
    $_SESSION['order_no'] = $_SESSION['prev_order_no'] = $order_noRow;
    
    //date the order was made
    $_SESSION['order_date'] = $order_dateRow;
    
    //worker id
    $_SESSION['worker_id'] = $worker_idRow;
    
    //description of the work that is being don
    $_SESSION['plan_description'] = $plan_descriptionRow;
    
    //date the job was done
    $_SESSION['plan_date'] = $work_dateRow;
    
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






//get the order number from sessions
$profile_find_order_no = $_SESSION['order_no'];


//execute the statement for getting values from customer account
$stmt_find_profiles->execute();

//store the result
$stmt_find_profiles->store_result();

//bind the results
$stmt_find_profiles->bind_result($profile_order_no, $customer_firstname, $customer_lastname, $customer_phoneRow, $customer_addressRow, $customer_emailRow, $car_yearRow, $car_makeRow, $car_modelRow, $vin_noRow, $license_plateRow);

//store the values of the row into sessions
if ($stmt_find_profiles->num_rows > 0){

  while($stmt_find_profiles->fetch()){
    //store the values into sessions
    //-----customer profiles table-----//
    
    //customer's firstname
    $_SESSION['customer_firstname'] = $customer_firstname;
    
    //customer's lastname
    $_SESSION['customer_lastname'] = $customer_lastname;
    
     //customer's phone number
    $_SESSION['customer_phone'] = $customer_phoneRow;
    
     //customer's address
    $_SESSION['customer_address'] = $customer_addressRow;
    
    //customer's email
    $_SESSION['customer_email'] = $customer_emailRow;
    
    //car year
    $_SESSION['car_year'] = $car_yearRow;
    
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
$stmt_find_estimate->bind_result($order_noRow, $estimate_dateRow, $estimate_date_expiryRow, $estimate_parts_unitRow, $estimate_labour_unitRow, $estimate_supplies_unitRow, $estimate_disposal_unitRow, $estimate_parts_totalRow, $estimate_labour_totalRow, $estimate_supplies_totalRow, $estimate_disposal_totalRow, $estimate_total_costRow, $exceed_costRow, $removal_choiceRow, $customer_initialRow);

//store the values of the row into sessions
if ($stmt_find_estimate->num_rows > 0){

  while($stmt_find_estimate->fetch()){
    //store the values into sessions
    //-----estimate cost table-----//
    //estimate date selected
    $_SESSION['estimate_date'] = $estimate_dateRow;
    
    //date of expiry of the estimate date selected
    $_SESSION['estimate_expiry_date'] = $estimate_date_expiryRow;
    
    //estimate of parts per unit selected
    $_SESSION['estimate_parts_per_unit'] = $estimate_parts_unitRow;
    
    //estimate of labour per unit selected
    $_SESSION['estimate_labour_per_unit'] = $estimate_labour_unitRow;
    
    //estimate of supplies per unit selected
    $_SESSION['estimate_supplies_per_unit'] = $estimate_supplies_unitRow;
    
    //estimate of disposal/recycling per unit selected
    $_SESSION['estimate_disposal_per_unit'] = $estimate_disposal_unitRow;
    
    //estimate of total parts selected
    $_SESSION['estimate_parts_total'] = $estimate_parts_totalRow;
    
    //estimate of total labour selected
    $_SESSION['estimate_labour_total'] = $estimate_labour_totalRow;
    
    //estimate of total supplies selected
    $_SESSION['estimate_supplies_total'] = $estimate_supplies_totalRow;
    
    //estimate of total disposal selected
    $_SESSION['estimate_disposal_total'] = $estimate_disposal_totalRow;
    
     //estimate total
    $_SESSION['estimate_total_cost'] = $estimate_total_costRow;
    
    //exceed cost
    $_SESSION['exceed_cost'] = $exceed_costRow;
    
     //removal choice selected
    $_SESSION['removal_choice'] = $removal_choiceRow;
    
    //custooer initial
    $_SESSION['customer_initial'] = $customer_initialRow;
    
    }
 }
 
 
 
//get the worker id from sessions
$worker_find_id = $_SESSION['worker_id'];



//execute the statement for getting values from worker account
$stmt_find_waccounts->execute();

//store the result
$stmt_find_waccounts->store_result();

//bind the results
$stmt_find_waccounts->bind_result($worker_idRow, $worker_firstnameRow, $worker_lastnameRow, $worker_passwordRow, $worker_emailRow);

//store the values of the row into sessions
if ($stmt_find_waccounts->num_rows > 0){

  while($stmt_find_waccounts->fetch()){
  
    //worker id
    $_SESSION['worker_id'] = $worker_idRow;
  
    //worker firstname
    $_SESSION['worker_firstname'] = $worker_firstnameRow;
  
    //worker lastname
    $_SESSION['worker_lastname'] = $worker_lastnameRow;
  
    //worker password
    $_SESSION['worker_password'] = $worker_passwordRow;
  
    //worker email
    $_SESSION['worker_email'] = $worker_emailRow;
  }
}




//edit orders if the user pressed the edit button
if ($_POST['editForm'] == "1"){
  $_SESSION['editForm'] = true;
  
} else if ($_POST['editForm'] == "0"){
  $_SESSION['editForm'] = false;
}



echo "<p>o_id:" .  $_SESSION['order_id'] . "</p>";
echo "<p>o_no.:" .  $_SESSION['order_no'] . "</p>";
echo "<p>o_date:" .  $_SESSION['order_date'] . "</p>";
echo "<p>o_workid:" .  $_SESSION['worker_id'] . "</p>";
echo "<p>o_plandescription:" .  $_SESSION['plan_description'] . "</p>";
echo "<p>o_workdate:" .  $_SESSION['plan_date'] . "</p>";
echo "<p>o_odometerIn:" .  $_SESSION['odometer_intake'] . "</p>";
echo "<p>o_school_name:" .  $_SESSION['school_name'] . "</p>";
echo "<p>o_school_add:" .  $_SESSION['school_address'] . "</p>";
echo "<p>o_status:" .  $_SESSION['status'] . "</p><br><br>";


echo "<p>c_firstname:" .  $_SESSION['customer_firstname'] . "</p>";
echo "<p>c_lastname:" .  $_SESSION['customer_lastname'] . "</p>";
echo "<p>c_email:" . $_SESSION['customer_email'] . "</p><br><br>";


echo "<p>p_phone:" .  $_SESSION['customer_phone'] . "</p>";
echo "<p>p_addres:" .  $_SESSION['customer_address'] . "</p>";
echo "<p>p_year:" .  $_SESSION['car_year'] . "</p>";
echo "<p>p_make:" .  $_SESSION['car_make'] . "</p>";
echo "<p>p_model:" .  $_SESSION['car_model'] . "</p>";
echo "<p>p_vin:" .  $_SESSION['vin_no'] . "</p>";
echo "<p>p_license:" .  $_SESSION['license_plate'] . "</p> <br><br>";


echo "<p>e_esti_date:" .  $_SESSION['estimate_date'] . "</p>";
echo "<p>e_expir_esti_date:" .  $_SESSION['estimate_expiry_date'] . "</p>";
echo "<p>e_p/unit:" .  $_SESSION['estimate_parts_per_unit'] . "</p>";
echo "<p>e_l/unit:" .  $_SESSION['estimate_labour_per_unit'] . "</p>";
echo "<p>e_s/unit:" .  $_SESSION['estimate_supplies_per_unit'] . "</p>";
echo "<p>e_d/unit:" .  $_SESSION['estimate_disposal_per_unit'] . "</p>";
echo "<p>e_p_total:" .  $_SESSION['estimate_parts_total'] . "</p>";
echo "<p>e_l_total:" .  $_SESSION['estimate_labour_total'] . "</p>";
echo "<p>e_s_total:" .  $_SESSION['estimate_supplies_total'] . "</p>";
echo "<p>e_d_total:" .  $_SESSION['estimate_disposal_total'] . "</p>";
echo "<p>e_total:" .  $_SESSION['estimate_total'] . "</p>";
echo "<p>e_exceed:" .  $_SESSION['exceed_cost'] . "</p>";
echo "<p>e_choice:" .  $_SESSION['removal_choice'] . "</p>";
echo "<p>e_initial:" .  $_SESSION['customer_initial'] . "</p> <br> <br>";

echo "<p>modify variable:" . $_SESSION['editForm'] . "</p>";
echo "<p>modify variable_post:" . $_POST['editForm'] . "</p>";


//close the statement
$stmt_find_orders->close();
$stmt_find_estimate->close();
$stmt_find_profiles->close();
$stmt_find_waccounts->close();
?>
