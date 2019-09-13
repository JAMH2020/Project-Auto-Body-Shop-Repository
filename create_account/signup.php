<!--page to allow customer to sign up an account -->

<!--script to create bullet points of error messages if there is a missing field-->
<script src="js/errorlist.js"></script>
<!--script to show password -->
<script src="js/showpassword.js"></script>

<?php
//first name and last name of the customer
$customer_firstname = $customer_lastname = "";

//email address
$customer_email = "";

//password for the customer's account
$customer_password = "";


//variables for any missing fields in the sign up page
$customer_firstnameERR = $customer_lastnameERR = $customer_passwordERR = $customer_emailERR ="";

//title of error section if a missing field occurs
$error_title = "";


//function that cancels escape codes and allows for html code input
function fix_input($data){
    
  $data = htmlspecialchars($data);

  for ($i = 0; $i < strlen($data); $i++){
    if ($data[$i] == "\\"){
      $data = substr_replace($data, "\\", $i, 0);
      $i++;
    }

  }

  return $data;
}


//returns an error message if a field is missing
if ($_SERVER['REQUEST_METHOD'] == "POST"){
 
  //customer's firstname
  if (empty($_POST['customer_firstname'])){
    $customer_firstnameERR = "first name is missing";
  } else {
    $customer_firstname = fix_input($_POST['customer_firstname']);
  }

   //customer's lastname
  if (empty($_POST['customer_lastname'])){
    $customer_lastnameERR = "last name is missing";
  } else {
    $customer_lastname = fix_input($_POST['customer_lastname']);
  }

  //email
  if (empty($_POST['customer_email'])){
    $customer_emailERR = "email is missing";
  } else {
    $customer_email = fix_input($_POST['customer_email']);
  }
 
  //password
  if (empty($_POST['customer_password'])){
    $customer_passwordERR = "password is missing";
  } else {
    $customer_password = fix_input($_POST['customer_password']);
  }

 
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

<h2>Sign Up</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete = "off">

<span>First Name:</span>
<input type="text" name="customer_firstname" placeholder="First Name">

<span>Last Name:</span>
<input type="text" name="customer_lastname" placeholder="Last Name"> <br>

<span>Password:</span>
<input type="password" name="customer_password" placeholder="Password" id="password"> <br>


<input type="checkbox" onclick="showPassword()">
<span>Show Password</span> <br>


<span>Email:</span>
<input type="text" name="customer_email" placeholder="Email"> <br>

<input type="submit" name="sign_up" value="Sign Up"> <br>

</form>

<?php
} else {
  echo "done";

  //insert the user sign up data into the accounts table in the database
  include "../database/insert.php";
}
?>
