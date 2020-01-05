<?php
/*******************************************************************
** generate unique id for the appointment email notification sent **
********************************************************************/

//include file to connect to the database
include '../../database/connectdb.php';



//include file to check errors in sql statements
include_once '../../database/error_check.php';



//prepare and bind sql statement
  $statement = "SELECT Appointment_Id FROM Appointments 
                ORDER BY Appointment_Id DESC
                LIMIT 1";
                
  $stmt_a_appointment = $conn->prepare($statement);


  //execute the statement
  $stmt_a_appointment->execute();


  //store the result
  $stmt_a_appointment->store_result();


  //bind the results
  $stmt_a_appointment->bind_result($appointment_id);



  //print out the accounts that are available
if ($stmt_a_appointment->num_rows > 0){

  while($stmt_a_appointment->fetch()){
    //save the appointment id into a session
    $_SESSION['appointment_id'] = $appointment_id + 1;
  }
}



//close the statement
$stmt_a_appointment->close();
?>
