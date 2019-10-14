<?php
/***********************************
** Update orders to the database  **
************************************/


//connect to the database
include_once '../../database/connectdb.php';

//include file to check for errors in sql statements
include_once '../../database/error_check.php';

//prepare sql statement to bind
//update orders table
$stmt_u_orders = $conn->prepare("UPDATE Orders SET Order_No = ?, Worker_Id = ?, Customer_Id = ?, Description = ?, Work_Date = ?, Odometer_Intake = ?, School_Name = ?, School_Address = ?, Status = ? WHERE Order_Id = ?");
$stmt_u_orders->bind_param("iiississsi", $order_no, $worker_id, $customer_id, $plan_description, $plan_date, $odometer_intake, $school_name, $school_address, $status, $order_id);


//update estimate cost table
$stmt_u_estimate = $conn->prepare("UPDATE Estimate_Cost SET Estimate_Date = ?, Estimate_Date_Expiry = ?, Parts_Unit_Price = ?, Labour_Unit_Price = ?, Supplies_Unit_Price = ?, Disposal_Unit_Price = ?, Parts_Total = ?, Labour_Total = ?, Supplies_Total = ?, Disposal_Total = ?, Total_Cost = ?, Exceed_Cost = ?, Removal_Choice = ?, Initial = ? WHERE Order_No = ?");
$stmt_u_estimate->bind_param("ssddddddddddssi", $estimate_date, $estimate_expiry_date, $estimate_parts_per_unit, $estimate_labour_per_unit, $estimate_supplies_per_unit, $estimate_disposal_per_unit, $estimate_parts_total, $estimate_labour_total, $estimate_supplies_total, $estimate_disposal_total, $estimate_total_cost, $exceed_cost, $removal_choice, $customer_initial, $order_no_prev);


//update changes that could affect the customer profile table
$stmt_u_profiles = $conn->prepare("UPDATE Customer_Profile SET Phone_No = ?, Address = ?, Email = ?, Car_Year = ?, Car_Make = ?, Car_Model = ?, Vin_No = ?, License_Plate = ? WHERE Email = ?");
$stmt_u_profiles->bind_param("sssisssss", $customer_phone, $customer_address, $customer_pemail, $car_year, $car_make, $car_model, $vin_no, $license_plate, $customer_pemail_prev);

//update changes that could affect the customer profile table
$stmt_u_caccounts = $conn->prepare("UPDATE Customer_Accounts SET First_Name = ?, Last_Name = ?, Password = ?, Email = ? WHERE Email = ?");
$stmt_u_caccounts->bind_param("sssss", $customer_firstname, $customer_lastname, $customer_password, $customer_cemail, $customer_cemail_prev);


//--------Orders Table----------//
//order id
$order_id = $_SESSION['order_id'];
 
//order number
$order_no = $_SESSION['order_no'];
     
     
     
//if the user is the admin
if ($_SESSION['admin_loggedin']){
  //get the new worker id
  include_once "../../database/select/aselect_waccounts.php";
  $worker_id = get_waccounts_id($conn);
  
// if the user is the workr
} else {

  //worker id
  $worker_id = $_SESSION['worker_id'];
}



    
//customer's id
$customer_id = $_SESSION['customer_id'];
    
//description of the work that is being don
$plan_description = $_SESSION['plan_description'];
    
//date the job was done
$plan_date = $_SESSION['plan_date'];
    
//odometer intake
$odometer_intake = $_SESSION['odometer_intake'];
    
//school name
$school_name = $_SESSION['school_name'];
    
//school address
$school_address = $_SESSION['school_address'];
    
//status of the order
$status = $_SESSION['status'];





//-----estimate cost table-----//
//estimate date selected
$estimate_date = $_SESSION['estimate_date'];
    
//date of expiry of the estimate date selected
$estimate_expiry_date = $_SESSION['estimate_expiry_date'];
    
//estimate of parts per unit selected
$estimate_parts_per_unit = $_SESSION['estimate_parts_per_unit'];
    
//estimate of labour per unit selected
$estimate_labour_per_unit = $_SESSION['estimate_labour_per_unit'];
    
//estimate of supplies per unit selected
$estimate_supplies_per_unit = $_SESSION['estimate_supplies_per_unit'];
    
