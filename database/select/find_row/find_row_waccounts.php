<?php
/*****************************************************************
** find values of a specific row in the customer accounts table **
******************************************************************/

//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}

//include file to connect to the database
include_once '../../connectdb.php';

//include file to check errors in sql statements
include_once '../../error_check.php';


//prepare and bind sql statement
$stmt_find_waccounts = $conn->prepare("SELECT * FROM Worker_Accounts WHERE Worker_Id= ?");
$stmt_find_waccounts->bind_param("i",$worker_find_id);

//get the customer id using AJAX
$worker_find_id = $_POST['rowId'];

//execute the statement
$stmt_find_waccounts->execute();

//store the result
$stmt_find_waccounts->store_result();

//bind the results
$stmt_find_waccounts->bind_result($worker_idRow, $worker_firstnameRow, $worker_lastnameRow, $worker_passwordRow, $worker_emailRow);




//store the values of the row into sessions
if ($stmt_find_waccounts->num_rows > 0){

  while($stmt_find_waccounts->fetch()){
    //store the values into sessions
    //customer id
    $_SESSION['worker_id'] = $worker_idRow;
 
    //firstname
    $_SESSION['worker_firstname'] = $worker_firstnameRow;
    
    //lastname
    $_SESSION['worker_lastname'] = $worker_lastnameRow;
    
    //password
    $_SESSION['worker_password'] = $worker_passwordRow;
    
    //email
    $_SESSION['worker_email'] = $worker_emailRow;
    
    
    //identify that a customer account is being changed instead of worker account
    $_SESSION['account_change'] = 1;

   }
} else {
  echo "<p>nothing</p>";
}


echo "<p>c_id:" .  $_SESSION['worker_id'] . "</p>";
echo "<p>c_firstame:" .  $_SESSION['worker_firstname'] . "</p>";
echo "<p>c_password:" .  $_SESSION['worker_password'] . "</p>";
echo "<p>c_email:" .  $_SESSION['worker_email'] . "</p>";
echo "<p>c_change_status:" .  $_SESSION['account_change'] . "</p>";


//close the statement
$stmt_find_waccounts->close();
?>
