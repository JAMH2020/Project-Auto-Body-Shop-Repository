<?php
/*********************************************************************
 * File to check whethere the admin is making a new customer account *
 *********************************************************************/
 
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}
?>


<?php
//check if the admin is creating a new customer account
if ($_POST['adminCustomer'] == 1){
 $_SESSION['admin_create_caccount'] = 1;
?>

<script>redirect_page('/create_account/signup.php');</script>

<?php
} else {
  $_SESSION['admin_create_caccount'] = 0;
}
?>

<div id="adminCustomer"></div>
