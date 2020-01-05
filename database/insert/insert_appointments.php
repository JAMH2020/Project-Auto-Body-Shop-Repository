<?php
/************************************************************************
** Insert user data from the book appointments page into the database  **
*************************************************************************/


//connect to the database
include_once '../../database/connectdb.php';

//include file to check for errors in sql statements
include_once '../../database/error_check.php';

//prepare sql statement to bind
$stmt_appointment = $conn->prepare("INSERT INTO Appointments (Customer_Id, Worker_Id, Car_Year, Car_Make, Car_Model, School_Name, School_Address, Description, Date, Status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt_appointment->bind_param("iiisssssss", $customer_id, $worker_id, $car_year, $car_make, $car_model, $school_name, $school_address, $description, $date, $status);
  

//customer id
$customer_id = $_SESSION['customer_id'];

//worker id
$worker_id = 0;

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

//reason for the appointment
$description = $_SESSION['plan_description'];

//date
$date = "";

//status
$status = "pending";


//execute the insertion for the prepared sql statement
insertData($stmt_appointment);

$stmt_appointment->close();

//set all session variables for order to blank
include "../../src/clear_sessions.php";

clear_appointments();
?>
