<?php
/*****************************************
** Update appointments to the database  **
******************************************/


//connect to the database
include '../../database/connectdb.php';

//include file to check for errors in sql statements
include_once '../../database/error_check.php';

//prepare sql statement to bind
//update customer account table
$stmt_u_appointment = $conn->prepare("UPDATE Appointments SET Worker_Id = ?, Car_Year = ?, Car_Make = ?, Car_Model = ?, School_Name = ?, School_Address = ?, Description = ?, Date = ?, Status = ? WHERE Appointment_Id = ?");
$stmt_u_appointment->bind_param("iisssssssi", $worker_id, $car_year, $car_make, $car_model, $school_name, $school_address, $description, $date, $status, $appointment_id);

//------appointments table-------//
//car year
$car_year = $_SESSION['car_year'];

//car make
$car_make = $_SESSION['car_make'];

//car model
$car_model = $_SESSION['car_model'];

//school name
$school_name = $_SESSION['school_name'];

//school address
$school_address = $_SESSION['school_address'];

//description
$description = $_SESSION['plan_description'];

//date
$date = $_SESSION['plan_date'];

//status
$status = $_SESSION['status'];

//appointment id
$appointment_id = $_SESSION['appointment_id'];



//worker id
//if the customer is loggedin 
if ($_SESSION['customer_loggedin']){
  $worker_id = 0;
  
//if the admin is loggedin
} else if ($_SESSION['admin_loggedin']){

  //get the new worker id
  include_once "../../database/select/aselect_waccounts.php";
  $worker_id = get_waccounts_id($conn);
}






//execute the insertion for the prepared sql statement
$stmt_u_appointment->execute();



//close statements
$stmt_u_appointment->close();


//set all session variables for order to blank
include_once "../../src/clear_sessions.php";

clear_appointments();
?>
