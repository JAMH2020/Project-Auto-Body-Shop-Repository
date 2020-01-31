<?php

function clear_order(){
  //set all session variables for order to blank
  $_SESSION['order_no'] = $_SESSION['school_name'] = $_SESSION['school_address'] = $_SESSION['car_year'] = $_SESSION['car_make'] = $_SESSION['car_model'] =
  $_SESSION['vin_no'] = $_SESSION['license_plate'] = $_SESSION['odometer_intake'] = $_SESSION['plan_description'] = $_SESSION['plan_date'] = 
  $_SESSION['estimate_parts_per_unit'] = $_SESSION['estimate_parts_total'] = $_SESSION['estimate_labour_per_unit'] = $_SESSION['estimate_labour_total'] =
  $_SESSION['estimate_supplies_per_unit'] = $_SESSION['estimate_supplies_total'] = $_SESSION['estimate_disposal_per_unit'] = $_SESSION['estimate_disposal_total'] =
  $_SESSION['estimate_total_cost'] = $_SESSION['estimate_date'] = $_SESSION['estimate_expiry_date'] = $_SESSION['removal_choice'] = $_SESSION['customer_address'] = $_SESSION['customer_phone'] = $_SESSION['waiver_date'] = 
  $_SESSION['customer_initial'] = $_SESSION['exceed_cost'] = $_SESSION['prev_order_no'] = $_SESSION['prev_customer_email'] = $_SESSION['prev_worker_email'] = "";
  
  
  //if the admin or customer is logged in
  if ($_SESSION['admin_loggedin'] || $_SESSION['customer_loggedin']){
    $_SESSION['worker_id'] = "";
  }
  
  //if the admin or the worker is logged in
   if ($_SESSION['admin_loggedin'] || $_SESSION['worker_loggedin']){
     $_SESSION['customer_email'] = $_SESSION['customer_firstname'] = $_SESSION['customer_lastname'] = "";
   }
}

function clear_invoice(){
  //set all session variables for invoice to blank
  $_SESSION['order_no'] = $_SESSION['invoice_no'] = $_SESSION['invoice_date'] = $_SESSION['odometer_return'] = $_SESSION['done_description'] = $_SESSION['completion_date']
  = $_SESSION['return_date'] = $_SESSION['parts_per_unit'] = $_SESSION['labour_per_unit'] = $_SESSION['supplies_per_unit'] = $_SESSION['disposal_per_unit'] = $_SESSION['parts_total']
  = $_SESSION['labour_total'] = $_SESSION['supplies_total'] = $_SESSION['disposal_total'] = $_SESSION['estimate_total_cost'] = $_SESSION['total_cost'] = $_SESSION['order_id'] = $_SESSION['order_date'] = $_SESSION['plan_description'] = $_SESSION['plan_date'] = 
$_SESSION['odometer_intake'] = $_SESSION['school_name'] = $_SESSION['school_address'] = $_SESSION['status'] =
$_SESSION['customer_phone'] = $_SESSION['customer_address'] = $_SESSION['car_year'] = $_SESSION['car_make'] = $_SESSION['car_model'] = 
$_SESSION['vin_no'] = $_SESSION['license_plate'] = $_SESSION['removal_choice'] = $_SESSION['prev_invoice_no'] = "";
  
  //if the admin or customer is logged in
  if ($_SESSION['admin_loggedin'] || $_SESSION['customer_loggedin']){
    $_SESSION['worker_id'] = $_SESSION['worker_firstname'] = $_SESSION['worker_lastname'] =  $_SESSION['worker_email'] = "";
  }
  
  //if the admin or the worker is logged in
   if ($_SESSION['admin_loggedin'] || $_SESSION['worker_loggedin']){
     $_SESSION['customer_firstname'] = $_SESSION['customer_lastname'] = $_SESSION['customer_email'] = "";
   }
}




function clear_appointments(){
  //set all session variable for appointments to blank
  $_SESSION['appointment_id'] = $_SESSION['car_year'] = $_SESSION['car_make'] = $_SESSION['car_model'] = $_SESSION['school_name'] =  $_SESSION['school_address'] =
  $_SESSION['plan_description'] = $_SESSION['plan_date'] = $_SESSION['status'] = $_SESSION['prev_status'] = "";
  
  //if the admin  or customer is logged on
  if ($_SESSION['admin_loggedin'] || $_SESSION['customer_loggedin']){
    $_SESSION['worker_id'] = $_SESSION['worker_firstname'] = $_SESSION['worker_lastname'] = $_SESSION['worker_email'] = "";
  }
  
  //if the admin or worker is logged on
  if ($_SESSION['admin_loggedin'] || $_SESSION['worker_loggedin']){
    $_SESSION['customer_id'] = $_SESSION['customer_firstname'] = $_SESSION['customer_lastname'] = $_SESSION['customer_email'] = "";
  }
}

?>
