<?php
// Include setup file
include_once "../database/connectdb.php";

//include file to check for errors
include_once "../database/error_check.php";





// Prepare and bind select statement for the login
//check customer accounts
$stmt_clogin = $conn->prepare("SELECT * FROM Customer_Accounts WHERE Email = ? AND Password = ?");
$stmt_clogin->bind_param("ss",$param_username, $param_password);

//check worker accounts
$stmt_wlogin =  $conn->prepare("SELECT * FROM Worker_Accounts WHERE Email = ? AND Password = ?");
$stmt_wlogin->bind_param("ss",$param_username, $param_password);

//check admin accounts
$stmt_alogin = $conn->prepare("SELECT * FROM Admin_Accounts WHERE Email = ? AND Password = ?");
$stmt_alogin->bind_param("ss",$param_username, $param_password);


// Set parameters
$param_username = $_POST['login_username'];
$param_password = $_POST['login_password'];

            

//check the customer accounts table
//execute the prepared statement
$stmt_clogin->execute();

// Store result
$stmt_clogin->store_result();

// Bind result variables
$stmt_clogin->bind_result($customer_idRow, $customer_firstnameRow, $customer_lastnameRow, $customer_passwordRow, $customer_emailRow);



//check the worker accounts table
$stmt_wlogin->execute();

// Store result
$stmt_wlogin->store_result();

// Bind result variables
$stmt_wlogin->bind_result($worker_idRow, $worker_firstnameRow, $worker_lastnameRow, $worker_passwordRow, $worker_emailRow);




//check the admin accouts table
$stmt_alogin->execute();

// Store result
$stmt_alogin->store_result();

// Bind result variables
$stmt_alogin->bind_result($admin_idRow, $admin_firstnameRow, $admin_lastnameRow, $admin_passwordRow, $admin_emailRow);



                
// Check if username and password exists from the 
if($stmt_clogin->num_rows > 0){ 
   echo "success";


  //get the result if the username and password exists
  while($stmt_clogin->fetch()){

     
    // Store data in session variables
    //check if user is logged int
    $_SESSION["customer_loggedin"] = true;
    
    //customer's id
    $_SESSION["cusomter_id"] = $customer_idRow;
    
    //customer's firstname
    $_SESSION["customer_firstname"] = $customer_firstnameRow;
    
    //customer's lastname
    $_SESSION["customer_lastname"] = $customer_lastnameRow;  
    
    //customer's password
    $_SESSION['customer_password'] = $customer_passwordRow;
    
    //customer's email
    $_SESSION['customer_email'] = $customer_emailRow;
                            

    // Redirect user to welcome page
?>

<script>redirect_page("../customer/customer_cpanel.php")</script>

<?php
    }

} else{

  //check if the username and password exists in the worker accounts
  if($stmt_wlogin->num_rows > 0){ 
   echo "success";


    //get the result if the username and the password exists
    while($stmt_wlogin->fetch()){

     
    // Store data in session variables
    //check if user is logged int
    $_SESSION["worker_loggedin"] = true;
    
    //worker's id
    $_SESSION["wokrer_id"] = $worker_idRow;
    
    //worker's firstname
    $_SESSION["worker_firstname"] = $worker_firstnameRow;
    
    //worker's lastname
    $_SESSION["worker_lastname"] = $worker_lastnameRow;  
    
    //worker's password
    $_SESSION['worker_password'] = $worker_passwordRow;
    
    //worker's email
    $_SESSION['worker_email'] = $worker_emailRow;
    
    //redirect the user to the worker control panel
?>

<script>redirect_page("../worker_cpanel/worker_cpanel.php")</script>

<?php
    }
    
  } else {
    //check if the username and password exists in the admin accounts
    if($stmt_alogin->num_rows > 0){ 
      echo "success";


      //get the result if the username and the password exists
      while($stmt_alogin->fetch()){

     
        // Store data in session variables
        //check if user is logged int
        $_SESSION["admin_loggedin"] = true;
    
        //admin's id
        $_SESSION["admin_id"] = $admin_idRow;
    
        //admin's firstname
        $_SESSION["admin_firstname"] = $admin_firstnameRow;
    
        //admin's lastname
        $_SESSION["admin_lastname"] = $admin_lastnameRow;  
    
        //admin's password
        $_SESSION['admin_password'] = $admin_passwordRow;
    
        //admin's email
        $_SESSION['admin_email'] = $admin_emailRow;
    
        //redirect the user to the worker control panel
?>

<script>redirect_page("../admin/admin_cpanel.php")</script>

<?php
        }
        
      //prints out error if unable to find the username and password
      } else {
        echo "<p>" . "Incorrect Username or Password" . "</p>";
      }
  
  
  }

}

 
 
// Close statement
$stmt_clogin->close();
$stmt_wlogin->close();
$stmt_alogin->close();
?>
