<?php
/*********************************************
** shows all the worker accounts available  **
**********************************************/


//include file to connect to the database
include '../../database/connectdb.php';

//include file to check errors in sql statements
include '../../database/error_check.php';


//prepare and bind sql statement
$stmt_a_waccounts = $conn->prepare("SELECT * FROM Worker_Accounts");

//execute the statement
$stmt_a_waccounts->execute();

//store the result
$stmt_a_waccounts->store_result();

//bind the results
$stmt_a_waccounts->bind_result($worker_idRow, $worker_firstnameRow, $worker_lastnameRow, $worker_passwordRow, $worker_emailRow);


//print out the accounts that are available
if ($stmt_a_waccounts->num_rows > 0){

  //prints out a table
  echo "<table>";
    echo "<tr>";
      
      echo "<th>Worker Id</th>";
      echo "<th>Name</th>";
      echo "<th>Password</th>";
      echo "<th>Email</th>";
      
    echo "</tr>";

  while($stmt_a_waccounts->fetch()){
    echo "<tr>";
      echo "<td> <input type='radio' name='order_id' value=" . $worker_idRow .">" . $worker_idRow . "</td>";
      echo "<td>" . $worker_firstnameRow . " " . $worker_lastnameRow . "</td>";
      echo "<td>" . $worker_passwordRow . "</td>";
      echo "<td>" . $worker_emailRow . "</td>";
     
    echo "</tr>";
  }
  
  echo "</table>";
  
} else {
  echo "<h3>" . "There are no accounts available" . "</h3>";
}


//close the statement
$stmt_a_waccounts->close();