//estimate of disposal/recycling per unit selected
$estimate_disposal_per_unit = $_SESSION['estimate_disposal_per_unit'];
    
//estimate of total parts selected
$estimate_parts_total = $_SESSION['estimate_parts_total'];
    
//estimate of total labour selected
$estimate_labour_total = $_SESSION['estimate_labour_total'];
    
//estimate of total supplies selected
$estimate_supplies_total = $_SESSION['estimate_supplies_total'];
    
//estimate of total disposal selected
$estimate_disposal_total = $_SESSION['estimate_disposal_total'];
    
//estimate total
$estimate_total_cost = $_SESSION['estimate_total_cost'];

//exceed cost
$exceed_cost = $_SESSION['exceed_cost'];
    
//removal choice selected
$removal_choice = $_SESSION['removal_choice'];

//customer's initial
$customer_initial = $_SESSION['customer_initial'];

//order number before change
$order_no_prev = $_SESSION['prev_order_no'];




//---------customer profile table------//
//firstname
$customer_firstname = $_SESSION['customer_firstname'];
    
//lastname
$customer_lastname = $_SESSION['customer_lastname'];
 
//customer phone number
$customer_phone = $_SESSION['customer_phone'];
    
//customer address
$customer_address = $_SESSION['customer_address'];
    
//customer email
$customer_pemail = $_SESSION['customer_email'];
    
//car year
$car_year = $_SESSION['car_year'];
    
//car make
$car_make = $_SESSION['car_make'];
    
//car model
$car_model = $_SESSION['car_model'];
    
//vin number
$vin_no = $_SESSION['vin_no'];
    
//license plate number
$license_plate = $_SESSION['license_plate'];

//customer's previous email before change
$customer_pemail_prev = $_SESSION['prev_customer_email'];




//----------customer account table------------// 
//firstname
$customer_firstname = $_SESSION['customer_firstname'];
    
//lastname
$customer_lastname = $_SESSION['customer_lastname'];
    
//password
$customer_password = $_SESSION['customer_password'];
    
//email
$customer_cemail = $_SESSION['customer_email'];

//customer's previous email before change
$customer_cemail_prev = $_SESSION['prev_customer_email'];



//execute the insertion for the prepared sql statement
$stmt_u_orders->execute();
$stmt_u_estimate->execute();
$stmt_u_profiles->execute();
$stmt_u_caccounts->execute();



//close statements
$stmt_u_orders->close();
$stmt_u_estimate->close();
$stmt_u_profiles->close();
$stmt_u_caccounts->close();




// redefines all sessions in the order form to blank
$_SESSION['order_id'] = $_SESSION['order_no'] = $_SESSION['worker_id'] = $_SESSION['customer_id'] = $_SESSION['plan_description'] = $_SESSION['plan_date'] = 
$_SESSION['odometer_intake'] = $_SESSION['school_name'] = $_SESSION['school_address'] = $_SESSION['status'] = $_SESSION['estimate_date'] = $_SESSION['estimate_expiry_date'] = 
$_SESSION['estimate_parts_per_unit'] = $_SESSION['estimate_labour_per_unit'] = $_SESSION['estimate_supplies_per_unit'] = $_SESSION['estimate_disposal_per_unit'] =
$_SESSION['estimate_parts_total'] = $_SESSION['estimate_labour_total'] = $_SESSION['estimate_supplies_total'] = $_SESSION['estimate_disposal_total'] =
$_SESSION['estimate_total_cost'] = $_SESSION['exceed_cost'] = $_SESSION['removal_choice'] = $_SESSION['customer_initial'] = $_SESSION['prev_order_no'] =
$_SESSION['customer_firstname'] = $_SESSION['customer_lastname'] = $_SESSION['customer_phone'] = $_SESSION['customer_address'] = $_SESSION['customer_email'] = 
$_SESSION['car_year'] = $_SESSION['car_make'] = $_SESSION['car_model'] = $_SESSION['vin_no'] = $_SESSION['license_plate'] = $_SESSION['prev_customer_email'] =
$_SESSION['customer_password'] = $_SESSION['worker_email'] = "";

?>
