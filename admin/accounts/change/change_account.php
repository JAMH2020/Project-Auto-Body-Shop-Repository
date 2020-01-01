<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}
?>

<!DOCTYPE html>
<html>
<head>
  <!--script to create bullet points of error messages if there is a missing field
 or an error with the user's input-->
  <script src="../../../create_account/js/errorlist.js"></script>
  <!--script to show password -->
  <script src="../../../create_account/js/showpassword.js"></script>
  <!--script that will redirect the user to another page-->
  <script src="../../../src/js/submit_form.js"></script>
  <!--styles for the change account page-->
  <link href="change_account_styles.css" rel="stylesheet" type="text/css" />

</head>
<body>

<?php
//include file that will fix the user inputs that are entered
include "../../../database/fixinput.php";

//title of error section if a missing field occurs
$error_title = "";

//check if there are any errors
$error_account_input = false;


//declare variables if the user is editting a customer account
if ($_SESSION['account_change'] == 0){
  //first name and last name of the customer
  $customer_firstname = $customer_lastname = "";

  //email address
  $customer_email = "";

  //password for the customer's account
  $customer_password = "";


  //variables for any missing fields in the sign up page
  $customer_firstnameERR = $customer_lastnameERR = $customer_passwordERR = $customer_emailERR = "";
  
  
  
  //returns an error message if a field is missing or there is an incorrect input
  if ($_SERVER['REQUEST_METHOD'] == "POST"){
 
    //firstname
    createErrMsg("change_account", "first name", "customer_firstname", "customer_firstnameERR");

    //lastname
    createErrMsg("change_account", "last name", "customer_lastname", "customer_lastnameERR");

    //email
    createErrMsg("change_account", "email", "customer_email", "customer_emailERR");

    //password
    createErrMsg("change_account", "password", "customer_password", "customer_passwordERR");
 
 
    //show the error title if any fields are missing after signing up
    if (empty($_POST['customer_firstname']) or empty($_POST['customer_lastname']) or empty($_POST['customer_email']) or empty($_POST['customer_password'])){
      $error_title = "Error";
      $error_account_input = true;
      
    } else {
      $error_account_input = false;
    }
  
  
  } else {
    //remember the email before submitting the form
    $_SESSION['prev_customer_email'] = $_SESSION['customer_email'];
  }

  
//declare variables if the user is editting a worker account
} else {
  //first name and last name of the worker
  $worker_firstname = $worker_lastname = "";

  //email address
  $worker_email = "";

  //password for the worker's account
  $worker_password = "";


  //variables for any missing fields in the sign up page
  $worker_firstnameERR = $worker_lastnameERR = $worker_passwordERR = $worker_emailERR = "";
  
  
  
  //returns an error message if a field is missing or there is an incorrect input
  if ($_SERVER['REQUEST_METHOD'] == "POST"){
 
    //firstname
    createErrMsg("change_account", "first name", "worker_firstname", "worker_firstnameERR");

    //lastname
    createErrMsg("change_account", "last name", "worker_lastname", "worker_lastnameERR");

    //email
    createErrMsg("change_account", "email", "worker_email", "worker_emailERR");

    //password
    createErrMsg("change_account", "password", "worker_password", "worker_passwordERR");
 
 
    //show the error title if any fields are missing after signing up
    if (empty($_POST['worker_firstname']) or empty($_POST['worker_lastname']) or empty($_POST['worker_email']) or empty($_POST['worker_password'])){
      $error_title = "Error";
      $error_account_input = true;
      
    } else {
      $error_account_input = false;
    }
  
  
  }
}






