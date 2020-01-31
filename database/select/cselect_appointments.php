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
  $stmt_accepted->bind_result($appointment_idRow, $customer_idRow, $worker_idRow, $car_yearRow, $car_makeRow, $car_modelRow, $school_nameRow, $school_addressRow, $descriptionRow, $dateRow, $statusRow);



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
  $stmt_planned->bind_result($appointment_idRow, $customer_idRow, $worker_idRow, $car_yearRow, $car_makeRow, $car_modelRow, $school_nameRow, $school_addressRow, $descriptionRow, $dateRow, $statusRow);



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
             <a href='#' onclick='editPage("../database/select/find_row/find_row_appointments.php", "../database/select/find_row/find_row_appointments.php", 1); findCAccountRow("<?php echo $appointment_idRow; ?>", "../database/select/find_row/find_row_appointments.php", "../customer/appointments/appointment.php"); return false;'>Edit</a>
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
    $stmt_rejected->bind_result($appointment_idRow, $customer_idRow, $worker_idRow, $car_yearRow, $car_makeRow, $car_modelRow, $school_nameRow, $school_addressRow, $descriptionRow, $dateRow, $statusRow);



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



function completed_orders($conn){
    //prepare and bind sql statement
  //inner join the customer accounts table into the orders table in order to get the customer's name using the customer id as the key
  $statement = "SELECT Orders.Order_Id, Orders.Order_No, Orders.Date, Orders.School_Name, Orders.School_Address, Order_Profile.Car_Year, Order_Profile.Car_Make, Order_Profile.Car_Model, Orders.Description 
                                      FROM Orders
                                      LEFT JOIN Order_Profile
                                      ON Orders.Order_No = Order_Profile.Order_No
                                      WHERE Order_Profile.Email = '" . $_SESSION['customer_email'] . "' AND Orders.Status = 'complete'";
  
    $stmt_completed = $conn->prepare($statement);

    //execute the prepared statement
    $stmt_completed->execute();

    //store the selected result
    $stmt_completed->store_result();

    //bind the selected results
    $stmt_completed->bind_result($order_idRow, $order_noRow, $dateRow, $school_nameRow, $school_addressRow, $car_yearRow, $car_makeRow, $car_modelRow, $descriptionRow);



    //print out the orders that are available
    if ($stmt_completed->num_rows > 0){

      //prints out a table
      echo "<table class='table'>";
      echo "<tr>";
        echo "<th>Order No</th>";
        echo "<th>Date</th>";
        echo "<th>School Name</th>";
        echo "<th>School Address</th>";
        echo "<th>Car Year</th>";
        echo "<th>Car Make</th>";
        echo "<th>Car Model</th>";
        echo "<th>Description of Order</th>";
        echo "<th></th>";
       
      echo "</tr>";
  
    while($stmt_completed->fetch()){
  
        echo "<tr>";
        
        echo "<td>" . "#" . $order_noRow . "</td>";
        echo "<td>" . $dateRow . "</td>";
        echo "<td>" . $school_nameRow . "</td>";
        echo "<td>" . $school_addressRow . "</td>";
        echo "<td>" . $car_yearRow . "</td>";
        echo "<td>" . $car_makeRow . "</td>";
        echo "<td>" . $car_modelRow . "</td>";
        echo "<td>" . $descriptionRow . "</td>";
  ?>


            <td>
              <a href='#' onclick='viewPage("../database/select/find_row/find_row_orders.php", 1); findCAccountRow("<?php echo $order_idRow; ?>", "../database/select/find_row/find_row_orders.php", "../worker_cpanel/orders/intake_repair_form.php"); return false;'>View</a>
            </td>

  <?php     
      echo "</tr>";
    }
  
    echo "</table>";
  
  //if there are no orders
  } else {
    echo "<h3 class='conclusion'>" . "There are no completed Orders" . "</h3>";
    exit();
  }





  //close the statment
  $stmt_completed->close();

}



function completed_invoices($conn){
      //prepare and bind sql statement
  //inner join the customer accounts table into the orders table in order to get the customer's name using the customer id as the key
  $statement = "SELECT Invoice.Invoice_Id, Invoice.Invoice_No, Invoice.Order_No, Invoice.Invoice_Date, Invoice.Authorization_Date, Invoice.Completion_Date, Orders.School_Name, Orders.School_Address ,Order_Profile.Car_Year, Order_Profile.Car_Make, Order_Profile.Car_Model, Invoice.Description
                                      FROM Invoice
                                      LEFT JOIN Orders
                                        ON Invoice.Order_No = Orders.Order_No
                                      LEFT JOIN Order_Profile
                                        ON Orders.Order_No = Order_Profile.Order_No
                                      WHERE Order_Profile.Email = '" . $_SESSION['customer_email'] . "'";
  
    $stmt_invoice = $conn->prepare($statement);

    //execute the prepared statement
    $stmt_invoice->execute();

    //store the selected result
    $stmt_invoice->store_result();

    //bind the selected results
    $stmt_invoice->bind_result($invoice_idRow, $invoice_noRow, $order_noRow, $invoice_dateRow, $completion_dateRow, $return_dateRow, $school_nameRow, $school_addressRow, $car_yearRow, $car_makeRow, $car_modelRow, $descriptionRow);



    //print out the orders that are available
    if ($stmt_invoice->num_rows > 0){

      //prints out a table
      echo "<table class='table'>";
      echo "<tr>";
        echo "<th>Invoice No</th>";
        echo "<th>Order No</th>";
        echo "<th>Date of Invoice</th>";
        echo "<th>Completion Date</th>";
        echo "<th>Date Vehicle is Returned</th>";
        echo "<th>School Name</th>";
        echo "<th>School Address</th>";
        echo "<th>Car Year</th>";
        echo "<th>Car Make</th>";
        echo "<th>Car Model</th>";
        echo "<th>Description of Invoice</th>";
        echo "<th></th>";
       
      echo "</tr>";
  
    while($stmt_invoice->fetch()){
  
        echo "<tr>";
        
        echo "<td>" . $invoice_noRow . "</td>";
        echo "<td>" . $order_noRow . "</td>";
        echo "<td>" . $invoice_dateRow . "</td>";
        echo "<td>" . $completion_dateRow . "</td>";
        echo "<td>" . $return_dateRow . "</td>";
        echo "<td>" . $school_nameRow . "</td>";
        echo "<td>" . $school_addressRow . "</td>";
        echo "<td>" . $car_yearRow . "</td>";
        echo "<td>" . $car_makeRow . "</td>";
        echo "<td>" . $car_modelRow . "</td>";
        echo "<td>" . $descriptionRow . "</td>";
  ?>

            <td>
              <a href='#' onclick='viewPage("../database/select/find_row/find_row_invoices.php", 1); findCAccountRow("<?php echo $invoice_idRow; ?>", "../database/select/find_row/find_row_invoices.php", "../worker_cpanel/invoices/invoice.php"); return false;'>View</a>
            </td>

  <?php     
      echo "</tr>";
    }
  
    echo "</table>";
  
  //if there are no orders
  } else {
    echo "<h3 class='conclusion'>" . "There are no Invoices" . "</h3>";
    exit();
  }





  //close the statment
  $stmt_invoice->close();
}
