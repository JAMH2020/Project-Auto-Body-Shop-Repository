<?php
/***********************************************
** shows all the customer accounts available  **
************************************************/


//include file to connect to the database
include '../../database/connectdb.php';

//include file to check errors in sql statements
include '../../database/error_check.php';


//prepare and bind sql statement
$stmt_a_caccounts = $conn->prepare("SELECT * FROM Customer_Accounts");

//execute the statement
$stmt_a_caccounts->execute();

//store the result
$stmt_a_caccounts->store_result();

//bind the results
$stmt_a_caccounts->bind_result($customer_idRow, $customer_firstnameRow, $customer_lastnameRow, $customer_passwordRow, $customer_emailRow);


//print out the accounts that are available
if ($stmt_a_caccounts->num_rows > 0){

  //prints out a table
  echo "<table>";
    echo "<tr>";
      
      echo "<th>Customer Id</th>";
      echo "<th>Name</th>";
      echo "<th>Password</th>";
      echo "<th>Email</th>";
      
    echo "</tr>";

  while($stmt_a_caccounts->fetch()){
     echo "<tr>";
      echo "<td> <input type='radio' name='order_id' value=" . $customer_idRow .">" . $customer_idRow . "</td>";
      echo "<td>" . $customer_firstnameRow . " " . $customer_lastnameRow . "</td>";
      echo "<td>" . $customer_passwordRow . "</td>";
      echo "<td>" . $customer_emailRow . "</td>";
     
    echo "</tr>";
   }
   
   echo "</table>";
   
} else {
  echo "<h3>" . "There are no accounts available" . "</h3>";
}



//close the statement
$stmt_a_caccounts->close();
