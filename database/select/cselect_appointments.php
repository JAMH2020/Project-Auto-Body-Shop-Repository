<?php
/****************************************************************
** shows all the appointments of the customer who is logged on **
*****************************************************************/

//include file to connect to the database
include_once '../database/connectdb.php';


//include file to check errors in sql statements
include_once '../database/error_check.php';


function accepted_appointments($conn){
  //prepare and bind sql statement
  //inner join the customer accounts table into the orders table in order to get the customer's name using the customer id as the key
  $stmt_accepted = $conn->prepare("SELECT * FROM Appointments WHERE Status = 'accepted' ORDER BY Appointment_Id DESC");

  //execute the prepared statement
  $stmt_accepted->execute();

  //store the selected result
  $stmt_accepted->store_result();

  //bind the selected results
  $stmt_accepted->bind_result($appointment_idRow, $car_yearRow, $car_makeRow, $car_modelRow, $school_nameRow, $school_addressRow, $descriptionRow, $dateRow, $statusRow);;



  //print out the orders that are available
  if ($stmt_accepted->num_rows > 0){

    //prints out a table
    echo "<table class='table'>";
    echo "<tr>";
      
      echo "<th>Appointment id</th>";
      echo "<th>Car Year</th>";
      echo "<th>Car Make</th>";
      echo "<th>Car Model</th>";
      echo "<th>School Name</th>";
      echo "<th>School Address</th>";
      echo "<th>Reason of Appointment</th>";
      echo "<th></th>";
      
    echo "</tr>";
  
    while($stmt_accepted->fetch()){
  
        echo "<tr>";
        echo "<td>" . "#" . $appointment_idRow . "</td>";
        echo "<td>" . $car_yearRow . "</td>";
        echo "<td>" . $car_makeRow . "</td>";
        echo "<td>" . $car_modelRow . "</td>";
        echo "<td>" . $school_nameRow . "</td>";
        echo "<td>" . $school_addressRow . "</td>";
        echo "<td>" . $descriptionRow . "</td>";
  ?>


  <?php     
      echo "</tr>";
    }
  
    echo "</table>";
  
  //if there are no orders
  } else {
    echo "<h3 class='conclusion'>" . "There are no ongoing appointments" . "</h3>";
    exit();
  }





  //close the statment
  $stmt_accepted->close();

}


function planned_appointments($conn){
  //prepare and bind sql statement
  //inner join the customer accounts table into the orders table in order to get the customer's name using the customer id as the key
  $stmt_planned = $conn->prepare("SELECT * FROM Appointments WHERE Status = 'pending' ORDER BY Appointment_Id DESC");

  //execute the prepared statement
  $stmt_planned->execute();

  //store the selected result
  $stmt_planned->store_result();

  //bind the selected results
  $stmt_planned->bind_result($appointment_idRow, $car_yearRow, $car_makeRow, $car_modelRow, $school_nameRow, $school_addressRow, $descriptionRow, $dateRow, $statusRow);;



  //print out the orders that are available
  if ($stmt_planned->num_rows > 0){

    //prints out a table
    echo "<table class='table'>";
    echo "<tr>";
      
      echo "<th>Appointment id</th>";
      echo "<th>Car Year</th>";
      echo "<th>Car Make</th>";
      echo "<th>Car Model</th>";
      echo "<th>School Name</th>";
      echo "<th>School Address</th>";
      echo "<th>Reason of Appointment</th>";
      echo "<th></th>";
      
    echo "</tr>";
  
  while($stmt_planned->fetch()){
  
      echo "<tr>";
      echo "<td>" . "#" . $appointment_idRow . "</td>";
      echo "<td>" . $car_yearRow . "</td>";
      echo "<td>" . $car_makeRow . "</td>";
      echo "<td>" . $car_modelRow . "</td>";
      echo "<td>" . $school_nameRow . "</td>";
      echo "<td>" . $school_addressRow . "</td>";
      echo "<td>" . $descriptionRow . "</td>";
?>

           
           <td>
             <a href='#' onclick='editPage("../../database/select/find_row/find_row_appointments.php", "../../database/select/find_row/find_row_appointments.php", 1); findCAccountRow("<?php echo $appointment_idRow; ?>", "../../database/select/find_row/find_row_appointments.php", "../../customer/appointments/appointment.php"); return false;'>Edit</a>
           </td>


<?php     
    echo "</tr>";
  }
  
  echo "</table>";
  
//if there are no orders
} else {
  echo "<h3 class='conclusion'>" . "There are no pending appointments" . "</h3>";
  exit();
}





//close the statment
$stmt_planned->close();

}





function rejected_appointments($conn){
  //prepare and bind sql statement
  //inner join the customer accounts table into the orders table in order to get the customer's name using the customer id as the key
    $stmt_rejected = $conn->prepare("SELECT * FROM Appointments WHERE Status = 'rejected' ORDER BY Appointment_Id DESC");

    //execute the prepared statement
    $stmt_rejected->execute();

    //store the selected result
    $stmt_rejected->store_result();

    //bind the selected results
    $stmt_rejected->bind_result($appointment_idRow, $car_yearRow, $car_makeRow, $car_modelRow, $school_nameRow, $school_addressRow, $descriptionRow, $dateRow, $statusRow);;



    //print out the orders that are available
    if ($stmt_rejected->num_rows > 0){

      //prints out a table
      echo "<table class='table'>";
      echo "<tr>";
        
        echo "<th>Appointment id</th>";
        echo "<th>Car Year</th>";
        echo "<th>Car Make</th>";
        echo "<th>Car Model</th>";
        echo "<th>School Name</th>";
        echo "<th>School Address</th>";
        echo "<th>Reason of Appointment</th>";
       
      echo "</tr>";
  
    while($stmt_rejected->fetch()){
  
        echo "<tr>";
        
        echo "<td>" . "#" . $appointment_idRow . "</td>";
        echo "<td>" . $car_yearRow . "</td>";
        echo "<td>" . $car_makeRow . "</td>";
        echo "<td>" . $car_modelRow . "</td>";
        echo "<td>" . $school_nameRow . "</td>";
        echo "<td>" . $school_addressRow . "</td>";
        echo "<td>" . $descriptionRow . "</td>";
  ?>


  <?php     
      echo "</tr>";
    }
  
    echo "</table>";
  
  //if there are no orders
  } else {
    echo "<h3 class='conclusion'>" . "There are no rejected appointments" . "</h3>";
    exit();
  }





  //close the statment
  $stmt_rejected->close();

}
