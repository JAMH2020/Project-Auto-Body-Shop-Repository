<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}

//check if the user is logged in yet
include_once "../login/login_check.php";

//end session if user is not logged in
if (!$_SESSION['admin_loggedin'] && !$_SESSION['worker_loggedin'] && !$_SESSION['customer_loggedin']){
  $_SESSION = array();
  session_destroy();
}
?>


<!DOCTYPE html>

<html lang="en">

<head>  
  <meta charset="UTF-8">
  <!--title that will show up on the tab-->
  <title>Create a Worker Account</title>
  <meta name="description" content="Create Another Worker Account">
  <meta name="author" content="JAMH Group">

  <!--script to create bullet points of error messages if there is a missing field
  or an error with the user's input-->
  <script src="js/errorlist.js"></script>
  <!--script to show password -->
  <script src="js/showpassword.js"></script>
  <!--script that will redirect the user to another page-->
  <script src="../src/js/submit_form.js"></script>
  <!--script that will ask for user confirmation before submitting form-->
  <script src="../src/js/form_confirmation.js"></script>
  <!--style page for the signup page-->
  <link href="signup_styles.css" rel="stylesheet" type="text/css" />
</head>

<body>


<?php
//first name and last name of the worker
$worker_firstname = $worker_lastname = $_SESSION['worker_firstname'] = $_SESSION['worker_lastname'] = "";

//email address
$worker_email = $_SESSION['worker_email'] = "";

//password for the worker's account
$worker_password = $_SESSION['worker_password'] = "";


//variables for any missing fields in the sign up page
$worker_firstnameERR = $worker_lastnameERR = $worker_passwordERR = $worker_emailERR = "";

//title of error section if a missing field occurs
$error_title = "";


//include file that will fix the user inputs that are entered
include "../database/fixinput.php";



//returns an error message if a field is missing or there is an incorrect input
if ($_SERVER['REQUEST_METHOD'] == "POST"){
 
  //firstname
  createErrMsg("sign_up", "first name", "worker_firstname", "worker_firstnameERR");

  //lastname
  createErrMsg("sign_up", "last name", "worker_lastname", "worker_lastnameERR");

  //email
  createErrMsg("sign_up", "email", "worker_email", "worker_emailERR");
  
  //check if there is already a worker account with the same email
  $worker_email_exist = worker_exist($_SESSION['worker_email'], "none");
  
  if ($worker_email_exist){
    $worker_emailERR = "An account with this email already exist";
  }

  //password
  createErrMsg("sign_up", "password", "worker_password", "worker_passwordERR");
  password_check($_SESSION['worker_password'], "password", "worker_passwordERR");
 
 
  //show the error title if any fields are missing after signing up
  if (empty($_POST['worker_firstname']) or empty($_POST['worker_lastname']) or empty($_POST['worker_email']) or empty($_POST['worker_password'])){
    $error_title = "Error";
  }
}



//ask the user to input the required fields if the user has not pressed the sign up button yet
if (!isset($_POST['sign_up']) or $worker_firstnameERR != "" or $worker_lastnameERR != "" or $worker_passwordERR != "" or $worker_emailERR = ""){

  //include the navigation bar
  include "../navigation_bar/navigation_bar.php";
?>


    <div class="background">
      <div class="box">
    
        <span class="error_message"><?php echo $error_title;?></span>
          <ul id="errorList" class="error_message">
          <?php
           //list the error message for firstname if missing
          if ($worker_firstnameERR != ""){
          ?>

            <script> listErrors("<?php echo $worker_firstnameERR?>"); </script>

          <?php
           }
          //list the error message for lastname if missing
           if ($worker_lastnameERR != ""){
          ?>
 
            <script>listErrors("<?php echo $worker_lastnameERR?>");</script>

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
          ?>


         </ul>
       
        <font class="Signup" size="10">Create Worker Account</font>
        <center>
          <form name="accountForm" onsubmit="return confirmForm('accountForm', 'sign_up', 'account')" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete = "off">

            <center class="di"><span>First Name:</span>
            <input type="text" name="worker_firstname" class="form-control" placeholder="First Name" value="<?php echo $_SESSION['worker_firstname'];?>"></center>

            <center class="di"><span>Last Name:</span>
            <input type="text" name="worker_lastname" class="form-control" placeholder="Last Name" value="<?php echo $_SESSION['worker_lastname'];?>"> <br></center>

            <center class="di"><span>Password:</span>
            <input type="password" name="worker_password" class="form-control" placeholder="Password" id="password" value="<?php echo $_SESSION['worker_password'];?>"> <br></center>


           <center class="di">
             <label class="checkbox_container">
              <input type="checkbox" class="checkbox_hidden" onclick="showPassword()">
              <div class="checkmark"></div>
              <span>Show Password</span> 
             </label><br>
           </center>


            <center class="di"><span>Email:</span>
           <input type="text" name="worker_email" class="form-control" placeholder="Email" value="<?php echo $_SESSION['worker_email'];?>"> </center><br>

            <center><input  type="submit" name="sign_up" class="signup_btn" value="Create Worker Account" > <br></center>

          </form>
        </center>
        <div class="back_align">
          <a class="back" href="../admin/admin_cpanel.php">Back</a>
        </div>
      </div>
  </div>
  
  
<?php
//include the footer
include '../footer/footer.php';



} else {
  //insert the user sign up data into the accounts table in the database
  include "../database/insert/insert_wsignup.php";
  
  //notification that an account has been created
  $_SESSION['account_done'] = "insert";
  
  //redirect to the worker section of the admin cpanel
  $_SESSION['admin_section'] = "waccounts";
?>

  <!--redirect to the admin worker account page-->
  <script>redirect_page("../admin/admin_cpanel.php");</script>
  
<?php
}
?>

</body>
</html>
