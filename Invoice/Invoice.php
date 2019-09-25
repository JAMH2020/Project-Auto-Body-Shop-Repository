<!--script to create bullet points of error messages if there is a missing field
 or an error with the user's input-->
  <script src="js/errorlist.js"></script>

<?php

//ALL CUSTOMER RELATED INFORMATION
//customer work order number
$work_order_number = $_SESSION['work_order_number'] = "";

//customer full name
$customer_full_name = $_SESSION['customer_full_name'] = "";

//customer phone number
$customer_phone_number = $_SESSION['customer_phone_number'] = "";

//customer address 
$customer_address = $_SESSION['customer_address'] = "";

//customer email
$customer_email = $_SESSION['customer_email'] = "";

//customer invoice number
$invoice_number = $_SESSION['invoice_number'] = "";

//ALL CAR RELATED INFORMATION
//car model year
$car_model_year = $_SESSION['car_model_year'] = "";

//car year make
$car_make = $_SESSION['car_make'] = "";

//car model
$car_model = $_SESSION['car_model'] = "";

//car VIN number
$VIN = $_SESSION['VIN'] = "";

//car license plate
$car_license_plate = $_SESSION['car_license_plate'] = "";

//intake odometer reading
$intake_odometer_reading = $_SESSION['intake_odometer_reading'] = "";

//odometer reading on return
$return_odometer_reading = $_SESSION['return_odometer_reading'] = "";

//AUTHORIZATION STUFF
//date of return vehicle
$return_date = $_SESSION['return_date'] = "";

//parts removed returned or not
$removed_part_returned = $_SESSION['removed_part_returned'] = "";

//COSTS
//costs of parts
$parts_costs = $_SESSION['parts_costs'] = "";

//cost of labour
$labour_costs = $_SESSION['labour_costs'] = "";

//shop supplies cost
$supplies_cost = $_SESSION['supplies_costs'] = "";

//recycling and/or disposal fees
$redi_fees = $_SESSION['redi_fees'] = "";

//estimated costs of everything dones
$estimated_costs = $_SESSION['estimated_costs'] = "";

//Total cost of EVERYTHING
$total_cost = $_SESSION ['total_cost'] = "";

//FINAL
//Teachers name
$teachers_name = $_SESSION['teachers_name'] = "";

//siganture of owner
$owner_signature = $_SESSION['owner_signature'] = "";












?>
