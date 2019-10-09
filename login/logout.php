<?php
//start the session if it has not been started yet
if (session_start() === null){
  session_start();
}

 
// Unset all of the session variables
$_SESSION = array();

 
// Destroy the session.
session_destroy();

 
// Redirect to login page
?>

<script>redirect_page("http://www.portcreditautobodyshop.tk/login/login.php")</script>

<?php
exit();
?>
