<?php

//connects to the database 
include '../database/connectdb.php';

//checks for errors in sql statements
include '../database/error_check.php';

//connects php statements to mysql table
$stmt_invoice = $conn->prepare("INSERT INTO Invoice (Work_order_name, Customer_full_name, Customer_phone_number, Customer_address, Customer_email, Invoice_Number, Car_model_year, Car_make, Car_model, VIN, Car_license_plate, Intake_odometer_reading, Return_odometer_reading, Removed_part_returned, Return_date, Parts_costs, Labour_costs, Supplies_costs, Redi_fees, Estimated_costs, Total_cost, Teachers_name, Owner_signature ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt_invoice->bind_param("ssss", $work_order_number, $customer_full_name, $customer_phone_number, $customer_address, $customer_email, $invoice_number, $car_model_year, $car_make, $car_model, $VIN, $car_license_plate, $intake_odometer_reading, $return_odometer_reading, $removed_part_returned, $return_date, $parts_costs, $labour_costs, $supplies_cost, $redi_fees, $estimated_costs, $total_cost, $teachers_name, $owner_signature);
  
//customer work order number
$work_order_number = $_POST['work_order_number'];

//customer full name
$customer_full_name = $_POST['customer_full_name'];

//customer phone number
$customer_phone_number = $_POST['customer_phone_number'];

//customer address 
$customer_address = $_POST['customer_address'];

//customer email
$customer_email = $_POST['customer_email'];

//customer invoice number
$invoice_number = $_POST['invoice_number'];

//car model year
$car_model_year = $_POST['car_model_year'];

//car year make
$car_make = $_POST['car_make'];

//car model
$car_model = $_POST['car_model'];

//car VIN number
$VIN = $_POST['VIN'];

//car license plate
$car_license_plate = $_POST['car_license_plate'];

//intake odometer reading
$intake_odometer_reading = $_POST['intake_odometer_reading'];

//odometer reading on return
$return_odometer_reading = $_POST['return_odometer_reading'];

//date of return vehicle
$return_date = $_POST['return_date'];

//parts removed returned or not
$removed_part_returned = $_POST['removed_part_returned'];

//costs of parts
$parts_costs = $_POST['parts_costs'];

//cost of labour
$labour_costs = $_POST['labour_costs'];

//shop supplies cost
$supplies_cost = $_POST['supplies_costs'];

//recycling and/or disposal fees
$redi_fees = $_POST['redi_fees'];

//estimated costs of everything dones
$estimated_costs = $_POST['estimated_costs'];

//Total cost of EVERYTHING
$total_cost = $_POST['total_cost'];

//Teachers name
$teachers_name = $_POST['teachers_name'];

//siganture of owner
$owner_signature = $_POST['owner_signature'];

//execute the insertion for the prepared sql statement
insertData($stmt_invoice);
$stmt_invoice->close();
?>
