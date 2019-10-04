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
$stmt_find_caccounts = $conn->prepare("SELECT * FROM Customer_Accounts WHERE Customer_Id= ?");
$stmt_find_caccounts->bind_param("i",$customer_find_id);

//get the customer id using AJAX
$customer_find_id = $_POST['rowId'];

//execute the statement
$stmt_find_caccounts->execute();

//store the result
$stmt_find_caccounts->store_result();

//bind the results
$stmt_find_caccounts->bind_result($customer_idRow, $customer_firstnameRow, $customer_lastnameRow, $customer_passwordRow, $customer_emailRow);




//store the values of the row into sessions
if ($stmt_find_caccounts->num_rows > 0){

  while($stmt_find_caccounts->fetch()){
    //store the values into sessions
    //customer id
    $_SESSION['customer_id'] = $customer_idRow;
 
    //firstname
    $_SESSION['customer_firstname'] = $customer_firstnameRow;
    
    //lastname
    $_SESSION['customer_lastname'] = $customer_lastnameRow;
    
    //password
    $_SESSION['customer_password'] = $customer_passwordRow;
    
    //email
    $_SESSION['customer_email'] = $customer_emailRow;
    
    
    //identify that a customer account is being changed instead of worker account
    $_SESSION['account_change'] = 0;

   }
} else {
  echo "<p>nothing</p>";
}

echo "<p>c_id:" .  $_SESSION['customer_id'] . "</p>";
echo "<p>c_firstame:" .  $_SESSION['customer_firstname'] . "</p>";
echo "<p>c_password:" .  $_SESSION['customer_password'] . "</p>";
echo "<p>c_email:" .  $_SESSION['customer_email'] . "</p>";
echo "<p>c_change_status:" .  $_SESSION['account_change'] . "</p>";



//close the statement
$stmt_find_caccounts->close();
?>
