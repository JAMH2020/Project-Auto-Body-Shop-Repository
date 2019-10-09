<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}
?>

<!-- control panel for the worker -->
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <!--title that will show up on the tab-->
  <title>Welcome</title>
  
  <!--style sheet for the customer control panel-->
  <link rel="stylesheet" type="text/css" href="customer_cpanel_styles.css">
  
  
  <!--JQuery library-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <!--script use to redirect the user to another page-->
  <script src="../src/js/submit_form.js"></script>
  
  <!--script for finding the value of a certain row in the customer table without the refresh of the page-->
  <script src="../database/findRow.js"></script>
  
</head>

<body>
<?php
//include the navigation bar
include '../navigation_bar/navigation_bar.php';
?>

<div class="welcome_page">
  <div class="page-header">
    <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["customer_firstname"] . " " . $_SESSION["customer_lastname"]); ?></b>. Welcome to our site.</h1>
  </div>
      
  <h3>Account Settings</h3>
  <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>

  <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>



  <h3>Orders</h3>
  <a href="#">Book an Appointment</a>
 
  <a href="#">Check My Orders</a>
</div>

<?php
//include the footer
include '../footer/footer.php';
?>


</body>
</html>
