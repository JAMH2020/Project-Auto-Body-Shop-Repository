<?php
/************************************************************************
** find values of a specific invoice_id to be used to edit the invoice **
*************************************************************************/

//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}

//include file to connect to the database
include_once '../../connectdb.php';

//include file to check errors in sql statements
include_once '../../error_check.php';


//prepare and bind sql statement
//get the row from the invoices table
$stmt_find_invoices = $conn->prepare("SELECT * FROM Invoice WHERE Invoice_Id = ?");
$stmt_find_invoices->bind_param("i",$invoice_find_id);

//get the row from the orders table
$stmt_find_orders = $conn->prepare("SELECT * FROM Orders WHERE Order_No = ?");
$stmt_find_orders->bind_param("i", $order_find_no);

//get the row from the order profile table
$stmt_find_profiles = $conn->prepare("SELECT * FROM Order_Profile WHERE Order_No = ?");
$stmt_find_profiles->bind_param("i",$order_find_no);

//get the row from the total cost table
$stmt_find_total = $conn->prepare("SELECT * FROM Total_Cost WHERE Invoice_No = ?");
$stmt_find_total->bind_param("s",$total_find_no);

//get the row from the estimate cost table
$stmt_find_estimate = $conn->prepare("SELECT Removal_Choice FROM Estimate_Cost WHERE Order_No = ?");
$stmt_find_estimate->bind_param("i",$estimate_find_no);

//get the row form the worker accounts table
$stmt_find_worker = $conn->prepare("SELECT First_Name, Last_Name, Email FROM Worker_Accounts WHERE Worker_Id = ?");
$stmt_find_worker->bind_param("i", $worker_find_id);



//get the order id using AJAX
$invoice_find_id = $_POST['rowId'];

//execute the statement
$stmt_find_invoices->execute();

//store the result
$stmt_find_invoices->store_result();

//bind the results
$stmt_find_invoices->bind_result($invoice_idRow, $order_noRow, $worker_idRow, $invoice_noRow, $invoice_dateRow, $odometer_returnRow, $descriptionRow, $authorization_dateRow, $completion_dateRow);


//store the values of the row into sessions
if ($stmt_find_invoices->num_rows > 0){

  //store the values into sessions
  while($stmt_find_invoices->fetch()){
  
    //--------Invoices Table------------//
    //invoice id
    $_SESSION['invoice_id'] = $invoice_idRow;
    
    //order number
    $_SESSION['order_no'] = $order_noRow;
    
    //worker id
    $_SESSION['worker_id'] = $worker_idRow;
    
    //invoice number
    $_SESSION['invoice_no'] = $invoice_noRow;
    
    //date the invoice was created
    $_SESSION['invoice_dateRow'] = $invoice_dateRow;
    
    //odometer value on return
    $_SESSION['odometer_return'] = $odometer_returnRow;
    
    //description of the job done
    $_SESSION['done_description'] = $descriptionRow;
    
    //date the work is authorized
    $_SESSION['completion_date'] = $authorization_dateRow;
    
    //date the work is completed
    $_SESSION['return_date'] = $completion_dateRow;
    
    
    
    
    //order number in order to search the orders table
    $order_find_no = $order_noRow;
    
    //worker id in order to search the worker accounts table
    $worker_find_id = $worker_idRow;
    
    //session for remembering previous invoice number
    $_SESSION['prev_invoice_no'] = $invoice_noRow;
  }
}



//execute the statement to find the correpsonding order
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
    $_SESSION['order_no'] = $order_noRow;
    
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







//execute the statement for getting values from customer account
$stmt_find_profiles->execute();

//store the result
$stmt_find_profiles->store_result();

//bind the results
$stmt_find_profiles->bind_result($p_order_noRow, $customer_firstnameRow, $customer_lastnameRow, $customer_phoneRow, $customer_addressRow, $customer_emailRow, $car_yearRow, $car_makeRow, $car_modelRow, $vin_noRow, $license_plateRow);

