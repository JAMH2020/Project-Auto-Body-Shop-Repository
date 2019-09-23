<?php
// Include setup file
include "../database/connectdb.php";

//include file to check for errors
include "../database/error_check.php";





// Prepare and bind select statement for the login
$stmt_clogin = $conn->prepare("SELECT * FROM Customer_Accounts WHERE Email = ? AND Password = ?");
$stmt_clogin->bind_param("ss",$param_username, $param_password);


// Set parameters
$param_username = $_POST['login_username'];
$param_password = $_POST['login_password'];

            

//execute the prepared statement
$stmt_clogin->execute();

// Store result
$stmt_clogin->store_result();

// Bind result variables
$stmt_clogin->bind_result($customer_idRow, $customer_firstnameRow, $customer_lastnameRow, $customer_passwordRow, $customer_emailRow);

                
// Check if username and password exists from the 
if($stmt_clogin->num_rows > 0){ 
   echo "success";


  //get the result if
  while($stmt_clogin->fetch()){

     
    // Store data in session variables
    //check if user is logged int
    $_SESSION["loggedin"] = true;
    
    //customer's firstname
    $_SESSION["customer_firstname"] = $customer_firstnameRow;
    
    //customer's lastname
    $_SESSION["customer_lastname"] = $customer_lastnameRow;  
    
    //customer's password
    $_SESSION['customer_password'] = $customer_passwordRow;
    
    //customer's email
    $_SESSION['customer_email'] = $customer_emailRow;
                            

    // Redirect user to welcome page
    header("location: ../worker_cpanel/worker_cpanel.php");
    }

} else{
  echo "<p>" . "Incorrect Username or Password" . "</p>";
  
  $x = $_POST['username'];
  $b = $_POST['username'];
  echo "<p>" . $x . "this is u name" . "</p>";
  echo "<p>" . $b .  "this is p name" . "</p>";
}

 
 
// Close statement
$stmt_clogin->close();
?>
