 <!--script to create bullet points of error messages if there is a missing field
 or an error with the user's input-->
  <script src="js/errorlist.js"></script>
  <!--script to show password -->
  <script src="js/showpassword.js"></script>

<?php
//first name and last name of the customer
$customer_firstname = $customer_lastname = $_SESSION['customer_firstname'] = $_SESSION['customer_lastname'] = "";

//email address
$customer_email = $_SESSION['customer_email'] = "";

//password for the customer's account
$customer_password = $_SESSION['customer_password'] = "";


//variables for any missing fields in the sign up page
$customer_firstnameERR = $customer_lastnameERR = $customer_passwordERR = $customer_emailERR = "";

//title of error section if a missing field occurs
$error_title = "";


//include file that will fix the user inputs that are entered
include "../database/fixinput.php";


//returns an error message if a field is missing or there is an incorrect input
if ($_SERVER['REQUEST_METHOD'] == "POST"){
 
  //firstname
  createErrMsg("customer_firstname", "first name", "customer_firstname", "customer_firstnameERR");

  //lastname
  createErrMsg("customer_lastname", "last name", "customer_lastname", "customer_lastnameERR");

  //email
  createErrMsg("customer_email", "email", "customer_email", "customer_emailERR");

  //password
  createErrMsg("customer_password", "password", "customer_password", "customer_passwordERR");
 
 
  //show the error title if any fields are missing after signing up
  if (empty($_POST['customer_firstname']) or empty($_POST['customer_lastname']) or empty($_POST['customer_email']) or empty($_POST['customer_password'])){
    $error_title = "Error";
  }
}



//ask the user to input the required fields if the user has not pressed the sign up button yet
if (!isset($_POST['sign_up']) or $customer_firstnameERR != "" or $customer_lastnameERR != "" or $customer_passwordERR != "" or $customer_emailERR = ""){
?>

<span><?php echo $error_title;?></span>
<ul id="errorList">
  <?php
  //list the error message for firstname if missing
  if ($customer_firstnameERR != ""){
  ?>

  <script> listErrors("<?php echo $customer_firstnameERR?>"); </script>

  <?php
  }

  //list the error message for lastname if missing
  if ($customer_lastnameERR != ""){
  ?>
 
  <script>
  listErrors("<?php echo $customer_lastnameERR?>");
  </script>

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
  ?>


</ul>

<h1>Sign Up</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete = "off">

<span>First Name:</span>
<input type="text" name="customer_firstname" placeholder="First Name" value="<?php echo $_SESSION['customer_firstname'];?>">

<span>Last Name:</span>
<input type="text" name="customer_lastname" placeholder="Last Name" value="<?php echo $_SESSION['customer_lastname'];?>"> <br>

<span>Password:</span>
<input type="password" name="customer_password" placeholder="Password" id="password" value="<?php echo $_SESSION['customer_password'];?>"> <br>


<input type="checkbox" onclick="showPassword()">
<span>Show Password</span> <br>


<span>Email:</span>
<input type="text" name="customer_email" placeholder="Email" value="<?php echo $_SESSION['customer_email'];?>"> <br>

<input type="submit" name="sign_up" value="Sign Up"> <br>

</form>

<?php
} else {
  echo "done";

  //insert the user sign up data into the accounts table in the database
  include "../database/insert.php";
}
?>

