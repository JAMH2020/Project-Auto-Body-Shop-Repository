<?php
/********************************************************************
** Insert user data from the intake repair form into the database  **
*********************************************************************/

//connect to the database
include_once '../../database/connectdb.php';

//include file to check for errors in sql statements
include_once '../../database/error_check.php';



//prepare sql statement to bind
//statement to insert into the Orders table

$stmt_orders = $conn->prepare("INSERT INTO Orders (Order_No, Date, Worker_Id, Customer_Id, Description, Work_Date, Odometer_Intake, School_Name, School_Address, Status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt_orders->bind_param("isiississs", $order_no, $date, $worker_id, $customer_id, $plan_description, $plan_date, $odometer_intake, $school_name, $school_address, $status);
  
  
//statement to insert into the Customer Profile table
$stmt_cprofile = $conn->prepare("INSERT INTO Customer_Profile (Phone_No, Address, Email, Car_Year, Car_Make, Car_Model, Vin_No, License_Plate) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt_cprofile->bind_param("sssissss", $customer_phone, $customer_address, $customer_email, $car_year, $car_make, $car_model, $vin_no, $license_plate);


//statement to insert into the Estimate Cost table
$stmt_estimate_cost = $conn->prepare("INSERT INTO Estimate_Cost (Order_No, Estimate_Date, Estimate_Date_Expiry, Parts_Unit_Price, Labour_Unit_Price, Supplies_Unit_Price, Disposal_Unit_Price, Parts_Total, Labour_Total, Supplies_Total, Disposal_Total, Total_Cost, Exceed_Cost, Removal_Choice, Initial) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt_estimate_cost->bind_param("issddddddddddss", $order_no, $estimate_date, $estimate_expiry_date, $estimate_parts_per_unit, $estimate_labour_per_unit, $estimate_supplies_per_unit, $estimate_disposal_per_unit, $estimate_parts_total, $estimate_labour_total, $estimate_supplies_total, $estimate_disposal_total, $estimate_total_cost, $exceed_cost, $removal_choice, $customer_initial); 

  
//--------Data of intake repair form----//
//order number
$order_no = $_SESSION['order_no'];
  
//school name
$school_name = $_SESSION['school_name'];
 
//school address
$school_address = $_SESSION['school_address'];

//client's car repair information
//year of car
$car_year = $_SESSION['car_year'];

//brand of the vehicle and the model
$car_make = $_SESSION['car_make'];
 
//model of the vehicle
$car_model = $_SESSION['car_model'];

//client's VIN number
$vin_no = $_SESSION['vin_no'];

//license plate number
$license_plate = $_SESSION['license_plate'];

//odometer reading at intake
$odometer_intake = $_SESSION['odometer_intake'];

//description of the work that is going to be done
$plan_description = $_SESSION['plan_description'];

//date work is going to be performed
$plan_date = $_SESSION['plan_date'];




//Estimate costings of repair
//price of parts per unit
$estimate_parts_per_unit = $_SESSION['estimate_parts_per_unit'];
//total price of parts
$estimate_parts_total = $_SESSION['estimate_parts_total'];

//price of labour per unit
$estimate_labour_per_unit = $_SESSION['estimate_labour_per_unit'];
//total price of labour
$estimate_labour_total = $_SESSION['estimate_labour_total'];

//price of shop supplies per unit
$estimate_supplies_per_unit = $_SESSION['estimate_supplies_per_unit'];  
//total prcie of shop supplies
$estimate_supplies_total = $_SESSION['estimate_supplies_total'];
 
//price of recycling/disposal fee per unit
$estimate_disposal_per_unit = $_SESSION['estimate_disposal_per_unit'];
//total of recycling/disposal fee
$estimate_disposal_total = $_SESSION['estimate_disposal_total'];

//total cost
$estimate_total_cost = $_SESSION['estimate_total_cost'];

//date the estimate costings were declared
$estimate_date = $_SESSION['estimate_date'];  

//expiry date of estimate costings were declared
$estimate_expiry_date = $_SESSION['estimate_expiry_date'];

//removal choice of parts during the work process (A: returned to undersigned ______ or B: disposed of bye the school ______)
$removal_choice = $_SESSION['removal_choice'];

  
  
  
//-------data of the waiver form-------//
//customer's first name
$customer_firstname = $_SESSION['customer_firstname'];
  
//customer's last name
$customer_lastname = $_SESSION['customer_lastname'];
  
//customer's address
$customer_address = $_SESSION['customer_address'];
  
//customer's email
$customer_email = $_SESSION['customer_email'];
  
//customer's phone
$customer_phone = $_SESSION['customer_phone'];
  
  
//date the waiver was signed
$waiver_date = $_SESSION['waiver_date'];
  
//customer's initial
$customer_initial = $_SESSION['customer_initial'];

  
//how much cost should not exceed
$exceed_cost = $_SESSION['exceed_cost'];




//date when data is inserted
$date = date("Y-m-d H:i:s");
  
  
  
//worker id
//if the admin is logged in
if ($_SESSION['admin_loggedin']){

  //get the new worker id
  //include file to get the worker id using the worker email
  include_once "../../database/select/aselect_waccounts.php";
  $worker_id = get_waccounts_id($conn);
  
//if the worker is logged in  
} else {
  $worker_id = $_SESSION['worker_id'];
}





//customer id
//include file to get the customer id using the customer email
include_once "../../database/select/aselect_caccounts.php";
$customer_id = get_caccounts_id($conn);


//status
$status = "imcomplete";









//insert the data for the orders table
//$stmt_orders->execute();


//insert the data for the customer profile table
//$stmt_cprofile->execute();

//insert the data for the estimate cost table
//$stmt_estimate_cost->execute();


//close statement
$stmt_orders->close();
$stmt_cprofile->close();
$stmt_estimate_cost->close();



//set all session variables for order to blank
$_SESSION['order_no'] = $_SESSION['school_name'] = $_SESSION['school_address'] = $_SESSION['car_year'] = $_SESSION['car_make'] = $_SESSION['car_model'] =
$_SESSION['vin_no'] = $_SESSION['license_plate'] = $_SESSION['odometer_intake'] = $_SESSION['plan_description'] = $_SESSION['plan_date'] = 
$_SESSION['estimate_parts_per_unit'] = $_SESSION['estimate_parts_total'] = $_SESSION['estimate_labour_per_unit'] = $_SESSION['estimate_labour_total'] =
$_SESSION['estimate_supplies_per_unit'] = $_SESSION['estimate_supplies_total'] = $_SESSION['estimate_disposal_per_unit'] = $_SESSION['estimate_disposal_total'] =
$_SESSION['estimate_total_cost'] = $_SESSION['estimate_date'] = $_SESSION['estimate_expiry_date'] = $_SESSION['removal_choice'] = $_SESSION['customer_firstname'] =
$_SESSION['customer_lastname'] = $_SESSION['customer_address'] = $_SESSION['customer_email'] = $_SESSION['customer_phone'] = $_SESSION['waiver_date'] = 
$_SESSION['customer_initial'] = $_SESSION['exceed_cost'] = $_SESSION['worker_id'] = "";
?>
