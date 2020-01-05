<?php
/**************************************************************************
 * Check if the user is loggedin, if not, redirect them to the login page**
 **************************************************************************/
 
 //if the user is not logged in yet, redirect them to the login page
 if (!$_SESSION['admin_loggedin'] && !$_SESSION['worker_loggedin'] && !$_SESSION['customer_loggedin']){
   header("location:/login/login.php");
 }
?>
