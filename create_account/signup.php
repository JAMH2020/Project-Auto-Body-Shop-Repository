<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}
?>

<!DOCTYPE html>

<html lang="en">

<head>  


  <!--script to create bullet points of error messages if there is a missing field
  or an error with the user's input-->
  <script src="js/errorlist.js"></script>
  <!--script to show password -->
  <script src="js/showpassword.js"></script>
  <!--script that will redirect the user to another page-->
  <script src="../src/js/submit_form.js"></script>
  <!--style page for the signup page-->
  <link href="signup_styles.css" rel="stylesheet" type="text/css" />
</head>

<body>

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
  createErrMsg("sign_up", "first name", "customer_firstname", "customer_firstnameERR");

  //lastname
  createErrMsg("sign_up", "last name", "customer_lastname", "customer_lastnameERR");

  //email
  createErrMsg("sign_up", "email", "customer_email", "customer_emailERR");

  //password
  createErrMsg("sign_up", "password", "customer_password", "customer_passwordERR");
 
 
  //show the error title if any fields are missing after signing up
  if (empty($_POST['customer_firstname']) or empty($_POST['customer_lastname']) or empty($_POST['customer_email']) or empty($_POST['customer_password'])){
    $error_title = "Error";
  }
}

//title for the signup page
$title = "";

//if the admin is creating a customer account
if($_SESSION['admin_create_caccount'] == 1){
  $title = "Create Customer Account";

} else {
  $title = "Sign Up";
}


//ask the user to input the required fields if the user has not pressed the sign up button yet
if (!isset($_POST['sign_up']) or $customer_firstnameERR != "" or $customer_lastnameERR != "" or $customer_passwordERR != "" or $customer_emailERR = ""){

  //include the navigation bar
  include "../navigation_bar/navigation_bar.php";
?>

    <div class="background">
      <div class="box">
    
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
 
            <script>listErrors("<?php echo $customer_lastnameERR?>");</script>

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
       
        <font class="Signup" size="10"><?php echo $title; ?></font>
        <center>
          <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete = "off">

            <center class="di"><span>First Name:</span>
            <input type="text" name="customer_firstname" class="form-control" placeholder="First Name" value="<?php echo $_SESSION['customer_firstname'];?>"></center>

            <center class="di"><span>Last Name:</span>
            <input type="text" name="customer_lastname" class="form-control" placeholder="Last Name" value="<?php echo $_SESSION['customer_lastname'];?>"> <br></center>

            <center class="di"><span>Password:</span>
            <input type="password" name="customer_password" class="form-control" placeholder="Password" id="password" value="<?php echo $_SESSION['customer_password'];?>"> <br></center>


           <center class="di">
             <label class="checkbox_container">
              <input type="checkbox" class="checkbox_hidden" onclick="showPassword()">
              <div class="checkmark"></div>
              <span>Show Password</span> 
             </label><br>
           </center>


            <center class="di"><span>Email:</span>
           <input type="text" name="customer_email" class="form-control" placeholder="Email" value="<?php echo $_SESSION['customer_email'];?>"> </center><br>

            <center><input  type="submit" name="sign_up" class="signup_btn" value="<?php echo $title; ?>" > <br></center>

          </form>
        </center>
      </div>
  </div>

<?php
//include the footer
include '../footer/footer.php';



} else {
  //insert the user sign up data into the accounts table in the database
  include "../database/insert/insert_signup.php";
  
  
  //if the admin is creating a customer account
  if($_SESSION['admin_create_caccount'] == 1){
?>
  <!--redirect to the admin customer account page-->
  <script>redirect_page("../admin/accounts/customer_acc.php");</script>
  

<?php
  
  //if it is any user
  } else {
?>
  <!--redirect to the homepage-->
  <script>redirect_page("http://www.portcreditautobodyshop.tk");</script>

<?php
  }
}
?>

</body>
</html>