//store the values of the row into sessions
if ($stmt_find_profiles->num_rows > 0){

  while($stmt_find_profiles->fetch()){
    //store the values into sessions
    //-----customer profiles table-----//
    
    //customer's firstname
    $_SESSION['customer_firstname'] = $customer_firstnameRow;
    
    //customer's lastname
    $_SESSION['customer_lastname'] = $customer_lastnameRow;
    
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




//get the corresponding invoice number from sessions
$total_find_no = $_SESSION['invoice_no'];


//execute the statement for getting values from the total cost table
$stmt_find_total->execute();

//store the result
$stmt_find_total->store_result();

//bind the results
$stmt_find_total->bind_result($invoice_noRow, $parts_per_unitRow, $labour_per_unitRow, $supplies_per_unitRow, $disposal_per_unitRow, $parts_totalRow, $labour_totalRow, $supplies_totalRow, $disposal_totalRow, $estimate_totalRow, $totalRow);

//store the values of the row into sessions
if ($stmt_find_total->num_rows > 0){

  while($stmt_find_total->fetch()){
    //store the values into sessions
    //-----total cost table-----//
    //price of parts per unit
    $_SESSION['parts_per_unit'] = $parts_per_unitRow;
    
    //price of labour per unit
    $_SESSION['labour_per_unit'] = $labour_per_unitRow;
    
    //price of supplies per unit
    $_SESSION['supplies_per_unit'] = $supplies_per_unitRow;
    
    //price of disposal/recycling per unit
    $_SESSION['disposal_per_unit'] = $disposal_per_unitRow;
    
    //total price of parts
    $_SESSION['parts_total'] = $parts_totalRow;
    
    //total price of labour
    $_SESSION['labour_total'] = $labour_totalRow;
    
    //total price of supplies
    $_SESSION['supplies_total'] = $supplies_totalRow;
    
    //total price of recycling/disposal fee
    $_SESSION['disposal_total'] = $disposal_totalRow;
    
     //estimate total
    $_SESSION['estimate_total_cost'] = $estimate_totalRow;
    
    //total cost
    $_SESSION['total_cost'] = $totalRow;   
    
    }
 }
 
 
 
//get the corresponding invoice number from sessions
$estimate_find_no = $_SESSION['order_no'];


//execute the statement for getting values from the total cost table
$stmt_find_estimate->execute();

//store the result
$stmt_find_estimate->store_result();


//bind result
$stmt_find_estimate->bind_result($removal_choiceRow);



//store the values of the row into sessions
if ($stmt_find_estimate->num_rows > 0){

  while($stmt_find_estimate->fetch()){
  //store the values into sessions
  //-------estimate cost table-------//
  
  //removal choice selected
  $_SESSION['removal_choice'] = $removal_choiceRow;
  
  }
}






//edit invoices if the user pressed the edit button
if ($_POST['editForm'] == "1"){
  $_SESSION['editForm'] = true;
  
} else if ($_POST['editForm'] == "0"){
  $_SESSION['editForm'] = false;
}



//view orders if the user pressed the view button
if ($_POST['viewForm'] == "1"){
  $_SESSION['viewForm'] = true;
  
} else if ($_POST['viewForm'] == "0"){
  $_SESSION['viewForm'] = false;
}




//execute the statement for getting values from the worker accounts table
$stmt_find_worker->execute();

//store the result
$stmt_find_worker->store_result();


//bind result
$stmt_find_worker->bind_result($worker_firstnameRow, $worker_lastnameRow, $worker_emailRow);

//store the values of the row into sessions
if ($stmt_find_worker->num_rows > 0){

  while($stmt_find_worker->fetch()){
  //store the values into sessions
  //-------worker accounts table-------//
  
  //worker's firstname
  $_SESSION['worker_firstname'] = $worker_firstnameRow;
  
  //worker's lastname
  $_SESSION['worker_lastname'] = $worker_lastnameRow;
  
  //worker's email
  $_SESSION['worker_email'] = $worker_emailRow;
  }
} 



/*
echo "<p>i_id:" .  $_SESSION['invoice_id'] . "</p>";
echo "<p>i_order_no.:" .  $_SESSION['order_no'] . "</p>";
echo "<p>i_worker_id:" .  $_SESSION['worker_id'] . "</p>";
echo "<p>i_invoice_no:" .  $_SESSION['invoice_no'] . "</p>";
echo "<p>i_invoice_date:" .  $_SESSION['invoice_date'] . "</p>";
echo "<p>i_odomter_return:" .  $_SESSION['odometer_return'] . "</p>";
echo "<p>i_description:" .  $_SESSION['done_description'] . "</p>";
echo "<p>i_authorization_date" . $_SESSION['completion_date'] . "</p>";
echo "<p>i_complete_date:" .  $_SESSION['return_date'] . "</p><br><br>";



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
echo "<p>c_email:" .  $_SESSION['customer_email'] . "</p><br><br>";


echo "<p>p_phone:" .  $_SESSION['customer_phone'] . "</p>";
echo "<p>p_addres:" .  $_SESSION['customer_address'] . "</p>";
echo "<p>p_year:" .  $_SESSION['car_year'] . "</p>";
echo "<p>p_make:" .  $_SESSION['car_make'] . "</p>";
echo "<p>p_model:" .  $_SESSION['car_model'] . "</p>";
echo "<p>p_vin:" .  $_SESSION['vin_no'] . "</p>";
echo "<p>p_license:" .  $_SESSION['license_plate'] . "</p> <br><br>";


echo "<p>t_p_unit:" .  $_SESSION['parts_per_unit'] . "</p>";
echo "<p>t_l_unit:" .  $_SESSION['labour_per_unit'] . "</p>";
echo "<p>t_s_unit:" .  $_SESSION['supplies_per_unit'] . "</p>";
echo "<p>t_d_unit:" .  $_SESSION['disposal_per_unit'] . "</p>";
echo "<p>t_p_total:" .  $_SESSION['parts_total'] . "</p>";
echo "<p>t_l_total:" .  $_SESSION['labour_total'] . "</p>";
echo "<p>t_s_total:" .  $_SESSION['supplies_total'] . "</p>";
echo "<p>t_d_total:" .  $_SESSION['disposal_total'] . "</p>";
echo "<p>t_estimate:" .  $_SESSION['estimate_total_cost'] . "</p>";
echo "<p>t_total:" .  $_SESSION['total_cost'] . "</p>";
echo "<p>e_choice:" .  $_SESSION['removal_choice'] . "</p><br><br>";

echo "<p>w_firstname:" . $_SESSION['worker_firstname'] . "</p>";
echo "<p>w_lastname:" . $_SESSION['worker_lastname'] . "</p>";
echo "<p>w_email:" . $_SESSION['worker_email'] . "</p><br><br>";

echo "<p>prev_invoice_no:" . $_SESSION['prev_invoice_no'] . "</p>";
*/

//close the statement
$stmt_find_invoices->close();
$stmt_find_orders->close();
$stmt_find_profiles->close();
$stmt_find_total->close();
$stmt_find_estimate->close();
?>


<!--redirect to the invoice page-->
<script>redirect_page('../../worker_cpanel/invoices/invoice.php');</script>