//ask the user to input the required fields if the user has not pressed the sign up button yet
if (!isset($_POST['change_account']) or $error_account_input){

  //include the navigation bar
  include "../../../navigation_bar/navigation_bar.php";
?>

<span><?php echo $error_title;?></span>
<ul id="errorList">
  <?php
  //list errors for editing customer account
  if ($_SESSION['account_change'] == 0){
    //list the error message for firstname if missing
    if ($customer_firstnameERR != ""){
  ?>

  <script> listErrors("<?php echo $customer_firstnameERR?>"); </script>

  <?php
    }

    //list the error message for lastname if missing
    if ($customer_lastnameERR != ""){
  ?>
 
  <script> listErrors("<?php echo $customer_lastnameERR?>"); </script>

  <?php
    }

    //list the error message for password if missing
    if ($customer_passwordERR != ""){
  ?>

  <script> listErrors("<?php echo $customer_passwordERR?>"); </script>

  <?php
    }

    //list the error message for email if missing
    if ($customer_emailERR != ""){
  ?>

  <script> listErrors("<?php echo $customer_emailERR?>"); </script>

  <?php
    }
    
  //list errors for editing worker account
  } else {
  
    //list the error message for firstname if missing
    if ($worker_firstnameERR != ""){
  ?>
  
  <script> listErrors("<?php echo $worker_firstnameERR?>"); </script>
  
  <?php
    }

    //list the error message for lastname if missing
    if ($worker_lastnameERR != ""){
  ?>
 
  <script> listErrors("<?php echo $worker_lastnameERR?>"); </script>

  <?php
    }

    //list the error message for password if missing
    if ($worker_passwordERR != ""){
  ?>

  <script> listErrors("<?php echo $worker_passwordERR?>"); </script>

  <?php
    }

    //list the error message for email if missing
    if ($worker_emailERR != ""){
  ?>

  <script> listErrors("<?php echo $worker_emailERR?>"); </script>

  <?php
    }
  }
  ?>


</ul>

<div class="background">
  <div class="background_cover">
    <div class="box">


      <span class="Change_Account">Change Account</span>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete = "off">


<?php
//seperate form for changing customer account
if ($_SESSION['account_change'] == 0){
?>

            <div class="form_group">
              <span>First Name:</span>
              <input type="text" class="form_control" name="customer_firstname" placeholder="First Name" value="<?php echo $_SESSION['customer_firstname']; ?>">
              <br>
            </div>


            <div class="form_group">
              <span>Last Name:</span>
              <input type="text" class="form_control"  name="customer_lastname" placeholder="Last Name" value="<?php echo $_SESSION['customer_lastname']; ?>">
              <br>
            </div>


            <div class="form_group">
              <span>Password:</span>
              <input type="password" class="form_control" name="customer_password" placeholder="Password" id="password" value="<?php echo $_SESSION['customer_password']; ?>"> 
              <br>
            </div>




            <label class="checkbox_container">
              <input type="checkbox" class="checkbox_hidden" onclick="showPassword()">
              <div class="checkmark"></div>
              <span>Show Password</span> 
            </label><br>




            <div class="form_group">
              <span>Email:</span>
              <input type="text" class="form_control" name="customer_email" placeholder="Email" value="<?php echo $_SESSION['customer_email']; ?>"> 
              <br>
            </div>

<?php
} else {
?>

            <div class="form_group">
              <span>First Name:</span>
              <input type="text" class="form_control" name="worker_firstname" placeholder="First Name" value="<?php echo $_SESSION['worker_firstname']; ?>">
              <br>
            </div>


            <div class="form_group">
              <span>Last Name:</span>
              <input type="text" class="form_control" name="worker_lastname" placeholder="Last Name" value="<?php echo $_SESSION['worker_lastname']; ?>"> 
              <br>
            </div>


            <div class="form_group">
              <span>Password:</span>
              <input type="password" class="form_control" name="worker_password" placeholder="Password" id="password" value="<?php echo $_SESSION['worker_password']; ?>"> 
              <br>
            </div>




            <label class="checkbox_container">
              <input type="checkbox" class="checkbox_hidden" onclick="showPassword()">
              <div class="checkmark"></div>
              <span>Show Password</span> 
            </label><br>

            <div class="form_group">
              <span>Email:</span>
              <input type="text" class="form_control" name="worker_email" placeholder="Email" value="<?php echo $_SESSION['worker_email']; ?>"> 
              <br>
            </div>


<?php
}
?>


<input type="submit" class="change" name="change_account" value="Change"> <br>

</form>

<?php
  //allows user to go back to the list of customer accounts if they are editting a customer account
  if ($_SESSION['account_change'] == 0){
  
    $_SESSION['admin_section'] = "caccounts";
?>
<div class="back_align">
  <a class="back" href="../../admin_cpanel.php">Back</a>
</div>


<?php
  } else {
    $_SESSION['admin_section'] = "waccounts";
?>
<div class="back_align">
  <a class="back" href="../../admin_cpanel.php">Back</a>
</div>

<?php
  }
?>
    </div>
  </div>
</div>

<?php
//include the footer
include '../../../footer/footer.php';
} else {
  
  //if the user is editing the customer accounts
  if (!$_SESSION['account_change']){
    //change the user sign up data into the accounts table in the database
    include "../../../database/update/update_caccounts.php";
    
    
    //redirect the admin to the customer account section of the admin control panel
    $_SESSION['admin_section'] = "caccounts";
  
?>

<script>redirect_page("../../admin_cpanel.php");</script>

<?php
  } else {
    //change the account data in the worker accounts table in the database
    include "../../../database/update/update_waccounts.php";
    
    //redirect the admin to the worker account section of the admin control panel
    $_SESSION['admin_section'] = "waccounts";
?>

<script>redirect_page("../../admin_cpanel.php");</script>

<?php
  }
}
?>

</body>
</html>



