<?php
/**************************************************************
** shows all the appointments for the admin who is logged on **
***************************************************************/

//include file to connect to the database
include '../../database/connectdb.php';

//include file to check errors in sql statements
include '../../database/error_check.php';



function accepted_appointment($conn){
  //prepare and bind sql statement
  $stmt_a_appointment = $conn->prepare("SELECT Appointments.Appointment_Id, Customer_Accounts.Customer_Id, Customer_Accounts.First_Name, Customer_Accounts.Last_Name, Worker_Accounts.Worker_Id, Worker_Accounts.First_Name, Worker_Accounts.Last_Name, Appointments.Car_Year, Appointments.Car_Make, Appointments.Car_Model, Appointments.School_Name, Appointments.School_Address, Appointments.Description, Appointments.Date, Appointments.Status  
                                        FROM Appointments 
                                        LEFT JOIN Worker_Accounts
                                          ON Appointments.Worker_Id = Worker_Accounts.Worker_Id
                                        LEFT JOIN Customer_Accounts
                                          ON Appointments.Customer_Id = Customer_Accounts.Customer_Id
                                        WHERE Status = 'accepted'");


//execute the statement
$stmt_a_appointment->execute();


//store the result
$stmt_a_appointment->store_result();


//bind the results
$stmt_a_appointment->bind_result($appointment_idRow , $customer_idRow, $customer_firstnameRow, $customer_lastnameRow, $worker_idRow, $worker_firstnameRow, $worker_lastnameRow, $car_yearRow ,$car_makeRow ,$car_modelRow, $school_nameRow, $school_addressRow, $descriptionRow, $dateRow, $statusRow);

//print out the accounts that are available
if ($stmt_a_appointment->num_rows > 0){

  //prints out a table
  echo "<table class='table'>";
    echo "<tr>";

      echo "<th>Appointment Id</th>";
      echo "<th>Customer</th>";
      echo "<th>Assigned Worker</th>";
      echo "<th>Car Year</th>";
      echo "<th>Car Make</th>";
      echo "<th>Car Model</th>";
      echo "<th>School Name</th>";
      echo "<th>School Address</th>";
      echo "<th>Description</th>";
      echo "<th>Date</th>";
      echo "<th>Status</th>";
      echo "<th></th>";
      echo "<th></th>";
    echo "</tr>";

  while($stmt_a_appointment->fetch()){

     echo "<tr>";
      echo "<td>" . $appointment_idRow . "</td>";
      echo "<td>" . $customer_firstnameRow . " " . $customer_lastnameRow . " #" . $customer_idRow . "</td>";
      echo "<td>" . $worker_firstnameRow . " " . $worker_lastnameRow . " #" . $worker_idRow . "</td>";
      echo "<td>" . $car_yearRow . "</td>";
      echo "<td>" . $car_makeRow . "</td>";
      echo "<td>" . $car_modelRow . "</td>";
      echo "<td>" . $school_nameRow . "</td>";
      echo "<td>" . $school_addressRow . "</td>";
      echo "<td>" . $descriptionRow . "</td>";
      echo "<td>" . $dateRow . "</td>";
      echo "<td>" . $statusRow . "</td>";
?>

            <td>
             <a href='#' onclick='editPage("../database/select/find_row/find_row_appointments.php", "../database/select/find_row/find_row_appointments.php", 1); findCAccountRow("<?php echo $appointment_idRow; ?>", "../database/select/find_row/find_row_appointments.php", "../customer/appointments/appointment.php"); return false;'>Edit</a>
           </td>
           
           <td>
             <a href='#' onclick='appointmentOrder("../database/select/find_row/find_row_appointments.php", "../database/select/find_row/find_row_appointments.php", 1); findCAccountRow("<?php echo $appointment_idRow; ?>", "../database/select/find_row/find_row_appointments.php", "../worker_cpanel/orders/intake_repair_form.php"); return false;'>Create Order</a>
           </td>

<?php
    echo "</tr>";
   }
   echo "</table>";
   
} else {
  echo "<h3 class='conclusion'>" . "There are no accepted appointments" . "</h3>";
}


//close the statement
$stmt_a_appointment->close();
}





//for listing rejected appointments
function rejected_appointment($conn){
   //prepare and bind sql statement
  $stmt_r_appointment = $conn->prepare("SELECT Appointments.Appointment_Id, Customer_Accounts.Customer_Id, Customer_Accounts.First_Name, Customer_Accounts.Last_Name, Worker_Accounts.Worker_Id, Worker_Accounts.First_Name, Worker_Accounts.Last_Name, Appointments.Car_Year, Appointments.Car_Make, Appointments.Car_Model, Appointments.School_Name, Appointments.School_Address, Appointments.Description, Appointments.Date, Appointments.Status  
                                        FROM Appointments 
                                        LEFT JOIN Worker_Accounts
                                          ON Appointments.Worker_Id = Worker_Accounts.Worker_Id
                                        LEFT JOIN Customer_Accounts
                                          ON Appointments.Customer_Id = Customer_Accounts.Customer_Id
                                        WHERE Status = 'rejected'");


//execute the statement
$stmt_r_appointment->execute();


//store the result
$stmt_r_appointment->store_result();


//bind the results
$stmt_r_appointment->bind_result($appointment_idRow , $customer_idRow, $customer_firstnameRow, $customer_lastnameRow, $worker_idRow, $worker_firstnameRow, $worker_lastnameRow, $car_yearRow ,$car_makeRow ,$car_modelRow, $school_nameRow, $school_addressRow, $descriptionRow, $dateRow, $statusRow);

//print out the accounts that are available
if ($stmt_r_appointment->num_rows > 0){

  //prints out a table
  echo "<table class='table'>";
    echo "<tr>";

      echo "<th>Appointment Id</th>";
      echo "<th>Customer</th>";
      echo "<th>Car Year</th>";
      echo "<th>Car Make</th>";
      echo "<th>Car Model</th>";
      echo "<th>School Name</th>";
      echo "<th>School Address</th>";
      echo "<th>Description</th>";
      echo "<th>Status</th>";
      echo "<th></th>";
    echo "</tr>";

  while($stmt_r_appointment->fetch()){

     echo "<tr>";
      echo "<td>" . $appointment_idRow . "</td>";
      echo "<td>" . $customer_firstnameRow . " " . $customer_lastnameRow . " #" . $customer_idRow . "</td>";
      echo "<td>" . $car_yearRow . "</td>";
      echo "<td>" . $car_makeRow . "</td>";
      echo "<td>" . $car_modelRow . "</td>";
      echo "<td>" . $school_nameRow . "</td>";
      echo "<td>" . $school_addressRow . "</td>";
      echo "<td>" . $descriptionRow . "</td>";
      echo "<td>" . $statusRow . "</td>";
?>

            <td>
             <a href='#' onclick='editPage("../../database/select/find_row/find_row_appointments.php", "../../database/select/find_row/find_row_appointments.php", 1); findCAccountRow("<?php echo $appointment_idRow; ?>", "../../database/select/find_row/find_row_appointments.php", "../../customer/appointments/appointment.php"); return false;'>Edit</a>
           </td>

<?php
    echo "</tr>";
   }
   echo "</table>";
   
} else {
  echo "<h3 class='conclusion'>" . "There are no rejected appointments" . "</h3>";
}


//close the statement
$stmt_r_appointment->close();
}





//list the incoming appointments
function incoming_appointment($conn){
  //prepare and bind sql statement
  $stmt_i_appointment = $conn->prepare("SELECT Appointments.Appointment_Id, Customer_Accounts.Customer_Id, Customer_Accounts.First_Name, Customer_Accounts.Last_Name, Worker_Accounts.Worker_Id, Worker_Accounts.First_Name, Worker_Accounts.Last_Name, Appointments.Car_Year, Appointments.Car_Make, Appointments.Car_Model, Appointments.School_Name, Appointments.School_Address, Appointments.Description, Appointments.Date, Appointments.Status  
                                        FROM Appointments 
                                        LEFT JOIN Worker_Accounts
                                          ON Appointments.Worker_Id = Worker_Accounts.Worker_Id
                                        LEFT JOIN Customer_Accounts
                                          ON Appointments.Customer_Id = Customer_Accounts.Customer_Id
                                        WHERE Status = 'pending'");


//execute the statement
$stmt_i_appointment->execute();


//store the result
$stmt_i_appointment->store_result();


//bind the results
$stmt_i_appointment->bind_result($appointment_idRow , $customer_idRow, $customer_firstnameRow, $customer_lastnameRow, $worker_idRow, $worker_firstnameRow, $worker_lastnameRow, $car_yearRow ,$car_makeRow ,$car_modelRow, $school_nameRow, $school_addressRow, $descriptionRow, $dateRow, $statusRow);


//print out the accounts that are available
if ($stmt_i_appointment->num_rows > 0){

  //prints out a table
  echo "<table class='table'>";
    echo "<tr>";

      echo "<th>Appointment Id</th>";
      echo "<th>Customer</th>";
      echo "<th>Car Year</th>";
      echo "<th>Car Make</th>";
      echo "<th>Car Model</th>";
      echo "<th>School Name</th>";
      echo "<th>School Address</th>";
      echo "<th>Description</th>";
      echo "<th>Status</th>";
      echo "<th></th>";
    echo "</tr>";

  while($stmt_i_appointment->fetch()){

     echo "<tr>";
      echo "<td>" . $appointment_idRow . "</td>";
      echo "<td>" . $customer_firstnameRow . " " . $customer_lastnameRow . " #" . $customer_idRow . "</td>";
      echo "<td>" . $car_yearRow . "</td>";
      echo "<td>" . $car_makeRow . "</td>";
      echo "<td>" . $car_modelRow . "</td>";
      echo "<td>" . $school_nameRow . "</td>";
      echo "<td>" . $school_addressRow . "</td>";
      echo "<td>" . $descriptionRow . "</td>";
      echo "<td>" . $statusRow . "</td>";
?>

            <td>
             <a href='#' onclick='editPage("../../database/select/find_row/find_row_appointments.php", "../../database/select/find_row/find_row_appointments.php", 1); findCAccountRow("<?php echo $appointment_idRow; ?>", "../../database/select/find_row/find_row_appointments.php", "../../customer/appointments/appointment.php"); return false;'>Edit</a>
           </td>

<?php
    echo "</tr>";
   }
   echo "</table>";
   
} else {
  echo "<h3 class='conclusion'>" . "There are no incoming appointments" . "</h3>";
}


//close the statement
$stmt_i_appointment->close();
}





function met_appointment($conn){
    //prepare and bind sql statement
  $stmt_i_appointment = $conn->prepare("SELECT Appointments.Appointment_Id, Customer_Accounts.Customer_Id, Customer_Accounts.First_Name, Customer_Accounts.Last_Name, Worker_Accounts.Worker_Id, Worker_Accounts.First_Name, Worker_Accounts.Last_Name, Appointments.Car_Year, Appointments.Car_Make, Appointments.Car_Model, Appointments.School_Name, Appointments.School_Address, Appointments.Description, Appointments.Date, Appointments.Status  
                                        FROM Appointments 
                                        LEFT JOIN Worker_Accounts
                                          ON Appointments.Worker_Id = Worker_Accounts.Worker_Id
                                        LEFT JOIN Customer_Accounts
                                          ON Appointments.Customer_Id = Customer_Accounts.Customer_Id
                                        WHERE Status = 'met'");


//execute the statement
$stmt_i_appointment->execute();


//store the result
$stmt_i_appointment->store_result();


//bind the results
$stmt_i_appointment->bind_result($appointment_idRow , $customer_idRow, $customer_firstnameRow, $customer_lastnameRow, $worker_idRow, $worker_firstnameRow, $worker_lastnameRow, $car_yearRow ,$car_makeRow ,$car_modelRow, $school_nameRow, $school_addressRow, $descriptionRow, $dateRow, $statusRow);


//print out the accounts that are available
if ($stmt_i_appointment->num_rows > 0){

  //prints out a table
  echo "<table class='table'>";
    echo "<tr>";

      echo "<th>Appointment Id</th>";
      echo "<th>Customer</th>";
      echo "<th>Car Year</th>";
      echo "<th>Car Make</th>";
      echo "<th>Car Model</th>";
      echo "<th>School Name</th>";
      echo "<th>School Address</th>";
      echo "<th>Description</th>";
      echo "<th>Status</th>";
    echo "</tr>";

  while($stmt_i_appointment->fetch()){

     echo "<tr>";
      echo "<td>" . $appointment_idRow . "</td>";
      echo "<td>" . $customer_firstnameRow . " " . $customer_lastnameRow . " #" . $customer_idRow . "</td>";
      echo "<td>" . $car_yearRow . "</td>";
      echo "<td>" . $car_makeRow . "</td>";
      echo "<td>" . $car_modelRow . "</td>";
      echo "<td>" . $school_nameRow . "</td>";
      echo "<td>" . $school_addressRow . "</td>";
      echo "<td>" . $descriptionRow . "</td>";
      echo "<td>" . $statusRow . "</td>";
?>

<?php
    echo "</tr>";
   }
   echo "</table>";
   
} else {
  echo "<h3 class='conclusion'>" . "There are no accepted orders". "</h3>";
}


//close the statement
$stmt_i_appointment->close();
}
?>
