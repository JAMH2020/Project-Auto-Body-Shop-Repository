<?php
/************************************************************
** find values of a specific row in the appointments table **
*************************************************************/

//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}

//include file to connect to the database
include_once '../../connectdb.php';

//include file to check errors in sql statements
include_once '../../error_check.php';


//prepare and bind sql statement
$stmt_find_appointment = $conn->prepare("SELECT Appointments.Appointment_Id, Customer_Accounts.Customer_Id, Customer_Accounts.First_Name, Customer_Accounts.Last_Name, Customer_Accounts.Email,Worker_Accounts.Worker_Id, Worker_Accounts.First_Name, Worker_Accounts.Last_Name, Worker_Accounts.Email,Appointments.Car_Year, Appointments.Car_Make, Appointments.Car_Model, Appointments.School_Name, Appointments.School_Address, Appointments.Description, Appointments.Date, Appointments.Status  
                                        FROM Appointments 
                                        LEFT JOIN Worker_Accounts
                                          ON Appointments.Worker_Id = Worker_Accounts.Worker_Id
                                        LEFT JOIN Customer_Accounts
                                          ON Appointments.Customer_Id = Customer_Accounts.Customer_Id
                                        WHERE Appointments.Appointment_Id = ?");
$stmt_find_appointment->bind_param("i",$appointment_find_id);

//get the customer id using AJAX
$appointment_find_id = $_POST['rowId'];

//execute the statement
$stmt_find_appointment->execute();

//store the result
$stmt_find_appointment->store_result();

//bind the results
$stmt_find_appointment->bind_result($appointment_idRow , $customer_idRow, $customer_firstnameRow, $customer_lastnameRow, $customer_emailRow, $worker_idRow, $worker_firstnameRow, $worker_lastnameRow, $worker_emailRow, $car_yearRow ,$car_makeRow ,$car_modelRow, $school_nameRow, $school_addressRow, $plan_descriptionRow, $plan_dateRow, $statusRow);




//store the values of the row into sessions
if ($stmt_find_appointment->num_rows > 0){

  while($stmt_find_appointment->fetch()){
    //store the values into sessions
    //appointment id
    $_SESSION['appointment_id'] = $appointment_idRow;
    
    //customer id
    $_SESSION['customer_id'] = $customer_idRow;
    
    //customer firstname
    $_SESSION['customer_firstname'] = $customer_firstnameRow;
    
    //customer lastname
    $_SESSION['customer_lastname'] = $customer_lastnameRow;
    
    //customer email
    $_SESSION['customer_email'] = $customer_emailRow;
    
    //worker id
    $_SESSION['worker_id'] = $worker_idRow;
    
    //worker firstname
    $_SESSION['worker_firstname'] = $worker_firstnameRow;
    
    //worker lastname
    $_SESSION['worker_lastname'] = $worker_lastnameRow;
    
    //worker email
    $_SESSION['worker_email'] = $worker_emailRow;
 
    //car year
    $_SESSION['car_year'] = $car_yearRow;
    
    //car make
    $_SESSION['car_make'] = $car_makeRow;
    
    //car model
    $_SESSION['car_model'] = $car_modelRow;
    
    //school name
    $_SESSION['school_name'] = $school_nameRow;
    
    //school name
    $_SESSION['school_name'] = $school_nameRow;
    
    //school address
    $_SESSION['school_address'] = $school_addressRow;
    
    //description
    $_SESSION['plan_description'] = $plan_descriptionRow;
    
    //date
    $_SESSION['plan_date'] = $plan_dateRow;
    
    //status
    $_SESSION['status'] = $_SESSION['prev_status'] = $statusRow;

   }
} else {
  echo "<p>nothing</p>";
}



//edit orders if the user pressed the edit button
if ($_POST['editForm'] == "1"){
  $_SESSION['editForm'] = true;
  
} else if ($_POST['editForm'] == "0"){
  $_SESSION['editForm'] = false;
}


//update the status of the appointments if the admin or worker pressed the create order from appointments
if ($_POST['oldOrder'] == "1"){
  $_SESSION['oldOrder'] = true;
} else if ($_POST['editForm'] == "0"){
  $_SESSION['oldOrder'] = false;
}


/*
echo "<p>c_id:" .  $_SESSION['appointment_id'] . "</p>";
echo "<p>c_firstame:" .  $_SESSION['car_year'] . "</p>";
echo "<p>c_password:" .   $_SESSION['school_name'] . "</p>";
echo "<p>c_email:" .  $_SESSION['worker_email'] . "</p>";
echo "<p>c_change_status:" .  $_SESSION['account_change'] . "</p>";
*/

//close the statement
$stmt_find_appointment->close();

//if the admin or the worker is creating an order from an accepted appointment
if ($_SESSION['oldOrder']){
?>

<!--redirect to the intake repair form-->
<script>redirect_page('/worker_cpanel/orders/intake_repair_form.php'); </script>

<?php
} else {
?>

<!--redirect to the edit account page-->
<script>redirect_page('/customer/appointments/appointment.php'); </script>

<?php
}
?>
